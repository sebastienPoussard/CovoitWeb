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
  echo '<H3 class="text-center">Mes trajets proposés</H3>';

  // récuperer les reservations de l'utilisateur.
  $req = $bdd->prepare('SELECT * FROM trajet
                        WHERE conducteur = :mail
                        AND estannule = false;');
  $req->execute(array('mail'=> $_SESSION['identifiant']));
  $res = $req->fetchAll(PDO::FETCH_ASSOC);
  // parcourir l'ensemble des trajets.
  foreach ($res as $trajet) {
    echo 'Depart : '.$trajet['pointdepart'];
    echo '<br>';
    echo 'Arrivee : '.$trajet['pointarrivee'];
    echo '<br>';
    echo 'Heure de départ : '.$trajet['dateheuredepart'];
    echo '<br>';
    echo 'Immatriculation du véhicule : '.$trajet['idvoiture'];
    // annulation du covoiturage
    echo '<br>';
    echo '<form class="" action="mes_trajets_proposes.php" method="post">';
    echo '    <input type="text" name="idtrajetcancel" value="'.$trajet['idtrajet'].'" hidden>';
    echo '    <input type="submit" name="" value="Annuler ce covoiturage">';
    echo '</form>';
    // recuperer la liste des utilisateurs confirmés participant au covoiturages.
    $req2 = $bdd->prepare('SELECT * FROM utilisateur
                  LEFT JOIN reservation ON reservation.mail = utilisateur.mail
                  WHERE reservation.idtrajet = :idtrajet
                  AND estaccepte = TRUE
                  AND estvalide = TRUE;');
    $req2->execute(array('idtrajet'=> $res[0]['idtrajet']));
    $res2 = $req2->fetchAll(PDO::FETCH_ASSOC);
    if ($res2) {
      echo '<br><br>liste des utilisateur confirmé participant au covoiturage :';
      // afficher tous les utilisateurs participants au covoiturage.
      foreach ($res2 as $utilisateur) {
        echo '<br>';
        echo 'nom :'.$utilisateur['nomuser'];
        echo '<br>';
        echo 'prenom :'.$utilisateur['prenomuser'];
      }
    }
    // recuperer la liste des utilisateur souhaitant participer au covoiturage.
    $req3 = $bdd->prepare('SELECT * FROM utilisateur
                  LEFT JOIN reservation ON reservation.mail = utilisateur.mail
                  WHERE reservation.idtrajet = :idtrajet
                  AND estaccepte = FALSE
                  AND estvalide = TRUE;');
    $req3->execute(array('idtrajet'=> $res[0]['idtrajet']));
    $res3 = $req3->fetchAll(PDO::FETCH_ASSOC);
    // afficher les utilisateurs souhaitant participer au covoiturage.
    if ($res3) {
      echo '<br><br>les utilisateurs suivant souhaitent participer au covoiturage : <br>';
    }
    foreach ($res3 as $utilisateur) {
      echo '<br>';
      echo 'nom :'.$utilisateur['nomuser'];
      echo '<br>';
      echo 'prenom :'.$utilisateur['prenomuser'];
      echo '<form class="" action="mes_trajets_proposes.php" method="post">';
      echo '    <input type="text" name="iduser" value="'.$utilisateur['mail'].'" hidden>';
      echo '    <input type="text" name="idtrajet" value="'.$trajet['idtrajet'].'" hidden>';
      echo '    <input type="submit" name="" value="Accepter la participation">';
      echo '</form>';
    }

  }
} else {
  // si l'utilisateur n'est pas authentifié, afficher un message d'erreur.
  echo '<p class="text-center">Vous devez être identifié pour acceder à cette page</p>';
}
 ?>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
