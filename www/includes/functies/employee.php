<?php 

//*** EMPLOYEE.PHP ***
function getEmployees(){
	try {
		require "includes/connectie.php";
		$sql = "SELECT * FROM login ORDER BY familienaam";
		$stmt = $db->prepare($sql);
		$stmt -> execute();
		$result = $stmt->fetchAll();
		$db=null;
		return $result;
	} catch (PDOException $e) {
		
	}
}

function writeEmployeeTable($werknemers){
	foreach($werknemers as $werknemer){
		$foto = $werknemer["foto"];
		$fnaam = $werknemer["familienaam"];
		$naam = $werknemer["naam"];
		$gebruikersnaam = $werknemer["gebruikersnaam"];
		$wachtwoord = $werknemer["wachtwoord"];
		$admin = $werknemer["admin"];
		$tr  = "<tr class='werknemer-tr'>";
		$tr .= "<td class='options'><a href='employee.php?delete_id=".$werknemer["id"]."'>
					<i class='glyphicon glyphicon-trash'></i>
				</a>
				<a href='employee_edit.php?edit_id=".$werknemer["id"]."'>
					<i class='glyphicon glyphicon-pencil'></i>
				</a></td>";
		$tr .= "<td><img class='profilePic' src='uploads/".$foto."'></td>";
		$tr .= "<td>".$fnaam."</td>";
		$tr .= "<td>".$naam."</td>";
		$tr .= "<td>".$gebruikersnaam."</td>";
		$tr .= "<td>".$wachtwoord."</td>";
		$tr .= "<td>".$admin."</td>";
		$tr .= "</td>";
		echo $tr;
	}
}


function deleteUser($id){
	try {
		require "includes/connectie.php";
		$sql = "DELETE FROM login WHERE id='$id'";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		return "Gebruiker werd gedelete.";
	} catch (PDOException $e) {
		echo $e;
	}
}
//*** END EMPLOYEE.PHP


//*** START EMPLOYEE_ADD.PHP
function checkUsernameAvailable($gebruikersnaam){
	try {
		require "includes/connectie.php";
		$sql="SELECT * FROM login WHERE gebruikersnaam= '$gebruikersnaam'";
		$stmt = $db->prepare($sql);
		$stmt -> execute();
		$result = $stmt->fetch();
		$db =null;
		if($result==false){
			return true;
		}else{
			return false;
		}
	} catch (PDOException $e) {
		echo $e;
	}
 }

function addUser($gebruikersnaam,$wachtwoord,$naam,$fnaam,$foto,$admin){
	try {
		require "includes/connectie.php";
		$sql= "INSERT INTO login(gebruikersnaam,wachtwoord,admin,familienaam,naam,foto)
		VALUES ('$gebruikersnaam','$wachtwoord',$admin,'$fnaam','$naam','$foto')";
		$stmt = $db->prepare($sql);
		$stmt -> execute();
		$db=null;
		return "De gebruikrer is toegevoegd.";
	} catch (PDOException $e) {
		echo $e;
	}
}

//*** END EMPLOYEE_ADD.PHP


//*** START EMPLOYEE_EDIT.PHP
function getLoginValuesById($id){
	try {
		require "includes/connectie.php";
		$sql = "SELECT * FROM login WHERE id=$id";
		$stmt = $db->prepare($sql);
		$stmt -> execute();
		$result = $stmt->fetch();
		$db=null;
		return $result;
	} catch (PDOException $e) {
		echo $e;
	}
}

function checkUsernameAvailableWithId($id,$gebruikersnaam){
	try {
		require "includes/connectie.php";
		//zoek of de gebruikersnaam al bestaat EN check of de id!=mijn ID
		//maw als gebruikersnaam al bestaat maar het is mijngebruikersnaam dan mag ik ze wel nemen.
		$sql = "SELECT * FROM login WHERE gebruikersnaam='$gebruikersnaam' AND id!='$id'";
		$stmt = $db->prepare($sql);
		$stmt ->execute();
		$result = $stmt->fetch();
		$db=null;
		if($result ==false){
			return true;
		}else{
			return false;
		}
	} catch (PDOException $e) {
		echo $e;
	}
}

function updateUser($id,$gebruikersnaam,$wachtwoord,$fnaam,$naam,$foto,$admin){
	try {
		require "includes/connectie.php";
		$sql = "UPDATE login SET gebruikersnaam='$gebruikersnaam', wachtwoord='$wachtwoord', admin='$admin', familienaam='$fnaam', naam='$naam', foto='$foto' WHERE id='$id'";
		$stmt = $db->prepare($sql);
		$stmt -> execute();
		$db=null;
	} catch (PDOException $e) {
		echo $e;
	}
}


?>
