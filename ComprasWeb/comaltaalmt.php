<html>
	<head>
		<meta charset="utf-8">
		<title>Alta Cliente</title>
	</head>
	<body>
		<h1>Alta de Almacen</h1>
		<?php
		include('conectar.php');

		if (!isset($_POST) || empty($_POST)) { 
						
			/* Se inicializa la lista valores*/
			echo '<form action="" method="post">';
		?>
			<div>
			Localidad: <input type='text' name='localidad' value='' size=25></br> 
			</BR>
		<?php
			echo '<div><input type="submit" value="Crear Almacen"></div>
			</form>';
		} else { 

			// Aquí va el código al pulsar submit

			// Lo primero obtengo el dpto actual (para contrastar)
			$id=obtenerid($conn);
			$localidad = $_POST['localidad'];
			var_dump($id);
			
			if ($id==''){
				$id=10;
				$insert_value="INSERT INTO ALMACEN (NUM_ALMACEN, LOCALIDAD) VALUES ('$id', '$localidad');";
				$resultado=mysqli_query($conn, $insert_value);
				if ($resultado){
					$conn->query($insert_value);
					echo "New record created successfully";
				}else{
					echo "Don't create";
				} 
			}else{
				$id+=10;
				$insert_value="INSERT INTO ALMACEN (NUM_ALMACEN, LOCALIDAD) VALUES ('$id', '$localidad');";
				$resultado=mysqli_query($conn, $insert_value);
				if ($resultado){
					$conn->query($insert_value);
					echo "New record created successfully";
				}else{
					echo "Don't create";
				} 
			}
			
		}
		?>
		<?php
		// Funciones utilizadas en el programa
		function obtenerid($db){
			$categoria="";
			$sql = "SELECT NUM_ALMACEN FROM ALMACEN";
		  
			$resultado=mysqli_query($db,$sql);
			
			if($resultado){
		   
				while($fila=mysqli_fetch_assoc($resultado)){
				$categoria=$fila['NUM_ALMACEN'];
					}
			}
			return $categoria;
		}
		
		?>
	</body>
</html>
