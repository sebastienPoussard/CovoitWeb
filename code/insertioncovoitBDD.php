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


if(isset($_POST['button'])) //s'active a la validation
{
    //on insère dans la BDD les informations concernant le nouveau covoiturage

    $reqTest= 'INSERT INTO Trajet( pointdepart , pointarrivee , dateheuredepart, estannule, conducteur, idvoiture) 
                VALUES( :pointdepart , :pointarrivee , :dateheuredepart, false, :conducteur, :matricule)';


    $isAuthTest = $bdd->prepare($reqTest);
    $isAuthTest->execute(
        array(
            'pointdepart' => $_SESSION['lieuDepart'],
            'pointarrivee' => $_SESSION['lieuArrivee'],
            'dateheuredepart' => $_SESSION['dateHeureDepart'],
            'conducteur' => $_SESSION['identifiant'],
            'matricule' => $_SESSION['matricule']
        )
    );

    //si la requete fonctionne on envoie un message indiquant que tout s'est bien passé
    if($isAuthTest)
    {
        echo '<div class="alert alert-primary" role="alert" >';
        echo "votre covoiturage a bien été enregistré!";
        echo '</div>';
    }
    else
    {
        echo '<div class="alert alert-danger" role="alert" >';
        echo "oops, il y a eu un problème!";
        echo '</div>';
    }

}


?>

<!-- code de la page -->

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
