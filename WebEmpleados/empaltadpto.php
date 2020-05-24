<?php
include('conectar.php');

	$cod=CrearCodDep($conn);		
	//var_dump($_REQUEST["nombre"]);
	$nombre=$_POST["nombre"];

	$insert_value="INSERT INTO departamento (cod_dpto, nombre_dpto) VALUES ('$cod', '$nombre');";
	$conn->query($insert_value);
    echo "New record created successfully";

function CrearCodDep($conn){
$resultMAX="select max(cod_dpto) from departamento";
$cod_depart = $conn->query($resultMAX);
$cod_departAUX=""; 
if ($cod_depart->num_rows>0){
	while($row =$cod_depart-> fetch_assoc()){
	$cod_departNUM=substr($row ["max(cod_dpto)"],1);
	settype($cod_departNUM, 'integer');
	$cod_departNUM=$cod_departNUM+1;
	$cod_departNUM=str_pad($cod_departNUM,3,0,STR_PAD_LEFT);
	$cod_departAUX="D".$cod_departNUM;
	}
	}else{$cod_departAUX="D001";}
return $cod_departAUX;
}

?>