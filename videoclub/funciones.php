<?php
function nombrecliente($conn ,$sesion){
	$select_value="SELECT first_name, last_name FROM customer where customer_id=$sesion";
	$idk3=mysqli_query($conn,$select_value);
	$fila3=mysqli_fetch_assoc($idk3);
	$nombre=$fila3['first_name'];
	$apellido=$fila3['last_name'];
	
	$n=$nombre." ".$apellido;
	return $n;
}

function emailcliente($conn ,$sesion){
	$select_value="SELECT email FROM customer where customer_id=$sesion";
	$idk3=mysqli_query($conn,$select_value);
	$fila3=mysqli_fetch_assoc($idk3);
	$email=$fila3['email'];
	
	return $email;
}

function obtenerPelis($conn) {
	$categorias = array();
	
	$sql = "SELECT film.title FROM inventory, film WHERE inventory.film_id=film.film_id AND quantity>0";
	
	$resultado = mysqli_query($conn, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$categorias[] = $row['title'];
		}
	}
	return $categorias;
}

function obtenerPelisAlq($conn, $sesion) {
	$categorias = array();
	
	$sql = "SELECT film.title FROM inventory, film, rental WHERE inventory.film_id=film.film_id AND inventory.inventory_id=rental.inventory_id AND rental.customer_id='$sesion' AND return_date='0000-00-00 00:00:00';";
	
	$resultado = mysqli_query($conn, $sql);
	if ($resultado) {
		while ($row = mysqli_fetch_assoc($resultado)) {
			$categorias[] = $row['title'];
		}
	}
	return $categorias;
}

?>