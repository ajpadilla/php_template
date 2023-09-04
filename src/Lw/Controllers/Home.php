<?php

namespace Template\Php\Controllers;

use Template\Php\View;

class Home
{
    public function index(): View
    {
        //$_SESSION['count'] = ($_SESSION['count'] ?? 0) + 1;
        //return 'HomeController';

        return View::make('index');
    }
}