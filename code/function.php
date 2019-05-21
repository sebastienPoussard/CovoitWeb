<?php
/**
 * Created by PhpStorm.
 * User: melie
 * Date: 21/05/19
 * Time: 17:10
 */
function getProfil($mail)
{
    global $bdd;
    $photo_profil = "\"/user/" . $mail . ".jpg\"";

// Query
    $tabreq = array('SELECT * FROM utilisateur WHERE mail = :mail',
        'SELECT avg(note) as moynote FROM Commentaire WHERE utilisateurcible = :mail',
        'SELECT count(IDTrajet) as nbdemandes FROM reservation WHERE mail = :mail',
        'SELECT count(IDTrajet) as nbtrajet FROM Trajet WHERE conducteur = :mail',
        'SELECT * FROM Trajet WHERE conducteur = :mail');

    $reqTest = 'SELECT marque FROM voiture WHERE proprietaire = :mail';// Prepare and execute the query
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
}