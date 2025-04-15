<?php

namespace App\Interfaces;

interface MicroondasInterface
{
    public function definePreDefinido($preDefinido);

    public function defineTempo($tempo);

    public function definePotencia($potencia);

    public function iniciarAquecimento();
}
