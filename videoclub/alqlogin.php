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
	if (!isset($_POST) || empty($_POST)) { 

?>        
     <body>
    <h1 class="text-center"> VIDEOCLUB IES LEONARDO DA VINCI</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Login Usuario</div>
		<div class="card-body">
		
		<form id="" name="" action="" method="post" class="card-body">
		
		<div class="form-group">
			Usuario <input type="text" name="usuario" placeholder="usuario" class="form-control">
        </div>
		<div class="form-group">
			Clave <input type="password" name="clave" placeholder="usuario" class="form-control">
        </div>				
        
		<input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
        </form>
		
	    </div>
		
<?php
	}
	else{
	   
		$usuario=$_POST["usuario"];
		$password=$_POST["clave"];
		
		$select_value="SELECT id FROM users where username='$usuario' AND passcode='$password'";
		$idk3=mysqli_query($conn,$select_value);
		$fila3=mysqli_fetch_assoc($idk3);
		$idcliente=$fila3['id'];
		
		if (isset($idcliente)){
			session_start();
			$_SESSION['usuario']=$idcliente;
			include("alqwelcome.php");
		}else{
			include("alqlogin.php");
		}
	}
?>
    </div>
    </div>
    </div>



</body>
</html>