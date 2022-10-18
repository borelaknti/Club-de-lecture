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
require_once("../formProcessing/liste_association.php");

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
		<?php

    		$page = "association-list";

    		$active = "navg";

    		include_once "../layouts/navigationAdmin.php";
		?>
		
		<div class="tab-member">
			<?php echo $htmlTable; ?>
		</div>
		<?php include_once "../layouts/footer.php"; ?>
	</div>	
</body>
</html>