<?php
session_start();
ini_set('display_errors', 'on');
ini_set('log_errors', 1);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ob_start();
date_default_timezone_set('America/New_York');
require_once("includes/functions.php");
require_once("includes/Users.php");
require_once("includes/session.php");

$message = '';
$usernameErr = $passwordErr= $passwordConfirmationErr = "";
$mail = $_GET['email'];

if($_SESSION['logIn']=='logged'){
    redirect_to("admin/index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "";
    $password = "";
    $passwordConfirmation = "";

    if(isset($_POST['submit'])){

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $passwordConfirmation = trim($_POST['password-confirmation']);
        
        $user = new Users();
        if (empty($username)) {
            $usernameErr = "Le nom d'usager est obligatoire";
        } else {
            $username = cleanUpInputs($username);

            $ml = $user->findMail($username);
            $email = $_POST['email'];
            if ($ml[0]->utilisateur_email != $email ){
                $usernameErr = "Erreur sur Le nom d'usager .";
            }

            if(empty($ml))
                $usernameErr = "l'administrateur inexistant .";
        }
        if (empty($password)) {
            $passwordErr = "Le mot de passe est obligatoire";
        }
        if (empty($passwordConfirmation)) {
            $passwordConfirmationErr = " La confirmation du mot de passe est obligatoire";
        } 
        if ($password !== $passwordConfirmation){
            $message = "Les deux mots de passes ne sont pas identiques";
        }

        if (empty($message) &&  empty($usernameErr)  && empty($passwordErr) && empty($passwordConfirmationErr)){

            $user = new Users();
            $userPasswordArray = $user->createResetPasswordArray($username, $password);
            
            if ($user->checkLinkExpired($username,time())){
            	
            	$result = $user->updatePwd($userPasswordArray);
            	
            	if ($result['success']){
            		$_SESSION['forgot'] = "réinitialisation  réussi";
            		$_SESSION['msg'] = '';
            		redirect_to("connexion.php");
            	}else
            	{
            		
            		$_SESSION['forgot'] = "";
            		
            		$_SESSION['msg'] = 'échec de la modification du mot de passe';
            		redirect_to("restaurerpwd.php");
            	}
                
            }
            else{
                
                $_SESSION['msg'] = 'le lien a expire';
                $_SESSION['logIn'] = "false";
                $_SESSION['forgot'] = '';
                redirect_to("connexion.php");
            }
        }
    }

}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "layouts/header.php"; ?>
</head>
<body>
	<div class="generalInsc ">
		<div class=" title">
            <i class='fas  fa-angle-left '></i> <a class="back" href="index.php"> Page d'acceuil</a>
        </div>
        <div class="form-dispo-reint offset-md-4">
            <div class="offset-md-2 mb-4">
                <h5> Formulaire de reinitialisation du mot de passe</h5>
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
            ?>
            <div class="offset-md-1 mb-4">
                <form id="reinitialisation"  action="reinitialiserpwd.php" method="post">
                    <input type="hidden"  name="email"   value="<?php echo $mail;?>" />
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> Username:  </label>
                        <div class="col-sm-8">
                            <input type="text" class=" form-control mb-3" id="username" name="username"   value="<?php echo htmlentities($username);?>" required/>
                            <?php echo outputError($usernameErr);?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> Password:  </label>
                        <div class="col-sm-8">
                            <input type="password" class=" form-control mb-3" id="password" name="password"   value="<?php echo htmlentities($password);?>" required />
                            <?php echo outputError($passwordErr);?> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> Comfirmation password:  </label>
                        <div class="col-sm-8">
                            <input type="password" class=" form-control mb-3" id="password-confirmation" name="password-confirmation"value="<?php echo htmlentities($passwordConfirmation);?>" required />
                             <?php echo outputError($passwordConfirmationErr);?>
                        </div>
                    </div>
                    <div class="row offset-md-1">
                        <button type="submit" name="submit" class="btn btn-success col-sm-10 p-2 mb-2" >  restaurer  </button> <br>
                        <a  href="connexion.php" class="link btn btn-success col-sm-10  " role="button">   connexion   </a>
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