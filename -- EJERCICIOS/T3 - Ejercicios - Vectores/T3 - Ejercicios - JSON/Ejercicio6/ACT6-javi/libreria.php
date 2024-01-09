<?php

function rellenarVector($v){
    $contador = 0;
    while ($contador < 10) {
        $num_aleatorio = rand(1,2);
        $v[] = $num_aleatorio;
        $contador++;
    }
    return $v;
}

function vecesRepetidas($v, $n) {
    $res = 0;
    foreach ($v as $value) {
        if ($value == $n) {
            $res++;
        }
    }
    return $res;
}
