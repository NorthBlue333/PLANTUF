<?php
$user = $db->prepare("SELECT * FROM users WHERE mail=:mail");
$user->bindParam(':mail', $mail, PDO::PARAM_STR);
$user->execute();
$user = fetchSecure($user);
?>
