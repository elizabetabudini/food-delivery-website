<?php
if (session_status() === PHP_SESSION_NONE){
	session_start();
}
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>CFU - Messaggi</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="./../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="./../css/form.css" rel="stylesheet">
	<link href="./../css/full.css" rel="stylesheet">
	<link href="./../css/menubar.css" rel="stylesheet">
	<link href="./../css/navigation.css" rel="stylesheet">
	<link href="./../css/messaggi.css" rel="stylesheet">
	<link href="./../css/footer.css" rel="stylesheet">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<body>
		<?php
		$current="strumenti";
		include 'menu.php';?>
		<br/>
<div class="container transparent">

		<a href="strumenti.php" class="btn btn-success" ><i class="fa fa-arrow-left"></i> Indietro</a>

		<?php
		$current="strumenti";

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "cfu";

		// Getting submitted user data from database
		$con = new mysqli($servername, $username, $password, $dbname);
		$stmt5 = $con->prepare("SELECT id FROM ristorante WHERE email_proprietario=?");
		if($stmt5!=false){
			$stmt5->bind_param("s", $_SESSION["email"]);
			$stmt5->execute();
			$result = $stmt5->get_result();
			$id = $result->fetch_object();
			$id=$id->id;
			$stmt5->close();

		}
		$result = mysqli_query($con,"SELECT * FROM prenotazione WHERE id_ristorante = '".$id."' AND stato='0'");
		if($result->num_rows==0){
			echo "<form class='card-text mobile'><p class='card-text' id='no_mess'>Non hai ordini da evadere</p></form>";
		} else {
			while($row = mysqli_fetch_array($result)) {
				echo '<form action="#" method="post" class="card-text mobile" id="form1" >';
				echo "<h4 class='card-text'id='data'>ID Ordine: ".$row['id']."</h4>";
				echo "<h4 class='card-text' id='mess'>Cliente: ".$row['email_cliente']."</h4>";
				$res = mysqli_query($con,"SELECT * FROM carrello WHERE id_prenotazione = ".$id);
				if($res->num_rows==0){
					echo "";
				} else {
					while($rowi = mysqli_fetch_array($res)) {
						$res2 = mysqli_query($con,"SELECT * FROM alimento WHERE id= ".$rowi['id_alimento']);
						if($res2->num_rows==0){
							echo "";
						} else {
							$rowii = mysqli_fetch_array($res2);
							echo "<p class='card-text' id='mess'>Alimento: ".$rowii['nome']." </p>";
							echo "<p class='card-text' id='mess'>ID_alimento: ".$rowi['id_alimento']." </p>";
							echo "<p class='card-text' id='mess'>Quantità: ".$rowi['quantita']."</p></br>";
						}

					}
				}

				echo '<a href="apiordini.php?action=evadi&id='.$row["id"].'" class="btn btn-success" >Evadi <i class="fa fa-check"></i></a>
				<input type="hidden" name="sent" value="true" />';
				echo	'<a href="apiordini.php?action=elimina&id='.$row["id"].'" class="btn btn-danger" onclick="return confirm("Sei sicuro?")">Rimuovi <i class="fa fa-close"></i></a>

				</form>';
			}
		}
		?>
	</div>

		</div>
		<?php include 'footer.php'; ?>

		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="./../js/messaggi.js"></script>
	</body>
	</html>
