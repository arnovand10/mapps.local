<?php 
require "includes/functies/main.php";
require "includes/functies/guests.php";
standaardBeginCode();
$isAdmin = $_SESSION["admin"];
if($_SESSION['login']==false){
	header('location: login.php');
}
$gasten = getGuests();
?>
<!-- tabel met gasten -->
<div class="content">
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<?php 
				if($isAdmin!=null){
				$adminOptions = 
				'<th><a href="">Opties</th>';
				echo $adminOptions;
			}
			 ?>
			<th><a href="">Familienaam</a></th>
			<th><a href="">Voornaam</a></th>
			<th><a href="">Aantal</a></th>
			<th><a href="">Check-in</a></th>
			<th><a href="">Geplande Check-out</a></th>
			<th><a href="">Uitgecheckt op</a></th>
		</tr>
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
			<?php 
				writeGuests($gasten);
			 ?>
		</form>
	</table>
</div>