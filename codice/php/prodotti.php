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
$disponibile = 1;

if(isset($_POST['add'])){
  if($_POST["Categoria"] != "notf"){
    $stmt5 = $conn->prepare("INSERT INTO alimento (disponibilita, nome, info, prezzo, id_ristorante, nome_menu) VALUES (?, ?, ?, ?, ?, ?)");
    if($stmt5!=false){
      $stmt5->bind_param("ssssss", $disponibile, $_POST["nomeprod"],  $_POST["info"],  $_POST["prezzo"], $id_rist, $_POST["Categoria"]);
      $stmt5->execute();
      $stmt5->close();
    }
  }else{
    $stmt5 = $conn->prepare("INSERT INTO alimento (disponibilita, nome, info, prezzo, id_ristorante) VALUES (?, ?, ?, ?, ?)");
    if($stmt5!=false){
      $stmt5->bind_param("sssss", $disponibile, $_POST["nomeprod"],  $_POST["info"],  $_POST["prezzo"], $id_rist );
      $stmt5->execute();
      $stmt5->close();
    }
  }
  header("Location: prodotti.php");
}



if(isset($_POST['modify'])){
  if($_POST["btn"]== "true"){
    $_SESSION["alimmod"] = $_POST["prod"];
    header("Location: modificaalimenti.php");
  }else{
    $stmt5 = $conn->prepare("DELETE FROM alimento WHERE id = ?");
    if($stmt5!=false){
      $stmt5->bind_param("s", $_POST["prod"] );
      $stmt5->execute();
      $stmt5->close();
    }
    header("Location: prodotti.php");

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
  h1,h2,h3,h4,h5{color:white;}
  </style>
</head>
<body>
  <?php include 'menu.php'; ?>
  <div class="container transparent">
    <br/>
  <a href="modificaprodotti.php" class=" btn btn-success"> < Indietro</a>
  <div class="card card-sm center-msg-box transparent mobile">
    <div class="container mobile">
      <h1>Listino di <?php echo $_SESSION["nome"]?></h1>

      <h3 class="list-group-item-heading">Aggiungi un prodotto al listino!</h3>
      <form id ="add" class ="addprod card card-sm mobile"  method="post" action = "#">
        <div class="row">
          <div class="form-group col-sm-3">
            <label for="nomeprod">Nome Prodotto</label>
            <input type="text" name="nomeprod"  class="form-control" id="nomeprod" placeholder="" required pattern=".{[0-9]2,}" title="Inserisci almeno 2 caratteri">
          </div>
          <div class="form-group col-sm-3">
            <label for="Categoria">Menu</label>
            <select  class="form-control form-control-md form-control-borderless" id="Categoria" name="Categoria">
              <?php
              $sql = mysqli_query($conn, 'SELECT nome FROM menu WHERE id_ristorante = "'.$id_rist.'"');
              if(mysqli_num_rows($sql) != 0){
                echo "<option selected value='notf'>None selected</option>";
                while ($row = $sql->fetch_assoc()){
                  echo "<option value='".$row['nome']."'>".$row['nome']."</option>";
                }
              }else{
                echo "<option value='notf'>Nessun Menu </option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-2">
            <label for="prezzo">prezzo</label>
            <input type="number" name="prezzo"  class="form-control" placeholder="0.00" id="prezzo" required min="0.01" value="0" step=".01" pattern="^\d*(\.\d{0,2})?$"  title="Inserisci prezzo">
          </div>
          <div class="form-group col-md-4">
            <label for="info">Info</label>
            <textarea type="text" name="info" class="form-control" id="info"></textarea>
          </div>
          <div class="col-md-12 ">
            <div class="row justify-content-center">
            </br>
            <div class="col-sm-2S">
              <input type="hidden" name= "add" value="true">
              <button type="submit" class="btn btn-success">Aggiungi</a>
              </div>
            </div>

          </div>
        </div>
      </form>
      <h3 class="list-group-item-heading">I prodotti nel tuo listino</h3>
      <?php
      //get rows query
      $stmt = $conn->prepare("SELECT nome, nome_menu, prezzo, info, id FROM alimento WHERE id_ristorante = ?");
      $stmt->bind_param('s', $id_rist);
      $stmt->execute();

      $query = $stmt->get_result();

      if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
          ?>
          <form id ="modify" class =" "  method="post" action = "#">
            <div class="thumbnail">
              <div class="caption">
                <h4 class="list-group-item-heading"><?php echo $row["nome"]; ?></h4>
                <p class="lead"><?php echo $row["nome_menu"] !== NULL ? $row["nome_menu"] : "no menu"; ?></p>
                <div class="row">
                  <div class="col-md-6">
                    <p class="lead"><?php echo '€'.$row["prezzo"].' euro'; ?></p>
                  </div>
                  <div class="col-md-6">
                    <p class="lead"><?php echo $row["info"] !== "" ? $row["info"] : "no info"; ?></p>
                  </div>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-success" name="btn" value = "true">Modifica</button>
                  </div>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-success" name="btn" value = "false" onSubmit="return confirm('Are you sure you wish to delete?');">Elimina</button>
                  </div>
                  <input type="hidden" name= "prod" value="<?php echo $row["id"]; ?>">
                  <input type="hidden" name= "modify" value="true">
                </div>
              </div>
            </div>


          </form>
      <?php
    }
  }else{
    echo "<br/><h5> Ancora non hai prodotti nel Listino </h5>";
  }
  ?>
</div>
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
