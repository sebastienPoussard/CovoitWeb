<div class="container-fluid" id="rechercher">
  <div class="text-center">
    <h2>Rechercher</h2>
  </div>
  <form method="post" action="rechercher.php" enctype="multipart/form-data">
    <p><input type="text" name="lieuDepart" placeholder="De:" required class="form-control"></p>
    <p><input type="text" name="lieuArrivee" placeholder="à:" required class="form-control"></p>
    <p><input type="date" name="dateDepart" placeholder="Jour" value="<?php echo date("Y-m-j"); ?>" required class="form-control"></p>
    <p><input type="time" name="heureDepart" placeholder="heure" value="<?php echo date("H:i",time()+60*60*2); ?>" required class="form-control"></p>
    <!-- implementer si temps ok
    <div class="row col-sm-2 p-3 ">
      <label for="bagages">Bagages</label>
      <SELECT id="bagages" name="bagages">
        <option>1</option>
        <option>2</option>
        <option>3</option>
      </SELECT>
    </div>
    -->
    <div class="col-sm-2 p-3 text-center ml-3">
      <input type="submit" class="btn btn-info" value="Rechercher" id="button">
    </div>
  </form>
</div>
