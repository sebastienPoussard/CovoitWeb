<!-- le code pour la partie haute de l'application web -->
<div class="row border border-primary" style="margin:8px; border-radius:10px;">
  <!--  logo -->
  <div class="col-lg-2">
    <a href="index.php">
      <img src="/img/logo.png" width="120" height="90">
    </a>
  </div>
  <!-- Accueil & recherche -->
  <div class="col-lg-7">
    <h3> Accueil <h3>
    <!-- Search form -->
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Rechercher" aria-label="Recipient's username" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button">Rechercher</button>
      </div>
    </div>
  </div>
  <!-- cadre profil, se deconnecter ... -->
  <div class="col-lg-3">
    <!-- sous groupe avec la bordure -->
    <div class="row border border-primary" style="margin:8px; border-radius:10px;">
      <p> Connecté en tant que ...</p>
      <!-- colonne de gauche avec nom d'utilisateur et avatar -->
      <div class="col-lg-6">
        <p> Seb <p>
          <img src="/user/avatar.jpg" height="50" width="50">
      </div>
      <!-- colonne de droite avec les boutons de profil et de deconnexion -->
      <div class="col-lg-6">
        <button type="button" class="btn btn-info ">Profil</button>
        <button type="button" class="btn btn-info ">Déconnexion</button>
      </div>
    </div>
  </div>
</div>
