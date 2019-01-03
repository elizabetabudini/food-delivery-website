<?php
/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cfu";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


  foreach($conn->query('SELECT nome , id_ristorante, nome_menu FROM carrello WHERE id_prenotazione = '.$_SESSION['id'].'') as $row) {
  echo */
  ?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Accedi</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/form.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/footer.css" rel="stylesheet">
    <link href="./../css/carrello.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php $current= "carrello";
  $_SESSION['Redirect']= $_SERVER["REQUEST_URI"];
	include 'menu.php'; ?>
  <div class="center-msg-box card card-sm dark">
    <h1 class = "title">Carrello</h1>
    <br/>
    <br/>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cfu";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_SESSION['id_prenotazione'])){
        foreach($conn->query('SELECT nome , id_ristorante, nome_menu FROM carrello WHERE id_prenotazione = '.$_SESSION['id'].'') as $row) {
        //TODO
        echo'
          <div class="row card-sm">
            <div class="card card-sm center-msg-box transparent col-sm-9">
              <h3>'.$row["nome"].'</h3>
              <h4>quantita</h4>
            </div>
            <form action="#" method="post" id="form1" class = "card card-sm transparent col-sm-3">
              <input type="submit" class="btn btn-primary" name="action" value="Modifica"/>
              <br/>
              <input type="submit" class="btn btn-primary" name="action" value="Cancella"/>
              <input type="hidden" name = "id" value="'.$_SESSION["id_prenotazione"].'">
              <input type="hidden" name = "nome_menu" value="'.$row["nome_menu"].'">
              <input type="hidden" name = "id_ristorante" value="'.$row["id_ristorante"].'">
              <input type="hidden" name = "nome" value="'.$row["nome"].'">
              <input type="hidden" name="sent" value="true" />
            </form>
          </div>
          ';
        }
      }else{
        echo '<div class="card card-sm center-msg-box transparent col-sm-9 center">
          <h3 class="text-center">il tuo carrello è vuoto :(</h3>
        </div>';
      }
      ?>
  </div>

  <?php include 'footer.php'; ?>
  <!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
