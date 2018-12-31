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
    <title>CFU - Profilo Fornitore</title>
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
    <?php $current = "profilofornitore";
    include 'menu.php';
        ?>
    <div class="card card-sm center-msg-box">
      <h1>Profilo <?php echo $_SESSION["nome"]; ?></h1>
      <h3>La tua mail: <?php echo $_SESSION["email"]; ?></h3>
      <h3>Nome ristorante: </h3>
      <h3>Indirizzo: </h3>
      <h3>Categoria: </h3>
      <h3>Info: </h3>
      <h3>Rating: </h3>
      <h3>Approvato: </h3>

      <a href="#" class="btn btn-primary">Modifica dati</a>

    </div>

<?php include 'footer.php'; ?>
<!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
