<?php
include 'libreria.php';
header("Content-Type:application/json");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];

$argus = explode("/", $paths);
unset($argus[0]);

$rio = [];
rellenarRio($rio);


if (count($argus) == 1 && $argus[1] >= 0 && $argus[1] <= count($rio)) { //ESTA CONDICION FALLA
    darPedrada($rio, $argus[1] - 1);
    $cod = 200;
    $mensaje = "Todo OK";
    header('HTTP/1.1 ' . $cod . ' ' . $mensaje);
    $respuesta = ['Rio:' => $rio];
    echo json_encode($respuesta);
} else {
    if ($argus[1] > count($rio) - 1) {
        $cod = 405;
        $mensaje = "Se salio del rio la piedra";
        header('HTTP/1.1 ' . $cod . ' ' . $mensaje);
        $respuesta = ['Rio:' => $rio];
    echo json_encode($respuesta);
    }else {
        $cod = 404;
        $mensaje = "Demasiados argumentos";
        header('HTTP/1.1 ' . $cod . ' ' . $mensaje);
        $respuesta = ['Rio:' => $rio];
        echo json_encode($respuesta);
    }
}
