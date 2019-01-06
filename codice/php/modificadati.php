<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cfu";
$current= "profilofornitore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["sent"])){
  $stmt = $conn->prepare("UPDATE ristorante SET nome = ?, indirizzo = ?, info = ?, nome_categoria = ?  WHERE email_proprietario = ?");
  if($stmt!=false){
    $stmt->bind_param("sssss", $_POST["nomerist"], $_POST["indirizzorist"], $_POST["info"], $_POST["Categoria"], $_SESSION["email"]);
    $stmt->execute();
    $stmt->close();
  }
  else {
    $errors .= "Bad Programmatore Exception: la query non è andata a buon fine: 65 signinfornitore.php </br>";
  }
  header("Location: profilofornitore.php");
}

$query = $conn->query("SELECT * FROM ristorante WHERE email_proprietario = '".$_SESSION["email"]."'");
$row = $query->fetch_assoc();
$nome_rist = $row["nome"];
$info = $row["info"];
$indirizzo = $row["indirizzo"];
$categoria= $row["nome_categoria"];



?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>CFU - Registrati</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="./../css/bootstrap.min.css">
  <link href="./../css/form.css" rel="stylesheet">
  <link href="./../css/full.css" rel="stylesheet">
  <link href="./../css/menubar.css" rel="stylesheet">
  <link href="./../css/footer.css" rel="stylesheet">
  <link href="./../css/navigation.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
  <?php $current= "profilofornitore";
  include 'menu.php';?>
  <div class="container">
    <form id="fornitoreform" class="mobile" method="post" action="#">
      <div class="form-group">
        <label for="inputRist">Nome Ristorante</label>
        <input type="text" name="nomerist"  class="form-control" id="inputRist" placeholder="Inserisci nome ristorante" value="<?php echo $nome_rist; ?>" title="Inserisci almeno 2 caratteri">
      </div>
      <div class="form-group">
        <label for="inputIndirizzo">Indirizzo Ristorante</label>
        <input type="text" name="indirizzorist" value="<?php echo $indirizzo; ?>" class="form-control" id="inputIndirizzo" placeholder="Inserisci indirizzo ristorante" >
        <small id="Help" class="form-text text-muted">Ad es. "Viale Bovio, 11, Cesena, FC"</small>
      </div>
      <div class="form-group">
        <label for="inputIndirizzo">Categoria ristorante</label>
        <select  class="form-control form-control-md form-control-borderless" id="Categoria" name="Categoria">
          <?php
          $conn = new mysqli($servername, $username, $password, $dbname);
          $sql = mysqli_query($conn, "SELECT nome_categoria FROM categoria_ristoranti");
          while ($row = $sql->fetch_assoc()){
            if($row['nome_categoria'] == $categoria){
              echo "<option selected value='". $row['nome_categoria'] ."'>" . $row['nome_categoria'] . "</option>";
            }else{
              echo "<option value='". $row['nome_categoria'] ."'>" . $row['nome_categoria'] . "</option>";
            }
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="info">Info</label>
        <textarea type="text" name="info" class="form-control" id="info"><?php echo $info; ?></textarea>
      </div>

      <input type="hidden" name="sent" value="true" />
      <a href = "profilofornitore.php"><button type="button"  class="btn btn-success">Annulla</button></a>
      <button type="submit" class="btn btn-success" style="float: right">Modifica</button>
    </form>
  </div>
</div>

</div>
<?php include 'footer.php'; ?>
<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="./../js/messaggi.js"></script>
</body>
</html>
