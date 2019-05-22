<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<link href="../css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="../open-iconic/font/css/open-iconic-bootstrap.css">
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>
<?php
$mail = $_SESSION['identifiant'];
$photo_profil="\"/user/".$mail.".jpg\"";

/* Différentes requetes:
 * informations d'utilisateur
 * moyenne de sa note
 * nombre de trajets qu'il a demandé
 * nombre de trajets qu'il a conduit
 * toutes les informations de sa table trajet
 * les voitures qu'il possède
 */
$tabreq = array('SELECT * FROM utilisateur WHERE mail = :mail',
    'SELECT avg(note) as moynote FROM Commentaire WHERE utilisateurcible = :mail',
    'SELECT count(IDTrajet) as nbdemandes FROM reservation WHERE mail = :mail',
    'SELECT count(IDTrajet) as nbtrajet FROM Trajet WHERE conducteur = :mail',
    'SELECT * FROM Trajet WHERE conducteur = :mail ORDER BY idtrajet DESC ');

$reqTest= 'SELECT marque FROM voiture WHERE proprietaire = :mail';// Prepare and execute the query
$isAuthTest = $bdd->prepare($reqTest);
$isAuthTest->execute(
    array(
        'mail' => $mail
    )
);


$tabResult = array();

foreach ($tabreq as $req) {

    // Prepare and execute the query
    $isAuth = $bdd->prepare($req);
    $isAuth->execute(
        array(
            'mail' => $mail
        )
    );
    array_push($tabResult, $isAuth->fetchAll());
}

/* Les requetes sont affichées dans un tableau a 3 dimensions
 * qui seront en général
 * $tabResult [index de la requete dans l'array] [0] [champ]
 */

?>
</head>
<body>

<?php
/* On crée un tableau dans lequel seront affichés les differentes infos de l'utilisateur
 * Sa photo de profil si elle existe, sinon on affichera la photo par défaut
 * son nom et prénom
 * sa note, qui est une moyenne de toutes celles qu'il a recu, arrondie a 2 chiffres après la virgule
 * le nombre de trajets qu'il a conduit
 * le nombre de trajets qu'il a demandé
 * dans une boucle, on affiche ses voitures
 * on lui permet d'accéder a un formulaire pour ajouter une nouvelle voiture
 */

echo "<div class=\"container centered\">";
    echo "<div class=\"row\">";
        echo "<div class=\"col\">";
        echo $photo_profil ;
            echo "<table class='table table-hover'>";
                if(file_exists($photo_profil))
                {
                    echo "<tr><td rowspan=8> <img class='rounded img-fluid' src=".$photo_profil."> </td></tr>";
                }
                else
                {
                    echo "<tr><td rowspan=8> <img src=\"/img/logoPhotodeProfil.png\"> </td></tr>";
                }
                echo "<tr><td>nom, prenom : ".$tabResult[0][0]['nomuser']." ".$tabResult[0][0]['prenomuser']."</td></tr>";
                echo "<tr><td>note : ".round($tabResult[1][0]['moynote'],2)."</td></tr>";
                echo "<tr><td>nombre de trajets demandés: ".$tabResult[2][0]['nbdemandes']."</td></tr>";
                echo "<tr><td>nombre de trajets conduits : ".$tabResult[3][0]['nbtrajet']."</td></tr>";
                echo "<tr><td>voiture(s) : ";
                while($resultTest=$isAuthTest->fetch())
                {
                    echo $resultTest['marque'].", ";
                }
                echo "</td></tr>";
                echo "<tr><td>ajouter une voiture ? <a href='ajoutVoiture.php'>ICI</a></td></tr>";
            echo "</table>";
        echo "<p>".$tabResult[0][0]['description']."</p>";
        echo "</div>";
    echo "</div>";
echo "</div>";

/* on affiche les trois derniers trajets qu'il a conduit par ordre de nouveauté
 * on y met le point de départ -> le point d'arrivée
 * la date et l'heure de départ
 */
echo "<div class=\"container\">";
    echo "<div class=\"row\">";
        for($i=0;$i<3;$i++)
        {
            if(!empty($tabResult[4][$i]['pointdepart']))
            {
                echo "<div class=\"col-4\">";
                echo "Covoiturage : ".$tabResult[4][$i]['pointdepart']."->".$tabResult[4][$i]['pointarrivee']."<br>";
                echo "le ".$tabResult[4][$i]['dateheuredepart']."<br>";
                echo "</div>";
            }
        }
    echo "</div>";
echo "</div>";
?>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
