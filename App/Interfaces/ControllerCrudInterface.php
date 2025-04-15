<?php

namespace App\Interfaces;

interface ControllerCrudInterface
{
    public static function show();

    public static function store();

    public static function delete($id);
}
