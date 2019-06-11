<?php
$plant = $db->prepare("SELECT sc.*, c.category_id, c.description, c.name AS category_name
                      FROM subcategories AS sc
                      JOIN categories AS c USING(category_id)
                      WHERE sc.subcategory_id = :id");
$plant->bindParam(':id', $_GET['plant'], PDO::PARAM_INT);
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
