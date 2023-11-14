<?php

class HomeController extends Controller implements ControllerInterface
{

  public function index()
  {
    try {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $recipeModel = $this->model('RecipeModel');
                $searchQuery = [];
                
                $data = $recipeModel->getBySearchQuery($searchQuery);

                $viewResult = $this->view("home", "home", $data);

                $viewResult->render();

                break;
            default:
                throw new DisplayedException(405);
        }
    } catch (Exception $e) {
        http_response_code($e->getCode());
    }
  }
  // public function login 

}