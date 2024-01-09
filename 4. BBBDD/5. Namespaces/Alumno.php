<?php namespace Alumno;

class Persona {
    public $nombreAlumno;
    public $otr;


    public function __construct($nom)
    {
        $this->nombreAlumno = $nom;
    }

    public function metodoAlumno(){
        return "Método de persona de Alumno";
    }
}