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
require_once("../includes/PhpMail.php");


//$page = "forget-password";
//$active = "active";
$message = "";
$emailErr = "";

if(empty($_SESSION['logIn']) && $_SESSION['logIn'] !== 'logged'){
    redirect_to("../admin/index.php");
}


if(isset($_POST['submit'])){
    $email = cleanUpInputs($_POST['email']);
    $user = new Users();
    $userList = $user->findAllMember();
    $res = $user->founduser($email,$userList);
    if($res)
    {
        $result = $user->passwordTime($email); 
        if($result["success"])
        {
            $mail = new PHPMail();
            //try{
                $url = $_SERVER['HTTP_ORIGIN'].'/password-reset';
                $emailMessage = '<a href="'.$url.'">cliquer ici pour changer le mot de passe. </a>';
                $mail->send_mail_by_PHPMAILER($email,"borelaknti@gmail.com",'courriel de changement de mot de passe',$emailMessage);
                $_SESSION['forgot'] = "le courriel de changement de mot de passe a ete envoye";
                 
                redirect_to('/connexion.php');
            //}
            //catch($e)
            //{
            //  $e.errorMessage();
            //}
        }

        }
    }
    else
    {
        $email="";
    }

?>