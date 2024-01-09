<?php
/*Escribe un programa que inicie un vector con números al azar de 1 a 100. Después
crearemos un módulo al que le pasemos un número y me devuelva cuantas veces
aparece ese número en el vector. */
include 'libreria.php';

//echo rand(5, 15), "\n";
$vector = array();
$vector = rellenarVector($vector);

print_r ($vector);
$n = 7;
echo 'El '. $n . ' se repite ' . vecesRepetidas($vector, $n) . ' veces';
//EXISTE LA FUNCION IN_ARRAY($valor_a_buscar, $array, $comprobartipos = false o = true)