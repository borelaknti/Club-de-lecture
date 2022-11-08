<?php
session_start();
ini_set('display_errors', 'on');
ini_set('log_errors', 1);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ob_start();
date_default_timezone_set('America/New_York');
require_once("../includes/functions.php");
require_once("../includes/Association.php");
require_once("../includes/session.php");

$_SESSION['msg'] = '';
$_SESSION['nomErr'] = $_SESSION['adressErr'] = $_SESSION['dateErr'] =  $_SESSION['createurErr'] =  "";

if(empty($_SESSION['logIn']) && $_SESSION['logIn'] !== 'logged'){
    redirect_to("../admin/index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$nom = ""; 
	$adress = "";
	$date = ""; 
	$createur = ""; 

    if(isset($_POST['submit'])){

    	$nom = trim($_POST['nom']);
		$adress = trim($_POST['adress']);
		$date = trim($_POST['date']); 
		$createur = trim($_POST['createur']); 
        
        $association = new Association();
        //die(var_dump($nom,$prenom,$date,$adress));
        if (empty($nom)) {
            $_SESSION['nomErr'] = "* Le nom de l'association est obligatoire";
        } else {
            $nom = cleanUpInputs($nom);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$nom)) {
                $_SESSION['nomErr'] = "* Seules les lettres et les espaces blancs sont autorisés";
            }
            if (strlen($nom) > 100) {
                $_SESSION['nomErr'] = "* Le nom  de l'association doit comporter un maximum de 100 caractères.";
            }
        }
        if (empty($date)) {
            $_SESSION['dateErr'] = "* La date de naissance est obligatoire";
        } 
        if (empty($adress)) {
            $_SESSION['adressErr'] = "* l'adresse est obligatoire";
        }
        if (empty($createur)) {
            $_SESSION['createurErr'] = "* Le nom du createur est obligatoire";
        } else {
            $createur = cleanUpInputs($createur);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$createur)) {
                $_SESSION['createurErr'] = "* Seules les lettres et les espaces blancs sont autorisés";
            }
            if (strlen($createur) > 100) {
                $_SESSION['createurErr'] = "* Le nom du createur de l'association doit comporter un maximum de 100 caractères.";
            }
        } 
        //die(var_dump($_SESSION['nomErr'],$prenom,$date,$adress));
        if (empty($_SESSION['msg']) && empty($_SESSION['nomErr']) && empty($_SESSION['createurErr']) && empty($_SESSION['dateErr']) && empty($_SESSION['adressErr']) ){

            $association = new Association();
            $associationList = $association->findAll();
            if(searchAssociation($nom,$associationList)) 
            {
                $_SESSION['msg'] = "Il y a deja une association a ce nom";
                redirect_to("../admin/inscrireAssociation.php");
            } else
            {
                $associationArray = $association->createAssociationArray($nom, $createur, $date, $adress);
                //die(var_dump($associationArray));
                $result = $association->createAssociation($associationArray);
                if ($result['success']){
                    redirect_to("../admin/listeAssociation.php");
                }
                else{
                    $_SESSION['msg'] = "Il y a eu une erreur lors de la création de l'association.";
                    redirect_to("../admin/inscrireAssociation.php");
                }
            }
            
        } else{
                $_SESSION['msg'] = "Il y a eu une erreur lors de la création de l'association.";
                redirect_to("../admin/inscrireAssociation.php");
            }
    }

}
?>