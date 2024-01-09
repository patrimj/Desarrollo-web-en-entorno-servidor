<?php namespace Persona;

class Persona {
    public $nombrePersona;


    public function __construct($nom)
    {
        $this->nombrePersona = $nom;
    }

    public function metodoPersona(){
        return "Método de persona de Persona";
    }
}