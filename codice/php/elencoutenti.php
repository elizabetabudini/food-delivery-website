<?php if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$current="elencoutenti";
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>CFU - Home</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./../css/bootstrap.min.css">
  <link href="./../css/full.css" rel="stylesheet">
  <link href="./../css/menubar.css" rel="stylesheet">
  <link href="./../css/approvazione.css" rel="stylesheet">
  <link href="./../css/navigation.css" rel="stylesheet">
  <link href="./../css/footer.css" rel="stylesheet">
  <link href="./../css/tableutenti.css" rel="stylesheet">


  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>

  </style>
</head>
<body>
  <?php include 'menu.php'; ?>
<div class="container transparent">
  <br/>
  <a href="homeadmin.php" class="btn btn-success"><i class="fa fa-arrow-left"></i> indietro</a>
  <!--<div class="card card-sm center-msg-box transparent ">
  <h3 class="title text-center">Elenco utenti</h3> -->
  <div class="card card-sm center-msg-box mobile" style="background-color: rgba(0,0,0,0); box-shadow: rgba(0,0,0,0); border: 0px;">
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cfu";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if(isset($_POST['delete'])){
    $user  = $_POST['delete'];
    $delet_query = mysqli_query($conn,"DELETE FROM persona WHERE email = '$user' ") or die(mysqli_error($conn));

  }

  $result = mysqli_query($conn,"SELECT nome, cognome, email FROM persona WHERE privilegi ='0'");

  echo "<table class='table table-light table-hover'>
  <tr>
  <th>Nome</th>
  <th>Cognome</th>
  <th>Email</th>
  <th>Elimina utente</th>
  </tr>";
  if($result->num_rows==0){
    echo '<div id="nouser"> Non ci sono utenti </div>';
  }
  while($row = mysqli_fetch_array($result))
  {
    if($row['email'] != "not_logged_in"){
    echo ' <tr>
    <td> '. $row['nome'] .' </td>
    <td> '. $row['cognome'] .' </td>
    <td> '. $row['email'] .' </td>
    <td>
    <form action="#" method="POST">
    <input type="submit" class= "btn btn-primary name="delete" value="Elimina" />
    <input type="hidden" name = "delete" value="'.$row["email"].'">
    </td>
    </form></tr>';
  }}
  echo "</table>";
  ?>

</div>
</div>
  <?php include 'footer.php'; ?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./../js/messaggi.js"></script>
</body>
