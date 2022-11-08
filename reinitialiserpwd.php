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
        //die(var_dump($birthday));
        if (empty($username)) {
            $usernameErr = "* Le nom d'usager est obligatoire";
        } else {
            $username = cleanUpInputs($username);

            if (!$user->userUnique($username)){
                $usernameErr = "* Le nom d'usager existe déjà.";
            }
        }
        if (empty($password)) {
            $passwordErr = "* Le mot de passe est obligatoire";
        }
        if (empty($passwordConfirmation)) {
            $passwordConfirmationErr = "* La confirmation du mot de passe est obligatoire";
        } 
        if ($password !== $passwordConfirmation){
            $message = "Les deux mots de passes ne sont pas identiques";
        }

        if (empty($message) &&  empty($usernameErr)  && empty($passwordErr) && empty($passwordConfirmationErr)){

            $user = new Users();
            $userPasswordArray = $user->createResetPasswordArray($username, $password);
            //die(var_dump($userArray));
            if ($user->checkLinkExpired($username,time())){
            	//die(var_dump($user->checkLinkExpired($username,time())));
            	$result = $user->updatePwd($userPasswordArray);
            	//$result = ['success'=> false];
            	if ($result['success']){
            		$_SESSION['forgot'] = "reinitialisation  reussi";
            		$_SESSION['msg'] = '';
            		redirect_to("connexion.php");
            	}else
            	{
            		//die(var_dump("connexion ecchoue"));
            		$_SESSION['forgot'] = "";
            		//$_SESSION['message'] = "";
            		$_SESSION['msg'] = 'echec de la modification du mot de passe';
            		redirect_to("restaurerpwd.php");
            	}
                
            }
            else{
                //$message = "Il y a eu une erreur lors de la création de l'usager.";
                //die(var_dump("lien expire"));
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
	<div class="generalInsc rest">
		<div class="rest">
			<?php
            	if ($message){
                	echo 
                    	'<div class=" error-message">'.
                            outputMessage($message).
                    	'</div>';
            		}
        	?>
			<form id="reinitialisation"  action="reinitialiserpwd.php" method="post">
				<fieldset>
					<legend>Formulaire de reinitialisation du mot de passe</legend>
					<table class="tab-insc" cellpadding="10" cellspacing="15">
						<tr>
                        <td><label for="username">Username : </label> </td> <td> <input type="text" id="username" name="username" maxlength="30"  value="<?php echo htmlentities($username);?>" required /> <span class="error"> <?php echo $usernameErr;?></span></td>
                    	</tr>
					<tr>
                        <td><label for="password">Password :</label> </td> <td> <input type="password" id="password" name="password" maxlength="30"  value=" <?php echo htmlentities($password);?>" required /> <span class="error"> <?php echo $passwordErr;?></span> </td>
                    </tr>
					<tr>
                        <td><label for="password-confirmation">Password-confirmation:</label> </td> <td> <input type="password" id="password-confirmation" name="password-confirmation"value="<?php echo htmlentities($passwordConfirmation);?>" required /> <span class="error"> <?php echo $passwordConfirmationErr;?></span></td>
                    </tr>
					</table>
					<div class="btn-insc">
						<button  type="submit" name="submit" class="btn btn-clean"> restaurer </button> <br> <br>
            			<a href="connexion.php"> <button type="button" class="btn btn-clean"> connexion </button> </a>
					</div>
				</fieldset>
			</form>	
		</div>
		<?php include_once "layouts/footer.php"; ?>
	</div>
</body>
</html>