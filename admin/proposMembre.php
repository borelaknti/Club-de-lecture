<?php
session_start();
ini_set('display_errors', 'on');
ini_set('log_errors', 1);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ob_start();
date_default_timezone_set('America/New_York');

require_once("../includes/functions.php");
require_once("../includes/Users.php");
require_once("../includes/Association.php");
require_once("../includes/session.php");

if(empty($_SESSION['logIn']) && $_SESSION['logIn'] !== 'logged'){
    redirect_to("../connexion");
}


$users = new Users();
$asso = new Association();
$userList = $users->findAllMember();
$member = aPropos($_GET['id'],$userList);
$user = $asso->findAssociationMember($_GET['id']);
//die(var_dump($member));
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "../layouts/adminHeader.php"; ?>
</head>
<body>
	<div class="container">
		<div class="titreInsc">
			<h1>A propos de <?php echo $userList[$_GET['id']-1]->nomUtilisateur;?> </h1>
		</div>
		<div class="insc-membre">
			<fieldset>
				<table class="tabVelo" cellpadding="10" cellspacing="5">
					<tr>
						<td><label class="nom"> Nom :</label></td> <td> <?php echo $member->nomUtilisateur;?> </td>
					</tr>
					<tr>
						<td><label class="nom"> Prenom :</label></td> <td> <?php echo $member->prenomUtilisateur;?> </td>
					</tr>
					<tr>
						<td><label class="nom"> Date de naissance :</label></td> <td> <?php echo $member->dateNaissance;?> </td>
					</tr>
					<tr>
						<td><label class="nom"> Adresse :</label></td> <td> <?php echo $member->adresseUtilisateur;?> </td>
					</tr>
					<tr>
						<td><label class="nom"> Sexe :</label></td> <td> <?php echo $member->sexeUtilisateur;?> </td> 
					</tr>
					<tr>
						<td><label class="nom"> Adresse Mail : </label></td> <td> <?php echo $member->utilisateur_email;?> </td>
					</tr>
					<tr>
						<td><label class="nom"> Membre de l'association : </label></td> <td>
					<?php 
					if(isset($user))
					{
						foreach ($user as $index)
    					{
    						echo " * ".$index->nomAssociation;
					 	}
					}else
						echo "Aucune";
					 ?>
					 </td>
					</tr>
				</table>
				<div class="endbutton">
					<a  href="listeMembre.php"  > <button type="button" class="buttonEnd " >  Fermer  </button> </a>
				</div>
			</fieldset>
		</div>
	</div>	
</body>
</html>