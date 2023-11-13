<?php


class PlaylistModel {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function createPlaylist($data) {
        $query = "INSERT INTO playlist (title, user_id) values (:title, :user_id)";

        $this->db->query($query);
        $this->db->bind('title', $data['title']);
        $this->db->bind('user_id', $data['user_id']);

        $this->db->exec();
    }

    public function getPlaylistById($playlist_id)
    {
        $query = 'SELECT * FROM playlist WHERE playlist_id = :playlist_id';

        $this->db->query($query);
        $this->db->bind('playlist_id', $playlist_id);
        $playlist = $this->db->fetch();

        return $playlist;
    }

    public function getPlaylistsByTitle($title) {
        $query = "SELECT * FROM playlist WHERE title = :title";

        $this->db->query($query);
        $this->db->bind('title', $title);

        $this->db->fetchAll();
    }

    public function getPlaylistsByOwner($user_id) {
        $query = "SELECT * FROM playlist WHERE user_id = :user_id";

        $this->db->query($query);
        $this->db->bind('user_id', $user_id);

        return $this->db->fetchAll();
    }

    public function getPlaylistOwnerId($playlist_id) {
        $query = "SELECT user_id FROM playlist WHERE playlist_id = :playlist_id";

        $this->db->query($query);
        $this->db->bind('playlist_id', $playlist_id);

        return $this->db->fetch();
    }

    public function renamePlaylist($playlist_id, $title) {
        $query = "UPDATE playlist SET title = :title WHERE playlist_id = :playlist_id";

        $this->db->query($query);
        $this->db->bind('title', $title);
        $this->db->bind('playlist_id', $playlist_id);

        $this->db->exec();
    }

    public function deletePlaylist($playlist_id) {
        $query = "DELETE FROM playlist WHERE playlist_id = :playlist_id";

        $this->db->query($query);
        $this->db->bind('playlist_id', $playlist_id);

        $this->db->exec();
    }

    public function fetchAllRecipe($playlist_id) {
        $query = "SELECT * FROM playlist_recipe INNER JOIN recipe ON playlist_recipe.recipe_id = recipe.recipe_id WHERE playlist_id = :playlist_id";

        $this->db->query($query);
        $this->db->bind('playlist_id', $playlist_id);

        return $this->db->fetchAll();
    }

    public function addToPlaylist($playlist_id, $recipe_id) {
        $query = "INSERT INTO playlist_recipe (playlist_id, recipe_id) VALUES (:playlist_id, :recipe_id)";

        $this->db->query($query);
        $this->db->bind('playlist_id', $playlist_id);
        $this->db->bind('recipe_id', $recipe_id);

        $this->db->exec();
    }

    public function removeFromPlaylist($playlist_id, $recipe_id) {
        $query = "DELETE FROM playlist_recipe WHERE playlist_id = :playlist_id AND recipe_id = :recipe_id";

        $this->db->query($query);
        $this->db->bind('playlist_id', $playlist_id);
        $this->db->bind('recipe_id', $recipe_id);

        $this->db->exec();
    }

    // WARNING: for seeding purposes only
    public function hardReset()
    {
      $query = 'DELETE FROM playlist';
      $this->db->query($query);
      $this->db->exec();
    }
}
