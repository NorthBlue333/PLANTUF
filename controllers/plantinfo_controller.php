<?php
$plantp = false;
$flowerp = false;
$fruitp = false;
$harvestp = false;
$trimp = false;

foreach ($plantings as $planting) {
  if(date('n') >= date('n', strtotime($planting['start'])) && date('n') <= date('n', strtotime($planting['end']))) {
    $plantp = true;
    break;
  }
}

foreach ($flowerings as $flowering) {
  if(date('n') >= date('n', strtotime($flowering['start'])) && date('n') <= date('n', strtotime($flowering['end']))) {
    $flowerp = true;
    break;
  }
}

foreach ($fruitings as $fruiting) {
  if(date('n') >= date('n', strtotime($fruiting['start'])) && date('n') <= date('n', strtotime($fruiting['end']))) {
    $fruitp = true;
    break;
  }
}

foreach ($trimmings as $trimming) {
  if(date('n') >= date('n', strtotime($trimming['start'])) && date('n') <= date('n', strtotime($trimming['end']))) {
    $trimp = true;
    break;
  }
}

foreach ($harvestings as $harvesting) {
  if(date('n') >= date('n', strtotime($harvesting['start'])) && date('n') <= date('n', strtotime($harvesting['end']))) {
    $harvestp = true;
    break;
  }
}
?>
