<?php
require_once __DIR__ . '/../../config/config.php';

class DB {
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
            user_id             INTEGER     PRIMARY KEY     AUTO_INCREMENT
            -- TODO: Continue... (jangan lupa displit koma)
        )";

        $create_recipe = "CREATE TABLE IF NOT EXISTS recipe (
            recipe_id           INTEGER     PRIMARY KEY     AUTO_INCREMENT
            -- TODO: Continue... (jangan lupa displit koma)
        )";

        $create_playlist = "CREATE TABLE IF NOT EXISTS playlist (
            playlist_id         INTEGER     PRIMARY KEY     AUTO_INCREMENT
            -- TODO: Continue... (jangan lupa displit koma)
        )";

        $create_playlist_recipe = "CREATE TABLE IF NOT EXISTS playlist_recipe (
            playlist_recipe_id  INTEGER     PRIMARY KEY     AUTO_INCREMENT
            -- TODO: Continue... (jangan lupa displit koma)
        )";

        try {
            $this->conn->exec($create_user);
            $this->conn->exec($create_recipe);
            $this->conn->exec($create_playlist);
            $this->conn->exec($create_playlist_recipe);

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

}
