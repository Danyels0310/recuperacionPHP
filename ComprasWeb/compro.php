<html>
	<head>
		<meta charset="UTF-8">
		<title>Compro</title>
	 
	</head>

	<body>
		<h1>Compra producto </h1>
		<?php
		include('conectar.php');


		/* Se muestra el formulario la primera vez */
		if (!isset($_POST) || empty($_POST)) { 
			
			$clientes=obtenercliente($conn);
			$productos=obtenerproducto($conn);
			/* Se inicializa la lista valores*/
			echo '<form action="compro.php" method="post">';
			
			?>

		<div>
		   <label for="cliente">Cliente:</label>
			<select name="cliente"><br>
				<?php foreach ($clientes as $cliente): ?> {
				   <option> <?php echo("$cliente") ?></option>;
				<?php endforeach; ?></br>
			</select>
		</div>	
		<div>
			<label for="producto">Producto:</label>
			<select name="producto">
				<?php foreach($productos as $producto) : ?>
					<option> <?php echo $producto ?> </option>
				<?php endforeach; ?></br>
			</select>
		</div>
		<div>
			Cantidad: <input type='number' name='cantidad' value='' size=25></br> 
			<input type='date' name='fecha'></input>
		</div>
		</br>
			
		<?php
			echo '<div><input type="submit" value="Alta Producto"></div>
			</form>';
		} else { 
			$cliente=$_POST["cliente"];
			$producto=$_POST["producto"];
			$cantidad=$_POST['cantidad'];
			$fecha=$_POST['fecha'];
			
			//obtenemos el id del cliente con el nombre de dicho cliente
			$dni="SELECT NIF as DNI FROM CLIENTE WHERE NOMBRE='$cliente'";
			$idk=mysqli_query($conn,$dni);
			$fila=mysqli_fetch_assoc($idk);
			$id_cliente=$fila['DNI'];
			
			//obtenemos el id del producto con el nombre de dicho producto
			$id_producto="SELECT ID_PRODUCTO as ID FROM PRODUCTO WHERE NOMBRE='$producto'";
			$idk2=mysqli_query($conn,$id_producto);
			$fila2=mysqli_fetch_assoc($idk2);
			$id_produc=$fila2['ID'];
			
			//obtemeos la cantidad de dicho producto
			$cantidad_producto="SELECT CANTIDAD as UNIDADES FROM ALMACENA WHERE ID_PRODUCTO='$id_produc'";
			$idk3=mysqli_query($conn,$cantidad_producto);
			var_dump($cantidad_producto);
			$fila3=mysqli_fetch_assoc($idk3);
			$uni_quedan=$fila3['UNIDADES'];

			$insertarcompras="INSERT INTO COMPRA(NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES) VALUES('$id_cliente','$id_produc','$fecha',$cantidad)";

			if($uni_quedan<$cantidad){
				echo "La cantidad que vas a comprar es superior a la que tienes en el producto";
			}
			else{
				$cambiarunidades="UPDATE productoA set CANTIDAD=CANTIDAD-$cantidad where ID_PRODUCTO='$id_produc'";
				mysqli_query($conn,$cambiarunidades);
				mysqli_query($conn,$insertarcompras);
				echo "New record created successfully";
			}
		}
		
		// Funciones utilizadas en el programa

		function obtenercliente($conn){
			$categoria=[];
			$sql = "SELECT NOMBRE FROM CLIENTE";
		  
			$resultado=mysqli_query($conn,$sql);
			
			if($resultado){
		   
				while($fila=mysqli_fetch_assoc($resultado)){
				$categoria[]=$fila['NOMBRE'];
					}
			}
			return $categoria;
		}
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