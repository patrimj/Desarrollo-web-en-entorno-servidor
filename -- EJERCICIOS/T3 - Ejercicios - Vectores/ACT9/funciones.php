<?php

function comprobarCapicua($numero) {
    $v = str_split($numero);
    $devolver = false;
    if ($v == array_reverse($v)) {
        $devolver = true;
    }
    return $devolver;
}