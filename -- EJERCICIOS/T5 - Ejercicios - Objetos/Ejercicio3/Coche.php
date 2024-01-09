<?php

/*
Realiza una clase coche que tenga los atributos necesarios que permitan reflejar su marca, modelo, color y matrícula. También debe almacenar información acerca de sus características de movimiento: motor encendido o apagado, marchaActual, velocidadActual, subirMarcha, bajarMarcha y aquellos que creas conveniente para manipular su información dinámica.
Crea los métodos habituales que creas conveniente y, además, los métodos necesarios que nos permitan simular lo siguiente:
    a) El coche parte de una situación de reposo.$motorEncendido = false
    b) Arranca.
    c) Acelera e irá subiendo marchas hasta llegar a una velocidad que se ha pedido por teclado al usuario.
    d) Se mantiene esa velocidad un tiempo que se ha pedido al usuario por teclado.
    e) Se va desacelerando y bajando marchas hasta que el coche se pare.
    f) Punto muerto y paramos el motor.
 */
class Coche {
    private $marca;
    private $modelo;
    private $color;
    private $matricula;
    private $motorEncendido = false;
    private $marchaActual = 0;
    private $velocidadActual = 0;

    public function __construct($marca, $modelo, $color, $matricula) {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->color = $color;
        $this->matricula = $matricula;
    }

    public function arrancar() {
        // Arranca
        $this->motorEncendido = true;
    }

    public function apagar() {
        // Apaga el motor del coche.
        $this->motorEncendido = false;
    }

    public function subiendoMarchas() {
        // Sube una marcha del coche si es posible.
        if ($this->motorEncendido && $this->marchaActual < 5) {
            $this->marchaActual++;
        }
    }

    public function bajandoMarchas() {
        if ($this->motorEncendido && $this->marchaActual > 0) {
            $this->marchaActual--;
        }
    }

    public function acelerarHastaVelocidad($velocidadDeseada) {
        // Acelera el coche hasta alcanzar la velocidad pedid.
        if ($this->motorEncendido && $this->marchaActual > 0) {
            while ($this->velocidadActual < $velocidadDeseada) {
                $this->velocidadActual += 20; //aumentar la velocidad actual del coche en 20 km/h 
                if ($this->velocidadActual > $velocidadDeseada) {
                    $this->velocidadActual = $velocidadDeseada;
                }
                $this->subiendoMarchas();
            }
        }
    }

    public function mantenerVelocidadPorTiempo($tiempoSegundos) {
        sleep($tiempoSegundos);
    }

    public function desacelerarHastaParar() {
        while ($this->velocidadActual > 0) {
            $this->velocidadActual -= 10;
            $this->bajandoMarchas();
        }
    }

    public function puntoMuerto() {

        $this->marchaActual = 0;
    }

    public function pararMotor() {
        $this->apagar();
        $this->puntoMuerto();
    }

    function __toString()
    {
        return "Marca: {$this->marca} Modelo: {$this->modelo}, Color: {$this->color} , Matricula: {$this->matricula}, Motor: {$this->motorEncendido}, Marcha:  {$this->marchaActual}, velocidad: {$this->velocidadActual} ";
    }
}
echo json_encode($v, JSON_UNESCAPED_UNICODE);
?>