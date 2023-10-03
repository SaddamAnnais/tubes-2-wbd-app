<?php

class DisplayedException extends Exception
{
  public function __construct($message, $code)
  {
    parent::__construct($message, $code);
    error_log('ERROR : ' . $code . ': ' . $message);
  }
}