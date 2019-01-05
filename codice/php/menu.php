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
if(isset($_SESSION["email"])){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cfu";
  $current= "profilofornitore";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $result = mysqli_query($conn,"SELECT * FROM messaggio WHERE email = '".$_SESSION["email"]."' AND letto='0'");
  if($result->num_rows>0){
    $notifiche = $result->num_rows;
    $_SESSION["unread"]=$result->num_rows;
  } else {
    $_SESSION["unread"]=0;
  }

}
if ($_SESSION['fornitore']== "true") {
  echo '<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>';
    echo '<span id="msg" class="badge badge-primary"></span>
    <span class="sr-only">unread messages</span>';


echo '
  </button>
  <a class="navbar-brand" href="homefornitori.php">CFU - Cesena Food University</a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">';

  include 'menufornitori.php';
} else {
  if ($_SESSION['admin']== "true") {
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>';

      echo '<span id="msg" class="badge badge-primary"></span>
      <span class="sr-only">unread messages</span>';


    echo '
    </button>
    <a class="navbar-brand" href="homeadmin.php">CFU - Cesena Food University</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">';

    include 'menuadmin.php';
  } else {
    if ($_SESSION['utente']== "true"){
      echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>';

        echo '<div id="" class="badge badge-primary"></div>
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
