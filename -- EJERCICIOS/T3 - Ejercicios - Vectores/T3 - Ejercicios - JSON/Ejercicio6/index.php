<?php
header("Content-Type:application/json");
$maximo = 10;
$tamVector = 8;


$requestMethod = $_SERVER["REQUEST_METHOD"];
$paths = $_SERVER['REQUEST_URI'];
//declaro el rango del vector
// $vec = range(1,8);
// elimino la primera posicion de los argumentos
$argus = explode("/",$paths);
unset($argus[0]);

//separo los argumentos y los guardo en un array
//selecciono el primer argumento para seleccionar el numero que quiero consultar


$vec = rellenarVector($tamVector,$maximo);

if ($requestMethod == 'GET'){
    if (empty($argus[1])){ //si el numero que se le pasa por argumento es mayor que la suma del vector lanza error o no tiene argumento
        $cod = 406;
        $mes = "No has puesto argumentos";
        header("HTTP/1.1 ".$cod.' '.$mes);
        echo json_encode(['cod' => $cod,
                'mes' => $mes]);
    } elseif ($argus[1] > $maximo) {
        $cod = 406;
        $mes = "El número es mayor que el rango del array";
        header("HTTP/1.1 ".$cod.' '.$mes);
        echo json_encode(['cod' => $cod,
                'mes' => $mes]);
    }else {
        $cod = 200;
        $mes = "Todo ok";
        $cuantos = contRepetidos($vec,$argus[1]);
        header("HTTP/1.1 ".$cod.' '.$mes);
        echo json_encode(['cod' => $cod,
                          'mes' => $mes,
                          'cuantos' => $cuantos,
                          'vector' => $vec]);
    }
}else{
    $cod = 405;
    $mes = "Verbo no soportado";
    header("HTTP/1.1 ".$cod.' '.$mes);
    //c) enviar la respuesta
    echo json_encode(['cod' => $cod,
                      'mes' => $mes]);
};


function rellenarVector($cuantos, $max=10){
    $v=[];
    for ($i=0; $i < $cuantos; $i++) {
        $v[] = rand(1,$max);
    }
    return $v;
}

function contRepetidos($v, $n){
    $res = 0;
    foreach ($v as $value){
        if ($value == $n){
            $res ++;
        }
    }
    return $res;
}
?>