<?php
//Ejercicios tema 4 - Vectores/arrays

// 1) Crea un vector de diez números enteros. Inicialízala todas las casillas a -1. Mostrar el vector resultante. Diséñalo modularmente.

// Función para crear un vector de tamaño n con todos los elementos inicializados a un valor dado
function inicializarVector($tamano, $valorInicial) {
    $vector = array_fill(0, $tamano, $valorInicial);
    return $vector;
}

// Función para mostrar un vector
function mostrarVector($vector) {
    foreach ($vector as $elemento) {
        echo "$elemento ";
    }
    echo "\n";
}

$tamanoVector = 10;
$valorInicial = -1;

$vector = inicializarVector($tamanoVector, $valorInicial);
echo "Vector inicializado con -1: ";
mostrarVector($vector);

// 2) Crea dos vectores; uno que tenga los primeros 10 números pares y otro que tenga los 10 primeros impares. Modularmente.

// Función para generar un vector con los primeros n números pares
function generarPares($n) {
    $vectorPares = [];
    for ($i = 2; $i <= $n * 2; $i += 2) {
        $vectorPares[] = $i;
    }
    return $vectorPares;
}

// Función para generar un vector con los primeros n números impares
function generarImpares($n) {
    $vectorImpares = [];
    for ($i = 1; $i <= $n * 2 - 1; $i += 2) {
        $vectorImpares[] = $i;
    }
    return $vectorImpares;
}

$n = 10;

$vectorPares = generarPares($n);
$vectorImpares = generarImpares($n);

echo "Primeros $n números pares: ";
mostrarVector($vectorPares);

echo "Primeros $n números impares: ";
mostrarVector($vectorImpares);


// 3) Escribe un programa modular que pida diez valores reales y los almacene en un vector. Recórrelo luego para averiguar la media de dichos números.

// Función para calcular la media de los valores en un vector
function calcularMedia($vector) {
    $suma = array_sum($vector);
    $media = $suma / count($vector);
    return $media;
}

// Solicitar al usuario que ingrese diez valores reales y almacenarlos en un vector
$valores = [];
for ($i = 0; $i < 10; $i++) {
    echo "Ingrese el valor $i: ";
    $valor = floatval(readline());
    $valores[] = $valor;
}

$media = calcularMedia($valores);
echo "La media de los valores es: $media\n";

// 4) Crea un programa modular que inicie un vector con diez números aleatorios. Después un módulo me indicará cual es el valor máximo y la posición que ocupa. Caso de haber más de un máximo me debe devolver la posición del último.

// Función para encontrar el valor máximo y su posición en un vector
function encontrarMaximo($vector) {
    $maximo = max($vector);
    $posicion = array_search($maximo, $vector);
    return [$maximo, $posicion];
}

// Función para generar un vector con números aleatorios
function generarVectorAleatorio($tamano, $min, $max) {
    $vector = [];
    for ($i = 0; $i < $tamano; $i++) {
        $vector[] = rand($min, $max);
    }
    return $vector;
}

$tamanoVector = 10;
$minimoValor = 1;
$maximoValor = 100;

$vectorAleatorio = generarVectorAleatorio($tamanoVector, $minimoValor, $maximoValor);
list($maximo, $posicion) = encontrarMaximo($vectorAleatorio);

echo "Vector aleatorio: ";
mostrarVector($vectorAleatorio);
echo "El valor máximo es $maximo y se encuentra en la posición $posicion.\n";

// 5) Diseña un programa que genere un vector con números al azar que oscilan entre [-100 y 100]. Después realiza un módulo que indique cuantos números positivos y cuantos negativos hay.

// Función para contar números positivos y negativos en un vector
function contarPositivosNegativos($vector) {
    $positivos = 0;
    $negativos = 0;

    foreach ($vector as $numero) {
        if ($numero > 0) {
            $positivos++;
        } elseif ($numero < 0) {
            $negativos++;
        }
    }

    return [$positivos, $negativos];
}

