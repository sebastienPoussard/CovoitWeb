<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php
// verifier que l'utilisateur est identifié pour acceder à cette page.
if ($_SESSION['identifiant']) {
  echo '<H1 class="oi oi-eye d-flex justify-content-center"></H1><H3 class="text-center">Trajets réalisés en tant que conducteur</H3>';
  $ladate = date("Y-m-j").' '.date("H:i",time()+60*60*2);
  // récuperer les trajets passés de l'utilisateur
  $req = $bdd->prepare('SELECT * FROM trajet
                        WHERE conducteur = :mail
                        AND dateheuredepart < :ladate
                        AND estannule = false;');
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
        <li class="list-group-item list-group-item-secondary">
          <h5 class="card-title oi oi-clock"> Départ prévue : '.$datefr.'</h5>
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
        <li class="list-group-item list-group-item-secondary">
          <H4 class="text-center">Ce que les participants ont pensés de ce covoiturage</H4>';
      // afficher tous les utilisateurs qui ont participés au covoiturage.
      foreach ($res2 as $utilisateur) {
        echo '<p class="oi oi-check d-block"> '.$utilisateur['prenomuser']." ".$utilisateur['nomuser']." (".$utilisateur['mail'].")</p> ";
        echo '<p class="d-block">note attribué par l\'utilisateur : ';
        // récuperer la note et le commentaire de l'utilisateur
        $reqUser = $bdd->prepare('SELECT * FROM reservation
                                  WHERE mail = :mail
                                  AND idtrajet = :idtrajet
                                  ;');
        $reqUser->execute(array('idtrajet'=> $trajet['idtrajet'],
                                'mail' => $utilisateur['mail']
                                ));
        $resUser = $reqUser->fetchAll(PDO::FETCH_ASSOC);
        echo $resUser[0]['note'].'/10</p> ';
        echo '<p class="d-block">commentaire laissé par l\'utilisateur : ';
        echo $resUser[0]['commentaire'].'</p> ';
      }
      echo '</li>';
    }
    echo '
        </ul>
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
