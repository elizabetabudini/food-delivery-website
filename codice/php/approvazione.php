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
    $stmt = $conn->prepare("UPDATE ristorante SET approvato = '1' WHERE email_proprietario = ? ");
    $stmt->bind_param("s", $_POST['email']);
    $stmt->execute();
    $stmt->close();

    $mess= "Buone notizie! Il tuo ristorante è stato approvato dal nostro Team, ora puoi aggiungere il tuo listino. Benvenuto!";
    $data= date('Y-m-d-H-m');
    $letto="0";
    $stmt2 = $conn->prepare("INSERT INTO messaggio (testo, email, data, letto) VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("ssss", $mess, $_POST['email'], $data, $letto);
    $stmt2->execute();
    $stmt2->close();
  }

  if($_POST['action'] == "Elimina" ){
    $stmt2 = $conn->prepare("DELETE FROM ristorante WHERE email_proprietario = ? ");
    $stmt2->bind_param("s", $_POST['email']);
    $stmt2->execute();
    $stmt2->close();
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
    <link href="./../css/approvazione.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php include 'menu.php'; ?>

  <div class="card card-sm center-msg-box transparent ">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cfu";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    echo '<h3 class="title text-center">Ecco i ristoranti che non hanno ancora ricevuto l approvazione</h3>';
    foreach($conn->query('SELECT nome , email_proprietario, id FROM ristorante WHERE approvato = 0') as $row) {
      echo '
        <div class="row card-sm">
          <div class="card card-sm center-msg-box transparent col-sm-8">
            <p>'. $row['nome'] .'</p>
            <p>'. $row['email_proprietario'] .'</p>
          </div>
          <form action="#" method="post" id="form1" class = "card card-sm transparent col-sm-4">
            <input type="submit" class="btn btn-primary" name="action" value="Approva"/>
            <input type="hidden" name = "email" value="'.$row["email_proprietario"].'">
            <br/>
            <input type="submit" class="btn btn-primary" name="action" value="Elimina"/>
            <input type="hidden" name = "email" value="'.$row["email_proprietario"].'">
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
