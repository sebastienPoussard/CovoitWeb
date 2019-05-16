</head>
<body>
  <?php
  require 'cobdd.php';
  require 'header.php';
   ?>
  <div class="row" id="bg-img">
    <div class="col-lg-2">
      <!-- la colonne de gauche rechercher un trajet -->
      <?php require $_SERVER["DOCUMENT_ROOT"].'/modules/rechercher.html'; ?>
    </div>
    <div class="col-lg-8">
