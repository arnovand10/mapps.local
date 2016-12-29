<!-- FUNCTIES DIE OVER VERSCHILLENDE PAGINAS GEBRUIKT WORDEN-->
<?php 
/******* STANDAARD BEGIN CODE *********/
function standaardBeginCode(){
	//maakt het mogelijk sessions te gebruiken
	session_start();

	//inladen van header/footer/navigatie
	require "includes/head.php";
	require "includes/nav.php";
	require "includes/footer.php";
}

//haalt alle waardes uit klasseopties tabel
function getClasses(){
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
}
?>