<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>
<?php

// récuperer les variables passés en post
$nomUser=$_POST['nomuser'];
$prenomUser=$_POST['prenomuser'];
$IdentifiantMail=$_POST['mail'];
$motDePasse=$_POST['mdp'];
$verifMotDePasse=$_POST['mdpVerif'];
$descriptionUser=$_POST['description'];

// interoger la base de données pour savoir si l'utilisateur existe
$verifIdentifiant=$bdd->prepare('SELECT COUNT(*) AS nbr FROM utilisateur WHERE mail=:identifiant');
$verifIdentifiant->bindValue(':identifiant',$IdentifiantMail, PDO::PARAM_STR);
$verifIdentifiant->execute();
$IdUtilise=($verifIdentifiant->fetchColumn()==0)?1:0;
$verifIdentifiant->closeCursor();
$ok = true;
// verifier que l'utilisateur n'existe pas déjà
if (!$IdUtilise) {
    echo '<p class="text-center">Votre compte est déjà créé </p>';
    $ok = false;
}
// verifier que le format du mail est correct
if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $IdentifiantMail)) {
    echo '<p class="text-center">Ce n\'est pas une adresse mail </p>';
    $ok = false;
}
// verifier que les 2 mots de passes entrés dans le formulaire sont identiques
if ($motDePasse == $verifMotDePasse) {
    $cryptageMotDePasse = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
}
else {
    echo '<p class="text-center">Vos mot de passes sont différents </p>';
    $ok = false;
}
// si toutes les conditions sont bonnes, enregistrer l'utilisateur dans la base de données
if ($ok) {
  $verifIdentifiant=$bdd->prepare('INSERT INTO utilisateur (mail, mdp, nomuser,
          prenomuser, estban, description) VALUES (:mail, :mdp, :nomuser, :prenomuser, :estban, :description)');

  $value = $verifIdentifiant->execute(
      array(
        'mail'=>$IdentifiantMail,
        'mdp'=>$cryptageMotDePasse,
        'nomuser'=>$nomUser,
        'prenomuser'=>$prenomUser,
        'estban'=>"FALSE",
        'description'=>$descriptionUser));
  // afficher un message de réussite
  echo '<p class="text-center">Votre inscription est terminée vous pouvez m\'intenant vous identifier</p>';
}

?>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
