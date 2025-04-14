<?php

namespace App\Controllers;

class RouterController
{
    private $routes = [];
    private static $params = [];

    private function validate(string $method)
    {
        return in_array($method, ['get', 'post']);
    }

    public function __call(string $method, array $args)
    {
        $method = strtolower($method);

        if (!$this->validate($method))
            return false;

        [$route, $action] = $args;
        if (!isset($action) or !is_callable($action))
            return false;

        $this->routes[$method][$route] = $action;
        return true;
    }

    public function run()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']) ?? 'get';
        $route = $_GET['r'] ?? '/';

        if (!isset($this->routes[$method]))
            die('405 Method not allowed');

        if (!isset($this->routes[$method][$route]))
            die('404 Error');

        self::$params = $this->getParams($method);

        die($this->routes[$method][$route]());
    }

    private function getParams(string $method)
    {
        if ($method == 'get')
            return $_GET;

        return $_POST;
    }

    public static function getRequest()
    {
        return self::$params;
    }
}
