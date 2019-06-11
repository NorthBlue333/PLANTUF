<?php
session_name('sess_theconnectedflower');
session_start();

require_once('../_config/db.php');
require_once('../_config/functions.php');

if(isset($_POST['flowering']) && isset($_POST['plantid'])) {
  $insert = $db->prepare("UPDATE plants SET is_flowering = :bool WHERE plant_id = :id AND user_id = :u_id");
  $insert->bindParam(':bool', $_POST['flowering'], PDO::PARAM_INT);
  $insert->bindParam(':id', $_POST['plantid'], PDO::PARAM_INT);
  $insert->bindParam(':u_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
  $insert->execute();
}
if(isset($_POST['fruiting']) && isset($_POST['plantid'])) {
  $insert = $db->prepare("UPDATE plants SET is_fruiting = :bool WHERE plant_id = :id AND user_id = :u_id");
  $insert->bindParam(':bool', $_POST['fruiting'], PDO::PARAM_INT);
  $insert->bindParam(':id', $_POST['plantid'], PDO::PARAM_INT);
  $insert->bindParam(':u_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
  $insert->execute();
}
if(isset($_POST['delete']) && isset($_POST['plantid'])) {
  $insert = $db->prepare("DELETE FROM plants WHERE plant_id = :id AND user_id = :u_id");
  $insert->bindParam(':id', $_POST['plantid'], PDO::PARAM_INT);
  $insert->bindParam(':u_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
  $insert->execute();
}
?>
