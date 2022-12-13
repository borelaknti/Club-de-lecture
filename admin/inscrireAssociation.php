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

$message = $_SESSION['msg'] ?? '';
$forgot = $_SESSION['forgot'] ?? '';
$nomErr = $_SESSION['nomErr'] ?? '';
$dateErr = $_SESSION['dateErr'] ?? '';
$adressErr = $_SESSION['adressErr'] ?? '';
$createurErr = $_SESSION['createurErr'] ?? '';
$nom = $_SESSION['nom'] ?? '';
$date = $_SESSION['date'] ?? '';
$adress = $_SESSION['adress'] ?? '';
$createur = $_SESSION['createur'] ?? '';

?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "../layouts/adminHeader.php"; ?>
</head>
<body>
	<div class="general-form-img">
		<div class="form-dispo-membre offset-md-4">
			<div class="offset-md-2 mb-5">
				<h4> Inscrire une nouvelle association </h4>
			</div>
		<?php
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
            if ($forgot){
                echo 
                    '<div class="row big-error">
                        <div class="col-sm-9 offset-md-1">
                            '.
                                outputSuccess($forgot).
                    '
                        </div>
                    </div>';;
            }
        ?>
        <div class=" <?php if(empty($_SESSION['msg']) && empty($_SESSION['nomErr']) && empty($_SESSION['createurErr']) && empty($_SESSION['dateErr']) && empty($_SESSION['adressErr'])) echo ""; else echo "insc-pos-membre"; ?>  offset-md-1 mb-4">
				<form id="inscrire-association" action="../formProcessing/inscrire_Association.php" method="post">
  					<div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> Nom de l'association:  </label>
                        <div class="col-sm-8">
                            <input type="text" class=" form-control mb-3"  name="nom" id="nom"   value="<?php echo htmlentities($nom);?>" required />
                           <?php echo outputError($nomErr) ;?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> adresse:  </label>
                        <div class="col-sm-8">
                            <input type="text" class=" form-control mb-3"   name="adress" id="adress"  size="40" value="<?php echo htmlentities($adress);?>" required />
                           <?php echo outputError($adressErr) ;?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> Date de creation:  </label>
                        <div class="col-sm-8">
                            <input type="date" class=" form-control mb-3" name="date" id="date" value="<?php echo htmlentities($date);?>" required />
                            <?php echo outputError($dateErr);?> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> Nom du createur:  </label>
                        <div class="col-sm-8">
                            <input type="text" class=" form-control mb-3" name="createur" id="createur" size="40" value="<?php echo htmlentities($createur);?>" required />
                           <?php echo outputError($createurErr) ;?>
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