// Función para generar un vector con números aleatorios entre -100 y 100
function generarVectorAleatorio($tamano) {
    $vector = [];
    for ($i = 0; $i < $tamano; $i++) {
        $vector[] = rand(-100, 100);
    }
    return $vector;
}

$tamanoVector = 20;

$vectorAleatorio = generarVectorAleatorio($tamanoVector);
list($positivos, $negativos) = contarPositivosNegativos($vectorAleatorio);

echo "Vector aleatorio: ";
mostrarVector($vectorAleatorio);
echo "Números positivos: $positivos\n";
echo "Números negativos: $negativos\n";

// 6) Escribe un programa que inicie un vector con números al azar de 1 a 100. Después crearemos un módulo al que le pasemos un número y me devuelva cuantas veces aparece ese número en el vector.

// Función para contar cuántas veces aparece un número en un vector
function contarApariciones($vector, $numero) {
    $apariciones = 0;
    foreach ($vector as $elemento) {
        if ($elemento == $numero) {
            $apariciones++;
        }
    }
    return $apariciones;
}

// Función para generar un vector con números aleatorios del 1 al 100
function generarVectorAleatorio($tamano) {
    $vector = [];
    for ($i = 0; $i < $tamano; $i++) {
        $vector[] = rand(1, 100);
    }
    return $vector;
}

$tamanoVector = 20;

$vectorAleatorio = generarVectorAleatorio($tamanoVector);

echo "Vector aleatorio: ";
mostrarVector($vectorAleatorio);

echo "Ingrese un número para contar sus apariciones en el vector: ";
$numeroBuscado = intval(readline());

$apariciones = contarApariciones($vectorAleatorio, $numeroBuscado);

echo "El número $numeroBuscado aparece $apariciones veces en el vector.\n";

///otra 
$vec6 = range(1,100);

foreach (range(1, 100) as $número) {
    echo $número;
}
for ($i=0; $i < count ($vec6); $i++){ /// recorrer un vector
    echo $vec6 [$i]. '<br>';
}
// array_count_values — Cuenta todos los valores de un array

$array = array(range(1,100));
print_r(array_count_values($array));

// 7) Repetir el ejercicio anterior pero ahora, después de rellenar el vector, se le pasará un número al módulo y debe devolver la posición de la primera aparición de ese número en el vector; devolverá -1 si ese número no está en el vector.

// Función para encontrar la posición de la primera aparición de un número en un vector
function encontrarPrimeraAparicion($vector, $numero) {
    foreach ($vector as $posicion => $elemento) {
        if ($elemento == $numero) {
            return $posicion;
        }
    }
    return -1; // Si no se encuentra el número en el vector
}

// Función para generar un vector con números aleatorios del 1 al 100
function generarVectorAleatorio($tamano) {
    $vector = [];
    for ($i = 0; $i < $tamano; $i++) {
        $vector[] = rand(1, 100);
    }
    return $vector;
}

$tamanoVector = 20;

$vectorAleatorio = generarVectorAleatorio($tamanoVector);

echo "Vector aleatorio: ";
mostrarVector($vectorAleatorio);

echo "Ingrese un número para encontrar su primera aparición en el vector: ";
$numeroBuscado = intval(readline());

$posicion = encontrarPrimeraAparicion($vectorAleatorio, $numeroBuscado);

if ($posicion != -1) {
    echo "El número $numeroBuscado aparece por primera vez en la posición $posicion del vector.\n";
} else {
    echo "El número $numeroBuscado no se encuentra en el vector.\n";
}

// 8) Dado un array de números de 5 posiciones con los siguiente valores {1,2,3,4,5}, guardar los valores de este array en otro array distinto pero con los valores invertidos, es decir, que el segundo array deberá tener los valores {5,4,3,2,1}.

// Función para invertir un array
function invertirArray($array) {
    return array_reverse($array);
}

$original = [1, 2, 3, 4, 5];
$invertido = invertirArray($original);

echo "Array original: ";
mostrarVector($original);

echo "Array invertido: ";
mostrarVector($invertido);

// 9) Crea una aplicación que pida un numero por teclado y después comprobaremos si el numero introducido es capicúa, es decir, que se lee igual sin importar la dirección. Por ejemplo, si introducimos 30303 es capicúa, si introducimos 30430 no es capicúa. Utiliza vectores para resolver el problema.

