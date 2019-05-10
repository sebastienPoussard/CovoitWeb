<!DOCTYPE html>
<html>
    
    <head>
        
    </head>
    
    <body>
        
        <?php
            include covoitPDO.php;
            // Query
            $req='SELECT maxPassagers FROM Voiture WHERE mail = :mail';
            $Result = array();
            // Prepare and execute the query
            $isAuth = $link->prepare($req);
            $isAuth->execute(
                array(
                    'mail' => $mail
                )
            );
            $Result = $isAuth;
            $data=$Result->fetch();

            $idTrajet = uniqid();
            $lieuDepart =$_POST['depart'];
            $lieuArrivee =$_POST['arrivee'];
            $dateHeureDepart =$_POST['dateheuredepart'];
            $estAnnule=false;
            $bdd->exec("INSERT INTO Trajet(idTrajet , depart , arrivee , dateheuredepart) VALUES('$idTrajet','$lieuDepart','$lieuarrivee','$dateHeureDepart','$estAnnule')");
                        }
        ?>
        
        <table>
            <tr><td colspan=3>  Trajet du $_POST['dateheuredepart']                       </td></tr>
            <tr><td>départ</td>             <td>:</td>      <td><?php $_POST['depart']          ?></td></tr>
            <tr><td> arrivée</td>           <td>:</td>      <td><?php $_POST['arrivee']         ?></td></tr>
            <tr><td>places</td>             <td>:</td>      <td><?php $data['maxPassagers']     ?></td></tr>
            <tr><td>limite de bagages</td>  <td>:</td>      <td><?php $_POST['"nbbagages']      ?></td></tr>

        </table>
    
    </body>
</html>