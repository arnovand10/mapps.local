<!-- ALLE FUNCTIES DIE ROOMS.PHP GEBRUIKT-->
<?php 
//haalt alle kamers uit de database
function getRooms(){
	require("includes/connectie.php");
	try {
		//kamers tabel uit database halen
		$sql = "SELECT id,nummer, vrij, personen, prijs, naam FROM kamers, klasseopties
		WHERE klasse = klasse_id
		GROUP BY id 
		ORDER BY nummer";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$db = null;
		return $result;	
	} catch (PDOException $e) {
		echo $e;
	}
}

//haalt alle waardes uit klasseopties tabel
/*function getClasses(){
	try {
		require "includes/connectie.php";
		$sql = "SELECT * FROM klasseopties";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$db = null;
		return $result;	
	} catch (PDOException $e) {
		echo $e;
	}
}*/


//query aanpassen aan filter waardes
function filterRooms(){
	require("includes/connectie.php");
	//waarders uit url halen
	$kamer = $_GET["kamer"];
	$personen = $_GET["personen"];
	$vrij = $_GET["vrij"];
	$klasse = $_GET["klasse"];
	$prijs = $_GET["prijs"];
	$prijs1 = $prijs-50;
	try {
		//gefilterde waardes uit tabel database halen
		$sql = "SELECT * FROM kamers, klasseopties WHERE ";
		if(!empty($kamer)){$sql .= "nummer='{$kamer}' AND ";}
		if(!empty($personen)){$sql .= "personen='{$personen}' AND ";}
		if(!empty($vrij)){$sql .= "vrij='{$vrij}' AND ";}
		if(!empty($klasse)){$sql .= "naam='{$klasse}' AND ";}
		if(!empty($prijs)){$sql .= "prijs<='{$prijs}'AND prijs>'{$prijs1}' AND ";}
		$sql .= "klasse = klasse_id AND ";
		$sql .= "TRUE ";
		$sql .= "GROUP BY nummer";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$filter = $stmt->fetchAll();
		$db=null;
		return $filter;
	} catch (PDOException $e) {
		echo $e;
	}
}

function writeRooms($result){
	$isAdmin = $_SESSION["admin"];
	//toevoegen rij
	$tr="<tr>";
	if($isAdmin!=null){
		//id van de kamer meegeven in de checkbox
		$tr .= "<td>";
		//enkel kamers die niet bezet zijn mogen verwijderd of aangepast worden.
		if($result["vrij"]==1){
			$tr .= "<a href='rooms.php?delete_id=".$result["id"]."'>
					<i class='glyphicon glyphicon-trash'></i>
				</a>
				<a href='rooms_edit.php?edit_id=".$result["id"]."'>
					<i class='glyphicon glyphicon-pencil'></i>
				</a>";
			
		}
		$tr.="</td>";
	}
	$tr.=	"<td>{$result["nummer"]}</td>
		<td>{$result["vrij"]}</td>
		<td>{$result["personen"]}</td>
		<td>{$result["naam"]}</td>
		<td>{$result["prijs"]} &euro;</td>
	</tr>";
	echo $tr;
}

function addRoom($nummer,$vrij,$personen,$prijs,$klasse){
	//kamer toevoegen aan database
	require "includes/connectie.php";
	try {
		$sql = "INSERT INTO kamers (nummer,vrij,personen,prijs,klasse)
	VALUES ('{$nummer}','{$vrij}','{$personen}','{$prijs}','{$klasse}')";
		$stmt = $db->prepare($sql);
		$stmt -> execute();
		$db = null;	
	} catch (PDOException $e) {
		echo $e;
	}
}

function checkRoomNumberAvailable($nummer){
	//checken of de kamer al bestaat;
	require "includes/connectie.php";
	try {
		$sql = "SELECT nummer FROM kamers WHERE nummer='$nummer'";
		$stmt = $db->prepare($sql);
		$stmt -> execute();
		$result = $stmt->fetch();
		$db = null;
		//result is een array -> in index [0] zit waarde van nummer
		if($result[0]!=null || $nummer<0){
			return false;
		}else{
			return true;
		}	
	} catch (PDOException $e) {
		echo $e;
	}
}

function removeRoom($id){
	//kamer verwijderen uit tabellen lijst
	require "includes/connectie.php";
	try {
		$sql = "DELETE FROM kamers WHERE id=$id";
		$stmt = $db->prepare($sql);
		$stmt -> execute();
		$db = null;
	} catch (PDOException $e) {
		echo $e;
	}
}

function editRoom($id,$nummer,$vrij,$personen,$klasse,$prijs){
	require "includes/connectie.php";
	try {
		$sql = "UPDATE kamers SET nummer=$nummer, vrij=$vrij, personen=$personen, klasse = $klasse, prijs=$prijs WHERE id=$id";
		echo $sql;
		$stmt = $db->prepare($sql);
		$stmt -> execute();
		$db = null;
	} catch (PDOException $e) {
		echo $e;
	}
}


function getRoomById($id){
	require "includes/connectie.php";
	try {
		$sql = "SELECT * FROM kamers WHERE id=$id";
		$stmt = $db->prepare($sql);
		$stmt -> execute();
		$result = $stmt->fetch();
		$db = null;
		return $result;
	} catch (PDOException $e) {
		echo $e;
	}
}


?>