// Función para verificar si un número es capicúa
function esCapicua($numero) {
    $numeroStr = strval($numero);
    $reversoStr = strrev($numeroStr);
    return $numeroStr === $reversoStr;
}

echo "Ingrese un número para verificar si es capicúa: ";
$numero = intval(readline());

if (esCapicua($numero)) {
    echo "El número $numero es capicúa.\n";
} else {
    echo "El número $numero no es capicúa.\n";
}

//otra
///para comparar arrays 
$num = 0;

function capicua($num) {
    $digitos = str_split($num);// // Convertir el número en un array de dígitos
    $capi=  array_reverse($digitos); // le da la vuelta
    //print_r ($digitos);
    //print_r ($capi);
    if ($digitos == $capi){ // si son iguales es capicua
        return true; // es capicúa
    }else{
        return false;
    }    
}

if (capicua(1234)){
    echo $num . 'si es capicua';

}else{
    echo $num .'no es capicua';
} 

// 10) Crea un programa que genere una combinación de la lotería primitiva cuidando de no repetir ningún número.

// Función para generar una combinación de lotería primitiva sin números repetidos
function generarCombinacionLoteria() {
    $combinacion = [];
    while (count($combinacion) < 6) {
        $numeroAleatorio = rand(1, 49);
        if (!in_array($numeroAleatorio, $combinacion)) {
            $combinacion[] = $numeroAleatorio;
        }
    }
    sort($combinacion); // Ordenar la combinación en orden ascendente
    return $combinacion;
}

$combinacion = generarCombinacionLoteria();

echo "Combinación de la lotería primitiva: ";
mostrarVector($combinacion);

// 11) Diseña un programa modular que inicie un vector de 20 posiciones con números al azar del 1 al 10. Después pide otro vector de tres posiciones por teclado. Crea un módulo al que le pasemos ambos vectores y nos calcule la posición en la que existe alguna repetición del vector más pequeño en el primero.

// Función para generar un vector con números aleatorios del 1 al 10
function generarVectorAleatorio($tamano) {
    $vector = [];
    for ($i = 0; $i < $tamano; $i++) {
        $vector[] = rand(1, 10);
    }
    return $vector;
}

// Función para encontrar la posición de repetición del vector más pequeño en el vector grande
function encontrarPosicionRepetido($vectorGrande, $vectorPequeno) {
    $tamanoGrande = count($vectorGrande);
    $tamanoPequeno = count($vectorPequeno);

    for ($i = 0; $i <= $tamanoGrande - $tamanoPequeno; $i++) {
        $subvector = array_slice($vectorGrande, $i, $tamanoPequeno);
        if ($subvector == $vectorPequeno) {
            return $i;
        }
    }
    return -1; // Si no se encuentra repetición
}

$tamanoVectorGrande = 20;
$tamanoVectorPequeno = 3;

$vectorGrande = generarVectorAleatorio($tamanoVectorGrande);

echo "Vector grande aleatorio: ";
mostrarVector($vectorGrande);

echo "Ingrese un vector de $tamanoVectorPequeno posiciones separadas por espacios: ";
$entrada = readline();
$vectorPequeno = explode(" ", $entrada);

if (count($vectorPequeno) != $tamanoVectorPequeno) {
    echo "El vector ingresado debe tener $tamanoVectorPequeno posiciones.\n";
} else {
    $posicionRepetido = encontrarPosicionRepetido($vectorGrande, $vectorPequeno);
    if ($posicionRepetido != -1) {
        echo "El vector pequeño se repite en la posición $posicionRepetido del vector grande.\n";
    } else {
        echo "El vector pequeño no se encuentra en el vector grande.\n";
    }
}

// 12) Suma de vectores. Realiza un programa que inicie dos vectores de 3 elementos y los sume en un tercero. Ejemplo: V1: 2 -3 4 V2: 4 9 5 Suma: 6 6 9

