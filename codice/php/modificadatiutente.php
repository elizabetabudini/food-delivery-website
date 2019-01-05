<?php
  if (session_status() === PHP_SESSION_NONE){
    session_start();
  }
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cfu";
  $current= "profilofornitore";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if(isset($_POST["sent"])){
    $stmt = $conn->prepare("UPDATE persona SET nome = ?, cognome = ? WHERE email= ?");
    if($stmt!=false){
      $stmt->bind_param("sss", $_POST["nome"], $_POST["cognome"], $_SESSION["email"]);
      $stmt->execute();
      $stmt->close();
    }
    else {
      $errors .= "Bad Programmatore Exception: la query non è andata a buon fine</br>";
    }
    header("Location: profiloutente.php");
  }

  $query = $conn->query("SELECT * FROM persona WHERE email= '".$_SESSION["email"]."'");
  $row = $query->fetch_assoc();
  $nome = $row["nome"];
  $cognome= $row["cognome"];



?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Registrati</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link href="./../css/form.css" rel="stylesheet">
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/footer.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php $current= "profiloutente";
	include 'menu.php';?>
	<div class="container">
			<form id="utenteform" method="post" action="#" class="mobile">
        <div class="form-group">
				<label for="input">Nome</label>
				<input type="text" name="nome"  class="form-control" id="inputNome" placeholder="Inserisci nome" value="<?php echo $nome; ?>" title="Inserisci almeno 2 caratteri">
				</div>
        <div class="form-group">
				<label for="input">Cognome</label>
				<input type="text" name="cognome"  class="form-control" id="inputCognome" placeholder="Inserisci cognome" value="<?php echo $cognome; ?>" title="Inserisci almeno 2 caratteri">
				</div>


				<input type="hidden" name="sent" value="true" />
				<a href = "profiloutente.php"><button type="button"  class="btn btn-success">Annulla</button></a>
				<button type="submit" class="btn btn-success" style="float: right">Modifica</button>
			</form>
		</div>
	</div>

</div>
<?php include 'footer.php'; ?>
<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>
