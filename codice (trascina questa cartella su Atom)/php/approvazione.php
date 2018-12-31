<?php
$current= "homeadmin";
if(isset($_POST["sent"])){

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cfu";
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if($_POST['action'] == "Approva"){
    $stmt = $conn->prepare("UPDATE `ristorante` SET `approvato`= `1` WHERE `id` = ? ");
    $stmt->bind_param("s", $_POST['id']);
    $stmt->execute();
  }

  if($_POST['action'] == "Elimina" ){
    $stmt = $conn->prepare("DELETE FROM `ristorante` r,`persona` p WHERE `r.email_proprietario` = `p.email` WHERE `r.id` = ? ");
    $stmt->bind_param("s", $id);
    $stmt->execute();
  }
}
?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Accedi</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">

    <link href="./../css/form.css" rel="stylesheet">
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/adminapprova.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php include 'menu.php'; ?>

  <div class="card card-sm center-msg-box transparent ">
    <h3 class="title text-center">Ecco i ristoranti che non hanno ancora ricevuto l'approvazione</h3>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cfu";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }


    foreach($conn->query('SELECT nome , email_proprietario, id FROM ristorante WHERE approvato = 0') as $row) {
      echo '
        <div class="row card-sm">
          <div class="card card-sm center-msg-box transparent col-sm-8">
            <p>'. $row['nome'] .'</p>
            <p>'. $row['email_proprietario'] .'</p>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
