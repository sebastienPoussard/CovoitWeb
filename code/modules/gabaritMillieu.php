</head>
<body>
  <?php
  require $_SERVER["DOCUMENT_ROOT"].'/modules/cobdd.php';
  require $_SERVER["DOCUMENT_ROOT"].'/modules/header.php';
   ?>
  <div class="row" id="bg-img">
    <div class="col-lg-2">
      <!-- la colonne de gauche rechercher un trajet -->
      <?php require $_SERVER["DOCUMENT_ROOT"].'/modules/rechercher.php'; ?>
    </div>
    <div class="col-lg-8">
