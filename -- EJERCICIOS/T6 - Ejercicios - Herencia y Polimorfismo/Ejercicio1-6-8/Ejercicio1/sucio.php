

/*
    EJERCICIO 8
*/
// Crear el parque
$parque = new Parque(10); // Parque con 10 sectores

// Crear algunos animales
$perro = new Animal("Buddy");
$gato = new Animal("Whiskers");

// Agregar animales al parque
$parque->agregarAnimal($perro);
$parque->agregarAnimal($gato);

// Simulación del parque
for ($i = 0; $i < 60; $i++) {
    echo "Segundo {$i}:\n";
    $parque->realizarAcciones();
    if ($i % 15 == 0) {
        foreach ($parque->animales as $animal) {
            $animal->moverse($parque);
        }
    }
    if ($i % 20 == 0) {
        foreach ($parque->animales as $animal) {
            $animal->abandonar($parque);
        }
    }
    if ($i % 10 == 0) {
        $nuevoAnimal = new Animal("NuevoAnimal{$i}");
        $parque->agregarAnimal($nuevoAnimal);
    }
    echo "-----------\n";
}

// animal


public function moverse($parque) {
        if ($this->posicion !== null) {
            $nuevaPosicion = $parque->encontrarPosicionLibre();
            if ($nuevaPosicion !== null) {
                echo "{$this->nombre} se mueve de la posición {$this->posicion} a la posición {$nuevaPosicion}.\n";
                $parque->ocuparPosicion($nuevaPosicion, $this);
                $parque->liberarPosicion($this->posicion);
                $this->posicion = $nuevaPosicion;
            }
        }
    }

    public function abandonar($parque) {
        if ($this->posicion !== null && mt_rand(0, 1) == 0) { // 50% de probabilidad de abandonar
            echo "{$this->nombre} ha abandonado el parque.\n";
            $parque->liberarPosicion($this->posicion);
            $this->posicion = null;
        }
    }
}

//parque



<?php
class Parque {
    private $sectores = [];
    private $tamanio;
    private $animales = [];

    public function __construct($tamanio) {
        $this->tamanio = $tamanio;
        for ($i = 0; $i < $tamanio; $i++) {
            $this->sectores[$i] = null;
        }
    }

    public function encontrarPosicionLibre() {
        $posicionesLibres = array_keys($this->sectores, null);
        if (!empty($posicionesLibres)) {
            return $posicionesLibres[array_rand($posicionesLibres)];
        }
        return null;
    }

    public function ocuparPosicion($posicion, $animal) {
        $this->sectores[$posicion] = $animal;
    }

    public function liberarPosicion($posicion) {
        $this->sectores[$posicion] = null;
    }

    public function agregarAnimal($animal) {
        $posicionLibre = $this->encontrarPosicionLibre();
        if ($posicionLibre !== null) {
            $this->animales[] = $animal;
            $animal->moverse($this);
        } else {
            echo "{$animal->nombre} no puede entrar al parque, no hay espacio.\n";
        }
    }

    public function realizarAcciones() {
        foreach ($this->animales as $animal) {
            $accion = mt_rand(1, 3); // 1: comer, 2: dormir, 3: hacerRuido
            switch ($accion) {
                case 1:
                    $animal->comer();
                    
                case 2:
                    $animal->dormir();
                    
                case 3:
                    $animal->hacerRuido();
                    
            }
        }
    }
}
