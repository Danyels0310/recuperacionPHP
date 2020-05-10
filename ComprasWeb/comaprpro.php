<html>
	<head>
		<meta charset="utf-8">
		<title>Aprovisionar Productos</title>
	</head>
	<body>
		<h1>Aprovisionar Productos</h1>
		<?php
		include('conectar.php');

		if (!isset($_POST) || empty($_POST)) { 
			
			$almacenes= obtenerAlamacen($conn); 			
			$productos = obtenerProducto($conn); 			
			/* Se inicializa la lista valores*/
			echo '<form action="" method="post">';
		?>
			<div>
			<label for="almacen">Almacen:</label>
			<select name="almacen">
				<?php foreach($almacenes as $almacen) : ?>
					<option> <?php echo $almacen ?> </option>
				<?php endforeach; ?></br>
			</select>
			</div>
			</br>
			<div>
			<label for="producto">Producto:</label>
			<select name="producto">
				<?php foreach($productos as $producto) : ?>
					<option> <?php echo $producto ?> </option>
				<?php endforeach; ?></br>
			</select>
			</div>
			</BR>Cantidad: <input type='number' name='cantidad' value='' size=25></br> 
			
		<?php
			echo '<div><input type="submit" value="Crear Producto"></div>
			</form>';
		} else { 

			// Aquí va el código al pulsar submit

			// Lo primero obtengo el dpto actual (para contrastar)
			$almacen = $_POST['almacen'];
			$producto = $_POST['producto'];
			$cantidad = $_POST['cantidad'];
			
			$codpro="SELECT ID_PRODUCTO AS CODIGO FROM PRODUCTO WHERE NOMBRE='$producto'";
			$idk=mysqli_query($conn,$codpro);
			$fila=mysqli_fetch_assoc($idk);
			$codigo_poducto=$fila['CODIGO'];
			
			
			
			$insert_value="INSERT INTO ALMACENA (NUM_ALMACEN, ID_PRODUCTO, CANTIDAD) VALUES ('$almacen', '$codigo_poducto', '$cantidad');";
			$resultado=mysqli_query($conn, $insert_value);
			if ($resultado){
				$conn->query($insert_value);
				echo "New record created successfully";
			}else{
				echo "Don't create";
			}

		}
		?>
		<?php
		// Funciones utilizadas en el programa
		function obtenerAlamacen($conn) {
			$categorias = array();
			
			$sql = "SELECT NUM_ALMACEN FROM ALMACEN";
			
			$resultado = mysqli_query($conn, $sql);
			if ($resultado) {
				while ($row = mysqli_fetch_assoc($resultado)) {
					$categorias[] = $row['NUM_ALMACEN'];
				}
			}
			return $categorias;
		}
		function obtenerProducto($conn) {
			$categorias = array();
			
			$sql = "SELECT NOMBRE FROM PRODUCTO";
			
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
