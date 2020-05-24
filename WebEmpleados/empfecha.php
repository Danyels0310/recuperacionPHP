<html>
	<head>
		<meta charset="utf-8">
		<title>Fecha</title>
	</head>
	<body>
		<h1>Fecha</h1>
		<?php
		include('conectar.php');

		if (!isset($_POST) || empty($_POST)) { 
						 			
			/* Se inicializa la lista valores*/
			echo '<form action="" method="post">';
		?>
			Fecha <input type='date' name='fecha' value=''>
			
		<?php
			echo '<div><input type="submit" value="Crear Producto"></div>
			</form>';
		} else { 

			$fecha=$_POST["fecha"];
			if($fecha==''){ 
				trigger_error('La fecha no puede estar vacia');	
			}
			$selec_value="select empleado.nombre, empleado.apellidos, departamento.nombre_dpto from empleado,departamento,emple_depart where empleado.dni=emple_depart.dni and departamento.cod_dpto=emple_depart.cod_dpto and emple_depart.fecha_ini<='$fecha' and (emple_depart.fecha_fin>'$fecha' or emple_depart.fecha_fin='0000-00-00 00:00:00';";
			$resultado=mysqli_query($conn, $selec_value);
			var_dump($resultado);
			
			if ($resultado) {
				echo "<ul>";
				while ($row = mysqli_fetch_assoc($resultado)) {
				  $nombre=$row['nombre'];
				  $apellidos=$row['apellidos'];
				  $nombre_dpto=$row['nombre_dpto'];
				  echo "<li>EMPLEADO: ".$nombre." ".$apellidos.", DEPARTAMENTO=".$nombre_dpto."</li>";   
				}
				echo "<ul>";
			}else{
				echo "No se encontro ninguno en esa fecha.";
			}
		}
		?>
	</body>
</html>