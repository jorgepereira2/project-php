<?php

namespace App\Models;

use App\Interfaces\MicroondasInterface;

class MicroondasFactory implements MicroondasInterface
{
    public $tempoMin = 1;
    public $tempoMax = 120;
    public $potenciaMin = 1;
    public $potenciaMax = 10;

    public $tempo;
    public $potencia;

    public function defineTempo($tempo)
    {
        if ($tempo < $this->tempoMin || $tempo > $this->tempoMax) {
            throw new \Exception("O tempo informado de {$tempo}, não pode ser menor que {$this->tempoMin} e maior que {$this->tempoMax}.");
        }
        $this->tempo = $tempo;
    }

    public function definePotencia($potencia = null)
    {
        $potencia = ($potencia)
            ? $potencia
            : 10;

        if ($potencia < $this->potenciaMin || $potencia > $this->potenciaMax) {
            throw new \Exception("A potência informada de {$potencia}, não pode ser menor que {$this->potenciaMin} e maior que {$this->potenciaMax}.");
        }
        $this->potencia = $potencia;
    }

    public function iniciarAquecimento()
    {
        $Microondas = new Microondas();
        $Microondas->setTempo($this->tempo);
        $Microondas->setPotencia($this->potencia);
        return $Microondas;
    }
}
