<html>
   
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VIDEOCLUB - IES Leonardo Da Vinci</title>
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
		<div class="card-header">Menú Usuario</div>
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
		<!--BORRAR una de las opciones-->
		<!--Formulario con enlaces -->
		<ul>
			<li><a href="alqpel.php">Alquilar Peliculas</a></li>
			<li><a href="alqcons.php">Consultar Alquileres</a></li>
			<li><a href="alqdev.php">Devolver Peliculas</a></li>  		 
		  </ul>
		
		<!--Formulario con botones 
		<input type="button" value="Alquilar Películas" onclick="window.location.href=''" class="btn btn-warning disabled">
		</br></br>
		<input type="button" value="Consultar Alquileres" onclick="window.location.href=''" class="btn btn-warning disabled">
		</br></br>
		<input type="button" value="Devolver Películas" onclick="window.location.href=''" class="btn btn-warning disabled">
		</br></br>-->
		

		  <BR><a href="logout.php">Cerrar Sesión</a>
	</div>  
	  
	  
     
   </body>
   
</html>