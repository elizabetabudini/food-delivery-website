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

  if(isset($_POST['modify'])){
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
    header("Location: prodotti.php");
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
  <?php include 'menu.php'; ?>
  <div class="card card-sm center-msg-box transparent mobile">
    <div class="container mobile">
      <?php
      //get rows query
        $stmt = $conn->prepare("SELECT nome, nome_menu, prezzo, info, id FROM alimento WHERE id_ristorante = ? AND id = ?");
        $stmt->bind_param('ss', $id_rist, $_SESSION["alimmod"]);
        $stmt->execute();
        $query = $stmt->get_result();
        $row = $query->fetch_assoc();
            ?>
            <form id ="modify" class ="card card-sm mobile "  method="post" action = "#">
              <div class="row">
                <div class="form-group col-sm-3">
                  <label for="nomeprod">Nome Prodotto</label>
                  <input type="text" name="nomeprod"  class="form-control" id="nomeprod" value="<?php echo $row["nome"]; ?>" placeholder="">
                </div>
                <div class="form-group col-sm-3">
                  <label for="inputMenu">Menu</label>
                  <select  class="form-control form-control-md form-control-borderless" id="Categoria" name="Categoria">
                    <?php
                      $sql = mysqli_query($conn, 'SELECT nome FROM menu WHERE id_ristorante = "'.$id_rist.'"');
                      if(mysqli_num_rows($sql) != 0){
                        if($row["nome_menu"] === NULL){
                          echo "<option selected value='notf'>None selected</option>";
                        }
                        while ($row2 = $sql->fetch_assoc()){
                          if($row2['nome'] == $row["nome_menu"]){
                            echo "<option selected value='".$row2['nome']."'>" . $row2['nome'] . "</option>";
                          }else{
                            echo "<option value='".$row2['nome']."'>" . $row2['nome'] . "</option>";
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
                <div class="form-group col-md-4">
                  <label for="info">Info</label>
                  <textarea type="text" name="info" class="form-control" id="info"><?php echo $row["info"]; ?></textarea>
                </div>
                <div class="col-md-12">
                  <br/>
                  <div class="row justify-content-center">
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-success" name="btn" value = "true">Modifica</button>
                    </div>
                    <div class="col-md-2">
                      <a href="menucibi.php" class="btn btn-success">Annulla</a>
                    </div>
                  </div></div>
              </div>
              <input type="hidden" name= "prod" value="<?php echo $row["id"]; ?>">
              <input type="hidden" name= "modify" value="true">
            </form>
            <?php


        ?>
    </div>
  </div>
</div>
