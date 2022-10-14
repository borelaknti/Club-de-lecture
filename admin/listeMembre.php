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
		<?php

    		$page = "member-list";

    		$active = "navg";

    		include_once "../layouts/navigationAdmin.php";
		?>
		<div class="tab-member">
			<table border="1" class="list"> 
					<tr>
						<th> numero </th> <th> Nom </th> <th> Prenom </th> <th>Date de naissance</th> <th>etat</th> <th>adresse</th> <th>sexe</th> <th>adresse mail</th> <th>action</th>
					</tr>
					<tr>
						<td> 1 </td> <td> Borel </td> <td> Giovanni </td> <td>27/08/2002</td> <td>actif</td> <td>94 rue jacques cartier</td> <td>feminin</td> <td>borelgio@gmail.com</td> <td><i class="fas fa-info-circle"></i></td>
					</tr>
					<tr>
						<td> 2 </td> <td> philip </td> <td> morris </td> <td>28/03/2022</td> <td>inactif</td> <td>95 jascques du nom</td> <td>masculin</td> <td>adressemail@gmail.com</td> <td><i class="fas fa-info-circle"></i></td>
					</tr>
			</table>
		</div>
		<?php include_once "../layouts/footer.php"; ?>
	</div>	
</body>
</html>