<?php

namespace App\Models;

use App\Interfaces\MicroondasInterface;

class MicroondasFactory implements MicroondasInterface
{
    public $tempoMin = 1;
    public $tempoMax = 120;
    public $potenciaMin = 1;
    public $potenciaMax = 10;
    public $preDefinido = false;

    public $tempo;
    public $potencia;

    public function definePreDefinido($preDefinido)
    {
        $this->preDefinido = $preDefinido;
    }

    public function defineTempo($tempo)
    {
        if (($tempo < $this->tempoMin || $tempo > $this->tempoMax) && $this->preDefinido == false) {
            throw new \Exception("O tempo informado de {$tempo}, não pode ser menor que {$this->tempoMin} e maior que {$this->tempoMax}.");
        }
        $this->tempo = $tempo;
    }

    public function definePotencia($potencia = null)
    {
        $potencia = ($potencia)
            ? (int)$potencia
            : 10;

        if (($potencia < $this->potenciaMin || $potencia > $this->potenciaMax) && $this->preDefinido == false) {
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
