<?php
// détruire la session active
session_start();
session_unset();
session_destroy();
// détruire le setcookie
setcookie ("mail", "", time() - 3600);
?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php
echo '<p class="text-centered"> Vous êtes maintenant déconnecté </p>';
?>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
