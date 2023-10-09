<?php


class UserModel
{
  private $db;

  public function __construct()
  {
    $this->db = new DB();
  }

  public function getUserByUsername($username)
  {
    $this->db->query('SELECT * FROM user WHERE username = :username');
    $this->db->bind('username', $username);
    return $this->db->fetch();
  }

  public function getUserById($user_id)
  {
    $this->db->query('SELECT * FROM user WHERE user_id = :user_id');
    $this->db->bind('user_id', $user_id);
    return $this->db->fetch();
  }

  public function getUsers()
  {
    $query = 'SELECT * FROM user';
    $this->db->query($query);
    return $this->db->fetchAll();
  }

  public function login($data)
  {
    $this->db->query('SELECT user_id, password_hash FROM user WHERE username = :username LIMIT 1');
    $this->db->bind('username', $data['username']);

    $result = $this->db->fetch();
    if ($result) {
      if (password_verify($data['password'], $result->password_hash)) {
        return $result->user_id;
      }
    }

    throw new DisplayedException(401);
  }

  public function register($data)
  {
    $query = "INSERT INTO user (username, name, password_hash, is_admin) values (:username, :name, :password_hash, false)";
    $this->db->query($query);
    $this->db->bind('username', $data['username']);
    $this->db->bind('name', $data['name']);
    $this->db->bind('password_hash', password_hash($data['password'], PASSWORD_DEFAULT));
    $this->db->exec();

    return $this->login($data);
  }

  // WARNING: for seeding purposes only
  public function registerAdmin($data)
  {
    $query = "INSERT INTO user (username, name, password_hash, is_admin) values (:username, :name, :password_hash, true)";
    $this->db->query($query);
    $this->db->bind('username', $data['username']);
    $this->db->bind('name', $data['name']);
    $this->db->bind('password_hash', password_hash($data['password'], PASSWORD_DEFAULT));
    $this->db->exec();

    return $this->db->rowCount();
  }

  public function updateUserById($userId, $data)
  {
    $query = "UPDATE user SET username = :username, name = :name WHERE user_id = :user_id";
    $this->db->query($query);
    $this->db->bind('username', $data['username']);
    $this->db->bind('name', $data['name']);
    $this->db->bind('user_id', $userId);
    $this->db->exec();
  }

  public function updateUserPasswordById($userId, $newPassword)
  {
    $query = "UPDATE user SET password_hash = :password_hash WHERE user_id = :user_id";
    $this->db->query($query);
    $this->db->bind('password_hash', password_hash($newPassword, PASSWORD_DEFAULT));
    $this->db->bind('user_id', $userId);
    $this->db->exec();
  }

  public function deleteUserById($userId)
  {
    $query = "DELETE FROM user WHERE user_id = :user_id";
    $this->db->query($query);
    $this->db->bind('user_id', $userId);
    $this->db->exec();
  }

  // WARNING: for seeding purposes only
  public function hardReset()
  {
    $query = 'DELETE FROM user';
    $this->db->query($query);
    $this->db->exec();
  }
}