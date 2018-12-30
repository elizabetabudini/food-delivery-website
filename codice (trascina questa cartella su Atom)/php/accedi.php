<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
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

	if(strlen($errors) == 0){

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "cfu";
		session_start();
    // Getting submitted user data from database
    $con = new mysqli($servername, $username, $password, $dbname);
    $stmt = $con->prepare("SELECT * FROM persona WHERE email = ?");
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();

    $result = $stmt->get_result();
	  $user = $result->fetch_object();
		if($user===NULL){
				$errors .= "L'email ".$_POST['email']." non è ancora registrata!<br/>";
		} else {

			// Verify user password and set $_SESSION
	  	if ( password_verify($_POST["password"], $user->password)) {
				 $_SESSION['email']= $user->email;
				 $_SESSION['nome']= $user->nome;
				 $_SESSION['cognome']= $user->cognome;
				 if($user->privilegi==0){
					 $_SESSION['utente']= $user->privilegi;
					 header("Location: homeclienti.php");
				 }
				 if($user->privilegi==1){
					 header("Location: areafornitori.php");
					 $_SESSION['fornitore']= $user->privilegi;
				 }
				 if($user->privilegi==2){
					 header("Location: homeadmin.php");
					 $_SESSION['admin']= $user->privilegi;
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
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/form.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php $current= "accedi";
	include 'menu.php'; ?>
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

  <form method="post" action="#" id="signupform" >
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Enter email" autofocus required>

    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name= "password" id="password" placeholder="Password" required>
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
  </body>
</html>
