<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$_SESSION['fornitore']= "false";
$_SESSION['utente']= "true";
$_SESSION['admin']="false";
?>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";

}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Ricerca</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/form.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/footer.css" rel="stylesheet">
    <link href="./../css/admin.css" rel="stylesheet">
    <link href="./../css/sidebar.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php $current= "ricerca";
	include 'menu.php';
  var_dump($_SESSION["id_prenotazione"]); ?>

  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <br/>
    <a href="#">About</a>
    <br/>
    <a href="#">Services</a>
    <br/>
    <a href="#">Contact</a>
    <br/>
    <a href="#">Clients</a>
  </div>

 <div class="main card card-sm center-msg-box main">
 <button type="button" name="button"  onclick="openNav()">Categories</button>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cfu";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  foreach($conn->query('SELECT * FROM ristorante ORDER BY nome_categoria') as $row) {
    echo'
    <div class="row">
      <div class="card card-sm center-msg-box col-sm-8">
        <h3>'.$row["nome"].'</h3>
        <h4>'.$row["nome_categoria"].'</h4>
        <h6>'.$row["indirizzo"].'</h6>
      </div>
      <div class="card card-sm center-msg-box col-sm-4">
        <h5> '.$row["rating"].'/10 utenti raccomandano </h5>
        QUASI QUASI IL RATING LO TOGLIEREI
      </div>
    </div>
      ';
    }
    ?>

  </div>

  <?php include 'footer.php'; ?>
  <!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
