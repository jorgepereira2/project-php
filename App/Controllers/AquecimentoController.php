<?php

namespace App\Controllers;

use App\Interfaces\ControllerRequestInterface;
use App\Models\MicroondasFactory;

class AquecimentoController extends Controller implements ControllerRequestInterface
{
    public static function store()
    {
        try {
            $tempo = self::params('tempo');
            $potencia = self::params('potencia');
            $preDefinido = self::params('preDefinido');

            $Microondas = new MicroondasFactory();
            $Microondas->definePreDefinido($preDefinido);
            $Microondas->defineTempo((int)$tempo);
            $Microondas->definePotencia($potencia);
            $Microondas->iniciarAquecimento();

            return json_encode([
                'error' => false,
                'message' => "Aquecimento OK",
                'params' => [
                    'tempo' => $tempo,
                    'potencia' => $potencia,
                ],
            ]);
        } catch (\Exception $e) {
            return json_encode([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public static function aquecimentoPreDefinidos()
    {
        return [
            [
                "nome" => "Pipoca",
                "alimento" => "Pipoca (de micro-ondas)",
                "tempoSegundos" => 180,
                "tempo" => formataSegundos(180),
                "potencia" => 7,
                "instrucoes" => "Observar o barulho de estouros do milho, caso houver um intervalo de mais de 10 segundos entre um estouro e outro, interrompa o aquecimento."
            ],
            [
                "nome" => "Leite",
                "alimento" => "Leite",
                "tempoSegundos" => 300,
                "tempo" => formataSegundos(300),
                "potencia" => 5,
                "instrucoes" => "Cuidado com aquecimento de líquidos, o choque térmico aliado ao movimento do recipiente pode causar fervura imediata causando risco de queimaduras."
            ],
            [
                "nome" => "Carnes de boi",
                "alimento" => "Carne em pedaço ou fatias",
                "tempoSegundos" => 840,
                "tempo" => formataSegundos(840),
                "potencia" => 4,
                "instrucoes" => "Interrompa o processo na metade e vire o conteúdo com a parte de baixo para cima para o descongelamento uniforme."
            ],
            [
                "nome" => "Frango",
                "alimento" => "Frango (qualquer corte)",
                "tempoSegundos" => 480,
                "tempo" => formataSegundos(480),
                "potencia" => 7,
                "instrucoes" => "Interrompa o processo na metade e vire o conteúdo com a parte de baixo para cima para o descongelamento uniforme."
            ],
            [
                "nome" => "Feijão",
                "alimento" => "Feijão congelado",
                "tempoSegundos" => 480,
                "tempo" => formataSegundos(480),
                "potencia" => 9,
                "instrucoes" => "Deixe o recipiente destampado e em casos de plástico, cuidado ao retirar o recipiente pois o mesmo pode perder resistência em altas temperaturas."
            ]
        ];
    }
}
