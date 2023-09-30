<?php

require_once '../../config/config.php';
require_once '../core/Database.php';

class PlaylistModel {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function createPlaylist($data) {
        $query = "";
    }

    public function getPlaylistsByTitle($title) {

    }

    public function getPlaylistsByOwner($username) {

    }

    public function getPlaylistOwner($playlistId) {

    }

    public function renamePlaylist($playlistId, $newTitle) {

    }

    public function deletePlaylist($playlistId) {

    }

    public function fetchAllRecipe($playlistId) {
        
    }

    public function addRecipe($playlistId, $recipeId) {

    }

    public function removeRecipe($playlistId, $recipeId) {

    }


}
