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
require_once("includes/PhpMail.php");


//$page = "forget-password";
//$active = "active";
$message = "";
$emailErr = "";

if(empty($_SESSION['logIn']) && $_SESSION['logIn'] == 'logged'){
    redirect_to("../admin/index.php");
}
	//die("23");

if(isset($_POST['submit'])){

   	$email = cleanUpInputs($_POST['email']);
   	$user = new Users();
    $userList = $user->findAll();
    $res = founduser($email,$userList);

    
    if($res)
    {
    	$result = $user->passwordTime($email); 
    	if($result["success"])
    	{
    		$mail = new PhpMail();
    		try{
    			$url = $_SERVER['HTTP_ORIGIN'].'/reinitialiserpwd.php';
    			
        		$emailMessage = '<a href="'.$url.'"> cliquer ici pour changer le mot de passe. </a>';
        		//die(var_dump($emailMessage));
  	    		$mail->send_mail_by_PHPMailer($email,"borelaknti@gmail.com",'courriel de changement de mot de passe',$emailMessage);
        		$_SESSION['forgot'] = "le courriel de changement de mot de passe a ete envoye";
        		 
        		redirect_to('/connexion.php');
        	}
        	catch(Exception $e)
		    {
		    	$e.errorMessage();
		    }
		}

		}
    }
    else
    {
    	$email="";
    }

?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "layouts/header.php"; ?>
</head>
<body>
	<div class="generalInsc rest">
		<div class="title">
			<i class='fas  fa-angle-left '></i> <a class="back" href="index.php"> Page d'acceuil</a>
		</div>
		<div class="rest">
			<form id="restaurer" action="restaurerpwd.php" method="post">
				<fieldset>
					<legend>La lecture d’un roman jette sur la vie une lumière</legend>
					<table class="tab-insc" cellpadding="10" cellspacing="15">
						<tr>
							<td>
								<label for="email">Email:</label></td><td><input type="text" id="email" name="email" value="<?php echo htmlentities($email);?>" required/>
							</td>
						</tr>
					</table>
					<div class="btn-insc">
						<button  type="submit" name="submit" class="btn btn-clean"> restaurer </button><br> <br>
            			<a href="connexion.php"> <button type="button" class="btn btn-clean"> connexion </button> </a>
					</div>
				</fieldset>
			</form>	
		</div>
		<?php include_once "layouts/footer.php"; ?>
	</div>
</body>
</html>