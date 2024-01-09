<?php

function rellenarRio(&$v) {
    $v = array_fill(0,10,0);
}

function darPedrada(&$v, $posPedrada) {
    $valor = 4;
    
    for ($i = $posPedrada; $i >= 0 && $valor >= 1; $i--) {
        $v[$i] = $valor;
        $valor--;
    }
    
    $valor = 3;
    
    for ($i = $posPedrada + 1; $i < count($v) && $valor >= 1; $i++) {
        $v[$i] = $valor;
        $valor--;
    }


}