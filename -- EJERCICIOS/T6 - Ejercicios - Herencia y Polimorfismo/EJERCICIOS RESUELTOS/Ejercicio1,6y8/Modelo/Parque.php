<?php
class Parque {
    public $sector = [];

    function getSector() {
        return $this->sector;
    }

    

    // function introducirAnimal($a) {
    //     $claseAnimal = get_class($a);
        
    //     if ($a instanceof Animal) {
    //         foreach ($this->sector as $value) {
    //             if ($value instanceof $claseAnimal) {
    //                 return; // El animal del mismo tipo ya se encuentra en el sector, no lo agregamos de nuevo
    //             }
    //         }
    //         $this->sector[] = $a;
    //     }
    // }
    
    
    function comerAnimales() {
        foreach ($this->sector as $value) {
            $value->comer();
        }
    }
    function ruidoAnimales() {
        foreach ($this->sector as $value) {
            $value->hacerRuido();
        }
    }

    function duermenAnimales() {
        foreach ($this->sector as $value) {
            $value->dormir();
        }
    }

    function cambiarAnimalPosicion($a, $b) {
        //no se
    }

    function cuantos() {
        return count($this->sector) - 1;
    }

    function eliminarAnimal($indexAleatorio) {
        unset($this->sector[$indexAleatorio]);
        $this->sector = array_values($this->sector);
    }

    function introducirAnimal($a) {

        $seEncuentra = false;
        if ($a instanceof Perro) {
            foreach ($this->sector as $value) {
                if ($value instanceof Perro) {
                    $seEncuentra = true;
                }           
            }
            if (!$seEncuentra) {
                $this->sector[] = $a;
            }
            $seEncuentra = false;
        }elseif ($a instanceof Gato) {
            foreach ($this->sector as $value) {
                if ($value instanceof Gato) {
                    $seEncuentra = true;
                }        
            }
            if (!$seEncuentra) {
                $this->sector[] = $a;
            }
        } else {
            $seEncuentra = false;
            foreach ($this->sector as $value) {
                if ($value instanceof Elefante) {
                    $seEncuentra = true;
                }        
            }
            if (!$seEncuentra) {
                $this->sector[] = $a;
            }
        }
    }
}