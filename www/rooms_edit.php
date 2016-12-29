<?php 
require "includes/functies/main.php";
require "includes/functies/rooms.php";
standaardBeginCode();


if(isset($_GET["edit_id"])){
	$id = $_GET["edit_id"];
	$kamer = getRoomById($id);
	$kamer_nummer = $kamer["nummer"];
	$kamer_vrij = $kamer["vrij"];
	$kamer_personen = $kamer["personen"];
	$kamer_klasse = $kamer['klasse'];
	$kamer_prijs = $kamer['prijs'];
	
}else{
	header("location: rooms.php");
}

if(isset($_POST["submit"])){
	$id = $_GET["edit_id"];
	$nummer = $_POST["nummer"];
	$vrij = "1";
	$personen = $_POST["personen"];
	$klasse = $_POST["klasse"];
	$prijs = $_POST["prijs"];
	if(!empty($id)&&!empty($nummer)&&!empty($vrij)&&!empty($personen)&&!empty($klasse)&&!empty($prijs)){
		editRoom($id,$nummer,$vrij,$personen,$klasse,$prijs);
		header("location: rooms.php");
	}
}

 ?>


 <div class="content">
	<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" class="form-horizontal checkIn">
		
		<div class="form-group">
			<label for="nummer" class="control-label col-sm-4">Kamer nummer: </label>
			<div class="col-sm-8">
				<input type="number" name="nummer" class="form-control" value="<?php echo $kamer_nummer ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="vrij" class="control-label col-sm-4">Vrij: </label>
			<div class="col-sm-8">
				<input type="number" name="vrij" class="form-control" value="<?php echo $kamer_vrij ?>" disabled>
			</div>
		</div>
		<div class="form-group">
			<label for="personen" class="control-label col-sm-4">Aantal personen: </label>
			<div class="col-sm-8">
				<select name="personen" id="personen" class="form-control">
					<?php
					$i=1;
					do{
						if($i == $kamer_personen){
							echo "<option value".$i." selected>".$i."</option>"	;
						}else{
							echo "<option value".$i.">".$i."</option>"	;
						}
						if($i==1){
							$i++;
						}else{
							$i+=2;
						}
						echo $i;
					}while($i<=8);
					 ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="klasse" class="control-label col-sm-4">Klasse: </label>
			<div class="col-sm-8">
				<select name="klasse" id="klasse" class="form-control">
					<?php 
						$klasses = getClasses();
						foreach($klasses as $klasse){
							if($kamer_klasse == $klasse["klasse_id"]){
								echo "<option value=".$klasse["klasse_id"]." selected>".$klasse["naam"]."</option>";	
							}else{
							echo "<option value=".$klasse["klasse_id"].">".$klasse["naam"]."</option>";
							}
						}
					 ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="prijs" class="control-label col-sm-4">Prijs: </label>
			<div class="col-sm-8">
				<input type="text" name="prijs" class="form-control" value="<?php echo $kamer_prijs; ?>">
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<input type="submit" name="submit" class="form-control" value="Wijzigingen opslaan">
			</div>
			<div class="col-sm-4">
				<a href="rooms.php" class="form-control">Terug</a>
			</div>
		</div>
		<?php
		if(!empty($message)){
		echo "<div class='form-group'><div class='message col-sm-offset-4 col-sm-8'><p class='form-control'>{$message}</p></div></div>";
		}
		?>
	</form>
</div>
