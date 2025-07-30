<?php

namespace App\Http\Controllers;

use App\Providers\View;

class HomeController
{
    public function index()
    {
        $name = "Islam";

        View::render('index', compact('name'));
    }
}