// Función para sumar dos vectores
function sumarVectores($vector1, $vector2) {
    $suma = [];
    for ($i = 0; $i < count($vector1); $i++) {
        $suma[] = $vector1[$i] + $vector2[$i];
    }
    return $suma;
}

// Vectores de ejemplo
$vector1 = [2, -3, 4];
$vector2 = [4, 9, 5];

$suma = sumarVectores($vector1, $vector2);

echo "Vector 1: " . implode(" ", $vector1) . "\n";
echo "Vector 2: " . implode(" ", $vector2) . "\n";
echo "Suma: " . implode(" ", $suma) . "\n";

// 13) Iniciar respecto a una posición. Realiza un programa que pida un valor entero, lo coloque en la primera posición de un vector e inicie el resto de elementos sumando uno al anterior. Ejemplo, si introducimos un 9 en la primera posición el resto de componentes quedaría: 9 10 11 12 13 14 15
        //Repite el ejercicio en otro módulo de forma que se inicie el primer elemento y el resto de componentes del vector sean el anterior más el índice actual. Ejemplo, si introducimos un 2 el primero el resto quedaría: 2 3 5 8 12 17 23
 
        // Función para iniciar un vector a partir de un valor y una longitud
        function iniciarVectorDesdeValor($valor, $longitud) {
            $vector = [];
            for ($i = 0; $i < $longitud; $i++) {
                $vector[] = $valor + $i;
            }
            return $vector;
        }
        
        echo "Ingrese un valor entero: ";
        $valorInicial = intval(readline());
        
        echo "Ingrese la longitud del vector: ";
        $longitud = intval(readline());
        
        $vector = iniciarVectorDesdeValor($valorInicial, $longitud);
        
        echo "Vector resultante: " . implode(" ", $vector) . "\n";
      
        
// 14) Donde está la mosca. Vamos a intentar cazar una mosca. La mosca será un valor que se introduce en una posición de un vector; el jugador no ve el panel pero si ve las casillas a las que puede golpear. Si la mosca está en esa posición se acaba el juego, mosca cazada. Si la mosca no está en esa posición pueden ocurrir dos cosas: que la mosca esté en casillas adyacentes en cuyo caso la mosca revolotea y se sitúa en otra casilla o que la mosca no esté en casillas adyacentes, en este caso la mosca permanece donde está.

// Función para jugar al juego de cazar la mosca

function jugarAlJuegoDeLaMosca($longitudVector, $posicionMosca) {
    $vector = array_fill(0, $longitudVector, ' ');
    $vector[$posicionMosca] = 'X';

    while (true) {
        echo "Vector: " . implode(" ", $vector) . "\n";
        echo "Intenta cazar la mosca (introduce la posición): ";
        $posicionIntento = intval(readline());

        if ($posicionIntento < 0 || $posicionIntento >= $longitudVector) {
            echo "Posición fuera de rango. El juego termina.\n";
            break;
        }

        if ($posicionIntento == $posicionMosca) {
            echo "¡Felicidades! Has cazado la mosca.\n";
            break;
        } elseif (abs($posicionIntento - $posicionMosca) <= 1) {
            echo "La mosca ha revoloteado.\n";
            $vector[$posicionMosca] = ' ';
            do {
                $nuevaPosicionMosca = rand(0, $longitudVector - 1);
            } while ($nuevaPosicionMosca == $posicionMosca);
            $posicionMosca = $nuevaPosicionMosca;
            $vector[$posicionMosca] = 'M';
        } else {
            echo "No has cazado la mosca. Sigue intentando.\n";
        }
    }
}

$longitudVector = 10; // Longitud del vector
$posicionMosca = rand(0, $longitudVector - 1); // Posición aleatoria de la mosca

echo "Bienvenido al juego de cazar la mosca.\n";
jugarAlJuegoDeLaMosca($longitudVector, $posicionMosca);

// 15) Juego de las parejas.Realizaremos el juego de las parejas. Se inicia un vector de n casillas (siendo n un número par) y se colocan al azar parejas de números. Ese panel se oculta al jugador al que se le mostrará un panel vacío del que irá destapando de 2 en 2. Si los números destapados coinciden se quedan visibles si no se muestran un segundo y luego se ocultan. El jugador tratará de recordar qué números eran para encontrar a su pareja.

