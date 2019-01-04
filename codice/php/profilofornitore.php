<?php
  if (session_status() === PHP_SESSION_NONE){
    session_start();
  }
  $_SESSION["fornitore"]= "true";
  $_SESSION['utente']= "false";
  $_SESSION['admin']="false";
  $current= "profilofornitore";

  $servernome = "localhost";
  $usernome = "root";
  $password = "";
  $dbnome = "cfu";

  $db = new mysqli($servernome, $usernome, $password, $dbnome);

  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  $query = $db->query("SELECT * FROM ristorante WHERE email_proprietario = '".$_SESSION["email"]."'");
  $row = $query->fetch_assoc();
  $nome_rist = $row["nome"];
  $info = $row["info"];
  $indirizzo = $row["indirizzo"];
  $categoria= $row["nome_categoria"];
  $rating = $row["rating"];
  $approvazione = $row["approvato"]
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
      <h1>Profilo <?php echo $_SESSION["nome"]; ?> </h1>
      <h3>La tua mail: <?php echo $_SESSION["email"]; ?> </h3>
      <h3>Nome ristorante: <?php echo $nome_rist; ?> </h3>
      <h3>Indirizzo:<?php echo $indirizzo; ?> </h3>
      <h3>Categoria: <?php echo $categoria; ?> </h3>
      <h3>Info: <?php echo $info; ?> </h3>
      <h3>Rating: <?php echo $rating; ?> </h3>
      <?php
        if($approvazione == 1){
          echo'<h3>Approvato! :) </h3>';
        }else{
          echo'<h3> Non ancora approvato :(</h3>';
        } ?>


      <a href="modificadati.php" class="btn btn-primary">Modifica dati</a>
      <a href="notifiche" class="btn btn-primary">Modifica dati</a>
    </div>

<?php include 'footer.php'; ?>
<!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
