<?php
//Ejercicios tema 2 - Modular

//  1) Realiza un programa modular que calcule la superficie y el perímetro de un cuadrado cuyo lado pediremos por teclado.


// Definimos una función para calcular la superficie de un cuadrado
function calcularSuperficieCuadrado($lado) {
    $superficie = $lado * $lado;
    return $superficie;
}

// Definimos una función para calcular el perímetro de un cuadrado
function calcularPerimetroCuadrado($lado) {
    $perimetro = 4 * $lado;
    return $perimetro;
}

// Lado del cuadrado (en este caso, un valor fijo)
$ladoDelCuadrado = 5; // Puedes cambiar este valor según tus necesidades

// Calculamos la superficie y el perímetro del cuadrado usando las funciones
$superficie = calcularSuperficieCuadrado($ladoDelCuadrado);
$perimetro = calcularPerimetroCuadrado($ladoDelCuadrado);

// Mostramos los resultados
echo "Superficie del cuadrado: " . $superficie . " unidades cuadradas\n";
echo "Perímetro del cuadrado: " . $perimetro . " unidades\n";

// 2)  Diseña un programa modular que calcule el área y la circunferencia de un círculo cuyo radio se debe preguntar al usuario.

// Función para calcular el área de un círculo
function calcularAreaCirculo($radio) {
    $area = M_PI * pow($radio, 2);
    return $area;
}

// Función para calcular la circunferencia de un círculo
function calcularCircunferenciaCirculo($radio) {
    $circunferencia = 2 * M_PI * $radio;
    return $circunferencia;
}

// Solicitar al usuario que ingrese el radio del círculo
echo "Ingrese el radio del círculo: ";
$radio = floatval(readline()); // Lee el valor del radio desde la entrada estándar

// Calcula el área y la circunferencia utilizando las funciones
$area = calcularAreaCirculo($radio);
$circunferencia = calcularCircunferenciaCirculo($radio);

// Mostrar los resultados
echo "El área del círculo con radio $radio es: " . $area . " unidades cuadradas\n";
echo "La circunferencia del círculo con radio $radio es: " . $circunferencia . " unidades\n";

// 3) Determinar si un número leído por teclado es positivo o negativo mediante un programa modular.

// Función para determinar si un número es positivo o negativo
function determinarPositivoNegativo($numero) {
    if ($numero > 0) {
        return "El número es positivo.";
    } elseif ($numero < 0) {
        return "El número es negativo.";
    } else {
        return "El número es igual a cero.";
    }
}

// Solicitar al usuario que ingrese un número
echo "Ingrese un número: ";
$numero = floatval(readline()); // Lee el número desde la entrada estándar

// Llama a la función para determinar si es positivo o negativo
$resultado = determinarPositivoNegativo($numero);

// Mostrar el resultado
echo $resultado . "\n";

// 4) Calcula la raíz cuadrada de un número que pedimos por teclado, teniendo la precaución de que el número no sea negativo; en este caso se debe informar de que la operación no es posible. Se debe realizar modularmente.

// Función para calcular la raíz cuadrada de un número (con validación)
function calcularRaizCuadrada($numero) {
    if ($numero < 0) {
        return "La operación no es posible. El número es negativo.";
    } else {
        $raiz = sqrt($numero);
        return "La raíz cuadrada de $numero es: " . $raiz;
    }
}

// Solicitar al usuario que ingrese un número
echo "Ingrese un número: ";
$numero = floatval(readline()); // Lee el número desde la entrada estándar

// Llama a la función para calcular la raíz cuadrada
$resultado = calcularRaizCuadrada($numero);

// Mostrar el resultado
echo $resultado . "\n";

// 5) Determinar, modularmente, si un año pedido por teclado es bisiesto o no.

// Función para determinar si un año es bisiesto
function esBisiesto($anio) {
    if (($anio % 4 == 0 && $anio % 100 != 0) || $anio % 400 == 0) {
        return "El año $anio es bisiesto.";
    } else {
        return "El año $anio no es bisiesto.";
    }
}

