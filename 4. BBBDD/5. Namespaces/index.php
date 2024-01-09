<?php

require 'Persona.php';
require 'Alumno.php';
use Alumno\Persona;

$p = new Persona('DAW2');
// echo $p->nombrePersona;
// echo $p->metodoPersona();
echo $p->nombreAlumno;
echo $p->metodoAlumno();