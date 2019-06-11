<?php
session_name('sess_theconnectedflower');
session_start();

require_once('../_config/db.php');
require_once('../_config/functions.php');

$vote = checkSetEmpty($_POST['vote']);
$comment_id = checkSetEmpty($_POST['comment']);
$user_id = $_SESSION['user']['user_id'];
if($comment_id && in_array($vote, [0, 1])) {
  $already_voted = $db->prepare("SELECT vote_id, type FROM votes WHERE comment_id = :commentid AND user_id = :userid");
  $already_voted->bindParam(':commentid', $comment_id, PDO::PARAM_INT);
  $already_voted->bindParam(':userid', $user_id, PDO::PARAM_INT);
  $already_voted->execute();
  $already_voted = fetchSecure($already_voted);
  if($already_voted) {
    $voting = $db->prepare("DELETE FROM votes WHERE vote_id = :id");
    $voting->bindParam(':id', $already_voted['vote_id'], PDO::PARAM_INT);
    $voting->execute();
    if($already_voted['type'] != $vote) {
      $voting = $db->prepare("INSERT INTO votes(type, comment_id, user_id) VALUES (:type, :comment_id, :user_id)");
      $voting->bindParam(':type', $vote, PDO::PARAM_INT);
      $voting->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
      $voting->bindParam(':user_id', $user_id, PDO::PARAM_INT);
      $voting->execute();
    }
  } else {
    $voting = $db->prepare("INSERT INTO votes(type, comment_id, user_id) VALUES (:type, :comment_id, :user_id)");
    $voting->bindParam(':type', $vote, PDO::PARAM_INT);
    $voting->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $voting->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $voting->execute();
  }
}
?>
