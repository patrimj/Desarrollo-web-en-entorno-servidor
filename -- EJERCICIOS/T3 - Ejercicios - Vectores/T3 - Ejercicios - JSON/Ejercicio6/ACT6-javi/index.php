<?php
/*Escribe un programa que inicie un vector con números al azar de 1 a 100. Después
crearemos un módulo al que le pasemos un número y me devuelva cuantas veces
aparece ese número en el vector. */
include 'libreria.php';
header("Content-Type:application/json");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];
$argus = explode("/", $paths);
unset($argus[0]);

$vector = array();
$vector = rellenarVector($vector);


//EN MODO SERVICIOS
if (count($argus) >= 2) {
    $cod = 404;
    $mes = "Demasiados argumentos";
    header('HTTP/1.1 '.$cod.' '.$mes);
    //c) Enviar la respuesta.
    echo json_encode(['cod' => $cod,
                        'mes' => $mes]);
} else {
    if (empty($argus[1])) {
        $cod = 405;
        $mes = "Necesita 1 argumento";
        header('HTTP/1.1 '.$cod.' '.$mes);
        //c) Enviar la respuesta.
        echo json_encode(['cod' => $cod,
                            'mes' => $mes]);
    } else {
        $cod = 200;
        $mensaje = "Todo OK";
        header('HTTP/1.1 ' . $cod . ' ' . $mensaje);
        $nrepetido = vecesRepetidas($vector, $argus[1]);
    
        $respuesta = ['Numeros:' => $vector,
                     'Veces repetidas:'=> $nrepetido];
    
        echo json_encode($respuesta);
    }
}