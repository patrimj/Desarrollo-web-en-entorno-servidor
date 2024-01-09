<?php

require 'libreria.php';// si encuentra la libreria bien y sino error
include_once 'libreria.php';// si encuentra la libreria bien y sino va a seguir y una vez

$variable = 12;
$variableboolean = true;
$variabletext = 'hufhf';
$variabledouble = 12.1;
echo gettype($variable); // nos muestra el tipo
echo $variable;

$i=0;
$i++;

if ($i != 10){
}
$cad = 'carlos'.'otra cosa'.$i. '<br>'; //concatenar  
echo $cad;

while ($i = 0){
    echo '*'.'<br>';

}

function loquesea ($argum1){
    return argum1
}
$val = rand(1,3);
// $variable = 12;
// $variable = true;
// $variable = 'akjasldjl';
// //$variable = 7.8;
// // echo gettype($variable);
// // echo $variable;  
// $i=0;
// $i++;
// if ($i!=10){

// }
// $cad = 'carlos '.'otra cosa'.$i.'<br>';
// echo $cad;
// while($i>0){
//     echo '*'.'<br>';
//     $i--;
// }
// for ($i=0; $i < 10 ; $i++) { 
//     echo $i.'<br>';
// }
$valor = 9;
echo $valor.'<br>';
loquesea($valor).'<br>';
echo $valor.'<br>';
?>