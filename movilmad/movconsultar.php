<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="bootstrap.min.css">
  </head>
   
 <body>
    <h1>Servicio de ALQUILER DE E-CARS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - CONSULTA ALQUILERES </div>
		<div class="card-body">
	<?php
	include 'conectar.php';
	include 'funciones.php';
	if (!isset($_POST) || empty($_POST)) { 
	?>
	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
	<?php 
		session_start();
		$sesion=$_SESSION['usuario'];
		echo"<div> Bienvenido: ".nombrecliente($conn ,$sesion)."</div>";
		echo"<div> Numero Cliente: ".$sesion."</div>";
	?>
		<B>Consultar Alquileres </B> <BR><BR>
		     
			 Fecha Desde: <input type='date' name='fechadesde' class="form-control">
			 Fecha Hasta: <input type='date' name='fechahasta' class="form-control"><br><br>
				
		<div>
			<input type="submit" value="Consultar" name="Volver" class="btn btn-warning disabled">
		
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='movwelcome.php'">
		
		</div>		
	</form>
	<!-- FIN DEL FORMULARIO -->
    <a href = "logout.php">Cerrar Sesion</a>
	<?php
		}else{
			$inicio=$_POST["fechadesde"];
			$fin=$_POST["fechahasta"];
			
			$select_value="SELECT rvehiculos.matricula, rvehiculos.marca, rvehiculos.modelo, fecha_alquiler, fecha_devolucion, preciototal FROM ralquilar, rvehiculos WHERE ralquilar.matricula=rvehiculos.matricula AND fecha_alquiler>='$inicio' AND fecha_alquiler<'$fin' ORDER BY fecha_alquiler;";
			$resultado = mysqli_query($conn, $select_value);
			if($resultado){
				if (mysqli_num_rows($resultado) > 0) {
					echo "<table border=1px><tr><th>MATRICULA</th><th>MARCA</th><th>MODELO</th><th>FECHA_ALQUILER</th><th>FECHA_DEVOLUCION</th><th>PRECIO_TOTAL</th></tr>";
					while ($row = mysqli_fetch_assoc($resultado)) {
						 echo "<tr>";
						 echo "<td>".$row['matricula']."</td>";
						 echo "<td>".$row['marca']."</td>";
						 echo "<td>".$row['modelo']."</td>";
						 echo "<td>".$row['fecha_alquiler']."</td>";
						 echo "<td>".$row['fecha_devolucion']."</td>";
						 echo "<td>".$row['preciototal']."</td></tr>";
					}
					echo "</table>";
					echo "<a href='movconsultar.php'>Volver a consultar</a>";
				} else {
					trigger_error("No tenemos ningun coche alquilado en esa franja de fechas.");
					echo "<a href='movconsultar.php'>Volver a consultar</a>";					
				}
			}else{
				trigger_error("Error: " . $select_value . "<br/>" . mysqli_error($conn));
			}
		
		}
	?>
  </body>
   
</html>
