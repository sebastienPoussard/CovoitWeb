<?php
/**
 * Created by PhpStorm.
 * User: melie
 * Date: 09/05/19
 * Time: 13:50
 */
include '../modules/cobdd.php';
$lieuDepart = $_POST['lieuDepart'];
$lieuArrivee = $_POST['lieuArrivee'];
$dateDepart = $_POST['dateDepart'];
$heureDepart = $_POST['heureDepart'];
$nombreBagage = $_POST['bagages'];
$reqRechercher = $bdd->prepare('SELECT * FROM trajet WHERE pointdepart=:lieuDepart AND pointarrivee=:lieuArrivee');
$reqRechercher->execute(
    array(
        "lieuDepart" => $lieuDepart,
        "lieuArrivee" => $lieuArrivee,
    )
) or die(print_r($bdd->errorInfo()));

$resultat = $reqRechercher->fetchAll(PDO::FETCH_ASSOC);

if (!$resultat) {
    echo 'aucun covoiturage à cette date';
} else {
?>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="./rechercher.css" rel="stylesheet">
    <link rel="stylesheet" href="../open-iconic/font/css/open-iconic-bootstrap.css">
    <div class="row">
    <div class="container-fluid">
    <div class="row">
        <img id=logo src="../img/logo.png" alt="logoQuietCar">
        </div>
    <div class="row">
        <h3 class="mx-auto">Voici les covoiturages disponibles</h3>
    </div>

    <?php
    foreach ($resultat as $trajet):
        $photo = glob("../user/".$trajet['conducteur'].".*")[0];
        ?>

            <div class="col-md-3 ficheTrajet" id="border" >
                <img src="../user/<?php echo $photo; ?>" class="img-circle" alt="profilpicture" id="avatar">
                <h4>
                    De <?php echo $trajet['conducteur']; ?>
                </h4>

            <!-- Partie droite avec infos du trajet  -->
            <div class="col-sm-9">
                <h3>
                    Le <?php echo $trajet['dateheuredepart'] ?>
                </h3>
                <h4>
                    De <?php echo $trajet['pointdepart'] ?>
                </h4>
                <h4>
                    A <?php echo $trajet['pointarrivee'] ?>
                </h4>
            </div>
            </div>
        </div>
        </div>
    <?php
    endforeach;
}
?>

