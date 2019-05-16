<?php
// si le cookie existe et que l'utilisateur n'est pas sur la page de deconnexion,
// créer la session automatiquement
session_start();
if (isset($_COOKIE['mail']) && !($_SERVER['REQUEST_URI'] == "/deconnexion.php")) {
  $_SESSION['identifiant']=$_COOKIE['mail'];
}
// echo '$_SESSION : ';
// var_dump($_SESSION['identifiant']);
// echo '<br>$_COOKIE : ';
// var_dump($_COOKIE['mail']);
 ?>
