<?php 
require "includes/functies/main.php";
standaardBeginCode();

if($_SESSION['login']==false){
	header('location: login.php');
}

 $user = $_SESSION["gebruikersnaam"];
 $date = $_SESSION["lastlogin"];
 $isAdmin = $_SESSION['admin'];

 $html = '<div class="content background-image background-image-index"></div>';
 $html .= "<div class='welcome content'>";
 $html .= "<h1>Welkom $user</h1>";
 if($isAdmin!=null){
 	$html.= "<strong>Ingelogd als admin</strong>";
 }
 $html .="<p>Last logout was: $date</p>";
 $html .="</div>";

 echo $html;