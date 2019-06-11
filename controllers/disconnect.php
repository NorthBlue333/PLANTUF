<?php
session_name('sess_theconnectedflower');
session_start();
session_destroy();
header("Location: ../index.php");
?>
