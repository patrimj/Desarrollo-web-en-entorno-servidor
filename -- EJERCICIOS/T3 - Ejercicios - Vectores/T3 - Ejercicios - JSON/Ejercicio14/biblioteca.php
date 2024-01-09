<?php
function colocarMosca(&$v) {
    $mosca = rand(0,count($v) - 1);
    $v[$mosca] = 1;
}

function rellenarTablero(&$tablero) {
    $tablero = array_fill(0,10,0);
}

function darManotazo($v, $manotazo) {
    $resultado = 0;
    /**
     * Return 0 -> Has ganado
     *        1 -> La mosca salio volando
     *        2 -> Sigue intentandolo
     */
    if ($v[$manotazo] == 1) {
        $resultado =  0;
    } else {
        if ($v[$manotazo + 1] == 1 || $v[$manotazo - 1] == 1) {
            $resultado = 1;
            colocarMosca($v);
        } else {
            $resultado = 2;
        }
    } 
    return $resultado;
}

function colocarMosca_nVeces(&$v, $nMoscas) {
    $i = 0;
    while ($i < $nMoscas) {
        $mosca = rand(0,count($v) - 1);
        if ($v[$mosca] == 1) {
            $mosca = rand(0,count($v) - 1);
        }else {
            $v[$mosca] = 1;
            $i++;
        }
    }
}

function rellenarTablero_nPosiciones(&$v, $nPosiciones) {
    $v = array_fill(0,$nPosiciones, 0);
}