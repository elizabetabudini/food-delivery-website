<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$_SESSION['fornitore']= "true";
$_SESSION['utente']= "false";
$_SESSION['admin']="false";
$current="strumenti";
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>CFU - Home Admin</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="./../css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <link href="./../css/full.css" rel="stylesheet">
  <link href="./../css/menubar.css" rel="stylesheet">
  <link href="./../css/footer.css" rel="stylesheet">
  <link href="./../css/navigation.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  h1,h3, h4{text-align: center; color:white;}
  .center-msg-box{width: 900px;background: rgba(0,0,0,0.7);}
  </style>

</head>
<body>
  <?php
  include 'menu.php';
  if(! isset($_SESSION["email"])){
    header("Location: accedi.php");
  }?>
  <div class="card card-sm center-msg-box transparent mobile">
    <div class="row justify-content-center">
      <div class="col-sm-4 ">
        <div class="card lis">
          <div class="card-body">
            <h5 class="card-title">Evadi Ordine</h5>
            <p class="card-text-center">Non fare attendere i tuoi clienti</p>
            <a href="evadiordini.php" class="btn btn-success">Ordini <i class="fa fa-check"></i></a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card lis">
          <div class="card-body ">
            <h5 class="card-title">Modifica Listino</h5>
            <p class="card-text-center">Aumenta la scelta! Inserisci prodotti e nuovi menu</p>
            <a href="modificaprodotti.php" class="btn btn-success">Listino <i class="fa fa-list"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  include 'footer.php';
  ?>

  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./../js/messaggi.js"></script>
</body>
</html>
