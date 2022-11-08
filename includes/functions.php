<?php

function cleanUpInputs($inputs): string
{
    $inputs = strip_tags($inputs);
    $inputs = trim($inputs);
    $inputs = stripslashes($inputs);
    return htmlspecialchars($inputs);
}

function outputMessage($message = "") :string
{
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

function searchMember($nom,$clientList) :bool
{
    foreach ($clientList as $client)
    {
        if ($client->nomUtilisateur == $nom)
            return true;
    }
    return false;
}

function searchAssociation($nom,$associationList) :bool
{
    foreach ($associationList as $asso)
    {
        if ($asso->nomAssociation == $nom)
            return true;
    }
    return false;
}

function searchPartner($member,$association,$partnerList) :bool
{
    foreach ($partnerList as $partner)
    {
        if ($partner->fknumAssociation == $association && $partner->fknumUtilisateur == $member)
            return true;
    }
    return false;
}

function founduser($email,$userList) :bool
{
    foreach($userList as $user)
    {
        if($user->utilisateur_email == $email && $user->login_utilisateur != NULL && $user->mot_de_passe!=NULL)
            return true;
    }

    return false;
}

function searchUser($fname,$lname,$userList) :bool
{
    foreach($userList as $user)
    {
        if(($fname == $user->nomUtilisateur && $lname == $user->prenomUtilisateur) )
            return true;
    }
    return false;
}

function aPropos($id,$clientList) 
{
    foreach($clientList as $client)
    {
        if($client->numUtilisateur == $id)
            return $client;
    }
}