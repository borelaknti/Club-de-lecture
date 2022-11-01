<?php
session_start();
ini_set('display_errors', 'on');
ini_set('log_errors', 1);
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ob_start();
date_default_timezone_set('America/New_York');

require_once("../includes/functions.php");
require_once("../includes/Association.php");
require_once("../includes/utilisateurassocier.php");
require_once("../includes/session.php");
require_once("../formProcessing/liste_membre.php");

if(empty($_SESSION['logIn']) && $_SESSION['logIn'] !== 'logged'){
    redirect_to("../connexion");
}

if(isset($_GET['id']))
{
    $asso = new UtilisateurAssocier();
    $res = $asso->deleteMembreAssociation($_GET['id']);
    if($res['success'])
    {
        $association = new Association();
        $result = $association->deleteAssociation($_GET['id']);
        if ($result['success']) {
            redirect_to("../admin/listeAssociation.php");
        }else
        {
            $message = "Il y a eu une erreur lors de la suppression de l'association";
            redirect_to("../admin/listeAssociation.php");
        }
    } else
    {
        $message = "Il y a eu une erreur lors de la suppression de l'association";
        redirect_to("../admin/listeAssociation.php");
    }
}
else
{
    $message = "Il y a eu une erreur lors de la suppression de l'association";
    redirect_to("../admin/listeAssociation.php");
}
