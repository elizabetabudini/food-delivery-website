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

		$stmt = $conn->prepare("INSERT INTO persona (nome, cognome, email, password, privilegi, cellulare) VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssss", $nome, $cognome, $email, $pwd, $privilegi, $cell);

		$isInserted = $stmt->execute();
		if(!$isInserted){
			$insertError = $stmt->error;
		}

		$stmt2 = $conn->prepare("INSERT INTO ristorante (email_proprietario, nome, posizione) VALUES (?, ?, ?)");
		$stmt2->bind_param("sss", $email, $nomerist, $indirizzorist);
    $res= $stmt2->execute();

		if( !$res ){
			$insertError = $stmt->error;
		} else {

			$result = $stmt2->get_result();
		  $ristorante = $result->fetch_object();
			$id= $ristorante->id;

			$stmt3 = $conn->prepare("UPDATE persona SET id_ristorante=? WHERE email=?");
			$stmt3->bind_param([$id, $email]);
			$stmt3->execute();
			$stmt3->close();
		}
		$stmt->close();
		$stmt2->close();
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
    <link href="./../css/menubar.css" rel="stylesheet">
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

			<form id="fornitoreform" method="post" action="#">
        <div class="form-group">
				<label for="inputRist">Nome Ristorante</label>
				<input type="text" name="nomerist"  class="form-control" id="inputRist" autofocus placeholder="Inserisci nome ristorante" required pattern=".{2,}" title="Inserisci almeno 2 caratteri">
				</div>
        <div class="form-group">
				<label for="inputIndirizzo">Indirizzo Ristorante</label>
        <input type="text" name="indirizzorist"  class="form-control" id="inputIndirizzo" placeholder="Inserisci indirizzo ristorante" required>
        <small id="Help" class="form-text text-muted">Ad es. "Viale Bovio, 11, Cesena, FC"</small>
        </div>
				<div class="form-group">
				<label for="inputNome">Nome</label>
				<input type="text" name="nome" class="form-control" id="inputNome" placeholder="Inserisci Nome" required pattern=".{2,}" title="Inserisci almeno 2 caratteri">
				</div>
				<div class="form-group">
				<label for="inputCognome">Cognome</label>
				<input type="text" name="cognome" class="form-control" id="inputCognome" placeholder="Inserisci Cognome" required pattern=".{2,}" title="Inserisci almeno 2 caratteri">
				</div>
				<div class="form-group">
				<label for="inputEmail">Indirizzo Email</label>
				<input type="email" name="email"  class="form-control" id="inputEmail" placeholder="Inserisci Email" required >
				</div>
        <div class="form-group">
				<label for="inputPassword">Password</label>
				<input type="password" name="password"  class="form-control" id="inputPassword" placeholder="Inserisci Password" required pattern=".{4,}" title="Inserisci almeno 4 caratteri">
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
	</body>
</html>
