<?php
include 'biblioteca.php';

$tablero = iniciarTablero(10);
colocarMosca($tablero);
print_r($tablero);
$manotazo = rand(0, count($tablero) - 1);
$qhp = darManotazo($tablero, $manotazo);

switch($qhp){
    case 0: echo 'Has ganado'.'<br>'; 
            break;
    case 1: echo 'Casi'.'<br>';
            break;
    case 2: echo 'Ni te has acercao'.'<br>';
}

