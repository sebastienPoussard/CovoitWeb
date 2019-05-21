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
// qui ne sont pas déjà reservés et dont l'utilisateur n'est pas conducteur
// et dont le conducteur n'a pas annulé le trajet
$reqRechercher = $bdd->prepare('SELECT * FROM trajet
                                WHERE pointdepart=:lieuDepart
                                AND pointarrivee=:lieuArrivee
                                AND conducteur != :idconducteur
                                AND estannule = false
                                AND idtrajet NOT IN (
                                  SELECT idtrajet FROM reservation
                                  WHERE mail = :mail
                                )');
$reqRechercher->execute(
    array(
        "lieuDepart" => $lieuDepart,
        "lieuArrivee" => $lieuArrivee,
        "idconducteur" => $_SESSION['identifiant'],
        "mail" => $_SESSION['identifiant']
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
  $photo = glob("/user/".$trajet['conducteur'].".*")[0];
  $datefr = strftime("%d/%m/%Y à %H:%M",strtotime($trajet['dateheuredepart']));

  echo '
   <div class="card text-center">
   <img class="card-img-top" src="/user/'.$photo.'" alt="Card image cap">
    <div class="card-header oi oi-flag">
      Trajet de '.$trajet['pointdepart'].' à '.$trajet['pointarrivee'].'
    </div>
    <div class="card-body">
      <h5 class="card-title oi oi-clock"> Départ prévue : '.$datefr.'</h5>
      <p class="card-text">Immatriculation du véhicule : '.$trajet['idvoiture'].'</p>
      <p class="card-text oi oi-envelope-closed"> Conducteur : '.$trajet['conducteur'].'</p>
    </div>
    <div class="card-footer text-muted">
    <form class="" action="inscription_a_un_covoit.php" method="post">
       <input type="text" name="idcovoit" value="'.$trajet['idtrajet'].'" hidden>
       <input class="btn btn-outline-danger" type="submit" name="" value="Reserver ce covoiturage">
    </form>
    </div>
  </div>
  <br>';

endforeach;
}

require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php';
?>
