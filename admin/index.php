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

$_SESSION['msg'] = '';
$_SESSION['nomErr'] = '';
$_SESSION['prenomErr'] = '';
$_SESSION['dateErr'] = '';
$_SESSION['adresseErr'] = '';
$_SESSION['emailErr'] = '';
$_SESSION['adressErr'] = '';
$_SESSION['createurErr'] = '';
$_SESSION['memberErr'] = '';
$_SESSION['associationErr'] = '';
$_SESSION['nom'] = '';
$_SESSION['prenom'] = '';
$_SESSION['email'] =  '';
$_SESSION['date'] = '';
$_SESSION['adresse'] = '';
$_SESSION['sexe'] =  '';
$_SESSION['adress'] = '';
$_SESSION['createur'] = '';

?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "../layouts/adminHeader.php"; ?>
</head>
<body>
	<div class="container">
		<?php

    		$page = "home";

    		$active = "navg";

    		include_once "../layouts/navigationAdmin.php";
		?>

		<div class="Big-button">
			<div class="">
				<a href="inscrireMembre.php" class="link" > <button class="button1 button " >   Nouveau Membre  </button> </a> 
				<a href="inscrireAssociation.php" class="link" > <button  class="button2 button ">  Nouvelle Association  </button> </a>
			</div>
			<div class="">
				<a  href="inscrireMembreAssociation.php" class="link" > <button class="button4 button" > ajouter un membre a une association  </button> </a>
				<a  href="listeMembre" class="link" > <button class="button5 button" >  Desactiver un membre  </button> </a>
			</div>
		</div>
		
		<?php include_once "../layouts/footer.php"; ?>
	</div>	
</body>
</html>