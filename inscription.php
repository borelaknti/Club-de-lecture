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
                 $birthdayErr = "*la date est trop recente";
                 
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

        if (empty($message) && empty($nameErr) && empty($usernameErr) && empty($birthdayErr) && empty($emailErr) && empty($passwordErr) && empty($passwordConfirmationErr)){

            $user = new Users();
            $userArray = $user->createUserArray($fname, $lname, $birthday, $address, $sexe,$username, $password, $email);
            //die(var_dump($userArray));
            $result = $user->createUser($userArray);
            if ($result['success']){
                $session->newUserloggedIn($result['userid']);
                $_SESSION['logIn'] = 'logged';
                redirect_to("admin/index");
            }
            else{
                $message = "Il y a eu une erreur lors de la création de l'usager.";
                $_SESSION['logIn'] = 'false';
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
	<div class="generalInsc insc">
		<div class="title">
			<i class='fas  fa-angle-left '></i> <a class="back" href="index.php"> Page d'acceuil</a>
		</div>
		<form id="login" action="inscription.php" method="post">
			<fieldset>
				<legend>La lecture d’un roman jette sur la vie une lumière</legend>
				<table class="tab-insc" cellpadding="10" cellspacing="5">
					<tr> <td><label for="fname">First name:</label> </td> <td><input type="text" id="fname" name="fname" maxlength="100"  value="<?php echo htmlentities($fname);?>" required /> <span class="error"> <?php echo $fnameErr;?></span> </td> </tr>
					<tr><td><label for="lname">Last name:</label></td> <td><input type="text" id="lname" name="lname" maxlength="100"  value="<?php echo htmlentities($lname);?>" required /> <span class="error"> <?php echo $lnameErr;?></span> </td> </tr>
					<tr><td><label for="email">Email:</label></td><td><input type="email" id="email" name="email" value="<?php echo htmlentities($email);?>" required /> <span class="error"> <?php echo $emailErr;?></span></td></tr>
					<tr><td><label for="birthday">Birthday:</label> </td> <td> <input type="date" id="birthday" name="birthday" value="<?php echo htmlentities($birthday);?>" required /> <span class="error"> <?php echo $birthdayErr;?></span> </td></tr>
					<tr> <td><label for="sexe">Sexe:</label> </td> <td> <select  name="sexe" id="sexe"> <option value="masculin"> Masculin</option>  <option value="feminin"> Feminin </option></select> </td></tr>
					<tr><td><label for="adress">Address: </label> </td> <td> <input type="text" id="address" name="address" maxlength="150"  value="<?php echo htmlentities($address);?>" required /> <span class="error"> <?php echo $addressEr;?></span> </td></tr>
					<tr><td><label for="username">Username : </label> </td> <td> <input type="text" id="username" name="username" maxlength="30"  value="<?php echo htmlentities($username);?>" required /> <span class="error"> <?php echo $usernameErr;?></span></td></tr>
					<tr><td><label for="password">Password:</label> </td> <td> <input type="password" id="password" name="password" maxlength="30"  value="<?php echo htmlentities($password);?>" required /> <span class="error"> <?php echo $passwordErr;?></span> </td></tr>
					<tr><td><label for="password-confirmation">Password-confirmation:</label> </td> <td> <input type="password" id="password-confirmation" name="password-confirmation"value="<?php echo htmlentities($passwordConfirmation);?>" required /> <span class="error"> <?php echo $passwordConfirmationErr;?></span></td></tr>
				</table>
				<div class="btn-insc">
					<button  class="btn btn-clean" type="submit" name="submit"> s'inscrire </button> <br> <br>
            		<a href="connexion.php"> <button type="button" class="btn btn-clean"> connexion </button> </a>
				</div>
			</fieldset>
		</form>
		<?php include_once "layouts/footer.php"; ?>
	</div>
</body>
</html>