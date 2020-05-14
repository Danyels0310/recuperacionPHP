<html>
<head><meta charset="utf-8"></head>
<body>
<?php
$baraja=array('1P','1D','1T','1C','2P','2D','2T','2C','3P','3D','3T','3C','4P','4D','4T','4C','5P','5D','5T','5C','6P','6D','6T','6C','7P','7D','7T','7C','8P','8D','8T','8C','9P','9D','9T','9C','10P','10D','10T','10C','JP','JD','JT','JC','QP','QD','QT','QC','KP','KD','KT','KC');
$repartir=repartirCartas($baraja);
$jugadores=cartasJugador($repartir);


function repartirCartas($baraja){
	shuffle($baraja); //barajamos la baraja
	
	for ($i=0; $i<11; $i++){
		$repartir[]=array_shift($baraja); //cogemos los 11 primeros ya que son cuatro jugadores y cada jugador tiene dos cartas, las tres restantes son de la mesa
	}
	return $repartir;
}

function cartasJugador($repartir){
	for ($i=0; $i<4; $i++){
		$j=$i*2; $cont=0;
		while($cont<2){	
		$jugador[$cont]=$repartir[$j+$cont];
		$cont++;
		}
		$jugador[2]=$repartir[8];
		$jugador[3]=$repartir[9];
		$jugador[4]=$repartir[10];
		$jugadores[$i]=$jugador;
	}
	return $jugadores;
}

function mostrarCartas($jugadores){
	echo "<table border='1'>";
	for ($i=0; $i<4; $i++){	
		echo "<tr align='center'><th>Jugador ".($i+1)."</th></tr><tr><td>";
		for($j=0; $j<5;$j++){
			echo "<img width='50px' src='images/".$jugadores[$i][$j].".png'>" ;
		}
		echo "</td></tr>";
	}
	echo "</table>";
}

function keys($array){
	$r=array_keys($array);
	return $r[0];
}
function mostrarJugada($jugadores){	
	for ($i=0; $i<4;$i++){
		for ($j=0; $j<5;$j++){
		$jugadores[$i][$j] = trim($jugadores[$i][$j], "CDPT"); 
			if($jugadores[$i][$j]=="J"){
				$jugadores[$i][$j]="11";
			}
			if($jugadores[$i][$j]=="Q"){
				$jugadores[$i][$j]="12";
			}
			if($jugadores[$i][$j]=="K"){
				$jugadores[$i][$j]="13";
			}
			if($jugadores[$i][$j]==1){
				$jugadores[$i][$j]="14";
			}
		}
		//ordenamos los valores y contamos los repetidos
		rsort($jugadores[$i]);
		$ordenado[$i]=array_count_values($jugadores[$i]);
		$primero=keys($ordenado[$i]);
		//mostramos los resultados
		if (sizeof($ordenado[$i])==5){
			echo "La carta más alta del jugador ".($i+1)." es ";
			foreach($ordenado[$i] as $num => $rep) {
				if($primero==11){
					echo "J</br>";
					break;
				}else if($primero==12){
					echo "Q</br>";
					break;
				}else if($primero==13){
					echo "K</br>";
					break;
				}else if($primero==14){
					echo "A</br>";
					break;
				}else{
					echo $primero."<br>";
					break;
				}
			}
		}else if (sizeof($ordenado[$i])==4){
			echo "El jugador ".($i+1)." tiene una pareja<br>";
		}else if (sizeof($ordenado[$i])==3){
			foreach($ordenado[$i] as $num => $rep) {
				if($ordenado[$i][$num]==2){
					echo "El jugador ".($i+1)." tiene dobles parejas<br>";
					break;
				}
				if($ordenado[$i][$num]==3){
					echo "El jugador ".($i+1)." tiene un trio<br>";
				}
			}
		}else if (sizeof($ordenado[$i])==2){
			foreach($ordenado[$i] as $num => $rep) {
				if($ordenado[$i][$num]==4){
					echo "El jugador ".$i." tiene poker<br>";
				}else{
					echo "El jugador ".$i." tiene full<br>";
				}
			}
		}	
	}
	
}

mostrarCartas($jugadores);
mostrarJugada($jugadores);
?>
</body>
</html>

