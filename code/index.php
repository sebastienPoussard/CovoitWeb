<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php
$sql= 'SELECT * FROM trajet ORDER BY idtrajet DESC ';// Prepare and execute the query
$request = $bdd->prepare($sql);
$request->execute();
while($result=$request->fetch())
{
    echo '<div class="card text-center">';
        echo '<div class="card-header oi oi-flag">';
            echo 'Trajet de '.$trajet['pointdepart'].' à '.$trajet['pointarrivee'].;
        echo '</div>';
        echo '<div class="card-body">';
            echo '<div class="row">';
                echo '<div class="col-lg-3">';
                    echo '<img class="" src="/user/'.$trajet['conducteur'].'.jpg" width="100" height="100" alt="Card image cap">';
                echo '</div>';
                echo '<div class="col-lg-9">';
                    echo '<h5 class="card-title oi oi-clock"> Départ prévue : '.$datefr.'</h5>';
                    echo '<p class="card-text">Immatriculation du véhicule : '.$trajet['idvoiture'].'</p>';
                    echo '<p class="card-text oi oi-envelope-closed"> Conducteur : '.$trajet['conducteur'].'</p>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
}
?>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
