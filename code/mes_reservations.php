<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php
// verifier que l'utilisateur est identifié pour acceder à cette page.
if ($_SESSION['identifiant']) {
  echo '<H3 class="text-center">Mes reservations</H3><br>';

  // récuperer les reservations de l'utilisateur.
  $req = $bdd->prepare('SELECT * FROM reservation
                        WHERE mail = :mail;');
  $req->execute(array('mail'=> $_SESSION['identifiant']));
  $res = $req->fetchAll(PDO::FETCH_ASSOC);
  // parcourir l'ensemble des trajets.
  foreach ($res as $trajet) {
    // recuperer les informations sur le trajet.
    $req2 = $bdd->prepare('SELECT * FROM trajet
                          WHERE idtrajet = :idTrajet
                          AND estannule = false;');
    $req2->execute(array('idTrajet'=> $trajet['idtrajet']));
    $res2 = $req2->fetchAll(PDO::FETCH_ASSOC);

    // convertir la date en format fr
    $datefr = strftime("%d/%m/%Y à %H:%M",strtotime($res2[0]['dateheuredepart']));

    echo '
     <div class="card text-center">
      <div class="card-header oi oi-flag">
        Trajet de '.$res2[0]['pointdepart'].' à '.$res2[0]['pointarrivee'].'
      </div>
      <div class="card-body">
        <h5 class="card-title oi oi-clock"> Départ prévue : '.$datefr.'</h5>
        <p class="card-text">Immatriculation du véhicule : '.$res2[0]['idvoiture'].'</p>
        <p class="card-text oi oi-envelope-closed"> Contacter le conducteur : '.$res2[0]['conducteur'].'</p>
      </div>
      <div class="card-footer text-muted">
      <form class="" action="mes_reservations.php" method="post">
         <input type="text" name="idtrajet" value="'.$trajet['idtrajet'].'" hidden>
         <input class="btn btn-outline-danger" type="submit" name="" value="Annuler ma participation">
      </form>
      </div>
    </div>
    <br>';
  }
} else {
  // si l'utilisateur n'est pas authentifié, afficher un message d'erreur.
  echo '<p class="text-center">Vous devez être identifié pour acceder à cette page</p>';
}
 ?>


<br>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
