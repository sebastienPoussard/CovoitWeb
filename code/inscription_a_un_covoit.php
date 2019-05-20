<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php
if (isset($_POST['idcovoit'])) {
  echo "id du covoit selectionné : ".$_POST['idcovoit'];
  echo "<br>";
  // verifier que le trajet comporte encore des places
  // commencer par chercher le nombre de reservation déjà existante sur ce trajet
  $req = $bdd->prepare('SELECT COUNT(*) FROM reservation WHERE idtrajet = :idTrajet
      AND estaccepte = true AND estvalide = true;');
  $req->execute(array('idTrajet'=> $_POST['idcovoit']));
  $res = $req->fetchAll(PDO::FETCH_ASSOC);
  $nbReservation= $res[0]['count'];
  echo "nb de reservation déjà réalisée sur ce covoit : ".$nbReservation."<br>";

  // récuperer le nombre de places sur la voitures qui fait le trajet
  $req = $bdd->prepare('SELECT maxpassagers FROM voiture
    WHERE matricule = (SELECT idvoiture FROM trajet
                        WHERE idtrajet = :idTrajet)');
  $req->execute(array('idTrajet'=> $_POST['idcovoit']));
  $res = $req->fetchAll(PDO::FETCH_ASSOC);
  $nbPassagersMax = $res[0]['maxpassagers'];
  echo "nb de passagersMax : ".$nbPassagersMax."<br>";

  // si le nombre de reservation est inférieur au nombre de passagers que peut
  // transporter la voiture alors effectuer la reservation.
  if ($nbReservation < $nbPassagersMax) {

    $req = $bdd->prepare('INSERT INTO reservation
                          VALUES (:idMail, :idCovoit, \'false\', \'true\' );');
    $res = $req->execute(array('idMail'=>$_SESSION['identifiant'],
                        'idCovoit'=> $_POST['idcovoit']));
        if ($res) {
          // si la requete c'est correctement déroulée, afficher un message de succés à l'utilisateur.
          echo '<p class="text-center">Votre trajet à été reservé, vous devez maintenant attendre
          que le conducteur valide votre reservation !</p>';
        } else {
          // sinon afficher une erreur.
          echo '<p class="text-center">Une erreur est survenue à l\'inscription de ce covoiturage</p>';
        }
        // si le nombre de place disponible dans le covoiturage n'est pas suffisant, afficher un message
        // d'erreur.
  } else {
    echo '<p class="text-center">Ce trajet est déjà plein</p>';
  }
// si l'utilisateur accède à la page sans passer en POST un numero de trajet
// afficher une rereur.
} else {
  echo '<p class="text-center">Aucn trajet n\'à été selectionné</p>';
}
 ?>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
