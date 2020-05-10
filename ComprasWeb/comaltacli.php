<html>
	<head>
		<meta charset="utf-8">
		<title>Alta Cliente</title>
	</head>
	<body>
		<h1>Alta de Cliente</h1>
		<?php
		include('conectar.php');

		if (!isset($_POST) || empty($_POST)) { 
						
			/* Se inicializa la lista valores*/
			echo '<form action="" method="post">';
		?>
			<div>
			NIF: <input type:'text' name='nif' value='' size=15></br>
			Nombre: <input type='text' name='nombre' value='' size=25></br>
			Apellido: <input type='text' name='ape' value='' size=25></br>
			CP: <input type='text' name='cp' value='' size=8></br>
			Dirección: <input type='text' name='dire' value='' size=25></br> 
			Ciudad: <input type='text' name='ciudad' value='' size=25></br> 
			</BR>
		<?php
			echo '<div><input type="submit" value="Crear Cliente"></div>
			</form>';
		} else { 

			// Aquí va el código al pulsar submit

			// Lo primero obtengo el dpto actual (para contrastar)
			$nif = $_POST['nif'];
			$nombre = $_POST['nombre'];
			$ape = $_POST['ape'];
			$cp = $_POST['cp'];
			$direc = $_POST['dire'];
			$ciudad = $_POST['ciudad'];
			
			if (empty($nif)){
				echo("El NIF esta vacio");
			} else {
				$arraynif=obtenernif($conn);
				$esta=false;
				for ($i=0; $i< sizeof($arraynif);$i++){
					if ($nif=$arraynif[$i]){
						$esta=true;
					}
				}
				if ($esta){
					echo("El NIF ya esta registrado");
				}else{
					if(comprobarnif($nif)){
						$insert_value="INSERT INTO CLIENTE (NIF, NOMBRE, APELLIDO, CP, DIRECCION, CIUDAD) VALUES ('$nif', '$nombre', '$ape', '$cp', '$direc', '$ciudad');";
						$resultado=mysqli_query($conn, $insert_value);
						if ($resultado){
							$conn->query($insert_value);
							echo "New record created successfully";
						}else{
							echo "Don't create";
						}
					}else{ 
						echo "El NIF esta mal escrito";
					}
				}
			}
		}
		?>
		<?php
		// Funciones utilizadas en el programa
		function obtenernif($conn) {
			$categorias = array();
			
			$sql = "SELECT NIF, NOMBRE FROM CLIENTES";
			
			$resultado = mysqli_query($conn, $sql);
			if ($resultado) {
				while ($row = mysqli_fetch_assoc($resultado)) {
					$categorias[] = $row['NIF'];
				}
			}
			return $categorias;
		}
		
		function comprobarnif($nif){
			$letra = substr($nif, -1);
			$numeros = substr($nif, 0, -1);
			if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
				return true;
			}else{
				return false;
			}
		}
		?>
	</body>
</html>
