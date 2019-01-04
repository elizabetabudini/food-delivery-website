<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$_SESSION['fornitore']= "false";
$_SESSION['utente']= "true";
$_SESSION['admin']="false";
$current= "homeclienti";
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Home Clienti</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/home.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/footer.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">
    <link href="./../css/notificapopup.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script>


  </head>
  <body>
    <?php $current = 'homeclienti';
      include 'menu.php';
     ?>

    <div class="row h-100 justify-content-center align-items-center ">
        <div class="col-12 col-md-10 col-lg-8 ">
          <form class="card card-sm center-msg-box" action="prenotazione.php" method="post" name ="ricerca" id="ricerca">
            <h1>CFU</h1>
            <h2>Cesena Food University</h2>
            <h3>Their food at your university</h3>
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
                  echo "<option value='". $row['nome'] ."'>" . $row['nome'] . "</option>";
                }
                ?>
              </select>
            </form>
            </div>
                <!--end of col-->
              <div class="col-auto">
                  <button class="btn btn-lg btn-success" id = "submit" type="submit" >Risultati</button>
                  <?php if(isset($_POST['luogo'])) $selectOption = $_POST['luogo']; ?>
              </div>
              <!--end of col-->
            </div>
          </form>
        </div>
        <!--end of col-->
    </div>

<?php include 'footer.php'; ?>
<!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
