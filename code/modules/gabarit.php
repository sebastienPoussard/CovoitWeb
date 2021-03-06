<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>QuietCar, le covoit sans blabla</title>
    <!-- css du site -->
    <link rel="stylesheet" href="/css/main.css">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- css d'open iconic compatible bootstrap -->
    <link rel="stylesheet" href="/open-iconic/font/css/open-iconic-bootstrap.css">
</head>
<body>
  <?php
  require 'cobdd.php';
  require 'header.php';
   ?>
  <div class="row" id="bg-img">
    <div class="col-lg-2">
      <!-- la colonne de gauche rechercher un trajet -->
      <?php require $_SERVER["DOCUMENT_ROOT"].'/Rechercher/rechercher.html'; ?>
    </div>
    <div class="col-lg-8">
      <!-- contenu centrale à modifier en fonction de la page -->
      <p> contenu centrale different sur chaque page</p>
    </div>
    <div class="col-lg-2">
      <!-- colonne de droite pour proposer un trajet -->
      <?php require $_SERVER["DOCUMENT_ROOT"].'/Proposer/Proposer_un_covoiturage.html'; ?>
    </div>
  </div>
<!-- js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
<?php require 'footer.php'; ?>
</html>
