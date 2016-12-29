<!--***** ALLE FUNCTIES IN GUESTS.PHP  *****-->
<?php 
function getGuests(){
	require "includes/connectie.php";
	try {
		$sql = "SELECT * FROM gasten ORDER BY familienaam, voornaam";
		$stmt = $db->prepare($sql);
		$stmt -> execute();
		$result = $stmt->fetchAll();
		return $result;	
	} catch (PDOExpression $e) {
		$e;
	}
}

function writeGuests($gasten){
	$isAdmin=$_SESSION["admin"];
	foreach($gasten as $gast){
		$gast_id = $gast["gasten_id"];
		$gast_voornaam = $gast["voornaam"];
		$gast_familienaam = $gast["familienaam"];
		$gast_aantal = $gast["aantal"];
		$gast_checkin = $gast["checkin"];
		$gast_checkout = $gast["checkout"];
		$gast_checkedOutAt = $gast["checkedOutAt"];

		$tr = "<tr>";
		//als amdin is -> admin optis weergeven
		if($isAdmin!=null){
			//id van de persoon meegeven aan pencil.
			$tr .= "<td>";
			$tr .= "<a href='guest_edit.php?edit_id=".$gast_id."'>
					<i class='glyphicon glyphicon-pencil'></i>
				</a>";
			
			$tr.="</td>";	
		}
		$tr .= "<td>".$gast_familienaam."</td>";
		$tr .= "<td>".$gast_voornaam."</td>";
		$tr .= "<td>".$gast_aantal."</td>";
		$tr .= "<td>".$gast_checkin."</td>";
		$tr .= "<td>".$gast_checkout."</td>";
		$tr .= "<td>".$gast_checkedOutAt."</td>";
		$tr .= "</tr>";
		echo $tr;
	}
 }

 function getGuestById($id){
 	try {
 		require "includes/connectie.php";
 		$sql = "SELECT * FROM gasten WHERE gasten_id = $id";
 		$stmt = $db->prepare($sql);
 		$stmt -> execute();
 		$result = $stmt->fetch();
 		$db = null;
 		return $result;
 	} catch (PDOExeption $e) {
 		echo $e;
 		
 	}
 }

 function editGuests($id, $gast_vn,$gast_fn,$gast_aantal,$gast_checkout){
 	try {
 		require "includes/connectie.php";
 		$checkoutTimestamp =  date("Y-m-d H:i:s", strtotime($gast_checkout));
 		$sql = "UPDATE gasten SET voornaam='$gast_vn', familienaam='$gast_fn', aantal=$gast_aantal, checkout='$checkoutTimestamp' WHERE gasten_id=$id";
 		$stmt = $db->prepare($sql);
 		$stmt->execute();
 		$db=null;
 		return "Wijzegingen opgeslagen!";
 	} catch (PDOExeption $e) {
 		echo $e;
 	}
 }

 function getLinkedRoomIdByGuestId($id){
 	try {
 		require "includes/connectie.php";
 		$sql =  "SELECT  kamers_id FROM geboekt WHERE gast_id = $id";
 		$stmt = $db->prepare($sql);
 		$stmt -> execute();
 		$result = $stmt->fetch();
 		$db =null;
 		return $result;
 	} catch (PDOExeption $e) {
 		echo $e;
 	}
 }

 function getRoomById($id){
 	try {
 		require "includes/connectie.php";
 		$sql = "SELECT * FROM kamers WHERE id=$id";
 		$stmt = $db->prepare($sql);
 		$stmt -> execute();
 		$result = $stmt->fetch();
 		$db =null;
 		return $result;
 	} catch (PDOExeption $e) {
 		echo $e;
 	}
 }
 ?>
