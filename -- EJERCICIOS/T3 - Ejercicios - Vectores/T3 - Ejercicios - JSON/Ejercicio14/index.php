<?php
include 'biblioteca.php';
header("Content-Type:application/json");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];

$argus = explode("/", $paths);

unset($argus[0]);
$tablero = [];
switch (count($argus)) {
    case 1:
        //1 argumento -> se usa como posicion en la que da el manotazo
        rellenarTablero($tablero);
        colocarMosca($tablero);
        $resultado = darManotazo($tablero, $argus[1] + 1);
        $cod = 200;
        $mensaje = "Todo OK";
        header('HTTP/1.1 ' . $cod . ' ' . $mensaje);    
        $respuesta = ['Tablero:' => $tablero,
                      'Resultado:'=> $resultado];
    
        echo json_encode($respuesta);
        break;
    case 2: 
        //2 argumentos, 1 posicion que da el manotazo, 2 numero de moscas
        rellenarTablero($tablero);
        colocarMosca_nVeces($tablero, $argus[2]);
        $resultado = darManotazo($tablero, $argus[1] + 1);
        $cod = 200;
        $mensaje = "Todo OK";
        header('HTTP/1.1 ' . $cod . ' ' . $mensaje);    
        $respuesta = ['Tablero:' => $tablero,
                      'Resultado:'=> $resultado];
    
        echo json_encode($respuesta);
        break;
    case 3: 
        //2 argumentos, 1 posicion que da el manotazo, 2 numero de moscas, 3 posiciones del tablero
        rellenarTablero_nPosiciones($tablero, $argus[3]);
        colocarMosca_nVeces($tablero, $argus[2]);
        $resultado = darManotazo($tablero, $argus[1] + 1);
        $cod = 200;
        $mensaje = "Todo OK";
        header('HTTP/1.1 ' . $cod . ' ' . $mensaje);    
        $respuesta = ['Tablero:' => $tablero,
                      'Resultado:'=> $resultado];
    
        echo json_encode($respuesta);
        break;
    default:
        $cod = 404;
        $mensaje = "Todo KO";
        header('HTTP/1.1 ' . $cod . ' ' . $mensaje);    
        $respuesta = ['Tablero:' => $tablero,
                    'Resultado:'=> $resultado];

        echo json_encode($respuesta);
        break;
}





/*
colocarMosca($tablero);
print_r($tablero);
$manotazo = rand(0, count($tablero) - 1);
darManotazo($tablero, $manotazo);
 */
