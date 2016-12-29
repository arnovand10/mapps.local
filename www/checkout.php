<?php 
require "includes/functies/main.php";
require "includes/functies/checkout.php";
standaardBeginCode();
if($_SESSION['login']==false){
	header('location: login.php');
}

$datum = date("Y-m-d H:i:s");

if(isset($_POST["submit"])){
	//de familienaam gelinked aan de kamer weergeven
	$kamer_nummer = $_POST["kamer"];
	$arrGast_id = getLinkedGuestIdByRoomNumber($kamer_nummer);
	$gast_id = $arrGast_id["gast_id"];
	$arrGast = getGuestById($gast_id);
	$gast_fnaam = $arrGast["familienaam"];
	$gast_gc = date("Y-m-d", strtotime($arrGast["checkout"]));
	$_SESSION["checkout"] = [$gast_fnaam,$kamer_nummer,$gast_gc];
}

if(isset($_POST["confirm"])){
	$gast_fnaam = $_SESSION["checkout"][0];
	$kamer_nummer = $_SESSION["checkout"][1];
	$gast_gc = $_SESSION["checkout"][2];
	unset($_SESSION["checkout"]);
	if(!empty($gast_fnaam)&&!empty($gast_gc)&&!empty($datum)){
		checkoutGuest($gast_fnaam,$kamer_nummer);
		$message  = "Gast is uitgechecked";
	}else{
		$message =  "Er is een fout opgetreden";
	}
}

?>
<div class="content">
	<form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" class="form-horizontal checkIn">
		<div class="form-group">
			<label for="datum" class="control-label col-sm-4">Check-Out Datum: </label>
			<div class="col-sm-8">
				<?php 
					//wordt in php toegevoegd anders is value ""
					$datumInput = "<input type='text' value='$datum' name='datum' disabled class='form-control'> ";
					echo $datumInput;
				?>
			</div>
		</div>
		<div class="form-group">
			<label for="familienaam" class="control-label col-sm-4">Familienaam: </label>
			<div class="col-sm-8">
				<input type="text" name="familienaam" class="form-control" disabled value="<?php echo $gast_fnaam ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="gc" class="control-label col-sm-4">Geplande Check-Out Datum: </label>
			<div class="col-sm-8">
				<input type="text" name="gc" class="form-control" disabled value="<?php if(!empty($gast_fnaam)){echo $gast_gc;} ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="kamer" class="control-label col-sm-4">Kamer: </label>
			<div class="col-sm-8">
				<input type="text" name="kamer" class="form-control" value="<?php echo $_POST["kamer"] ?>">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<input type="submit" name="submit" class="form-control" value="Check-Out">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<input type="submit" name="confirm" class="form-control" value="Confirmeer">
			</div>	
			<div class="col-sm-4">	
			<input type="reset" name="cancel" class="form-control" value="Annuleer">
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