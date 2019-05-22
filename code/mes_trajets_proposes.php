<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php
// si la page est accédé pour accepter la participation d'un utilisateurs
// au covoiturage
if ($_SESSION['identifiant'] && isset($_POST['iduser']) && isset($_POST['idtrajet'])) {
  $req0 = $bdd->prepare('UPDATE reservation
                        SET estaccepte = true
                        WHERE mail = :mail
                        AND idtrajet = :idTrajet');
  $toto = $req0->execute(array('idTrajet'=> $_POST['idtrajet'],
                       'mail'=> $_POST['iduser']));
}

// si la page est accédé pour annuler un covoiturage.
if ($_SESSION['identifiant'] && isset($_POST['idtrajetcancel'])) {
  $req4 = $bdd->prepare('UPDATE trajet
                        SET estannule = true
                        WHERE idtrajet = :idTrajet');
  $req4->execute(array('idTrajet'=> $_POST['idtrajetcancel']));
}


// verifier que l'utilisateur est identifié pour acceder à cette page.
if ($_SESSION['identifiant']) {
  echo '<br><H1 class="oi oi-book d-flex justify-content-center"></H1><H3 class="text-center">Mes trajets proposés</H3>';
  $ladate = date("Y-m-j").' '.date("H:i",time()+60*60*2);
  // récuperer les trajets proposés de l'utilisateur.
  $req = $bdd->prepare('SELECT * FROM trajet
                        WHERE conducteur = :mail
                        AND dateheuredepart > :ladate
                        AND estannule = false;');
  $toto = $req->execute(array('mail'=> $_SESSION['identifiant'],
                      'ladate' => $ladate));
  $res = $req->fetchAll(PDO::FETCH_ASSOC);
  // parcourir l'ensemble des trajets.
  foreach ($res as $trajet) {

    // recuperer le nombre de places max sur le trajet
    $reqPlaceMax = $bdd->prepare('SELECT maxpassagers FROM voiture
                          WHERE matricule = :matricule;');
    $reqPlaceMax->execute(array('matricule'=> $trajet['idvoiture']));
    $resPlaceMax = $reqPlaceMax->fetchAll(PDO::FETCH_ASSOC);
    $nbPassagersMax = $resPlaceMax[0]['maxpassagers'];
    // recuperer le nombre de places déja occupés
    $reqPassagers = $bdd->prepare('SELECT COUNT(*) FROM reservation WHERE idtrajet = :idTrajet
        AND estaccepte = true AND estvalide = true;');
    $reqPassagers->execute(array('idTrajet'=> $trajet['idtrajet']));
    $resPassagers = $reqPassagers->fetchAll(PDO::FETCH_ASSOC);
    $nbReservation= $resPassagers[0]['count'];

    // convertir la date en format fr
    $datefr = strftime("%d/%m/%Y à %H:%M",strtotime($trajet['dateheuredepart']));

    echo '
     <div class="card text-center">
      <div class="card-header oi oi-flag">
        Trajet de '.$trajet['pointdepart'].' à '.$trajet['pointarrivee'].'
      </div>
      <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-info">
          <h5 class="card-title oi oi-clock"> Départ prévu : '.$datefr.'</h5>
          <p class="card-text">Immatriculation du véhicule : '.$trajet['idvoiture'].'</p>';
    echo '<p class="card-text">Reservations : '.$nbReservation.'/'.$nbPassagersMax.'</p>';
    if ($nbReservation == $nbPassagersMax) {
      echo '<p class="card-text text-success">Trajet complet !</p>';
    }
    echo '
        </li>
      ';

    // recuperer la liste des utilisateurs confirmés participant au covoiturages.
    $req2 = $bdd->prepare('SELECT * FROM utilisateur
                  LEFT JOIN reservation ON reservation.mail = utilisateur.mail
                  WHERE reservation.idtrajet = :idtrajet
                  AND estaccepte = TRUE
                  AND estvalide = TRUE;');
    $req2->execute(array('idtrajet'=> $trajet['idtrajet']));
    $res2 = $req2->fetchAll(PDO::FETCH_ASSOC);
    if ($res2) {
      echo '
        <li class="list-group-item list-group-item-success">
          <H4 class="text-center">Utilisateurs confirmés participant au covoiturage </H4>';
      // afficher tous les utilisateurs participants au covoiturage.
      foreach ($res2 as $utilisateur) {
        echo '<p class="oi oi-check d-block"> '.$utilisateur['prenomuser']." ".$utilisateur['nomuser']." (".$utilisateur['mail'].")</p> ";
      }
      echo '</li>';
    }
    // recuperer la liste des utilisateur souhaitant participer au covoiturage.
    $req3 = $bdd->prepare('SELECT * FROM utilisateur
                  LEFT JOIN reservation ON reservation.mail = utilisateur.mail
                  WHERE reservation.idtrajet = :idtrajet
                  AND estaccepte = FALSE
                  AND estvalide = TRUE;');
    $toto = $req3->execute(array('idtrajet'=> $trajet['idtrajet']));
    $res3 = $req3->fetchAll(PDO::FETCH_ASSOC);
    // afficher les utilisateurs souhaitant participer au covoiturage.
    if ($res3) {
      echo '
        <li class="list-group-item list-group-item-warning">
          <H4 class="text-center">les utilisateurs suivant souhaitent rejoindre ce covoiturage
          et attendent votre acceptation</H4>';
    }
    foreach ($res3 as $utilisateur) {
      echo '<p class="oi oi-question-mark d-inline"> '.$utilisateur['prenomuser']." ".$utilisateur['nomuser']." (".$utilisateur['mail'].")</p> ";
      echo '<form class="d-inline" action="mes_trajets_proposes.php" method="post">';
      echo '    <input type="text" name="iduser" value="'.$utilisateur['mail'].'" hidden>';
      echo '    <input type="text" name="idtrajet" value="'.$trajet['idtrajet'].'" hidden>';
      echo '    <input class="btn btn-success btn-sm" type="submit" name="" value="Accepter la participation">';
      echo '</form>';
      echo "</p>";
    }
    echo '</li>';
    // annulation du covoiturage
    echo '
        </ul>
      </div>
      <div class="card-footer text-muted">
        <form class="" action="mes_trajets_proposes.php" method="post">
        <input type="text" name="idtrajetcancel" value="'.$trajet['idtrajet'].'" hidden>
        <input class="btn btn-outline-danger" type="submit" name="" value="Annuler ce covoiturage">
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

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
