<?php
$subcategories = $db->query("SELECT sc.*, c.name AS cname FROM subcategories AS sc JOIN categories AS c USING(category_id) ORDER BY sc.category_id, sc.name");
$subcategories = fetchAllSecure($subcategories);
?>
