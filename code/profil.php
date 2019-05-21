<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<link href="../css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="../open-iconic/font/css/open-iconic-bootstrap.css">
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>
<?php require 'function.php';

getProfil($_SESSION['identifiant']);

?>
</head>
<body>

<?php
/*
foreach ($tabResult as $resReq) {
    //var_dump($resReq);
    echo "--..---<br>";
    foreach ($resReq as $field) {
        echo "<br>..<br>";
        var_dump($field);
        //print_r($field);
    }
}
*/

//[n°requete] [0]

echo "<div class=\"container centered\">";
echo "<div class=\"row\">";

echo "<div class=\"col\">";
echo "<table>";
if(file_exists($photo_profil))
{
    echo "<tr><td rowspan=6> <img src=\"/user/".$mail.".jpg\"> </td></tr>";
}
else
{

    echo "<tr><td rowspan=6> <img src=\"/img/logoPhotodeProfil.png\"> </td></tr>";
}

echo "<tr><td>nom, prenom : ".$tabResult[0][0]['nomuser']." ".$tabResult[0][0]['prenomuser']."</td></tr>";
echo "<tr><td>note : ".round($tabResult[1][0]['moynote'],2)."</td></tr>";
echo "<tr><td>nombre de trajets demandés: ".$tabResult[2][0]['nbdemandes']."</td></tr>";
echo "<tr><td>nombre de trajets conduits : ".$tabResult[3][0]['nbtrajet']."</td></tr>";

echo "<tr><td>voiture(s) : ";
while($resultTest=$isAuthTest->fetch())
{echo $resultTest['marque'].", ";}
echo "</td></tr>";

echo "</table>";
echo "</div>";

echo "</div>";
echo "</div>";
echo "<tr><td>ajouter une voiture ?</td><td> ICI </td> </tr>";

echo "<div class=\"container\">";
echo "<div class=\"row\">";

for($i=0;$i<3;$i++)
{if(!empty($tabResult[4][$i]['pointdepart']))
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
