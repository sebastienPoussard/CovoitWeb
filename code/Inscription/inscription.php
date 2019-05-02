<?php
/**
 * Created by PhpStorm.
 * User: melie
 * Date: 01/05/19
 * Time: 15:56
 */
include '../covoitPDO.php';
$nomUser=$_POST['nomuser'];
$prenomUser=$_POST['prenomuser'];
$IdentifiantMail=$_POST['mail'];
$motDePasse=$_POST['mdp'];
$verifMotDePasse=$_POST['mdpVerif'];
$descriptionUser=$_POST['description'];


$verifIdentifiant=$bdd->prepare('SELECT COUNT(*) AS nbr FROM utilisateur WHERE mail=:identifiant');
$verifIdentifiant->bindValue(':identifiant',$IdentifiantMail, PDO::PARAM_STR);
$verifIdentifiant->execute();
$IdUtilise=($verifIdentifiant->fetchColumn()==0)?1:0;
$verifIdentifiant->closeCursor();
    if (!$IdUtilise) {
        echo "Votre compte est déjà créé ";
    }

    if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $IdentifiantMail)) {
        echo "Ce n'est pas une adresse mail";
    }

    if ($motDePasse == $verifMotDePasse) {
        $cryptageMotDePasse = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    }
    else {
        echo "vos mots de passe sont différents";

    }

    if (!empty($_FILES['avatar'])) {
        //On définit les variables :
        $poid = 10024;
        $largeur = 100;
        $longueur = 100;
        $ext = array('jpg', 'jpeg', 'gif', 'png'); //Liste des extensions valides

        if ($_FILES['avatar'] > $poid) {
            echo "Le fichier est trop lourd";

            $CalculTailleAvatar = getimagesize($_FILES['avatar']);
            if ($CalculTailleAvatar[0] > $largeur OR $CalculTailleAvatar[1] > $longueur) {
                echo "l'image n'a pas la bonne taille pour un avatar";
            }

            $verifExtension = strtolower(substr(strrchr($_FILES['avatar'], '.'), 1));
            if (!in_array($verifExtension, $ext)) {

                echo "type de fichier non suporté";
            }
        }
    }
    