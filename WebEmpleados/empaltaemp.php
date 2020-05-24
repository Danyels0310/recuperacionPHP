<html>
	<head>
		<meta charset="utf-8">
		<title>Alta Empleado</title>
	</head>
	<body>
		<h1>Alta Empleado</h1>
		<?php
		include('conectar.php');

		if (!isset($_POST) || empty($_POST)) { 
			
			$departamentos= obtenerDepartamento($conn); 			 			
			/* Se inicializa la lista valores*/
			echo '<form action="" method="post">';
		?>
			DNI: <input type='text' name='dni' value='' size=25></br>
			Nombre: <input type='text' name='nombre' value='' size=25></br>
			Apellido: <input type='text' name='ape' value='' size=25></br>
			Fecha de nacimiento: <input type='date' name='fecha_naci' value='' size=25></br>
			Salario: <input type='text' name='salario' value='' size=25></br>
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
			$dni = $_POST['dni'];
			$nombre = $_POST['nombre'];
			$apellido = $_POST['ape'];
			$fecha = $_POST['fecha_naci'];
			$salario = $_POST['salario'];
			$departamento = $_POST['departamento'];
			$hoy=date("Y-n-d");
			var_dump($fecha);
			
			
			$insert_value1="INSERT INTO `empleado`(`dni`, `nombre`, `apellidos`, `fecha_nac`, `salario`) VALUES ('$dni', '$nombre', '$apellido', '$fecha', '$salario');";
			
			$codigo="select cod_dpto from departamento where nombre_dpto='$departamento';";
			$idk=mysqli_query($conn,$codigo);
			$fila=mysqli_fetch_assoc($idk);
			$codigo_dep=$fila['cod_dpto'];
			
			$insert_value2="INSERT INTO emple_depart (dni, cod_dpto, fecha_ini, fecha_fin) VALUES ('$dni', '$codigo_dep', '$hoy','');";
			$resultado1=mysqli_query($conn, $insert_value1);
			
			$resultado2=mysqli_query($conn, $insert_value2);
			var_dump($resultado2);
			if ($resultado1){
				$conn->query($insert_value1);
				echo "New record created successfully(Empleado)</br>";
			}else{
				echo "Don't create";
			}
			
			if ($resultado2){
				$conn->query($insert_value2);
				echo "New record created successfully(emple_depart)</br>";
			}else{
				echo "Don't create";
			}

		}
		?>
		<?php
		// Funciones utilizadas en el programa
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
