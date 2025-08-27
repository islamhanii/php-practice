<?php

namespace App\Http\Controllers;

use App\Providers\View;

class HomeController
{
    public function index($name)
    {
        View::render('index', compact('name'));
    }
}