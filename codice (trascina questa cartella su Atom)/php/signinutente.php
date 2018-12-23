<?php
if(isset($_POST["sent"])){
	$errors = "";
	$insertError = "";


	if(!isset($_POST["nome"]) || strlen($_POST["nome"]) < 2){
		$errors .= "Nome è obbligatorio e deve essere almeno 2 caratteri <br/>";
	}

	if(!isset($_POST["cognome"]) || strlen($_POST["cognome"]) < 2){
		$errors .= "Cognome è obbligatorio e deve essere almeno 2 caratteri";
	}

	if(!isset($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
		$errors .= "Email è obbligatoria e deve essere valida <br/>";
	}
	if(!isset($_POST["password"])){
		$errors .= "Password è obbligatoria <br/>";
	}

	if(strlen($errors) == 0){

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "progetto";

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$nome = $_POST["nome"];
		$cognome = $_POST["cognome"];
		$email = $_POST["email"];
		$pwd = password_hash($_POST["password"], PASSWORD_DEFAULT);

		$stmt = $conn->prepare("INSERT INTO clienti (nome, cognome, email, password) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $nome, $cognome, $email, $pwd);
		
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
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link href="./../css/form.css" rel="stylesheet">
    <link href="./../css/full.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php include 'menu.php'; ?>
	<div class="container-fluid">
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
				Errore durante l'inserimento!
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
			<form id="insertform" method="post" action="#">
				<div class="form-group">
				<label for="inputNome">Nome</label>
				<input type="text" name="nome" class="form-control" id="inputNome" placeholder="Inserisci Nome">
				</div>
				<div class="form-group">
				<label for="inputCognome">Cognome</label>
				<input type="text" name="cognome" class="form-control" id="inputCognome" placeholder="Inserisci Cognome">
				</div>
				<div class="form-group">
				<label for="inputEmail">Indirizzo Email</label>
				<input type="email" name="email"  class="form-control" id="inputEmail" placeholder="Inserisci Email">
				</div>
				<div class="form-group">
				<label for="inputPassword">Password</label>
				<input type="password" name="password"  class="form-control" id="inputPassword" placeholder="Inserisci Password">
				</div>
				<input type="hidden" name="sent" value="true" />
				<button type="submit" class="btn btn-primary">Registrati</button>
			</form>
		</div>
	</div>

</div>

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="/js/signinutente.js"></script>
  </body>
</html>
