<?php
//Todas las variables del formulario r23_alta
$dni=$_POST['DNI'];
$nombre=$_POST['NOMBRE'];
$apellido1=$_POST['APELLIDO1']; 
$apellido2=$_POST['APELLIDO2'];
$curso=$_POST['CURSOACADEMICO'];//date('Y')
$daw=$_POST['DAW'];
$dwes=$_POST['DWES'];
$di=$_POST['DI'];
$dwec=$_POST['DWEC'];
$ingles=$_POST['INGLES'];
$fol=$_POST['FOL'];
$fct=$_POST['FCT'];
$proyecto=$_POST['PROYECTO'];
//Ahora voy a crear un documento que guarde los datos
$F = fopen ('Alumnos.txt','a+'); 
fwrite ($F, $dni."-".$nombre."-".$apellido1."-".$apellido2."-".$curso."-".$daw."-".$dwes."-".$di."-".$dwec."-".$ingles."-".$fol."-".$fct."-".$proyecto."\n");
fclose($F);
?>