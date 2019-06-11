<?php
$date = empty($_GET['history']) || $_GET['history'] == 'none' ? date('Y-m-d') : date('Y-m-d', strtotime($_GET['history']));
require_once('models/planthistory_model.php');
?>
<h1 class="text-center text-green font-weight-bold mb-0"><?= $histories['plantname'] ?></h1>
<a class="mb-3 d-table mx-auto font-weight-bold font-italic text-green" href="index.php?p=plants&plant=<?= $histories['plant_id'] ?>">Show plant</a>

<form action="index.php" method="get">
  <select class="form-control mt-3" name="history">
    <option value="none">-- Choose the date --</option>
    <?php
    foreach ($alldates as $alldate) { ?>
      <option <?= $date == $alldate['day'] ? 'selected' : '' ?>><?= $alldate['day'] ?></option>
    <?php } ?>
  </select>
  <input type="hidden" name="plant" value="<?= $histories['plant_id'] ?>">
  <button class="btn bg-green text-white mt-3 d-block mx-auto" type="submit" name="p" value="plants">See</button>
</form>
<?php if($histories['is_flowering'] !== null) { ?>
  <p class="mb-0">
    <span class="font-weight-bold">Average temperature : </span><?= $histories['temp_av'] ?>°C
  </p>
  <p class="mb-0">
    <span class="font-weight-bold">Average humidity : </span><?= $histories['hum_av'] ?>%
  </p>
  <p>
    <span class="font-weight-bold">Average light : </span><?= $histories['light_av'] ?>h
  </p>
  <p class="mb-0">
    <span class="font-weight-bold">Is flowering : </span><?= $histories['is_flowering'] ? 'yes' : 'no' ?>
  </p>
  <p class="mb-0">
    <span class="font-weight-bold">Is fruiting : </span><?= $histories['is_fruiting'] ? 'yes' : 'no' ?>
  </p>
  <p class="mb-0">
    <span class="font-weight-bold">Has been harvested : </span><?= $histories['is_harvested'] ? 'yes' : 'no' ?>
  </p>
  <p class="mb-0">
    <span class="font-weight-bold">Has been trimmed : </span><?= $histories['is_trimmed'] ? 'yes' : 'no' ?>
  </p>
<?php } ?>
