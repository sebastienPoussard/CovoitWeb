<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>
<?php
$mail = $_SESSION['identifiant'];

/* on cherche les information concernant la voiture que l'utilisateur a choisi pour ce covoiturage
 * on cherche le maximum de passagers, le maximum de bagages et le matricule
 */
$req=$bdd->prepare('SELECT maxPassagers,maxbagages,matricule FROM Voiture WHERE proprietaire = :mail AND modele = :modele');

// Preparation et execution de la requete
$res = $req->execute(array('mail' => $mail, 'modele' => $_POST['modele']));
$data = $req->fetch();

/* on affecte les resultats a des variables
 * on prend en compte le fait que le conducteur prenne une place dans la voiture
 */
$maxpassagers=$data['maxpassagers']-1;
$maxbagages=$data['maxbagages'];

$lieuDepart =$_POST['depart'];
$lieuArrivee =$_POST['arrivee'];
$dateHeureDepart =$_POST['dateHeureDepart'];
$estAnnule=false;
$voiture=$_POST['modele'];

// on crée aussi des variables de session que l'on va utiliser dans insertioncovoitBDD.php
$_SESSION['matricule']=$data['matricule'];
$_SESSION['lieuDepart']=$lieuDepart;
$_SESSION['lieuArrivee']=$lieuArrivee;
$_SESSION['dateHeureDepart']=$dateHeureDepart;

/* on crée un tableau récapitulatif des informations du covoiturage
 * la date et l'heure du départ
 * le lieu de depart et le lieu d'arrivée
 * la voiture utilisée et les places disponibles pour les bagages et les passagers
 * on demande la confirmation ensuite,
 *      si oui on insère le covoiturage dans la BDD
 *      sinon on reviens a la page d'accueil
 */
echo "<table>";
        echo "<tr><td colspan=3>Trajet du $dateHeureDepart</td></tr>";
        echo "<tr><td>départ</td><td>:</td><td>$lieuDepart</td></tr>";
        echo "<tr><td>arrivée</td><td>:</td><td>$lieuArrivee</td></tr>";
        echo "<tr><td>voiture utilisée</td><td>:</td><td>$voiture</td></tr>";
        echo "<tr><td>places (passagers)</td><td>:</td><td>$maxpassagers</td></tr>";
        echo "<tr><td>places (bagages)</td><td>:</td><td>$maxbagages</td></tr>";
        echo "<tr><td colspan=3>Confirmez vous ce nouveau covoiturage?</td></tr>";

        echo "<form method='POST' action='insertioncovoitBDD.php'>";
            echo "<tr><td><input type='submit' name='button' value='oui'></td><td></td><td><a href='/index.php' target='_blank'> <input type='button' value='non'> </a></td></tr>";
        echo "</form>";
echo "</table>";

?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
