<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<?php
$sql= 'SELECT * FROM trajet ORDER BY idtrajet DESC ';// Prepare and execute the query
$request = $bdd->prepare($sql);
$request->execute();

var_dump($request);
?>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
