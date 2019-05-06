<?php
session_start();
session_destroy();
include ("index.php");
if($id==0) erreur(ERR_IS_NOT_CO);
echo "Vous êtes déconnectés";