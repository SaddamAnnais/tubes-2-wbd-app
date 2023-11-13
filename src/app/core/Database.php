<?php

class DB
{
    private $conn;
    private $stmt;

    public function __construct()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->conn = new PDO($dsn, DB_USER, DB_PASSWORD, $option);
        } catch (PDOException $e) {
            throw new DisplayedException(502, $e->getMessage());
        }

        $create_user = "CREATE TABLE IF NOT EXISTS user (
            user_id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username        VARCHAR(255) UNIQUE NOT NULL,
            name            VARCHAR(255) NOT NULL,
            password_hash   VARCHAR(255) NOT NULL,
            is_admin        BOOLEAN DEFAULT FALSE
        )";

        $create_recipe = "CREATE TABLE IF NOT EXISTS recipe (
            recipe_id       INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title           VARCHAR(255) NOT NULL,
            `desc`          TEXT NOT NULL,
            tag             VARCHAR(255) NOT NULL,  # dessert, main course, appetizer, full course
            difficulty      VARCHAR(6) NOT NULL,    # easy, medium, hard
            video_path      VARCHAR(255) NOT NULL,
            duration        INT UNSIGNED NOT NULL,
            image_path      VARCHAR(255) NOT NULL,
            created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
            CHECK((difficulty = \"easy\" OR difficulty = \"medium\" OR difficulty = \"hard\") AND (tag = \"dessert\" OR tag = \"main course\" OR tag = \"appetizer\" OR tag = \"full course\"))
        )";

        $create_playlist = "CREATE TABLE IF NOT EXISTS playlist (
            playlist_id     INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title           VARCHAR(255) NOT NULL,
            user_id         INT UNSIGNED,
            created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
            cover           VARCHAR(255) DEFAULT NULL,
            total_recipe    INT UNSIGNED DEFAULT 0,
            FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE ON UPDATE CASCADE
        )";

        $create_playlist_recipe = "CREATE TABLE IF NOT EXISTS playlist_recipe (
            recipe_id       INT UNSIGNED,
            playlist_id     INT UNSIGNED,
            PRIMARY KEY (recipe_id, playlist_id),
            FOREIGN KEY (recipe_id) REFERENCES recipe(recipe_id),
            FOREIGN KEY (playlist_id) REFERENCES playlist(playlist_id) ON DELETE CASCADE ON UPDATE CASCADE
        )";

        $update_recipe_trigger = "CREATE TRIGGER IF NOT EXISTS update_recipe_trigger
            AFTER UPDATE ON recipe
            FOR EACH ROW
            BEGIN
                UPDATE playlist SET cover = NEW.image_path WHERE cover IS NOT NULL  AND playlist_id IN (SELECT playlist_id FROM playlist_recipe pr2 WHERE pr2.recipe_id = NEW.recipe_id);
            END;
        ";

        $insert_to_playlist_trigger = "CREATE TRIGGER IF NOT EXISTS insert_to_playlist_trigger
            AFTER INSERT ON playlist_recipe
            FOR EACH ROW
            BEGIN
                UPDATE playlist SET total_recipe = total_recipe + 1 WHERE playlist_id = NEW.playlist_id;
                UPDATE playlist SET cover = (SELECT image_path FROM recipe WHERE recipe_id = NEW.recipe_id) WHERE playlist_id = NEW.playlist_id;
            END;
        ";

        $delete_from_playlist_trigger = "CREATE TRIGGER IF NOT EXISTS delete_from_playlist_trigger
            AFTER DELETE ON playlist_recipe
            FOR EACH ROW
            BEGIN
                UPDATE playlist SET total_recipe = total_recipe - 1 WHERE playlist_id = OLD.playlist_id;
                UPDATE playlist SET cover = (SELECT r.image_path FROM playlist_recipe pr, recipe r WHERE pr.playlist_id = OLD.playlist_id AND r.recipe_id = pr.recipe_id LIMIT 1) WHERE playlist_id = OLD.playlist_id AND total_recipe <> 0;
                UPDATE playlist SET cover = NULL WHERE playlist_id = OLD.playlist_id AND total_recipe = 0;
            END;
        ";

        try {
            $this->conn->exec($create_user);
            $this->conn->exec($create_recipe);
            $this->conn->exec($create_playlist);
            $this->conn->exec($create_playlist_recipe);
            $this->conn->exec($insert_to_playlist_trigger);
            $this->conn->exec($update_recipe_trigger);
            $this->conn->exec($delete_from_playlist_trigger);
        } catch (PDOException $e) {
            throw new DisplayedException(500, $e->getMessage());
        }
    }

    public function bind($param, $value, $type = null)
    {
        try {
            if (is_null($type)) {
                switch (true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                        break;
                }
            }

            $this->stmt->bindValue($param, $value, $type);
        } catch (PDOException $e) {
            throw new DisplayedException(500, $e->getMessage());
        }
    }

    public function query($query)
    {
        try {
            $this->stmt = $this->conn->prepare($query);
        } catch (PDOException $e) {
            throw new DisplayedException(500, $e->getMessage());
        }
    }

    public function exec()
    {
        try {
            $this->stmt->execute();
        } catch (PDOException $e) {
            throw new DisplayedException(500, $e->getMessage());
        }
    }

    // fetch a row from the result set
    public function fetch()
    {
        try {
            $this->exec();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new DisplayedException(500, $e->getMessage());
        }
    }

    // array containing all rows of a result set
    public function fetchAll()
    {
        try {
            $this->exec();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new DisplayedException(500, $e->getMessage());
        }
    }

    public function rowCount()
    {
        try {
            return $this->stmt->rowCount();
        } catch (PDOException $e) {
            throw new DisplayedException(500, $e->getMessage());
        }
    }

}
