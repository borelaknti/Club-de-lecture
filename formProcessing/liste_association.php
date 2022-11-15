<?php
include_once realpath(dirname(__DIR__)) .  '/includes/database.php';
include_once realpath(dirname(__DIR__)) . '/includes/Association.php';
include_once realpath(dirname(__DIR__)) .  '/includes/functions.php';
include_once realpath(dirname(__DIR__)) .  '/layouts/header.php';

$associations = new Association();
$associationList = $associations->findAll();   
?>
<?php

/*
 * Ajouter une classe afin de mettre du style dans les rangés avec du texte noir sur une page
 * avec un fond qui possède une image.
 */
$htmlTable =  '<table class="list"> 
                    <tr>
                        <th> numero </th> <th> Nom </th> <th>adresse</th> <th>Date de creation</th> <th>nom du createur</th> <th colspan="2">action</th>
                    </tr>';
if(count($associationList) > 0)
{
    foreach ($associationList as $asso)
    {
            $htmlTable .=  '<tr>';
            $htmlTable .=  '<td> '. $asso->numAssociation .' </td>';
            $htmlTable .=  '<td>'. $asso->nomAssociation .'</td>';
            $htmlTable .=  '<td>'. $asso->adresseAssociation .'</td>';
            $htmlTable .=  '<td>'. $asso->Datecreation .'</td>';
            $htmlTable .=  '<td >'. $asso->nomCreateur .'</td>';
            $htmlTable .=  '<td > <a  href="detailsAssociation.php?id='. $asso->numAssociation.'" class="link"> <i class="fas fa-info-circle">  </i> </a></td>';
            $htmlTable .=  '<td > <a  href="/formProcessing/supprimerAssociation.php?id='. $asso->numAssociation.'" class="link"> <i class="fas fa-trash">  </i> </a> </td>';
            $htmlTable .=  '</tr>';
    }
}
else 
{
	$htmlTable .=  '<tr><td colspan="5" class="alert alert-danger text-center"><em>Aucun dossier n\'a été trouvé.</em></td></tr>';
}
$htmlTable .=  '	</table> ';

?>