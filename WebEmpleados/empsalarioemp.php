<html>
	<head>
		<meta charset="UTF-8">
		<title>Modificar Salario</title>
	 
	</head>

	<body>
		<h1>Modificar Salario</h1>
		<?php
		include('conectar.php');


		/* Se muestra el formulario la primera vez */
		if (!isset($_POST) || empty($_POST)) { 
			
			$empleados= obtenerEmpleado($conn);  
			/* Se inicializa la lista valores*/
			echo '<form action="" method="post">';
			
		?>
		Porcentaje <input type='text' name='porcentaje' value='' size=25></br> 
		<div>
		<label for="empleado">Empleado:</label>
		<select name="empleado">
			<?php foreach($empleados as $empleado) : ?>
				<option> <?php echo $empleado ?> </option>
			<?php endforeach; ?></br>
		</select>
		</div>
	
			
		<?php
			echo '<div><input type="submit" value="Buscar producto"></div>
			</form>';
		} else { 
			$dni=$_POST["empleado"];
			$porcentaje=$_POST["porcentaje"];
			if($porcentaje==""){
				trigger_error('El porcentaje no puede estar vacio');	
			}
			
			$select_value="SELECT salario from empleado WHERE dni='$dni';";
			$idk=mysqli_query($conn,$select_value);
			$fila=mysqli_fetch_assoc($idk);
			$salario=$fila['salario'];
			
			if ($porcentaje[0]=="-"){
				echo "Se le va hacer una reducción del ".substr($porcentaje, 1)."%";
			}else{
				echo "Se le va hacer un aumento del ".$porcentaje."%";
			}
			
			$newSalario=$salario*(1+($porcentaje/100));
			
			$update_value="UPDATE empleado set salario='$newSalario' WHERE dni='$dni';";
			$resultado=mysqli_query($conn, $update_value);
			var_dump($resultado);
			if ($resultado){
				echo "El salario del empleado ".$dni." cambia a ".$newSalario."</br>";
			}else{
				echo "Don't update</br>";
			}
		}
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
		?>
	</body>
</html>