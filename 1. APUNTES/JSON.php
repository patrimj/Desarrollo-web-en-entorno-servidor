<?php
//SINTAXIS JSON

//En JSON existen dos tipos de elementos

//- matrices (arrays): Las matrices son listas de valores separados por comas. Las matrices se escriben entre corchetes [ ]
[1, "pepe", 3.14, "Pepito Conejo"]

//- objetos (objects). Los objetos son listas de parejas nombre / valor. El nombre y el valor están separados por dos puntos : y las parejas están separadas por comas. Los objetos se escriben entre llaves { } y los nombres de las parejas se escriben siempre entre comillas dobles.
{"nombre": "Pepito Conejo", "edad": 25, "carnet de conducir": true}

//- Los espacios en blanco y los saltos de línea no son significativos, es decir, puede haber cualquier número de espacios en blanco o saltos de línea separando cualquier elemento o símbolo del documento.

[
  {
    "nombre": "Pepito Conejo",
    "edad": 25,
    "carnet de conducir": true
  },
  {
    "nombre": "Ana Barberá",
    "edad": 90,
    "carnet de conducir": false
  }
]

//api para aprender que es una api https://reqres.in/api/users

/*
JSON (JavaScript Object Notation) es un formato de intercambio de datos ligero y fácil de leer que se utiliza comúnmente 
para transmitir datos entre un servidor y un cliente, así como para el almacenamiento de datos.
En PHP, puedes trabajar con JSON de varias maneras, como la serialización y deserialización de datos JSON.
1) Serialización de datos a JSON:
    Puedes convertir datos PHP en una cadena JSON utilizando la función json_encode(). */
    $data = array(
      'nombre' => 'Juan',
      'edad' => 30,
      'ciudad' => 'Ejemploville'
    );

    $jsonString = json_encode($data);
    echo $jsonString; // El resultado será una cadena JSON que representa los datos en el formato JSON.

/* Uso básico de json_encode():
    -- La función json_encode() se utiliza para convertir datos de PHP en una cadena JSON. */
        $data = array( //array asociativo
        'nombre' => 'Juan',
        'edad' => 30,
        'ciudad' => 'Ejemploville'
        );
            $jsonString = json_encode($data); // json --> {"nombre":"Juan","edad":30,"ciudad":"Ejemploville"}

/* 
2) Deserialización de datos desde JSON: Puedes convertir una cadena JSON en un objeto PHP utilizando la función json_decode()
    -- La función json_decode() convierte la cadena JSON en un objeto o un arreglo asociativo de PHP, dependiendo de cómo lo configures. */
    $jsonString = '{"nombre":"Juan","edad":30,"ciudad":"Ejemploville"}';

    $data = json_decode($jsonString);

    echo $data->nombre; // Imprimirá "Juan"
    echo $data->edad;   // Imprimirá 30
    echo $data->ciudad; // Imprimirá "Ejemploville"

    // cómo crear una API web simple que responde a peticiones GET y proporciona datos en formato JSON

    // a) cabecera devolucion json (se pone 1 vez solo)

    //Esta línea establece la cabecera de respuesta HTTP para indicar que la respuesta se enviará en formato JSON.
    header("Content-Type:application/json");// directiva de php, ya no devuelve texto plano sino Json
    // Esto obtiene el método HTTP utilizado en la solicitud (GET, POST, etc.) y lo almacena en la variable $requestMethod.
    $requestMethod = $_SERVER["REQUEST_METHOD"];// averiguar el verbo
    //Esto obtiene la URI de la solicitud, que contiene los argumentos pasados en la URL, y lo almacena en la variable $paths.
    $paths = $_SERVER['REQUEST_URI']; // averiguar argumentos de la url, los datos
    print_r($paths); // Esta línea imprime la URI de la solicitud en la salida, lo que te permite ver la estructura de la URL.
        //echo $requestMethod . '<br>'; //DEVUELVE --> GET
        //echo $paths. '<br>';//DEVUELVE --> /12/6
        $argus  = explode ("/", $paths); // Divide la URI en partes separadas por "/", creando un array llamado $argus.
        unset($argus [0]); //Elimina el primer elemento del array $argus, que generalmente es una cadena vacía debido a la barra inicial en la URI.
        print_r($argus);
        echo 'has pasasdo'.count($argus). 'argumentos <br>';//Imprime la cantidad de argumentos pasados en la URL.
    
        if (count($argus)>=2){
          $cod = 404;
          $mes = "Demasiados argumentos";
          header('HTTP/1.1 '.$cod.' '.$mes);
          //c) Enviar la respuesta.
          echo json_encode(['cod' => $cod,
                              'mes' => $mes]);
      } else {
          if (empty($argus[1])){
              //Cero argumentos
              $v =   ['1A' => 1,
                      '2B' => 2,
                      3,
                      4];
              $cod = 200;
              $mes = "Todo ok";
              header('HTTP/1.1 '.$cod.' '.$mes);
              //c) Enviar la respuesta.
              echo json_encode($v);
          } else {
              //Un argumento
              $v =   [];
              for ($i=0; $i < $argus[1]; $i++) { 
                  $v[] = rand(1,100);
              }
              $cod = 200;
              $mes = "Todo ok";
              header('HTTP/1.1 '.$cod.' '.$mes);
              //c) Enviar la respuesta.
              echo json_encode($v);
          }
      }
      ///////////////

        //$v= [1,2,3,4]; // tengo un vector y lo quiero devolver en json
        if ($requestMethod=='GET') {//Si el método de solicitud es GET 
            //b) cabecera  devolucion peticion
            $v= [1,2,3,4];// se crea un array con algunos datos
            $cod= 200;///se establece el código de respuesta HTTP 200 (éxito)
            $mes= 'todo ok';
            header('HTTP/1.1 '. $cod.' '.$mes);
            //c) Enviar la respuesta.
            echo json_encode(($v)); //se imprime una respuesta JSON que contiene el array $v.
        }else{
            //b) Cabecera devolución petición.
            $cod= 405;
            $mes= 'verbo no soportado';
            header('HTTP/1.1 '. $cod.' '.$mes);
            //c) Enviar la respuesta.
            echo json_encode(['cod' => $cod,
                              'mes' => $mes ]);
        }
//b) cabecera  devolucion peticion
    $cod= 200;
    $mes= 'todo ok';
    header('HTTP/1.1 '. $cod.' '.$mes);

//c) enviar la respuesta --> de php a json
    echo json_encode(($v));

    //(https://www.php.net/manual/es/function.json-encode.php)
?>
