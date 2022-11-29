<?php
session_start();
ini_set('display_errors', 'on');
ini_set('log_errors', 1);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ob_start();
date_default_timezone_set('America/New_York');

require_once("../includes/functions.php");
require_once("../includes/Association.php");
require_once("../includes/session.php");
require_once("../formProcessing/membreAssociation.php");
require_once("../formProcessing/details_association.php");

if(empty($_SESSION['logIn']) && $_SESSION['logIn'] !== 'logged'){
    redirect_to("../connexion");
}

$asso = new Association();
$user = $asso->findAssociation($_GET['id']);
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "../layouts/adminHeader.php"; ?>
</head>
<body>
	<div class="general-form-img">
		<?php

    		$page = "member-list";

    		$active = "navg";

    		include_once "../layouts/navigationAdmin.php";
		?>
		<?php
            if ($message){
                echo 
                	'<div class=" error-message">'.
                    		outputMessage($_SESSION['message'] ).
                    '</div>';
            }
        ?>
		<div class="tab-member">
			<div class="titre-det offset-md-4">
				<h2 > Liste des Membres de l'association <?php echo $user[0]->nomAssociation; ?> </h2>
			</div>
			<div class=" mb-5 offset-md-5">
				<?php echo $htmlTab; ?> 
			</div>
			<div class=" mb-5 offset-md-2">
				<?php echo $htmlTable; ?>
			</div>
		</div>
		<div class="legend offset-md-3">
			<i class='fas fa-info-circle '></i> <label> Information </label> <br> <br>
			<i class='fas fa-check'></i><label>  Rendre inactif </label> <br> <br>
			<i class='fas fa-ban'></i><label>  Rendre actif </label> <br> <br>
		</div>
		<?php include_once "../layouts/footer.php"; ?>
	</div>	
</body>
</html>