<?php

class UnauthorizedController extends Controller implements ControllerInterface
{
  public function index()
  {
    $NotExistsPage = $this->view('exception', 'Unauthorized');
    $NotExistsPage->render();
  }
}