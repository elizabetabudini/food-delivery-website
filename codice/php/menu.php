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

      echo '<div id="" class="msg badge badge-primary"></div>
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
/*
if(isset($_SESSION["unread"])){
  if($_SESSION["unread"]==true){
    echo '<div class="hover_bkgr_fricc">
    <span class="helper"></span>
    <div>
    <div class="popupCloseButton">X</div>
    <p>La tua casella contiene messaggi non letti</p>
    </div>
    </div>';


    echo '<style>
    .hover_bkgr_fricc{
      background:rgba(0,0,0,.4);
      cursor:pointer;
      height:100%;
      position:fixed;
      text-align:center;
      top:0;
      width:100%;
      z-index:10000;
    }
    .hover_bkgr_fricc .helper{
      display:inline-block;
      height:100%;
      vertical-align:middle;
    }
    .hover_bkgr_fricc > div {
      background-color: #fff;
      box-shadow: 10px 10px 60px #555;
      display: inline-block;
      height: auto;
      max-width: 551px;
      min-height: 100px;
      vertical-align: middle;
      width: 60%;
      position: relative;
      border-radius: 8px;
      padding: 15px 5%;
    }
    .popupCloseButton {
      background-color: #fff;
      border: 3px solid #999;
      border-radius: 50px;
      cursor: pointer;
      display: inline-block;
      font-family: arial;
      font-weight: bold;
      position: absolute;
      top: -20px;
      right: -20px;
      font-size: 25px;
      line-height: 30px;
      width: 30px;
      height: 30px;
      text-align: center;
    }
    .popupCloseButton:hover {
      background-color: #ccc;
    }
    </style>';

  }
}*/
?>
