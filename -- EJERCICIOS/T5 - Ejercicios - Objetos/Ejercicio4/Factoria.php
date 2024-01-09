<?php

require_once 'Aula.php';
require_once 'Ordenador.php';

class Factoria
{
    private static $procesadores = ['AMD', 'Intel'];
    private static $graficas = ['AMD', 'Nvidia', 'Intel'];
    private static $memorias = ['2GB', '4GB', '8GB'];
    private static $placas = ['Asus', 'MSI', 'Gigabyte'];
    private static $fuentes = ['Bronze', 'Silver', 'Gold'];

    private static $numeros = [200, 201, 202, 203, 204, 205, 206];
    private static $ciclos = ['DAM', 'DAW', 'ASIR'];
    private static $cursos = ['1º', '2º'];

    public static function montarOrdenador()
    {
        $procesador = self::$procesadores[rand(0, count(self::$procesadores) - 1)];
        $grafica = self::$graficas[rand(0, count(self::$graficas) - 1)];
        $memoria = self::$memorias[rand(0, count(self::$memorias) - 1)];
        $placa = self::$placas[rand(0, count(self::$placas) - 1)];
        $fuente = self::$fuentes[rand(0, count(self::$fuentes) - 1)];

        return new Ordenador($procesador, $grafica, $memoria, $placa, $fuente);
    }

    public static function montarOrdenadores($cantidad = 2)
    {
        $ordenadores = [];
        for ($i = 0; $i < $cantidad; ++$i) {
            $ordenadores[] = self::montarOrdenador();
        }

        return $ordenadores;
    }

    public static function prepararAula($cant = 1)
    {
        $numero = self::$numeros[rand(0, count(self::$numeros) - 1)];
        $curso = self::$cursos[rand(0, 1)].' '.self::$ciclos[rand(0, count(self::$ciclos) - 1)];
        //$ordenadores = self::montarOrdenadores($cant);
        $a = new Aula($numero, $curso);
        for ($i=1; $i <= $cant; $i++) { 
            $a->addOrdenador(self::montarOrdenador());
        }
        return $a;
    }

    public static function prepararAulas($cantidadAula, $cantOrds = 1)
    {
        $aulas = [];
        for ($i = 0; $i < $cantidadAula; ++$i) {
            $aulas[] = self::prepararAula($cantOrds);
        }

        return $aulas;
    }
}
