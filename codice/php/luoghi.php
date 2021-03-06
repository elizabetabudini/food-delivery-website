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


if(isset($_POST['add'])){
  $stmt5 = $conn->prepare("INSERT INTO luogo (nome) VALUES (?)");
  if($stmt5!=false){
    $stmt5->bind_param("s", $_POST["nome"]);
    $stmt5->execute();
    $stmt5->close();
  }
  header("Location: luoghi.php");
}

if(isset($_POST['modify'])){
  if($_POST["btn"]== "true"){
    $_SESSION["luomod"] = $_POST["exn"];
    header("Location: modificaluoghi.php");
  }else{
    $stmt5 = $conn->prepare("DELETE FROM luogo WHERE nome = ?");
    if($stmt5!=false){
      $stmt5->bind_param("s", $_POST["exn"] );
      $stmt5->execute();
      $stmt5->close();
    }
    header("Location: luoghi.php");
  }
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
  <?php include 'menu.php'; ?>
  <br/>
  <div class="container transparent">
    <a href="homeadmin.php" class="btn btn-success">< indietro</a>

  <div class="card card-sm center-msg-box transparent mobile">
    <div class="container mobile">
      <h1>Ecco i luoghi di consegna</h1>
      <h3 class="list-group-item-heading">Aggiungi un Luogo!</h3>

      <form id ="add" class =" addprod card card-sm mobile "  method="post" action = "#">
        <div class="row addprod  justify-content-center">
          <div class="form-group col-sm-4">
            <label for="nome">Nome</label>
            <input type="text" name="nome"  class="form-control" id="nome" placeholder="" required pattern=".{2,}" title="Inserisci almeno 2 caratteri">
          </div>
          <div class="col-md-2 justify-content-center">
          </br>
          <input type="hidden" name= "add" value="true">
          <button type="submit" class="btn btn-success">Aggiungi <i class="fa fa-plus"></i></a>
          </div>
        </div>
      </form>
      <h3 class="list-group-item-heading">Gestisci i luoghi gia esistenti</h3>
      <?php
      //get rows query
      $stmt = $conn->prepare("SELECT * FROM luogo ");
      $stmt->execute();

      $query = $stmt->get_result();
      if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
          echo $row["nome"];
          ?>
          <form id ="modify" class =" addprod card card-sm mobile "  method="post" action = "#">
            <div class="row justify-content-center">
              <div class="form-group col-sm-4">
                <label for="nome">Nome</label>
                <label name="nome"  class="form-control" id="nome"><?php echo $row['nome'] ?></label>
              </div>
              <div class="col-md-2">
                <br/>
                <button type="submit" class="btn btn-success" name="btn" value = "true">Modifica <i class="fa fa-pencil"></i></button>
              </div>
              <div class="col-md-2">
                <br/>
                <button type="submit" class="btn btn-danger" name="btn" value = "false">Elimina <i class="fa fa-trash"></i></button>
              </div>
            </div>
          <input type="hidden" name= "exn" value="<?php echo $row['nome']; ?>">
          <input type="hidden" name= "modify" value="true">
          </form>
        <?php
      }
    }
    $stmt->close();

    ?>
  </div></div>
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
</html>
