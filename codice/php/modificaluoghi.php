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


if(isset($_POST['modify'])){
  $stmt5 = $conn->prepare("UPDATE luogo SET nome = ? WHERE nome = ?");
 if($stmt5!=false){
   $stmt5->bind_param("ss", $_POST["nome"], $_POST["exn"]);
   $stmt5->execute();
   $stmt5->close();
 }
 unset($_SESSION["luomod"]);
 header("Location: luoghi.php");
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
    <link href="./../css/footer.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .a{float:right;}
    .cart-link{width: 100%;text-align: right;display: block;font-size: 22px;}
    .caption{color:black;background-color: rgba(255,255,255, 90%); padding: 20px;margin-top: 5px;}
    #torna {float: left; margin-left: 6%; margin-top: 1%;}
    .addprod{padding: 10px;}
    h1,h2,h3, #nop {color:white;}
    </style>
  </head>
  <body>
    <?php $current = "modificaluoghi";
    include 'menu.php';
    ?>
    <div class=" container card card-sm center-msg-box mobile">
    <form id ="modify" class ="card card-sm mobile addprod"  method="post" action = "#">
      <div class="row justify-content-center">
        <div class="form-group col-sm-4">
          <label for="nome">Nome menu</label>
          <input type="text" name="nome"  class="form-control" id="nome" placeholder="" value="<?php echo $_SESSION['luomod'] ?>">
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-2">
          <br/>
          <button type="submit" class="btn btn-success" name="btn" value = "true">Applica modifiche<i class="fa fa-pencil"></i></button>
        </div>
        <div class="col-md-2">
          <br/>
          <a href="luoghi.php" class="btn btn-danger">Annulla <i class="fa fa-close"></i></a>
        </div>
      </div>
      <input type="hidden" name= "exn" value="<?php echo $_SESSION['luomod']; ?>">
      <input type="hidden" name= "modify" value="true">
    </form>
  </div>

  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="./../js/messaggi.js"></script>
  </body>
</html>
