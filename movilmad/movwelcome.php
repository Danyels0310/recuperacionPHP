<html>
   
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a MovilMAD</title>
    <link rel="stylesheet" href="bootstrap.min.css">
 </head>
<?php
	include 'conectar.php';
	include 'funciones.php';
?>
 <body>
    <h1>Servicio de ALQUILER DE E-CARS</h1> 

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - OPERACIONES </div>
		<?php
			if (!isset($_SESSION['usuario'])){
				session_start();
			}
			$sesion=$_SESSION['usuario'];
			echo"<div> Bienvenido: ".nombrecliente($conn ,$sesion)."</div>";
			echo"<div> Numero Cliente: ".$sesion."</div>";
		?>

	  <!--BORRAR una de las opciones-->
		<!--Formulario con enlaces -->
		<ul>
			<li><a href="movalquilar.php">Alquilar Vehículo</a></li>
			<li><a href="movconsultar.php">Consultar Alquileres</a></li>
			<li><a href="movdevolver.php">Devolver Vehículo</a></li>  		 
		  </ul>
		
        <!--Formulario con botones 
	
		<input type="button" value="Alquilar Vehículo" onclick="window.location.href=''" class="btn btn-warning disabled">
		</br></br>
		<input type="button" value="Consultar Alquileres" onclick="window.location.href=''" class="btn btn-warning disabled">
		</br></br>
		<input type="button" value="Devolver Vehículo" onclick="window.location.href=''" class="btn btn-warning disabled">
		</br></br> -->
		
		
		
		  <BR><a href="logout.php">Cerrar Sesión</a>
		</div>  
	</div> 	
   </body>
   
</html>