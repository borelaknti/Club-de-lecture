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
$message = $_SESSION['msg'] ?? '';
$nomErr = $_SESSION['nomErr'] ?? '';
$prenomErr = $_SESSION['prenomErr'] ?? '';
$dateErr = $_SESSION['dateErr'] ?? '';
$adresseErr = $_SESSION['adresseErr'] ?? '';
$emailErr = $_SESSION['emailErr'] ?? '';
$nom = $_SESSION['nom'] ?? '';
$prenom = $_SESSION['prenom'] ?? '';
$date = $_SESSION['date'] ?? '';
$adresse = $_SESSION['adresse'] ?? '';
$email = $_SESSION['email'] ?? '';

//die(var_dump( $nom ));
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
		<?php
		//die(var_dump($message));
            if ($message){
                echo 
                    '<div class=" error-message">'.
                            outputMessage($message).
                    '</div>';
            }
        ?>
		<div class="insc-membre">
		<form id="inscrire" action="../formProcessing/inscrire_Membre.php" method="post">
			<fieldset>
				<table class="tabVelo" cellpadding="10" cellspacing="5">
					<tr>
						<td><label class="nom"> Nom :</label></td> <td><input type="text" name="nom" id="nom" size="40" maxlength="100"  value="<?php echo htmlentities($nom);?>" required > <span class="error"> <?php echo $nomErr;?></span> </td>
					</tr>
					<tr>
						<td><label class="nom"> Prenom :</label></td> <td><input type="text" name="prenom" id="prenom" maxlength="100"  value="<?php echo htmlentities($prenom);?>" required size="40"> <span class="error"> <?php echo $prenomErr;?></span> </td>
					</tr>
					<tr>
						<td><label class="nom"> Date de naissance :</label></td> <td><input type="date" name="date" id="date" maxlength="100"  value="<?php echo htmlentities($date);?>" required size="40"> <span class="error"> <?php echo $dateErr;?></span> </td>
					</tr>
					<tr>
						<td><label class="nom"> Adresse :</label></td> <td><input type="text" name="adresse" id="adresse" size="40" maxlength="100"  value="<?php echo htmlentities($adresse);?>" required size="40"> <span class="error"> <?php echo $adresseErr;?></span> </td>
					</tr>
					<tr> 
                        <td><label for="sexe">Sexe:</label> </td> <td> <select  name="sexe" id="sexe"> <option value="masculin"> Masculin</option>  <option value="feminin"> Feminin </option></select> </td>
                    </tr>
					<tr>
						<td><label class="nom"> Adresse Mail : </label></td> <td><input type="text" name="email" id="email" size="40" value="<?php echo htmlentities($email);?>" required size="40"> <span class="error"> <?php echo $emailErr;?></span> </td>
					</tr>
				</table>
				<div class="endbutton">
					<button class="buttonEnd " type="submit" name="submit">  Soumettre le formulaire  </button>
					<a  href="index.php"  > <button type="button" class="buttonEnd " >  Retour au menu  </button> </a>
				</div>
			</fieldset>
		</form>
	</div>	
		<?php include_once "../layouts/footer.php"; ?>
	</div>	
</body>
</html>