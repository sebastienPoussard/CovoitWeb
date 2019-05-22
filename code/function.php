<?php
/**
 * Created by PhpStorm.
 * User: melie
 * Date: 21/05/19
 * Time: 17:10
 */
function changerMotDePasse($mail, $password){
    $db = connexionBD();
    //tester la validité du mot de passe
    if (!isPasswordValid($password)){
        return false;
    }
    //Modifier le mot de passe dans la bd
    $result = pg_query_params($db, "UPDATE Utilisateur SET passwd = $2 WHERE mail = $1;", array($mail, $password));
    return $result;
}