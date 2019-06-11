<?php if(!isset($_GET['plant'])) {
  require_once('models/plantsinfo_model.php'); ?>
  <form action="index.php" method="get">
    <h1 class="text-center text-green font-weight-bold mb-3">Choose the plant</h1>
    <select class="form-control mt-3" name="plant">
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
    <button class="btn bg-green text-white mt-3 d-block mx-auto" type="submit" name="p" value="plantsinfo">Search</button>
  </form>
<?php } else {
  require_once('models/plantinfo_model.php');
  require_once('controllers/plantinfo_controller.php'); ?>
  <h1 class="text-center text-green font-weight-bold mb-0"><?= $subcategory['name'] ?></h1>
  <a class="mb-3 d-table mx-auto font-weight-bold font-italic text-green" href="index.php?p=community&subcategory=<?= $subcategory['subcategory_id'] ?>">Read comments</a>
  <article>
    <h2 class="text-green mb-4 ml-2">Description</h2>
    <p>
      <div class="sizes">
        <figure <?= $plant['size_id'] == 4 || $plant['size_id'] == 5 ? 'class="active"' : '' ?>>
          <?= file_get_contents("_assets/images/svg/size.svg") ?>
        </figure>
        <figure <?= $plant['size_id'] == 2 || $plant['size_id'] == 3 || $plant['size_id'] == 4 ? 'class="active"' : '' ?>>
          <?= file_get_contents("_assets/images/svg/size.svg") ?>
        </figure>
        <figure <?= $plant['size_id'] == 1 || $plant['size_id'] == 2 ? 'class="active"' : '' ?>>
          <?= file_get_contents("_assets/images/svg/size.svg") ?>
        </figure>
      </div>
      <?= $subcategory['description'] ?>
    </p>
  </article>
  <article>
    <h2 class="text-orange">Temperature</h2>
    <p class="mb-0">
      <span class="font-weight-bold">Minimum : </span><?= $subcategory['min_temperature'] ?>°C
    </p>
    <p>
      <span class="font-weight-bold">Maximum : </span><?= $subcategory['max_temperature'] ?>°C
    </p>
  </article>
  <article class="mt-5">
    <h2 class="text-info">Humidity</h2>
    <p class="mb-0">
      <span class="font-weight-bold">Minimum : </span><?= $subcategory['min_humidity'] ?>%
    </p>
    <p>
      <span class="font-weight-bold">Maximum : </span><?= $subcategory['max_humidity'] ?>%
    </p>
  </article>
  <article class="mt-5">
    <h2 class="text-warning">Light</h2>
    <p class="mb-0">
      <span class="font-weight-bold">Minimum : </span><?= $subcategory['min_light'] ?>h
    </p>
    <p>
      <span class="font-weight-bold">Maximum : </span><?= $subcategory['max_light'] ?>h
    </p>
  </article>
  <article class="mt-5 periods">
    <h2 class="text-center text-green mb-0">Periods</h2>
    <div class="d-flex justify-content-around flex-wrap">
      <button class="btn w-30 h-30w border rounded-circle border-0 d-block p-30px<?= $plantp ? '' : ' grayscale' ?> opacity-1 cursor-default" disabled><?= file_get_contents("_assets/images/svg/planting.svg") ?></button>
      <?php if(count($flowerings) > 0){ ?>
        <button class="btn w-30 h-30w ml-1 border rounded-circle border-0 d-block p-30px<?= $flowerp ? '' : ' grayscale' ?> opacity-1" name="flowering" disabled><?= file_get_contents("_assets/images/svg/flowering.svg") ?></button>
      <?php }
      if(count($fruitings) > 0){ ?>
        <button class="btn w-30 h-30w ml-sm-1 border rounded-circle border-0 d-block p-30px<?= $fruitp ? '' : ' grayscale' ?> opacity-1" name="fruiting" disabled><?= file_get_contents("_assets/images/svg/fruiting.svg") ?></button>
      <?php }
      if(count($harvestings) > 0){ ?>
        <button class="btn w-30 h-30w ml-sm-1 border rounded-circle border-0 d-block p-30px<?= $harvestp ? '' : ' grayscale' ?> opacity-1" name="harvested" disabled><?= file_get_contents("_assets/images/svg/harvesting.svg") ?></button>
      <?php }
      if(count($trimmings) > 0){ ?>
        <button class="btn w-30 h-30w ml-sm-1 border rounded-circle border-0 d-block p-30px<?= $trimp ? '' : ' grayscale' ?> opacity-1" name="trimmed" disabled><?= file_get_contents("_assets/images/svg/trimming.svg") ?></button>
      <?php } ?>
    </div>
  </article>
<?php } ?>
