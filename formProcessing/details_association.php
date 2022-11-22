<?php
include_once realpath(dirname(__DIR__)) .  '/includes/database.php';
include_once realpath(dirname(__DIR__)) . '/includes/Users.php';
include_once realpath(dirname(__DIR__)) .  '/includes/functions.php';
include_once realpath(dirname(__DIR__)) .  '/layouts/header.php';

$asso = new Association();
$user = $asso->findAssociation($_GET['id']);   
//die(var_dump($user)); // verifier le parametre quand le tableau est vide
?>
<?php

$htmlTab =  '<table  class="list-detail">';
if( isset($user) )
{   
   
            $htmlTab .=  '<tr>';
            $htmlTab .=  '<td> Numero </td>';
            $htmlTab .=  '<td> '. $user[0]->numAssociation .' </td>';
            $htmlTab .=  '</tr>';
            $htmlTab .=  '<tr>';
            $htmlTab .=  '<td> Nom de l\'association </td>';
            $htmlTab .=  '<td>'. $user[0]->nomAssociation .'</td>';
            $htmlTab .=  '</tr>';
            $htmlTab .=  '<tr>';
            $htmlTab .=  '<td> Adresse de l\'association </td>';
            $htmlTab .=  '<td>'. $user[0]->adresseAssociation .'</td>';
            $htmlTab .=  '</tr>';
            $htmlTab .=  '<tr>';
            $htmlTab .=  '<td> Date de creation de l\'association </td>';
            $htmlTab .=  '<td>'. $user[0]->Datecreation .'</td>';
            $htmlTab .=  '</tr>';
            $htmlTab .=  '<tr>';
            $htmlTab .=  '<td> Nom de createur de l\'association </td>';
            $htmlTab .=  '<td >'. $user[0]->nomCreateur .'</td>';
            $htmlTab .=  '</tr>';;
}
else 
{
	$htmlTab .=  '<tr><td ><em>Aucune association n\'a été trouvé.</em></td></tr>';
}
$htmlTab .=  '	</table> ';

?>