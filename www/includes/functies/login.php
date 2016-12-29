<!-- ALLE FUNCTIES GEBRUIKT IN LOGIN.PHP -->
<?php
//zoekt alle waardes van de megegeven gebruiker
function vindGebruikerWaardes($gebruiker){
	require 'includes/connectie.php';
	$sql = "SELECT * FROM login WHERE gebruikersnaam = '$gebruiker'";
	$result = $db->query($sql);
	foreach($result as $key){
		$gevondenGebruiker = $key["gebruikersnaam"];
		$_SESSION["gebruikersnaam"] = $key["gebruikersnaam"];
		$_SESSION["lastlogin"] = $key["lastlogin"];
	}
	$db=null;
	return $gevondenGebruiker;
}

//zoekt in database naar het wachtwoord van de gebruiker
function vindGebruikerWachtwoord($gebruiker){
	require 'includes/connectie.php';
	$sql = "SELECT wachtwoord FROM login WHERE gebruikersnaam  = '$gebruiker'";
	$result = $db->query($sql);
	foreach($result as $key){
		$pass = $key["wachtwoord"];
	}
	$db = null;
	return $pass;
}

//controleer ingevoerde watchwoord en database wachtwoord
function checkGebruikerWachtwoord($txtWachtwoord,$dbWachtwoord){
	if($txtWachtwoord==$dbWachtwoord){
		//sessie login aanmaken zodat andere paginas toegankelijk worden.
		$_SESSION["login"]=true;
		return true;
	}else{
		//foutief wachtwoord
		return null;
	}
}

//controleer of admin is
function checkGebruikerAdmin($gebruiker){
	require "includes/connectie.php";
	$sql = "SELECT admin FROM login WHERE gebruikersnaam = '$gebruiker'";
	$result = $db->query($sql);
	foreach($result as $key){
		$isAdmin = $key["admin"];
	}
	$db=null;
	if($isAdmin==1){
		//je bent admin!
		$_SESSION["admin"]=true;
		return true;
	}else{
		//geen admin rechten
		return false;
	}
}
?>