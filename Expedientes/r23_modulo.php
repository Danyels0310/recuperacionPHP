<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
</head>

<body>
    <h1 class="text-center">CONSULTA CALIFICACIONES MÓDULO</h1>

    <div class="container ">
        <div id="App" class="row pt-6">
            <div class="col-md4-">
                <div class="card">
                    <div class="card-header">
                        Datos a introducir
                    </div>
                    <form id="product-form" name="" action="r23_modulo.php" method="POST" class="card-body">
						<div class="form-group">
                            <input type="text" name="CURSOACADEMICO" placeholder="CURSOACADEMICO" class="form-control">
                        </div>
						
						<div class="form-group">
						<select name="modulo">
							   <option value="4">DAW</option> 
							   <option value="5">DWES</option> 
							   <option value="6">DI</option>
							   <option value="7">DWEC</option> 
							   <option value="8">FOL</option> 
							   <option value="9">Inglés</option> 
							   <option value="10">FCT</option> 
							   <option value="11">Proyecto</option> 
						</select>
                        </div>
                        <input type="submit" value="Consulta" class="btn btn-outline-info btn-inline">
                        <input type="reset" value="Nueva Consulta" class="btn btn-outline-info btn-inline ml-5">
                    </form>
                </div>


            </div>

        </div>
        <br>


    </div>
<?php
//Variables
$Dnis=[];
$F = file ('Alumnos.txt');
if(empty($_POST['CURSOACADEMICO'])){
	$curso="";
}else{
	$curso =$_POST['CURSOACADEMICO'];
}
if(empty($_POST['modulo'])){
	$Asignatura="";
}else{
	$Asignatura = intval($_POST['modulo']);
}
$Asignaturas = array('DAW','DWES','DI','DWEC','FOL','Inglés','FCT','Proyecto');
//Obtener la consulta
foreach ($F as $linea => $value){
	$Alumno = explode ('-',$value);
	$Dni = ($Alumno[0]);
	unset ($Alumno[0]);
	$Alumno=array_values($Alumno);
	$Alumnos[$Dni] = $Alumno;
	array_push($Dnis,$Dni);
} 
//mostrar la consulta
foreach ($Dnis as $linea =>$value){
	if ($Alumnos[$value][3]==$curso){
		echo "<table border='1' align='center'>
		<tr align='center'><td> DNI </td><td>".$value."</td>";
		
		echo "</tr><tr><td>".$Asignaturas[$Asignatura-4]."</td>";
		switch ($Alumnos[$value][$Asignatura]){
			case 0:
			case 1:
			case 2:
			case 3:
			case 4:
				echo "<td>Insuficiente</td>";
				break;
			case 5:
				echo "<td>Suficiente</td>";
				break;
			case 6:
				echo "<td>Bien</td>";
				break;
			case 7:
			case 8:
				echo "<td>Notable</td>";
				break;
			case 9:
				echo "<td>Sobresaliente</td>";
				break;
			case 10:
				echo "<td>Matricula de honor</td>";
				break;
		}
		
	}

}
echo "</tr></table>";



?>


</body>

</html>