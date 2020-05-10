<html>
	<head>
		<meta charset="UTF-8">
		<title>Consulta almacen</title>
	 
	</head>

	<body>
		<h1>Consulta Almacen </h1>
		<?php
		include('conectar.php');


		/* Se muestra el formulario la primera vez */
		if (!isset($_POST) || empty($_POST)) { 
			
			$almacenes=obteneralmacen($conn);
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
	
			
		<?php
			echo '<div><input type="submit" value="Buscar almacen"></div>
			</form>';
		} else { 
			$array_productos=verProductos($conn);
			
			if (empty($array_productos)){
				echo "No hay productos";
			}else{
				echo "<table border='1'><tr><th>Almacen</th><th>Producto</th><th>Cantidad</th></tr>";
				foreach($array_productos as $row){
					echo $row;
				}
				echo "</table>";
			}
			
			
			
		}
		// Funciones utilizadas en el programa

		function obteneralmacen($conn){
			$categoria=[];
			$sql = "SELECT NUM_ALMACEN FROM ALMACEN";
		  
			$resultado=mysqli_query($conn,$sql);
			
			if($resultado){
		   
				while($fila=mysqli_fetch_assoc($resultado)){
				$categoria[]=$fila['NUM_ALMACEN'];
					}
			}
			return $categoria;
		}
		
		function verProductos($conn){
			$almacen=$_POST["almacen"];
			
			$select_value="SELECT NUM_ALMACEN AS ALMACEN, NOMBRE AS PRODUCTO, CANTIDAD FROM PRODUCTO INNER JOIN ALMACENA ON PRODUCTO.ID_PRODUCTO=ALMACENA.ID_PRODUCTO WHERE NUM_ALMACEN='$almacen'";
			$resultado=mysqli_query($conn, $select_value);
			if(mysqli_num_rows($resultado)>0){
				while($row= mysqli_fetch_assoc($resultado)){
				 $productos[]="<TR align='center'><TD> " . $row["ALMACEN"]. " </TD><TD> " . $row["PRODUCTO"]. " </TD><TD> ". $row["CANTIDAD"].'</TD></TR>'; 
				}
			}else{
				$productos=0;
			}
			return $productos;
		}
		?>
	</body>
</html>