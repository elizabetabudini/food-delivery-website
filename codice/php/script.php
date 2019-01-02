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
    $result = mysqli_query($con,"SELECT * FROM messaggio WHERE email = '".$_SESSION["email"]."'");
		if($row_cnt = $result->num_rows==0){
			echo "<form><p class='card-text' id='no_mess'>Non hai messaggi nella tua casella</p></form>";
		} else {
			while($row = mysqli_fetch_array($result)) {
			echo '<form action="#" method="post" id="form1" >';
			echo "<p class='card-text'id='data'>Data: ".$row['data']."</p>";
			echo "<p class='card-text' id='mess'>Messaggio: ".$row['testo']."</p>";

			echo '
			 <input type="submit" class="btn btn-primary" name="action" value="Segna come letto"/>
			 <input type="hidden" name = "id" value="'.$row["email"].'">
			 <br/>
			 <input type="submit" class="btn btn-primary" name="action" value="Elimina"/>
			 <input type="hidden" name = "id" value="'.$row["email"].'">
			 <input type="hidden" name="sent" value="true" />
		 </form>';
		 }
		}


 ?>
