<?php

// importamos las clases
require_once 'Constantes.php';
require_once 'Conexion.php';
require_once 'Persona.php';

header("Content-Type:application/json");

//recogemos los argumentos de la URL
$requestMethod = $_SERVER["REQUEST_METHOD"]; // obtiene el método HTTP de la solicitud (GET, POST, PUT, DELETE).
$paths = $_SERVER['REQUEST_URI']; //obtiene la URL de la solicitud actual

$argus = explode('/', $paths); //divide la URL en fragmentos usando el carácter '/' y se almacena en un arreglo $argus
unset($argus[0]); //Se elimina el primer elemento que es vacío.

// GET, POST, PUT y DELETE

if ($requestMethod == 'GET') {
    if (isset($_GET['dni'])) { // verifica si en la URL se ha proporcionado un parámetro llamado 'dni'. 
        $dni = $_GET['dni']; //Si se proporciona el parámetro 'dni' en la URL, esta línea lo obtiene y lo almacena en la variable $dni.
        $persona = Conexion::obtenerPorDNI($dni);
        if ($persona) {
            echo json_encode($persona);
        } else {
            echo json_encode(['error' => 'Persona no encontrada']);
        }
    } else {
        //  obtener todas las personas
        $personas = Conexion::obtenerTodas();
        echo json_encode($personas);
    }
} elseif ($requestMethod == 'POST') {
    //  insertar una nueva persona
    $data = json_decode(file_get_contents("php://input"), true); //obtener los datos brutos

    if (
        isset($data['dni']) &&
        isset($data['nombre']) &&
        isset($data['clave']) &&
        isset($data['tfno']) //verifica  q se hayan proporcionado todos los datos necesarios para crear una nueva persona
    ) {
        $persona = new Persona($data['dni'], $data['nombre'], $data['clave'], $data['tfno']);
        $resultado = Conexion::insertar($persona);
        if ($resultado) {
            echo json_encode(['msg' => 'Persona insertada correctamente']);
        } else {
            echo json_encode(['error' => 'Error al insertar persona']);
        }
    }    
} elseif ($requestMethod == 'PUT') {
    //  actualizar una persona
    parse_str(file_get_contents("php://input"), $_PUT); // para analizar el contenido del cuerpo de la solicitud
    
    $dni = $_PUT['dni'];
    $nombre = $_PUT['nombre'];
    $clave = $_PUT['clave'];
    $tfno = $_PUT['tfno'];
    $resultado = Conexion::modificar($dni, $nombre, $clave, $tfno);
    if ($resultado) {
        echo json_encode(['msg' => 'Persona actualizada correctamente']);
    } else {
        echo json_encode(['error' => 'Error al actualizar persona']);
    }
} elseif ($requestMethod == 'DELETE') {
    if (isset($argus[1])) {
        $dni = $argus[1];
        $resultado = Conexion::borrar($dni);
        if ($resultado) {
            echo json_encode(['msg' => 'Persona eliminada correctamente']);
        } else {
            echo json_encode(['error' => 'Error al eliminar persona']);
        }
    } else {
        echo json_encode(['error' => 'inserte dni']);
    }
}

/*
En solicitudes HTTP estándar, como GET y POST, los datos enviados por el cliente se encuentran en variables globales predefinidas en PHP:

$_GET: Contiene datos enviados a través del método GET, generalmente desde parámetros de URL.
$_POST: Contiene datos enviados a través del método POST, generalmente desde formularios HTML.

Sin embargo, en el caso de las solicitudes HTTP PUT, los datos no se envían típicamente a través de variables globales predefinidas como $_GET o $_POST. En su lugar, los datos se encuentran en el cuerpo de la solicitud HTTP y deben ser recuperados manualmente.
*/



