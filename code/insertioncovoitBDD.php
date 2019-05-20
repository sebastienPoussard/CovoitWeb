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


if(isset($_POST['button']))
{
    $reqTest= 'INSERT INTO Trajet(idTrajet , pointdepart , pointarrivee , dateheuredepart, conducteur) 
              VALUES(:idTrajet , :pointdepart , :pointarrivee , :dateheuredepart, :conducteur)';
    //'.$_SESSION['$idtrajet'].','.$_SESSION['$lieuDepart'].','.$_SESSION['$lieuArrivee'].','.$_SESSION['$dateHeureDepart'].','.$_SESSION['identifiant'].')');

    // Prepare and execute the query
    $isAuthTest = $bdd->prepare($reqTest);
    $isAuthTest->execute(
        array(
            'idtrajet' => $_SESSION['$idtrajet'],
            'pointdepart' => $_SESSION['$lieuDepart'],
            'pointarrivee' => $_SESSION['$lieuArrivee'],
            'dateheuredepart' => $_SESSION['$dateHeureDepart'],
            'conducteur' => $_SESSION['identifiant']
        )
    );

    $reqInsert->execute();
    header("Location: https://covoit.pouseb.fr/index.php");
}


?>

<!-- code de la page -->

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
