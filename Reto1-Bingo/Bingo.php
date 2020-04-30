<HTML>
	<HEAD> <TITLE> Bingo </TITLE> </HEAD>
	<BODY>
	<?php
	
	echo "<h1 align='center'>Bingo con funciones</h1>";
	
	//Variables
	$njug=["J1","J2","J3","J4"];
	$jugador=array("", array(0));
	$contador=array("", array(0));
	$a=0;
	$win=0;
	$fin=false;
	
	//Funciones:
	
	//Funcion rellenar
	function rellenarArrays(){
		$rellenar[0]=rand(1,60);
		for ($i=1;$i<15;$i++){
			$comprobar=rand(1,60);
			while(in_array($comprobar,$rellenar)){
			$comprobar=rand(1,60);}
			$rellenar[$i]=$comprobar;
		}
		sort($rellenar);
		return $rellenar;
	}
	
	//Funcion de rellenar bolas.
	$numb=60;//<---Aqui puedes poner el numero de bolas que quieras.
	function rellenarBolas($numb){
		$bolas[0]=rand(0,$numb);											
		for ($i=0;$i<$numb;$i++){
			do{$comprobar=rand(1,$numb);
			}while(in_array($comprobar,$bolas));
			$bolas[$i]=$comprobar;
		}
	return $bolas;
	}
	
	// Funcion mostrar bolas
	
	//Rellenamos todos los arrays de todos los jugadores
	for($r=0;$r<count($njug);$r++){
	echo "<h4 align='center'>$njug[$r]</h4>";
	echo "<table border='1' align='center'>";
		for($x=0;$x<3;$x++){
			$jugador [$njug[$r]][$x]=rellenarArrays();
			
			//Mostramos por pantalla
			echo "<tr><td align='center' colspan='15'>".($x+1)." carton </td></tr>";
			echo "<tr>";
			for ($i=1;$i<15;$i++){
				echo "<td align='center'>";
				echo $jugador[$njug[$r]][$x][$i];
				echo "</td>";
			}
			echo"</tr>";
		}
		echo "</table>";
	}
	
	//Jugar
	for($r=0;$r<count($njug);$r++){		
		for ($x=0;$x<3;$x++){
			$contador[$njug[$r]][$x]=0;
		}
	}

	$bolas=rellenarBolas($numb);
	while($a<count($bolas) && $fin==false){
	//Incrementar contadores
		for($i=0;$i<15;$i++){
			for($r=0;$r<count($njug);$r++){
				for ($x=0;$x<3;$x++){
					if($jugador[$njug[$r]][$x][$i]==$bolas[$a])
						$contador[$njug[$r]][$x]+=1;
				}
				//Comprobar quien llega primero a 15
				for ($x=0;$x<3;$x++){
					if ($contador[$njug[$r]][$x]==15){
						$win=$r;
						$fin=true;
					
					}
				}
			}
		}
		
		if($fin){
		echo "<h3 align='center'>".$njug[$win]." ha ganado</h3>";
		}
		$a++;
	}
	
?>
	</BODY>
	</HTML>