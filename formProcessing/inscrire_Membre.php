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

$_SESSION['msg'] = '';
$_SESSION['nomErr'] = $_SESSION['prenomErr'] = $_SESSION['emailErr'] =  $_SESSION['dateErr'] = $_SESSION['adresseErr'] = $_SESSION['sexeErr'] =  "";
$_SESSION['nom'] = $_SESSION['prenom'] = $_SESSION['email'] =  $_SESSION['date'] = $_SESSION['adresse'] = $_SESSION['sexe'] =  "";

if(empty($_SESSION['logIn']) && $_SESSION['logIn'] !== 'logged'){
    redirect_to("../admin/index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$nom = ""; 
	$prenom = "";
	$date = ""; 
	$adresse = ""; 
    $email = "";
    $sexe = "";

    if(isset($_POST['submit'])){

    	$nom = trim($_POST['nom']);
		$prenom = trim($_POST['prenom']);;
		$date = trim($_POST['date']);; 
		$adresse = trim($_POST['adresse']);; 
        $email = trim($_POST['email']);
        $sexe = trim($_POST['sexe']);
        
        $user = new Users();
        //die(var_dump($birthday));
        if (empty($nom)) {
            $_SESSION['nomErr'] = "* Le nom est obligatoire";
        } else {
            $_SESSION['nom'] = cleanUpInputs($nom);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$nom)) {
                $_SESSION['nomErr'] = "* Seules les lettres et les espaces blancs sont autorisés";
            }
            if (strlen($nom) > 100) {
                $_SESSION['nomErr'] = "* Le nom doit comporter un maximum de 100 caractères.";
            }
        }if (empty($prenom)) {
            $_SESSION['prenomErr'] = "* Le prenom est obligatoire";
        } else {
            $_SESSION['prenom'] = cleanUpInputs($prenom);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$prenom)) {
                $_SESSION['prenomErr'] = "* Seules les lettres et les espaces blancs sont autorisés";
            }
            if (strlen($prenom) > 100) {
                $_SESSION['prenomErr'] = "* Le prenom doit comporter un maximum de 100 caractères.";
            }
        }
        if (empty($date)) {
            $_SESSION['dateErr'] = "* La date de naissance est obligatoire";
        }
        else
        {
            $_SESSION['date'] = cleanUpInputs($date);
            $dt = time();
            $dt = date("Y-m-d", $dt);
            $val = $dt - $date;
            if($val <= 6)
                $_SESSION['dateErr'] = "* vous avez ".$val." ans et vous devez avoir au mois 7 ans";
            
            //die(var_dump( $val ));
        }
        if (empty($adresse)) {
            $_SESSION['adresseErr'] = "* l'adresse est obligatoire";
        }
        else
        {   $_SESSION['adresse'] = cleanUpInputs($adresse);
            //die(var_dump(ctype_alnum($adresse)));
            /*
             * Corrections : dans la validation des adresses, il faut aussi permettre les espaces.
             * Donc créer une fonction de validation personnalisée et utiliser preg_match() avec une expression régulière.
             */
            if (!ctype_alnum($adresse)) {
                $_SESSION['adresseErr'] = "* ne peut pas contenir seulement les chiffres mais doit aussi contenir des lettres";
            }
        }
        if (empty($email)) {
            $_SESSION['emailErr'] = "* Le nom est obligatoire";
        } else {
            $_SESSION['email'] = cleanUpInputs($email);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['emailErr'] = "* Seules les lettres et les chiffres sont autorisés";
            }
        } 

        if (empty($_SESSION['msg']) && empty($_SESSION['nomErr']) && empty($_SESSION['prenomErr'])&& empty($_SESSION['adresseErr']) && empty($_SESSION['dateErr']) && empty($_SESSION['emailErr']) ){

            $user = new Users();
            $userList = $user->findAllMember();
            if(searchMember($nom,$userList))
            {
                $_SESSION['msg'] = "Il y a deja un membre qui existe a ce nom.";
                redirect_to("../admin/inscrireMembre.php");;
            }else
            {
                $userArray = $user->createUserMember($nom, $prenom, $date, $adresse, $sexe, $email);
                //die(var_dump($userArray));
                $result = $user->createMember($userArray);
                if ($result['success']){
                    redirect_to("../admin/listeMembre.php");
                }
                else{
                    $_SESSION['msg'] = "Il y a eu une erreur lors de la création de l'usager.";
                    redirect_to("../admin/inscrireMembre.php");;
                }
            }
            
        }else{
                $_SESSION['msg'] = "Il y a eu une erreur lors de la création de l'usager.";
                redirect_to("../admin/inscrireMembre.php");;
            }
    }

}
?>