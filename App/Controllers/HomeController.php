<?php

namespace App\Controllers;

use App\Interfaces\ControllerViewInterface;

class HomeController extends Controller implements ControllerViewInterface
{
    public static function index()
    {
        return self::view('Home', [
            //
        ]);
    }
}
