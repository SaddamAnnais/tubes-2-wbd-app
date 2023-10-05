<?php

class HomeController extends Controller implements ControllerInterface
{

  public function index()
  {
    echo 'this is home controller';
  }

  public function test($name = "saddam")
  {
    echo 'my name is ' . $name; 
  }

  // public function login 

}