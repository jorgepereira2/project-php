<?php

namespace App\Controllers;

use App\Interfaces\ControllerRequestInterface;
use App\Models\MicroondasFactory;

class AquecimentoController extends Controller implements ControllerRequestInterface
{
    public static function store()
    {
        $tempo = self::params('tempo');
        $potencia = self::params('potencia');

        $Microondas = new MicroondasFactory();
        $Microondas->defineTempo($tempo);
        $Microondas->definePotencia($potencia);
        $iniciarAquecimento = $Microondas->iniciarAquecimento();

        Debug("tempo => {$iniciarAquecimento->getTempo()}", false);
        Debug("potencia => {$iniciarAquecimento->getPotencia()}", false);
        exit;
    }
}
