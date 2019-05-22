
<?php require_once "modules/cobdd.php";?>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../open-iconic/font/css/open-iconic-bootstrap.css">
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php
$nomUtilisateur = $_GET['prenomUser'];
$req = $bdd->prepare(
        'SELECT u.mail, u.nomuser, u.prenomuser, v.marque, count(distinct r.IDTrajet) as nbdemandes, count(distinct t.IDTrajet) as nbtrajet
                  FROM utilisateur u, reservation r, trajet t, voiture v
                  WHERE prenomuser LIKE :prenomUser
                  AND u.mail = r.mail
                  AND t.conducteur = u.mail
                  AND v.proprietaire = u.mail
                  GROUP BY (u.mail, u.nomuser, u.prenomuser, v.marque);'
);
$req->execute(array("prenomUser" => "%".$nomUtilisateur."%"));
$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
// s'il n'y à aucun résultat alors afficher un message
if (!$resultat) {
    echo 'Aucun profil existant';
} else {
    ?>
    <div class="text-center">
        <h3>Voici les profils existants</h3>
    </div>

    <?php
// sinon les afficher tous
    foreach ($resultat as $profil):
        echo "<div class=\"container centered\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col\">";
        echo "<table>";
        $photo = glob("./user/".$profil['mail'].".*")[0];
        if(file_exists($photo))
        {
            echo "<tr><td rowspan=6> <img src='$photo' style='max-height: 10vh'></td></tr>";
        }
        else
        {

            echo "<tr><td rowspan=6> <img src=\"/img/logoPhotodeProfil.png\"> </td></tr>";
        }

        echo "<tr><td>nom, prenom : ".$profil['nomuser']." ".$profil['prenomuser']."</td></tr>";
        echo "<tr><td>note : ".round($profil['moynote'],2)."</td></tr>";
        echo "<tr><td>nombre de trajets demandés: ".$profil['nbdemandes']."</td></tr>";
        echo "<tr><td>nombre de trajets conduits : ".$profil['nbtrajet']."</td></tr>";
        echo "<tr><td>voiture(s) : ".$profil['marque'];
        echo "</td></tr>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    endforeach;
}
?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>


