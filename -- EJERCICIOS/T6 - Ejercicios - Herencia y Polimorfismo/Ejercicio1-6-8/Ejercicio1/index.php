<?php
/*
----EJERCICIO 1----
Vamos a realizar una estructura de clases en la que queden reflejados los dos tipos de animales domésticos principales: perros y gatos.
Todos tendrán un nombre, una raza, un peso y un color. 
En cuanto a métodos tendrán los siguientes: vacunar, comer, dormir, hacerRuido, hacerCaso. 
Los métodos vacunar, comer y dormir son comunes. 
Los métodos hacerRuido y hacerCaso serán sobreescritos en las especializaciones: 
- hacerRuido para los perros será un ladrido 
           y para los gatos un maullido; 
- hacerCaso para los perros será un método boolean que devolverá true 
                el 90% de las veces 
                y para los gatos el 5%. 
Los perros tendrán un método particular: sacarPaseo. 
Los gatos tendrán otro método que será: toserBolaPelo.

----EJERCICIO 6 ----
Sobre el ejercicio de animales domésticos realiza las siguientes variaciones: 
los métodos comer, dormir y hacerRuido. deben ser obligatorios para cualquier nuevo animal doméstico que se añada nuevo. 
Crea la clase Elefante que herede de la anterior y que incluya los métodos obligatorios (el elefante barrita). 
Realiza el ejercicio en los supuestos de que la clase Animal no se instancie nunca y en el supuesto que sí.

----EJERCICIO 8 ----
Pues otra vez con los animales domésticos. Vamos a diseñar una simulación de un parque. 
En este parque, dividido en sectores solo cabe un animal doméstico por sector.
Cada 10 segundos aparece un animal nuevo que se sitúa en una posición libre del parque; si no hubiera el animal se va.
Cada 2 segundos los animales del parque hacen algunas de las acciones habituales: comer, dormir o hacerRuido; al azar.
Cada 15 segundos un animal cambia de posición a otra adyacente. Si no hay hueco libre no se mueve.
Cada 20 segundos alguno de los animales abandona el parque con una probabilidad del 50%.


*/
header("Content-Type:application/json");

require_once (__DIR__.'Animal.php');
require_once (__DIR__.'Gato.php');
require_once (__DIR__ .'Elefante.php');
require_once (__DIR__ .'Perro.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths =  $_SERVER['REQUEST_URI'];

$argus = explode('/',$paths);
unset($argus[0]);

$perro = new Perro("Noa", "Yorshire", 2, "Negro");
$gato = new Gato("Mia", "Siamés", 2, "Blanco");
$elefante = new Elefante("Dumbo", "AAA", 500, "Gris"); // EJERCICIO 6

$perro->vacunar();
$perro->comer();
$perro->hacerRuido();
$perro->sacarPaseo();

    if ($perro->hacerCaso()) {
        echo "{$perro->nombre} hace caso";
    } else {
        echo "{$perro->nombre} no hace caso";
    }


$gato->vacunar();
$gato->comer();
$gato->hacerRuido();
$gato->toserBolaPelo();

    if ($gato->hacerCaso()) {
        echo "{$gato->nombre} hace caso";
    } else {
        echo "{$miGato->nombre} no hace caso";
    }

/*
    EJERCICIO 6
*/

$miElefante->comer();
$miElefante->dormir();
$miElefante->hacerRuido();

if ($requestMethod == 'GET') {
    if (count($argus) == 0) {
        $cod = 401;
        $mssg = 'Faltan argumentos';
        header('HTTP/1.1 ' . $cod . ' ' . $mssg);
        $respuesta = ['Cod' => $cod, 'Mensaje' => $mssg];
        echo json_encode($respuesta);
    } else {
        if (count($argus) > 3) {
            $cod = 402;
            $mssg = 'Sobran argumentos';
            header('HTTP/1.1 ' . $cod . ' ' . $mensaje);

            $respuesta = ['Cod' => $cod, 'Mensaje' => $mssg];
            echo json_encode($respuesta);
        } else {
              
        }
    }
}