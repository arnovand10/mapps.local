<?php 
require "includes/functies/main.php";
require "includes/functies/employee.php";
standaardBeginCode();

$werknemers=getEmployees();


//delete
if (isset($_GET["delete_id"])) {
	$error = deleteUser($_GET["delete_id"]);
	$werknemers = getEmployees();
}

 ?>

 <div class="content">
 	<div class="adminoptions">
 		<a href="employee_add.php"><i class="glyphicon glyphicon-plus"></i></a> <?php if(!empty($error)){echo "<error>".$error."</error>";} ?>
 	</div>
		<table class="table table-bordered table-striped table-hover">
		<tr>
			<th><a href="">Opties</a></th>
			<th><a href="">Foto</a></th>
			<th><a href="">Familienaam</a></th>
			<th><a href="">Naam</a></th>
			<th><a href="">Gebruikersnaam</a></th>
			<th><a href="">Wachtwoord</a></th>
			<th><a href="">Admin</a></th>
		</tr>
		<?php 
			writeEmployeeTable($werknemers);
		 ?>
		 
 	</table>
	</form>
 </div>