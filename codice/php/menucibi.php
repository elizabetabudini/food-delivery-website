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
$stmt->close();
if(isset($_POST['add'])){
  $stmt5 = $conn->prepare("INSERT INTO menu (nome, id_ristorante) VALUES (?, ?)");
  if($stmt5!=false){
    $stmt5->bind_param("ss", $_POST["nome"], $id_rist);
    $stmt5->execute();
    $stmt5->close();
  }
  header("Location: menucibi.php");

}

if(isset($_POST['modify'])){
  if($_POST["btn"]== "true"){
     $stmt5 = $conn->prepare("UPDATE menu SET nome = ? WHERE nome = ? AND id_ristorante = ?");
    if($stmt5!=false){
      $stmt5->bind_param("sss", $_POST["nome"], $_POST["exn"] ,$id_rist );
      $stmt5->execute();
      $stmt5->close();
    }
  }else{
    $stmt5 = $conn->prepare("DELETE FROM menu WHERE nome = ?");
    if($stmt5!=false){
      $stmt5->bind_param("s", $_POST["nome"] );
      $stmt5->execute();
      $stmt5->close();
    }
  }
  header("Location: menucibi.php");
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
  <link href="./../css/navigation.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <?php include 'menu.php'; ?>
  <div class="card card-sm center-msg-box transparent mobile">
    <div class="container mobile">
      <h1><?php echo $_SESSION["nome"]?> ecco i tuoi menu</h1>

      <form id ="add" class ="card card-sm mobile "  method="post" action = "#">
        <h4 class="list-group-item-heading">Aggiungi un Menu!</h4>
        <div class="row justify-content-center">
          <div class="form-group col-sm-4">
            <label for="nome">Nome menu</label>
            <input type="text" name="nome"  class="form-control" id="nome" placeholder="" pattern=".{2,}" title="Inserisci almeno 2 caratteri">
          </div>
          <div class="col-md-2">
          </br>
          <input type="hidden" name= "add" value="true">
          <button type="submit" class="btn btn-success">Aggiungi</a>
          </div>
        </div>
      </form>
      <h3 class="list-group-item-heading">Modifica i Prodotti gia esistenti</h3>
      <?php
      //get rows query
      $stmt = $conn->prepare("SELECT * FROM menu WHERE id_ristorante = ?");
      $stmt->bind_param('s', $id_rist);
      $stmt->execute();

      $query = $stmt->get_result();
      if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
          echo $row["nome"];
          ?>
          <form id ="modify" class ="  card card-sm mobile "  method="post" action = "#">
            <div class="row justify-content-center">
              <div class="form-group col-sm-4">
                <label for="nome">Nome menu</label>
                <input type="text" name="nome"  class="form-control" id="nome" placeholder="" value="<?php echo $row['nome'] ?>">
              </div>
              <div class="col-md-2">
                <br/>
                <button type="submit" class="btn btn-success" name="btn" value = "true">Modifica</button>
              </div>
              <div class="col-md-2">
                <br/>
                <button type="submit" class="btn btn-success" name="btn" value = "false">Elimina</button>
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
  </div>
</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="./../js/messaggi.js"></script>
</body>
</html>
