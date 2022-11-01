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
			<h1>Inscrire une nouvelle association</h1>
		</div>
		<div class="insc-membre">
			<form id="inscrire-association" action="../formProcessing/inscrire_Association.php" method="post">
			<fieldset>
				<table class="tabVelo" cellpadding="10" cellspacing="5">
					<tr>
						<td><label class="nom"> Nom de l'association:</label></td> <td><input type="text" name="nom" id="nom" size="40" value="<?php echo htmlentities($nom);?>" required> <?php echo $nomErr;?></span> </td>
					</tr>
					<tr>
						<td><label class="nom"> Adresse :</label></td> <td><input type="text" name="adress" id="adress"  size="40" value="<?php echo htmlentities($adress);?>" required> <?php echo $adressErr;?></span> </td>
					</tr>
					<tr>
						<td><label class="nom"> Date de creation :</label></td> <td><input type="date" name="date" id="date" value="<?php echo htmlentities($date);?>" required> <?php echo $dateErr;?></span> </td> 
					</tr>
					<tr>
						<td><label class="nom"> Nom du createur : </label></td> <td><input type="text" name="createur" id="createur" size="40" value="<?php echo htmlentities($createur);?>" required> <?php echo $createurErr;?></span> </td>
					</tr>
				</table>
				<div class="endbutton">
					<button class="buttonEnd " type="submit" name="submit" >  Soumettre le formulaire  </button>
					<a  href="index.php"  > <button type="button" class="buttonEnd " >  Retour au menu  </button> </a>
				</div>
			</fieldset>
		</form>
		</div>
		<?php include_once "../layouts/footer.php"; ?>
	</div>	
</body>
</html>