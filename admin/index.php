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
$_SESSION['forgot'] = '';
$_SESSION['nomErr'] = '';
$_SESSION['prenomErr'] = '';
$_SESSION['dateErr'] = '';
$_SESSION['adresseErr'] = '';
$_SESSION['emailErr'] = '';
$_SESSION['adressErr'] = '';
$_SESSION['createurErr'] = '';
$_SESSION['memberErr'] = '';
$_SESSION['associationErr'] = '';
$_SESSION['member'] = '';
$_SESSION['association'] = "";
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
	<div class="general-form-img">
		<?php

    		$page = "home";

    		$active = "navg";

    		include_once "../layouts/navigationAdmin.php";
		?>

		<div class="Big-button">
			<div>
				<a href="inscrireMembre.php" class="link" > <button class="button1 button " > 
					<span class="button__icon ">
						<i class='fas fa-user-plus'></i>
					</span>
					<span class="button__text">Nouveau Membre</span>
					    </button> </a> 
				<a href="inscrireAssociation.php" class="link" > <button  class="button2 button ">  
				<span class="button__icon">
						<i class='fas fa-plus '></i>
					</span>
					<span class="button__text">Nouvelle Association </span>
					     </button> </a>
			</div>
			<div >
				<a  href="inscrireMembreAssociation.php" class="link" > <button class="button4 button" >
				<span class="button__icon">
						<i class='fas fa-users '></i>
					</span>
					<span class="button__text">ajouter un membre <br> a une association  </span>
					     </button> </a>
				<a  href="listeMembre" class="link" > <button class="button5 button" > <span class="button__icon">
						<i class='fas fa-ban '></i>
					</span>
					<span class=" bonus">Desactiver un membre  </span>   </button> </a>
			</div>
		</div>
		
		<div class="row">
            <footer class="footer-bottom">
                <p>Copyright &copy;2022 Club de lecture. designe par <span> NTI AKOUMBA</span> </p>
            </footer>
        </div>  
	</div>	
</body>
</html>