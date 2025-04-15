<?php

namespace App\Models;

class DatabaseConfig
{
    public $host;
    public $dbname;
    public $username;
    public $password;
    public $charset;

    public function __construct()
    {
        $this->host = $_ENV['DATABASE_HOST'];
        $this->dbname = $_ENV['DATABASE_NAME'];
        $this->username = $_ENV['DATABASE_USER'];
        $this->password = $_ENV['DATABASE_PASSWORD'];
        $this->charset = $_ENV['DATABASE_CHARSET'];
    }
}
