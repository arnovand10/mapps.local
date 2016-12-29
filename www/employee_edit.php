<?php 	
require "includes/functies/main.php";
require "includes/functies/employee.php";
standaardBeginCode();
 
 if(isset($_GET["edit_id"])){
 	$user = getLoginValuesById($_GET["edit_id"]);
 	$fnaam = $user["familienaam"];
 	$naam = $user["naam"];
 	$gebruikersnaam = $user["gebruikersnaam"];
 	$wachtwoord = $user["wachtwoord"];
 	$foto = $user["foto"];
 	$admin = $user["admin"];
 	$_SESSION["foto"]=$foto;
 }

if(isset($_POST["submit"])){
	$id = $_GET["edit_id"];
	$fnaam = $_POST["addFamilienaam"];
	$naam = $_POST["addNaam"];
	$gebruikersnaam = $_POST["addGebruikersnaam"];
	$wachtwoord = $_POST["addWachtwoord"];
	$image = $_FILES["addFoto"]["name"];
	$imageExtension = end((explode(".",$image)));
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
		//check of gebruikersnaam al in gebruik is
		$result = checkUsernameAvailableWithId($id,$gebruikersnaam);
		if($result==false){
			$message = "De gebruikersnaam is al in gebruik.";
		}else{
			//als er geen nieuwe afbeeling geselecteerd is -> gebruik de oude
			if(empty($image)){
				updateUser($id, $gebruikersnaam,$wachtwoord,$fnaam,$naam,$_SESSION["foto"],$admin);
			$message = "De gebruiker is aangepast.";
			unset($_SESSION["foto"]);
			}else{
				$target_dir = "uploads/";
				$target_file = $target_dir . $uniqueImageName;
				move_uploaded_file($_FILES["addFoto"]["tmp_name"],$target_file);
				updateUser($id, $gebruikersnaam,$wachtwoord,$fnaam,$naam,$foto,$admin);
				$message = "De gebruiker is aangepast.";	
			}
		}
		
	}else{
		$message = "Alle velden moeten ingevuld zijn.";
	}
}

 ?>

 <div class="content">	
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="form-horizontal checkIn" enctype="multipart/form-data">
 			<h4>Gebruiker Aanpassen</h4>
		<div class="form-group">
			<label for="addFamilienaam" class="control-label col-sm-4">Familienaam: </label>
			<div class="col-sm-8">
				<input type="text" name="addFamilienaam" class="form-control" value="<?php echo isset($fnaam) ? $fnaam : '' ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="addNaam" class="control-label col-sm-4">Naam: </label>
			<div class="col-sm-8">
				<input type="text" name="addNaam" class="form-control" value="<?php echo isset($naam) ? $naam : '' ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="addGebruikersnaam" class="control-label col-sm-4">Gebruikersnaam: </label>
			<div class="col-sm-8">
				<input type="text" name="addGebruikersnaam" class="form-control" value="<?php echo isset($gebruikersnaam) ? $gebruikersnaam : '' ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="addWachtwoord" class="control-label col-sm-4">Wachtwoord: </label>
			<div class="col-sm-8">
				<input type="text" name="addWachtwoord" class="form-control" value="<?php echo isset($wachtwoord) ? $wachtwoord : '' ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="addFoto" class="control-label col-sm-4">Foto:</label>
			<div clas="col-sm-8">
				<input type="file" class="form-control-file col-sm-8	" id="addFoto" name="addFoto" value="<?php echo isset($foto) ? $foto : '' ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="addAdmin" class="control-label col-sm-4">Admin:</label>
			<div class="checkbox col-sm-1">
				<label >
				<?php
					//checkbox in php toevoegen zodat de checkbox value kan onthouden worden
					$checkbox = "<input type='checkbox' name='addAdmin'";
					if($admin==1){
						$checkbox .= "checked";
					}
					$checkbox .= ">";
					echo $checkbox;
				?>
				</label>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<input type='submit' name='submit' value='Aanpassen' class='btn btn-default form-control'>
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