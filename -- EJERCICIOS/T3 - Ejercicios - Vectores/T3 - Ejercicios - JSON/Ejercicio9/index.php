<?php
header("Content-Type:application/json");

require 'funciones.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];

$argus = explode("/", $paths);
unset($argus[0]);
if (count($argus) >= 2) {
    $cod = 400;
    $msg = "Demasiados argumentos";
    header('HTTP/1.1 ' . $cod . ' '. $msg);
}else {
    if(empty($argus[1])) {
        $cod = 405;
        $mes = "Necesita 1 argumento";
        header('HTTP/1.1 '.$cod.' '.$mes);
        //c) Enviar la respuesta.
        echo json_encode(['cod' => $cod,
                          'mes' => $mes]);
    }else {
        $cod = 200;
        $msg = "Todo ok";
        header('HTTP/1.1 ' . $cod . ' '. $msg);

        $vector = str_split($argus[1]);
        $esCapicua = comprobarCapicua($vector);
        $respuesta = ['Es capicua?' => $esCapicua, 'Numero' => $vector];
        echo json_encode($respuesta);
    }
}


/*
$esCapicua = comprobarCapicua($vector);
$vector = str_split($numero);

if ($esCapicua) {
    echo 'El numero '. $numero . ' es capicua';
} else {
    echo 'El numero '. $numero . ' no es capicua';
}
 */

