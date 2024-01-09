<?php
function iniciarTablero($cant){
    $v = array_fill(0,$cant-1,0);
    return $v;
}


function colocarMosca(&$v) {
    $mosca = rand(0,count($v) - 1);
    $v[$mosca] = 1;
}

/**
 * return 0 -> la cazas 
 *        1 -> casi
 *        2 -> ni te acercas
 */
function darManotazo($v, $manotazo) {
    $resultado = '';
    
    if ($v[$manotazo] == 1) {
        $resultado =  0;
    } else {
        if ($v[$manotazo + 1] == 1 || $v[$manotazo - 1] == 1) {
            $resultado = 1;
            shuffle($v);
        } else {
            $resultado = 2;
        }
    } 
    return $resultado;
}
