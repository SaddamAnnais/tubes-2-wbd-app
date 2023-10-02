<?php

class Router {
    private $VIEWS_URL = '/../components/';

    public function __construct()
    {
        $this->route();
    }

    public function route() {
        $request = trim($_SERVER['REQUEST_URI'], "/");

        
        switch ($request) {
            case '':
            case 'index':
            case 'index.php':
            case 'index.html':
            case 'home':
            case 'home.php':
            case 'home.html':
                require __DIR__ . $this->VIEWS_URL . 'home/home.php'; ;
                break;

            default:
                // http_response_code(404);
                require __DIR__ . $this->VIEWS_URL . 'templates/404.php';
        }
    }
}