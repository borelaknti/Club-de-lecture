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

//$message = '';

$page = "connexion";

$active = 'active';

if($_SESSION['logIn']=='logged'){
    redirect_to("admin/index");
    //header("Location: admin/index.php");
}

//$session = new Session();

$message = '';
$forgot = $_SESSION['forgot'] ?? '';
$msg = $_SESSION['msg'] ?? '';

if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $user = new Users();
    $foundUser = $user->authenticate($username,$password);
    //check database to check if it exists

    if($foundUser){
        $session->login($foundUser);
        $_SESSION['logIn'] = 'logged';
        redirect_to("../admin/index");
    }else{
        $message = "La combinaison nom d'utilisateur/mot de passe est incorrecte.";

        $_SESSION['logIn'] = 'false';
    }
}else {
    $username = "";
    $password = "";
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once "layouts/header.php"; ?>
</head>
<body>
	<div class="generalInsc conex">
		<div class="title">
			<i class='fas  fa-angle-left '></i> <a class="back" href="index.php"> Page d'acceuil</a>
		</div>
		<?php
		//die(var_dump($msg));
            if ($message){
                echo 
                	'<div class=" error-message">'.
                    		outputMessage($message).
                    '</div>';
            }
            if ($msg){
                echo 
                	'<div class=" error-message">'.
                    		outputMessage($msg).
                    '</div>';
            }
            if ($forgot){
                echo 
                	'<div class=" error-message">'.
                    		outputMessage($forgot).
                    '</div>';
            }
        ?>
		<form id="login" action="connexion.php" method="post">
			<fieldset >
				<legend>La lecture d’un roman jette sur la vie une lumière</legend>
				<table class="tab-insc" cellpadding="10" cellspacing="5">
					<tr><td><label >Login:</label></td><td><input type="text" id="" name="username" value="<?php echo htmlentities($username);?>" required/></td></tr>
					<tr><td><label >Mot de passe:  </label> </td> <td> <input type="password" id="" name="password" value="<?php echo htmlentities($password);?>" required/></td></tr>
				</table>
				<div class="btn-insc">
					 <button type="submit" name="submit" class="btn btn-clean"> connexion </button> <br> <br>
					<a href="inscription.php"> <button  type="button" class="btn btn-clean"> s'inscrire </button> </a> 
				</div>
				<div class="pwd">
					<a class="pass" href="restaurerpwd.php"> Mot de passe oublie</a> <i class='fas  fa-angle-right '></i> 
				</div>
			</fieldset>
		</form>
	</div>
	<?php include_once "layouts/footer.php"; ?>
</body>
</html>