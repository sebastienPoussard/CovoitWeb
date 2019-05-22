<?php require $_SERVER["DOCUMENT_ROOT"] . '/modules/gabaritDebut.php'; ?>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../open-iconic/font/css/open-iconic-bootstrap.css">
<?php require $_SERVER["DOCUMENT_ROOT"] . '/modules/gabaritMillieu.php'; ?>
<?php require 'modules/cobdd.php' ?>
    <head>
        <title>Changez votre mot de passe</title>
        <link rel="stylesheet" type="text/css" href="main.css">
        <form method="post" action="changer_motDePasse.php" class="col-sm-5 p-3">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 m-auto">
                            <p><input type="email" name="identifiant" placeholder="identifiant@mail.fr"
                                      class="form-control" required></p>
                            <p><input type="password" name="ancienMDP" placeholder="mot de passe" class="form-control"
                                      required></p>
                            <p><input type="password" name="nouveauMDP" placeholder="mot de passe" class="form-control"
                                      required></p>
                            <p><input type="password" name="nouveauMDP2" placeholder="mot de passe" class="form-control"
                                      required></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <input type="submit" class="btn btn-info" value="Je change" id="buttonCO">
                </div>
            </div>
        </form>
    </head>
    <body>
    <?php
    $ancienMDP = $_POST["ancienMDP"];
    $nouveauMDP = $_POST["nouveauMDP"];
    $nouveauMDP2 = $_POST["nouveauMDP2"];
    $identifiant = $_POST["identifiant"];

    $reqInfos = $bdd->prepare('SELECT mdp FROM utilisateur WHERE mail=:identifiant');
    $reqInfos->bindValue(':identifiant', $_POST['identifiant'], PDO::PARAM_STR);
    $reqInfos->execute();
    $mdp = $reqInfos->fetchColumn();

    // sinon verifier que le mdp crypté correspond
    $verificationMdp = password_verify($_POST["ancienMDP"], $mdp);
    if ($verificationMdp) {
        if ($nouveauMDP == $nouveauMDP2) {

            $req = $bdd->prepare('UPDATE utilisateur SET mdp= :mdp WHERE mail = :mail');
            $cryptageMotDePasse = password_hash($_POST['nouveauMDP'], PASSWORD_DEFAULT);
            $test = $req->execute(array("mail" => $identifiant, "mdp" => $cryptageMotDePasse));
            echo "Votre mot de passe est modifié";
        } else {

            echo 'Vos mots de passes sont différents';
        }
    } else
        echo "Mauvais mot de passe";
    ?>
    </body>
    </html>
<?php require $_SERVER["DOCUMENT_ROOT"] . '/modules/gabaritFin.php'; ?>