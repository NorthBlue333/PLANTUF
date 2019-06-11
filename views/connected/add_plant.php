<?php require_once('models/add_model.php'); ?>
<form action="controllers/add_plant.php" method="post">
  <h1 class="text-center text-green font-weight-bold mb-3">Add your plant</h1>
  <input class="form-control" type="text" name="plantname" placeholder="Plant name">
  <select class="form-control mt-3" name="planttype">
    <option value="none">-- Choose the plant type --</option>
    <?php
    foreach ($subcategories as $key => $subcategory) {
      if($key == 0 || $subcategory['category_id'] != $subcategories[$key-1]['category_id']) {
        if($key != 0) { ?>
        </optgroup>
        <?php } ?>
        <optgroup label="<?= $subcategory['cname'] ?>">
      <?php } ?>
      <option value="<?= $subcategory['subcategory_id'] ?>"><?= $subcategory['name'] ?></option>
      <?php if($subcategory == end($subcategories)) { ?>
      </optgroup>
      <?php } ?>
    <?php }
    ?>
  </select>
  <input class="form-control mt-3" type="number" name="planttemp" placeholder="Temperature value">
  <input class="form-control mt-3" type="number" name="planthum" placeholder="Humidity vlaue">
  <input class="form-control mt-3" type="number" name="plantlight" placeholder="Light value">
  <input class="form-control mt-3" name="plantdate" placeholder="Planting date">
  <button class="btn bg-green text-white mt-3 d-block mx-auto" type="submit">Add</button>
</form>
