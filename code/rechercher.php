<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php
// récuperation des parametres POST
$lieuDepart = $_POST['lieuDepart'];
$lieuArrivee = $_POST['lieuArrivee'];
$dateDepart = $_POST['dateDepart'];
$heureDepart = $_POST['heureDepart'];
$nombreBagage = $_POST['bagages'];
// requete dans la BDD pour récuperer les trajets demandés
$reqRechercher = $bdd->prepare('SELECT * FROM trajet WHERE pointdepart=:lieuDepart AND pointarrivee=:lieuArrivee');
$reqRechercher->execute(
    array(
        "lieuDepart" => $lieuDepart,
        "lieuArrivee" => $lieuArrivee,
    )
) or die(print_r($bdd->errorInfo()));

$resultat = $reqRechercher->fetchAll(PDO::FETCH_ASSOC);

// s'il n'y à aucun résultat alors afficher un message
if (!$resultat) {
    echo 'aucun covoiturage à cette date';
} else {
?>
  <div class="text-center">
    <h3>Voici les covoiturages disponibles</h3>
  </div>

<?php
// sinon les afficher tous
foreach ($resultat as $trajet):
  $photo = glob("../user/".$trajet['conducteur'].".*")[0];
?>
  <div class="col-md-3 ficheTrajet" id="border" >
    <img src="../user/<?php echo $photo; ?>" class="img-circle" alt="profilpicture" id="avatar">
    <h4>
      Conducteur :<?php echo $trajet['conducteur']; ?>
    </h4>
  </div>
  <!-- Partie droite avec infos du trajet  -->
  <div class="col-sm-9">
    <h3>
      Le <?php echo $trajet['dateheuredepart'] ?>
    </h3>
    <h4>
      De : <?php echo $trajet['pointdepart'] ?>
    </h4>
    <h4>
      A <?php echo $trajet['pointarrivee'] ?>
    </h4>
  </div>
<?php
endforeach;
}

require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php';
?>