// Función para inicializar el panel con parejas de números aleatorios
function inicializarPanel($tamano) {
    $numeros = range(1, $tamano / 2);
    $parejas = array_merge($numeros, $numeros);
    shuffle($parejas);
    return $parejas;
}

// Función para mostrar el panel
function mostrarPanel($panel, $destapadas) {
    foreach ($panel as $indice => $valor) {
        if (in_array($indice, $destapadas)) {
            echo $valor . " ";
        } else {
            echo "* ";
        }
    }
    echo "\n";
}

// Función para jugar al juego de las parejas
function jugarJuegoDeParejas($tamano) {
    $panel = inicializarPanel($tamano);
    $destapadas = [];
    $parejasEncontradas = 0;
    
    while ($parejasEncontradas < $tamano / 2) {
        mostrarPanel($panel, $destapadas);
        
        echo "Ingresa la posición de la primera carta: ";
        $posicion1 = intval(readline()) - 1;
        echo "Ingresa la posición de la segunda carta: ";
        $posicion2 = intval(readline()) - 1;
        
        if ($posicion1 < 0 || $posicion2 < 0 || $posicion1 >= $tamano || $posicion2 >= $tamano || in_array($posicion1, $destapadas) || in_array($posicion2, $destapadas) || $posicion1 == $posicion2) {
            echo "Movimiento no válido. Intenta de nuevo.\n";
            continue;
        }
        
        if ($panel[$posicion1] == $panel[$posicion2]) {
            echo "¡Encontraste una pareja!\n";
            $destapadas[] = $posicion1;
            $destapadas[] = $posicion2;
            $parejasEncontradas++;
        } else {
            echo "Las cartas no coinciden. Sigue intentando.\n";
            usleep(1000000); // Esperar 1 segundo
        }
        
        if ($parejasEncontradas == $tamano / 2) {
            echo "¡Has encontrado todas las parejas!\n";
        }
    }
}

$tamanoPanel = 8; // Puedes cambiar el tamaño del panel según tus preferencias

echo "Bienvenido al juego de las parejas.\n";
jugarJuegoDeParejas($tamanoPanel);

// 16) El rio y la piedra. Simularemos el lanzamiento de una piedra a un río. Se pedirá al usuario donde quiere lanzar la piedra (posición del vector) y la intensidad de la piedra (un número entero menor o igual que la dimensión máxima del vector). Cuando se lance, se almacena en esa casilla la pedrá y en las adyacentes se irán simulando las ondas con números que se van decrementando. Ejemplo, si damos una pedrá del 4 en la posición 6: 0001234321000 Después, cada segundo, se irá calmando el río restándole uno a las posiciones con número. La simulación se parará cuando el río vuelva a estar en calma; todo a cero.

// Función para simular las ondas en el río
function simularOndas($tamano, $posicionLanzamiento, $intensidad) {
    // Inicializar el río con ceros
    $rio = array_fill(0, $tamano, 0);
    $rio[$posicionLanzamiento] = $intensidad;

    // Mostrar el estado inicial del río
    echo "Estado inicial del río:\n";
    mostrarRio($rio);

    // Simulación de las ondas
    $tiempo = 0;
    while (max($rio) > 0) {
        $nuevoRio = array_fill(0, $tamano, 0);
        
        for ($i = 0; $i < $tamano; $i++) {
            if ($rio[$i] > 0) {
                // Propagar la onda hacia la izquierda
                if ($i > 0) {
                    $nuevoRio[$i - 1] = max($nuevoRio[$i - 1], $rio[$i] - 1);
                }
                // Propagar la onda hacia la derecha
                if ($i < $tamano - 1) {
                    $nuevoRio[$i + 1] = max($nuevoRio[$i + 1], $rio[$i] - 1);
                }
            }
        }

        // Actualizar el estado del río
        $rio = $nuevoRio;
        $tiempo++;

        // Mostrar el estado actual del río
        echo "Segundo $tiempo:\n";
        mostrarRio($rio);
    }

    echo "El río ha vuelto a estar en calma.\n";
}

