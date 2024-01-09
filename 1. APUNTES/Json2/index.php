<?php 

echo($_SERVER['REQUEST_METHOD']);
echo($_SERVER['REQUEST_URI']);
$datosRecibidos = file_get_contents("php://input");
// print_r($datosRecibidos);
$data = json_decode($datosRecibidos, true);
// print_r($data);
// echo $data['nombre'];
// echo $data['edad'];
// echo $data['matriculado'];
/*
{
  "nombre":"DAW2",
  "edad":12,
  "matriculado":true,
  "modulos":[
    {
      "cod":101,
      "desc":"PROG"
    },
    {
      "cod":202,
      "desc":"ED"
    }
   ]
}
*/
echo $data['nombre'];
echo $data['modulos'][0]['cod'];