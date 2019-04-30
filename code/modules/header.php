<!-- le code pour la partie haute de l'application web -->
<div class="row border border-primary" style="margin:8px; border-radius:10px;">
  <!--  logo -->
  <div class="col-lg-2">
    <a href="index.php">
      <img src="/img/logo.png"class="img-fluid">
    </a>
  </div>
  <!-- Accueil & recherche -->
  <div class="col-lg-7">
    <div class="">
      <h3 class="text-center"> Accueil <h3>
      <!-- Search form -->
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Rechercher" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button">Rechercher</button>
        </div>
      </div>
    </div>
  </div>
  <!-- cadre profil, se deconnecter ... -->
  <div class="col-lg-3">
    <!-- sous groupe avec la bordure -->
    <div class="row">
      <!-- colonne de gauche avec l'avatar de l'utilisateur -->
      <div class="col-lg-4">
        <div class="align-middle">
          <img  class="img-fluid align-middle" src="/user/avatar.jpg" style="    display: flex;
    align-items: center;
    flex-wrap: wrap;">
        </div>
      </div>
      <!-- colonne de droite avec le nom de l'utilisateur et les boutons deconnecter et profil -->
      <div class="col-lg-8">
        <div class="align-middle">
        <p class="text-center"> Seb <p>
        <button type="button" class="btn btn-info ">Profil</button>
        <button type="button" class="btn btn-info ">Déconnexion</button>
        </div>
      </div>
    </div>
  </div>
</div>
