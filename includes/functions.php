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

function searchMember($nom,$clientList)
{
    foreach ($clientList as $client)
    {
        if ($client->nomUtilisateur == $nom)
            return true;
    }
    return false;
}

function searchAssociation($nom,$associationList)
{
    foreach ($associationList as $asso)
    {
        if ($asso->nomAssociation == $nom)
            return true;
    }
    return false;
}

function searchPartner($member,$association,$partnerList)
{
    foreach ($partnerList as $partner)
    {
        if ($partner->fknumAssociation == $association && $partner->fknumUtilisateur == $member)
            return true;
    }
    return false;
}

function founduser($email,$userList)
{
    foreach($userList as $user)
    {
        if($user->utilisateur_email == $email)
            return true;
    }

    return false;
}