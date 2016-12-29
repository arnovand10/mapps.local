<?php 
require "includes/functies/main.php";
require "includes/functies/checkin.php";
standaardBeginCode();
if($_SESSION['login']==false){
	header('location: login.php');
}


$datum = date("Y-m-d H:i:s");
$message = null;


if(isset($_POST["submit"])){
	$vnaam = $_POST["voornaam"];
	$fnaam = $_POST["familienaam"];
	$aantal = $_POST["aantal"];
	$klasse = $_POST["klasse"];
	$checkOut = $_POST["outDatum"];
	if(!empty($vnaam)&&!empty($fnaam)&&!empty($aantal)&&!empty($klasse)){
		//check of de checkout datum > dan checkinDatum
		$isFuture = checkDatum($datum,$checkOut);
		if($isFuture == true){
			// zoek een geschikte kamer.
			$room = getAvailableRoom($aantal,$klasse);		
			$nummer = $room["nummer"];
			if($nummer!=null){
				//gast toevoegen;
				addGuest($vnaam,$fnaam,$aantal,$datum,$checkOut);
				//vrij op 0 zetten
				updateVrij($nummer);
				//gast id en kamer id aan elkaar linken
				linkRoomToGuest($nummer,$vnaam,$fnaam);
				$message = "{$vnaam} {$fnaam} werd ingecheckt in kamer {$nummer}.";
			}
			else{
				$message=  "Geen geschikte kamer gevonden.";
			}
		}
		else{
			$message = "Check-out kan enkel later dan Check-in.";
		}
			
	}
	else{
		$message = "Alle waardes moeten ingevuld zijn.";
	}
}



?>
<div class="content checkin">
	<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" class="form-horizontal checkIn">
		
		<div class="form-group">
			<label for="familienaam" class="control-label col-sm-4">Familienaam: </label>
			<div class="col-sm-8">
				<input type="text" name="familienaam" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="voornaam" class="control-label col-sm-4">Voornaam: </label>
			<div class="col-sm-8">
				<input type="text" name="voornaam" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="aantal" class="control-label col-sm-4">Aantal personen: </label>
			<div class="col-sm-8">
				<input type="number" name="aantal" class="form-control" id="aantalPersonen">
			</div>
		</div>
		<div class="form-group">
			<label for="kamer" class="control-label col-sm-4">Klasse: </label>
			<div class="col-sm-8">
				<select name="klasse" id="klasse" class="form-control">
					<?php 
						$klasses = getClasses();
						foreach($klasses as $klasse){
							$klasse_naam = $klasse["naam"];
							$html .= '<option value="'.$klasse["klasse_id"].'">'.$klasse_naam.'</option>';
						}
						echo $html;
					?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="kamer" class="control-label col-sm-4">Kamer: </label>
			<div class="col-sm-8">
				<input type="text" name="kamer" class="form-control" disabled>
			</div>
		</div>
		<div class="form-group">
			<label for="datum" class="control-label col-sm-4">Check-in Datum: </label>
			<div class="col-sm-8">
				<?php 
					
					//wordt in php toegevoegd anders is value ""
					$datumInput = "<input type='text' value='$datum' name='datum' disabled class='form-control'> ";
					echo $datumInput;
				?>
			</div>
		</div>
		<div class="form-group">
			<label for="outDatum" class="control-label col-sm-4">Check-out Datum: </label>
			<div class="col-sm-8">
				<input type="date" name="outDatum" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<input type="submit" name="submit" class="form-control" value="Check-In">
			</div>
			<div class="col-sm-4">
				<a href="index.php" class="form-control">Terug</a>
			</div>
		</div>
		<?php
		if(!empty($message)){
		echo "<div class='form-group'><div class='message col-sm-offset-4 col-sm-8'><p class='form-control'>{$message}</p></div></div>";
		}
		?>
	</form>
</div>

<?php require "includes/footer.php"; ?>