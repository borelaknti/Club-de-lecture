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
	<div class="generalInsc">
		<div class=" title">
			<i class='fas  fa-angle-left '></i> <a class="back" href="index.php"> Page d'acceuil</a>
		</div>
		<div class="form-dispo-connex offset-md-4">
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
				<form id="login" action="connexion.php" method="post">
  					<div class="form-group row">
  						<label  class="col-sm-3 col-form-label "> Username:  </label>
  						<div class="col-sm-8">
  							<input type="text" class=" form-control mb-3"  name="username" value="<?php echo htmlentities($username);?>" required/>
  						</div>
  					</div>
  					<div class="form-group row">
  						<label  class="col-sm-3 col-form-label "> Password:  </label>
  						<div class="col-sm-8">
  							<input type="password" class=" form-control mb-3" id="" name="password" value="<?php echo htmlentities($password);?>" required/>
  						</div>
  					</div>
  					<div class="row offset-md-1">
						<button type="submit" name="submit" class="btn btn-success col-sm-10 p-2 mb-2" >  se connecter   </button> <br>
						<a  href="inscription.php" class="link btn btn-success col-sm-10  " role="button">   S'inscrire  </a>
					</div>
					<div class="pwd">
						<a class="pass" href="restaurerpwd.php"> Mot de passe oublie</a> <i class='fas  fa-angle-right '></i> 
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