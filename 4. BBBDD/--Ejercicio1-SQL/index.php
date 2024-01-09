<?php

require_once(__DIR__ . '/Modelo/Persona.php');
require_once('Conexion.php');
require_once('Constantes.php');

header("Content-Type:application/json");
$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths =  $_SERVER['REQUEST_URI'];
$datosRecibidos = file_get_contents("php://input");

$argus = explode('/', $paths);
unset($argus[0]);


//GET, sin argumentos.
if ($requestMethod == 'GET') {
    if ($argus[1] == '') {
        Controlador::getTodas();
    } else {
        if (count($argus) > 1) {
            //GET, con un argumento.
            $cod = 401;
            $mes = "Sobran argumentos";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
            ];
            echo json_encode($respuesta);
        } else {
            //GET con una persona.
            Controlador::getPersona($argus[1]);
        }
    }
}

if ($requestMethod == 'POST') {
        if ($argus[1] == '') {
            //POST, registro de una persona.
            $data = json_decode($datosRecibidos, true);
            Controlador::insertarPersona(new Persona($data['dni'],$data['nombre'],$data['clave'],$data['tfno']));
        }

if ($requestMethod == 'DELETE') {
            if (count($argus) > 1) {
                $cod = 401;
                $mes = "Sobran argumentos";
                header(Constantes::$headerMssg . $cod . ' ' . $mes);
                $respuesta = [
                    'Cod:' => $cod,
                    'Mensaje:' => $mes,
                ];
                echo json_encode($respuesta);
            } else {
                if ($argus[1] != '') {
                    $resultado = Conexion::borrarPersona($argus[1]);
                    $cod = 201;
                    $mes = "Todo OK";
                    header(Constantes::$headerMssg . $cod . ' ' . $mes);
                    $respuesta = [
                        'Cod:' => $cod,
                        'Mensaje:' => $mes,
                        'Delete' => $resultado
                    ];
                    echo json_encode($respuesta);
                } else {
                    $cod = 401;
                    $mes = "Hacen falta argumentos";
                    header(Constantes::$headerMssg . $cod . ' ' . $mes);
                    $respuesta = [
                        'Cod:' => $cod,
                        'Mensaje:' => $mes,
                    ];
                }
            }
        } else {
            if ($requestMethod == 'PUT') {
                $resultado = Conexion::modificarPersona($argus[1], $data);
                $cod = 201;
                $mes = "Todo OK";
                header(Constantes::$headerMssg . $cod . ' ' . $mes);
                $respuesta = [
                    'Cod:' => $cod,
                    'Mensaje:' => $mes,
                    'Modificacion:' => $resultado
                ];
                echo json_encode($respuesta);
            }
        }
    }

