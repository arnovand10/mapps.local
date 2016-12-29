

<?php 
/*OPVULLEN VAN KAMER DATABASE MET RANDOM WAARDES
for($i=81;$i<=100;$i++){
	require "../includes/connectie.php";
	$rVrij = rand(0,1);
	$rPersonen = rand(1,8);
	$rBalkon = rand(0,1);
	$rBad = rand(0,1);
	$rAirco = rand(0,1);
	$rTelevisie= rand(0,1);
	$rWifi = rand(0,1);
	$rMinibar = rand(0,1);
	
	try {
		
		$sql = "INSERT INTO kamers(nummer,vrij,personen,balkon,bad,airco,televisie,wifi,minibar)
			VALUES ('{$i}','{$rVrij}','{$rPersonen}','{$rBalkon}','{$rBad}','{$rAirco}','{$rTelevisie}','{$rWifi}','{$rMinibar}')";
		
		$stmt = $db->prepare($sql);
		$stmt->execute();
			
	} catch (PDOExecption $e) {
		echo $e;
	}
	$db=null;
}

*/
 ?>