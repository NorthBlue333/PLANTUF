<?php
$plants = $db->prepare("SELECT p.plant_id, p.name, c.category_id, c.description, c.image, c.name AS category_name FROM plants AS p JOIN subcategories USING(subcategory_id) JOIN categories AS c USING(category_id) WHERE user_id = :u_id");
$plants->bindParam(':u_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
$plants->execute();
$plants = fetchAllSecure($plants);
?>