// Solicitar al usuario que ingrese un año
echo "Ingrese un año: ";
$anio = intval(readline()); // Lee el año desde la entrada estándar

// Llama a la función para determinar si es bisiesto
$resultado = esBisiesto($anio);

// Mostrar el resultado
echo $resultado . "\n";

// 6) Determinar, con un programa modular, si un número real pedido por teclado tiene decimales o no.

// Función para determinar si un número tiene decimales
function tieneDecimales($numero) {
    if ($numero == intval($numero)) {
        return "El número $numero no tiene decimales.";
    } else {
        return "El número $numero tiene decimales.";
    }
}

// Solicitar al usuario que ingrese un número real
echo "Ingrese un número real: ";
$numero = floatval(readline()); // Lee el número desde la entrada estándar

// Llama a la función para determinar si tiene decimales
$resultado = tieneDecimales($numero);

// Mostrar el resultado
echo $resultado . "\n";

//7) Realiza un conversor de grados Centígrados a grados Farenheit. Nuestro algoritmo debe poder hacer la conversión en ambos sentidos. Modularmente.

// Función para convertir grados Celsius a grados Fahrenheit
function celsiusToFahrenheit($celsius) {
    $fahrenheit = ($celsius * 9/5) + 32;
    return $fahrenheit;
}

// Función para convertir grados Fahrenheit a grados Celsius
function fahrenheitToCelsius($fahrenheit) {
    $celsius = ($fahrenheit - 32) * 5/9;
    return $celsius;
}

// Solicitar al usuario que elija la conversión
echo "Seleccione una opción:\n";
echo "1. Celsius a Fahrenheit\n";
echo "2. Fahrenheit a Celsius\n";
$opcion = intval(readline());

// Solicitar al usuario que ingrese la temperatura
echo "Ingrese la temperatura: ";
$temperatura = floatval(readline()); // Lee la temperatura desde la entrada estándar

// Realizar la conversión según la opción seleccionada
if ($opcion === 1) {
    $resultado = celsiusToFahrenheit($temperatura);
    echo "$temperatura grados Celsius son equivalentes a $resultado grados Fahrenheit.\n";
} elseif ($opcion === 2) {
    $resultado = fahrenheitToCelsius($temperatura);
    echo "$temperatura grados Fahrenheit son equivalentes a $resultado grados Celsius.\n";
} else {
    echo "Opción no válida. Por favor, seleccione 1 o 2 para la conversión.\n";
}

//8) Diseña un algoritmo que determine si tres números que pedimos por teclado están ordenados de menor a mayor (NO consiste en ordenar, solo indicar si están ordenados o no). Con un programa modular.

// Función para determinar si tres números están ordenados de menor a mayor
function estanOrdenados($num1, $num2, $num3) {
    return ($num1 <= $num2 && $num2 <= $num3);
}

// Solicitar al usuario que ingrese tres números
echo "Ingrese el primer número: ";
$numero1 = floatval(readline()); // Lee el primer número desde la entrada estándar

echo "Ingrese el segundo número: ";
$numero2 = floatval(readline()); // Lee el segundo número desde la entrada estándar

echo "Ingrese el tercer número: ";
$numero3 = floatval(readline()); // Lee el tercer número desde la entrada estándar

// Llama a la función para determinar si están ordenados
if (estanOrdenados($numero1, $numero2, $numero3)) {
    echo "Los números están ordenados de menor a mayor.\n";
} else {
    echo "Los números no están ordenados de menor a mayor.\n";
}

//9) Con un programa modular, determinar el número de cifras de un número Ejemplos: 9560 debe indicar que tiene 4 cifras; -369 tiene 3 cifras.

// Función para determinar el número de cifras de un número
function contarCifras($numero) {
    // Convierte el número en su valor absoluto para tratar números negativos
    $numero = abs($numero);

    // Convierte el número en una cadena de texto y calcula su longitud
    $numeroStr = strval($numero);
    $numCifras = strlen($numeroStr);

    return $numCifras;
}

