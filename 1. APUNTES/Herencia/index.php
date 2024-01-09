<?php 
require_once (__DIR__.'/Modelo/Personaje.php');
require_once (__DIR__ .'/Auxiliar/Factoria.php');
require_once (__DIR__ .'/Modelo/Elfo.php');

// header("Content-Type:application/json");



//  echo 'Aula de los personajes: '.Personaje::$AULA.'<br>';
//  $v = [];
//  $v[] = new Personaje('Javi',17);
//  $v[] = new Personaje('Juan',107);
//  foreach ($v as  $value) {
//     echo $value->pasear().'<br>';
//  }


//  $p = new Personaje('Javi',17);
//  $p2 = new Personaje('Juan',107);
//  echo $p->pasear().'<br>';
//  echo $p2->pasear(4).'<br>';

$p = Factoria::generaPersonaje();

//c) Enviar la respuesta.
// $cod = 200;
// header('HTTP/1.1 '.$cod.' Oki');
//  echo json_encode($p, JSON_UNESCAPED_UNICODE);
//  echo json_encode($v, JSON_UNESCAPED_UNICODE);


//  echo $p->pelear(12,'hola').'<br>';
//  echo $p.'<br>';
//  $p->setNombre('Inés');
//  echo $p.'<br>';
//  echo 'La persona: '.$p->getNombre().' tiene '.$p->getEdad().' años<br>';
//  echo Personaje::metodoEstatico();

// $e = Factoria::generaElfo();
// echo $e;

$v = Factoria::generaVariosPersonajes();
foreach ($v as $value) {
    echo $value.'<br>';
    if ($value instanceof Elfo){
        echo $value->lanzarFlechas();
    }
    else {
        echo 'Soy mindundi'.'<br>'; //casting  -- casteo.
    }
    // echo $value->pelear().'<br>';
}
// JSON DE SERPIENTE

if ($requestMethod == 'GET') {
    if (count($argus) == 0) {
        $cod = 401;
        $mssg = 'Faltan argumentos';
        header('HTTP/1.1 ' . $cod . ' ' . $mssg);
        $respuesta = ['Cod' => $cod, 'Mensaje' => $mssg];
        echo json_encode($respuesta);
    } else {
        if (count($argus) > 1) {
            $cod = 402;
            $mssg = 'Sobran argumentos';
            header('HTTP/1.1 ' . $cod . ' ' . $mensaje);

            $respuesta = ['Cod' => $cod, 'Mensaje' => $mssg];
            echo json_encode($respuesta);
        } else {
            $c1 = Factoria::generarConjunto("A",4);
            $c2 = Factoria::generarConjunto("B",6);
            switch ($argus[1]) {
                case "I":
                    //$c3 = Factoria::encontrarElementos($c1->getConjs(), $c2->getConjs());
                    $c3 = $c1->interseccion($c2);
                    $cod = 200;
                    $mssg = "TODO OK";
                    header('HTTP/1.1 ' . $cod . ' ' . $mensaje);
                    $respuesta = ["cod" => $cod,
                                "mssg" => $mssg,
                                "c1" => $c1, 
                                "c2" => $c2, 
                                "c3" => $c3];
                    echo json_encode($respuesta);
                    
                case "U":
                    $c3 = $c1->union($c2);
                    $cod = 200;
                    $mssg = "TODO OK";
                    header('HTTP/1.1 ' . $cod . ' ' . $mensaje);
                    $respuesta = ["cod" => $cod,
                                "mssg" => $mssg,
                                "c1" => $c1, 
                                "c2" => $c2, 
                                "c3" => $c3];
                    echo json_encode($respuesta);
                    
                case "C":
                    $cod = 200;
                    $mssg = "TODO OK";
                    header('HTTP/1.1 ' . $cod . ' ' . $mensaje);
                    $respuesta = ["cod" => $cod,
                                "mssg" => $mssg,
                                "c1" => $c1,
                                "Cantidad elementos:" => $c1->cardinalidad()];
                    echo json_encode($respuesta);   
                    
                default:
                    $cod = 404;
                    $respuesta = ["cod" => $cod,
                                "mssg" => "La letra no es 'I', 'U' ni 'C'."
                                ];
                    header('HTTP/1.1 ' . $cod . ' !=ok');
                    echo json_encode($respuesta);   
            }
            
        }
    }
} else{
    $cod = 404;
    $mssg = 'Verbo no encontrado';
    header('HTTP/1.1 ' . $cod . ' ' . $mensaje);
    $respuesta = ['Cod' => $cod, 'Mensaje' => $mssg];
    echo json_encode($respuesta);
}
// matrices
//obtener json
