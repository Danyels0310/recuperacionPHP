<html>
	<head>
		<meta charset="utf-8">
		<title>Alta Categoría</title>
	</head>
	<body>
		<h1>Alta de Categoría</h1>
		<?php
		include('conectar.php');

		if (!isset($_POST) || empty($_POST)) { 

			
			/* Se inicializa la lista valores*/
			echo '<form action="" method="post">';
		?>
			<div>
			ID categoria: <input type:'text' name='idcat' value='' size=15></br>
			Nombre: <input type='text' name='nombrecat' value='' size=25><br><br> 
			</div>
			</BR>
		<?php
			echo '<div><input type="submit" value="Crear Categoría"></div>
			</form>';
		} else { 

			// Aquí va el código al pulsar submit

			// Lo primero obtengo el dpto actual (para contrastar)
			$idcat = $_POST['idcat'];
			$nombrecat = $_POST['nombrecat'];
			$insert_value="INSERT INTO categoria (ID_CATEGORIA, NOMBRE) VALUES ('$idcat', '$nombrecat');";
			$resultado=mysqli_query($conn, $insert_value);
			if ($resultado){
				$conn->query($insert_value);
				echo "New record created successfully";
			}else{
				echo "Don't create";
			}

		}
		?>
	</body>
</html>
