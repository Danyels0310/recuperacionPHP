<html>
   
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a MovilMAD</title>
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
		$coches= obtenerCocheAlq($conn, $sesion);
?>	
  <body>
    <h1>Servicio de ALQUILER DE E-CARS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - DEVOLUCIÓN VEHÍCULO </div>
		<div class="card-body">
		<?php
			if (!isset($_SESSION['usuario'])){
				session_start();
			}
			$sesion=$_SESSION['usuario'];
			echo"<div> Bienvenido: ".nombrecliente($conn ,$sesion)."</div>";
			echo"<div> Numero Cliente: ".$sesion."</div></br>";
		?>
	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
				
			<B>Matricula/Marca/Modelo: </B><select name="vehiculos" class="form-control">
				<?php foreach($coches as $coche) : ?>
					<option> <?php echo $coche ?> </option>
				<?php endforeach; ?></br>
			</select>
	
		<div>
			<input type="submit" value="Devolver Vehiculo" name="devolver" class="btn btn-warning disabled">
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='movwelcome.php'">
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
	<a href = "logout.php">Cerrar Sesion</a>
<?php
	}
	else{
		if (isset($_POST["devolver"])){
			$coche=$_POST["vehiculos"];
			$matricula=substr($coche,0,strpos($coche,"-"));
			$hoy=date('Y-m-d');
			
			$select_value="SELECT fecha_devolucion FROM ralquilar WHERE matricula='$matricula';";
			$fila=mysqli_fetch_assoc($idk);
			$devolucion=$fila['fecha_devolucion'];
			var_dump($devolucion);
			var_dump($hoy);
			
			if($devolucion<=$hoy){
				$update_value="UPDATE rvehiculos SET disponible=1 where matricula='$alquila[0]';";
				$resultado=mysqli_query($conn, $update_value);
				echo "<script type='text/javascript'>alert('La devolución se hizo correctamente');</script>";
				header("location:movdevolver.php");
			}else{
				echo "<script type='text/javascript'>alert('No se pudo hacer la devolución. Pongase en contacto con Atención al Cliente');</script>";
				header("location:movdevolver.php");
			}
		}
	}
?>
  </body>
   
</html>



