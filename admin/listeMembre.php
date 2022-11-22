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
require_once("../formProcessing/liste_membre.php");

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
	<div class="general-form-img">
		<?php

    		$page = "member-list";

    		$active = "navg";

    		include_once "../layouts/navigationAdmin.php";
		?>
		<div class="tab-member">
			<?php echo $htmlTable; ?>
		</div>
		<div class="legend">
			<i class='fas fa-info-circle '></i> <label> Information </label> <br> <br>
			<i class='fas fa-check'></i><label>  Rendre inactif </label> <br> <br>
			<i class='fas fa-ban'></i><label>  Rendre actif </label> <br> <br>
		</div>
		<div class="row">
            <footer class="footer-bottom">
                <p>Copyright &copy;2022 Club de lecture. designe par <span> NTI AKOUMBA</span> </p>
            </footer>
        </div> 
	</div>	
</body>
</html>