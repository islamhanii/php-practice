<?php

namespace App\Http\Exceptions;

class RouteNotFoundException extends \Exception
{
    protected $message = '404 Not Found';
    protected $code = 404;
}