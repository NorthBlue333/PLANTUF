<?php
$user = $db->prepare("SELECT * FROM users WHERE mail=:mail OR username=:username");
$user->bindParam(':mail', $mail, PDO::PARAM_STR);
$user->bindParam(':username', $username, PDO::PARAM_STR);
$user->execute();
$user = fetchSecure($user);
?>
