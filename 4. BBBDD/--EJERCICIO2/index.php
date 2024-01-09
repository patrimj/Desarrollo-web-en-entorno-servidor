<?php

require_once 'Constantes.php';
require_once 'Conexion.php';
require_once 'Partida.php';
require_once 'Controlador.php';

header("Content-Type: application/json");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == 'POST') {
    // Manejar solicitud POST para crear una nueva partida
    // Obtener el tamaño y la cantidad de minas desde el cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    $tamanio = $data['tamanio'] ?? 10;
    $minas = $data['minas'] ?? 2;

    Controlador::nuevaPartida($tamanio, $minas);
} elseif ($requestMethod == 'GET') {
    // Manejar solicitud GET para obtener el progreso de la partida
    // Obtener el ID de la partida desde la URL
    $partidaId = $_GET['partida_id'] ?? null;

    if ($partidaId) {
        Controlador::obtenerProgreso($partidaId);
    } else {
        echo json_encode(['error' => 'ID de partida no proporcionado']);
    }
} elseif ($requestMethod == 'PUT') {
    // Manejar solicitud PUT para realizar un movimiento en la partida
    // Obtener el ID de la partida y el índice desde la URL
    $partidaId = $_GET['partida_id'] ?? null;
    $indice = $_GET['indice'] ?? null;

    if ($partidaId && $indice !== null) {
        Controlador::realizarMovimiento($partidaId, $indice);
    } else {
        echo json_encode(['error' => 'ID de partida o índice no proporcionados']);
    }
} elseif ($requestMethod == 'DELETE') {
    // Manejar solicitud DELETE para finalizar la partida
    // Obtener el ID de la partida desde la URL
    $partidaId = $_GET['partida_id'] ?? null;

    if ($partidaId) {
        // Obtener el resultado de la partida (puede ser victoria, derrota o rendición)
        $resultado = $_GET['resultado'] ?? 'Rendición';

        Controlador::finalizarPartida($partidaId, $resultado);
    } else {
        echo json_encode(['error' => 'ID de partida no proporcionado']);
    }
}

