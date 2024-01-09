<?php
// INTRODUCCIÓN

//Cuatro tipos escalares:
$boolean = TRUE;
$integer = 12;
$double = 12.12;
$string = 'HOLA';
//Cuatro tipos compuestos:
$array = array();
    $array = array(
        "foo" => "bar",
        "bar" => "foo",
    );

    // a partir de PHP 5.4
    $array = [
        "foo" => "bar",
        "bar" => "foo",
    ];

    $arr = array('fruit' => 'apple', 'veggie' => 'carrot');

    // Correcto
    print $arr['fruit'];  // apple
    print $arr['veggie']; // carrot

//object  (https://www.php.net/manual/es/language.types.object.php)
    class foo
    {
        function hacer_algo()
        {
            echo "Haciendo algo."; 
        }
    }

    $bar = new foo;
    $bar->hacer_algo();
$callable = 
//iterable 
    function foo(iterable $iterable) {
        foreach ($iterable as $valor) {
            // ...
        } 
    }
    // Iterable es un seudotipo introducido en PHP 7.1. Acepta cualquier array u objeto que implemente la interfaz Traversable. Estos dos tipos se recorren con foreach y se pueden emplear con yield from dentro de un generador.
//Y finalmente dos tipos especiales:
resource
$NULL = NULL;
/*
Una variable es considerada null si:
    -- se le ha asignado la constante null.
    -- no se le ha asignado un valor todavía.
    -- se ha destruido con unset() --> destruye las variables especificadas.
        unset(mixed $var, mixed $... = ?): void

*/

//LECCIÓN 1 - ARRAYs

$vec = array(1,2,3,4);
$vec2 = ['a,9.0,true,9', 'cadena'];
$arrayVacio1 = array();
$arrayVacio = [];
$vec3 = ['1A' => 'INES',
         '2B' => 'CARLOS',
         '3C' => 'OSCAR'  
];

//lenght --> count
for ($i=0; $i < count ($vec); $i++){ /// recorrer un vector
    echo $vec [$i]. '<br>';
}

//foreach ($variable as $key => $value) {
    # code...
//}

foreach ($vec as $key => $value) { //key es el indice
    echo $key . '->'. $value. '<br>';
}
foreach ($vec3 as $key => $value) { //key es el indice
    echo $key . '->'. $value. '<br>';
}
// SALDRA 1A -> INES
//        2B -> CARLOS
//        3C -> OSCAR  

echo vec3 ['3C']; // SALDRÁ OSCAR

//AÑADIR ELEMENTOS

$vec3 [] = ['4D' => 'JAIME'];
$vec2 [0] = 18; //machaco la posicion 0 y la cambio por 18
$a = 18
unset ($a[1]); /// Destruye una o más variables especificadas

$vec5 = range(1,7); // numeros al azar??
print_r ($vec5);

