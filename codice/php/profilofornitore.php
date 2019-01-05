<?php
  if (session_status() === PHP_SESSION_NONE){
    session_start();
  }
  $_SESSION["fornitore"]= "true";
  $_SESSION['utente']= "false";
  $_SESSION['admin']="false";
  $current= "profilofornitore";

  $servernome = "localhost";
  $usernome = "root";
  $password = "";
  $dbnome = "cfu";

  $db = new mysqli($servernome, $usernome, $password, $dbnome);

  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  $query = $db->query("SELECT * FROM ristorante WHERE email_proprietario = '".$_SESSION["email"]."'");
  $row = $query->fetch_assoc();
  $nome_rist = $row["nome"];
  $info = $row["info"];
  $indirizzo = $row["indirizzo"];
  $categoria= $row["nome_categoria"];
  $rating = $row["rating"];
  $approvazione = $row["approvato"]
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Profilo Fornitore</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/footer.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    h1,h3{text-align: center; color:white;}
    .a{float:right;}
    .card{width: 450px;background: rgba(0,0,0,0.7);border-radius: 10px;
    -webkit-border-radius: 10px;-moz-border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);-moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
    -webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
    }
    .table{background-color: rgba(255,255,255,65%);}
    .table td, .table th{border-top: none;}
</style>

  </head>
  <body>
    <?php $current = "profilofornitore";
    include 'menu.php';
        ?>

        <div class="card card-sm center-msg-box transparent mobile">
        <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h1 class="title">Profilo <?php echo $_SESSION["nome"]; ?> </h1>
            </div>

                  <table class="table table-light">
                    <tbody>
                      <tr>
                        <td>La tua mail:</td>
                        <td><?php echo $_SESSION["email"]; ?></td>
                      </tr>
                      <tr>
                        <td>Nome ristorante:</td>
                        <td><?php echo $nome_rist; ?></td>
                      </tr>
                      <tr>
                        <td>Indirizzo:</td>
                        <td><?php echo $indirizzo; ?></td>
                      </tr>

                         <tr>
                             <tr>
                        <td>Categoria:</td>
                        <td><?php echo $categoria; ?></td>
                      </tr>
                      <tr>
                        <td>Info:</td>
                        <td><?php echo $info; ?></td>
                      </tr>
                      <tr>
                        <td>Rating:</td>
                        <td><?php echo $rating; ?></td>
                      </tr>

                      <?php
                        if($approvazione == 1){
                          echo'<tr>
                            <td>Approvato</td>
                            <td>YESSS!</td>
                          </tr>';
                        }else{
                          echo'<tr>
                            <td>Approvato</td>
                            <td>IN ATTESA DI APPROVAZIONE</td>
                          </tr>';
                        } ?>

                    </tbody>
                  </table>



        <a class"a" href="modificadati.php" class="btn btn-success">Modifica dati</a>
    </div>
  </div>
  </div>

<?php include 'footer.php'; ?>
<!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
