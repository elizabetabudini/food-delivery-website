<?php if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$current="elencoutenti";
if(isset($_POST["sent"])){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cfu";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    if($_POST['action'] == "Elimina" ){
      var_dump($_POST['email']);
      $stmt2 = $conn->prepare("DELETE FROM persona WHERE email = ? ");
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
    <title>CFU - Home</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/adminapprova.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php include 'menu.php'; ?>

  <!--<div class="card card-sm center-msg-box transparent ">
    <h3 class="title text-center">Elenco utenti</h3> -->
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cfu";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $result = mysqli_query($conn,"SELECT nome, cognome, email FROM persona WHERE privilegi ='0'");

    echo "<table class='table table-light table-hover'>
    <tr>
    <th>Nome</th>
    <th>Cognome</th>
    <th>Email</th>
    <th>Elimina utente</th>
    </tr>";

    while($row = mysqli_fetch_array($result))
    {
    echo "<tr>";
    echo "<td>" . $row['nome'] . "</td>";
    echo "<td>" . $row['cognome'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo '<td><form action="#" method="post" id="form1">
    <input type="submit" class="btn btn-primary" name="action" value="Elimina"/>
    <input type="hidden" name = "email" value="'.$row['email'].'">
    <input type="hidden" name="sent" value="true" </td>';
    echo "</tr>";
    }
    echo "</table>";
?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity=
	"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="./../js/list.js"></script>

  </body>
