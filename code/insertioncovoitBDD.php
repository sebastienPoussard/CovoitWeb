<?php
/**
 * Created by PhpStorm.
 * User: Badr RIOUCH
 * Date: 20/05/2019
 * Time: 23:04
 */

if(isset($_POST['button']))
{
    header('Location=/index.php');
}
/*
function insérerCovoitBDD($idTrajet,$lieuDepart,$lieuarrivee,$dateHeureDepart,$estAnnule)
{
    $bdd->exec("INSERT INTO Trajet(idTrajet , depart , arrivee , dateheuredepart) VALUES('.$idTrajet.','.$lieuDepart.','.$lieuarrivee.','.$dateHeureDepart.','.$estAnnule.')");
}
*/

?>