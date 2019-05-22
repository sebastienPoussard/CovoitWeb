<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php
// si la page est accédé pour annuler une reservations
if ($_SESSION['identifiant'] && isset($_POST['idtrajet'])) {
  $req0 = $bdd->prepare('UPDATE reservation
                        SET estvalide = false
                        WHERE mail = :mail
                        AND idtrajet = :idTrajet');
  $req0->execute(array('idTrajet'=> $_POST['idtrajet'],
                       'mail'=> $_SESSION['identifiant']));
}

// verifier que l'utilisateur est identifié pour acceder à cette page.
if ($_SESSION['identifiant']) {
  echo '<H1 class="oi oi-cart d-flex justify-content-center"></H1><H3 class="text-center">Mes reservations</H3><br>';

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

    // savoir si le trajet à été accepté par le Conducteur
    $reqConf = $bdd->prepare('SELECT * FROM reservation
                              WHERE mail = :mail
                              AND idtrajet = :idtrajet;');
    $toto = $reqConf->execute(array('idtrajet'=> $trajet['idtrajet'],
                            'mail'=> $_SESSION['identifiant']));
    $reqConf = $reqConf->fetchAll(PDO::FETCH_ASSOC);
    $reqConf[0]['estaccepte'];
    if ($reqConf[0]['estaccepte'] && $reqConf[0]['estvalide']) {
      // convertir la date en format fr
      $datefr = strftime("%d/%m/%Y à %H:%M",strtotime($res2[0]['dateheuredepart']));

      echo '
      <div class="card text-center ';
      if ($reqConf[0]['estaccepte']) {
        echo 'card border-success';
      } else {
        echo 'car border-danger';
      }
      echo '
      ">
      <div class="card-header oi oi-flag">
      Trajet de '.$res2[0]['pointdepart'].' à '.$res2[0]['pointarrivee'].'
      </div>
      <div class="card-body">
      <h5 class="card-title oi oi-clock"> Départ prévu : '.$datefr.'</h5>
      <p class="card-text">Immatriculation du véhicule : '.$res2[0]['idvoiture'].'</p>
      <p class="card-text oi oi-envelope-closed"> Contacter le conducteur : '.$res2[0]['conducteur'].'</p>';
      if (!$reqConf[0]['estaccepte']) {
        echo '<p class="card-text text-danger">Le conducteur n\'à pas encore acceptée votre reservation </p>';
      } else {
        echo '<p class="card-text text-success">Votre reservation à été acceptée par le conducteur</p>';
      }
      echo '
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
  }
} else {
  // si l'utilisateur n'est pas authentifié, afficher un message d'erreur.
  echo '<p class="text-center">Vous devez être identifié pour acceder à cette page</p>';
}
 ?>


<br>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
