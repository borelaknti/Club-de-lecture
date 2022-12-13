<?php
include_once realpath(dirname(__DIR__)) .  '/includes/database.php';
include_once realpath(dirname(__DIR__)) . '/includes/Users.php';
include_once realpath(dirname(__DIR__)) .  '/includes/functions.php';
include_once realpath(dirname(__DIR__)) .  '/layouts/header.php';

$users = new Users();
$userList = $users->findMemberAssociation($_GET['id']);   
$pg="association";
?>
<?php

$htmlTable =  '<table class="list"> 
                    <tr>
                        <th> numero </th> <th> Nom </th> <th> Prenom </th>  <th>etat</th> <th>email</th> <th colspan="2">action</th>
                    </tr>';
if( isset($userList) )
{   
    foreach ($userList as $user)
    {
        if($user->etatUtilisateur == "A")
        {
            $htmlTable .=  '<tr>';
            $htmlTable .=  '<td> '. $user->numUtilisateur .' </td>';
            $htmlTable .=  '<td>'. $user->nomUtilisateur .'</td>';
            $htmlTable .=  '<td>'. $user->prenomUtilisateur .'</td>';
            $htmlTable .=  '<td> Actif </td>';
            $htmlTable .=  '<td >'. $user->utilisateur_email .'</td>';
            $htmlTable .=  '<td > <a  href="proposMembre.php?id='. $user->numUtilisateur.'&page='.$pg.'&idAsso='.$_GET['id'].'" class="link"> <i class="fas fa-info-circle">  </i> </a></td>';
            $htmlTable .=  '</tr>';
        }else
        {
            $htmlTable .=  '<tr>';
            $htmlTable .=  '<td> '. $user->numUtilisateur .' </td>';
            $htmlTable .=  '<td>'. $user->nomUtilisateur .'</td>';
            $htmlTable .=  '<td>'. $user->prenomUtilisateur .'</td>';
            $htmlTable .=  '<td> Inactif </td>';
            $htmlTable .=  '<td >'. $user->utilisateur_email .'</td>';
            $htmlTable .=  '<td > <a  href="proposMembre.php?id='. $user->numUtilisateur.'&page='.$pg.'&idAsso='.$_GET['id'].'" class="link"> <i class="fas fa-info-circle">  </i> </a></td>';
            $htmlTable .=  '</tr>';
        }
    	
    }
}
else 
{
	$htmlTable .=  '<tr><td colspan="6" ><em>Aucun utilisateur n\'a été trouvé.</em></td></tr>';
}
$htmlTable .=  '	</table> ';

?>