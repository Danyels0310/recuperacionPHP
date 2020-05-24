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
			
			$departamentos= obtenerDepartamento($conn); 
			/* Se inicializa la lista valores*/
			echo '<form action="" method="post">';
			
		?>
	
		<div>
			<label for="departamento">Departamento:</label>
			<select name="departamento">
				<?php foreach($departamentos as $departamento) : ?>
					<option> <?php echo $departamento ?> </option>
				<?php endforeach; ?></br>
			</select>
			</div>
	
			
		<?php
			echo '<div><input type="submit" value="Buscar producto"></div>
			</form>';
		} else { 
			$departamento = $_POST['departamento'];
			$dnis=array();
			
			$codigo="SELECT cod_dpto FROM departamento WHERE nombre_dpto='$departamento';";
			$idk=mysqli_query($conn,$codigo);
			$fila=mysqli_fetch_assoc($idk);
			$codigo_dep=$fila['cod_dpto'];
			
			$sql="SELECT dni from emple_depart where cod_dpto='$codigo_dep'";
			$resultado=mysqli_query($conn, $sql);
			if ($resultado) {
				while($row = mysqli_fetch_assoc($resultado)) {
					$dnis[]=$row['dni'];
				}
			}
			if(count($dnis)==0){
				echo 'El Departamento esta vacio';
			}else{
				echo "<h3>Departamento de ".$departamento."</h3><ul>";
				foreach($dnis as $dni){
					$select_value="select nombre, apellidos from empleado inner join emple_depart on empleado.dni=emple_depart.dni where cod_dpto='$codigo_dep';";
					$resultado=mysqli_query($conn, $select_value);
					$fila=mysqli_fetch_assoc($resultado);
					$nombre=$fila['nombre'];
					$apellidos=$fila['apellidos'];
					
					
					echo "<li>".$nombre." ".$apellidos."</li>";
				}
				echo "</ul>";
			}	
		}
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