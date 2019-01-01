
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Accedi</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/form.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/footer.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php $current= "ricerca";
	include 'menu.php'; ?>
  <div class="center-msg-box card card-sm dark">
    <h3>Carrello</h3>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cfu";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }


    foreach($conn->query('SELECT nome , id_ristorante, nome_menu FROM carrello WHERE id_prenotazione = '.$_SESSION['id'].'') as $row) {
      echo '
        <div class="row card-sm">
          <div class="card card-sm center-msg-box transparent col-sm-8">
            <p>'. $row['nome'] .'</p>
          </div>
          <form action="#" method="post" id="form1" class = "card card-sm transparent col-sm-4">
            <input type="submit" class="btn btn-primary" name="action" value="Approva"/>
            <br/>
            <input type="submit" class="btn btn-primary" name="action" value="Elimina"/>
            <input type="hidden" name = "id" value="'.$row["id"].'">
            <input type="hidden" name="sent" value="true" />
          </form>
        </div>';
      }
    ?>
  </div>

  <?php include 'footer.php'; ?>
  <!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
