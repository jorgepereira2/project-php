<?php

namespace App\Interfaces;

interface MicroondasInterface
{
    public function defineTempo($tempo);

    public function definePotencia($potencia);

    public function iniciarAquecimento();
}
