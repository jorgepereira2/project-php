<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AquecimentoController;
use App\Controllers\HomeController;
use App\Controllers\ProgramaAquecimentoController;
use Aura\Router\RouterContainer;
use Dotenv\Dotenv;
use Laminas\Diactoros\ServerRequestFactory;

$dotenv = Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->load();

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();
$matcher = $routerContainer->getMatcher();

$map->get('home', '/', function () {
    echo HomeController::index();
});

$map->post('aquecimento', '/aquecimento', function () {
    echo AquecimentoController::store();
});

$map->get('aquecimento.programa.show', '/aquecimento/programa', function () {
    echo ProgramaAquecimentoController::show();
});

$map->post('aquecimento.programa.programa', '/aquecimento/programa', function () {
    echo ProgramaAquecimentoController::store();
});

$map->post('aquecimento.programa.update', '/aquecimento/programa/{id}/update', function ($params) {
    echo ProgramaAquecimentoController::update($params['id']);
});

$map->post('aquecimento.programa.delete', '/aquecimento/programa/{id}/delete', function ($params) {
    echo ProgramaAquecimentoController::delete($params['id']);
});

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$route = $matcher->match($request);
if (!$route) {
    http_response_code(404);
    echo "Página não encontrada.";
    exit;
}

$handler = $route->handler;
$params = $route->attributes;

if (is_callable($handler)) {
    $handler($params);
} else {
    echo "Handler inválido.";
}
