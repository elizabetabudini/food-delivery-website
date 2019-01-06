<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cfu";

$conn = new mysqli($servername, $username, $password, $dbname);
$current= "strumenti";

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT id FROM ristorante WHERE email_proprietario = ?");
$stmt->bind_param("s", $_SESSION["email"]);
$stmt->execute();
$result = $stmt->get_result();
$id_rist = $result->fetch_object();
$id_rist = $id_rist->id;


if(isset($_POST['modify'])){
  $stmt5 = $conn->prepare("UPDATE menu SET nome = ? WHERE nome = ? AND id_ristorante = ?");
 if($stmt5!=false){
   $stmt5->bind_param("sss", $_POST["nome"], $_POST["exn"] ,$id_rist );
   $stmt5->execute();
   $stmt5->close();
 }
 unset($_SESSION["menumod"]);
 header("Location: menucibi.php");
}

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
    <link href="./../css/navigation.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <?php $current = "modificaprodotti";
    include 'menu.php';
    ?>
    <div class=" container center-msg-box" style="background-color: rgba(0,0,0,0);  box-shadow: 0px 0px">
    <form id ="modify" class ="card card-sm mobile "  method="post" action = "#">
      <div class="row justify-content-center">
        <div class="form-group col-sm-4">
          <label for="nome">Nome menu</label>
          <input type="text" name="nome"  class="form-control" id="nome" placeholder="" value="<?php echo $_SESSION['menumod'] ?>">
        </div>
        <div class="col-md-2">
          <br/>
          <button type="submit" class="btn btn-success" name="btn" value = "true">Modifica</button>
        </div>
        <div class="col-md-2">
          <br/>
          <button type="submit" class="btn btn-success" name="btn" value = "false">Elimina</button>
        </div>
        <div class="col-md-2">
          <br/>
          <a href="menucibi.php" class="btn btn-success">Annulla</a>
        </div>
      </div>
      <input type="hidden" name= "exn" value="<?php echo $_SESSION['menumod']; ?>">
      <input type="hidden" name= "modify" value="true">
    </form>

  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="./../js/messaggi.js"></script>
  </body>
</html>
