<?php
$subcategories = $db->prepare("SELECT sc.*, c.name AS cname, c.description AS cdesc
                                FROM subcategories AS sc
                                JOIN categories AS c USING(category_id)
                                ORDER BY sc.category_id, sc.name");
$subcategories->execute();
$subcategories = fetchAllSecure($subcategories);
?>
