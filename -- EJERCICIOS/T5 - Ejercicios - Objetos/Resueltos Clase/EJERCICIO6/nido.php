<?php

class Nido {
    public $serpientes = [];
    public $aniosVividos = 0;
    private $maxSerpientes = 20;


    public function __construct(){
    }
    public function getAniosVividos(){
        return $this->aniosVividos;
    }
    public function setAniosVividos($aniosVividos){
        $this->aniosVividos = $aniosVividos;
    }
    public function getSerpientes(){
        return $this->serpientes;
    }
    public function setSerpientes($serpientes){
        $this->serpientes = $serpientes;
    }
    public function naceSerpiente(){
        if (sizeof($this->serpientes) < $this->maxSerpientes){
            $cuantas = rand(1,3);
            Factoria::crearVariasSerientes($cuantas);
        }
    }
    public function pasarAnio(){
        $this->aniosVividos++;
        foreach ($this->serpientes as $serpiente) {
            $serpiente->pasarAnio();
        }
    }
}