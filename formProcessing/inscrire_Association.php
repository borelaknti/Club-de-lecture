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

$message = '';
$nomErr = $adressErr = $dateErr =  $createurErr =  "";

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
            $nomErr = "* Le nom de l'association est obligatoire";
        } else {
            $nom = cleanUpInputs($nom);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$fnom)) {
                $nomErr = "* Seules les lettres et les espaces blancs sont autorisés";
            }
            if (strlen($nom) > 100) {
                $nomErr = "* Le nom  de l'association doit comporter un maximum de 100 caractères.";
            }
        }
        if (empty($date)) {
            $dateErr = "* La date de naissance est obligatoire";
        } 
        if (empty($adress)) {
            $adressErr = "* l'adresse est obligatoire";
        }
        if (empty($createur)) {
            $createurErr = "* Le nom du createur est obligatoire";
        } else {
            $createur = cleanUpInputs($createur);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$createur)) {
                $createurErr = "* Seules les lettres et les espaces blancs sont autorisés";
            }
            if (strlen($createur) > 100) {
                $createurErr = "* Le nom du createur de l'association doit comporter un maximum de 100 caractères.";
            }
        } 
        //die(var_dump($nomErr,$prenom,$date,$adress));
        if (empty($message) && empty($nomErr) && empty($createurErr) && empty($dateErr) && empty($adressErr) ){

            $association = new Association();
            $associationList = $association->findAll();
            if(searchAssociation($nom,$associationList)) 
            {
                $message = "Il y a deja une association a ce nom";
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
                    $message = "Il y a eu une erreur lors de la création de l'association.";
                    redirect_to("../admin/inscrireAssociation.php");
                }
            }
            
        } else{
                $message = "Il y a eu une erreur lors de la création de l'association.";
                redirect_to("../admin/inscrireAssociation.php");
            }
    }

}
?>