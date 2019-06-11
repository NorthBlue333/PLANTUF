<?php
$alldates = $db->prepare("SELECT DATE_FORMAT(datetime, '%Y-%m-%d') AS day
                      FROM plants AS p
                      JOIN histories AS h USING(plant_id)
                      WHERE p.plant_id = :id AND p.user_id = :user_id
                      GROUP BY day");
$alldates->bindParam(':id', $_GET['plant'], PDO::PARAM_INT);
$alldates->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
$alldates->execute();
$alldates = fetchAllSecure($alldates);
$histories = $db->prepare("SELECT p.name AS plantname, h.*, p.plant_id,
                      IFNULL(SUM(h.temperature)/COUNT(h.temperature), 0) AS temp_av,
                      IFNULL(SUM(h.humidity)/COUNT(h.humidity), 0) AS hum_av,
                      IFNULL(TRUNCATE((SUM(IF(h.light-500>0, 1, 0))/COUNT(h.light))/192, 2), 0) AS light_av
                      FROM plants AS p
                      LEFT JOIN histories AS h USING(plant_id)
                      WHERE p.plant_id = :id AND p.user_id = :user_id AND DATE_FORMAT(datetime, '%Y-%m-%d') = :date");
$histories->bindParam(':id', $_GET['plant'], PDO::PARAM_INT);
$histories->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
$histories->bindParam(':date', $date, PDO::PARAM_STR);
$histories->execute();
$histories = fetchSecure($histories);
?>
