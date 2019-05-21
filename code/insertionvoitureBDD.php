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


if(isset($_POST['button']))
{

    $reqTest= 'INSERT INTO voiture VALUES( :matricule , :marque , :modele, :maxbagages, :maxpassagers, :proprietaire)';
    //'.$_SESSION['$idtrajet'].','.$_SESSION['$lieuDepart'].','.$_SESSION['$lieuArrivee'].','.$_SESSION['$dateHeureDepart'].','.$_SESSION['identifiant'].')');

    // Prepare and execute the query
    $isAuthTest = $bdd->prepare($reqTest);
    $isAuthTest->execute(
        array(
            'matricule' => $_POST['matricule'],
            'marque' => $_POST['marque'],
            'modele' => $_POST['modele'],
            'maxbagages' => $_POST['maxbagages'],
            'maxpassagers' => $_POST['maxpassagers'],
            'proprietaire' => $_SESSION['identifiant']
        )
    );
    if($isAuthTest)
    {
        echo "votre voiture a bien été enregistrée!";
    }
    else
    {
        echo "oops, il y a eu un problème!";
    }

}


?>

<!-- code de la page -->

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
