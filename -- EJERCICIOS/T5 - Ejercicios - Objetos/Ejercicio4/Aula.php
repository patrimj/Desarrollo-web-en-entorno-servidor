<?php

class Aula
{
    public $numero;
    public $curso;
    public $ordenadores;

    public function __construct($numero, $curso)
    {
        $this->numero = $numero;
        $this->curso = $curso;
        $this->ordenadores = [];
        // for ($i = 0; $i < count($ordenadores); ++$i) {
        //     $this->ordenadores[] = $ordenadores[$i];
        // }
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($value)
    {
        $this->numero = $value;
    }

    public function getCurso()
    {
        return $this->curso;
    }

    public function setCurso($value)
    {
        $this->curso = $value;
    }

    public function getOrdenadores()
    {
        return $this->ordenadores;
    }

    public function setOrdenadores($value)
    {
        for ($i = 0; $i < count($value); ++$i) {
            $this->ordenadores[] = $value[$i];
        }
    }

    public function addOrdenador($o){
        $this->ordenadores[] = $o;
    }
}
