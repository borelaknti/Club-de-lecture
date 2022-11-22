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
$message = $_SESSION['message'] ?? '';;
$forgot = $_SESSION['forgot'] ?? '';
$msg = $_SESSION['msg'] ?? '';
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
  	    		$mail->send_mail_by_PHPMailer($email,"fitsdev21@gmail.com",'courriel de changement de mot de passe',$emailMessage);
        		$_SESSION['forgot'] = "le courriel de changement de mot de passe a ete envoye";
        		$_SESSION['msg']= "";
        		redirect_to('/connexion.php');
        	}
        	catch(Exception $e)
		    {
		    	$e.errorMessage();
		    }
		}else
		{
			$message = "erreur de reinitialisation du mot de passe";
		}

		}
    else
    {
    	$message = "L'email ne correspond a aucun utilisateur";
    	$email="";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "layouts/header.php"; ?>
</head>
<body>
	<div class="generalInsc">
		<div class=" title">
			<i class='fas  fa-angle-left '></i> <a class="back" href="index.php"> Page d'acceuil</a>
		</div>
		<div class="form-dispo-rest offset-md-4">
			<div class="offset-md-2 mb-4">
				<h5> La lecture d’un roman jette sur la vie une lumière </h5>
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
            if ($msg){
                echo 
                    '<div class="row big-error">
                        <div class="col-sm-9 offset-md-1">
                            '.
                                outputError($msg).
                    '
                        </div>
                    </div>';;
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
        <div class="offset-md-1 mb-4">
				<form id="restaurer" action="restaurerpwd.php" method="post">
  					<div class="form-group row">
  						<label  class="col-sm-3 col-form-label "> Email:  </label>
  						<div class="col-sm-8">
  							<input type="email" class=" form-control mb-3" id="email" name="email" value="<?php echo htmlentities($email);?>" required/>
  							<?php //echo outputError($fnameErr) ;?>
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