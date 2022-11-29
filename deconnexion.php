<?php
session_start();

require_once("includes/config.php");
require_once("includes/functions.php");
require_once("includes/session.php");

$session = new Session();

$session->logout();
session_destroy();
redirect_to("../index");
?>