<?php 
require "includes/functies/main.php";
require "includes/functies/bookings.php";
standaardBeginCode();





?>

<div class="content">
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th><a href="">Kamer</a></th>
			<th><a href="">Klasse</a></th>
			<th><a href="">Familie</a></th>
			<th><a href="">Aantal</a></th>
			<th><a href="">Check-in</a></th>
			<th><a href="">Check-out</a></th>
		</tr>
		<?php
			$bookings = getBookings();
			$klasses = getClasses();
			$message = writeRoomGuestLinkTable($bookings,$klasses);
		if(!empty($message)){
		echo "<div class='form-group'><div class='message col-sm-offset-4 col-sm-8'><p class='form-control'>{$message}</p></div></div>";
		}
		?>
	</table>
</div>