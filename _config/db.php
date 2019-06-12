<?php
$dsn = 'mysql:dbname=theconnectedflower;host=localhost;charset=utf8';
//$user = 'theconnectedflower';
//$password = 'th3c0nn3ct3dfl0w3r';
$user = 'root';
$password = 'root';

try {
    $db = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    $db = null;
}
?>
