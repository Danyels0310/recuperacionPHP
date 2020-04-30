<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
</head>

<body >
    <h1 class="text-center">CONSULTA EXPEDIENTES ALUMNOS</h1>

    <div class="container ">
        <div id="App" class="row pt-6">
            <div class="col-md4-">
                <div class="card">
                    <div class="card-header" >
                        Curso Académico
                    </div>
                    <form id="product-form" name="" action="r23_expedientes.php" method="POST" class="card-body" >
						<div class="form-group" >
                            <input type="text" name="CURSOACADEMICO" placeholder="CURSOACADEMICO" class="form-control">
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
foreach ($Dnis as $linea => $value){
	if ($Alumnos[$value][3]==$curso){
	echo "<table border='1' align='center'>
		<tr align='center'><td>DNI</td> <td>DAW</td> <td>DWES</td> <td> DI </td> <td>DWEC</td> <td>Ingles</td> <td>FOL</td> <td>FCT</td> <td>Proyecto</td></tr>
		<tr align='center'><td>$value</td> <td>".$Alumnos[$value][4]."</td> <td>".$Alumnos[$value][5]."</td> <td>".$Alumnos[$value][6]."</td> <td>".$Alumnos[$value][7]."</td> <td>".$Alumnos[$value][8]."</td> <td>".$Alumnos[$value][9]."</td> <td>".$Alumnos[$value][10]."</td> <td>".$Alumnos[$value][11]."</td></tr>
	</table>";}
}

?>


</body>

</html>