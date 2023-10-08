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

                if(isset($_GET["search"])) {
                  $searchQuery["search"] = $_GET["search"];
                }

                if(isset($_GET["filter_by_tag"])) {
                  $searchQuery["filter_by_tag"] = $_GET["filter_by_tag"];
                }

                if(isset($_GET["filter_by_diff"])) {
                  $searchQuery["filter_by_diff"] = $_GET["filter_by_diff"];
                }

                if(isset($_GET["page"])) {
                  $searchQuery["page"] = $_GET["page"];
                }

                $data = $recipeModel->getBySearchQuery($searchQuery);

                if(isset($_GET["page"])) {
                  $data["curPages"] = $_GET["page"];// careful different indexing start
                } else {
                  $data["curPages"] = 1;
                }

                if (isset($_SESSION['user_id'])) {
                    
                } else {
                    $viewResult = $this->view("home", "home", $data);
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
  // public function login 

}