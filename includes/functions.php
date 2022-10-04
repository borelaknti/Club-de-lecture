<?php

function cleanUpInputs($inputs): string
{
    $inputs = strip_tags($inputs);
    $inputs = trim($inputs);
    $inputs = stripslashes($inputs);
    return htmlspecialchars($inputs);
}

function outputMessage($message = ""){
    if(!empty($message)){
        return "<p class=\"message text-danger\">{$message}</p>";
    }else{
        return "";
    }
}

function redirect_to($location, $status=302)
{
   header('Location: '.$location, true, $status);
   exit();
}

