<?php if (session_status() === PHP_SESSION_NONE){
} else {
  session_destroy();
}
header("Location: codice/php/homeclienti.php");
exit; ?>
