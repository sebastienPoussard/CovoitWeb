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
$avatar=$_FILES['avatar'];

$verifIdentifiant=$bdd->prepare('SELECT COUNT(*) AS nbr FROM utilisateur WHERE mail=:identifiant');
$verifIdentifiant->bindValue(':identifiant',$IdentifiantMail, PDO::PARAM_STR);
$verifIdentifiant->execute();
$IdUtilise=($verifIdentifiant->fetchColumn()==0)?1:0;
$verifIdentifiant->closeCursor();

if (!$IdUtilise) {
    echo "Votre compte est déjà créé ";
    exit();
}

if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $IdentifiantMail)) {
    echo "Ce n'est pas une adresse mail";
    exit();
}

if ($motDePasse == $verifMotDePasse) {
    $cryptageMotDePasse = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    echo $cryptageMotDePasse;
}
else {
    echo "vos mots de passe sont différents";
    exit();

}

//On définit les variables :
$poid =2000000;
$largeur = 100;
$longueur = 100;
$ext = array('jpg', 'jpeg', 'gif', 'png'); //Liste des extensions valides
echo $avatar['size'];
if ($avatar['size'] > $poid) {
    echo "Le fichier est trop lourd";
    exit();
}
$CalculTailleAvatar = getimagesize($avatar['size']);
if ($CalculTailleAvatar[0] > $largeur OR $CalculTailleAvatar[1] > $longueur) {
    echo "l'image n'a pas la bonne taille pour un avatar";
    exit();
}

$verifExtension = pathinfo($avatar['name'], PATHINFO_EXTENSION);
if (!in_array($verifExtension, $ext)) {

    echo "type de fichier non suporté";
    exit();
}

$verifIdentifiant=$bdd->prepare('INSERT INTO utilisateur (mail, mdp, nomuser,             
        prenomuser) VALUES (:mail, :mdp, :nomuser, :prenomuser)');
$verifIdentifiant->execute(
    array(
        'nomuser'=>$nomUser,
        'prenomuser'=>$prenomUser,
        'mail'=>$IdentifiantMail,
        'mdp'=>$cryptageMotDePasse,
       // 'description'=>$descriptionUser
)
);