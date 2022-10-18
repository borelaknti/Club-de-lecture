<?php
include_once realpath(dirname(__DIR__)) .  '/includes/database.php';
include_once realpath(dirname(__DIR__)) . '/includes/Association.php';
include_once realpath(dirname(__DIR__)) .  '/includes/functions.php';
include_once realpath(dirname(__DIR__)) .  '/layouts/header.php';

$associations = new Association();
$associationList = $associations->findAll();   
?>
<?php

$htmlTable =  '<table border="1" class="list"> 
                    <tr>
                        <th> numero </th> <th> Nom </th> <th>adresse</th> <th>Date de creation</th> <th>nom du createur</th>
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
            $htmlTable .=  '</tr>';
    }
}
else 
{
	$htmlTable .=  '<tr><td colspan="5" class="alert alert-danger text-center"><em>Aucun dossier n\'a été trouvé.</em></td></tr>';
}
$htmlTable .=  '	</table> ';

?>