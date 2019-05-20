<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php
// verifier que l'utilisateur est identifié pour acceder à cette page.
if ($_SESSION['identifiant']) {
  echo '<H3 class="text-center">Mes reservations</H3>';

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
    echo 'Depart : '.$res2[0]['pointdepart'];
    echo '<br>';
    echo 'Arrivee : '.$res2[0]['pointarrivee'];
    echo '<br>';
    echo 'Heure de départ : '.$res2[0]['dateheuredepart'];
    echo '<br>';
    // annulation ?
    echo 'Conducteur : '.$res2[0]['conducteur'];
    echo '<br>';
    echo 'Immatriculation du véhicule : '.$res2[0]['idvoiture'];
    echo '<br><br>';
    echo '<form class="" action="mes_reservations.php" method="post">';
    echo '    <input type="text" name="idtrajet" value="'.$trajet['idtrajet'].'" hidden>';
    echo '    <input type="submit" name="" value="Annuler ma participation">';
    echo '</form>';

  }
} else {
  // si l'utilisateur n'est pas authentifié, afficher un message d'erreur.
  echo '<p class="text-center">Vous devez être identifié pour acceder à cette page</p>';
}
 ?>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
