<?php
// si le cookie existe, créer la session automatiquement
if (isset($_COOKIE['mail'])) {
  session_start();
  $_SESSION['identifiant']=$_COOKIE['mail'];
}
echo '$_SESSION : ';
var_dump($_SESSION['identifiant']);
echo '<br>$_COOKIE : ';
var_dump($_COOKIE['mail']);
 ?>
