<?php

class Ordenador
{
    public $procesador;
    public $grafica;
    public $ram;
    public $placa;
    private $fuente;

    public function __construct($procesador, $grafica, $ram, $placa, $fuente)
    {
        $this->procesador = $procesador;
        $this->grafica = $grafica;
        $this->ram = $ram;
        $this->placa = $placa;
        $this->fuente = $fuente;
    }

    public function getProcesador()
    {
        return $this->procesador;
    }

    public function setProcesador($value)
    {
        $this->procesador = $value;
    }

    public function getGrafica()
    {
        return $this->grafica;
    }

    public function setGrafica($value)
    {
        $this->grafica = $value;
    }

    public function getRam()
    {
        return $this->ram;
    }

    public function setRam($value)
    {
        $this->ram = $value;
    }

    public function getPlaca()
    {
        return $this->placa;
    }

    public function setPlaca($value)
    {
        $this->placa = $value;
    }

    public function getFuente()
    {
        return $this->fuente;
    }

    public function setFuente($value)
    {
        $this->fuente = $value;
    }
}
