<?php

approva(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cfu";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "DELETE FROM `ristorante` WHERE `id` = ??? ";
  $result = mysqli_query($conn, $sql);
}


elimina(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cfu";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "UPDATE `ristorante` SET `approvato`= `1` WHERE `id` = ??? ";
  $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Accedi</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../../css/bootstrap.min.css">

    <link href="./../../css/form.css" rel="stylesheet">
    <link href="./../../css/full.css" rel="stylesheet">
    <link href="./../../css/admin.css" rel="stylesheet">
    <link href="./../../css/menubar.css" rel="stylesheet">
    <link href="./../../css/approvazione.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php include '../menu.php'; ?>

  <div class="card card-sm center-msg-box transparent ">
    <h3 class="title text-center">Ecco i ristoranti che non hanno ancora ricevuto l'approvazione</h3>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cfu";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    foreach($conn->query('SELECT nome , email_proprietario FROM ristorante WHERE approvato = 0') as $row) {
      echo '
        <div class="row card-sm">
          <div class="card card-sm center-msg-box transparent col-sm-8">
            <p>'. $row['nome'] .'</p>
            <p>'. $row['email_proprietario'] .'</p>
          </div>
          <div class="card card-sm center-msg-box transparent col-sm-4">
              <a href="#" class="btn btn-primary" onclick = "approva()">Approva!</a>
              <br/>
              <a href="#" class="btn btn-primary" onclick = "elimina()">Elimina!</a>
          </div>
        </div>';
    }?>
    <!-- parte in php dove va messo la query che restituisce tutti i ristoranti in attesa di conferma
    <div class="row">
      <div class="card card-sm center-msg-box transparent col-sm-8">
        <p>Lorem ipsum dolor sit amet, consectetur adipisic culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      <div class="card card-sm center-msg-box transparent col-sm-4">
          <a href="#" class="btn btn-primary">Approva!</a>
          <br/>
          <a href="#" class="btn btn-primary">Elimina!</a>
      </div>
    </div>
    <div class="row">
      <div class="card card-sm center-msg-box transparent col-sm-8">
        <p>Lorem ipsum dolor sit amet, consectetur adipisic culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      <div class="card card-sm center-msg-box transparent col-sm-4">
          <a href="#" class="btn btn-primary">Approva!</a>
          <br/>
          <a href="#" class="btn btn-primary">Elimina!</a>
      </div>
    </div>-->
  </div>







  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../../js/bootstrap.min.js"></script>
  </body>
</html>
