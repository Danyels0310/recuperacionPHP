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
		<div class="card-header">Menú Usuario - ALQUILAR VEHÍCULOS</div>
		<div class="card-body">
	<?php
	include 'conectar.php';
	include 'funciones.php';
	if (!isset($_POST) || empty($_POST)) { 
		$coches= obtenerCoche($conn);
	
	?>	  	  

	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">
		<?php 
			if (!isset($_SESSION['usuario'])){
				session_start();
			}
			$sesion=$_SESSION['usuario'];
			echo"<div> Bienvenido: ".nombrecliente($conn ,$sesion)."</div>";
			echo"<div> Numero Cliente: ".$sesion."</div>";
		?>
		<B>Vehiculos disponibles en este momento:</B>   <BR><BR>
		
			<B>Matricula/Marca/Modelo: </B><select name="vehiculos" class="form-control">
				<?php foreach($coches as $coche) : ?>
					<option> <?php echo $coche ?> </option>
				<?php endforeach; ?></br>
			</select>
			<BR>
			<B>Dias alquiler:</B><input type="text" name="dias" placeholder="dias" class="form-control">
		
		<BR> <BR><BR><BR><BR><BR>
		<div>
			<input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
			<input type="submit" value="Realizar Alquiler" name="alquilar" class="btn btn-warning disabled">
			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
			<input type="button" value="Volver" name="Volver" class="btn btn-warning disabled" onclick="window.location.href='movwelcome.php'">
		</div>		
	</form>
<?php
	}
	else{
	$coche=$_POST["vehiculos"];
	$dias=$_POST["dias"];
	session_start();
		if (isset($_POST["agregar"])){
			header("location:movalquilar.php");
			$matricula=substr($coche,0,strpos($coche,"-"));
			$alquila=array($matricula, $dias);
			$pedido=array();

			if (!isset($_COOKIE[$_SESSION['usuario']])) {
				setcookie($_SESSION['usuario'], serialize($pedido), time()+3600);
			}else {
				$pedido = unserialize($_COOKIE[$_SESSION['usuario']]);
			}
			array_push($pedido, $alquila);
			setcookie($_SESSION['usuario'], serialize($pedido));
			
			$update_value="UPDATE rvehiculos SET disponible=0 where matricula='$matricula';";
			$resultado=mysqli_query($conn, $update_value);
			if ($resultado){
				echo "<script type='text/javascript'>
					alert('Coche agregado al carrito');
				</script>";
				header("location:movalquilar.php");
			}else{
				echo "<script type='text/javascript'>
					alert('Coche no agregado al carrito');
				</script>";
				header("location:movalquilar.php");
			}	
		}
		if (isset($_POST["alquilar"])){
			$pedido = unserialize($_COOKIE[$_SESSION['usuario']]);
			foreach($pedido as $alquila){
				$id_cliente=$_SESSION['usuario'];
				$matricula=$alquila[0];
				$dias=intval($alquila[1]);
				$dia_alquila=date('Y-m-d');
				
				$select_value1="SELECT preciobase FROM rvehiculos WHERE matricula='$matricula';";
				$idk1=mysqli_query($conn,$select_value1);
				$fila1=mysqli_fetch_assoc($idk1);
				$preciobase=$fila1['preciobase'];
				
				$select_value2="SELECT ADDDATE('$dia_alquila', $dias) as devolucion";
				$idk2=mysqli_query($conn,$select_value2);
				$dia_devolver=mysqli_fetch_assoc($idk2);
				$precio_total=$preciobase*$dias;
				
				$insert_value="INSERT INTO `ralquilar`(`idcliente`, `matricula`, `num_dias`, `fecha_alquiler`, `fecha_devolucion`, `preciototal`) VALUES ('$id_cliente', '$matricula', $dias, '$dia_alquila', '$dia_devolver', '$');";
				$resultado=mysqli_query($conn, $insert_value);
				if ($resultado){
					echo "<script type='text/javascript'>
					alert('Alquiler realizado');
					</script>";
					header("location:movalquilar.php");
				}else{
					echo "<script type='text/javascript'>
					alert('CAlquiler no realizado');
					</script>";
					header("location:movalquilar.php");
				}
			}
		}
		if (isset($_POST["vaciar"])){
			$pedido = unserialize($_COOKIE[$_SESSION['usuario']]);
			foreach($pedido as $alquila){
				$update_value="UPDATE rvehiculos SET disponible=1 where matricula='$alquila[0]';";
				$resultado=mysqli_query($conn, $update_value);
				if ($resultado){
					header("location:movalquilar.php");
				}else{
					echo "<script type='text/javascript'>
					alert('Coche no eliminiado al carrito');
					</script>";
					header("location:movalquilar.php");
				}
			}
			setcookie($_SESSION['usuario'], "", time()-9999);
		}
	}
?>
  </body> 
</html>

