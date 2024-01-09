<?php
// a) cabecera devolucion json (se pone 1 vez solo)
    header("Content-Type:application/json");// directiva de php, ya no devuelve texto plano sino Json
    $requestMethod = $_SERVER["REQUEST_METHOD"];// averiguar el verbo
    $paths = $_SERVER['REQUEST_URI']; // averiguar argumentos de la url, los datos
    print_r($paths);
        //echo $requestMethod . '<br>'; //DEVUELVE --> GET
        //echo $paths. '<br>';//DEVUELVE --> /12/6
        $argus  = explode ("/", $paths);
        unset($argus [0]);
        print_r($argus);
        echo 'has pasasdo'.count($argus). 'argumentos <br>';
    
        if (empty ($argus[1])){
            //cero argumentos
        }else{
            //un argumento
        }

        //$v= [1,2,3,4]; // tengo un vector y lo quiero devolver en json
        if ($requestMethod=='GET') {
            $v= [1,2,3,4];
            $cod= 200;
            $mes= 'todo ok';
            header('HTTP/1.1 '. $cod.' '.$mes);
            echo json_encode(($v));
        }else{
            $cod= 405;
            $mes= 'verbo no soportado';
            header('HTTP/1.1 '. $cod.' '.$mes);
            echo json_encode(['cod' => $cod,
                              'mes' => $mes ]);
        }
//b) cabecera  devolucion peticion
    $cod= 200;
    $mes= 'todo ok';
    header('HTTP/1.1 '. $cod.' '.$mes);

//c) enviar la respuesta --> de php a json
    echo json_encode(($v));

// si esta y si no esta
// el numero que le pasa da el manotazo en el numero y el vector por defecto de 10, no pasarse de 10

// otra maner dos argumentos el num del tamaño y el manotazo, segun la url que le ponga va a responder de diferente manera /20/7
// tercer manera /panel/cantidad de moscas/manotazos

?>

