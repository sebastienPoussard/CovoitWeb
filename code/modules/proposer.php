<div class="container-fluid" id="proposer">
  <div class="text-center">
    <h2>Proposer</h2>
  </div>
  <form method="post" action="confirmationcovoiturage.php" enctype="multipart/form-data">
    <p><input type="text" name="depart" placeholder="De:" required class="form-control"></p>
    <p><input type="text" name="arrivee" placeholder="à" required class="form-control"></p>
    <p><input type="date" name="dateDepart" placeholder="Jour" required class="form-control"></p>
    <p><input type="time" name="heureDepart" placeholder="heure" required class="form-control"></p>
    <label for="nbbagages" >vous pouvez transporter : </label>
    <select type="select" name="nbbagages">
      <option value="0">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
    </select>
      <label for="choixvoiture" >vous utiliserez : </label>
    <select type="select" name="choixvoiture">
    </select>
      <?php
      //preparation de la requete
      $req="SELECT * FROM Voiture WHERE proprietaire = :mail";
      // preparation et execution de la requete
      $res = $bdd->prepare($req);
      $res->execute(array('mail' => $_SESSION['identifiant']));
      //boucle, pour chaque voiture, ajouter une option
      while($data=$res->fetch())
      {
          $marque=$data['marque'];
          echo "<option value=\" ".$marque." \" >".$marque."</option>";
      }

      ?>

    <div class="p-3 text-center ml-3">
      <input type="submit" class="btn btn-info" name="valider" value="Proposer" id="button">
    </div>
  </form>
</div>