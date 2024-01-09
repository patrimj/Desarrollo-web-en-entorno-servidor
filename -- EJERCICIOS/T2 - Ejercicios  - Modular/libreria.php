<?php
//EJERCICIO 15
function sacarCocciente($n1, $n2, $resultado) {
    $resultado = $n1 - $n2;
    $contador = 0;
    while ($resultado >= $n2) {
        $resultado = $n1 - $n2;
        $n1 = $resultado;
        $contador++;
        }
        return $contador;

    }
    function sacarResto($n1, $n2, $resultado) {
        $resultado = $n1 - $n2;
        while ($resultado >= $n2) {
            $resultado = $n1 - $n2;
            $n1 = $resultado;
            }
            return $resultado;
    }

//EJERCICIO 16
function sumarSegundo (&$hora, &$minuto, &$segundo) {
    $segundo++;
    if ($segundo == 60) {
        $segundo = 0;
        $minuto++;
        if ($minuto == 60) {
            $minuto = 0;
            $hora++;
            if ($hora == 24) {
                $hora = 0;
            }
        }
    }
}