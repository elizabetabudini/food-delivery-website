<?php

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "cfu";
		session_start();
    // Getting submitted user data from database
    $con = new mysqli($servername, $username, $password, $dbname);
    $result = mysqli_query($con,"SELECT * FROM messaggio");

   while($row = mysqli_fetch_array($result)) {

   echo "<div id='dest'>Destinatario: ".$row['email']."</div>";
   echo "<div id='data'>Data: ".$row['data']."</div>";
   echo "<div id='mess'>Messaggio: ".$row['testo']."</div>";

   echo '<form action="#" method="post" id="form1" >
    <input type="submit" class="btn btn-primary" name="action" value="Segna come letto"/>
    <input type="hidden" name = "id" value="'.$row["email"].'">
    <br/>
    <input type="submit" class="btn btn-primary" name="action" value="Elimina"/>
    <input type="hidden" name = "id" value="'.$row["email"].'">
    <input type="hidden" name="sent" value="true" />
  </form>';
	}

 ?>
