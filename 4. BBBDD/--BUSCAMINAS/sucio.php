<?php

require_once 'Conexion.php';
require_once 'Controlador.php';
require_once 'Constantes.php';

header("Content-Type: application/json");
$method = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];
$datosRecibidos = file_get_contents("php://input");

$argus = explode('/', $paths);
unset($argus[0]);

if ($method === 'GET') {
    if (isset($_GET['tamaño']) && isset($_GET['minas']) && isset($_GET['email']) && isset($_GET['cont'])) {
        $tamaño = $_GET['tamaño'];
        $minas = $_GET['minas'];
        $email = $_GET['email'];
        $contrasena = $_GET['cont'];

        // Verifica si el usuario y las credenciales son correctas
        $resultadoLogin = Controlador::login($email, $contrasena);

        if ($resultadoLogin['cod'] === 200) {
            // Si el usuario existe y las credenciales son válidas, intenta crear una partida
            $resultadoPartida = Controlador::generaPartida($tamaño, $minas, $email, $contrasena);

            if ($resultadoPartida['cod'] === 200) {
                // Devuelve el tablero en JSON
                echo json_encode(['cod' => 200, 'mensaje' => 'Partida creada', 'tablero' => $resultadoPartida['mensaje']]);
            } elseif ($resultadoPartida['cod'] === 204) {
                // Devuelve un mensaje de error indicando que ya existe una partida en curso
                echo json_encode(['cod' => 204, 'mensaje' => 'Ya tienes una partida en curso']);
            } else {
                // Devuelve un mensaje de error genérico
                echo json_encode(['cod' => 500, 'mensaje' => 'Error interno']);
            }
        } else {
            // Devuelve un mensaje de error indicando que las credenciales son incorrectas
            echo json_encode(['cod' => $resultadoLogin['cod'], 'mensaje' => $resultadoLogin['mensaje']]);
        }
    } else {
        // Ruta incorrecta o parámetros faltantes
        echo json_encode(['cod' => 400, 'mensaje' => 'Ruta incorrecta o parámetros faltantes']);
    }
} elseif ($method === 'POST') {
    // Ruta para realizar un movimiento en la partida
    $data = json_decode($datosRecibidos);

    // Verifica si el usuario y las credenciales son correctas
    $resultadoLogin = Controlador::login($data->email, $data->cont);

    if ($resultadoLogin['cod'] === 200) {
        // Si el usuario existe y las credenciales son válidas, intenta realizar un movimiento
        $resultadoMovimiento = Partida::movimiento($data->casilla);

        if ($resultadoMovimiento['cod'] === 200) {
            // Devuelve el resultado del movimiento en JSON
            echo json_encode(['cod' => 200, 'mensaje' => 'Movimiento realizado', 'tablero' => $resultadoMovimiento['mensaje']]);
        } elseif ($resultadoMovimiento['cod'] === 400) {
            // Devuelve un mensaje de error indicando que el movimiento no es válido
            echo json_encode(['cod' => 400, 'mensaje' => 'Movimiento no válido']);
        } else {
            // Devuelve un mensaje de error genérico
            echo json_encode(['cod' => 500, 'mensaje' => 'Error interno']);
        }
    } else {
        // Devuelve un mensaje de error indicando que las credenciales son incorrectas
        echo json_encode(['cod' => $resultadoLogin['cod'], 'mensaje' => $resultadoLogin['mensaje']]);
    }
} else {
    // Método de solicitud no admitido
    echo json_encode(['cod' => 405, 'mensaje' => 'Método de solicitud no admitido']);
}
/*    // Obtén los valores de $tamanio y $minas de la URL si están presentes, de lo contrario, usa valores predeterminados
$tamanio = isset($_GET['tamaño']) ? intval($_GET['tamaño']) : 10;//isset es una función en PHP que se utiliza para comprobar si una variable está definida y no es nula (null).
$minas = isset($_GET['minas']) ? intval($_GET['minas']) : 2; //intval es una función en PHP que se utiliza para convertir una variable en un valor entero (integer).

return new Partida($tamanio, $minas);
}*/
?>
