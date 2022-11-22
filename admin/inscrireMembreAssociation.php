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
	<div class="general-form-img">
		<div class="form-dispo-MA offset-md-4">
			<div class="offset-md-2 mb-4">
				<h4> Inscrire un membre dans une association</h4>
			</div>
		<?php
		//die(var_dump($msg));
            if ($message){
                	echo 
                    '<div class="row big-error">
                        <div class="col-sm-9 offset-md-1">
                            '.
                                outputError($message).
                    '
                        </div>
                    </div>';
            }
        ?>
        <div class=" insc-pos-MA offset-md-1 mb-4">
				<form id="inscrire-mb-as" action="../formProcessing/inscrire_Membre_Association.php" method="post">
  					<div class="form-group row mb-1">
                        <label  class="col-sm-3 col-form-label "> Membre :  </label>
                        <div class="col-sm-8">
                            <select class="form-select form-control" id="member" name="member"> 
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
                            <?php echo outputError($memberErr) ;?>
                        </div>
                    </div>
                    <div class="form-group row mb-5">
                        <label  class="col-sm-3 col-form-label "> Association :  </label>
                        <div class="col-sm-8">
                            <select class="form-select form-control" id="association" name="association"> 
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
                            <?php echo outputError($associationErr) ;?>
                        </div>
                    </div>
  					<div class="row offset-md-1">
						<button type="submit" name="submit" class="btn btn-success col-sm-10 p-2 mb-2" >  Soumettre le formulaire   </button> <br>
						<a  href="index.php" class="link btn btn-success col-sm-10  " role="button">   Retour au menu   </a>
					</div>
  				</form>
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