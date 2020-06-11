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
?>   
   <body>
    <h1 class="text-center"> VIDEOCLUB IES LEONARDO DA VINCI</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Consulta Alquileres</div>
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
		<h3>Peliculas alquiladas </h3> <BR>
	<?php
		$select_value=" SELECT film.title, rental_date FROM rental, inventory, film WHERE rental.inventory_id=inventory.inventory_id AND inventory.film_id=film.film_id AND customer_id='$sesion' AND return_date='0000-00-00 00:00:00' ORDER BY rental_date;";
			$resultado = mysqli_query($conn, $select_value);
			if($resultado){
				if (mysqli_num_rows($resultado) > 0) {
					echo "<table border=1px><tr><th>TITULO</th><th>FECHA DE ALQUILER</th></tr>";
					while ($row = mysqli_fetch_assoc($resultado)) {
						 echo "<tr>";
						 echo "<td>".$row['title']."</td>";
						 echo "<td>".$row['rental_date']."</td>";
					}
					echo "</table></br>";
				} else {
					echo "<script type='text/javascript'>alert('No tienes ninguna pelicula alquilada');</script>";
					header("location:alqcons.php");					
				}
			}else{
				trigger_error("Error: " . $select_value . "<br/>" . mysqli_error($conn));
			}
	?>			
		<div>
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='alqwelcome.php'">
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
  </div>



</body>
</html>

