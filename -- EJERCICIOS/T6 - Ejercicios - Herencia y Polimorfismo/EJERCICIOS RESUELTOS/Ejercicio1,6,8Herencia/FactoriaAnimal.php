<?php
require_once('Perro.php');
require_once('Gato.php');
require_once('Elefante.php');
require_once('Animal.php');



class FactoriaAnimal {
    public static $tipoAnimales = ['Perro', 'Gato', 'Elefante'];
    public static $nombres=['Luna','Lola','Lolo','Lulu'];
    public static $razas=['Pastor Aleman','Bulldog','Pitbull','Labrador'];
    public static $pesos=['10','20','30','40'];
    public static $colores=['amarillo','rojo','verde','azul'];

    public static function crearAnimal() {
        $nombre = self::$nombres[array_rand(self::$nombres)]; 
        $raza = self::$razas[array_rand(self::$razas)]; 
        $peso = self::$pesos[array_rand(self::$pesos)]; 
        $color = self::$colores[array_rand(self::$colores)];
        $tipoAnimal = self::$tipoAnimales[array_rand(self::$tipoAnimales)]; 
        $animalElegido = new $tipoAnimal($nombre,$raza,$peso,$color); 
        return $animalElegido;
    }
}




// public static function selectTipo($tipoAnimal) {
//     switch ($tipoAnimal) {
//         case 'gato':
//             return 'Gato'; 
//         case 'perro':
//             return 'Perro';
//         case 'elefante':
//             return 'Elefante';
//         default:
//             return 'Perro';
//     }
// }

// public static function crearAnimal($tipoAnimal,$cantidadAnimal) {
//     $tipoSeleccionado = self::selectTipo($tipoAnimal); 
//     for ($i = 0; $i < $cantidadAnimal; $i++) {
//         $animal = new $tipoSeleccionado; 
//         $parque->agregarAnimal($animal);
//     }

//     return $animal;
// }
