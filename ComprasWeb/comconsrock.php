<html>
	<head>
		<meta charset="UTF-8">
		<title>Consulta Stock</title>
	 
	</head>

	<body>
		<h1>Consulta Stock </h1>
		<?php
		include('conectar.php');


		/* Se muestra el formulario la primera vez */
		if (!isset($_POST) || empty($_POST)) { 
			
			$productos=obtenerproducto($conn);
			/* Se inicializa la lista valores*/
			echo '<form action="" method="post">';
			
		?>
	
		<div>
			<label for="producto">Producto:</label>
			<select name="producto">
				<?php foreach($productos as $producto) : ?>
					<option> <?php echo $producto ?> </option>
				<?php endforeach; ?></br>
			</select>
		</div>
	
			
		<?php
			echo '<div><input type="submit" value="Buscar producto"></div>
			</form>';
		} else { 
			$producto=$_POST["producto"];
			
			$select_value="SELECT CANTIDAD FROM ALMACENA INNER JOIN PRODUCTO ON ALMACENA.ID_PRODUCTO=PRODUCTO.ID_PRODUCTO WHERE NOMBRE='$producto'";
			$resultado=mysqli_query($conn, $select_value);
			$fila=mysqli_fetch_assoc($resultado);
			$cantidad=$fila['CANTIDAD'];
			
			
			echo "Tenemos ".$cantidad." unidad/es de ".$producto;
		}
		// Funciones utilizadas en el programa

		function obtenerproducto($conn){
			$categoria=[];
			$sql = "SELECT NOMBRE FROM PRODUCTO";
		  
			$resultado=mysqli_query($conn,$sql);
			
			if($resultado){
		   
				while($fila=mysqli_fetch_assoc($resultado)){
				$categoria[]=$fila['NOMBRE'];
					}
			}
			return $categoria;
		}
		?>
	</body>
</html>