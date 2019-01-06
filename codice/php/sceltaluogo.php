<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$current= " ";
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>CFU - Home Clienti</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="./../css/bootstrap.min.css">
  <link href="./../css/full.css" rel="stylesheet">
  <link href="./../css/home.css" rel="stylesheet">
  <link href="./../css/menubar.css" rel="stylesheet">
  <link href="./../css/footer.css" rel="stylesheet">
  <link href="./../css/navigation.css" rel="stylesheet">
  <link href="./../css/notificapopup.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <?php
  include 'menu.php';
  ?>

  <div class="row h-100 justify-content-center align-items-center ">
    <div class="col-12 col-md-10 col-lg-8 ">
      <form class="card card-sm center-msg-box" action="prenotazione2.php" method="post" name ="ricerca" id="ricerca">
        <h2>Conferma luogo di spedizione</h2>
        <div class="card-body row no-gutters align-items-center">
          <!--end of col-->
          <div class="col">
            <form method="post">
              <select autofocus="on" class="form-control form-control-lg form-control-borderless" id="sel1" name="luogo">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "cfu";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
                $sql = mysqli_query($conn, "SELECT nome FROM luogo");

                while ($row = $sql->fetch_assoc()){
                  if(isset($_SESSION["luogo"])){
                    if($_SESSION["luogo"]==$row['nome'])
                    echo "<option selected value='". $row['nome'] ."'>" . $row['nome'] . "</option>";
                  }
                  echo "<option value='". $row['nome'] ."'>" . $row['nome'] . "</option>";
                }
                ?>
              </select>

              <label>Seleziona data e orario
                <input type="dateTime-local" name="oraConsegna" id="currentDateTime"  min="<?php echo date("Y-m-d")."T".date("H:i");?>" value="<?php echo date("Y-m-d")."T".date("H:i");?>" required>
              </label>


            </form>
          </div>
          <!--end of col-->
          <div class="col-auto">
            <button class="btn btn-lg btn-success" id = "submit" type="submit" >Continua ></button>
            <?php if(isset($_POST['submit'])){
              $_SESSION["luogo"] = $_POST['luogo'];
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "cfu";
              $conn = new mysqli($servername, $username, $password, $dbname);
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }
              $stmt3 = $conn->prepare("UPDATE prenotazione SET luogo_consegna=? data_consegna=? WHERE id=?");
              $stmt3->bind_param("ss", $_POST["luogo"], $_POST['oraConsegna'], $_SESSION["id_prenotazione"] );
              $stmt3->execute();
              $stmt3->close();
              $conn->close();
            }
            ?>
          </div>
          <!--end of col-->
        </div>
      </form>
    </div>
    <!--end of col-->
  </div>

  <?php include 'footer.php'; ?>
  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./../js/messaggi.js"></script>
</body>
</html>
