<?php

class PremiumController extends Controller implements ControllerInterface
{
  public function index()
  {
    try {
      switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
          // creator list here
          echo "creator list here";

          break;
        default:
          throw new DisplayedException(405);
      }
    } catch (Exception $e) {
      http_response_code($e->getCode());
    }
  }

  public function recipe($params) // $params : creator id
  {
    try {
      switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
          $curl = curl_init();

          // FETCH DATA
          // IMG from backend preferably as base64 encode. This enables the image to be directly used in img tags
          // $response will need recipe_id, duration, title, created_at 

          // EXAMPLE OF FETCHING
          $url = "https://dummyjson.com/quotes/" . $params;
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          $resp = curl_exec($curl);

          if ($e = curl_error($curl)) {
            echo $e;
          } else {
            $viewResult = $this->view("premium", "premium", $resp);
            $viewResult->render();
          }
          break;
        default:
          throw new DisplayedException(405);
      }
    } catch (Exception $e) {
      http_response_code($e->getCode());
    }
  }

  public function collection($params) // $params : collection id
  {
    try {
      switch ($_SERVER['REQUEST_METHOD']) {

        // bercabang jadi 2 antara yang punya param atau engga
        // gapunya param -> nampilin semua colections yang di-subscribe oleh user
        // punya param -> nampilin semua recipe dalam collection dengan id tsb

        case 'GET':
          $curl = curl_init();

          // NOT YET
          // // FETCH DATA
          // // IMG from backend preferably as base64 encode. This enables the image to be directly used in img tags
          // // $response will need recipe_id, duration, title, created_at 

          // // EXAMPLE OF FETCHING
          // $url = "https://dummyjson.com/quotes/" . $params;
          // curl_setopt($curl, CURLOPT_URL, $url);
          // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          // $resp = curl_exec($curl);

          // if ($e = curl_error($curl)) {
          //   echo $e;
          // } else {
          //   $viewResult = $this->view("premium", "premium", $resp);
          //   $viewResult->render();
          // }

          break;
        default:
          throw new DisplayedException(405);
      }
    } catch (Exception $e) {
      http_response_code($e->getCode());
    }
  }
}