<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
    <!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>
<?php
/**
 * Created by PhpStorm.
 * User: Badr RIOUCH
 * Date: 20/05/2019
 * Time: 23:04
 */
var_dump($_SESSION);

/*
if(isset($_POST['button']))
{
    $reqInsert= 'INSERT INTO Trajet(idTrajet , pointdepart , pointarrivee , dateheuredepart, conducteur) VALUES('.$_SESSION['$idTrajet'].','.$_SESSION['$lieuDepart'].','.$_SESSION['$lieuarrivee'].','.$_SESSION['$dateHeureDepart'].','.$_SESSION['identifiant'].')';
    $conn->execute($reqInsert);
    header("Location: https://covoit.pouseb.fr/index.php");
}
*/

?>

<!-- code de la page -->

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
