<?php
session_name('sess_theconnectedflower');
session_start();

require_once("../_config/db.php");
require_once("../_config/functions.php");

$user_id = $_SESSION['user']['user_id'];

if(isset($_POST['answersubmit'])) {
  if(isset($_POST['answertitle']) && !empty($_POST['answertitle']) && isset($_POST['answertext']) && !empty($_POST['answertext'])) {
    $add_comment = $db->prepare("INSERT INTO comments(post_date, title, comment, answer_id, subcategory_id, user_id) VALUES (:post_date, :title, :comment, :answer_id, :subcategory_id, :user_id)");
    $add_comment->bindValue(':post_date', date('Y-m-d H:i:s'), PDO::PARAM_STR);
    $add_comment->bindParam(':title', $_POST['answertitle'], PDO::PARAM_STR);
    $add_comment->bindParam(':comment', $_POST['answertext'], PDO::PARAM_STR);
    $add_comment->bindValue(':answer_id', explode('-', $_POST['answersubmit'])[0], PDO::PARAM_INT);
    $add_comment->bindValue(':subcategory_id', explode('-', $_POST['answersubmit'])[1], PDO::PARAM_INT);
    $add_comment->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $add_comment->execute();
  }
}
if(isset($_POST['commentsubmit'])) {
  if(isset($_POST['commenttitle']) && !empty($_POST['commenttitle']) && isset($_POST['commenttext']) && !empty($_POST['commenttext'])) {
    $add_comment = $db->prepare("INSERT INTO comments(post_date, title, comment, answer_id, subcategory_id, user_id) VALUES (:post_date, :title, :comment, :answer_id, :subcategory_id, :user_id)");
    $add_comment->bindValue(':post_date', date('Y-m-d H:i:s'), PDO::PARAM_STR);
    $add_comment->bindParam(':title', $_POST['commenttitle'], PDO::PARAM_STR);
    $add_comment->bindParam(':comment', $_POST['commenttext'], PDO::PARAM_STR);
    $add_comment->bindValue(':answer_id', null, PDO::PARAM_INT);
    $add_comment->bindValue(':subcategory_id', $_POST['commentplant'], PDO::PARAM_INT);
    $add_comment->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $add_comment->execute();
  }
}
if(isset($_POST['commentdelete'])) {
  $add_comment = $db->prepare("DELETE FROM comments WHERE comment_id = :c_id AND user_id = :u_id");
  $add_comment->bindParam(':c_id', $_POST['commentdelete'], PDO::PARAM_INT);
  $add_comment->bindParam(':u_id', $user_id, PDO::PARAM_INT);
  $add_comment->execute();
}
header('Location: ../index.php?p=community');
?>
