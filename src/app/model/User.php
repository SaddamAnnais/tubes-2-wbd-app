<?php

require_once '../../config/config.php';
require_once '../core/Database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    // TODO: Implement CRUD
}
