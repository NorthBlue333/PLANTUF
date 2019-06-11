<?php
session_name('sess_theconnectedflower');
session_start();

require_once("../_config/db.php");
require_once("../_config/functions.php");

if(isset($_POST['mail']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordcheck'])) {
  if(!empty($_POST['mail']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['passwordcheck'])) {
    if($_POST['password'] == $_POST['passwordcheck']) {
      $pass = $_POST['password'];
    } else {
      header('Location: ../index.php?p=signup&e=passmismatch');
      exit();
    }
    $mail = $_POST['mail'];
    $username = $_POST['username'];
    require_once('../models/user_exists_model.php');
    if($user) {
      header('Location: ../index.php?p=signup&e=alreadyexists');
      exit();
    } else {
      $insert = $db->prepare("INSERT INTO users(username, mail, password) VALUES (:username, :mail, :password)");
      $insert->bindParam(':username', $username, PDO::PARAM_STR);
      $insert->bindParam(':mail', $mail, PDO::PARAM_STR);
      $insert->bindValue(':password', hash('sha256', $pass), PDO::PARAM_STR);
      $insert->execute();
      require_once('../models/user_model.php');
      if($user) {
        $_SESSION['user'] = $user;
      }
      header('Location: ../index.php');
      exit();
    }
  } else {
    header('Location: ../index.php?p=signup&e=emptyinput');
    exit();
  }
} else {
  header('Location: ../index.php?p=signup&e=emptyinput');
  exit();
}
header('Location: ../index.php');
exit();
?>
