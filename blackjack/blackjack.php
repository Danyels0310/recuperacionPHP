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
/* $dinero=sueldo();
if($dinero){ */
	$apu1=$_POST["apuesta1"];
	$apu2=$_POST["apuesta2"];
	$apu3=$_POST["apuesta3"];
	$apu4=$_POST["apuesta4"];

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
		$cartas[$i]=($repartir);
		$puntos[$i]=$sum;
	}

	mostrarCartas($cartas, $puntos);
	mostrarResultado($puntos);
/* }else{
	echo "Uno de los jugadores tiene menos de 100€";
} */	

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

function mostrarResultado($puntos){
	for ($i=0; $i<4; $i++){	
		if ($puntos[4]<21){
			if($puntos[4]>$puntos[$i]){
				echo "<div id='pierde'> El jugador ".($i+1)." pierde.</div>";
			}else if($puntos[4]==$puntos[$i]){
				echo "<div id='empata'>El jugador ".($i+1)." empata.</div>";
			}else if($puntos[4]<$puntos[$i] || $puntos[$i]>=21){
				echo "<div id='gana'>El jugador ".($i+1)." gana.</div>";
			}
		}else if ($puntos[4]>21){
			if(21>$puntos[$i]){
				echo "<div id='pierde'>El jugador ".($i+1)." pierde.</div>";
			}else if(21<$puntos[$i]){
				echo "<div id='empata'>El jugador ".($i+1)." empata.</div>";
			}else if(21==$puntos[$i]){
				echo "<div id='gana'>El jugador ".($i+1)." gana.</div>";
			}
		}else if ($puntos[4]==21){
			if(21<$puntos[$i] || 21>$puntos[$i]){
				echo "<div id='pierde'>El jugador ".($i+1)." pierde.</div>";
			}else if(21==$puntos[$i]){
				echo "<div id='gana'>El jugador ".($i+1)." gana.</div>";
			}
		}
	}
}

function sueldo(){
	$nombre="saldo.txt";
	$archivo=fopen($nombre,"w+");
	$leer=fopen($nombre,"r");
	$jugar=false;
	if(file_exists($nombre)){
		while(!feof($fich)) {
			$texto=fgets($fich);
			$r=strpos($texto, '#');
			$cantidad=intval(substr($texto,$r+1));
			if ($cantidad>100){
				$jugar=true;
			}
		}
	}else{
		for ($i=1;$i<5;$i++){
			fwrite($archivo,"Jugador".$i."#".str_pad("1",4,"0",STR_PAD_RIGHT)."\n");
		}
	}
	return $jugar;
}




?>
<form id="product-form" name="blackjack" action="blackjack.html" method="post">
<input type="submit" name="submit" value="Volver a jugar">
</from>
</body>
</html>