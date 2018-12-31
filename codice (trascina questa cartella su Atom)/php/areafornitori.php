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
    <title>CFU - Home</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/areafornitori.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/footer.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
    <?php $current = "areafornitori";
    include 'menu.php';
        ?>
    <div class="card card-sm center-msg-box">
      <h1>CFU</h1>
      <h2>Cesena Food University</h2>
      <h3>Your food at their university</h3>
      <div class="row">

      <div class="col-sm-6 ">
        <div class="card dark">
          <div class="card-body ">
            <h5 class="card-title">Dai una svolta alla tua attività</h5>
            <p class="card-text-center">Perchè perdere l'occasione di spedire ogni giorno il tuo cibo a studenti affamati?</p>
            <a href="signinfornitore.php" class="btn btn-primary">Registrati!</a>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body ">
            <h5 class="card-title">Sei già un nostro partner?</h5>
            <p class="card-text-center">Modifica il listino aggiungendo nuovi cibi, controlla i tuoi ordini e tanto altro.</p>
            <a href="accedi.php" class="btn btn-primary">Accedi!</a>
          </div>
        </div>
      </div>
    </div>
    </div>

<?php include 'footer.php'; ?>
<!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
