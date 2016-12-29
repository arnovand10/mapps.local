<?php 
require "includes/functies/main.php";
require "includes/functies/guests.php";
standaardBeginCode();


if(isset($_GET["edit_id"])){
	$id = $_GET["edit_id"];
	$gast = getGuestById($id);
	$gast_vn = $gast["voornaam"];
	$gast_fn = $gast["familienaam"];
	$gast_aantal = $gast["aantal"];
	$gast_gc = $gast["checkout"];
	//zet de Y-m-d H:i:s om naar Y-m-d die google gebruikt
	$gast_gc =  date("Y-m-d", strtotime($gast["checkout"]));
}else{
	header("location: guests.php");
}

if(isset($_POST["submit"])){
	$id = $_GET["edit_id"];
	$gast_vn = $_POST["vnaam"];
	$gast_fn = $_POST["fnaam"];
	$gast_aantal = $_POST["personen"];
	$gast_checkout = $_POST["gc"];

	//ingevulden aantal $gast_aantal moet kleiner zijn dan het aantal voorzien personen van de kamer waar ze inzitten, anders zijn er bedden te weinig etc jwz enzow:
	$linkedKamerId = getLinkedRoomIdByGuestId($id);
	$linkedKamer = getRoomById($linkedKamerId["kamers_id"]);
	$linkedKamerAantal = $linkedKamer["personen"];
	if($gast_aantal <= $linkedKamerAantal){
		//alles is ingevuld -> opslaan
		if(!empty($gast_vn)&&!empty($gast_fn)&&!empty($gast_aantal)&&!empty($gast_checkout)){
			$message = editGuests($id, $gast_vn,$gast_fn,$gast_aantal,$gast_checkout);	
		}
		else{
			$message = "Niet alle waardes zijn ingevuld";
		}
	}
	else{
		$message = "De kamer die deze persoon geboekt heeft is niet groot genoeg.";
	}
}

 ?>


 <div class="content">
	<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" class="form-horizontal checkIn">
		
		<div class="form-group">
			<label for="vnaam" class="control-label col-sm-4">Voornaam: </label>
			<div class="col-sm-8">
				<input type="text" name="vnaam" class="form-control" value="<?php echo $gast_vn ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="fnaam" class="control-label col-sm-4">Familienaam: </label>
			<div class="col-sm-8">
				<input type="text" name="fnaam" class="form-control" value="<?php echo $gast_fn ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="personen" class="control-label col-sm-4">Aantal personen: </label>
			<div class="col-sm-8">
				<select name="personen" id="personen" class="form-control">
					<?php
					$i=1;
					do{
						if($i == $gast_aantal){
							echo "<option value".$i." selected>".$i."</option>"	;
						}else{
							echo "<option value".$i.">".$i."</option>"	;
						}
						$i++;
					}while($i<=8);
					 ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="gc" class="control-label col-sm-4">Geplande Check-out: </label>
			<div class="col-sm-8">
				<input type="date" name="gc" class="form-control" value="<?php echo $gast_gc ?>">
			</div>
		</div>		
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<input type="submit" name="submit" class="form-control" value="Wijzigingen opslaan">
			</div>
			<div class="col-sm-4">
				<a href="guests.php" class="form-control">Terug</a>
			</div>
		</div>
		<?php
		if(!empty($message)){
		echo "<div class='form-group'><div class='message col-sm-offset-4 col-sm-8'><p class='form-control'>{$message}</p></div></div>";
		}
		?>
	</form>
</div>
