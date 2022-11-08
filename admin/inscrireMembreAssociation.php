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

$message = $_SESSION['msg'] ?? '';
$memberErr= $_SESSION['memberErr'] ?? '';
$associationErr = $_SESSION['associationErr'] ?? '';

$users = new Users();
$associations = new Association();
$associationList = $associations->findAll();   
$userList = $users->findActifMember();   

?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "../layouts/adminHeader.php"; ?>
</head>
<body>
	<div class="container">
		<div class="titreInsc">
			<h1>Inscrire un membre dans une association</h1>
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
			<form id="inscrire-mb-as" action="../formProcessing/inscrire_Membre_Association.php" method="post">
			<fieldset>
					<table class="tabVelo" cellpadding="10" cellspacing="5">
						<tr>
							<td><label class="nom"> Membre :</label></td> <td> <select id="member" name="member"> 
								<?php 
								echo "<option selected disabled> choisir un membre</option>";
								if(count($userList) > 0)
								{ 
									foreach ($userList as $user)
    								{  ?>
    									<option value="<?php echo $user->numUtilisateur ?> ">  <?php echo $user->nomUtilisateur ?> </option>
									<?php }
								}
								?>
							</select> 
							<span class="error"> <?php echo $memberErr;?></span> </td> 
						</tr>
						<tr>
							<td><label class="nom"> Association :</label></td> <td> <select id="association" name="association"> 
								<?php 
								echo "<option selected disabled> choisir une associations </option>";
								if(count($associationList) > 0)
								{ 
									foreach ($associationList as $asso)
    								{  ?>
    									<option value="<?php echo $asso->numAssociation ?> ">  <?php echo $asso->nomAssociation ?> </option>
									<?php }
								}
								?>
							</select> 
							<span class="error"> <?php echo $associationErr;?></span> </td> 
						</tr>
					</table>
					<div class="endbutton">
						<button class="buttonEnd " type="submit" name="submit" >  Soumettre le formulaire  </button>
						<a  href="index.php"  > <button type="button" class="buttonEnd " >  Retour au menu  </button> </a>
					</div>
				</fieldset>
			</form>
		</div>

		<?php include_once "../layouts/footer.php"; ?>
	</div>	
</body>
</html>