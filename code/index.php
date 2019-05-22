<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php
$sql= 'SELECT * FROM trajet ORDER BY idtrajet DESC ';// Prepare and execute the query
$request = $bdd->prepare($sql);
$request->execute();
while($result=$request->fetch())
{
    echo "<table>";
    echo "<tr><td colspan='3'>trajet du ".$result['dateheuredepart']."</tr></td>";
    echo "<tr><td>".$result['pointdepart']."</td><td>-></td><td>".$result['pointarrivee']."</td></tr>";
    if($result['estannule']==true)
    {echo "<tr><td colspan='3'>ANNULÉ</tr></td>";}
    echo "</table>";
}
?>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
