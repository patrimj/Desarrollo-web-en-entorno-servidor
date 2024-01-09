<?php
class Serpiente {
    private $anillas = [];
    private $edad;
    private $color;
    public $viva;//por defecto se crean vivas

    public function __construct() { // Se ejecuta automáticamente cuando se crea una nueva instancia de serpiente
        $this->edad = 0;
        $this->color = $this->generarColorAzar(); //Cuando nace tiene un color asignado al azar.
        $this->crecer();
        $this->viva = true;//por defecto se crean vivas
    }

    public function envejecer() {
        $this->edad++;
        $s= new Serpiente();
        
        while (!$s -> muere() && $tiempo <= $tope){
            if ($s -> getEdad()<= 10){ //joven 
                if (mt_rand(1, 100) <= 80) {
                    $this->crecer();
                } else {
                    if (mt_rand(1, 100) === 20) { // la probabilidad de que sea igual a 1 es del 20% 
                        $this->mudarPiel();
                    }
                }
            } else { //Si ya va siendo mayorcilla (más de 10 años)
                    if (mt_rand(1, 100) === 10) {
                        $this->mudarPiel();
                    } else {
                        if (mt_rand(1, 100) <= 90) {
                            $this->decrecer();
                        }
                    }
                }

                if (mt_rand(1, 10) === 1) {
                    $this->viva = false;
                }
        }
    } 
    // echo json_encode($s);

    public function muere() {
        return !$this->viva;
    }

    public function getColor() {
        return $this->color;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function getAnillas() {
        return $this->anillas;
    }

    private function generarColorAzar() {
        $colores = ['r', 'v', 'a'];
        return $colores[array_rand($colores)];
    }

    public function crecer() {
        $this->anillas[] = $this->color;
    }

    public function decrecer() {
        if (!empty($this->anillas)) {
            array_pop($this->anillas);//quitamos
        }
    }

    public function mudarPiel() {
        $this->color = $this->generarColorAzar();
    }
}


