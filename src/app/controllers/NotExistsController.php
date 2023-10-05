<?php

class NotExistsController extends Controller implements ControllerInterface
{
  public function index()
  {
    $NotExistsPage = $this->view('exception', 'NotFound');
    $NotExistsPage->render();
  }
}