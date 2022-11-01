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

$message = '';
$nomErr = $prenomErr = $emailErr =  $dateErr = $adresseErr = $sexeErr =  "";

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
            $nomErr = "* Le nom est obligatoire";
        } else {
            $nom = cleanUpInputs($nom);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$fnom)) {
                $nomErr = "* Seules les lettres et les espaces blancs sont autorisés";
            }
            if (strlen($nom) > 100) {
                $nomErr = "* Le nom doit comporter un maximum de 100 caractères.";
            }
        }if (empty($prenom)) {
            $prenomErr = "* Le prenom est obligatoire";
        } else {
            $prenom = cleanUpInputs($prenom);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$prenom)) {
                $prenomErr = "* Seules les lettres et les espaces blancs sont autorisés";
            }
            if (strlen($prenom) > 100) {
                $prenomErr = "* Le prenom doit comporter un maximum de 100 caractères.";
            }
        }
        if (empty($date)) {
            $dateErr = "* La date de naissance est obligatoire";
        } 
        if (empty($adresse)) {
            $adresseErr = "* l'adresse est obligatoire";
        }
        if (empty($email)) {
            $emailErr = "* Le nom est obligatoire";
        } else {
            $email = cleanUpInputs($email);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "* Seules les lettres et les chiffres sont autorisés";
            }
        } 

        if (empty($message) && empty($nomErr) && empty($prenomErr) && empty($dateErr) && empty($emailErr) ){

            $user = new Users();
            $userList = $user->findAllMember();
            if(searchMember($nom,$userList))
            {
                $message = "Il y a deja un membre qui existe a ce nom.";
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
                    $message = "Il y a eu une erreur lors de la création de l'usager.";
                    redirect_to("../admin/inscrireMembre.php");;
                }
            }
            
        }else{
                $message = "Il y a eu une erreur lors de la création de l'usager.";
                redirect_to("../admin/inscrireMembre.php");;
            }
    }

}
?>