<?php
session_start();
ini_set('display_errors', 'on');
ini_set('log_errors', 1);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ob_start();
date_default_timezone_set('America/New_York');

require_once("includes/functions.php");
require_once("includes/session.php");

$_SESSION['forgot'] = '';
$_SESSION['msg'] = '';

?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "layouts/header.php"; ?>
</head>
<body>
	<div class="general">
		<?php
			if(isset($_SESSION['logIn']) && $_SESSION['logIn']=='logged'){
       	 	redirect_to("admin/index");
    		}
    	$page = "home";
    	$active = 'active';

    		include_once "layouts/navigation.php";
		?>
		<h1> La lecture est à l'esprit ce que l'exercice est au corps</h1>
		<div class="div-line"></div>
		<p class="hero">Joseph Addison</p>
		<p class="desc"> Un petit groupe  écrit et parle à propos de livres qui ont un lien entre eux. <br> On veut que ces jeunes lecteurs  bâtissent des outils puissants pour comprendre l’univers de leur livre.</p>
		<?php include_once "layouts/footer.php"; ?>
	</div>
</body>
</html>