<?php
session_start();
ini_set('display_errors', 'on');
ini_set('log_errors', 1);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ob_start();
date_default_timezone_set('America/New_York');
require_once("../includes/functions.php");
require_once("../includes/utilisateurassocier.php");
require_once("../includes/session.php");

$message = '';
$memberErr = $associationErr = "";

if(empty($_SESSION['logIn']) && $_SESSION['logIn'] !== 'logged'){
    redirect_to("../admin/index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$member = ""; 
	$association = ""; 

    if(isset($_POST['submit'])){

    	$member = trim($_POST['member']);
		$association = trim($_POST['association']);
        
        $partner = new UtilisateurAssocier();
        //die(var_dump($nom,$prenom,$date,$adress));
        if (empty($member)) {
            $memberErr = "* Le choix du membre est obligatoire";
        } 
        if (empty($association)) {
            $associationErr = "* Le choix d'une association est obligatoire";
        } 
        //die(var_dump($nomErr,$prenom,$date,$adress));
        if (empty($message) && empty($memberErr) && empty($associationErr)){

            $partner = new UtilisateurAssocier();
            $partnerList = $partner->findAll();
            //die(var_dump($partnerList));
            if(searchPartner($member,$association,$partnerList))
            {
                $message = "ce membre appartient deja a ce club.";
                redirect_to("../admin/inscrireMembreAssociation.php");
            }
            else
            {
                $partnerArray = $partner->createPartnerArray($member, $association);
                //die(var_dump($partnerArray));
                $result = $partner->createPartner($partnerArray);
                if ($result['success']){
                    redirect_to("../admin/listeMembre.php");
                }
                else{
                    $message = "Il y a eu une erreur lors de l'ajout d'un membre dans une association.";
                    redirect_to("../admin/inscrireMembreAssociation.php");
                }
            }
            
        } else{
                $message = "Il y a eu une erreur lors de l'ajout d'un membre dans une association.";
                redirect_to("../admin/inscrireMembreAssociation.php");
            }
    }

}
?>