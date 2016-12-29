<?php 	
require "includes/functies/main.php";
require "includes/functies/employee.php";
standaardBeginCode();


//register knop
if(isset($_POST["toevoegen"])){
	$gebruikersnaam = $_POST["addGebruikersnaam"];
	$wachtwoord = $_POST["addWachtwoord"];
	$naam = $_POST["addNaam"];
	$fnaam = $_POST["addFamilienaam"];
	$image = $_FILES["addFoto"]["name"];
	$imageExtension = end(explode(".",$image));
	$imageName = explode($imageExtension,$image)[0];
	$uniqueImageName = $imageName.date("YddmmHis").".".$imageExtension;
	$foto = $uniqueImageName;
	
	if($_POST["addAdmin"]=="on"){
		$admin = 1;	
	}else{
		$admin = 0;
	}
	//check of alles ingevuld is
	if(!empty($gebruikersnaam)&&!empty($wachtwoord)&&!empty($naam)&&!empty($fnaam)&&!empty($foto)){
		//zoek in database of gebruikersnaam al in gebruik is;
		$result = checkUsernameAvailable($gebruikersnaam);
		//als naam gevonden is -> error
		if($result==false){
			$message = "Gebruikersnaam is al in gebruik";
		}else{
			$target_dir = "uploads/";
			$target_file = $target_dir . $uniqueImageName;
			move_uploaded_file($_FILES["addFoto"]["tmp_name"],$target_file);
			$message = addUser($gebruikersnaam,$wachtwoord,$naam,$fnaam,$foto,$admin);
		}
	}else{
		$message= "Alle velden moeten ingevuld zijn.";
	}
}



 ?>

 <div class="content">
 <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="form-horizontal checkIn col-sm-12" enctype="multipart/form-data">
 			<h4>Gebruiker toevoegen</h4>
		<div class="form-group">
			<label for="addFamilienaam" class="control-label col-sm-4">Familienaam: </label>
			<div class="col-sm-8">
				<input type="text" name="addFamilienaam" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="addNaam" class="control-label col-sm-4">Naam: </label>
			<div class="col-sm-8">
				<input type="text" name="addNaam" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="addGebruikersnaam" class="control-label col-sm-4">Gebruikersnaam: </label>
			<div class="col-sm-8">
				<input type="text" name="addGebruikersnaam" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="addWachtwoord" class="control-label col-sm-4">Wachtwoord: </label>
			<div class="col-sm-8">
				<input type="text" name="addWachtwoord" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="addFoto" class="control-label col-sm-4">Foto:</label>
			<div clas="col-sm-8">
				<input type="file" class="form-control-file col-sm-8	" id="addFoto" name="addFoto">
			</div>
		</div>
		<div class="form-group">
			<label for="addAdmin" class="control-label col-sm-4">Admin:</label>
			<div class="checkbox col-sm-1">
				<label ><input type="checkbox" name="addAdmin"></label>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<input type='submit' name='toevoegen' value='toevoegen' class='btn btn-default form-control'>
			</div>
			<div class="col-sm-4">
				<a href="employee.php" class="form-control">Terug</a>
			</div>
		</div>
		<?php
		if(!empty($message)){
		echo "<div class='form-group'><div class='message col-sm-offset-4 col-sm-8'><p class='form-control'>{$message}</p></div></div>";
		}
		?>
	</form>
</div>
