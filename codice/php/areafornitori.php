<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$_SESSION["fornitore"]= "true";
$_SESSION['utente']= "false";
$_SESSION['admin']="false";
$current= "areafornitori";
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  h1,h2, h3, h4{text-align: center; color:white;}
  h2{padding-bottom: 2%;}
  </style>

</head>
<body>
  <?php $current = "areafornitori";
  include 'menu.php';
  ?>
  <div class="card card-sm center-msg-box">
    <h1>CFU</h1>
    <h2>Cesena Food University</h2>
    <div class="row">

      <div class="col-sm-6 ">
        <div class="card dark">
          <div class="card-body ">
            <h5 class="card-title">Dai una svolta alla tua attività</h5>
            <p class="card-text-center">Perchè perdere l'occasione di spedire ogni giorno il tuo cibo a studenti affamati?</p>
            <a href="signinfornitore.php" class="btn btn-success">Registrati! <i class="fa fa-pencil"></i></a>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body ">
            <h5 class="card-title">Sei già un nostro partner?</h5>
            <p class="card-text-center">Modifica il listino aggiungendo nuovi cibi, controlla i tuoi ordini e tanto altro.</p>
            <a href="accedi.php" class="btn btn-success">Accedi! <i class="fa fa-user"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>
  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./../js/messaggi.js"></script>
</body>
</html>