/*

LISTA ARRAYS
- array_shift: Quita un elemento del principio del array
    -- EJEMPLO:
        <?php
            $vec = array(1,2,3,4,5);
            $fruit = array_shift($vec);
            print_r($vec);
        ?>

    -- SOLUCIÓN
        [0] => 2
        [1] => 3
        [2] => 4
        [3] => 5

- array_pop: Extrae el último elemento del final del array
    -- EJEMPLO:
        <?php
            $stack = array("naranja", "plátano", "manzana", "frambuesa");
            $fruit = array_pop($stack);
            print_r($stack);
        ?>
    -- SOLUCIÓN
        [0] => naranja
        [1] => plátano
        [2] => manzana
- array_push:
    -- EJEMPLO:
        <?php
            $pila = array("naranja", "plátano");
            array_push($pila, "manzana", "arándano");
            print_r($pila);
        ?>
    -- SOLUCIÓN
        [0] => naranja
        [1] => plátano
        [2] => manzana
        [3] => arándano
- explode:
    -- EJEMPLO:
        <?php
            Un string que no contiene el delimitador simplemente
            devolverá un array de longitud uno con el string original.

            $entrada1 = "hola";
            $entrada2 = "hola,qué tal";
            var_dump( explode( ',', $entrada1 ) );
            var_dump( explode( ',', $entrada2 ) );
        ?>
    -- SOLUCIÓN
            [0] => string(4) "hola"

            [0] => string(4) "hola"
            [1] => string(8) "qué tal"

- shuffle: 
    -- EJEMPLO:
        <?php
            $números = range(1, 20);
            shuffle($números);
            foreach ($números as $número) {
                echo "$número ";
            }
        ?>
    -- SOLUCIÓN

- array_diff: Calcula la diferencia entre arrays
    -- EJEMPLO:
        <?php
            $array1    = array("a" => "green", "red", "blue", "red");
            $array2    = array("b" => "green", "yellow", "red");
            $resultado = array_diff($array1, $array2);
            print_r($resultado);
        ?>
    -- SOLUCIÓN
        [1] => blue

- array_values(): Devuelve todos los valores de un array
    -- EJEMPLO:
        <?php
            $array = array("size" => "XL", "color" => "gold");
            print_r(array_values($array));
        ?>

    -- SOLUCIÓN
        [0] => XL
        [1] => gold
- array_count_values — Cuenta todos los valores de un array
    -- EJEMPLO:
        <?php
            $array = array(1, "hello", 1, "world", "hello");
            print_r(array_count_values($array));
        ?>
    -- SOLUCIÓN
        [1] => 2
        [hello] => 2
        [world] => 1
- array_fill:
    -- EJEMPLO:
        <?php
            $a = array_fill(5, 6, 'banana');
            $b = array_fill(-2, 4, 'pear');
            print_r($a);
            print_r($b);
        ?>
    -- SOLUCIÓN
        [5]  => banana
        [6]  => banana
        [7]  => banana
        [8]  => banana
        [9]  => banana
        [10] => banana

        [-2] => pear
        [0] => pear
        [1] => pear
        [2] => pear
        
*/

switch ($quehapasado) {
    case 0:echo 'casi'.'<br>'; 
        break;
    case 1:echo 'has ganado'.'<br>'; 
        break;
    case 2:echo 'ni te has acercado'.'<br>'; 
        //break; no hace falta saltar
    default: echo 'por defecto';// es lo mas correcto
}

//ARRAYS EXPLICADOS

//ARRAY_FILL --> Rellena un array, le tienes que poner el indice, la cantidad de elementos y con que los rellenas
$array = array_fill(0,10,'_');
print_r($array);

//ARRAY_POP --> Sacar los juguetes de una maquina Gacha
$maquinaGacha = array("jugueteRosa", "jugueteRojo", "jugueteVerde");
$jugueteGanado = array_shift($maquinaGacha);
echo 'Queda en la maquina estos juguetes:';
print_r($maquinaGacha);
//Para 'Sacarlos por arriba'
$maquinaGacha = array("jugueteRosa", "jugueteRojo", "jugueteVerde");
$jugueteSacado = array_pop($maquinaGacha);
echo 'Queda en la maquina estos juguetes:';
print_r($maquinaGacha);

//ARRAY_PUSH --> Meter los juguetes de una maquina Gacha
$maquinaGacha = array("jugueteRosa", "jugueteRojo", "jugueteVerde");
array_push($maquinaGacha, "jugueteMarron", "jugueteAmarillo");
echo 'Ahora hay estos juguetes:';
print_r($maquinaGacha);

//ARRAY_SHIFT --> Quita un elemento del principio del array
$maquinaGacha = array("jugueteRosa", "jugueteRojo", "jugueteVerde");
$jugueteGanado = array_shift($maquinaGacha);
echo 'Queda en la maquina estos juguetes:';
print_r($maquinaGacha);

//ARRAY EXPLODE 
// Cadena de ejemplo
$cadena = "La Manzana/Plátano/un kg de Naranjas/Uva";
// Usar explode para dividir la cadena en un array
$frutas = explode("/", $cadena);
//Ahora podemos recorrer los elementos de este array
foreach ($frutas as $fruta) {
    echo $fruta . "<br>";
}
print_r($frutas);

//ARRAY SHUFFLE 
// Imagina que es una baraja de cartas
$baraja = array('3Copas','4Bastos','5Corazones');
// Ahora la barajamos
shuffle($baraja);
print_r($baraja);
?>

