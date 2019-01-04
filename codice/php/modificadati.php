<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cfu";
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
    <link href="./../css/footer.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php $current= "signinfornitore";
	include 'menu.php';?>
	<div class="container">

			<div class="alert alert-danger alert-js" role="alert" style="display: None">
				Dati inseriti non corretti
				<p></p>
			</div>

			<form id="fornitoreform" method="post" action="#">
        <div class="form-group">
				<label for="inputRist">Nome Ristorante</label>
				<input type="text" name="nomerist"  class="form-control" id="inputRist" autofocus placeholder="Inserisci nome ristorante"  pattern=".{2,}" title="Inserisci almeno 2 caratteri">
				</div>
        <div class="form-group">
				<label for="inputIndirizzo">Indirizzo Ristorante</label>
        <input type="text" name="indirizzorist"  class="form-control" id="inputIndirizzo" placeholder="Inserisci indirizzo ristorante" >
        <small id="Help" class="form-text text-muted">Ad es. "Viale Bovio, 11, Cesena, FC"</small>
        </div>
				<div class="form-group">
          <label for="inputIndirizzo">Categoria ristorante</label>
          <select  class="form-control form-control-md form-control-borderless" id="Categoria" name="Categoria">
            <?php
              $conn = new mysqli($servername, $username, $password, $dbname);
              $sql = mysqli_query($conn, "SELECT nome_categoria FROM categoria_ristoranti");
              while ($row = $sql->fetch_assoc()){
                echo "<option value='". $row['nome_categoria'] ."'>" . $row['nome_categoria'] . "</option>";
            }
            ?>
          </select>
        </div>
				<div class="form-group">
				<label for="inputCognome">Info</label>
				<textarea type="text" name="cognome" class="form-control" id="inputCognome" placeholder="Inserisci Info"  pattern=".{2,}" title="Inserisci almeno 2 caratteri"></textarea>
        </div>

				<input type="hidden" name="sent" value="true" />
				<a href = "profilofornitore.php"><button type="button"  class="btn btn-primary">Annulla</button></a>
				<button type="submit" class="btn btn-primary" style="float: right">Modifica</button>
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
