<?php
require_once (__DIR__.'/Modelo/Animal.php');
require_once (__DIR__.'/Modelo/Elefante.php');
require_once (__DIR__.'/Modelo/Perro.php');
require_once (__DIR__.'/Modelo/Gato.php');
require_once (__DIR__.'/Modelo/Parque.php');
require_once (__DIR__.'/Auxiliar/Factoria.php');

header("Content-Type:application/json");
$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths =  $_SERVER['REQUEST_URI'];

$argus = explode('/',$paths);
unset($argus[0]);

// $parque = new Parque();
// $parque->introducirAnimal(Factoria::generarPerro());
// $parque->introducirAnimal(Factoria::generarElefante());
// $parque->introducirAnimal(Factoria::generarGato());
// $parque->introducirAnimal(Factoria::generarGato());


// print_r($parque);
if ($requestMethod == 'GET') {
    if (empty($argus[1])) {
      $cod = 406;
      $mes = "No hay argumentos";
    }elseif (count($argus) >= 2) {
        $cod = 404;
        $mes = "Demasiados argumentos";
    }else {
        if (count($argus) == 1) {
            $parque = new Parque();
            for ($segundos=1; $segundos < $argus[1]; $segundos++) {
                if ($segundos % 2 == 0) {
                    $rndm = rand(1,3);
                    switch ($rndm) {
                        case 1:
                            $parque->ruidoAnimales();
                            break;
                        case 2:
                            $parque->comerAnimales();
                            break;

                        case 3:
                            $parque->duermenAnimales();
                            break;
                    }
                    $parque->ruidoAnimales();
                }

                if ($segundos % 10 == 0) {
                    $newAnimal = Factoria::generarAnimalAzar();
                    $parque->introducirAnimal($newAnimal);
                    // $perro = Factoria::generarPerro();
                    // $gato = Factoria::generarGato();
                    // $elefante = Factoria::generarElefante();
                    // $parque->introducirAnimal($perro);
                    // $parque->introducirAnimal($gato);
                    // $parque->introducirAnimal($elefante);

                }

                if ($segundos % 15 == 0) {
                        //cambiar posicion adyacente
                }

                if ($segundos % 20 == 0) {
                    $rndm = rand(0, $parque->cuantos());
                    $parque->eliminarAnimal($rndm);
                }
            }

            $cod = 200;
            $mes = "OK";
            header("HTTP/1.1 ".$cod.' '.$mes);
            $respuesta = ['Cod:' => $cod, 'Mensaje:' => $mes, 'Parque' => $parque];
            echo json_encode($respuesta);
        }
    }
  }else {
      $cod = 405;
      $mes = "Metodo no permitido";
      header("HTTP/1.1".$cod.' '.$mes);
      echo json_encode(['error'=>['code'=>$cod,'message'=>$mes]]);
  }
  
