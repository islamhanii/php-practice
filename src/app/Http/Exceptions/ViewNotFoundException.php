<?php

namespace App\Http\Exceptions;

class ViewNotFoundException extends \Exception
{
    protected $message = 'View not found';
    protected $code = 404;
}