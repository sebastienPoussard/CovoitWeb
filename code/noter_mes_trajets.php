<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php


// si la page est accédé pour ajouter une note faire l'update de la BDD.
if ($_SESSION['identifiant'] && isset($_POST['note'])) {
  $reqMettreNote = $bdd->prepare('UPDATE reservation
                                SET note = :note
                                WHERE idtrajet = :idtrajet
                                AND mail = :mail
                                ');
  $reqMettreNote->execute(array('idtrajet'=> $_POST['idtrajetNote'],
                                        'note' => $_POST['note'],
                                        'mail' => $_SESSION['identifiant']
                                        ));
}

// si la page est accédé pour ajouter une commentaire faire l'update de la BDD.
if ($_SESSION['identifiant'] && isset($_POST['commentaire'])) {
  $reqMettreCommentaire = $bdd->prepare('UPDATE reservation
                        SET commentaire = :commentaire
                        WHERE idtrajet = :idtrajet
                        AND mail = :mail
                        ');
  $toto = $reqMettreCommentaire->execute(array('idtrajet'=> $_POST['idtrajetNote'],
                                        'commentaire' => $_POST['commentaire'],
                                        'mail' => $_SESSION['identifiant']
                                        ));
}


// verifier que l'utilisateur est identifié pour acceder à cette page.
if ($_SESSION['identifiant']) {
  echo '<H3 class="text-center">Mes trajets participés en tant que passager</H3>';
  $ladate = date("Y-m-j").' '.date("H:i",time()+60*60*2);
  // récuperer les trajets auquel l'utilisateur à participé
  $req = $bdd->prepare('SELECT * FROM trajet
                        WHERE dateheuredepart < :ladate
                        AND estannule = false
                        AND idtrajet IN (
                                          SELECT trajet.idtrajet FROM trajet
                                          LEFT JOIN reservation ON reservation.idtrajet = trajet.idtrajet
                                          WHERE reservation.mail = :mail
                                          AND estaccepte = true
                                          AND estvalide = true)
                        AND conducteur != :mail
                        ;');
  $req->execute(array('mail'=> $_SESSION['identifiant'],
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
          <h5 class="card-title oi oi-clock"> Départ prévue : '.$datefr.'</h5>
          <p class="card-text">Immatriculation du véhicule : '.$trajet['idvoiture'].'</p>';
    echo '<p class="card-text">Reservations : '.$nbReservation.'/'.$nbPassagersMax.'</p>';
    if ($nbReservation == $nbPassagersMax) {
      echo '<p class="card-text text-success">Trajet complet !</p>';
    }
    echo '
        </li>
      ';


    // recuperer note et commentaire de l'utilisateur
    $reqNote = $bdd->prepare('SELECT * FROM reservation
                          WHERE mail = :mail
                          AND idtrajet = :idtrajet
                          ;');
    $reqNote->execute(array('mail'=> $_SESSION['identifiant'],
                        'idtrajet' => $trajet['idtrajet']));
    $resNote = $reqNote->fetchAll(PDO::FETCH_ASSOC);

    // laisser un commentaire ou une note s'il n'en existe pas déjà une
    echo '
        </ul>
      </div>
      <div class="card-footer text-muted">';
    // si ou la note ou le commentaire n'est pas attribué, mettre en place un formulaire
    if (!$resNote[0]['note'] || !$resNote[0]['commentaire'] ) {
      echo '
        <form class="" action="noter_mes_trajets.php" method="post">
        <input type="text" name="idtrajetNote" value="'.$trajet['idtrajet'].'" hidden>
      ';
      // si la note n'est pas attribué
      if (!$resNote[0]['note']) {
        echo '
        <p><input type="number" name="note" min="0" max="10" placeholder="votre note" class="form-control"></p>
        ';
      } else {
        echo '<p>Votre note : '.$resNote[0]['note'].'/10</p>';
      }
      // si le commeantaire n'est pas attribué
      if (!$resNote[0]['commentaire']) {
        echo '
        <p><input type="text" name="commentaire" max="150" placeholder="votre commentaire" class="form-control"></p>
        ';
      } else {
        echo '<p>Votre commentaire : '.$resNote[0]['commentaire'].'</p>';
      }
    } else {
      echo '
        <p>Votre note : '.$resNote[0]['note'].'/10</p>
        <p>Votre commentaire : '.$resNote[0]['commentaire'].'</p>
      ';
    }
    // ajouter la fin du formulaire
    if (!$resNote[0]['note'] || !$resNote[0]['commentaire'] ) {
      echo '
        <input class="btn btn-outline-success" type="submit" name="" value="Envoyer">
      </form>
      ';
    }
    echo '
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
