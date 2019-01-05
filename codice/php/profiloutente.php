<?php
  if (session_status() === PHP_SESSION_NONE){
    session_start();
  }
  $servernome = "localhost";
  $usernome = "root";
  $password = "";
  $dbnome = "cfu";

  $db = new mysqli($servernome, $usernome, $password, $dbnome);

  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  $query = $db->query("SELECT * FROM persona WHERE email = '".$_SESSION["email"]."'");
  $row = $query->fetch_assoc();
  $nome = $row["nome"];
  $cognome = $row["cognome"];
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Profilo Utente</title>
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
    <?php $current = "profiloutente";
    include 'menu.php';
        ?>
        <div class="card mobile card-sm center-msg-box transparent">
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
                        <td>Nome</td>
                        <td><?php echo $nome; ?></td>
                      </tr>
                      <tr>
                        <td>Cognome</td>
                        <td><?php echo $cognome; ?></td>
                      </tr>


                    </tbody>
                  </table>



        <a cass"a" href="modificadatiutente.php" class="btn btn-success">Modifica dati</a>
    </div>
  </div>
  </div>

<?php include 'footer.php'; ?>
<!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
