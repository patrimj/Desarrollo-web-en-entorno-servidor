<?php
header("Content-Type:application/json");

require_once 'Serpiente.php';
require_once 'Factoria.php';
require_once 'Logica.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths =  $_SERVER['REQUEST_URI'];

$argus = explode('/',$paths);
unset($argus[0]);

if ($requestMethod == 'GET') {
  if (empty($argus[1])) {
    $cod = 406;
    $mes = "No hay argumentos";
  }elseif (count($argus) >= 2) {
      $cod = 404;
      $mes = "Demasiados argumentos";
  }else {
      if (count($argus) == 1) {
          $cod = 200;
          $mes = "OK";
          $serpiente = Logica::pasarAniosSerpiente($argus[1]);
          header("HTTP/1.1".$cod.' '.$mes);
          echo json_encode(['cod'=>$cod,
              'message'=>$mes,
              'data'=>$serpiente]);
      }elseif (count($argus) == 2) {
          $cod = 200;
          $mes = "OK";
          $nido = Factoria::crearNido($argus[2]);
          $nido = Logica::pasarAniosNido($nido,$argus[1]);
          
          header("HTTP/1.1".$cod.' '.$mes);
          echo json_encode(['cod'=>$cod,
              'message'=>$mes,
              'data'=>$nido]);
      }
  }
}else {
    $cod = 405;
    $mes = "Metodo no permitido";
    header("HTTP/1.1".$cod.' '.$mes);
    echo json_encode(['error'=>['code'=>$cod,'message'=>$mes]]);
}
