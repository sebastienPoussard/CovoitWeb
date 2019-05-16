<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritDebut.php'; ?>
<!-- insérer la balise pour utiliser le CSS ici -->
<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritMillieu.php'; ?>

<p>Code de la page PHP spécifique demandé, example : afficher tous les covoiturages
demandés par le formulaire rechercher. <br>Une page est à la racine du projet</p>
<p>le Code HTML des modules (menu, footer, proposer, rechercher) utilise le main.css</p>
<p>Pour utiliser une feuille de style spécifique une page l'ajouter entre le gabarit de début et le
  gabarit de fin en le rangeant dans le dossier CSS</p>
<p>Pour utiliser les chemins : preferer la méthode avec $_SERVER["DOCUMENT_ROOT"]</p>

<?php require $_SERVER["DOCUMENT_ROOT"].'/modules/gabaritFin.php'; ?>
