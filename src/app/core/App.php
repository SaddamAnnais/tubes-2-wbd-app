<?php
class App
{
  protected $controller = 'home';
  protected $method = 'index';
  protected $params = [];

  public function __construct()
  {
    // parse url
    // turning url like /home/index/ into url[0] => home, url[1] => index
    // $url[0] will invoke the controller
    // $url[1] will invoke the method inside the controller
    // $url[2++] will be the params of the method
    $url = $this->parseUrl();

    // getting the controller
    try {
      if (!isset($url[0])) {
        // throw if there's no controller in url[0]
        throw new DisplayedException('Page Not Found', 404);
      }

      if (!file_exists(__DIR__ . '/../controllers/' . $url[0] . 'Controller.php')) {
        // throw if the controller is not found in the controller
        throw new DisplayedException('Page Not Found', 404);
      }

      // assigned the controller
      $this->controller = $url[0];
      require_once __DIR__ . '/../controllers/' . $this->controller . 'Controller.php';
      unset($url[0]);

      // turning the controller into objects
      $controllerClassName = $this->controller . 'Controller';
      $this->controller = new $controllerClassName();

      // getting the method inside the controller class
      if (isset($url[1])) {
        if (!method_exists($this->controller, $url[1])) {
          throw new DisplayedException('Page Not Found', 404);
        }
        $this->method = $url[1];
        unset($url[1]);
      }

      // getting the method params
      $this->params = $url ? array_values($url) : [];
    } catch (DisplayedException $e) {
      require_once __DIR__ . '/../controllers/NotExistsController.php';
      $this->controller = new NotExistsController();
    }
    // invoke the method inside the controller using the params
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  public function parseUrl()
  {
    if (isset($_SERVER['PATH_INFO'])) {
      $url = filter_var(trim($_SERVER['PATH_INFO'], '/'), FILTER_SANITIZE_URL);
      $explodeUrl = explode('/', $url);
      return $explodeUrl;
    }
  }
}