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
require_once("../formProcessing/liste_membre.php");

if(empty($_SESSION['logIn']) && $_SESSION['logIn'] !== 'logged'){
    redirect_to("../connexion");
}

$users = new Users();
$user = $users->findUser($_GET['id']);
if ($user[0]->etatUtilisateur == 'A'){
    
    $var = 'I';
    $result = $users->updateEtat($_GET['id'],$var);
    
    if ($result['success']){
        redirect_to("../admin/listeMembre.php");
    }
    else{
        $_SESSION['message'] = "Il y a eu une erreur lors du changement d'etat.";
    }
}
else
{
    $var = 'A';
    $result = $users->updateEtat($_GET['id'],$var);
    if ($result['success']){
        redirect_to("../admin/listeMembre.php");
    }
    else{
        $message = "Il y a eu une erreur lors du changement d'etat.";
        
    }
}
?>