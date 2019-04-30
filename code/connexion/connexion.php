<?php
/**
 * Created by PhpStorm.
 * User: melie
 * Date: 12/04/19
 * Time: 17:01
 */
include '../covoitPDO.php';
$reqInfos= $bdd->prepare('SELECT IDmail, mdp FROM membres WHERE identifiant=:identifiant');
$reqInfos->execute(array(
    'identifiant'=> $user));
$reqResultat=$reqInfos->fetch();

$verificationMdp = password_verify($_POST['mdp'],$reqResultat['mdp']);
if(!$reqResultat)
{
    echo'votre mot de passe est erroné';
}
else
{
    if($verificationMdp){
        session_start();
        $_SESSION['identifiant']=$reqResultat['identifiant'];
        echo'vous êtes connecté!';
    }
    else{
        echo 'identification erronée!';
    }
}
