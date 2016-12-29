<?php 
require "includes/functies/main.php";
require "includes/functies/rooms.php";
standaardBeginCode();


if($_SESSION['login']==false){
	header('location: login.php');
}
$isAdmin = $_SESSION["admin"];


$addKnop = $_POST["toevoegen"];
if(isset($addKnop)){
	$nummer = $_POST['addkamer'];
	$vrij = $_POST['addvrij'];
	$personen = $_POST['addpersonen'];
	$klasse= $_POST['addklasse'];
	$prijs = $_POST['addprijs'];
	$numberAvailable = checkRoomNumberAvailable($nummer);
	//checken of alles ingevuld is
	if (!empty($nummer)&&!empty($vrij)&&!empty($personen)&&!empty($klasse)&&!empty($prijs)) {
		if($numberAvailable ==true){
			addRoom($nummer,$vrij,$personen,$prijs,$klasse);	
		}else{
			$error= "<error>ERROR: Kamer nummer bestaat al / kan niet negatief zijn.</error>";
		}
	}else{
		$error = "<error>ERROR: Alle velden moeten ingevuld zijn.</error>";
	}
}


if(isset($_GET["delete_id"])){
	$id = $_GET["delete_id"];
	removeRoom($id);
}



?>


<!-- tabel met kamers-->
<div class="content">
	<?php
	if($isAdmin!=null) {
		$adminOptions = 
		'<div class="adminoptions">
			<i class="glyphicon glyphicon-plus"></i>
			'.$error.'
		</div>';
		echo $adminOptions;
	}
	
	?>
	<table class="table table-bordered table-striped table-hover">
	<tr>
		<?php
			if($isAdmin!=null){
				$adminOptions = 
				'<th><a href="">Opties</th>';
				echo $adminOptions;
			}
		?>
		<th><a href="">Kamer Nr</a></th>
		<th><a href="">Vrij</a></th>
		<th><a href="">Personen</a></th>
		<th><a href="">Klasse</a></th>
		<th><a href="">Prijs</a></th>
	</tr>
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET" class="kamers-form">
		<tr class="filter" style="display: none;">
				<?php
				if($isAdmin!=null){
					$adminOptions = "<td></td>";
					echo $adminOptions;
				}
				?>
				<td><input type="number" name="kamer" maxlength="3" class="numberOnly" id="kamer"></td>
				
				<td><input type="checkbox" name="vrij" id="vrij" value="1"></td>
				
				<td><select name="personen" id="personen">
					<option value="">kies aantal</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8	</option>
				</select></td>
				
				<td>
					<select name="klasse" id="klasse">
						<option value="">kies een klasse</option>
					<?php 
						$klasses = getClasses();
						echo "ok";
						foreach($klasses as $klasse){
							$klasse_naam = $klasse["naam"];
							$html .= '<option value="'.$klasse_naam.'">'.$klasse_naam.'</option>';
						}
						echo $html;
					?>
					</select>
				</td>
				
				<td>
				<select name="prijs" id="prijs">
					<option value="">Kies prijs</option>
					<option value="50">0-50€/dag</option>
					<option value="100">51-100€/dag</option>
					<option value="150">101-150€/dag</option>
					<option value="200">151-200€/dag</option>
				</select>
				</td>
			</tr>

			<tr class="filter" style="display:none;">
				<td colspan="9"><input type="submit" id="filter" name="filter" class='form-control' value="fiter">
					<input type="submit" id="reset" class='form-control' name="reset" value="reset">
				</td>
			</tr>
		
		<tr>
			<td colspan="9" id="filterknop">
				<span class="glyphicon glyphicon-menu-down"></span>
			</td>
		</tr>
		<?php 
			if(empty($_GET["filter"])){
				$results = getRooms();
				foreach($results as $result){
					writeRooms($result);
				}
			}
				else{
					$filtered = filterRooms();
					$i=0;
					foreach($filtered as $filteredRow){	
						writeRooms($filteredRow);
					}
					$resetknop = "<tr><td colspan='9'><input type='submit' id='reset' class='form-control' value='Reset'></td></tr>";
					echo $resetknop;
				}
			?>
		</form>
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
			<?php 
				if($isAdmin!=null){
					$newRow = "<tr class='addKamer'>";
					$newRow .= "<td><input type='submit' name='toevoegen' value='toevoegen' class='btn'></td>";
					$newRow .= '<td><input type="number" name="addkamer" maxlength="3" id="kamer"></td>';
					$newRow .= '<td><input type="checkbox" name="addvrij" id="vrij" value="1" checked></td>';
					$newRow .= '<td><select name="addpersonen" id="addpersonen"><option value="">kies aantal</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8	</option></select></td>';
					$newRow .= '<td><select name="addklasse" id="klasse"><option value="">kies een klasse</option>';
					$klasses = getClasses();
					foreach($klasses as $klasse){
						$klasse_naam = $klasse["naam"];
						$klasse_id = $klasse["klasse_id"];
						$newRow .= '<option value="'.$klasse_id.'">'.$klasse_naam.'</option>';
						}
					$newRow .= '<td><select name="addprijs" id="prijs"><option value="">Kies prijs</option><option value="50">50€/dag</option><option value="100">100€/dag</option><option value="200">200€/dag</option></select></td>';
					$newRow .= '</tr>';
					echo $newRow;
				}
			?>
		</form>
	</table>
</div>


<?php 

require "includes/footer.php";
?>