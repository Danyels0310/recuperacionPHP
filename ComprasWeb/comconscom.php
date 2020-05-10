<html>
	<head>
		<meta charset="UTF-8">
		<title>Consulta Compras</title>
	 
	</head>

	<body>
		<h1>Consulta Compras </h1>
		<?php
		include('conectar.php');


		/* Se muestra el formulario la primera vez */
		if (!isset($_POST) || empty($_POST)) { 
			
			$nifs=obtenercliente($conn);
			/* Se inicializa la lista valores*/
			echo '<form action="" method="post">';
			
		?>
	
		<div>
			<label for="nif">NIF:</label>
			<select name="nif">
				<?php foreach($nifs as $nif) : ?>
					<option> <?php echo $nif ?> </option>
				<?php endforeach; ?></br>
			</select>
		</div>
		<div>
			Desde: <input type='date' name='desde'></br>
			Hasta: <input type='date' name='hasta'></br>
		</div>
			
		<?php
			echo '<div><input type="submit" value="Buscar compra"></div>
			</form>';
		} else { 
			$array_compras=verCompras($conn);
			
			if (empty($array_compras)){
				echo "No hay productos";
			}else if ($_POST['desde']>$_POST['hasta']){
				echo "Las fechas introducidas no son correctas";
			}else{
				echo "<table border='1'><tr><th>Almacen</th><th>Producto</th><th>Cantidad</th></tr>";
				foreach($array_compras as $row){
					echo $row;
				}
				echo "</table>";
			}
			
			
			
		}
		// Funciones utilizadas en el programa

		function obtenercliente($conn){
			$categoria=[];
			$sql = "SELECT NIF FROM CLIENTE";
		  
			$resultado=mysqli_query($conn,$sql);
			
			if($resultado){
		   
				while($fila=mysqli_fetch_assoc($resultado)){
				$categoria[]=$fila['NIF'];
					}
			}
			return $categoria;
		}
		
		function verCompras($conn){
			$nif=$_POST["nif"];
			$desde=$_POST["desde"];
			$hasta=$_POST["hasta"];
			
			$select_value="SELECT PRODUCTO.ID_PRODUCTO  AS ID, NOMBRE AS PRODUCTO, PRECIO  FROM PRODUCTO INNER JOIN COMPRA ON PRODUCTO.ID_PRODUCTO=COMPRA.ID_PRODUCTO WHERE NIF='$nif' AND FECHA_COMPRA>='$desde' AND FECHA_COMPRA<='$hasta'";
			$resultado=mysqli_query($conn, $select_value);
			var_dump($desde);
			var_dump($hasta);
			if(mysqli_num_rows($resultado)>0){
				while($row= mysqli_fetch_assoc($resultado)){
				 $productos[]="<TR align='center'><TD> " . $row["ID"]. " </TD><TD> " . $row["PRODUCTO"]. " </TD><TD> ". $row["PRECIO"].'</TD></TR>'; 
				}
			}else{
				$productos=0;
			}
			return $productos;
		}
		?>
	</body>
</html>