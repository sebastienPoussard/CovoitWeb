<?php require 'modules/cobdd.php' ?>
	<head>
		<title>Changez votre mot de passe</title>
		<link rel="stylesheet"type="text/css"href="main.css">
        <form method="post" action="changer_motDePasse.php" class="col-sm-5 p-3">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 m-auto">
                            <p><input type="email" name="identifiant" placeholder="identifiant@mail.fr"
                                      class="form-control" required></p>
                            <p><input type="password" name="ancienMdp" placeholder="mot de passe" class="form-control" required></p>
                            <p><input type="password" name="nouveauMDP" placeholder="mot de passe" class="form-control" required></p>
                            <p><input type="password" name="nouveauMDP2" placeholder="mot de passe" class="form-control" required></p>
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


//si oldpass est bon et newpass1 = newpass2
if( $ancienMDP == $oldpass and $nouveauMDP == $nouveauMDP2) {
    ;
    $req = $bdd->prepare('UPDATE utilisateur SET mdp= :mdp AND identifiant = :mail');
    $test = $req->execute(array("mail" => $identifiant,
                                "mdp"=> $nouveauMDP));
    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
}

//si ancien mot de pass incorrect
if  ($resultat != $ancienMDP){;
	echo 'votre mot de passe est erroné';
	}
	//si  les 2 mdp sont differents
if ($nouveauMDP != $nouveauMDP2){;
	echo 'Vos mots de passes sont différents';
	}




?>
	</body>
	</html>