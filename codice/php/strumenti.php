<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$_SESSION['fornitore']= "true";
$_SESSION['utente']= "false";
$_SESSION['admin']="false";
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Home Admin</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">

    <link href="./../css/form.css" rel="stylesheet">
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/footer.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php
  $current="strumenti";
   include 'menu.php';
   if(! isset($_SESSION["email"])){
     header("Location: accedi.php");
  }?>
  <div class="card card-sm center-msg-box transparent">

  <div class="row">
    <div class="col-md-4 ">
      <div class="card dark">
        <div class="card-body">
          <h5 class="card-title">Evadi Ordine</h5>
          <p class="card-text-center">Non fare attendere i tuoi clienti</p>
          <a href="evadiordini.php" class="btn btn-primary">Elenco ordini!</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card dark">
        <div class="card-body ">
          <h5 class="card-title">Modifica Listino</h5>
          <p class="card-text-center">Aumenta la scelta! :D</p>
          <a href="modificaprodotti.php" class="btn btn-primary">Modifica!</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 ">
      <div class="card dark">
        <div class="card-body">
          <h5 class="card-title">fdsfsd</h5>
          <p class="card-text-center">fsdfsd</p>
          <a href="#" class="btn btn-primary">fsdfsd</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
 include 'footer.php';
 ?>

 <!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
