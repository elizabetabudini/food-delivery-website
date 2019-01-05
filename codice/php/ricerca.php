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
    <link href="./../css/sidebar.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      h1,h3{text-align: center; color:white;}
      .list-group-item{background-color: rgba(255,255,255, 65%)  }
      .a{float:right;margin-right: 2%}
      .filtri{margin-left: 7%; margin-top: 3%; }
      .card{background: rgba(0,0,0,0.7);border-radius: 10px;
      -webkit-border-radius: 10px;-moz-border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);-moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
      -webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);}
      .table{background-color: rgba(255,255,255,65%);}
    </style>

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
        <input type="submit" class="a btn btn-success" name="action" value="Modifica"/>
      </form>
    </div>
    <div class="row margin">
    </div>

    </div>
  </div>

  <button class=" filtri btn btn-success" type="button" name="button"  onclick="openNav()">Applica filtri</button>

 <div class="container">
  <?php

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
          </div>';
  }
  echo '
  <div class="card card-sm center-msg-box transparent">
  <div class="container">';
  foreach($conn->query($query) as $row)
  {
  echo '
  <li class="list-group-item">
  <h2>'.$row["nome"].'</h2>
  <h5>'.$row["nome_categoria"].' </h5>
  <h5>'.$row["indirizzo"].' </h5>

  <form action="ristorante.php" method="post" name ="seleziona" id="seleziona">
    <input type = "hidden" name="id_ristorante" value="'.$row["id"].'">
    <button class="a btn btn-sm btn-success " id = "submit" type="submit" >Guarda Listino </button>
  </form>
  </li>"';

  }
  echo "</ul>";
  $conn->close();
    ?>
  </div>
  </div>
  </div>

  <?php include 'footer.php'; ?>
  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
