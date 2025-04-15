<?php

namespace Core;

namespace App\Controllers;

use Throwable;

class ExceptionLoggerController
{
    public static function log(Throwable $ex)
    {
        $log = [
            'data' => date('Y-m-d H:i:s'),
            'mensagem' => $ex->getMessage(),
            'arquivo' => $ex->getFile(),
            'linha' => $ex->getLine(),
            'stacktrace' => $ex->getTraceAsString(),
        ];

        // Inner Exception (caso seja ErrorException dentro de outro try-catch)
        if ($ex->getPrevious()) {
            $log['inner_exception'] = $ex->getPrevious()->getMessage();
        }

        // (Opcional) Informações do request
        if (php_sapi_name() !== 'cli') {
            $log['request_uri'] = $_SERVER['REQUEST_URI'] ?? '';
            $log['method'] = $_SERVER['REQUEST_METHOD'] ?? '';
            $log['ip'] = $_SERVER['REMOTE_ADDR'] ?? '';
        }

        // Converte para JSON bonito
        $linha = json_encode($log, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL . str_repeat('-', 80) . PHP_EOL;

        file_put_contents(__DIR__ . '/../Logs/erros.log', $linha, FILE_APPEND);
    }
}
