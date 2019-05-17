<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php
if (isset($_POST['idcovoit'])) {
  $req = $bdd->prepare('INSERT INTO reservation VALUES (:mail, :idTrajet, FALSE, TRUE) ;');
  $res = $req->execute(array('mail'=>$_SESSION['identifiant'], 'idTrajet'=>$_POST['idcovoit']));
  if (!$res) {
    echo '<p class="text-center">une erreur est survenue à l\'ajout dans la base de données</p>';
  } else {
    echo '<p class="text-center">votre inscrpiton au covoiturage à été réalisé,
    vous devez maintenant attendre la validation du conducteur</p>';
  }
} else {
  echo '<p class="text-center">Aucun covoiturage n\'à été séléctionné</p>';
}

 ?>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
