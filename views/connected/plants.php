<?php
if(isset($_GET['plant']) && !empty($_GET['plant'])) {
  if(!isset($_GET['history'])) {
    require_once('models/plant_model.php');
    if($plant && $plant['user_id'] == $_SESSION['user']['user_id']) {
      require_once('controllers/plant_controller.php');
    ?>
      <h1 class="text-center text-green font-weight-bold mb-0"><?= $plant['name'] ?></h1>
      <a class="mb-3 d-table mx-auto font-weight-bold font-italic text-green" href="index.php?p=plants&plant=<?= $plant['plant_id'] ?>&history">Show history</a>
      <p class="d-flex planting-date text-center justify-content-center align-items-center"><?= file_get_contents("_assets/images/svg/planted.svg") ?><span class="d-block ml-2"><?= date('M jS, Y', strtotime($plant['planting_date'])) ?><span></p>
      <article>
        <h2 class="text-green mb-4 ml-2 cursor-pointer desc"><i class="parrow parrow-down"></i> <?= $subcategory['name'] ?></h2>
        <div class="sizes collapse">
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
        <p class="collapse">
          <?= $subcategory['description'] ?>
        </p>
      </article>
      <article>
        <h2 class="<?= $plant['temperature'] > $subcategory['min_temperature'] && $plant['temperature'] < $subcategory['max_temperature'] ? 'text-orange' : 'text-danger' ?> mb-1">Temperature</h2>
        <div class="progress mt-5">
          <div class="bar-limit">
              <div class="label-right text-gray">-50°C</div>
          </div>
          <div class="bar-step" style="left: <?= $subcategory['min_temperature']+50 ?>%;">
              <div class="label-right text-orange"><?= $subcategory['min_temperature'] ?>°C</div>
              <div class="label-line bg-orange"></div>
          </div>
          <div class="bar-step" style="left: <?= $subcategory['max_temperature']+50 ?>%">
              <div class="label-left text-orange"><?= $subcategory['max_temperature'] ?>°C</div>
              <div class="label-line bg-orange"></div>
          </div>
          <div class="bar-limit" style="left: 100%">
              <div class="label-left text-gray">50°C</div>
          </div>
          <div class="rounded progress-bar progress-bar-striped progress-bar-animated <?= $plant['temperature'] > $subcategory['min_temperature'] && $plant['temperature'] < $subcategory['max_temperature'] ? 'bg-orange' : 'bg-danger' ?>" style="width: <?= $plant['temperature']+50 ?>%;" aria-valuemin="0" aria-valuemax="50" aria-valuenow="<?= $plant['temperature'] ?>" data-toggle="tooltip" data-placement="top" title="<?= $plant['temperature'] ?>°C"></div>
        </div>
      </article>
      <article class="mt-5">
        <h2 class="<?= $plant['humidity'] > $subcategory['min_humidity'] && $plant['humidity'] < $subcategory['max_humidity'] ? 'text-info' : 'text-danger' ?> mb-1">Humidity</h2>
        <div class="progress mt-5">
          <div class="bar-limit">
              <div class="label-right text-gray">0%</div>
          </div>
          <div class="bar-step" style="left: <?= $subcategory['min_humidity'] ?>%">
              <div class="label-right text-info"><?= $subcategory['min_humidity'] ?>%</div>
              <div class="label-line bg-info"></div>
          </div>
          <div class="bar-step" style="left: <?= $subcategory['max_humidity'] ?>%">
              <div class="label-left text-info"><?= $subcategory['max_humidity'] ?>%</div>
              <div class="label-line bg-info"></div>
          </div>
          <div class="bar-limit" style="left: 100%">
              <div class="label-left text-gray">100%</div>
          </div>
          <div class="rounded progress-bar progress-bar-striped progress-bar-animated <?= $plant['humidity'] > $subcategory['min_humidity'] && $plant['humidity'] < $subcategory['max_humidity'] ? 'bg-info' : 'bg-danger' ?>" style="width: <?= $plant['humidity'] ?>%;" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?= $plant['humidity'] ?>" data-toggle="tooltip" data-placement="top" title="<?= $plant['humidity'] ?>%"></div>
        </div>
      </article>
      <article class="mt-5">
        <h2 class="<?= $plant['light'] > $subcategory['min_light'] && $plant['light'] < $subcategory['max_light'] ? 'text-warning' : 'text-danger' ?> mb-1">Light</h2>
        <div class="progress mt-5">
          <div class="bar-limit">
              <div class="label-right text-gray">0h</div>
          </div>
          <div class="bar-step" style="left: <?= $subcategory['min_light']*100/12 ?>%;">
              <div class="label-right text-warning"><?= $subcategory['min_light'] ?>h</div>
              <div class="label-line bg-warning"></div>
          </div>
          <div class="bar-step" style="left: <?= $subcategory['max_light']*100/12 ?>%">
              <div class="label-left text-warning"><?= $subcategory['max_light'] ?>h</div>
              <div class="label-line bg-warning"></div>
          </div>
          <div class="bar-limit" style="left: 100%">
              <div class="label-left text-gray">12h</div>
          </div>
          <div class="rounded progress-bar progress-bar-striped progress-bar-animated <?= $plant['light'] > $subcategory['min_light'] && $plant['light'] < $subcategory['max_light'] ? 'bg-warning' : 'bg-danger' ?>" style="width: <?= $plant['light']*100/12 ?>%;" aria-valuemin="0" aria-valuemax="12" aria-valuenow="<?= $plant['light'] ?>" data-toggle="tooltip" data-placement="top" title="<?= $plant['light'] ?>h"></div>
        </div>
      </article>
      <article class="mt-5 periods">
        <h2 class="text-center text-green mb-0">Periods</h2>
        <p class="text-center">Click on the flower or the fruit : make the border green if your plant is actually in these periods, else make it gray.</p>
        <div class="d-flex justify-content-around flex-wrap">
          <button class="btn w-30 h-30w border rounded-circle border-5 d-block p-30px<?= $plantp ? '' : ' grayscale' ?> opacity-1 cursor-default" disabled><?= file_get_contents("_assets/images/svg/planting.svg") ?></button>
          <?php if(count($flowerings) > 0){ ?>
            <button class="btn w-30 h-30w ml-1 border rounded-circle border-5<?= $plant['is_flowering'] == 1 ? ' border-green' : '' ?> d-block p-30px<?= $flowerp ? '' : ' grayscale' ?>" name="flowering" value="<?= $plant['plant_id'].'-'.!$plant['is_flowering'] ?>" type="submit"><?= file_get_contents("_assets/images/svg/flowering.svg") ?></button>
          <?php }
          if(count($fruitings) > 0){ ?>
            <button class="btn w-30 h-30w ml-sm-1 border rounded-circle border-5<?= $plant['is_fruiting'] == 1 ? ' border-green' : '' ?> d-block p-30px<?= $fruitp ? '' : ' grayscale' ?>" name="fruiting" value="<?= $plant['plant_id'].'-'.!$plant['is_fruiting'] ?>" type="submit"><?= file_get_contents("_assets/images/svg/fruiting.svg") ?></button>
          <?php }
          if(count($harvestings) > 0){ ?>
            <button class="btn w-30 h-30w ml-sm-1 border rounded-circle border-5<?= $plant['is_harvested'] == 1 ? ' border-green' : '' ?> d-block p-30px<?= $harvestp ? '' : ' grayscale' ?>" name="harvested" value="<?= $plant['plant_id'].'-'.!$plant['is_harvested'] ?>" type="submit"><?= file_get_contents("_assets/images/svg/harvesting.svg") ?></button>
          <?php }
          if(count($trimmings) > 0){ ?>
            <button class="btn w-30 h-30w ml-sm-1 border rounded-circle border-5<?= $plant['is_trimmed'] == 1 ? ' border-green' : '' ?> d-block p-30px<?= $trimp ? '' : ' grayscale' ?>" name="trimmed" value="<?= $plant['plant_id'].'-'.!$plant['is_trimmed'] ?>" type="submit"><?= file_get_contents("_assets/images/svg/trimming.svg") ?></button>
          <?php } ?>
        </div>
      </article>
      <article class="mt-3">
        <button class="btn btn-danger d-block mx-auto" name="plantdelete" value="<?= $plant['plant_id'] ?>" type="submit">Delete this plant</button>
      </article>
    <?php } else { ?>
      <div class="alert alert-danger text-center mt-2 w-50 mx-auto" role="alert">
        Plant not found. Please try again.
        <a class="font-weight-bold d-block" href="?p=plants">Back to my plants</a>
      </div>
    <?php }
  } else if(isset($_GET['history'])) {
    require_once('planthistory.php');
  }
} else {
  require_once('models/plants_model.php'); ?>
  <h1 class="text-center text-green font-weight-bold mb-3">My plants</h1>
  <button class="btn bg-green d-block mx-auto"><a href="?p=addplant" class="mt-3 text-white">Add a new plant</a></button>
  <section class="d-flex flex-wrap justify-content-around align-content-around mt-4">
    <?php foreach ($plants as $p) { ?>
      <a class="mt-2" href="?p=plants&plant=<?= $p['plant_id'] ?>" title="Voir <?= $p['name'] ?>">
        <div class="d-flex flex-column justify-content-between rounded border border-green w-45 h-45w mw-250px mh-250px p-3">
          <?= file_get_contents("_assets/images/svg/".$p['image'].".svg") ?>
          <h2 class="font-weight-bold text-green text-center mb-0 mt-2"><?= $p['name'] ?></h2>
        </div>
      </a>
    <?php } ?>
  </section>
<?php } ?>
