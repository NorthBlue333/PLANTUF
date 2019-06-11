<?php
session_name('sess_theconnectedflower');
session_start();

require_once("../_config/db.php");
require_once("../_config/functions.php");

if(isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST['password'])) {
  $mail = $_POST['mail'];
  $pass = $_POST['password'];
  require_once('../models/user_model.php');
  if($user) {
    if($user['password'] == hash('sha256', $pass)) {
      $_SESSION['user'] = $user;
    }
  }
}
header('Location: ../index.php');
exit();
?>
