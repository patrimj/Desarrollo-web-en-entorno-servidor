<?php
//Todos tendrán un nombre, una raza, un peso y un color. 
//Los métodos vacunar, comer y dormir son comunes. 
class Animal implements AInterface{
    public $nombre;
    public $raza;
    public $peso;
    public $color;
    public $posicion;// EJERCICIO 8

    /* 
    public function __construct($nombre, $raza, $peso, $color) {
        $this->nombre = $nombre;
        $this->raza = $raza;
        $this->peso = $peso;
        $this->color = $color;
    }*/

    public function __construct($nombre) {
        $this->nombre = $nombre;
        $this->posicion = null;
    }


    public function vacunar() {
        return "{$this->nombre} está vacunado";
    }

    public function comer() {
        return "{$this->nombre} come";
    }

    public function dormir() {
        return "{$this->nombre} duerme";
    }

    //Los métodos hacerRuido y hacerCaso serán sobreescritos en las especializaciones
    public function hacerRuido() {
        // en las clases hijas
    }

    public function hacerCaso() {
        // en las clases hijas
    }

}