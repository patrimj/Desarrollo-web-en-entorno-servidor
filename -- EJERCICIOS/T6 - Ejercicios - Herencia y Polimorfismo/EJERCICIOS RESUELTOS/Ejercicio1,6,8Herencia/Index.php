<?php
require_once('FactoriaAnimal.php');
require_once('Parque.php');
require_once('Animal.php');
require_once('Perro.php');
require_once('Gato.php');
require_once('Elefante.php');



header("Content-Type:application/json");

$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];

if($requestMethod=='GET'){
    $arraypath= explode('/',$paths);
    if (count($arraypath)==2){
        $consulta=$arraypath[1];
            $duracion=$consulta;
            echo json_encode(simular($duracion));
            $cod = 200;
            header('HTTP/1.1 '.$cod.' '.' OK');

    }else{
            $cod = 406;
            $mes = "FORMAT CONTENT NOT ACCEPTABLE";
            header('HTTP/1.1 '.$cod.' '.$mes);
            echo json_encode(['cod' => $cod,
            'mes' => $mes]);
        }
}else{
    $cod = 405;
    $mes = "Verbo no soportado";
    header('HTTP/1.1 '.$cod.' '.$mes);
    echo json_encode(['cod' => $cod,
                      'mes' => $mes]);
}

function simular($duracion) {
    $seg=0;
    $parque= new Parque(10);
    while ($seg < $duracion) {
      
        if ($seg % 10 === 0) {
            $nuevoAnimal = FactoriaAnimal::crearAnimal();
            $parque->agregarAnimal($nuevoAnimal);
        }

        if ($seg % 2 === 0) {
            $parque->realizarAcciones();
        }

        if ($seg % 15 === 0) {
            $parque->moverAnimales();
        }

        if ($seg % 20 === 0) {
            $parque->abandonarAnimales();
        }
        $seg++; 
    }
    return $parque;
}


