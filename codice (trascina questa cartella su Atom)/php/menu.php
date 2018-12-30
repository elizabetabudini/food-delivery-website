<?php
// Start the session
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<a class="navbar-brand" href="homeclienti.php">CFU - Cesena Food University</a>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto">

<?php

if ( isset( $_SESSION['fornitore'] ) ) {
  include 'menufornitori.php';
} else {
  if ( isset( $_SESSION['admin'] ) ) {
    include 'menuadmin.php';
  } else {
    include 'menuutenti.php';
  }
}

?>

</ul>
</div>
</nav>
