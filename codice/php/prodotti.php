<?php
  if (session_status() === PHP_SESSION_NONE){
    session_start();
  }
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cfu";

  $conn = new mysqli($servername, $username, $password, $dbname);
  $current= "Strumenti";

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

  if(isset($_POST['sent'])){
    $disponibile = 1;
    if($_POST["Categoria"] != "notf"){
      $stmt5 = $conn->prepare("INSERT INTO alimento (disponibilita, nome, info, prezzo, id_ristorante, nome_menu) VALUES (?, ?, ?, ?, ?, ?)");
      if($stmt5!=false){
        $stmt5->bind_param("ssssss", $disponibile, $_POST["nomeprod"],  $_POST["info"],  $_POST["prezzo"], $id_rist , $_POST["Categoria"]);
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
    }

?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Home</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
  <?php include 'menu.php'; ?>
  <div class="card card-sm center-msg-box transparent mobile">
    <div class="container mobile">
      <h1><?php echo $_SESSION["nome"]?> ecco la tua offerta</h1>

      <form id ="add" class ="  card card-sm mobile"  method="post" action = "#">
        <h4 class="list-group-item-heading">Aggiungi un Prodotto!</h4>
        <div class="row">
          <div class="form-group col-sm-3">
				    <label for="nomeprod">Nome Prodotto</label>
				    <input type="text" name="nomeprod"  class="form-control" id="nomeprod" placeholder="" pattern=".{2,}" title="Inserisci almeno 2 caratteri">
				  </div>
          <div class="form-group col-sm-3">
            <label for="inputRist">Menu</label>
            <select  class="form-control form-control-md form-control-borderless" id="Categoria" name="Categoria">
              <?php
                $sql = mysqli_query($conn, 'SELECT nome FROM menu WHERE id_ristorante = "'.$_SESSION["id_ristorante"].'"');
                if(mysqli_num_rows($sql) != 0){
                  while ($row = $sql->fetch_assoc()){
                      echo "<option value='". $row['nome'] ."'>" . $row['nome_categoria'] . "</option>";
                  }
                }else{
                  echo "<option value='notf'>Nessun Menu trovato</option>";
                }
              ?>
            </select>
          </div>
          <div class="col-md-2">
            <label for="prezzo">prezzo</label>
				    <input type="text" name="prezzo"  class="form-control" id="inputRist">
          </div>
          <div class="form-group col-md-2">
				    <label for="info">Info</label>
				    <textarea type="text" name="info" class="form-control" id="info"></textarea>
          </div>
          <div class="col-md-2">
            </br>
            <input type="hidden" name= "sent" value="true">
            <button type="submit" class="btn btn-success">Aggiungi</a>
          </div>
        </div>
      </form>
      </div>

      <div  class="row list-group">
        <?php
        //get rows query
          $stmt = $conn->prepare("SELECT nome, nome_menu, prezzo, info, id FROM alimento WHERE id_ristorante = ?");
          $stmt->bind_param('s', $id_rist);
          $stmt->execute();

          $query = $stmt->get_result();

          if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
              ?>
              <div>
                <h4 class="list-group-item-heading"><?php echo $row["nome"]; ?></h4>
                <p class="list-group-item-text"><?php echo 'menu: '.$row["nome_menu"]; ?></p>
                <div class="row">
                  <div class="col-md-6">
                    <p class="lead"><?php echo '€'.$row["prezzo"].' euro'; ?></p>
                  </div>
                  <div class="col-md-6">
                    <a class="btn btn-success" href="DBcarrello.php?action=addToCart&id=<?php echo $row["id"]; ?>">Aggiungi al carrello</a>
                  </div>
                </div>
              </div>
              <?php
            }
          }
          ?>
      </div>
    </div>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity=
	"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>
