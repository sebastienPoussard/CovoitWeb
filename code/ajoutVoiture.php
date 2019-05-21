<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../open-iconic/font/css/open-iconic-bootstrap.css">
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>
<?php
$mail = $_SESSION['identifiant'];
echo "<form method='post' action='insertionvoitureBDD.php' enctype='multipart/form-data'>";
    echo "<table>";
        echo "<tr> <td> Nouvelle voiture de : </td><td> $mail </td> </tr>";
        echo "<tr> <td><input type='text' name='marque' placeholder='Marque' required class='form-control'></td> </tr>";
        echo "<tr> <td><input type='text' name='modele' placeholder='Modèle' required class='form-control'></td> </tr>";
        echo "<tr> <td><input type='text' name='matricule' placeholder='Matricule' required class='form-control'></td> </tr>";
        echo "<tr> <td><input type='number' name='maxbagages' min='1' max='50' placeholder='Max. bagages' required class='form-control'></td> </tr>";
        echo "<tr> <td><input type='number' name='maxpassagers' min='1' max='50' placeholder='Max. passagers' required class='form-control'></td> </tr>";
        echo "<tr> <td> <input type='submit' class='btn btn-info' name='valider' value='Ajouter' id='button'> </td> </tr>";
    echo "</table>";
echo "</form>";


?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>