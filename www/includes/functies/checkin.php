<!--- ALLE FUNCTIES CHECKIN.PHP -->

<?php 
function getAvailableRoom($aantal,$klasse){
	require "includes/connectie.php";
	try {
		//zoeken naar een vrije kamer met juiste klasse
		$sql = " SELECT nummer FROM kamers, klasseopties WHERE klasse_id = $klasse AND vrij = 1 AND personen>=$aantal ORDER BY personen";
		$stmt = $db->prepare($sql);
		$stmt -> execute();
		$result = $stmt->fetch();
		$db=null;
		return $result;
	} catch (PDOException $e) {
		echo $e;
	}
}

function checkDatum($dateIn, $dateOut){
	$inTimestamp =  date("Y-m-d", strtotime($dateIn));
	$outTimestamp =  date("Y-m-d", strtotime($dateOut));
	if($outTimestamp>$inTimestamp){
		return true;
	}else{
		return false;
	}
}

function addGuest($vnaam,$fnaam,$aantal,$datum,$checkout){
	require "includes/connectie.php";
	/*$checkoutDatum = str_split("/",$checkout);
	$checkoutDag = $checkoutDatum[0];
	$checkoutMaand = $checkoutDatum[1];
	$checkoutJaar = $checkoutDatum[2];*/

	$checkoutTimestamp = $inTimestamp =  date("Y-m-d H:i:s", strtotime($checkout));;
	try {
		// gast toevoegen in database gasten
		$sql1 = "INSERT INTO gasten (voornaam, familienaam, aantal, checkin, checkout) VALUES(:vnaam,:fnaam,:aantal,CURRENT_TIMESTAMP,:checkout) ";
		$stmt = $db->prepare($sql1);
		$stmt -> bindParam(':vnaam',$vnaam);
		$stmt -> bindParam(':fnaam',$fnaam);
		$stmt -> bindParam(':aantal',$aantal);
		$stmt -> bindParam(':checkout',$checkoutTimestamp);
		$stmt -> execute();
		$db = null;
	} catch (PDOException $e) {
		echo $e;
	}
}

function updateVrij($nummer){
	try {
		require "includes/connectie.php";
		//gekozen kamer van vrij = 1 naar vrij = 0
		$sql3 = "UPDATE kamers SET vrij=0 WHERE nummer = {$nummer}";
		$stmt = $db->prepare($sql3);
		$stmt -> execute();
		$db = null;
	} catch (PDOException $e) {
		echo $e;
	}
}

function linkRoomToGuest($nummer,$vnaam,$fnaam){
	try {
		require "includes/connectie.php";
		//gast id en kamer id ophalen
		$sql4 = "SELECT id, gasten_id FROM kamers, gasten WHERE nummer = '$nummer' AND familienaam = '$fnaam' AND voornaam = '$vnaam'";
		$stmt = $db->prepare($sql4);
		$stmt->execute();
		$ids = $stmt->fetch();
		$id = $ids["id"];
		$gasten_id = $ids["gasten_id"];
		//gast id aan kamer id toevoegen in geboekt tabel
		$sql5 = "INSERT INTO geboekt(kamers_id, gast_id) VALUES ($id,$gasten_id)";
		$stmt = $db->prepare($sql5);
		$stmt -> execute();
		$db = null;	
	} catch (PDOException $e) {
		echo $e;
	}
}

 ?>