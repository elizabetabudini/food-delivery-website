<?php
$current= "messaggiutente";
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

    <link href="./../css/form.css" rel="stylesheet">
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">
    <link href="./../css/messaggi.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
			$(function() {
				setInterval(function() {
					$.ajax({
						type: "GET",
						url: "script.php",
						success: function(html) {
							 // html is a string of all output of the server script.
							$("#element").html(html);
					   }

					});
				}, 300);
			});
		</script>
  </head>
  <body>
  <?php include 'menu.php'; ?>

  <div class="card card-sm center-msg-box transparent mobile ">
    <h3 class="title text-center">I tuoi messaggi</h3>
    <p id="element"></p>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
