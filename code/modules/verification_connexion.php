<?php
// si le cookie existe, créer la session automatiquement
if (isset($_COOKIE['mail'])) {
  session_start();
  $_SESSION['identifiant']=$_COOKIE['mail'];
} 
 ?>
