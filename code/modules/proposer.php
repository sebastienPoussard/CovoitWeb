<div class="container-fluid" id="proposer">
  <div class="text-center">
    <h2>Proposer</h2>
  </div>
  <form method="post" action="../Proposer/confirmationcovoiturage.php" enctype="multipart/form-data">
    <p><input type="text" name="depart" placeholder="De:" required class="form-control"></p>
    <p><input type="text" name="arrivee" placeholder="à" required class="form-control"></p>
    <p><input type="datetime-local" name="dateHeureDepart" placeholder="Jour" required class="form-control"></p>
    <label for="choixvoiture" >vous conduirez votre : </label>
    <select type="select" name="modele">

      <?php
      $mail=$_SESSION['identifiant'];

      //preparation de la requete
      $req="SELECT * FROM Voiture WHERE proprietaire = :mail";
      // preparation et execution de la requete
      $res = $bdd->prepare($req);
      $res->execute(array('mail' => $mail));
      
      //boucle, pour chaque voiture, ajouter une option
      while($data=$res->fetch())
      {
          $modele=$data['modele'];
          echo "<option value=\"$modele\" >".$modele."</option>";
      }

      ?>
    </select>
    <div class="p-3 text-center ml-3">
      <input type="submit" class="btn btn-info" name="valider" value="Proposer" id="button">
    </div>
  </form>
</div>
