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
		if(isset($_POST["sent"])){
			if($_POST['action'] == "Segna come letto"){
				$stmt = $conn->prepare("UPDATE messaggio SET letto = '1' WHERE id = ? ");
				$stmt->bind_param("s", $_POST['id']);
				$stmt->execute();
				$stmt->close();
			}

			if($_POST['action'] == "Elimina" ){
				$stmt2 = $conn->prepare("DELETE FROM messaggio WHERE id = ? ");
				$stmt2->bind_param("s", $_POST['id']);
				$stmt2->execute();
				$stmt2->close();
			}
		}
    $result = mysqli_query($con,"SELECT * FROM messaggio WHERE email = '".$_SESSION["email"]."' AND letto='0'");
		if(!$result){
			echo "<form><p class='card-text' id='no_mess'>Non hai messaggi nella tua casella</p></form>";
		} else {
			while($row = mysqli_fetch_array($result)) {
			echo '<form action="#" method="post" id="form1" >';
			echo "<p class='card-text'id='data'>Data: ".$row['data']."</p>";
			echo "<p class='card-text' id='mess'>Messaggio: ".$row['testo']."</p>";

			echo '
			 <input type="submit" class="btn btn-success" name="action" value="Segna come letto"/>
			 <input type="hidden" name = "id" value="'.$row["id"].'">
			 <br/>
			 <input type="submit" class="btn btn-success" name="action" value="Elimina"/>
			 <input type="hidden" name = "id" value="'.$row["id"].'">
			 <input type="hidden" name="sent" value="true" />
		 </form>';
		 }
		}


 ?>
