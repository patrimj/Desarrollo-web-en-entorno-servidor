<?php

function rellenarVector($v){
    $contador = 0;
    while ($contador < 10) {
        $v[] = rand(1,100);
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
?>