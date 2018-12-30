<?php
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
 ?>
