<?php

class UserController extends Controller implements ControllerInterface
{

  public function index()
  {
    try {
      switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
          $editProfilerPage = $this->view('user', 'EditProfile');
          $editProfilerPage->render();
          exit;

        case 'POST':
          // // verify if the username and password are correct
          // $userModel = $this->model('UserModel');
          // $userId = $userModel->login($_POST);
          // $_SESSION['user_id'] = $userId;

          // // send response redirect to client 
          // header('Content-Type: application/json');
          // http_response_code(201);
          // $url = json_encode(["url" => BASE_URL . "/home"]);
          // echo $url;
          // die();

        default:
          throw new DisplayedException(405);
      }
    } catch (DisplayedException $e) {
      http_response_code($e->getCode());
      die();
    }
  }

  public function login()
  {
    try {
      switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
          $loginPage = $this->view('user', 'Login');
          $loginPage->render();
          exit;

        case 'POST':
          // verify if the username and password are correct
          $userModel = $this->model('UserModel');
          $userId = $userModel->login($_POST);
          $_SESSION['user_id'] = $userId;

          // send response redirect to client 
          header('Content-Type: application/json');
          http_response_code(201);
          $url = json_encode(["url" => BASE_URL . "/home"]);
          echo $url;
          die();

        default:
          throw new DisplayedException(405);
      }
    } catch (DisplayedException $e) {
      http_response_code($e->getCode());
      die();
    }
  }

  public function register()
  {
    try {
      switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
          $registerPage = $this->view('user', 'Register');
          $registerPage->render();
          exit;

        case 'POST':
          // verify if the username are available
          $userModel = $this->model('UserModel');
          $userModel->register($_POST);

          // send response redirect to client 
          header('Content-Type: application/json');
          http_response_code(201);
          $url = json_encode(["url" => BASE_URL . "/home"]);
          echo $url;
          die();

        default:
          throw new DisplayedException(405);
      }
    } catch (Exception $e) {
      http_response_code($e->getCode());
      die();
    }
  }
  // public function test()
  // {
  //   $userModel = $this->model('UserModel');
  //   $data = array(
  //     'username' => 'asd',
  //     'password' => 'asd',
  //   );
  //   $result = $userModel->login($data);
  //   echo $result;
  // }
}