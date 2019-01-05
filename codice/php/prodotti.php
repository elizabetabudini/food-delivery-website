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
        if($_POST["Categoria"] != "notf"){
          $stmt5 = $conn->prepare("UPDATE alimento SET nome = ?, info = ?, prezzo = ?, nome_menu = ? WHERE id = ?");
          if($stmt5!=false){
            $stmt5->bind_param("sssss", $_POST["nomeprod"],  $_POST["info"],  $_POST["prezzo"], $_POST["Categoria"], $_POST["prod"] );
            $stmt5->execute();
            $stmt5->close();
          }
        }else{
          $stmt5 = $conn->prepare("UPDATE alimento SET nome = ?, info = ?, prezzo = ? WHERE id = ?");
          if($stmt5!=false){
            $stmt5->bind_param("ssss", $_POST["nomeprod"],  $_POST["info"],  $_POST["prezzo"], $_POST["prod"] );
            $stmt5->execute();
            $stmt5->close();
          }
        }
      }else{
        $stmt5 = $conn->prepare("DELETE FROM alimento WHERE id = ?");
        if($stmt5!=false){
          $stmt5->bind_param("s", $_POST["prod"] );
          $stmt5->execute();
          $stmt5->close();
        }
      }
    //header("Location: prodotti.php");
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
            <label for="Categoria">Menu</label>
            <select  class="form-control form-control-md form-control-borderless" id="Categoria" name="Categoria">
              <?php
                $sql = mysqli_query($conn, 'SELECT nome FROM menu WHERE id_ristorante = "'.$_SESSION["id_ristorante"].'"');
                if(mysqli_num_rows($sql) != 0){
                  while ($row = $sql->fetch_assoc()){
                      echo "<option value='". $row['nome'] ."'>" . $row['nome_categoria'] . "</option>";
                  }
                }else{
                  echo "<option value='notf'>Nessun Menu </option>";
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
            <input type="hidden" name= "add" value="true">
            <button type="submit" class="btn btn-success">Aggiungi</a>
          </div>
        </div>
      </form>
      <h3 class="list-group-item-heading">Modifica i Prodotti gia esistenti</h3>
        <?php
        //get rows query
          $stmt = $conn->prepare("SELECT nome, nome_menu, prezzo, info, id FROM alimento WHERE id_ristorante = ?");
          $stmt->bind_param('s', $id_rist);
          $stmt->execute();

          $query = $stmt->get_result();

          if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
              ?>
              <form id ="modify" class ="card card-sm mobile"  method="post" action = "#">
                <div class="row">
                  <div class="form-group col-sm-3">
        				    <label for="nomeprod">Nome Prodotto</label>
        				    <input type="text" name="nomeprod"  class="form-control" id="nomeprod" value="<?php echo $row["nome"]; ?>" placeholder="">
        				  </div>
                  <div class="form-group col-sm-3">
                    <label for="inputMenu">Menu</label>
                    <select  class="form-control form-control-md form-control-borderless" id="Categoria" name="Categoria">
                      <?php
                        $sql = mysqli_query($conn, 'SELECT nome FROM menu WHERE id_ristorante = "'.$_SESSION["id_ristorante"].'"');
                        if(mysqli_num_rows($sql) != 0){
                          while ($row2 = $sql->fetch_assoc()){
                            if($row2['nome_menu'] == $row["nome_menu"]){
                              echo "<option selected value='".$row2['nome_menu']."'>" . $row2['nome_menu'] . "</option>";
                            }else{
                              echo "<option value='".$row2['nome_menu']."'>" . $row2['nome_menu'] . "</option>";
                            }
                          }
                        }else{
                          echo "<option value='notf'>Nessun Menu </option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="prezzo">prezzo</label>
        				    <input type="text" name="prezzo"  class="form-control" value = "<?php echo $row["prezzo"]; ?>" id="inputRist">
                  </div>
                  <div class="form-group col-md-2">
        				    <label for="info">Info</label>
        				    <textarea type="text" name="info" class="form-control" id="info"><?php echo $row["info"]; ?></textarea>
                  </div>
                  <div class="col-md-2">

                    <button type="submit" class="btn btn-success" name="btn" value = "true">Modifica</button>
                    <br/>
                    <button type="submit" class="btn btn-success" name="btn" value = "false">Elimina</button>
                  </div>
                </div>
                <input type="hidden" name= "prod" value="<?php echo $row["id"]; ?>">
                <input type="hidden" name= "modify" value="true">
              </form>
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
