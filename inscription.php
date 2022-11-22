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
$fnameErr = $lnameErr = $emailErr =  $birthdayErr = $addressErr = $usernameErr = $passwordErr= $passwordConfirmationErr = "";

if($_SESSION['logIn']=='logged'){
    redirect_to("admin/index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$fname = ""; 
	$lname = "";
	$birthday = ""; 
	$address = ""; 
    $username = "";
    $password = "";
    $sexe = "";
    $email = "";
    $passwordConfirmation = "";

    if(isset($_POST['submit'])){

    	$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);;
		$birthday = trim($_POST['birthday']);; 
		$address = trim($_POST['address']);; 
        $username = trim($_POST['username']);
        $sexe = trim($_POST['sexe']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $passwordConfirmation = trim($_POST['password-confirmation']);
        
        $user = new Users();
        //die(var_dump($birthday));
        if (empty($fname)) {
            $fnameErr = "* Le nom est obligatoire";
        } else {
            $fname = cleanUpInputs($fname);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
                $fnameErr = "* Seules les lettres et les espaces blancs sont autorisés";
            }
            if (strlen($fname) > 100) {
                $fnameErr = "* Le nom doit comporter un maximum de 100 caractères.";
            }
        }if (empty($lname)) {
            $lnameErr = "* Le prenom est obligatoire";
        } else {
            $lname = cleanUpInputs($lname);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
                $lnameErr = "* Seules les lettres et les espaces blancs sont autorisés";
            }
            if (strlen($lname) > 100) {
                $lnameErr = "* Le nom doit comporter un maximum de 100 caractères.";
            }
        }
        if (empty($birthday)) {
            $birthdayErr = "* La date de naissance est obligatoire";
        } else {
            $date = '2012-01-01';
            //die(var_dump($date < $birthday));
            if( $date < $birthday){
                 $birthdayErr = "*la date est trop recente 2012-01-01";
                 
            }
        }
        if (empty($address)) {
            $addressErr = "* l'addresse est obligatoire";
        }
        if (empty($username)) {
            $usernameErr = "* Le nom d'usager est obligatoire";
        } else {
            $username = cleanUpInputs($username);

            if ($user->userUnique($username)){
                $usernameErr = "* Le nom d'usager existe déjà.";
            }

            if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
                $usernameErr = "* Seules les lettres et les chiffres sont autorisés";
            }
            if (strlen($username) > 15) {
                $usernameErr = "* Le nom doit comporter un maximum de 15 caractères.";
            }
        }
        if (empty($email)) {
            $emailErr = "* Le nom est obligatoire";
        } else {
            $email = cleanUpInputs($email);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "* Seules les lettres et les chiffres sont autorisés";
            }
        }
        if (empty($password)) {
            $passwordErr = "* Le mot de passe est obligatoire";
        } else {
            $password = cleanUpInputs($password);

        }
        if (empty($passwordConfirmation)) {
            $passwordConfirmationErr = "* La confirmation du mot de passe est obligatoire";
        } else {
            $passwordConfirmation = cleanUpInputs($passwordConfirmation);

        }
        if ($password !== $passwordConfirmation){
            $message = "Les deux mots de passes ne sont pas identiques";
        }

        if (empty($message) && empty($lnameErr)&& empty($fnameErr) && empty($usernameErr) && empty($birthdayErr) && empty($emailErr) && empty($passwordErr) && empty($passwordConfirmationErr)){

            $user = new Users();
            $userList = $user->findAllAdministrator(); 
            $res = searchUser($fname,$lname,$userList);
            if(!$res)
            {
            $userArray = $user->createUserArray($fname, $lname, $birthday, $address, $sexe,$username, $password, $email);
            //die(var_dump($userArray));
            $result = $user->createUser($userArray);
            //die(var_dump($res));
            
               if ($result['success']){
                $session->newUserloggedIn($result['userid']);
                $_SESSION['logIn'] = 'logged';
                //$message = "Il y a eu une erreur lors de la création de l'usager.";
                redirect_to("admin/index");
                }
                else{
                    $message = "Il y a eu une erreur lors de la création de l'usager.";
                    $_SESSION['logIn'] = 'false';
                } 
            }else
            {
                $_SESSION['msg']="l'administrateur existe deja.";
                $_SESSION['forgot']="";
                $_SESSION['logIn'] = 'false';
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
	<div class="generalInsc">
		<div class=" title">
            <i class='fas  fa-angle-left '></i> <a class="back" href="index.php"> Page d'acceuil</a>
        </div>
        <div class="form-dispo offset-md-4">
            <div class="offset-md-2 mb-4">
                <h5> La lecture d’un roman jette sur la vie une lumière </h5>
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
        <div class="insc-pos-form offset-md-1 mb-4">
                <form id="login" action="inscription.php" method="post">
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> First name:  </label>
                        <div class="col-sm-8">
                            <input type="text" class=" form-control mb-3"  id="fname" name="fname"  value="<?php echo htmlentities($fname);?>" required />
                           <?php echo outputError($fnameErr) ;?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> Last name:  </label>
                        <div class="col-sm-8">
                            <input type="text" class=" form-control mb-3"  id="lname" name="lname"   value="<?php echo htmlentities($lname);?>" required />
                            <?php echo outputError($lnameErr);?> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> Email:  </label>
                        <div class="col-sm-8">
                            <input type="email" class=" form-control mb-3" id="email" name="email" value="<?php echo htmlentities($email);?>" required />
                            <?php echo outputError($emailErr);?>
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
                        <label  class="col-sm-3 col-form-label "> Birthday:  </label>
                        <div class="col-sm-8">
                            <input type="date" class=" form-control mb-3" id="birthday" name="birthday" value="<?php echo htmlentities($birthday);?>" required />
                            <?php echo outputError($birthdayErr);?> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label "> Address:  </label>
                        <div class="col-sm-8">
                            <input type="text" class=" form-control mb-3" id="address" name="address"   value="<?php echo htmlentities($address);?>" required />
                            <?php echo outputError($addressErr);?>
                        </div>
                    </div>
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
                             <?php echo outputError($passwordConfirmation);?>
                        </div>
                    </div>
                    <div class="row offset-md-1">
                        <button type="submit" name="submit" class="btn btn-success col-sm-10 p-2 mb-2" >  S'inscrire  </button> <br>
                        <a  href="connexion.php" class="link btn btn-success col-sm-10  " role="button">   se connecter   </a>
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