// Solicitar al usuario que ingrese un número
echo "Ingrese un número: ";
$numero = intval(readline()); // Lee el número desde la entrada estándar

// Llama a la función para contar las cifras
$numCifras = contarCifras($numero);

// Mostrar el resultado
echo "El número $numero tiene $numCifras cifras.\n";

//10) Los empleados de una fábrica trabajan por turnos: diurno y nocturno. Se debe calcular, modularmente, el jornal diario de acuerdo con los siguientes puntos:
//- La tarifa por horas diurnas es de 20 €.
//- La tarifa por horas nocturnas es de 35 €.
//- Caso de ser domingo, la tarifa se incrementará en 10 € más para el turno diurno y 15 € más para el nocturno.

// Función para calcular el jornal diario
function calcularJornalDiario($horasDiurnas, $horasNocturnas, $esDomingo) {
    $tarifaDiurna = 20;
    $tarifaNocturna = 35;

    // Incrementar la tarifa si es domingo
    if ($esDomingo) {
        $tarifaDiurna += 10;
        $tarifaNocturna += 15;
    }

    $jornalDiurno = $horasDiurnas * $tarifaDiurna;
    $jornalNocturno = $horasNocturnas * $tarifaNocturna;

    $jornalTotal = $jornalDiurno + $jornalNocturno;

    return $jornalTotal;
}

// Solicitar al usuario la cantidad de horas diurnas y nocturnas trabajadas
echo "Ingrese la cantidad de horas diurnas trabajadas: ";
$horasDiurnas = floatval(readline()); // Lee las horas diurnas desde la entrada estándar

echo "Ingrese la cantidad de horas nocturnas trabajadas: ";
$horasNocturnas = floatval(readline()); // Lee las horas nocturnas desde la entrada estándar

// Solicitar al usuario si es domingo
echo "¿Es domingo? (Sí o No): ";
$esDomingo = strtolower(trim(readline())); // Lee la respuesta y la convierte a minúsculas

// Validar la respuesta y calcular el jornal
if ($esDomingo == "si" || $esDomingo == "sí") {
    $esDomingo = true;
} else {
    $esDomingo = false;
}

$jornal = calcularJornalDiario($horasDiurnas, $horasNocturnas, $esDomingo);

// Mostrar el resultado
echo "El jornal diario es de €" . $jornal . "\n";

//11) Calcula modularmente el factorial de un número entero. El factorial es el resultado de multiplicar ese número por todos los números menores que él. Ejemplo: 4! = 4*3*2*1 = 24.

// Función iterativa para calcular el factorial
function calcularFactorial($n) {
    $factorial = 1;
    for ($i = 1; $i <= $n; $i++) {
        $factorial *= $i;
    }
    return $factorial;
}

// Solicitar al usuario que ingrese un número
echo "Ingrese un número entero para calcular su factorial: ";
$numero = intval(readline()); // Lee el número desde la entrada estándar

// Validar que el número sea no negativo
if ($numero < 0) {
    echo "El factorial no está definido para números negativos.\n";
} else {
    // Llama a la función para calcular el factorial
    $factorial = calcularFactorial($numero);
    
    // Mostrar el resultado
    echo "El factorial de $numero es $factorial.\n";
}

//12) Utilizando la función anterior calcula un número combinatorio.

// Función para calcular el número combinatorio C(n, k)
function calcularCombinatorio($n, $k) {
    // Calcula los factoriales necesarios
    $factorialN = calcularFactorial($n);
    $factorialK = calcularFactorial($k);
    $factorialNmenosK = calcularFactorial($n - $k);

    // Calcula el número combinatorio
    $combinatorio = $factorialN / ($factorialK * $factorialNmenosK);

    return $combinatorio;
}

// Solicitar al usuario que ingrese los valores de n y k
echo "Ingrese el valor de n: ";
$n = intval(readline()); // Lee n desde la entrada estándar

echo "Ingrese el valor de k: ";
$k = intval(readline()); // Lee k desde la entrada estándar

