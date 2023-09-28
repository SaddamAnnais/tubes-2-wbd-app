<?php

require_once '../../config/config.php';
require_once '../core/Database.php';

class PlaylistModel {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    // TODO: Implement CRUD
}
