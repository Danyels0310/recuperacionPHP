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
    <h1 class="text-center">CONSULTA CALIFICACIONES ALUMNOS</h1>

    <div class="container ">
        <!--Aplicacion-->
        <div id="App" class="row pt-6">
            <div class="col-md4-">
                <div class="card">
                    <div class="card-header">
                        Datos Alumno
                    </div>
                    <form id="product-form" name="" action="r23_consulta.php" method="POST" class="card-body">
						<div class="form-group">
                            <input type="text" name="DNI" placeholder="DNI" class="form-control">
                        </div>
						
						<div class="form-group">
						<select name="modulo">
							   <option value="4" selected>DAW</option> 
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
$Dni="";
if(empty($_POST['DNI'])){
	$DNI="";
}else{
	$DNI = $_POST['DNI'];
}
$F = file ('Alumnos.txt');
$comprobar = true;
if(empty($_POST['modulo'])){
	$Asignatura="";
}else{
	$Asignatura = intval($_POST['modulo']);
}
//Obtener la consulta
foreach ($F as $linea => $value){
	$Alumno = explode ('-',$value);
	$Dni = $Alumno[0];
	unset ($Alumno[0]);
	$Alumno=array_values($Alumno);
	$Alumnos[$Dni]=$Alumno;
	array_push($Dnis,$Dni);
} 
//mostrar la consulta
if(empty($DNI)){
	echo "Introduzca un DNI";
}else{
	foreach ($Dnis as $linea => $value){
		if ($value == $DNI){
			$comprobar=$comprobar && false;
		}
	}
	echo "La nota del alumno ".$Alumnos[$DNI][0]." ".$Alumnos[$DNI][1]." ".$Alumnos[$DNI][2]." es de ".$Alumnos[$DNI][$Asignatura];
}
?>


</body>

</html>