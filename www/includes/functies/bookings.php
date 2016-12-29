<?php 
function getBookings(){
	try {		
		require "includes/connectie.php";
		$sql = "SELECT nummer, klasse, familienaam, aantal, checkin, checkout FROM kamers, gasten, geboekt WHERE geboekt.gast_id=gasten.gasten_id AND geboekt.kamers_id=kamers.id ORDER BY checkout";
		$stmt = $db->prepare($sql);	
		$stmt->execute();
		$result = $stmt->fetchAll();
		$db=null;
		return $result;
	} catch (PDOException $e) {
		echo $e;
	}
}


function writeRoomGuestLinkTable($bookings,$klasses){
	foreach($bookings as $booking){
		$kamer_nummer = $booking["nummer"];
		$kamer_klasse = $booking["klasse"];
		$gast_fnaam = $booking["familienaam"];
		$gast_aantal = $booking["aantal"];
		$gast_checkin = $booking["checkin"];
		$gast_checkout = $booking["checkout"];
		
		//checken of te check-out datum gelijk is aan de datum van vandaag
		$checkoutTimestamp =  date("Y-m-d", strtotime($gast_checkout));
		$today = date("Y-m-d");
		if($checkoutTimestamp == $today){
			$tr = "<tr style='background-color: rgba(255,255,180,0.8)'>";
		}else if($checkoutTimestamp <= $today){
			$tr = "<tr style='background-color: rgba(255,180,180,0.8)'>";
		}else{
			$tr  = "<tr>";
		}

		//de $kamer_klasse geeft ID terug van tabel klasseopties -> via ID de naam van de klasse opzoeken
		$tr .= "<td>".$kamer_nummer."</td>";
		foreach($klasses as $klasse){
			$klasse_id = $klasse["klasse_id"];
			$klasse_naam = $klasse["naam"];
			if($klasse_id == $kamer_klasse){
				$tr .= "<td>".$klasse_naam."</td>";		
			}
		}
		$tr .= "<td>".$gast_fnaam."</td>";
		$tr .= "<td>".$gast_aantal."</td>";
		$tr .= "<td>".$gast_checkin."</td>";
		$tr .= "<td>".$gast_checkout."</td>";
		$tr .= "</tr>";
		echo $tr;
	}
}
 ?>