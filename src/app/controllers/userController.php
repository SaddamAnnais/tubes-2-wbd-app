<?php

class userController extends Controller implements ControllerInterface
{

  public function index()
  {
    echo 'this is user controller';
  }

  public function login()
  {
    try {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
              print_r($_ENV);
                // Prevent CSRF Attacks
                // $tokenMiddleware = $this->middleware('TokenMiddleware');
                // $tokenMiddleware->putToken();

                // $loginView = $this->view('user', 'LoginView');
                // $loginView->render();
                exit;

            case 'POST':
                // // Prevent CSRF Attacks
                // $tokenMiddleware = $this->middleware('TokenMiddleware');
                // $tokenMiddleware->checkToken();

                // $userModel = $this->model('UserModel');
                // $userId = $userModel->login($_POST['username'], $_POST['password']);
                // $_SESSION['user_id'] = $userId;

                // // Kembalikan redirect_url
                // header('Content-Type: application/json');
                // http_response_code(201);
                // echo json_encode(["redirect_url" => BASE_URL . "/home"]);
                exit;

            default:
                // throw new LoggedException('Method Not Allowed', 405);
        }
    } catch (Exception $e) {
        // http_response_code($e->getCode());
        exit;
    }
  }

  // public function login 

}