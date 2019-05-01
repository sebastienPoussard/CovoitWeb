<!-- barre de navigation du site -->
<nav class="navbar navbar-expand-lg navbar-light bg-light py-0">
  <!-- responsive design : si l'écran est trop petit un bouton apparait -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- la "marque" du site, correspond au logo -->
  <a class="navbar-brand" href="#">
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
        <a class="nav-link oi oi-person text-primary pt-3" href="#"> Sébastien</a>
      </li>
      <!-- déconnexion de l'utilisateur -->
      <li class="nav-item">
        <a class="nav-link oi oi-account-logout text-primary pt-3" href="#"> Déconnexion</a>
      </li>
    </ul>
  </div>
</nav>
