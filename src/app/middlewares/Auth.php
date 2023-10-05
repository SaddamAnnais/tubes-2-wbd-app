<?php

class Auth
{
  private $db;

  public function __construct()
  {
    $this->db = new DB();
  }

  public function isAuthenticated()
  {
    if (!isset($_SESSION['user_id'])) {
      throw new DisplayedException(401);
    }

    $this->db->query('SELECT * FROM user WHERE user_id = :user_id LIMIT 1');
    $this->db->bind('user_id', $_SESSION['user_id']);

    $result = $this->db->fetch();

    if (!$result) {
      throw new DisplayedException(401);
    }

    return $result;
  }

  public function isAdmin()
  {
    $result = $this->isAuthenticated();

    if (!$result->is_admin) {
      throw new DisplayedException(401);
    }
  }
}
