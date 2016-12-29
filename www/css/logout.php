<?php 
session_start();
include "includes/connectie.php";
$user = $_SESSION['gebruikersnaam'];
$sql = "UPDATE login SET lastlogin = CURRENT_TIMESTAMP WHERE gebruikersnaam = '$user'";
$db->query($sql);
session_destroy();
header('location: login.php');