<?php 
$nav = array(
	"index.php" => "Home",
	"guests.php" => "Gasten",
	"rooms.php" => "Kamers",
	"checkin.php" => "Check-In",
	"checkout.php" => "Check-Out",
	"bookings.php" => "Bezetting",
	"employee.php" => "Werknemers",
	"logout.php" => "Logout"
);

$navigatie = "<nav><ul>";
foreach($nav as $url => $titel){
	if(basename($_SERVER["PHP_SELF"])==$url){
		$navigatie .= "<li class='active'><a href='$url'>$titel</a></li>";
	}else if($_SESSION["admin"]!=true && $titel == "Werknemers"){
		$navigatie.="<li class='nohover'></li>";
	}
	else{
		$navigatie .= "<li><a href='$url'>$titel</a></li>";	
	}
}
$navigatie .= "</ul></nav>";
echo $navigatie;

?>