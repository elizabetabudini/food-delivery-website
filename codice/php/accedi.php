<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}

$_SESSION['url'] = $_SERVER['REQUEST_URI'];

/*se sono già loggato*/
if(isset($_SESSION["email"])){
  if(isset($URL)){
    header("Location:".$URL."");
  }
}

$current= "accedi";
if(isset($_POST["sent"])){
  $errors = "";
  $insertError = "";

  if(!isset($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    $errors .= "Email è obbligatoria e deve essere valida <br/>";
  }
  if(!isset($_POST["password"])){
    $errors .= "Password è obbligatoria <br/>";
  }

  /*se non ci sono errori sui dati inseriti dall'utente*/
  if(strlen($errors) == 0){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cfu";
    $con = new mysqli($servername, $username, $password, $dbname);

    /*Controllo che sul DB sia registrata la mail inserita dall'utente*/
    $stmt = $con->prepare("SELECT * FROM persona WHERE email = ?");
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_object();

    if($user===NULL){
      $errors .= "L'email ".$_POST['email']." non è ancora registrata!<br/>";
    } else {

      //*Controllo che la password inserita si corretta*/
      if ( password_verify($_POST["password"], $user->password)) {
        $_SESSION['email']= $user->email;
        $_SESSION['nome']= $user->nome;
        $_SESSION['cognome']= $user->cognome;
        if(isset($_SESSION["Redirect"])){
          $URL= $_SESSION["Redirect"];
        }
        if($user->privilegi==0){
          $_SESSION['utente']= $user->privilegi;
          $_SESSION['utente']=true;
          if($_SESSION["Redirect"]=="checkout.php"){
              header("Location:".$URL."");
          } else {
            header("Location: homeclienti.php");
          }

        }
        if($user->privilegi==1){
          $_SESSION['fornitore']= $user->privilegi;
          $_SESSION['fornitore']=true;
          header("Location: strumenti.php");
        }
        if($user->privilegi==2){
          $_SESSION['admin']= $user->privilegi;
          $_SESSION['admin']=true;
          header("Location: homeadmin.php");
        }

      } else {
        $errors .= "La password non è corretta<br/>";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>CFU - Accedi</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="./../css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="./../css/full.css" rel="stylesheet">
  <link href="./../css/form.css" rel="stylesheet">
  <link href="./../css/menubar.css" rel="stylesheet">
  <link href="./../css/footer.css" rel="stylesheet">
  <link href="./../css/navigation.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
  <?php $current= "accedi";
  include 'menu.php';?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-4 offset-md-4">
        <?php
        if(isset($_POST["sent"])){
          if(strlen($errors) == 0)
          {
            ?>
            <div class="alert alert-success alert-php" role="alert">
              Accesso effettuato!
            </div>
            <?php
          }
          else{
            ?>
            <div class="alert alert-danger alert-php" role="alert">
              Errore
              <p><?=$errors?><?=$insertError?></p>
            </div>
            <?php
          }
        }
        ?>
        <div class="alert alert-danger alert-js" role="alert" style="display: None">
          Dati inseriti non corretti
          <p></p>
        </div>

        <form method="post" action="#" id="signupform" class = "mobile" >
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Enter email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" autofocus required>

          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name= "password" id="password" placeholder="Password" required>
          </div>
          <input type="hidden" name="sent" value="true" />
          <button type="submit" name= "submit" id= "submit" class="btn btn-success">Accedi</button>
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
