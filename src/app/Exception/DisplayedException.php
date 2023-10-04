<?php

class DisplayedException extends Exception
{
  private $http_message = [
    400 => 'Bad Request',
    401 => 'Unauthorized',
    403 => 'Forbidden',
    404 => 'Page Not Found',
    405 => 'Method Not Allowed',
    413 => 'Payload/File Too Large',
    415 => 'Unsupported Media Type',
    500 => 'Internal Server Error',
    502 => 'Bad Gateway'
  ];

  private $additional_message;

  public function __construct($code, $additional_message = null)
  {
    parent::__construct($this->http_message[$code], $code);
    $this->additional_message = $additional_message;

    if ($additional_message) {
      error_log('ERROR : ' . $code . ': ' . $this->http_message[$code] . '\nADDITIONAL MESSAGE : ' . $additional_message);
    } else {
      error_log('ERROR : ' . $code . ': ' . $this->http_message[$code]);
    }
  }
}
