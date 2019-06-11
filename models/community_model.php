<?php
$categories = $db->prepare("SELECT * FROM categories");
$categories->execute();
$categories = fetchAllSecure($categories);

$subcategories = $db->prepare("SELECT * FROM subcategories");
$subcategories->execute();
$subcategories = fetchAllSecure($subcategories);
?>
