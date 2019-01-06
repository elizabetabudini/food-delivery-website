<?php
$current= "logout";
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
session_destroy();
$_SESSION["admin"]= "false";
$_SESSION["utente"]= "true";
$_SESSION["fornitore"]= "false";
header("Location: homeclienti.php");
?>
