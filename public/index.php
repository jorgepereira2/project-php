<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AquecimentoController;
use App\Controllers\HomeController;
use App\Controllers\RouterController;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->load();

$app = new RouterController();

$app->get('/', function () {
    return HomeController::index();
});

$app->post('/', function () {
    return AquecimentoController::store();
});

$app->run();
