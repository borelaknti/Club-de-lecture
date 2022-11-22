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
$nomErr = $_SESSION['nomErr'] ?? '';
$prenomErr = $_SESSION['prenomErr'] ?? '';
$dateErr = $_SESSION['dateErr'] ?? '';
$adresseErr = $_SESSION['adresseErr'] ?? '';
$emailErr = $_SESSION['emailErr'] ?? '';
$nom = $_SESSION['nom'] ?? '';
$prenom = $_SESSION['prenom'] ?? '';
$date = $_SESSION['date'] ?? '';
$adresse = $_SESSION['adresse'] ?? '';
$email = $_SESSION['email'] ?? '';

//die(var_dump( $nom ));
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
				<h4> Inscrire un nouveau membre </h4>
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
        <div class="insc-pos-membre  offset-md-1 mb-4">
				<form id="inscrire" action="../formProcessing/inscrire_Membre.php" method="post">
  					<div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> nom:  </label>
                        <div class="col-sm-8">
                            <input type="text" class=" form-control mb-3"  name="nom" id="nom"   value="<?php echo htmlentities($nom);?>" required />
                           <?php echo outputError($nomErr) ;?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> prenom:  </label>
                        <div class="col-sm-8">
                            <input type="text" class=" form-control mb-3"  name="prenom" id="prenom"   value="<?php echo htmlentities($prenom);?>" required />
                           <?php echo outputError($prenomErr) ;?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> Date de naissance:  </label>
                        <div class="col-sm-8">
                            <input type="date" class=" form-control mb-3" name="date" id="date"  value="<?php echo htmlentities($date);?>" required />
                            <?php echo outputError($dateErr);?> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> adresse:  </label>
                        <div class="col-sm-8">
                            <input type="text" class=" form-control mb-3"   name="adresse" id="adresse"  value="<?php echo htmlentities($adresse);?>" required />
                           <?php echo outputError($adresseErr) ;?>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label  class="col-sm-3 col-form-label "> Sexe:  </label>
                        <div class="col-sm-8">
                            <select class="form-select form-control" name="sexe" id="sexe">
                                <option value="masculin">masculin</option>
                                <option value="feminin">feminin</option>
                            </select>
                        </div>
                    </div>
  					<div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> Adresse email:  </label>
                        <div class="col-sm-8">
                            <input type="email" class=" form-control mb-3"   name="email" id="email"  value="<?php echo htmlentities($email);?>" required />
                           <?php echo outputError($emailErr) ;?>
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