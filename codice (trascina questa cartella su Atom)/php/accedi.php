<?php
if(isset($_POST["sent"])){
	$errors = "";
	$insertError = "";

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
		$dbname = "cfu";

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$email = $_POST["email"];
		$pwdinserita = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $pwdgiusta = "";
    /* create a prepared statement */
    $stmt = $mysqli->prepare("SELECT password FROM persona WHERE email=?");

    /* bind parameters for markers */
    $stmt->bind_param("s", $email);

    /* execute query */
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($pwdgiusta);

    /* fetch value */
    $stmt->fetch();

    if($pwdinserita===$pwdgiusta){
      console.log("password corretta");
    }else {
      console.log("errore password");
    }

    /* close statement */
    $stmt->close();

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
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/form.css" rel="stylesheet">
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

  <form method="post" action="#" id="signupform" >
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">

    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" name= "password" id="password" placeholder="Password">
    </div>
  	<input type="hidden" name="sent" value="true" />
    <button type="submit" name= "submit" id= "submit" class="btn btn-primary">Accedi</button>
  </form>
  </div>
 </div>
</div>
 <!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  <script src="./../js/accedi.js"></script>
  </body>
</html>
