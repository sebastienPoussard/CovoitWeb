<?php
/**
 * Created by PhpStorm.
 * User: melie
 * Date: 12/04/19
 * Time: 17:01
 */
include '../covoitPDO.php';
$reqInfos= $bdd->prepare('SELECT mail, mdp FROM utilisateur WHERE mail=:identifiant');
$reqInfos->execute(array(
    'identifiant'=> $user));
$reqResultat=$reqInfos->fetch();

$verificationMdp = password_verify($_POST['mdp'],$reqResultat['mdp']);
if(!$reqResultat)
{
    echo 'votre mot de passe est erroné';
}
else
{
    if($verificationMdp){
        session_start();
        $_SESSION['identifiant']=$reqResultat['IDmail'];
        echo'vous êtes connecté!';
    }
    else{
        echo 'identification erronée!';
    }

}
if (isset($_POST['connexionAuto']))
{
    $delais = time() + 365*24*3600;
    setcookie('mail', $_SESSION['mail'], $delais);
}