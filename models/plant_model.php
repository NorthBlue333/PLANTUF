<?php
$plant = $db->prepare("SELECT p.*, c.category_id, c.description, c.name AS category_name, sc.size_id, IFNULL(TRUNCATE((SUM(IF(h.light-500>0, 1, 0))/COUNT(h.light))/192, 2), 0) AS light
                      FROM plants AS p
                      JOIN subcategories AS sc USING(subcategory_id)
                      JOIN categories AS c USING(category_id)
                      LEFT JOIN histories AS h ON h.plant_id = p.plant_id AND DATEDIFF(CURRENT_DATE(), h.datetime) = 0
                      WHERE p.plant_id = :id AND p.user_id = :user_id");
$plant->bindParam(':id', $_GET['plant'], PDO::PARAM_INT);
$plant->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
$plant->execute();
$plant = fetchSecure($plant);

if($plant) {
  $subcategory = $db->prepare("SELECT * FROM subcategories WHERE subcategory_id = :id");
  $subcategory->bindParam(':id', $plant['subcategory_id'], PDO::PARAM_INT);
  $subcategory->execute();
  $subcategory = fetchSecure($subcategory);

  $plantings = $db->prepare("SELECT * FROM periods WHERE subcategory_id = :id AND type_id = 3");
  $plantings->bindParam(':id', $plant['subcategory_id'], PDO::PARAM_INT);
  $plantings->execute();
  $plantings = fetchAllSecure($plantings);

  $flowerings = $db->prepare("SELECT * FROM periods WHERE subcategory_id = :id AND type_id = 1");
  $flowerings->bindParam(':id', $plant['subcategory_id'], PDO::PARAM_INT);
  $flowerings->execute();
  $flowerings = fetchAllSecure($flowerings);

  $fruitings = $db->prepare("SELECT * FROM periods WHERE subcategory_id = :id AND type_id = 2");
  $fruitings->bindParam(':id', $plant['subcategory_id'], PDO::PARAM_INT);
  $fruitings->execute();
  $fruitings = fetchAllSecure($fruitings);

  $trimmings = $db->prepare("SELECT * FROM periods WHERE subcategory_id = :id AND type_id = 4");
  $trimmings->bindParam(':id', $plant['subcategory_id'], PDO::PARAM_INT);
  $trimmings->execute();
  $trimmings = fetchAllSecure($trimmings);

  $harvestings = $db->prepare("SELECT * FROM periods WHERE subcategory_id = :id AND type_id = 5");
  $harvestings->bindParam(':id', $plant['subcategory_id'], PDO::PARAM_INT);
  $harvestings->execute();
  $harvestings = fetchAllSecure($harvestings);
}
?>
