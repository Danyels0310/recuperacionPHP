<?php
function nombrecliente($conn ,$sesion){
	$select_value="SELECT nombre, apellido FROM rclientes where idcliente=$sesion";
	$idk3=mysqli_query($conn,$select_value);
	$fila3=mysqli_fetch_assoc($idk3);
	$nombre=$fila3['nombre'];
	$apellido=$fila3['apellido'];
	
	$n=$nombre." ".$apellido;
	return $n;
}

function obtenerCoche($conn) {
	$categorias = array();
	
	$sql = "SELECT matricula, marca, modelo FROM rvehiculos where disponible=1";
	
	$resultado = mysqli_query($conn, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$categorias[] = $row['matricula']."-".$row['marca']."-".$row['modelo'];
		}
	}
	return $categorias;
}

function obtenerCocheAlq($conn, $sesion) {
	$categorias = array();
	
	$sql = "SELECT rvehiculos.matricula, marca, modelo FROM rvehiculos, ralquilar where rvehiculos.matricula=ralquilar.matricula AND idcliente='$sesion' AND disponible=0";
	
	$resultado = mysqli_query($conn, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$categorias[] = $row['matricula']."-".$row['marca']."-".$row['modelo'];
		}
	}
	return $categorias;
}

?>