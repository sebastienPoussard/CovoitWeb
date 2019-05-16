<?php
// recuperer le mdp corresdpondant à l'utilisateur
session_start();
include $_SERVER["DOCUMENT_ROOT"].'/modules/cobdd.php';
$reqInfos= $bdd->prepare('SELECT mail, mdp FROM utilisateur WHERE mail=:identifiant');
$reqInfos->bindValue(':identifiant',$_POST['identifiant'], PDO::PARAM_STR);
$reqInfos->execute();
$reqResultat=$reqInfos->fetch();
// si aucun mdp n'est trouvé alors l'adresse utilisateur est mauvaise
if($reqResultat) {
  // sinon verifier que le mdp crypté correspond
  $verificationMdp = password_verify($_POST['mdp'],$reqResultat['mdp']);
  if($verificationMdp){
    // s'il correspond créer la session
    $_SESSION["identifiant"]=$reqResultat['mail'];
    // si l'utilisateur à choisi de rester connecter, créer le cookie
    if (isset($_POST['connexionAuto'])) {
        $delais = time() + 365*24*3600;
        $test = setcookie("mail", $_SESSION["identifiant"], $delais);
    }
  } else {
    // sinon afficher une erreur de mdp
    echo 'le mot de passe est incorrect';
  }
}
?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>
<?php
// afficher un message à l'utilisateur pour qu'il sache s'il est connecté ou non
if (!$reqResultat) {
  echo '<p class="text-center">Cette utilisateur n\'existe pas</p>';
  echo '<button type="button" class="btn btn-success">Je m\'inscrit</button>'
} else {
  echo '<p class="text-center">Vous êtes maintenant connecté !</p>';
}
 ?>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
