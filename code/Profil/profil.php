<!DOCTYPE html>
<html lang="en">
<head>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../open-iconic/font/css/open-iconic-bootstrap.css">
    <meta charset="UTF-8">
    <title>proposer</title>
<?php
    include covoitPDO.php;
    // Query
    $tabreq=array('SELECT * FROM utilisateurs WHERE mail = :mail',
                  'SELECT avg(note) as moynote FROM Commentaire WHERE mail = :mail',
                  'SELECT marque FROM voiture WHERE mail = :mail',
                  'SELECT count(IDTrajet) as nbdemandes FROM reserver WHERE mail = :mail',
                  'SELECT count(IDTrajet) as nbtrajet FROM Trajet WHERE mail = :mail',
                  'SELECT * FROM Trajet WHERE mail = :mail');

    $tabResult = array();
    // Prepare and execute the query
    for($i=0;$i<=5;$i++)
    {
        $isAuth = $link->prepare($tabreq[$i]);
        $isAuth->execute(
            array(
                'mail' => $mail
           )
        );
        $tabResult[$i] = $isAuth;
    }

    $data0=$tabResult[0]->fetch();
    $data1=$tabResult[1]->fetch();
    $data2=$tabResult[2]->fetch();
    $data3=$tabResult[3]->fetch();
    $data4=$tabResult[4]->fetch();
    $data5=$tabResult[5]->fetch();
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