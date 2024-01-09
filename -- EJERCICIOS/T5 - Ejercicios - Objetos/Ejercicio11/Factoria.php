<?php
require_once (__DIR__.'/Mina.php');


class Factoria {
    public static function crearEspanol($nombre) {
        return new Espanol($nombre);
    }

    public static function crearBizantino($nombre) {
        return new Bizantinos($nombre);
    }

    public static function crearCuraBizantino($nombre) {
        return new Cura($nombre);
    }

    public static function simular($duracion) {
         // La simulación dura 60 segundos
        $seg = 0;
        $mina = new Mina('ORO', 500);
        $aldeanos = [];
        $civilizaciones = [
            'Españoles' => new Civilizacion('Españoles', 'Isabel I',120),
            'Bizantinos' => new Civilizacion('Bizantinos', 'Constantino',100),
        ];
        $datos = [];// Array para almacenar datos de civilizaciones en formato JSON
    
        while ($seg < $duracion) {
            // Cada segundo: Aldeanos extraen recursos de la mina
            foreach ($aldeanos as $aldeano) {
                $aldeano->trabajar($mina);
            }
    
            // Cada 2 segundos: Nacimiento de aldeanos
            if ($seg % 2 === 0) {
                $aleatorio = rand(1, 10);
                if ($aleatorio <= 4) { // si sale del 1-4 español 40%
                    $nombreEspanol = 'Español' . count($aldeanos);
                    $aldeanos[] = new Espanol($nombreEspanol, 200, 'español');
                } 
                if ($aleatorio >= 5 && $aleatorio<=6) { // si sale del 5-6 bizqntino 20%
                    $nombreBizantino = 'Bizantino' . count($aldeanos);
                    $aldeanos[] = new Bizantinos($nombreBizantino, 250, 'bizantino');
                } 
            }
            foreach ($aldeanos as $aldeano) {
                $mina->extraerItem($aldeano);
            }
    
            // Cada 5 segundos: Ataque del cura bizantino
            if ($seg % 5 === 0) {
                foreach ($aldeanos as $aldeano) {
                    if ($aldeano->getCivilizacion() === 'Españoles'){
                        $aldeano->aBizantino();
                    }
                }
            }    
            $seg++;
        }
    
        $resultados = [
            "mina" => [
                "tipo" => $mina->getTipo(),
                "items de oro" => $mina->getItemsOro(),
                "items de piedra" => $mina->getItemsPiedra()
            ],
            "aldeanos" => [] //// Aquí irán los datos de los aldeanos
        ];
        
        foreach ($aldeanos as $aldeano) {
            $resultados["aldeanos"][] = [
                "nombre" => $aldeano->getNombre(),
                "salud" => $aldeano->getSalud(),
                "civilizacion" => $aldeano->getCivilizacion(),
                "recurso_extraido" => $aldeano->getItemExtraido()
            ];
        }
        $resultados["civilizaciones"] = $datos; // Agregar el array de civilizaciones al resultado
        
        return $resultados;
    }
}

    

