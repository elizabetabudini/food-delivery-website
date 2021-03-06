
<?php
$current= "signinfornitore";
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
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
  if(!isset($_POST["nomerist"]) || strlen($_POST["nomerist"]) < 2){
    $errors .= "Il nome del ristorante è obbligatorio e deve avere almeno 2 caratteri <br/>";
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

    $nomerist = $_POST["nomerist"];
    $indirizzorist = $_POST["indirizzorist"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $email = $_POST["email"];
    $pwd = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $privilegi = "1";
    $cell = "";
    $rating = "0";
    $info = "";
    $cat ="";

    $stmt = $conn->prepare("INSERT INTO persona (nome, cognome, email, password, privilegi, cellulare) VALUES (?, ?, ?, ?, ?, ?)");
    $isInserted="";
    if($stmt!=false){
      $stmt->bind_param("ssssss", $nome, $cognome, $email, $pwd, $privilegi, $cell);

      $isInserted = $stmt->execute();
      if(!$isInserted){
        $insertError = $stmt->error;
      }
      $stmt->close();
    }
    else {
      $errors .= "Bad Programmatore Exception: la query non è andata a buon fine: 65 signinfornitore.php </br>";
    }

    $stmt2 = $conn->prepare("INSERT INTO ristorante ( info, email_proprietario, nome, indirizzo, nome_categoria, rating) VALUES (?, ?, ?, ?, ?)");
    if($stmt2!=false){
      $stmt2->bind_param("ssssss", $info, $email, $nomerist, $indirizzorist, $_POST["Categoria"], $rating);
      $res= $stmt2->execute();
      $stmt2->close();
    } else {
      $errors .= "Bad Programmatore Exception: la query non è andata a buon fine: 74 signinfornitore.php </br>";
    }

    $stmt3 = $conn->prepare("SELECT id FROM ristorante WHERE email_proprietario = ?");
    if($stmt3!=false){
      $stmt3->bind_param("s", $_POST['email']);
      $stmt3->execute();
      /* bind result variables */
      $stmt3->bind_result($id);
      /* fetch value */
      $stmt3->fetch();
      $stmt3->close();
    } else {
      $errors .= "Bad Programmatore Exception: la query non è andata a buon fine: 87 signinfornitore.php </br>";
    }

    $stmt4 = $conn->prepare("UPDATE persona SET id_ristorante=? WHERE email=?");
    if($stmt4!=false){
      $stmt4->bind_param("ss", $id, $_POST['email']);
      $stmt4->execute();
      $stmt4->close();
    } else {
      $errors .= "Bad Programmatore Exception: la query non è andata a buon fine: 96 signinfornitore.php </br>";
    }
    $stmt = $conn->prepare("SELECT * FROM persona WHERE email = ?");
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_object();

    $_SESSION['nome']= $user->nome;
    $_SESSION['cognome']= $user->cognome;
    $_SESSION["email"]=$_POST['email'];

    $mess= "Iscrizione avvenuta correttamente! Riceverai una notifica quando l'iscrizione sarà approvata dal nostro Team";
    $data= date('Y-m-d H-i-s');
    $letto="0";
    $email=$_POST['email'];
    $stmt5 = $conn->prepare("INSERT INTO messaggio (testo, email, data, letto) VALUES (?, ?, ?, ?)");
    if($stmt5!=false){
      $stmt5->bind_param("ssss", $mess, $email, $data, $letto);
      $stmt5->execute();
      $stmt5->close();
    } else {
      $errors .= "Bad Programmatore Exception: la query non è andata a buon fine: signinfornitore.php </br>";
    }
    $to = $email;
    $subject = "Iscrizione CESENA FOOD UNIVERSITY";
    $body = "Iscrizione avvenuta correttamente! Riceverai
    una notifica quando l'iscrizione sarà approvata dal nostro Team.
    Ignora questa mail se non ti riguarda. Un saluto, CFU Team";
    $headers = "From: cesenafooduniversity@gmail.com" . "\r\n";
    mail($to, $subject, $body, $headers);


    $mess= "Il ristorante ".$nomerist." attende la tua approvazione, controlla i tuoi Strumenti";
    $data= date('Y-m-d H-i-s');
    $letto="0";
    $email="admin@admin.it";
    $stmt5 = $conn->prepare("INSERT INTO messaggio (testo, email, data, letto) VALUES (?, ?, ?, ?)");
    if($stmt5!=false){
      $stmt5->bind_param("ssss", $mess, $email, $data, $letto);
      $stmt5->execute();
      $stmt5->close();
    } else {
      $errors .= "Bad Programmatore Exception: la query non è andata a buon fine: signinfornitore.php </br>";
    }
    $to = "cesenafooduniversity@gmail.com";
    $subject = "Approvazione ".$nomerist;
    $body = "Il ristorante ".$nomerist." attende la tua approvazione, controlla i tuoi Strumenti" . "\r\n";
    mail($to, $subject, $body, $headers);

    if($user->privilegi==1){
      $_SESSION['fornitore']= $user->privilegi;
      $_SESSION['fornitore']=true;
      header("Location: strumenti.php");
    }

  }
}
?>
<?php
$_SESSION['fornitore']= "true";
$_SESSION['utente']= "false";
$_SESSION['admin']="false";
$current= "signinfornitore";
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
  <?php $current= "signinfornitore";
  include 'menu.php';?>
  <div class="container-fluid mobile">
    <div class="row">
      <div class="col-12 col-md-4 offset-md-4">
        <?php
        if(isset($_POST["sent"])){
          if(strlen($errors) == 0 and $isInserted)
          {
            ?>
            <div class="alert alert-success alert-php" role="alert">
              Inserimento avvenuto correttamente! Riceverai una notifica quando l'iscrizione sarà approvata dal nostro Team
            </div>
            <?php
          }
          else{
            ?>
            <div class="alert alert-danger alert-php" role="alert">
              <i class="fa fa-close"></i> Errore durante l'inserimento! La mail inserita è già registrata.
            </div>
            <?php
          }
        }
        ?>
        <div class="alert alert-danger alert-js" role="alert" style="display: None">
        <i class="fa fa-close"></i>  Dati inseriti non corretti
          <p></p>
        </div>

        <form id="fornitoreform" method="post" action="#" class = "mobile">
          <div class="form-group">
            <label for="inputRist">Nome Ristorante</label>
            <input type="text" <?php if(isset($_POST["nomerist"])) { echo 'value="'.htmlspecialchars($_POST['nomerist']).'"';} else echo 'autofocus' ?> name="nomerist"  class="form-control" id="inputRist" placeholder="Inserisci nome ristorante" required pattern=".{2,}" title="Inserisci almeno 2 caratteri">
          </div>
          <div class="form-group">
            <label for="inputIndirizzo">Indirizzo Ristorante</label>
            <input type="text" <?php if(isset($_POST["indirizzorist"])) { echo 'value="'.htmlspecialchars($_POST['indirizzorist']).'"';} ?> name="indirizzorist"  class="form-control" id="inputIndirizzo" placeholder="Inserisci indirizzo ristorante" required>
            <small id="Help" class="form-text text-muted">Ad es. "Viale Bovio, 11, Cesena, FC"</small>
          </div>
          <div class="form-group">
            <label for="inputIndirizzo">Categoria ristorante</label>
            <select  class="form-control form-control-md form-control-borderless" id="Categoria" name="Categoria">
              <?php
              $conn = new mysqli($servername, $username, $password, $dbname);
              $sql = mysqli_query($conn, "SELECT nome_categoria FROM categoria_ristoranti");
              while ($row = $sql->fetch_assoc()){
                if($row['nome_categoria'] == $categoria){
                  echo "<option selected value='". $row['nome_categoria'] ."'>" . $row['nome_categoria'] . "</option>";
                }else{
                  echo "<option value='". $row['nome_categoria'] ."'>" . $row['nome_categoria'] . "</option>";
                }
              }
              ?>
            </select>
            <small id="Help" class="form-text text-muted">Potrai modificare la tua categoria in seguito, sulla pagina Profilo</small>
          </div>
          <div class="form-group">
            <label for="inputEmail">Indirizzo Email</label>
            <input type="email" name="email"  <?php if(isset($_POST["email"])) { echo 'autofocus value="'.htmlspecialchars($_POST['email']).'"';} ?> class="form-control" id="inputEmail" placeholder="Inserisci Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Email non valida! Esempio valido: mario.rossi@gmail.com">
          </div>
          <div class="form-group">
            <label for="inputNome">Nome</label>
            <input type="text" <?php if(isset($_POST["nome"])) { echo 'value="'.htmlspecialchars($_POST['nome']).'"';} ?> name="nome" class="form-control" id="inputNome" placeholder="Inserisci Nome" required pattern=".{2,}" title="Inserisci almeno 2 caratteri">
          </div>
          <div class="form-group">
            <label for="inputCognome">Cognome</label>
            <input type="text" name="cognome" <?php if(isset($_POST["cognome"])) { echo 'value="'.htmlspecialchars($_POST['cognome']).'"';} ?> class="form-control" id="inputCognome" placeholder="Inserisci Cognome" required pattern=".{2,}" title="Inserisci almeno 2 caratteri">
          </div>
          <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" name="password"  class="form-control" id="inputPassword" placeholder="Inserisci Password" required pattern=".{4,}" title="Inserisci almeno 4 caratteri">
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
