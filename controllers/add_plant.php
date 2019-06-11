<?php
session_name('sess_theconnectedflower');
session_start();

require_once("../_config/db.php");
require_once("../_config/functions.php");

$plant_name = checkSetEmpty($_POST['plantname']);
$plant_type = checkSetEmpty($_POST['planttype']);
$plant_temp = checkSetEmpty($_POST['planttemp']);
$plant_hum = checkSetEmpty($_POST['planthum']);
$plant_light = checkSetEmpty($_POST['plantlight']);
$plant_date = checkSetEmpty($_POST['plantdate']);
$user_id = $_SESSION['user']['user_id'];

if($plant_name && $plant_date && $plant_type && $plant_type != "none") {
  $add_plant = $db->prepare("INSERT INTO plants(name, subcategory_id, planting_date, temperature, humidity, light, user_id) VALUES (:name, :subcategory_id, :planting_date, :temperature, :humidity, :light, :user_id)");
  $add_plant->bindParam(':name', $plant_name, PDO::PARAM_STR);
  $add_plant->bindParam(':subcategory_id', $plant_type, PDO::PARAM_INT);
  $add_plant->bindValue(':planting_date', date('Y-m-d', strtotime($plant_date)), PDO::PARAM_STR);
  $add_plant->bindValue(':temperature', $plant_temp ? $plant_temp : 0, PDO::PARAM_INT);
  $add_plant->bindValue(':humidity', $plant_hum ? $plant_hum : 0, PDO::PARAM_INT);
  $add_plant->bindValue(':light', $plant_light ? $plant_light : 0, PDO::PARAM_INT);
  $add_plant->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $add_plant->execute();
  header('Location: ../index.php?p=plants');
} else {
  header('Location: ../index.php?p=addplant');
}
?>
