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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./../css/bootstrap.min.css">
  <link href="./../css/full.css" rel="stylesheet">
  <link href="./../css/menubar.css" rel="stylesheet">
  <link href="./../css/footer.css" rel="stylesheet">
  <link href="./../css/navigation.css" rel="stylesheet">
  <link href="./../css/footer.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  h1,h3, h4{text-align: center; color:white;}
  .center-msg-box{background: rgba(0,0,0,0.7);}
  </style>
</head>
<body>
  <?php $current = "strumenti";
  include 'menu.php';
  ?>
<div class="container transparent">
  <br/>
  <a href="strumenti.php" class="btn btn-success"><i class="fa fa-arrow-left"></i> Indietro</a>

<div class="card card-sm center-msg-box transparent mobile ">
  <div class="row justify-content-center">
    <div class="col-sm-5 ">
      <div class="card lis">
        <div class="card-body">
          <h5 class="card-title">Gestisci i prodotti</h5>
          <p class="card-text-center">Aggiungi, visualizza i prodotti nel listino, modifica prezzi e informazioni</p>
          <a href="prodotti.php" class="btn btn-success">Alimenti <i class="fa fa-spoon"></i></a>
        </div>
      </div>
    </div>
    <div class="col-sm-5">
      <div class="card lis">
        <div class="card-body ">
          <h5 class="card-title">Gestisci i menu</h5>
          <p class="card-text-center">Inserisci nuovi menu e gestisci quelli esistenti</p>
          <a href="menucibi.php" class="btn btn-success">Menu <i class="fa fa-list"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
</div >
<?php include 'footer.php'; ?>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./../js/messaggi.js"></script>
</body>
</html>
