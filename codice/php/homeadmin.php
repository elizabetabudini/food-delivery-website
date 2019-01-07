<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$_SESSION['fornitore']= "false";
$_SESSION['utente']= "false";
$_SESSION['admin']="true";
$current= "homeadmin";
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>CFU - Home Admin</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="./../css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="./../css/form.css" rel="stylesheet">
  <link href="./../css/full.css" rel="stylesheet">
  <link href="./../css/menubar.css" rel="stylesheet">
  <link href="./../css/footer.css" rel="stylesheet">
  <link href="./../css/navigation.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
  <?php
  include 'menu.php';
  if(! isset($_SESSION["email"])){
    header("Location: accedi.php");
  }?>
  <div class="card card-sm center-msg-box transparent">

    <div class="row">
      <div class="col-md-4 ">
        <div class="card dark">
          <div class="card-body">
            <h5 class="card-title">Elimina utente</h5>
            <p class="card-text-center">Sicuro? nessuno vuole essere eliminato D:</p>
            <a href="elencoutenti.php" class="btn btn-primary">Vai all'elenco utenti!</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card dark">
          <div class="card-body ">
            <h5 class="card-title">Convalida ristoranti</h5>
            <p class="card-text-center">Aumenta la scelta! :D</p>
            <a href="approvazione.php" class="btn btn-primary">Approva!</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 ">
        <div class="card dark">
          <div class="card-body ">
            <h5 class="card-title">Gestisci le categorie</h5>
            <p class="card-text-center">Mi raccomando non eliminare le pizze.</p>
            <a href="categorie.php" class="btn btn-primary">Alle categorie!</a>
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
