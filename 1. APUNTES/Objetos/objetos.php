<?php // index

// su clase es Personaje

require_once ('Personaje.php');
//require_once (__DIR__ .'/Modelo/Personaje.php'); // le añade la ruta absoluta y asi no hay ningun problema con la ruta relativa --> __DIR__ 
require_once (__DIR__ .'Factoria.php');

header("Content-Type:application/json");

//echo 'Aula de los Personajes: ' .Personaje::$AULA.'<br>';
//  $v = [];
//  $v[] = new Personaje('Javi',17);
//  $v[] = new Personaje('Juan',107);
//  foreach ($v as  $value) {
//     echo $value->pasear().'<br>';
//  }

//  $p = new Personaje('Javi',17);
//echo $p.'<br>';
//  $p2 = new Personaje('Juan',107);
//  echo $p->pasear().'<br>';
//  echo $p2->pasear(4).'<br>';

$p = Factoria::generaPersonaje();
$v = Factoria::generaVariosPersonajes();

//c) Enviar la respuesta.
$cod = 200;
header('HTTP/1.1 '.$cod.' Oki');
//  echo json_encode($p, JSON_UNESCAPED_UNICODE);
 echo json_encode($v, JSON_UNESCAPED_UNICODE);

//  echo $p->pelear(12,'hola').'<br>';
//  echo $p.'<br>';
// $p -> setNombre('Ines');
// echo $p.'<br>';
// echo 'La persona' .$p->getNombre().' tiene ' .$p->getEdad().'años <br>';
// echo Personaje::metodoEstatico();




?>