<?php

namespace App\Models;

class DatabaseConnectionFactory
{
    public static function createMySQLConnection(): \PDO
    {
        try {
            $config = new DatabaseConfig();
            $dsn = "mysql:host={$config->host};dbname={$config->dbname};charset={$config->charset}";
            $pdo = new \PDO($dsn, $config->username, $config->password, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ]);
            return $pdo;
        } catch (\PDOException $e) {
            throw new \RuntimeException("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }
}
