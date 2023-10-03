<?php
require_once '../app/init.php';

// Activate or destroy session
if (session_status() === PHP_SESSION_ACTIVE) {
  $current_time = time();

  if ($current_time - $_SESSION['created_at'] > SESSION_EXPIRATION_TIME) {
      session_unset();
      session_destroy();
  }
}

if (session_status() === PHP_SESSION_NONE) {
  session_start();

  $_SESSION['created_at'] = time();
}

// Entry Point to WebApp
$app = new App;