// Función para mostrar el estado del río
function mostrarRio($rio) {
    foreach ($rio as $intensidad) {
        echo str_pad($intensidad, 3) . " ";
    }
    echo "\n";
}

echo "Simulación del lanzamiento de una piedra en el río.\n";

echo "Ingrese la longitud del río: ";
$tamanoRio = intval(readline());

echo "Ingrese la posición de lanzamiento de la piedra (entre 1 y $tamanoRio): ";
$posicionLanzamiento = intval(readline()) - 1;

echo "Ingrese la intensidad de la piedra (un número entero): ";
$intensidadPiedra = intval(readline());

simularOndas($tamanoRio, $posicionLanzamiento, $intensidadPiedra);

/* 17) Barquitos en rio.
Realiza el juego de los barquitos pero con un vector. Sólo se pondrán submarinos (barcos de una casilla).
El juego consiste en lo siguiente:
- Los paneles serán de 20 posiciones.
- Se pondrán 4 barcos: el ordenador coloca los suyos al azar y el jugador humano
es preguntado. Los barcos no pueden estar colocados de forma adyacente.
- Después, por turnos tira cada uno de los jugadores. El ordenador al azar y el
humano es preguntado.
- El juego termina cuando uno de los dos acaba con la flota del otro.
Lógicamente se llevarán dos paneles para cada jugador: uno para su flota y otro para sus tiradas. Se irá mostrando el de sus tiradas. Al final del juego se muestran todos los paneles.*/

// Función para inicializar el panel con submarinos
function inicializarPanel($tamano, $cantidadSubmarinos) {
    $panel = array_fill(0, $tamano, ' ');
    $colocados = 0;

    while ($colocados < $cantidadSubmarinos) {
        $posicion = rand(0, $tamano - 1);
        if ($panel[$posicion] === ' ') {
            $panel[$posicion] = 'S'; // Submarino
            $colocados++;
        }
    }

    return $panel;
}

// Función para mostrar el panel
function mostrarPanel($panel) {
    foreach ($panel as $casilla) {
        echo $casilla . " ";
    }
    echo "\n";
}

// Función para verificar si un jugador ha ganado
function haGanado($panel) {
    return !in_array('S', $panel); // El jugador gana si no quedan submarinos
}

$tamanoPanel = 20;
$cantidadSubmarinos = 4;

echo "Bienvenido al juego de los barquitos en el río.\n";

// Inicializar los paneles de la computadora y el jugador
$panelComputadora = inicializarPanel($tamanoPanel, $cantidadSubmarinos);
$panelJugador = inicializarPanel($tamanoPanel, $cantidadSubmarinos);

$turnoComputadora = true;

while (true) {
    if ($turnoComputadora) {
        // Turno de la computadora (tira al azar)
        $tiroComputadora = rand(0, $tamanoPanel - 1);
        if ($panelJugador[$tiroComputadora] === 'S') {
            echo "¡La computadora ha hundido uno de tus submarinos!\n";
            $panelJugador[$tiroComputadora] = 'X'; // Submarino hundido
            if (haGanado($panelJugador)) {
                echo "¡Has perdido! La computadora ha hundido todos tus submarinos.\n";
                break;
            }
        } else {
            echo "La computadora ha tirado en la posición $tiroComputadora y ha fallado.\n";
        }
        $turnoComputadora = false;
    } else {
        // Turno del jugador (pregunta al usuario)
        echo "Tu turno. Ingresa la posición donde quieres tirar (0-$tamanoPanel): ";
        $tiroJugador = intval(readline());

        if ($tiroJugador < 0 || $tiroJugador >= $tamanoPanel) {
            echo "Posición fuera de rango. Intenta de nuevo.\n";
            continue;
        }

        if ($panelComputadora[$tiroJugador] === 'S') {
            echo "¡Has hundido uno de los submarinos de la computadora!\n";
            $panelComputadora[$tiroJugador] = 'X'; // Submarino hundido
            if (haGanado($panelComputadora)) {
                echo "¡Felicidades! Has hundido todos los submarinos de la computadora y ganaste el juego.\n";
                break;
            }
        } else {
            echo "Has tirado en la posición $tiroJugador y has fallado.\n";
        }
        $turnoComputadora = true;
    }
}