// Validar que n y k sean números no negativos y que n sea mayor o igual a k
if ($n >= 0 && $k >= 0 && $n >= $k) {
    // Llama a la función para calcular el número combinatorio
    $combinatorio = calcularCombinatorio($n, $k);
    
    // Mostrar el resultado
    echo "El número combinatorio C($n, $k) es $combinatorio.\n";
} else {
    echo "Los valores ingresados no son válidos. Asegúrese de que n y k sean números no negativos y que n sea mayor o igual a k.\n";
}

//13) Determinar en un programa modular si un número introducido por teclado es primo o no. Un número primo solo es divisible por él mismo y por la unidad.

// Función para verificar si un número es primo
function esPrimo($numero) {
    // Los números menores o iguales a 1 no son primos
    if ($numero <= 1) {
        return false;
    }

    // Comprobar si el número es divisible por algún número entre 2 y su raíz cuadrada
    for ($i = 2; $i <= sqrt($numero); $i++) {
        if ($numero % $i == 0) {
            return false; // El número no es primo
        }
    }

    return true; // El número es primo
}

// Solicitar al usuario que ingrese un número
echo "Ingrese un número entero para verificar si es primo: ";
$numero = intval(readline()); // Lee el número desde la entrada estándar

// Llama a la función para verificar si es primo
if (esPrimo($numero)) {
    echo "$numero es un número primo.\n";
} else {
    echo "$numero no es un número primo.\n";
}

//14) Reutiliza el ejercicio anterior para mostrar los números primos que hay del 1 al 100.

// Función para verificar si un número es primo
function esPrimo($numero) {
    // Los números menores o iguales a 1 no son primos
    if ($numero <= 1) {
        return false;
    }

    // Comprobar si el número es divisible por algún número entre 2 y su raíz cuadrada
    for ($i = 2; $i <= sqrt($numero); $i++) {
        if ($numero % $i == 0) {
            return false; // El número no es primo
        }
    }

    return true; // El número es primo
}

// Mostrar los números primos del 1 al 100
echo "Números primos del 1 al 100:\n";
for ($numero = 1; $numero <= 100; $numero++) {
    if (esPrimo($numero)) {
        echo "$numero ";
    }
}

echo "\n";

//15) Dados dos números enteros, realizar el algoritmo que calcule el cociente y el resto mediante restas sucesivas. Modularmente. Ejemplo: 18 : 4
//Se irá restando 18 – 4 = 14; 14 – 4 = 10; 10 – 4 = 6; 6 – 4 = 2
//hasta que el resultado de la resta (2) es menor que el divisor (4). Por lo tanto el cociente es el número de restas que se han hecho (4) y el resto es el valor de la última resta (2).

// YO
///se definen las variables 
$num1 = 18;
$num2 = 4;

//&$cociente , &$cociente --> es lo que devuelve
//num1 sera el dividendo (18) y num2 el divisor (4)
function sacarCociente($num1, $num2) {//como argumentos para que se los pasen
    $cociente = 0;// a cero pero luego se guardara el resultadp de la division que es el cociente
    while ($num1 >= $num2) { // hasta que el resultado de la resta (2) es menor que el divisor (4).y no se pueda mas dividir
        $num1 = $num1 - $num2;  // Se irá restando 18 – 4 = 14; 14 – 4 = 10; 10 – 4 = 6; 6 – 4 = 2
        $cociente++; // cociente es el número de restas que se han hecho (4)
    }
    return $cociente;
}
$resto = $num1; //y el resto es el valor de la última resta (2).
$cociente = sacarCociente($num1, $num2);// y el cociente sera el resultado de la division

echo "Cociente" . $cociente . "<br>";
echo "Resto" . $resto . "<br>";

//JAVI

require 'libreria.php';
$n1 = 18;
$n2 = 4;
$resultado;

echo sacarCocciente($n1, $n2, $resultado);
echo sacarResto($n1, $n2, $resultado);
echo $n1 . $n2;

