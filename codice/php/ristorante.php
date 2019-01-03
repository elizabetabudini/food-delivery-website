<?php if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$current="ristorante";
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
    <link href="./../css/approvazione.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">
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
    if(isset($_POST['id_ristorante'])){
      $ristorante  = $_POST['id_ristorante'];
      $select_query = mysqli_query($conn,"SELECT nome FROM ristorante WHERE id = '$ristorante' ") or die(mysqli_error($conn));
      $row = mysqli_fetch_array($select_query);
      $_SESSION["nome_ristorante"]=$row["nome"];
      $_SESSION["id_ristorante"]=$ristorante;


    }
    if(isset($_POST['aggiungi'])){
      $user  = $_POST['aggiungi'];
      $aggiungi_query = mysqli_query($conn,"INSERT INTO carrello VALUES email = '$user' ") or die(mysqli_error($conn));

    }

    $stmt = $conn->prepare("SELECT nome, nome_categoria FROM menu WHERE id_ristorante = ?");
    $stmt->bind_param('s', $_SESSION["id_ristorante"]);
    $stmt->execute();

    $result = $stmt->get_result();

    echo "<table class='table table-light table-hover'>
    <tr>
    <th>Cibo</th>
    <th>Categoria</th>
    <th>Aggiungi</th>
    </tr>";
    if($result->num_rows==0){
      echo '<div id="nouser"> Non ci sono cibi nel ristorante '.$_SESSION["nome_ristorante"].'</div>';
    }
    while($row = mysqli_fetch_array($result))
    {
    echo ' <tr>
    <td> '. $row['nome'] .' </td>
    <td> '. $row['nome_categoria'] .' </td>
    <td>
    <form action="#" method="POST">
    <input type="submit" class= "btn btn-primary name="aggiungi" value="Aggiungi al carrello" />
    <input type="hidden" name = "delete" value="'.$row["nome"].'">
    </td>
    </form></tr>"';
    }
    echo "</table>";
?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity=
	"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
