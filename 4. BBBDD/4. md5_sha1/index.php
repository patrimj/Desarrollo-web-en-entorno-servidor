<?php
$clave = "hola";
$claveBD = "4d186321c1a7f0f354b297e8914ab240";
$claveResumida = sha1($clave);
$claveResumida2 = md5($clave);
$claveResumida3 = md5($clave);
echo $claveResumida.'<br>';
echo $claveResumida2.'<br>';
echo $claveResumida3.'<br>';
if (md5($clave)==$claveBD){
    echo 'loginCorrecto';
}