//16) Dada una hora por teclado (horas, minutos y segundos) realiza un algoritmo que muestre la hora después de incrementarle un segundo.

require 'libreria.php';
$hora = 12;
$minuto = 59;
$segundo = 59;

sumarSegundo($hora, $minuto, $segundo);
sumarSegundo($hora, $minuto, $segundo);

sumarSegundo($hora, $minuto, $segundo);

sumarSegundo($hora, $minuto, $segundo);

sumarSegundo($hora, $minuto, $segundo);

echo ($hora . 'h '. $minuto. 'm ' . $segundo . 's');

// Solicitar al usuario que ingrese la hora, los minutos y los segundos
echo "Ingrese la hora (0-23): ";
$hora = intval(readline()); // Lee la hora desde la entrada estándar

echo "Ingrese los minutos (0-59): ";
$minuto = intval(readline()); // Lee los minutos desde la entrada estándar

echo "Ingrese los segundos (0-59): ";
$segundo = intval(readline()); // Lee los segundos desde la entrada estándar

// Llama a la función para incrementar la hora en un segundo
list($nuevaHora, $nuevoMinuto, $nuevoSegundo) = incrementarSegundo($hora, $minuto, $segundo);

// Mostrar la nueva hora
echo "La hora después de incrementar un segundo es: $nuevaHora:$nuevoMinuto:$nuevoSegundo\n";

//17) Realiza un algoritmo que resuelva una ecuación de segundo grado. El programa pedirá por teclado los tres coeficientes y mostrará las posibles soluciones: No tiene solución, una única solución (y su valor) o dos soluciones (y sus valores).

// Función para resolver una ecuación cuadrática
function resolverEcuacionCuadratica($a, $b, $c) {
    $discriminante = $b * $b - 4 * $a * $c;
    
    if ($discriminante > 0) {
        $raiz1 = (-$b + sqrt($discriminante)) / (2 * $a);
        $raiz2 = (-$b - sqrt($discriminante)) / (2 * $a);
        return ["dos_soluciones", $raiz1, $raiz2];
    } elseif ($discriminante == 0) {
        $raiz = -$b / (2 * $a);
        return ["una_solucion", $raiz];
    } else {
        return ["sin_solucion"];
    }
}

// Solicitar al usuario que ingrese los coeficientes a, b y c
echo "Ingrese el coeficiente a: ";
$a = floatval(readline());

echo "Ingrese el coeficiente b: ";
$b = floatval(readline());

echo "Ingrese el coeficiente c: ";
$c = floatval(readline());

// Llama a la función para resolver la ecuación cuadrática
$resultado = resolverEcuacionCuadratica($a, $b, $c);

// Mostrar el resultado
if ($resultado[0] == "sin_solucion") {
    echo "La ecuación no tiene solución real.\n";
} elseif ($resultado[0] == "una_solucion") {
    echo "La ecuación tiene una única solución: x = {$resultado[1]}\n";
} elseif ($resultado[0] == "dos_soluciones") {
    echo "La ecuación tiene dos soluciones: x1 = {$resultado[1]}, x2 = {$resultado[2]}\n";
}

//18) Escribe un programa que simule el mecanismo de devolución de monedas de una máquina expendedora. El programa preguntará una cantidad de dinero y calculará la cantidad de monedas necesarias para dar esa cantidad. Por ejemplo, 3,47 € serían 1 moneda de 2€, 1 de 1€, 2 de 20cts, 1 de 5cts y 1 de 2 cts.

// Función para calcular las monedas necesarias para devolver el cambio
function calcularCambio($cantidad) {
    // Definir los valores de las monedas disponibles
    $valoresMonedas = [200, 100, 50, 20, 10, 5, 2, 1];

    // Inicializar un arreglo para contar las monedas de cada valor
    $monedasDevueltas = array_fill(0, count($valoresMonedas), 0);

    // Iterar a través de los valores de las monedas
    for ($i = 0; $i < count($valoresMonedas); $i++) {
        // Calcular la cantidad de monedas de este valor
        $monedasDevueltas[$i] = intval($cantidad / $valoresMonedas[$i]);

        // Actualizar la cantidad para calcular el cambio restante
        $cantidad -= $monedasDevueltas[$i] * $valoresMonedas[$i];
    }

    return $monedasDevueltas;
}

