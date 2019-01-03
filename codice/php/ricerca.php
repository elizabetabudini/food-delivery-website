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
    <link href="./../css/ricerca.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php $current= "ricerca";
	include 'menu.php';
  var_dump($_SESSION["id_prenotazione"]); ?>

  <div id="mySidenav" class="sidenav">
    <div class ="margin">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <br/>
      <h3>Categories</h3>
      <form  action="#" method="post" id="Categories">
        <div class="margin">

          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "cfu";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          foreach($conn->query('SELECT * FROM categoria_ristoranti ORDER BY nome_categoria') as $row) {
            echo'
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="'.$row['nome_categoria'].' name="check[]" id="'.$row['nome_categoria'].'">
                <label class="form-check-label" for="'.$row['nome_categoria'].'">
                  '.$row['nome_categoria'].'
                </label>
              </div>';
          }

          ?>
        </div>
        <br/>
      </form>
    </div>
    <div class="row margin">
      <input type="submit" class="btn btn-primary col-sm-6" name="action" value="Modifica" form="Categories"/>
      <input type="submit" class="btn btn-primary col-sm-6" name="action" value="Modifica" form="Categories"/>
    </div>

    </div>
  </div>

  <button type="button" name="button"  onclick="openNav()">Categories</button>

 <div class="main card card-sm center-msg-box main">
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cfu";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $filter = array();
/*  foreach($conn->query('SELECT * FROM categoria_ristoranti ORDER BY nome_categoria') as $row) {
    echo $row["nome_categoria"];*/
    echo 'true';
  if(isset($_POST['check[]'])){
    $N = count($aCat);
    for($i=0;$i < $N ; $i++){
      $filter[$i] = 'nome_categoria = '.$aCat[$i];
    }
  }
  echo implode(' ',$filter);
  $query = 'SELECT * FROM ristorante WHERE 1=1'.implode(' AND ', $filter);
  echo $query;
  foreach($conn->query($query) as $row) {
    echo'
    <div class="row">
      <div class="card card-sm center-msg-box col-sm-9">
        <h2>'.$row["nome"].'</h2>
        <h3>'.$row["nome_categoria"].'</h3>
        <h4>'.$row["indirizzo"].'</h4>
      </div>
      <form class=" col-sm-3 card card-sm center-msg-box" action="ristorante.php" method="post" name ="seleziona" id="seleziona">
        <input type = "hidden" name="id_ristorante" value="'.$row["id"].'">
        <button class="btn btn-sm btn-outline-info allign_center" id = "submit" type="submit" >Guarda Listino</button>
      </form>
    </div>
      ';
    }
    $conn->close();
    ?>

  </div>

  <?php include 'footer.php'; ?>
  <!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
