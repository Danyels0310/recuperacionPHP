<html>
    <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>VIDEOCLUB - IES Leonardo Da Vinci - Alquiler Películas</title>
		<link rel="stylesheet" href="bootstrap.min.css">
    </head>
<?php
	if (!isset($_SESSION['usuario'])){
		session_start();
	}
	include 'conectar.php';
	include 'funciones.php';
	if (!isset($_POST) || empty($_POST)) { 
		$sesion=$_SESSION['usuario'];
		$pelis= obtenerPelisAlq($conn, $sesion);
?>	

   
   <body>
    <h1 class="text-center"> VIDEOCLUB IES LEONARDO DA VINCI</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Devolución Alquileres</div>
		<div class="card-body">
		<?php
			if (!isset($_SESSION['usuario'])){
				session_start();
			}
			$sesion=$_SESSION['usuario'];
			echo"<div> <b>Nombre Cliente</b>: ".nombrecliente($conn ,$sesion)."</div>";
			echo"<div> <b>Email Cliente</b>: ".emailcliente($conn ,$sesion)."</div>";
			echo"<div> <b>Número Socio</b>: ".$sesion."</div>";
		?>
	   

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	<label for="pelicula" > Películas alquiladas: </label>
	<select name="rental" class="form-control">
		<?php foreach($pelis as $peli) : ?>
				<option> <?php echo $peli ?> </option>
		<?php endforeach; ?></br>
	</select><br><br>

		<div>
			<input type="submit" value="Devolver Pelicula" name="devolver" class="btn btn-warning disabled">
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='alqwelcome.php'">
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
  </div>
	<?php
	}
	else{;
		$sesion=$_SESSION['usuario'];
		
		$peli=$_POST["rental"];
		$select_value="SELECT film_id FROM film WHERE title='$peli';";
		$idk=mysqli_query($conn,$select_value);
		$fila=mysqli_fetch_assoc($idk);
		$id_peli=$fila['film_id'];
		
		$select_value="SELECT quantity FROM inventory, film WHERE inventory.film_id=film.film_id AND title='$peli';";
		$idk=mysqli_query($conn,$select_value);
		$fila=mysqli_fetch_assoc($idk);
		$cantidad=$fila['quantity'];
		
		$select_value1="SELECT inventory_id FROM inventory WHERE filM_id='$id_peli';";
		$idk=mysqli_query($conn,$select_value1);
		$fila=mysqli_fetch_assoc($idk);
		$id_inventario=$fila['inventory_id'];
		
		$select_value="SELECT rental_id FROM rental WHERE inventory_id='$id_inventario' AND customer_id='$sesion' AND return_date='0000-00-00 00:00:00';";
		$idk=mysqli_query($conn,$select_value);
		$fila=mysqli_fetch_assoc($idk);
		$id_rental=$fila['rental_id'];
		var_dump($select_value, $id_rental);
		
		$dia_devuelve=date('Y-m-d H:n:s');
		
		if(isset($_POST["devolver"])){
			$update_value1="UPDATE rental set return_date='$dia_devuelve' WHERE rental_id='$id_rental';";
			$resultado1=mysqli_query($conn, $update_value1);
			
			$cantidad_acutal=intval($cantidad)+1;
					
			$update_value2="UPDATE inventory SET quantity='$cantidad_acutal' where film_id='$id_peli';";
			$resultado2=mysqli_query($conn, $update_value2);
			
			if ($resultado1 && $resultado2 ){
				echo "<script type='text/javascript'>
				alert('Devolución realizada');
				</script>";
				header("location:alqdev.php");
			}else{
				echo "<script type='text/javascript'>
				alert('Devolución no realizada. intentelo de nuevo');
				</script>";
				header("location:alqdev.php");
			}
		}
	}
	?>
</body>
</html>


