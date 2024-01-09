<?php
include_once 'Conjunto.php';
include_once 'Factoria.php';
header("Content-Type:application/json");


$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];

$argus = explode("/", $paths);
unset($argus[0]);

if ($requestMethod == 'GET') {
    if (count($argus) == 0) {
        $cod = 401;
        $mssg = 'Faltan argumentos';
        header('HTTP/1.1 ' . $cod . ' ' . $mssg);
        $respuesta = ['Cod' => $cod, 'Mensaje' => $mssg];
        echo json_encode($respuesta);
    } else {
        if (count($argus) > 1) {
            $cod = 402;
            $mssg = 'Sobran argumentos';
            header('HTTP/1.1 ' . $cod . ' ' . $mensaje);

            $respuesta = ['Cod' => $cod, 'Mensaje' => $mssg];
            echo json_encode($respuesta);
        } else {
            $c1 = Factoria::generarConjunto("A",4);
            $c2 = Factoria::generarConjunto("B",6);
            switch ($argus[1]) {
                case "I":
                    //$c3 = Factoria::encontrarElementos($c1->getConjs(), $c2->getConjs());
                    $c3 = $c1->interseccion($c2);
                    $cod = 200;
                    $mssg = "TODO OK";
                    header('HTTP/1.1 ' . $cod . ' ' . $mensaje);
                    $respuesta = ["cod" => $cod,
                                "mssg" => $mssg,
                                "c1" => $c1, 
                                "c2" => $c2, 
                                "c3" => $c3];
                    echo json_encode($respuesta);
                    
                case "U":
                    $c3 = $c1->union($c2);
                    $cod = 200;
                    $mssg = "TODO OK";
                    header('HTTP/1.1 ' . $cod . ' ' . $mensaje);
                    $respuesta = ["cod" => $cod,
                                "mssg" => $mssg,
                                "c1" => $c1, 
                                "c2" => $c2, 
                                "c3" => $c3];
                    echo json_encode($respuesta);
                    
                case "C":
                    $cod = 200;
                    $mssg = "TODO OK";
                    header('HTTP/1.1 ' . $cod . ' ' . $mensaje);
                    $respuesta = ["cod" => $cod,
                                "mssg" => $mssg,
                                "c1" => $c1,
                                "Cantidad elementos:" => $c1->cardinalidad()];
                    echo json_encode($respuesta);   
                    
                default:
                    $cod = 404;
                    $respuesta = ["cod" => $cod,
                                "mssg" => "La letra no es 'I', 'U' ni 'C'."
                                ];
                    header('HTTP/1.1 ' . $cod . ' !=ok');
                    echo json_encode($respuesta);   
            }
            
        }
    }
} else{
    $cod = 404;
    $mssg = 'Verbo no encontrado';
    header('HTTP/1.1 ' . $cod . ' ' . $mensaje);
    $respuesta = ['Cod' => $cod, 'Mensaje' => $mssg];
    echo json_encode($respuesta);
}