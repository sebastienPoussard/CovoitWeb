<?php
/**
 * Created by PhpStorm.
 * User: melie
 * Date: 21/05/19
 * Time: 16:02
 */

require_once "cobdd.php";

$nomUtilisateur = $_GET['prenomUser'];
$req = $bdd->prepare('SELECT * FROM utilisateur WHERE nomuser LIKE  :prenomUser OR prenomuser LIKE :prenomUser;');
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
        $photo = glob("/user/".$profil['mail'].".*")[0];
        ?>
        <div class="col-md-3 ficheTrajet" id="border" >
            <img src="../user/<?php echo $photo; ?>" class="img-circle" alt="profilpicture" id="avatar">
            <h4>
                <?php echo $profil['prenomuser']; ?>
            </h4>
        </div>
        <!-- Partie droite avec infos du trajet  -->
            <a class="btn btn-info" href="consulterProfil.php?mail=<?php echo $profil['mail']; ?>">Voir profil</a>
    <?php
    endforeach;
}

?>

