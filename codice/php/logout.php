<?php
$current= "logout";
session_start();
session_destroy();
header("Location: homeclienti.php");
?>
