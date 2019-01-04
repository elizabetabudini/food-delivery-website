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
<?php
if ($_SESSION['fornitore']== "true") {
  echo '<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span><span id="notifica" class="badge badge-primary"></span>
  <span class="sr-only">unread messages</span>
  </button>
  <a class="navbar-brand" href="homefornitori.php">CFU - Cesena Food University</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">';

  include 'menufornitori.php';
} else {
  if ($_SESSION['admin']== "true") {
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span><span id="notifica" class="badge badge-primary"></span>
    <span class="sr-only">unread messages</span>
    </button>
    <a class="navbar-brand" href="homeadmin.php">CFU - Cesena Food University</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">';

    include 'menuadmin.php';
  } else {
    if ($_SESSION['utente']== "true"){
      echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span><span id="notifica" class="badge badge-primary"></span>
      <span class="sr-only">unread messages</span>
      </button>
      <a class="navbar-brand" href="homeclienti.php">CFU - Cesena Food University</a>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">';
        include 'menuutenti.php';
    }

  }

}

?>

</ul>
</div>
</nav>


<?php

echo '
<script>
  $(function() {
    setInterval(function() {
      $.ajax({
        type: "GET",
        url: "apimessaggi.php?action=nuovimessaggi",
        success: function(html) {
           // html is a string of all output of the server script.
           if($_SESSION["nuovimessaggi"]==true){
              $("#overlay").fadeIn(300);
           } else {
             $("#overlay").fadeOut(300);
           }

         }

      });
    }, 1000);
  });
</script>

</script>
      <script src="./../js/notifica.js" type="text/javascript"></script>
      </script>

      <div id="overlay">
        <div id="popup">
            <div id="close">X</div>
            <h2>Hai un nuovo messaggio</h2>
            <p>Controlla la tua casella dei messaggi!</p>
        </div>
      </div>';
      ?>
