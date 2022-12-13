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

$_SESSION['msg'] = '';
$_SESSION['forgot'] = '';
$_SESSION['memberErr'] = $_SESSION['associationErr'] = "";
$_SESSION['member'] = $_SESSION['association'] = "";

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
        if (empty($member)) {
            $_SESSION['memberErr'] = " Le choix du membre est obligatoire";
            
        } 
        if (empty($association)) {
            $_SESSION['associationErr'] = " Le choix d'une association est obligatoire";
            
        } 
        if (empty($_SESSION['msg']) && empty($_SESSION['memberErr']) && empty($_SESSION['associationErr'])){


            $partner = new UtilisateurAssocier();
            $partnerList = $partner->findAll();
            if(searchPartner($member,$association,$partnerList))
            {
                $_SESSION['msg'] = "le membre appartient déja au club ";
                $_SESSION['member'] = cleanUpInputs($member);
                $_SESSION['association'] = cleanUpInputs($association);
                redirect_to("../admin/inscrireMembreAssociation.php");
            }
            else
            {
                $partnerArray = $partner->createPartnerArray($member, $association);
                $result = $partner->createPartner($partnerArray);
                if ($result['success']){
                    $_SESSION['forgot'] = "le membre a bien été ajouter dans l'association";
                    redirect_to("../admin/inscrireMembreAssociation.php");
                }
                else{
                    $_SESSION['msg'] = "Il y a eu une erreur lors de l'ajout d'un membre dans une association.";
                    $_SESSION['member'] = cleanUpInputs($member);
                    $_SESSION['association'] = cleanUpInputs($association);
                    redirect_to("../admin/inscrireMembreAssociation.php");
                }
            }
            
        } else{
                $_SESSION['msg'] = "Il y a eu une erreur lors de l'ajout d'un membre dans une association.";
                redirect_to("../admin/inscrireMembreAssociation.php");
            }
    }

}
?>