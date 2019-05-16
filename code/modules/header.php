<?php
// récuperer le prénom de l'Utilisateur
$req = $bdd->prepare('SELECT prenomuser FROM utilisateur WHERE mail = :mail;');
$test = $req->execute(array("mail" => $_SESSION['identifiant']));
$res = $req->fetchAll(PDO::FETCH_ASSOC);
$nomUtilisateur = $res[0]['prenomuser'];
 ?>
<!-- barre de navigation du site -->
<nav class="navbar navbar-expand-lg navbar-light bg-light py-0">
  <!-- responsive design : si l'écran est trop petit un bouton apparait -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- la "marque" du site, correspond au logo -->
  <a class="navbar-brand" href="/index.php">
    <img src="/img/logo.png" width="80" height="50" alt="logo QuietCar">
  </a>
  <!-- les éléments de la barre de navigation -->
  <div class="collapse navbar-collapse" id="navbarNav">
    <!-- formulaire de recherche -->
    <form class="form-inline mx-auto">
      <input class="form-control mr-sm-2" type="search" placeholder="Utilisateur" aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">recherche</button>
    </form>
    <!-- partie droite de la barre de navigation -->
    <ul class="nav navbar-nav navbar-right">
      <!-- photo de l'utilisateur -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <img class="rounded" src="/user/avatar.jpg" width="50" height="50">
        </a>
      </li>
      <!-- accès au profil de l'utilisateur -->
      <li class="nav-item">
        <?php
        // afficher le prénom de l'utilisateur seulement s'il est connecté
        if(isset($_SESSION['identifiant'])) {
          echo '<a class="nav-link oi oi-person text-primary pt-3" href="#"> ';
          echo $nomUtilisateur;
          echo "<a>";
        }
         ?>
      </li>
      <!-- déconnexion de l'utilisateur -->
      <li class="nav-item">
        <?php
        // si l'utilisateur est connecté le bouton est pour se deconnecter
        if (isset($_SESSION["identifiant"])) {
          echo '<a class="nav-link oi oi-account-logout text-primary pt-3" href="/deconnexion.php"> Déconnexion</a>';
        } else {
          // sinon le bouton est pour se deconnecter
          echo '<a class="nav-link oi oi-account-login text-primary pt-3" href="/connexion.php">Connexion</a>';

        }
         ?>

      </li>
    </ul>
  </div>
</nav>
