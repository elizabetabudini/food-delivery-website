<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$_SESSION['fornitore']= "false";
$_SESSION['utente']= "true";
$_SESSION['admin']="false";
$current= "signinutente";
?>
<?php
if(isset($_POST["sent"])){
  $errors = "";
  $insertError = "";


  if(!isset($_POST["nome"]) || strlen($_POST["nome"]) < 2){
    $errors .= "Nome è obbligatorio e deve essere almeno 2 caratteri <br/>";
  }

  if(!isset($_POST["cognome"]) || strlen($_POST["cognome"]) < 2){
    $errors .= "Cognome è obbligatorio e deve avere almeno 2 caratteri <br/>";
  }

  if(!isset($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    $errors .= "Email è obbligatoria e deve essere valida <br/>";
  }
  if(!isset($_POST["password"]) || strlen($_POST["password"]) < 4){
    $errors .= "Password è obbligatoria e deve avere almeno 4 caratteri <br/>";
  }

  if(strlen($errors) == 0){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cfu";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $email = $_POST["email"];
    $pwd = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $privilegi = "0";
    $cell = "";


    $stmt = $conn->prepare("INSERT INTO persona (nome, cognome, email, password, privilegi, cellulare) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome, $cognome, $email, $pwd, $privilegi, $cell);

    $isInserted = $stmt->execute();
    if(!$isInserted){
      $insertError = $stmt->error;
    }

    $stmt->close();
  }
}
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
  <?php $current= "signinutente";
  include 'menu.php';
  ?>
  <div class="container-fluid ">
    <div class="row">
      <div class="col-12 col-md-4 offset-md-4">
        <?php
        if(isset($_POST["sent"])){
          if(strlen($errors) == 0 and $isInserted)
          {
            ?>
            <div class="alert alert-success alert-php" role="alert">
              Inserimento avvenuto correttamente!
            </div>
            <?php
          }
          else{
            ?>
            <div class="alert alert-danger alert-php" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">Errore:</span>
              Errore durante l'inserimento! La mail inserita è già registrata.
            </div>
          </div>
          <?php
        }
      }
      ?>
      <div class="alert alert-danger alert-js" role="alert" style="display: None">
        Dati inseriti non corretti
        <p></p>
      </div>

      <form id="insertform" method="post" action="#" class ="mobile">
        <div class="form-group">
          <label for="inputNome">Nome</label>
          <input type="text" name="nome" <?php if(isset($_POST["nome"])) { echo 'value="'.htmlspecialchars($_POST['nome']).'"';} else echo 'autofocus' ?> class="form-control" id="nome" placeholder="Inserisci Nome" required pattern=".{2,}" title="Inserisci almeno 2 caratteri">
        </div>
        <div class="form-group">
          <label for="inputCognome">Cognome</label>
          <input type="text" name="cognome" <?php if(isset($_POST["cognome"])) { echo 'value="'.htmlspecialchars($_POST['cognome']).'"';} ?> class="form-control" id="cognome" placeholder="Inserisci Cognome" required pattern=".{2,}" title="Inserisci almeno 2 caratteri">
        </div>
        <div class="form-group">
          <label for="inputEmail">Indirizzo Email</label>
          <input type="email" name="email"  <?php if(isset($_POST["email"])) { echo 'autofocus value="'.htmlspecialchars($_POST['email']).'"';} ?> class="form-control" id="email" placeholder="Inserisci Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >
        </div>
        <div class="form-group">
          <label for="inputPassword">Password</label>
          <input type="password" name="password"  class="form-control" id="password" placeholder="Inserisci Password" required pattern=".{4,}" title="Inserisci almeno 4 caratteri">
        </div>
        <input type="hidden" name="sent" value="true" />
        <button type="submit" class="btn btn-success">Registrati</button>
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
