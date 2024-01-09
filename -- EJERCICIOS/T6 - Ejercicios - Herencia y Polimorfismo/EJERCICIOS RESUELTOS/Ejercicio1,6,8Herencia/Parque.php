<?php
require_once('Perro.php');
require_once('Gato.php');
require_once('Elefante.php');
require_once('Animal.php');


class Parque {
    public $sectores = [];
    public $animales = [];
    
    public function __construct($numSectores) {
        for ($i = 0; $i < $numSectores; $i++) {
            $this->sectores[] = null; 
        }
    }
    
    public function agregarAnimal($animal) {
        $posicion = rand(0, count($this->sectores) - 1);
        if ($this->sectores[$posicion] === null) {
            $this->sectores[$posicion] = $animal;
            $this->animales[] = $animal;
        } 
    }
    
    public function realizarAcciones() {
        foreach ($this->animales as $animal) {
            $accionAleatoria = rand(1, 3);
            switch ($accionAleatoria) {
                case 1:
                    $animal->comer();
                    break;
                case 2:
                    $animal->dormir();
                    break;
                case 3:
                    $animal->hacerRuido();
                    break;
            }
        }
    }
    
    public function moverAnimales() {
        foreach ($this->animales as $animal) {
            $posicionActual = array_search($animal, $this->sectores);
            $nuevaPosicion = $posicionActual + rand(-1, 1);
            
            if ($nuevaPosicion >= 0 && $nuevaPosicion < count($this->sectores) && $this->sectores[$nuevaPosicion] === null) {
                $this->sectores[$posicionActual] = null;
                $this->sectores[$nuevaPosicion] = $animal;
            }
        }
    }
    
    public function abandonarAnimales() {
        foreach ($this->animales as $animal) {
            if (rand(0, 1) === 0) {
                $posicionActual = array_search($animal, $this->sectores);
                $this->sectores[$posicionActual] = null;
                unset($this->animales[array_search($animal, $this->animales)]);
            }
        }
    }
}