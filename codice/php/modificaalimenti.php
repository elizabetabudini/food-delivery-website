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
    <link href="./../css/footer.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style >
    .a{float:right;}
    .cart-link{width: 100%;text-align: right;display: block;font-size: 22px;}
    .caption{color:black;background-color:; padding: 20px;margin-top: 5px;}
    #torna {float: left; margin-left: 6%; margin-top: 1%;}
    .addprod{padding: 10px;}
    form{background-color: rgba(255,255,255,0.9)}

    .cont{
      padding-top: 2%;
      padding-bottom: 2%;
      text-align: center;
      border-top:  2px solid #444;
    }
    h1,h2,h3, #nop {color:white;}
    </style>
  </head>
  <body>
  <?php include 'menu.php'; ?>
  <div class="container">

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
            <form id ="modify" class =" card-sm mobile text-alig addprod"  method="post" action = "#">
              <div class=" thumbnail ">
                <div class="caption">
                  <div class="row">
                  <div class="row col-sm-6" style="margin: 0pt; padding: 0pt;">
                <div class="form-group col-sm-6" >
                  <label for="nomeprod">Nome Prodotto</label>
                  <input type="text" name="nomeprod"  class="form-control" id="nomeprod" value="<?php echo $row["nome"]; ?>" placeholder="">
                </div>
                <div class="form-group col-sm-6 ">
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
                  <div class=" row justify-content-center">
                    <div class="col-sm-6 cont" style="float: left;;">
                      <a href="prodotti.php" class="btn btn-danger">Annulla <i class="fa fa-close"></i></a>
                    </div>
                    <div class="col-sm-6 cont" style="float: right;;">
                      <button type="submit" class="btn btn-success" name="btn" value = "true">Modifica <i class="fa fa-pencil"></i></button>
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
