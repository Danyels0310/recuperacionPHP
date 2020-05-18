<html>
<head>
	<meta charset="utf-8">
	<style type="text/css">
		#pierde{color:red;}
		#empata{color:green;}
		#gana{color:blue;}
	</style>
</head>
<body>
<?php
$botes=bote();
$dinero=minimo($botes);
$apuestas=array($_POST["apuesta1"],$_POST["apuesta2"], $_POST["apuesta3"], $_POST["apuesta4"]);
if($dinero){ 
	$baraja=array('1P','1D','1T','1C','2P','2D','2T','2C','3P','3D','3T','3C','4P','4D','4T','4C','5P','5D','5T','5C','6P','6D','6T','6C','7P','7D','7T','7C','8P','8D','8T','8C','9P','9D','9T','9C','10P','10D','10T','10C','JP','JD','JT','JC','QP','QD','QT','QC','KP','KD','KT','KC');	
	shuffle($baraja); //barajamos la baraja

	for ($i=0; $i<5; $i++){	//cogemos 5 posiciones las 4 primeras son para los jugadores y la ultima par a la mesa
		$sum=0; $cont=0;$repartir=array();
		if ($i!=4){
			do{
				$valor=trim($baraja[0], "CDPT");
				if($valor=="J" ||$valor=="Q" || $valor=="K"){
					$sum+=10;
				}else if($valor==1 && $sum<15){
					$sum+=11;
				}else {
					$sum+=$valor;
				}
			$repartir[$cont]=$baraja[0]; 
			array_shift($baraja);
			$cont++;
			}while($sum<15);
		}else{
			do{
				$valor=trim($baraja[0], "CDPT");
				if($valor=="J" ||$valor=="Q" || $valor=="K"){
					$sum+=10;
				}else if($valor==1 && $sum<15){
					$sum+=11;
				}else {
					$sum+=$valor;
				}
			$repartir[$cont]=$baraja[0]; 
			array_shift($baraja);
			$cont++;
			}while($sum<17);
		}
		$cartas[$i]=($repartir);//en este array guardamos las cartas que se va a mostrar
		$puntos[$i]=$sum;//en este array guardamos las puntuaciones  de cada jugador y de la mesa
	}

	mostrarCartas($cartas, $puntos);
	$puntuacion=mostrarResultado($puntos, $apuestas, $botes);
	nuevoBote($puntuacion);
}else{
	echo "Uno de los jugadores tiene menos de 100€";
}	
//funcion que muestra las cartas y la puntuacion por pantalla
function mostrarCartas($cartas, $puntos){
	echo "<table border='1'>";
	for ($i=0; $i<5; $i++){	
		if ($i!=4){
		echo "<tr align='center'><th colspan='2'>Jugador ".($i+1)."</th></tr><tr><td>";
		}else{
		echo "<tr align='center'><th colspan='2'>Mesa</th></tr><tr><td>";
		}
		for($j=0; $j<sizeOf($cartas[$i]);$j++){
			echo "<img width='50px' src='images/".$cartas[$i][$j].".png'>" ;
		}
		echo "</td><td>Puntos: ".$puntos[$i]."</td></tr>";
	}
	echo "</table>";
}
// funcion que coge las puntuaciones de todos lo jugadores y de la mesa, y va comparando la putuación
// de cada jugador con la mesa y aplica la diferentes situaciones. y ademas crea un array para poder 
// ver como quedaría el saldo de caada jugador despues de cada jugada
function mostrarResultado($puntos, $apuestas, $botes){
	$puntuacion=array();
	for ($i=0; $i<4; $i++){	
		if ($puntos[4]<21){ //si la mesa tiene menos de 21
			if($puntos[4]>$puntos[$i]){
				echo "<div id='pierde'> El jugador ".($i+1)." pierde.</div>";
				$puntuacion[$i]=$botes[$i]-$apuestas[$i];
			}else if($puntos[4]==$puntos[$i]){
				echo "<div id='empata'>El jugador ".($i+1)." empata.</div>";
				$puntuacion[$i]=$botes[$i];
			}else if($puntos[4]<$puntos[$i] || $puntos[$i]>=21){
				echo "<div id='gana'>El jugador ".($i+1)." gana.</div>";
				$puntuacion[$i]=$botes[$i]+$apuestas[$i];
			}
		}else if ($puntos[4]>21){ //si la mesa tiene mas de 21
			if(21>$puntos[$i]){
				echo "<div id='pierde'>El jugador ".($i+1)." pierde.</div>";
				$puntuacion[$i]=$botes[$i]-$apuestas[$i];
			}else if(21<$puntos[$i]){
				echo "<div id='empata'>El jugador ".($i+1)." empata.</div>";
				$puntuacion[$i]=$botes[$i];
			}else if(21==$puntos[$i]){
				echo "<div id='gana'>El jugador ".($i+1)." gana.</div>";
				$puntuacion[$i]=$botes[$i]+$apuestas[$i];
			}
		}else if ($puntos[4]==21){ //si la mesa tiene 21
			if(21<$puntos[$i] || 21>$puntos[$i]){
				echo "<div id='pierde'>El jugador ".($i+1)." pierde.</div>";
				$puntuacion[$i]=$botes[$i]-$apuestas[$i];
			}else if(21==$puntos[$i]){
				echo "<div id='gana'>El jugador ".($i+1)." gana.</div>";
				$puntuacion[$i]=$botes[$i]+$apuestas[$i];
			}
		}
	}
	return $puntuacion;
}
//funcion que extrae del fichero saldo.txt el saldo de cada jugador y lo mete en un array
function bote(){
	$botes = Array();
	$fichero=file("saldo.txt");
	foreach($fichero as $clave => $valor){
		$bote = substr($valor, strpos($valor, "#")+1);
		array_push($botes, $bote);	
	}		
	return $botes;
}
//funcion que devuelve un boolean para ver si algún jugador tiene un saldo de  menos de 100
function minimo($botes){
	for ($i=0; $i<sizeOf($botes); $i++){
		if ($botes[$i]>100){
			$minimo=true;
		}else{
			$minimo=false;
		}
	}
	return $minimo;
}
//funcion que modifica el saldo de cada jugador
function nuevoBote($puntuacion){
	$cont = 1;
	$fichero = fopen("saldo.txt", "w");
	
	for($i = 0; $i < sizeOf($puntuacion); $i++){
		fwrite($fichero, "Jugador".($i+1)."#".$puntuacion[$i]."\n");
	}
}


?>
<form id="product-form" name="blackjack" action="blackjack.html" method="post">
<input type="submit" name="submit" value="Volver a jugar">
</from>
</body>
</html>