<?php
session_start();
ini_set('display_errors', 'on');
ini_set('log_errors', 1);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ob_start();
date_default_timezone_set('America/New_York');

require_once("../includes/functions.php");
require_once("../includes/Users.php");
require_once("../includes/session.php");

if(empty($_SESSION['logIn']) && $_SESSION['logIn'] !== 'logged'){
    redirect_to("../connexion");
}

?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "../layouts/adminHeader.php"; ?>
</head>
<body>
	<div class="container">
		<div class="titreInsc">
			<h1>Inscrire un nouveau membre</h1>
		</div>
		<div class="insc-membre">
		<form>
			<fieldset>
				<table class="tabVelo" cellpadding="10" cellspacing="5">
					<tr>
						<td><label class="nom"> Nom :</label></td> <td><input type="text" name="" size="40"></td>
					</tr>
					<tr>
						<td><label class="nom"> Prenom :</label></td> <td><input type="text" name="" size="40"></td>
					</tr>
					<tr>
						<td><label class="nom"> Date de naissance :</label></td> <td><input type="date" name="" > </td>
					</tr>
					<tr>
						<td><label class="nom"> Adresse :</label></td> <td><input type="text" name="" size="40"> </td>
					</tr>
					<tr>
						<td><label class="nom"> Sexe :</label></td> <td> <select> <option> Masculin</option>  <option> Feminin </option></select> </td> 
					</tr>
					<tr>
						<td><label class="nom"> Adresse Mail : </label></td> <td><input type="text" name="" size="40"> </td>
					</tr>
				</table>
				<div class="endbutton">
					<button class="buttonEnd " >  Soumettre le formulaire  </button>
					<a  href="index.php"  > <button type="button" class="buttonEnd " >  Retour au menu  </button> </a>
				</div>
			</fieldset>
		</form>
	</div>	
		<?php include_once "../layouts/footer.php"; ?>
	</div>	
</body>
</html>