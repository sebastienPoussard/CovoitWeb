<?php
/**
 * Created by PhpStorm.
 * User: melie
 * Date: 09/05/19
 * Time: 13:50
 */
include '../modules/cobdd.php';
$lieuDepart=$_POST['lieuDepart'];
$lieuArrivee=$_POST['lieuArrivee'];
$dateDepart=$_POST['dateDepart'];
$heureDepart=$_POST['heureDepart'];
$nombreBagage=$_POST['bagages'];
$reqRechercher= $bdd->prepare('SELECT * FROM trajet WHERE pointdepart=:lieuDepart AND pointarrivee=:lieuArrivee');
$reqRechercher->execute(
    array(
        "lieuDepart" => $lieuDepart,
        "lieuArrivee" => $lieuArrivee,
    )
) or die(print_r($bdd->errorInfo()));

$resultat = $reqRechercher->fetchAll(PDO::FETCH_ASSOC);

if (!$resultat) {
    echo'aucun covoiturage à cette date';
}
else{
    foreach ($resultat as $trajet)
        foreach ($trajet as $info)
            echo $info . '<br>';
}


