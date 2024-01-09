<?php
header('Content-Type: application/json');

require_once 'Conjunto.php';
require_once 'Factoria.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == 'GET') {
    
    $cantidadElementosA = 5; 
    $cantidadElementosB = 5; 

    // Creamos los conjuntos a y b con la misma cantidad (podemos modif para que sea diferentes cantidades con rand(1, 5))
    $conjuntoA = Factoria::crearConjunto($cantidadElementosA); // pasara el numero 5
    $conjuntoB = Factoria::crearConjunto($cantidadElementosB);

    //  intersección y  unión usando conj a como base
    $interseccion = $conjuntoA->interseccion($conjuntoA,$conjuntoB);
    $union = $conjuntoA->union($conjuntoA,$conjuntoB);

    // mostramos attay con los resultados
    $resultados = [
        'ConjuntoA' => $conjuntoA->obtenerElementos(),
        'ConjuntoB' => $conjuntoB->obtenerElementos(),
        'Interseccion' => $interseccion->obtenerElementos(),
        'Union' => $union->obtenerElementos(),
    ];

    // Devolver los resultados en formato JSON
    echo json_encode($resultados);
} else {
    // Manejar otros métodos HTTP si es necesario
    echo json_encode(['Mensaje' => 'Verbo no permitido']);
}

/*
SINTAXIS A TENER EN CUENTA
    -> se utiliza en PHP para acceder a los métodos y propiedades de un objeto
    => se utiliza en PHP para asignar un valor a una clave en un arreglo 'ConjuntoA' => es la clave
*/
