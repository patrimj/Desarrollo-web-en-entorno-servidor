<?php

require_once 'Coche.php';

// Crear un coche
$miCoche = new Coche('Toyota', 'Camry', 'Azul', 'ABC123');

//     b) Arranca.
$miCoche->arrancar();

//     c) Acelera e irá subiendo marchas 
$miCoche->subiendoMarchas();

// hasta llegar a una velocidad que se ha pedido por teclado al usuario.
$miCoche->acelerarHastaVelocidad(100);

//     d) Se mantiene esa velocidad un tiempo que se ha pedido al usuario por teclado.

$miCoche->mantenerVelocidadPorTiempo(10);

//    e) Se va desacelerando y bajando marchas hasta que el coche se pare.
$miCoche->desacelerarHastaParar();
$miCoche->bajandoMarchas();

//    f) Punto muerto y paramos el motor.
$miCoche->puntoMuerto();
$miCoche->pararMotor();


?>