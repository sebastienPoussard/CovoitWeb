<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>
<?php
            $mail = $_SESSION['identifiant'];

            // Query
            $req=$bdd->prepare('SELECT maxPassagers,maxbagages,matricule FROM Voiture WHERE proprietaire = :mail AND modele = :modele');

            // Prepare and execute the query
            $res = $req->execute(array('mail' => $mail, 'modele' => $_POST['modele']));
            $data = $req->fetch();
            $maxpassagers=$data['maxpassagers']-1;
            $maxbagages=$data['maxbagages'];




            $lieuDepart =$_POST['depart'];
            $lieuArrivee =$_POST['arrivee'];
            $dateHeureDepart =$_POST['dateHeureDepart'];
            $estAnnule=false;
            $voiture=$_POST['modele'];

            $_SESSION['matricule']=$data['matricule'];
            $_SESSION['lieuDepart']=$lieuDepart;
            $_SESSION['lieuArrivee']=$lieuArrivee;
            $_SESSION['dateHeureDepart']=$dateHeureDepart;

        echo "<table>";
        echo "<tr><td colspan=3>Trajet du $dateHeureDepart</td></tr>";
        echo "<tr><td>départ</td><td>:</td><td>$lieuDepart</td></tr>";
        echo "<tr><td>arrivée</td><td>:</td><td>$lieuArrivee</td></tr>";
        echo "<tr><td>voiture utilisée</td><td>:</td><td>$voiture</td></tr>";
        echo "<tr><td>places (passagers)</td><td>:</td><td>$maxpassagers</td></tr>";
        echo "<tr><td>places (bagages)</td><td>:</td><td>$maxbagages</td></tr>";
        echo "<tr><td colspan=3>Confirmez vous ce nouveau covoiturage?</td></tr>";

        echo "<form method='POST' action='insertioncovoitBDD.php'>";
        echo "<tr><td><input type='submit' name='button' value='oui'></td>
             <td></td><td><a href='/index.php' target='_blank'> <input type='button' value='non'> </a></td></tr>";
        echo "</table>";
        echo "</form>";






       ?>


<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
