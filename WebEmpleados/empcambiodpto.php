<html>
	<head>
		<meta charset="utf-8">
		<title>Cambiar Departamento</title>
	</head>
	<body>
		<h1>Cambiar Departamento</h1>
		<?php
		include('conectar.php');

		if (!isset($_POST) || empty($_POST)) { 
			
			$empleados= obtenerEmpleado($conn); 			 			
			$departamentos= obtenerDepartamento($conn); 			 			
			/* Se inicializa la lista valores*/
			echo '<form action="" method="post">';
		?>
			<div>
			<label for="empleado">Empleado:</label>
			<select name="empleado">
				<?php foreach($empleados as $empleado) : ?>
					<option> <?php echo $empleado ?> </option>
				<?php endforeach; ?></br>
			</select>
			</div>
			<div>
			<label for="departamento">Departamento:</label>
			<select name="departamento">
				<?php foreach($departamentos as $departamento) : ?>
					<option> <?php echo $departamento ?> </option>
				<?php endforeach; ?></br>
			</select>
			</div>
			
		<?php
			echo '<div><input type="submit" value="Crear Producto"></div>
			</form>';
		} else { 

			// Aquí va el código al pulsar submit

			// Lo primero obtengo el dpto actual (para contrastar)
			$empleado = $_POST['empleado'];
			$departamento = $_POST['departamento'];
			$hoy=date("Y-m-d H:m:s");		
		
			$codigo="SELECt cod_dpto FROM departamento WHERE nombre_dpto='$departamento';";
			$idk=mysqli_query($conn,$codigo);
			$fila=mysqli_fetch_assoc($idk);
			$codigo_dep=$fila['cod_dpto'];
			
			$fecha_fin="UPDATE emple_depart SET fecha_fin='$hoy' WHERE dni='$empleado' AND cod_dpto='$codigo_dep';";
			$resultado1=mysqli_query($conn, $fecha_fin);
			
			$insert_value2="INSERT INTO emple_depart (dni, cod_dpto, fecha_ini, fecha_fin) VALUES ('$empleado', '$codigo_dep', '$hoy','');";
			$resultado2=mysqli_query($conn, $insert_value2);
			
			if ($resultado1){
				$conn->query($fecha_fin);
				echo "Se modificó la fecha de fin de departamento</br>";
			}else{
				echo "Don't create</br>";
			}
			
			if ($resultado2){
				$conn->query($insert_value2);
				echo "Se introdujo al cliente en el nuevo departamento</br>";
			}else{
				echo "Don't create";
			}

		}
		?>
		<?php
		// Funciones utilizadas en el programa
		function obtenerEmpleado($conn) {
			$categorias = array();
			
			$sql = "SELECT dni FROM empleado";
			
			$resultado = mysqli_query($conn, $sql);
			if ($resultado) {
				while ($row = mysqli_fetch_assoc($resultado)) {
					$categorias[] = $row['dni'];
				}
			}
			return $categorias;
		}
		function obtenerDepartamento($conn) {
			$categorias = array();
			
			$sql = "SELECT nombre_dpto FROM departamento";
			
			$resultado = mysqli_query($conn, $sql);
			if ($resultado) {
				while ($row = mysqli_fetch_assoc($resultado)) {
					$categorias[] = $row['nombre_dpto'];
				}
			}
			return $categorias;
		}
		?>
	</body>
</html>
