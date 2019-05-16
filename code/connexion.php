<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/connexion.css">
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/connexion.css" rel="stylesheet">
    <link rel="stylesheet" href="/open-iconic/font/css/open-iconic-bootstrap.css">
    <title>QuietCar, le covoit sans blabla</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <h1 class="mx-auto">Bienvenue sur QuietCar le covoit sans blabla, connectez vous!</h1>
    </div>
    <div class="row">
        <img src="../img/logo.png" alt="logoQuietCar">
    </div>
    <div class="row mx-auto my-3 d-flex align-items-center justify-content-center">
        <form method="post" action="connecter_utilisateur.php" class="col-sm-5 p-3">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 m-auto">
                            <p><input type="email" name="identifiant" placeholder="identifiant@mail.fr"
                                      class="form-control" required></p>
                            <p><input type="password" name="mdp" placeholder="mot de passe" class="form-control" required></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <label>J'enregistre mon mot de passe</label><input type="checkbox"
                                                                               name="connexionAuto"/><br/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <input type="submit" class="btn btn-info" value="Je me connecte" id="buttonCO">
                    <input type="submit" class="btn btn-info" value="Je m'inscris" id="buttonI">
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<footer>
    <div class="footer">
        <div class="row">
            <div class="col-lg-3 text-center">
                <a class="oi oi-envelope-closed" href="mailto:contact@covoit.pouseb.fr">
                    nous contacter
                </a>
            </div>
            <div class="col-lg-6 text-center">
                centre
            </div>
            <div class="col-lg-3 text-right">
                <a class="oi oi-code" href="https://github.com/Qlaus">
                    Badr Riouch
                </a>
                <a class="oi oi-code" href="https://github.com/MelieMelie">
                    Marie-Amélie Mariscalco
                </a>
                <a class="oi oi-code" href="https://github.com/sebastienPoussard">
                    Sébastien Poussard
                </a>
            </div>

        </div>
    </div>
</footer>
