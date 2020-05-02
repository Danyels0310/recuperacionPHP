<html>
<head></head>
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
			echo "<img src='images/".$jugadores[$i][$j].".png'>" ;
		}
		echo "</td></tr>";
	}
}
mostrarCartas($jugadores);

?>
</body>
</html>
