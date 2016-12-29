<?php
require "includes/functies/main.php";
require "includes/functies/login.php";
standaardBeginCode();


$gebruikersnaam = $_POST["gebruikersnaam"];
$wachtwoord = $_POST["wachtwoord"];
$admin = $_POST["admin"];
$login = $_POST["login"];

//login knop
			if(isset($login)){
				//check of alles ingevuld is
				if(!empty($gebruikersnaam)&&!empty($wachtwoord)){
					//zoek of gebruiker bestaat
					$gevonden = vindGebruikerWaardes($gebruikersnaam);
					if($gevonden!=null){
						//zoek wachtwoord
						$pass = vindGebruikerWachtwoord($gebruikersnaam);
						if($pass != null){
							//controleer wachtwoord
							$check = checkGebruikerWachtwoord($wachtwoord, $pass);
							if($check!=null){
								//wil persoon inloggen als admin?
								if($admin!=null){
									//check of persoon admin priveleges heeft
									$isAdmin = checkGebruikerAdmin($gebruikersnaam);
									if($isAdmin==true){
										//inloggen als admin
										$_SESSION['admin'] = true;
										header("location: index.php");
									}else{
										//niet inloggen, melding dat gebruiker geen admin rechten heeft
										$message= "geen admin rechten";
									}
								}else{
									//gewoon inloggen
									header("location: index.php");
								}
							}else{
								//ingevoerd wachtwoord != wachtwoord gebruiker
								$message= "Wachtwoord komt niet overeen";
							}
						}else{
							//zou in princiepe niet kunnen voorvallen
							$message = "Error: geen wachtwoord gevonden???";	
						}
					}else{
						//gebruiker niet gevonden in tabel
						$message=  "Deze persoon is niet geregistreerd";
					}	
				}else{
					$message =  "Niet alle tekstvelden zijn ingevuld";
				}
			}



 ?>
 	<div class="content background-image background-image-login"></div>
 	 <div class="content login">
        <h1>Login</h1>
        <p class="lead">Vul gebruikersnaam en gegeven in.</p>
        
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        	<div class="form-group">

				<div class="col-sm-offset-4 col-sm-4">
					<!--<label for="gebruikersnaam">Gebruikersnaam: </label>-->
        			<input type="text" name="gebruikersnaam" placeholder="gebruikersnaam" value="<?php echo isset($_POST['gebruikersnaam']) ? $_POST['gebruikersnaam'] : '' ?>" class="form-control">
        		</div>
				
        	</div>
        	<div class="form-group">
        		<div class="col-sm-offset-4 col-sm-4">
        		<!--<label for="wachtwoord">Wachtwoord: </label>-->
        		<input type="password"  name="wachtwoord" placeholder="wachtwoord" value="<?php echo isset($_POST['wachtwoord']) ? $_POST['wachtwoord'] : '' ?>" class="form-control">
        		</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-4">
        			<input type="submit" value="login" name="login" class="btn btn-default form-control">
        		</div>
        	</div>
        	<div class="form-group">
        		<div class="checkbox">
        			<label for="admin"><input type="checkbox" name="admin" class="checkbox">login as admin</label>
        		</div>
        	</div>
        	<?php
		if(!empty($message)){
		echo "<div class='form-group'><div class='col-sm-offset-4 col-sm-4'><p class='login-error'>{$message}</p></div></div>";
		}
		?>
        </form>

      
    </div><!-- /.container -->