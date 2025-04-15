<?php

namespace App\Controllers;

use App\Interfaces\ControllerCrudInterface;
use App\Models\DatabaseConnectionFactory;

class ProgramaAquecimentoController extends Controller implements ControllerCrudInterface
{
    public static function show()
    {
        try {
            $conexao = DatabaseConnectionFactory::createMySQLConnection();

            $stmt = $conexao->query("SELECT * FROM programas");
            $personalizados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return json_encode([
                'error' => false,
                'message' => "OK",
                'personalizados' => $personalizados,
            ]);
        } catch (\Exception $e) {
            return json_encode([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public static function store()
    {
        try {
            $conexao = DatabaseConnectionFactory::createMySQLConnection();

            if (!isset($_POST['nome']) || $_POST['nome'] == null) {
                throw new \Exception("Campo 'nome' é obrigatório!");
            } elseif (!isset($_POST['alimento']) || $_POST['alimento'] == null) {
                throw new \Exception("Campo 'alimento' é obrigatório!");
            } elseif (!isset($_POST['potencia']) || $_POST['potencia'] == null) {
                throw new \Exception("Campo 'potencia' é obrigatório!");
            } elseif (!array_key_exists('instrucoes', $_POST)) {
                throw new \Exception("Campo 'potencia' é obrigatório!");
            }

            $nome = $_POST['nome'];
            $alimento = $_POST['alimento'];
            $tempo = $_POST['tempo'];
            $potencia = $_POST['potencia'];
            $instrucoes = $_POST['instrucoes'];

            $stmt = $conexao->prepare("INSERT INTO programas (nome, alimento, tempo, potencia, instrucoes) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $alimento, $tempo, $potencia, $instrucoes]);

            return json_encode([
                'error' => false,
                'message' => "OK",
            ]);
        } catch (\Exception $e) {
            return json_encode([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public static function delete($id)
    {
        try {
            $conexao = DatabaseConnectionFactory::createMySQLConnection();

            $stmt = $conexao->prepare("DELETE FROM programas WHERE id = ?");
            $stmt->execute([$id]);

            return json_encode([
                'error' => false,
                'message' => "OK",
            ]);
        } catch (\Exception $e) {
            return json_encode([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
