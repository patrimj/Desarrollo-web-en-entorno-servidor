<?php

function comprobarCapicua($v) {
    $devolver = false;
    if ($v == array_reverse($v)) {
        $devolver = true;
    }
    return $devolver;
}