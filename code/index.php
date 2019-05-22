<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php
$sql= 'SELECT * FROM trajet ORDER BY idtrajet DESC ';// Prepare and execute the query
$request = $bdd->prepare($sql);
$request->execute();
while($result=$request->fetch())
{
    $photo_profil='/user/'.$result['conducteur'].'.jpg';

    echo '<div class="card text-center">';
        echo '<div class="card-header oi oi-flag">';
            echo 'Trajet de '.$result['pointdepart'].' à '.$result['pointarrivee'];
        echo '</div>';
        echo '<div class="card-body">';
            echo '<div class="row">';
                echo '<div class="col-lg-3">';
                if(file_exists($photo_profil))
                {
                    echo '<img class="" src='.$photo_profil.' width="100" height="100" alt="Card image cap">';
                }
                else
                {
                    echo '<img class="" src="/img/logoPhotodeProfil.png" width="100" height="100" alt="Card image cap">';
                }

                echo '</div>';
                echo '<div class="col-lg-9">';
                    echo '<h5 class="card-title oi oi-clock"> Départ prévu : '.$result['dateheuredepart'].'</h5>';
                    echo '<p class="card-text">Immatriculation du véhicule : '.$result['idvoiture'].'</p>';
                    echo '<p class="card-text oi oi-envelope-closed"> Conducteur : '.$result['conducteur'].'</p>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';

    echo '<br>';
}
?>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