// Solicitar al usuario que ingrese la cantidad de dinero
echo "Ingrese la cantidad de dinero en euros y céntimos (por ejemplo, 3.47): ";
$cantidad = floatval(readline()); // Lee la cantidad desde la entrada estándar

// Llama a la función para calcular el cambio
$monedasDevueltas = calcularCambio($cantidad);

// Mostrar el resultado
echo "Monedas necesarias para devolver el cambio:\n";
for ($i = 0; $i < count($monedasDevueltas); $i++) {
    if ($monedasDevueltas[$i] > 0) {
        $valorMoneda = ($i >= 6) ? ($valoresMonedas[$i] / 100) . "€" : $valoresMonedas[$i] . "cts";
        echo "{$monedasDevueltas[$i]} moneda(s) de $valorMoneda\n";
    }
}

//19) Diseña un programa modular que pregunte al usuario la fecha actual y la fecha de nacimiento de una persona; el programa determinará la edad.

// Función para calcular la edad a partir de la fecha de nacimiento y la fecha actual
function calcularEdad($fechaNacimiento, $fechaActual) {
    // Convierte las fechas a objetos DateTime
    $fechaNacimientoObj = new DateTime($fechaNacimiento);
    $fechaActualObj = new DateTime($fechaActual);

    // Calcula la diferencia entre las fechas
    $diferencia = $fechaNacimientoObj->diff($fechaActualObj);

    // Obtiene el número de años de la diferencia
    $edad = $diferencia->y;

    return $edad;
}

// Solicitar al usuario que ingrese la fecha de nacimiento
echo "Ingrese la fecha de nacimiento (formato: YYYY-MM-DD): ";
$fechaNacimiento = readline(); // Lee la fecha de nacimiento desde la entrada estándar

// Obtener la fecha actual
$fechaActual = date("Y-m-d");

// Llama a la función para calcular la edad
$edad = calcularEdad($fechaNacimiento, $fechaActual);

// Mostrar el resultado
echo "La edad de la persona es $edad años.\n";

//20) Realiza un programa que admita tres números enteros y los devuelva ordenados de menor a mayor.

// Función para ordenar tres números de menor a mayor
function ordenarNumeros($num1, $num2, $num3) {
    $numeros = [$num1, $num2, $num3];
    sort($numeros); // Ordena el arreglo de menor a mayor
    return $numeros;
}

// Solicitar al usuario que ingrese tres números enteros
echo "Ingrese el primer número entero: ";
$numero1 = intval(readline()); // Lee el primer número desde la entrada estándar

echo "Ingrese el segundo número entero: ";
$numero2 = intval(readline()); // Lee el segundo número desde la entrada estándar

echo "Ingrese el tercer número entero: ";
$numero3 = intval(readline()); // Lee el tercer número desde la entrada estándar

// Llama a la función para ordenar los números
$numerosOrdenados = ordenarNumeros($numero1, $numero2, $numero3);

// Mostrar los números ordenados
echo "Los números ordenados de menor a mayor son: ";
foreach ($numerosOrdenados as $numero) {
    echo "$numero ";
}
echo "\n";

//21) Realiza un programa que permita convertir modularmente números binarios en decimales y viceversa.

// Función para convertir un número binario a decimal
function binarioADecimal($binario) {
    $decimal = 0;
    $longitud = strlen($binario);

    for ($i = 0; $i < $longitud; $i++) {
        $bit = $binario[$i];
        if ($bit == '1') {
            $posicion = $longitud - $i - 1;
            $decimal += pow(2, $posicion);
        }
    }

    return $decimal;
}

