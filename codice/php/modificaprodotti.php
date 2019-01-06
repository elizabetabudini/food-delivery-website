<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$_SESSION["fornitore"]= "true";
$_SESSION['utente']= "false";
$_SESSION['admin']="false";
$current= "areafornitori";
$_SESSION['Redirect']= $_SERVER["REQUEST_URI"];
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>CFU - Home Fornitori</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="./../css/bootstrap.min.css">
  <link href="./../css/full.css" rel="stylesheet">
  <link href="./../css/menubar.css" rel="stylesheet">
  <link href="./../css/footer.css" rel="stylesheet">
  <link href="./../css/navigation.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  h1,h3, h4{text-align: center; color:white;}
  .con{width: 900px;background: rgba(0,0,0,0.7);border-radius: 10px;
    -webkit-border-radius: 10px;-moz-border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);-moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
    -webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
  }
  </style>
</head>
<body>
  <?php $current = "modificaprodotti";
  include 'menu.php';
  ?>

<div class="card card-sm center-msg-box transparent mobile">
  <div class="row justify-content-center">
    <div class="col-sm-4 ">
      <div class="card lis">
        <div class="card-body">
          <h5 class="card-title">Gestisci Listino</h5>
          <p class="card-text-center">Inserisci nuovi prodotti e modifica quelli esistenti</p>
          <a href="prodotti.php" class="btn btn-primary">Modifica prodotti</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card lis">
        <div class="card-body ">
          <h5 class="card-title">Gestisci categorie di menu</h5>
          <p class="card-text-center">Modifica i tipi di menù che offre il tuo ristorante</p>
          <a href="menucibi.php" class="btn btn-primary">Modifica listino</a>
        </div>
      </div>
    </div>
  </div>
</div>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./../js/messaggi.js"></script>
</body>
</html>
