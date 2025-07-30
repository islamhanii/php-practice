<?php

namespace App\Http\Controllers;

use App\Providers\View;

class AuthController
{
    public function login()
    {
        View::render('auth/login');
    }
}