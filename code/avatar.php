<?php
/**
 * Created by PhpStorm.
 * User: melie
 * Date: 07/05/19
 * Time: 10:21
 */
echo "tesst";
$avatar=$_FILES['avatar'];
$cheminDuFichier = $_SERVER["DOCUMENT_ROOT"].'/user/';
$poid =2000000;
$largeur = 20000;
$longueur = 20000;
$ext = array('jpg', 'jpeg', 'gif', 'png'); //Liste des extensions valides
$CalculTailleAvatar = getimagesize($avatar['tmp_name']);
$verifExtension = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
if ($avatar['size'] > $poid) {
    echo "Le fichier est trop lourd";
}
else if ($CalculTailleAvatar[0] > $largeur OR $CalculTailleAvatar[1] > $longueur) {
    echo "l'image n'a pas la bonne taille pour un avatar";
}
else if (!in_array($verifExtension, $ext)) {

    echo "type de fichier non suporté";
}
else {
    $bool = move_uploaded_file($avatar['tmp_name'], $_SERVER["DOCUMENT_ROOT"]."/user/" . $_POST['mail'] . "." . $verifExtension);
    echo("test : ");
    var_dump($bool);

}
