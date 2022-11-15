<?php
session_start();

require_once("includes/config.php");
require_once("includes/functions.php");
require_once("includes/session.php");
/*
 * À corriger pour la finale : d'abord déclarer un objet de la classe session, puis appeler la fonction logout().
 * session_destroy() permet quand même de se déconnecter.
 */
$session->logout();
session_destroy();
redirect_to("../index");
?>