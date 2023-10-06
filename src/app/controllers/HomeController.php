<?php

class HomeController extends Controller implements ControllerInterface
{

  public function index()
  {
    try {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $recipeModel = $this->model('RecipeModel');
                // $fetchResult = $recipeModel->getBySearchQuery(array(

                // ));

                if (isset($_SESSION['user_id'])) {
                    
                } else {
                    $viewResult = $this->view("home", "home", $fetchResult);
                }

                $viewResult->render();

                break;
            default:
                echo "ERROR : Later Fix this!";
        }
    } catch (Exception $e) {
        http_response_code($e->getCode());
    }
  }

  public function test($name = "saddam")
  {
    echo 'my name is ' . $name; 
  }

  // public function login 

}