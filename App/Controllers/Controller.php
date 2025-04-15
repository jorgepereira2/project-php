<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    protected final static function view(string $_name, array $vars = [])
    {
        $loader = new FilesystemLoader(__DIR__ . "/../Views");
        $twig = new Environment($loader);

        $_filename = __DIR__ . "/../Views/{$_name}.html.twig";
        if (!file_exists($_filename))
            die("View {$_name} not found!");

        return $twig->render(
            "{$_name}.html.twig",
            $vars
        );
    }

    protected final static function params(string $name)
    {
        $params = json_decode(file_get_contents('php://input'), true);
        if (!isset($params[$name]))
            return null;
        return $params[$name];
    }

    protected final static function redirect(string $to)
    {
        $url = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
        $folders = explode('?', $_SERVER['REQUEST_URI'])[0];
        header('Location:' . $url . $folders . '?r=' . $to);
        exit();
    }
}
