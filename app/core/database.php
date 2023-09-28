<?php
require(__DIR__ . '/../config/config.php');
class DB {
  private $connection;
  private $statement;

  public function __construct()
  {
    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
    $option = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    try {
      $this->connection = new PDO($dsn, DB_USER, DB_PASSWORD, $option);

      if ($this->connection) {
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
      $this->connection->exec($create_user);
      $this->connection->exec($create_recipe);
      $this->connection->exec($create_playlist);
      $this->connection->exec($create_playlist_recipe);

      echo (" Table created successfully.");
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function query($query) {
    $this->statement = $this->connection->prepare($query);
  }

  public function exec() {
    $this->statement->execute();
  }
}
