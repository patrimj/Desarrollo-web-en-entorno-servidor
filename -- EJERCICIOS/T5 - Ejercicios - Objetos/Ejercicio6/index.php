<?php
require_once 'Serpiente.php';
require_once 'Anillas.php';
require_once 'Nido.php';
require_once 'Factoria.php';

// Crear un nido
$nido = Factoria::crearNido();

// Simular la vida del nido durante 5 minutos (300 segundos)
$nido->simularVida(300);

// Mostrar el estado final del nido
$serpientes = $nido->obtenerSerpientes();
$estadoNido = [];

foreach ($serpientes as $serpiente) {
    $anillas = [];
    foreach ($serpiente->getAnillas() as $anilla) {
        $anillas[] = $anilla->getColor();
    }

    $estadoNido[] = [
        'Color' => $serpiente->getColor(),
        'Edad' => $serpiente->getEdad(),
        'Anillas' => $anillas,
        'Estado' => $serpiente->estaMuerta() ? 'Muerta' : 'Viva',
    ];
}

echo json_encode(['Nido' => $estadoNido]);
