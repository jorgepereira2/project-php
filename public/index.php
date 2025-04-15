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
$map->post('aquecimento.programa.delete', '/aquecimento/programa/{id}/delete', function ($params) {
    echo ProgramaAquecimentoController::delete($params['id']);
});

// Login
$map->post('login', '/login', function ($params) {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (!$email || !$senha) {
        http_response_code(400);
        echo json_encode(["erro" => "E-mail e senha obrigatórios"]);
        return;
    }

    $usuario = autenticarUsuario($email, $senha);
    if (!$usuario) {
        http_response_code(401);
        echo json_encode([
            "erro" => true,
            "message" => "Credenciais inválidas",
            "params" => [
                'email' => $email,
                'senha' => $senha,
            ],
        ]);
        exit;
    }

    echo json_encode([
        "erro" => false,
        "message" => "Login bem-sucedido",
        "token" => $usuario['token']
    ]);
    exit;
});
$map->post('api.aquecimento', '/api/aquecimento', function ($params, $request, $usuario) {
    http_response_code(200);
    echo json_encode([
        "erro" => false,
        "message" => "Olá, " . $usuario['nome'] . "! Você acessou uma rota api.",
        "body" => json_decode(AquecimentoController::store(), true),
    ]);
    exit;
});
$map->post('api.aquecimento.programa.show', '/api/aquecimento/programa', function ($params, $request, $usuario) {
    http_response_code(200);
    echo json_encode([
        "erro" => false,
        "message" => "Olá, " . $usuario['nome'] . "! Você acessou uma rota api.",
        "body" => json_decode(ProgramaAquecimentoController::show(), true),
    ]);
    exit;
});
$map->post('api.aquecimento.programa.store', '/api/aquecimento/programa/store', function ($params, $request, $usuario) {
    http_response_code(200);
    echo json_encode([
        "erro" => false,
        "message" => "Olá, " . $usuario['nome'] . "! Você acessou uma rota api.",
        "body" => json_decode(ProgramaAquecimentoController::store(), true),
    ]);
    exit;
});
$map->post('api.aquecimento.programa.delete', '/api/aquecimento/programa/{id}/delete', function ($params, $request, $usuario) {
    http_response_code(200);
    echo json_encode([
        "erro" => false,
        "message" => "Olá, " . $usuario['nome'] . "! Você acessou uma rota api.",
        "body" => json_decode(ProgramaAquecimentoController::delete($params['id']), true),
    ]);
    exit;
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

if (strpos($route->name, 'api') !== false) {
    $usuario = verificarToken($request);
    if (!$usuario) {
        http_response_code(401);
        echo json_encode([
            "erro" => true,
            "message" => "Token inválido!",
        ]);
        exit;
    }
    $handler($params, $request, $usuario);
}

if (is_callable($handler)) {
    $handler($params);
} else {
    echo "Handler inválido.";
}
