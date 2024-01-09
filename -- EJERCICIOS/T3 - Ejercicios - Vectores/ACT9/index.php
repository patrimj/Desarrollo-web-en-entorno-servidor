<?php
require 'funciones.php';

$numero = 1221;

$esCapicua = comprobarCapicua($numero);

if ($esCapicua) {
    echo 'El numero '. $numero . ' es capicua';
} else {
    echo 'El numero '. $numero . ' no es capicua';
}
