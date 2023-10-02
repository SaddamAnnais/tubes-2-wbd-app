<?php
// TODO: hapus
require_once 'app/core/database.php';
require_once 'app/core/Router.php';

// do we need establish new connection on each page load?
new DB();
new Router();

?>
