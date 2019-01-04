<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$_SESSION['fornitore']= "false";
$_SESSION['utente']= "true";
$_SESSION['admin']="false";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cfu";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
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
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/footer.css" rel="stylesheet">
    <link href="./../css/search.css" rel="stylesheet">
    <link href="./../css/sidebar.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php $current= "home";
	include 'menu.php';?>

  <div id="mySidenav" class="sidenav">
    <div class ="margin">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <br/>
      <h3>Categories</h3>
      <form  action="ricerca.php" method="post" id="Categories">
        <div class="margin">

          <?php

          foreach($conn->query('SELECT * FROM categoria_ristoranti ORDER BY nome_categoria') as $row) {
            echo'
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="'.$row['nome_categoria'].'" name="check[]" id="'.$row['nome_categoria'].'">
                <label class="form-check-label" for="'.$row['nome_categoria'].'">
                  '.$row['nome_categoria'].'
                </label>
              </div>';
          }

          ?>
        </div>
        <br/>
        <input type="submit" class="btn btn-primary col-sm-6" name="action" value="Modifica"/>
      </form>
    </div>
    <div class="row margin">
    </div>

    </div>
  </div>

  <button class=" btn btn-primary" type="button" name="button"  onclick="openNav()">Applica filtri</button>

 <div class="container">
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
  if(isset($_POST['check'])){
    $aCat = $_POST['check'];
    $N = count($aCat);
    for($i=0;$i < $N ; $i++){
      $filter[$i] = 'nome_categoria = "'.$aCat[$i].'"';
    }
  }
  if(!empty($filter)){
    $query = 'SELECT * FROM ristorante WHERE '.implode(' OR ', $filter);
  }else{
    $query = 'SELECT * FROM ristorante';
  }
  $result=$conn->query($query);
  if($result->num_rows==0){
    echo '<div class="card card-sm center-msg-box ">
            <h1 class = "title">Nessun ristorante trovato </h1>
            <br/>
            <h3>Siamo spiacenti però la budo è una troia ;) </h3>
          </div>';
  }
  foreach($conn->query($query) as $row)
  {
  echo '
  <li class="list-group-item">'.$row["nome"].'
  '.$row["nome_categoria"].'
  '.$row["indirizzo"].'

  <form action="ristorante.php" method="post" name ="seleziona" id="seleziona">
    <input type = "hidden" name="id_ristorante" value="'.$row["id"].'">
    <button class="btn btn-sm btn-primary " id = "submit" type="submit" >Guarda Listino</button>
  </form>
  </li>"';

  }
  echo "</ul>";
  $conn->close();
    ?>

  </div>

  <?php include 'footer.php'; ?>
  <!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