// Función para convertir un número decimal a binario
function decimalABinario($decimal) {
    $binario = '';

    while ($decimal > 0) {
        $resto = $decimal % 2;
        $binario = $resto . $binario;
        $decimal = intval($decimal / 2);
    }

    return $binario;
}

// Solicitar al usuario la operación a realizar
echo "Elija la operación a realizar:\n";
echo "1. Convertir de binario a decimal\n";
echo "2. Convertir de decimal a binario\n";
$opcion = intval(readline()); // Lee la opción desde la entrada estándar

if ($opcion === 1) {
    // Convertir de binario a decimal
    echo "Ingrese un número binario: ";
    $binario = readline(); // Lee el número binario desde la entrada estándar
    $decimal = binarioADecimal($binario);
    echo "El número decimal equivalente es: $decimal\n";
} elseif ($opcion === 2) {
    // Convertir de decimal a binario
    echo "Ingrese un número decimal: ";
    $decimal = intval(readline()); // Lee el número decimal desde la entrada estándar
    $binario = decimalABinario($decimal);
    echo "El número binario equivalente es: $binario\n";
} else {
    echo "Opción no válida. Por favor, seleccione 1 o 2.\n";
}

//22) Realiza un módulo que me devuelva cuantos dígitos pares y cuantos impares tiene un número. Ejemplo: 234656, devolvería: 4 dígitos pares y 2 impares.

// Función para contar los dígitos pares e impares en un número
function contarDigitosParesImpares($numero) {
    $digitosPares = 0;
    $digitosImpares = 0;

    // Convierte el número en una cadena para procesar cada dígito
    $numeroStr = strval($numero);

    // Itera a través de los dígitos
    for ($i = 0; $i < strlen($numeroStr); $i++) {
        $digito = intval($numeroStr[$i]);

        if ($digito % 2 == 0) {
            $digitosPares++;
        } else {
            $digitosImpares++;
        }
    }

    return [$digitosPares, $digitosImpares];
}

// Solicitar al usuario que ingrese un número
echo "Ingrese un número entero: ";
$numero = intval(readline()); // Lee el número desde la entrada estándar

// Llama a la función para contar los dígitos pares e impares
list($digitosPares, $digitosImpares) = contarDigitosParesImpares($numero);

// Mostrar el resultado
echo "El número tiene $digitosPares dígito(s) par(es) y $digitosImpares dígito(s) impar(es).\n";

//23) Realiza un módulo que me calcule la suma de los dígitos de un número. Reutiliza el módulo para comprobar, de dos números que pedimos por teclado, cual es el que la suma de sus dígitos es mayor.

// Función para calcular la suma de los dígitos de un número
function sumaDigitos($numero) {
    $suma = 0;
    while ($numero > 0) {
        $digito = $numero % 10;
        $suma += $digito;
        $numero = intval($numero / 10);
    }
    return $suma;
}

// Solicitar al usuario que ingrese dos números
echo "Ingrese el primer número: ";
$numero1 = intval(readline()); // Lee el primer número desde la entrada estándar

echo "Ingrese el segundo número: ";
$numero2 = intval(readline()); // Lee el segundo número desde la entrada estándar

// Llama a la función para calcular la suma de los dígitos para ambos números
$sumaDigitosNumero1 = sumaDigitos($numero1);
$sumaDigitosNumero2 = sumaDigitos($numero2);

// Mostrar el resultado de la suma de los dígitos para ambos números
echo "La suma de los dígitos del primer número ($numero1) es: $sumaDigitosNumero1\n";
echo "La suma de los dígitos del segundo número ($numero2) es: $sumaDigitosNumero2\n";

// Comparar las sumas de los dígitos y determinar cuál es mayor
if ($sumaDigitosNumero1 > $sumaDigitosNumero2) {
    echo "El primer número tiene una suma de dígitos mayor.\n";
} elseif ($sumaDigitosNumero1 < $sumaDigitosNumero2) {
    echo "El segundo número tiene una suma de dígitos mayor.\n";
} else {
    echo "Ambos números tienen la misma suma de dígitos.\n";
}

?>