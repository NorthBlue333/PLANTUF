<?php
$plantp = false;
$flowerp = false;
$fruitp = false;

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
?>
