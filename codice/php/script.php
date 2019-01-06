<?php
if (session_status() === PHP_SESSION_NONE){
	session_start();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cfu";

// Getting submitted user data from database
$con = new mysqli($servername, $username, $password, $dbname);
$result = mysqli_query($con,"SELECT * FROM messaggio WHERE email = '".$_SESSION["email"]."' ORDER BY letto");
if($result->num_rows==0){
	echo "<form><p class='card-text mobile' id='no_mess'>Non hai messaggi nella tua casella</p></form>";
} else {
	while($row = mysqli_fetch_array($result)) {
		echo '<form action="#" class="mobile" method="post" id="form1" >';
		echo "<p class='card-text'id='data'>Data: ".$row['data']."</p>";
		echo "<p class='card-text' id='mess'>Messaggio: ".$row['testo']."</p>";

		if($row["letto"]==0){

			echo '<a href="apimessaggi.php?action=letto&id='.$row["id"].'" class="btn btn-success" >Letto</a>
			<input type="hidden" name="sent" value="true" />';
		}
		echo	'<a href="apimessaggi.php?action=elimina&id='.$row["id"].'" class="btn btn-danger" onclick="return confirm("Sei sicuro?")">Rimuovi</a>

		</form>';
	}
}


?>
