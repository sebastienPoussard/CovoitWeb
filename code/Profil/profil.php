<!DOCTYPE html>
<html lang="en">
<head>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../open-iconic/font/css/open-iconic-bootstrap.css">
    <meta charset="UTF-8">
    <title>proposer</title>
<?php
    //ATTENTION CETTE VARIABLE EST LA PUREMENT POUR UN TEST
        $mail='sebastien.poussard@protonmail.ch';
    //FIN ATTENTION
    
    // Query
    $tabreq=array('SELECT * FROM utilisateur WHERE mail = :mail',
                  'SELECT avg(note) as moynote FROM Commentaire WHERE utilisateurcible = :mail',
                  'SELECT marque FROM voiture WHERE proprietaire = :mail',
                  'SELECT count(IDTrajet) as nbdemandes FROM reservation WHERE mail = :mail',
                  'SELECT count(IDTrajet) as nbtrajet FROM Trajet WHERE conducteur = :mail',
                  'SELECT * FROM Trajet WHERE conducteur = :mail');

    $tabResult = array();

    foreach($tabreq as $req) {
    
        // Prepare and execute the query
        $isAuth = $link->prepare($req);
        $isAuth->execute(
            array(
                'mail' => $mail
            )
        );
        array_push($tabResult, $isAuth->fetchAll());
    }
    
    var_dump($tabResult);
    
?>
</head>
<body>

<table>
    
    <tr> <td rowspan = 6> <img src=<?php echo "/img/".$mail; ?> ></td> </tr>
    <tr> <td><?php echo $data0['nomUser'].$data0['prenomUser']; ?></td> </tr>
    <tr> <td><?php echo $data1['moynote']; ?></td> </tr>
    <tr> <td><?php echo $data2['marque']; ?></td> </tr>
    <tr> <td><?php echo $data2['nbdemandes']."trajets proposés";  ?></td> </tr>
    <tr> <td><?php echo $data5['nbtrajet']."trajets demandés"; ?></td> </tr>
    
</table>

<?php    // on affiche ses derniers trajets
while($data5=$tabreq[5]->fetch())
{
?>
    
<table>
    <tr><td><?php $data5['pointDepart']; ?></td><td>-></td><td><?php $data5['pointArrivee']; ?></td></tr>
    <tr><td colspan=3><?php $data5['dateHeureDepart']; ?></td></tr>
</table>
    
<?php
} 
?>


</body>
</html>