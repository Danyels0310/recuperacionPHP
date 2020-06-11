<html>
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VIDEOCLUB - IES Leonardo Da Vinci - Alquiler Películas</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    </head>
<?php
	include 'conectar.php';
	include 'funciones.php';
	if (!isset($_POST) || empty($_POST)) { 
		$pelis= obtenerPelis($conn);
	
?>	  

   
   <body>
    <h1 class="text-center"> VIDEOCLUB IES LEONARDO DA VINCI</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Alquiler Películas</div>
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
		
		<label for="pelicula">Selecciona pelicula: </label>
		<select name="pelicula" class="form-control">
			<?php foreach($pelis as $peli) : ?>
				<option> <?php echo $peli ?> </option>
			<?php endforeach; ?></br>
		</select><br><br>
			
		<div>
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Realizar Alquiler" name="alquilar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='alqwelcome.php'">
		</div>	
	<?php
	}else{
	$peli=$_POST["pelicula"];
	$select_value="SELECT film_id FROM film WHERE title='$peli';";
	$idk=mysqli_query($conn,$select_value);
	$fila=mysqli_fetch_assoc($idk);
	$id_peli=$fila['film_id'];
	
	$select_value="SELECT quantity FROM inventory, film WHERE inventory.film_id=film.film_id AND title='$peli';";
	$idk=mysqli_query($conn,$select_value);
	$fila=mysqli_fetch_assoc($idk);
	$cantidad=$fila['quantity'];
	
	session_start();
		if (isset($_POST["agregar"])){
			header("location:alqpel.php");
			$pedido=array();
    
			if (!isset($_COOKIE[$_SESSION['usuario']])) {
				setcookie($_SESSION['usuario'], serialize($pedido), time()+3600);
			}else {
				$pedido = unserialize($_COOKIE[$_SESSION['usuario']]);
			}
			array_push($pedido, $peli);
			setcookie($_SESSION['usuario'], serialize($pedido));
			
			$cantidad_acutal=intval($cantidad)-1;
			
			$update_value="UPDATE inventory SET quantity='$cantidad_acutal' where film_id='$id_peli';";
			$resultado=mysqli_query($conn, $update_value);
			if ($resultado){
				echo "<script type='text/javascript'>
					alert('Pelicula agregado al carrito');
				</script>";
				header("location:alqpel.php");
			}else{
				echo "<script type='text/javascript'>
					alert('Pelicula no agregado al carrito');
				</script>";
				header("location:alqpel.php");
			}	
		}
		if (isset($_POST["alquilar"])){
			$pedido = unserialize($_COOKIE[$_SESSION['usuario']]);
			if (!empty($pedido)){	
				foreach($pedido as $alquila){
					$id_cliente=$_SESSION['usuario'];
					$dia_alquila=date('Y-m-d H:n:s');
					
					$select_value="SELECT film_id FROM film WHERE title='$alquila';";
					$idk=mysqli_query($conn,$select_value);
					$fila=mysqli_fetch_assoc($idk);
					$id_peli1=$fila['film_id'];
					
					$select_value1="SELECT inventory_id FROM inventory WHERE filM_id='$id_peli1';";
					$idk1=mysqli_query($conn,$select_value1);
					$fila1=mysqli_fetch_assoc($idk1);
					$id_inventario=$fila1['inventory_id'];
					
					$resultMAX="select max(rental_id) from rental";
					$queryMax = mysqli_query($conn, $resultMAX);
					$resultMax = mysqli_fetch_assoc($queryMax);
					$idrental = $resultMax['max(rental_id)'];
					
					$cod_rental=$idrental+1;
					
					var_dump($cod_rental, $dia_alquila, $id_inventario, $id_cliente, '');
					
					$insert_value="INSERT INTO `rental`(`rental_id`, `rental_date`, `inventory_id`, `customer_id`, `return_date`) VALUES ('$cod_rental', '$dia_alquila', '$id_inventario', '$id_cliente', '');";
					$resultado=mysqli_query($conn, $insert_value);
					if ($resultado){
						echo "<script type='text/javascript'>
						alert('Alquiler realizado');
						</script>";
						header("location:alqpel.php");
						setcookie($_SESSION['usuario'], "", time()-9999);
					}else{
						echo "<script type='text/javascript'>
						alert('Alquiler no realizado');
						</script>";
						header("location:alqpel.php");
					}
				}
			}else{
				echo "<script type='text/javascript'>
				alert('No hay nada en el carrito');
				</script>";
				header("location:alqpel.php");
			}
		}
		if (isset($_POST["vaciar"])){
			$pedido = unserialize($_COOKIE[$_SESSION['usuario']]);
			if (!empty($pedido)){
				foreach($pedido as $alquila){
					$select_value="SELECT quantity FROM inventory, film WHERE inventory.film_id=film.film_id AND title='$alquila';";
					$idk=mysqli_query($conn,$select_value);
					$fila=mysqli_fetch_assoc($idk);
					$cantidad=$fila['quantity'];
					
					$select_value="SELECT film_id FROM film WHERE title='$alquila';";
					$idk=mysqli_query($conn,$select_value);
					$fila=mysqli_fetch_assoc($idk);
					$id_peli=$fila['film_id'];
					$cantidad_acutal=intval($cantidad)+1;
					
					$update_value="UPDATE inventory SET quantity='$cantidad_acutal' where film_id='$id_peli';";
					$resultado=mysqli_query($conn, $update_value);
					if ($resultado){
						header("location:alqpel.php");
					}else{
						echo "<script type='text/javascript'>
						alert('Pelicula no eliminiado al carrito');
						</script>";
						header("location:alqpel.php");
					}
				}
				setcookie($_SESSION['usuario'], "", time()-9999);
			}else{
				echo "<script type='text/javascript'>
				alert('No hay nada en el carrito');
				</script>";
				header("location:alqpel.php");
			}
		}
	}
	?>
	</form>
	<!-- FIN DEL FORMULARIO -->
	</div>	
  </div>



</body>
</html>