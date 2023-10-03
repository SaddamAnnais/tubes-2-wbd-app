<?php
require_once __DIR__ . '/../config/config.php';

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

            if ($this->conn) {
                echo "Connected to the database successfully!";
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        $create_user = "CREATE TABLE IF NOT EXISTS user (
            user_id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username        VARCHAR(255) NOT NULL,
            name            VARCHAR(255) NOT NULL,
            password_hash   VARCHAR(255) NOT NULL,
            is_admin        BOOLEAN DEFAULT FALSE
        )";

        $create_recipe = "CREATE TABLE IF NOT EXISTS recipe (
            recipe_id       INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title           VARCHAR(255) NOT NULL,
            `desc`          TEXT NOT NULL,
            tag             VARCHAR(255) NOT NULL,  # dessert, main course, appetizer
            difficulty      VARCHAR(6) NOT NULL,    # easy, medium, hard
            video_path      VARCHAR(255) NOT NULL,
            duration        INT(9) NOT NULL,
            image_path      VARCHAR(255) NOT NULL,
            created_at      DATETIME DEFAULT CURRENT_TIMESTAMP
        )";

        $create_playlist = "CREATE TABLE IF NOT EXISTS playlist (
            playlist_id     INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title           VARCHAR(255) NOT NULL,
            user_id         INT UNSIGNED,
            created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE ON UPDATE CASCADE
        )";

        $create_playlist_recipe = "CREATE TABLE IF NOT EXISTS playlist_recipe (
            recipe_id       INT UNSIGNED,
            playlist_id     INT UNSIGNED,
            PRIMARY KEY (recipe_id, playlist_id),
            FOREIGN KEY (recipe_id) REFERENCES recipe(recipe_id),
            FOREIGN KEY (playlist_id) REFERENCES playlist(playlist_id)
        )";

        $delete_recipe_trigger = "
            CREATE TRIGGER delete_recipe_trigger
            BEFORE DELETE ON recipe
            FOR EACH ROW
            DELETE FROM playlist_recipe WHERE recipe_id = OLD.recipe_id;
        ";

        try {
            $this->conn->exec($create_user);
            $this->conn->exec($create_recipe);
            $this->conn->exec($create_playlist);
            $this->conn->exec($create_playlist_recipe);
            // $this->conn->exec($delete_recipe_trigger);

            // TODO: hapus
            echo (" Table created successfully.");
        } catch (PDOException $e) {
            die($e->getMessage());
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
        } catch (PDOException) {
            // TODO: error handling
        }
    }

    public function query($query)
    {
        try {
            $this->stmt = $this->conn->prepare($query);
        } catch (PDOException) {
            // TODO: error handling
        }
    }

    public function exec()
    {
        try {
            $this->stmt->execute();
        } catch (PDOException) {
            // TODO: error handling
        }
    }

    // fetch a row from the result set
    public function fetch()
    {
        try {
            $this->exec();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException) {
            // TODO: error handling
        }
    }

    // array containing all rows of a result set
    public function fetchAll()
    {
        try {
            $this->exec();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException) {
            // TODO: error handling
        }
    }

    public function rowCount()
    {
        try {
            return $this->stmt->rowCount();
        } catch (PDOException) {

        }
    }

}
