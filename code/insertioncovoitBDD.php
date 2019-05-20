<?php
/**
 * Created by PhpStorm.
 * User: Badr RIOUCH
 * Date: 20/05/2019
 * Time: 23:04
 */

if(isset($_POST['button']))
{
    $reqInsert= 'INSERT INTO Trajet(idTrajet , depart , arrivee , dateheuredepart) VALUES('.$_SESSION['$idTrajet'].','.$_SESSION['$lieuDepart'].','.$_SESSION['$lieuarrivee'].','.$_SESSION['$dateHeureDepart'].'';
    //execute the query
    $conn->execute($reqInsert);
    header("Location: https://covoit.pouseb.fr/index.php");
}

?>