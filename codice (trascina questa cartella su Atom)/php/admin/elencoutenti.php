<?php if (session_status() === PHP_SESSION_NONE){
  session_start();
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
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/table.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php include 'menu.php'; ?>
<body>
    <div class="container-fluid">
		<div class="row">
			<div class="col-12 col-md-4 offset-md-4">
				<table class="table">
				  <thead>
					<tr>
					  <th scope="col">Email</th>
					  <th scope="col">Nome</th>
					  <th scope="col">Cognome</th>
            <th scope="col">Privilegi</th>
					</tr>
				  </thead>
				  <tbody>
				  </tbody>
				</table>

				<nav aria-label="Page navigation example" class="d-flex">
				  <ul class="pagination mx-auto">
				  </ul>
				</nav>

			</div>
		</div>

	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity=
	"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="./../js/list.js"></script>

  </body>
