<?php 	
//gast id geven dmv kamer nummer
function getLinkedGuestIdByRoomNumber($nummer){
	try {
		require "includes/connectie.php";
		$sql = "SELECT id FROM kamers WHERE  nummer=$nummer";
		$stmt = $db->prepare($sql);
		$stmt -> execute();
		$result = $stmt->fetch();
		$kamers_id = $result["id"];

		$sql2 = "SELECT gast_id FROM geboekt WHERE kamers_id = $kamers_id";
		$stmt = $db->prepare($sql2);
		$stmt->execute();
		$result = $stmt->fetch();
		$db=null;
		return $result;
	} catch (	PDOExeption $e) {
		echo $e;
	}
	
}

function getGuestById($id){
	try {
		require "includes/connectie.php";
		$sql = "SELECT * FROM gasten WHERE gasten_id=$id";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();
		$db=null;
		return $result;	
	} catch (PDOExeption $e) {
		echo $e;
	}
 }

function checkoutGuest($fnaam,$nummer){
		$arrGast = getGuestByFname($fnaam);
		$gast_id = $arrGast["gasten_id"];
		//gast id verwijderen in geboekt tabel
		deleteGuestRoomLink($gast_id);

		//gast checkedOutAt updaten in gasten tabel
		updateCheckedOutAt($gast_id);
		//kamer weer vrij zetten
		updateKamerStatus($nummer);
}

function getGuestByFname($fnaam){
	try {
		require "includes/connectie.php";
		$sql = "SELECT * FROM gasten WHERE familienaam='$fnaam'";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();
		$db=null;
		return $result;
	} catch (PDOExeption $e) {
		echo $e;
	}
}

function deleteGuestRoomLink($id){
	try {
		require "includes/connectie.php";
		$sql="DELETE FROM geboekt WHERE gast_id=$id";
		$stmt = $db->prepare($sql);
		$stmt -> execute();
		$db=null;
	} catch (PDOExeption $e) {
		echo $e;
	}
}



function updateCheckedOutAt($id){
	try {
		require "includes/connectie.php";
		$sql= "UPDATE gasten SET checkedOutAt= CURRENT_TIMESTAMP WHERE gasten_id=$id";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$db=null;
	} catch (PDOExeption $e) {
		echo $e;
	}
}

function updateKamerStatus($nummer){
	try {
		require "includes/connectie.php";
		$sql = "UPDATE kamers SET vrij=1 WHERE nummer=$nummer";
		$stmt = $db->prepare($sql);
		$stmt ->execute();
		$db=null;
	} catch (PDOExeption $e) {
		echo $e;
	}
}

?>