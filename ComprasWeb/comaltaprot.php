<html>
	<head>
		<meta charset="utf-8">
		<title>Alta Producto</title>
	</head>
	<body>
		<h1>Alta de Producto</h1>
		<?php
		include('conectar.php');

		if (!isset($_POST) || empty($_POST)) { 
			
			$categorias = obtenerCategorias($conn); 			
			/* Se inicializa la lista valores*/
			echo '<form action="" method="post">';
		?>
			<div>
			ID producto: <input type:'text' name='id' value='' size=15></br>
			Nombre: <input type='text' name='nombre' value='' size=25></br> 
			Precio: <input type='text' name='precio' value='' size=25></br> 
			<label for="categoria">Categoría:</label>
			<select name="categoria">
				<?php foreach($categorias as $categoria) : ?>
					<option> <?php echo $categoria ?> </option>
				<?php endforeach; ?></br>
			</div>
			</BR>
		<?php
			echo '<div><input type="submit" value="Crear Producto"></div>
			</form>';
		} else { 

			// Aquí va el código al pulsar submit

			// Lo primero obtengo el dpto actual (para contrastar)
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
			$precio= $_POST['precio'];
			$cat= $_POST['categoria'];
			
			$codcat="SELECT ID_CATEGORIA FROM CATEGORIA WHERE NOMBRE='$cat'";
			$idk=mysqli_query($conn,$codcat);
			$fila=mysqli_fetch_assoc($idk);
			$codigo_departamento=$fila['ID_CATEGORIA'];
						
			$insert_value="INSERT INTO `producto`(`ID_PRODUCTO`, `NOMBRE`, `PRECIO`, `ID_CATEGORIA`) VALUES('$id', '$nombre', '$precio', '$codigo_departamento');";
			
			$resultado=mysqli_query($conn, $insert_value);
			if ($resultado){
				$conn->query($insert_value);
				echo "New record created successfully";
			}else{
				echo "Don't create";
			}
var_dump($insert_value);
		}
		?>
		<?php
		// Funciones utilizadas en el programa
		function obtenerCategorias($conn) {
			$categorias = array();
			
			$sql = "SELECT ID_CATEGORIA, NOMBRE FROM CATEGORIA";
			
			$resultado = mysqli_query($conn, $sql);
			if ($resultado) {
				while ($row = mysqli_fetch_assoc($resultado)) {
					$categorias[] = $row['NOMBRE'];
				}
			}
			return $categorias;
		}
		?>
	</body>
</html>
