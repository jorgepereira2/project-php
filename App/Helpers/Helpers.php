<?php

use App\Models\DatabaseConnectionFactory;

if (!function_exists('Debug')) {
    function Debug($string, $exit = true)
    {
        echo "<pre>";
        print_r($string);
        echo "</pre>";

        if ($exit) {
            exit;
        }
    }
}

if (!function_exists('DebugDump')) {
    function DebugDump($dump, $exit = true)
    {
        var_dump($dump);

        if ($exit) {
            exit;
        }
    }
}

if (!function_exists('formataSegundos')) {
    function formataSegundos($segundos)
    {
        $minutos = floor($segundos / 60);
        $segundosRestantes = $segundos % 60;
        return "{$minutos}:{$segundosRestantes}";
    }
}

if (!function_exists('gerarToken')) {
    function gerarToken(): string
    {
        return bin2hex(random_bytes(32)); // 256 bits
    }
}

if (!function_exists('autenticarUsuario')) {
    function autenticarUsuario($email, $senha): ?array
    {
        $conexao = DatabaseConnectionFactory::createMySQLConnection();

        $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify("JJS" . $senha, $usuario['senha'])) {
            $token = gerarToken();

            $stmt = $conexao->prepare("UPDATE usuarios SET token = ? WHERE id = ?");
            $stmt->execute([$token, $usuario['id']]);

            $usuario['token'] = $token;
            return $usuario;
        }

        return null;
    }
}

if (!function_exists('verificarToken')) {
    function verificarToken($request): ?array
    {
        $headers = $request->getHeader('Authorization');
        if (empty($headers)) return null;

        $token = trim(str_replace('Bearer', '', $headers[0]));

        $conexao = DatabaseConnectionFactory::createMySQLConnection();

        $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE token = ?");
        $stmt->execute([$token]);

        return $stmt->fetch() ?: null;
    }
}
