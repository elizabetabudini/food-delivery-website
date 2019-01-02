<?php
// Start the session
if (session_status() === PHP_SESSION_NONE){
  session_start();
  if(!isset($_SESSION["admin"])){
    $_SESSION["admin"]= "false";
    $_SESSION["utente"]= "true";
    $_SESSION["fornitore"]= "false";
  }
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span><span id="notifica" class="badge badge-primary"></span>
<span class="sr-only">unread messages</span>
</button>
<a class="navbar-brand" href="homeclienti.php">CFU - Cesena Food University</a>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto">

<?php
if ($_SESSION['fornitore']=== "true") {
  include 'menufornitori.php';
} else {
  if ($_SESSION['admin']=== "true") {
    include 'menuadmin.php';
  } else {
    if ($_SESSION['utente']=== "true"){
        include 'menuutenti.php';
    }

  }
}

?>

</ul>
</div>
</nav>