echo "Panel de la computadora:\n";
mostrarPanel($panelComputadora);

echo "Tu panel:\n";
mostrarPanel($panelJugador);

/* 18) Buscaminas.
Realizaremos el juego del buscaminas con un vector. Para aquellos que no hayan jugado nunca (ni siquiera mientras estoy explicando algo) os recuerdo que el juego consiste en destapar todas las casillas de un vector menos las minas; si pisamos una mina el juego acaba y hemos perdido.
El juego nos proporcionará pistas, de forma que si destapamos una casilla y no hay una mina, esta casilla nos indicará cuantas minas hay adyacentes a esa posición.
Por lo tanto el ordenador debe preparar un panel de 20 casillas para nosotros en el que colocará 6 minas y las pistas correspondientes.
Ejemplo: 01*11**2*1000
Este panel permanecerá oculto y es el jugador el que debe tratar de descubrirlo.*/

// Función para inicializar el panel de buscaminas con minas y pistas
function inicializarBuscaminas($tamano, $cantidadMinas) {
    $panel = array_fill(0, $tamano, 0);

    while ($cantidadMinas > 0) {
        $posicion = rand(0, $tamano - 1);
        if ($panel[$posicion] !== 'M') {
            $panel[$posicion] = 'M'; // Mina
            $cantidadMinas--;
        }
    }

    for ($i = 0; $i < $tamano; $i++) {
        if ($panel[$i] !== 'M') {
            // Contar minas adyacentes
            $minasAdyacentes = 0;
            if ($i > 0 && $panel[$i - 1] === 'M') $minasAdyacentes++;
            if ($i < $tamano - 1 && $panel[$i + 1] === 'M') $minasAdyacentes++;
            $panel[$i] = $minasAdyacentes;
        }
    }

    return $panel;
}

// Función para mostrar el panel de buscaminas
function mostrarBuscaminas($panel) {
    foreach ($panel as $casilla) {
        if ($casilla === 'M') {
            echo "* ";
        } else {
            echo $casilla . " ";
        }
    }
    echo "\n";
}

$tamanoPanel = 20;
$cantidadMinas = 6;

echo "Bienvenido al juego del buscaminas.\n";
echo "El panel contiene minas (representadas por '*') y números que indican la cantidad de minas adyacentes.\n";

$panelBuscaminas = inicializarBuscaminas($tamanoPanel, $cantidadMinas);
$panelVisible = array_fill(0, $tamanoPanel, ' ');

while (true) {
    echo "Panel del buscaminas:\n";
    mostrarBuscaminas($panelVisible);

    echo "Ingrese la posición que desea destapar (0-$tamanoPanel): ";
    $posicion = intval(readline());

    if ($posicion < 0 || $posicion >= $tamanoPanel) {
        echo "Posición fuera de rango. Intenta de nuevo.\n";
        continue;
    }

    if ($panelVisible[$posicion] !== ' ' || $panelVisible[$posicion] === 'F') {
        echo "Ya has destapado esta casilla o la has marcado como bandera (F).\n";
        continue;
    }

    if ($panelBuscaminas[$posicion] === 'M') {
        echo "¡Has encontrado una mina! Game over.\n";
        $panelVisible[$posicion] = 'M'; // Muestra la mina que causó la derrota
        break;
    } else {
        $panelVisible[$posicion] = $panelBuscaminas[$posicion];
    }

    $casillasDestapadas = array_count_values($panelVisible);
    if (isset($casillasDestapadas[' ']) && $casillasDestapadas[' '] == $cantidadMinas) {
        echo "¡Felicidades! Has destapado todas las casillas sin pisar ninguna mina. ¡Ganaste!\n";
        break;
    }
}

echo "Panel del buscaminas:\n";
mostrarBuscaminas($panelBuscaminas);

?>