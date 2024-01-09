<?php

header('Content-Type:application/json');
/* Crea la clase que almacén la información técnica de un ordenador.
Crea también la clase que permita almacenar la información de todos los ordenadores
almacenados en un aula, así como el nombre del aula y el curso que se imparte en la misma.
Dejo a tu elección los atributos y métodos necesarios. El programa principal debe permitir
gestionar dicha aula. */

require_once 'Aula.php';
require_once 'Ordenador.php';
require_once 'Factoria.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$paths = $_SERVER['REQUEST_URI'];

$args = explode('/', $paths);
unset($args[0]);

if ($requestMethod = 'GET') {
    if (count($args) == 0) {
        $cod = 400;
        $mes = 'No hay argumentos.';
        echo json_encode([
            'Codigo' => $cod,
            'Mensaje' => $mes
            ]);
    } elseif (count($args) > 2) {
        $cod = 400;
        $mes = 'Demasiados argumentos.';
        echo json_encode([
            'Codigo' => $cod,
            'Mensaje' => $mes
            ]);
    } elseif (empty($args[1])) {
        $cod = 400;
        $mes = 'Argumento vacio.';
        echo json_encode([
            'Codigo' => $cod,
            'Mensaje' => $mes
            ]);
    } else {
        $cod = 200;
        $mes = 'OK';

        if (count($args) == 1) {
            $aulas = Factoria::prepararAulas($args[1]);
        } else {
            $aulas = Factoria::prepararAulas($args[1], $args[2]);
        }

        echo json_encode([
            'Codigo' => $cod,
            'Mensaje' => $mes,
            'Aulas' => $aulas,
            ]);
    }
} else {
    $cod = 400;
    $mes = 'Verbo no permitido.';
    echo json_encode([
        'Codigo' => $cod,
        'Mensaje' => $mes
        ]);
}

