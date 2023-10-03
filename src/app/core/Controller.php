<?php

class Controller
{
    public function view($folder, $view, $data = [])
    {
        require_once '../views/' . $folder . '/' . $view . '.php';
        return new $view($data);
    }

    public function model($model)
    {
        require_once '../models/' . $model . '.php';
        return new $model();
    }

    public function middleware($middleware)
    {
        require_once  '../middlewares/' . $middleware . '.php';
        return new $middleware();
    }
}
