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

$_SESSION['forgot'] = '';
$users = new Users();
$asso = new Association();
$userList = $users->findAllMember();
$member = aPropos($_GET['id'],$userList);
$user = $asso->findAssociationMember($_GET['id']);

?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "../layouts/adminHeader.php"; ?>
</head>
<body>
	<div class="general-form-img">
		<div class="propos-membre offset-md-4">
			<div class="offset-md-2 mb-5">
				<h4> A propos de <?php echo $member->nomUtilisateur;?>  </h4>
			</div>
        <div class="offset-md-1 mb-4">
			<div class="form-group row mb-3 ">
                <label  class=" inf-lab col-sm-4  offset-md-1 "> Nom : </label>
                    <div class="col-sm-6">
                        <label class="inf "> <?php echo $member->nomUtilisateur;?> </label> 
 					</div> 
 			</div>
 			<div class="form-group row mb-3 ">
                <label  class=" inf-lab col-sm-4  offset-md-1 "> Prenom : </label>
                    <div class="col-sm-6">
                        <label class="inf "> <?php echo $member->prenomUtilisateur;?> </label> 
 					</div> 
 			</div>
 			<div class="form-group row mb-3 ">
                <label  class=" inf-lab col-sm-4  offset-md-1 "> Date de naissance : </label>
                    <div class="col-sm-6">
                        <label class="inf "> <?php echo $member->adresseUtilisateur;?> </label> 
 					</div> 
 			</div>
 			<div class="form-group row mb-3 ">
                <label  class=" inf-lab col-sm-4  offset-md-1 "> Sexe : </label>
                    <div class="col-sm-6">
                        <label class="inf "> <?php echo $member->sexeUtilisateur;?>  </label> 
 					</div> 
 			</div>
 			<div class="form-group row mb-3 ">
                <label  class=" inf-lab col-sm-4  offset-md-1 "> Email : </label>
                    <div class="col-sm-6">
                        <label class="inf "> <?php echo $member->utilisateur_email;?> </label> 
 					</div> 
 			</div>
 			<div class="form-group row mb-5 ">
                <label  class=" inf-lab col-sm-4  offset-md-1 "> Membre de l'association : </label>
                    <div class="col-sm-6">
                        <label class="inf "> <?php 
					if(isset($user))
					{
						foreach ($user as $index)
    					{
    						echo " * ".$index->nomAssociation;
					 	}
					}else
						echo "Aucune";
					 ?> </label> 
 					</div> 
 			</div>
		</div>
		<div class="row offset-md-1">
			<?php if($_GET['page'] == "association")
					echo '<a  href="detailsAssociation.php?id='. $_GET['idAsso'].'" class="link btn btn-success col-sm-10  " role="button">   Retour au menu   </a>';
				  else
				  	echo '<a  href="listeMembre.php" class="link btn btn-success col-sm-10  " role="button">   Retour au menu   </a>';
			?>
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