<?php

namespace App\Models;

use App\Interfaces\MicroondasInterface;

class Microondas
{
    public $tempo;
    public $potencia;

    /**
     * @return mixed
     */
    public function getTempo()
    {
        return $this->tempo;
    }

    /**
     * @param mixed $tempo
     */
    public function setTempo($tempo)
    {
        $this->tempo = $tempo;
    }

    /**
     * @return mixed
     */
    public function getPotencia()
    {
        return $this->potencia;
    }

    /**
     * @param mixed $potencia
     */
    public function setPotencia($potencia)
    {
        $this->potencia = $potencia;
    }
}
