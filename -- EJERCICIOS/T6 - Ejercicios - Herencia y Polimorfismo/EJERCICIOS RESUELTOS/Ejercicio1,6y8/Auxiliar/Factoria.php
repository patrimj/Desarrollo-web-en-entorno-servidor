<?php

class Factoria {
    static $nombres= ['Javi', 'Manuel','Patricia','Laura', 'Juan','Jaime','Alejandro','Óscar','Inés','Alejandro','Marina'];
    static $razasPerros = ["Labrador","Bulldog","Golden Retriever","Dachshund", "Yorkshire Terrier"];
    static $razasGatos = ["Siamés","Persa","Maine Coon","Sphynx","Bengal"];
    static $razasElefantes = ["Raza elefante 1","Raza elefante 2","Raza elefante 3","Raza elefante 4","Raza elefante 5"];
    static $colores = ['Rojo','Azul','Verde','Amarillo','Naranja'];
    
    static function generarPerro() {
        $nombre = self::$nombres[rand(0, count(self::$nombres) - 1)];
        $raza = self::$razasPerros[rand(0, count(self::$razasPerros) - 1)];
        $color = self::$colores[rand(0, count(self::$colores) - 1)];
        $p = new Perro($nombre, $raza, rand(1,9),$color);
        return $p;
    }

    static function generarGato() {
        $nombre = self::$nombres[rand(0, count(self::$nombres) - 1)];
        $raza = self::$razasGatos[rand(0, count(self::$razasGatos) - 1)];
        $color = self::$colores[rand(0, count(self::$colores) - 1)];
        $p = new Gato($nombre, $raza, rand(1,9),$color);
        return $p;
    }

    static function generarElefante() {
        $nombre = self::$nombres[rand(0, count(self::$nombres) - 1)];
        $raza = self::$razasElefantes[rand(0, count(self::$razasElefantes) - 1)];
        $color = self::$colores[rand(0, count(self::$colores) - 1)];
        $e = new Elefante($nombre, $raza, rand(100,900),$color);
        return $e;
    }

    static function generarAnimalAzar() {
        $a = new Animal("","","","");
        $rndm = rand(1,3);
        if ($rndm == 1) {
            $a = self::generarPerro();
        }else
            if ($rndm == 2) {
                $a = self::generarGato();
                    } else {
                        $a = self::generarElefante();
                    }
        return $a;
    }
}