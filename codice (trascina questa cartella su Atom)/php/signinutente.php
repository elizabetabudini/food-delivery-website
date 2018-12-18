<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Registrati</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link href="./../css/form.css" rel="stylesheet">
    <link href="./../css/full.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php include 'menu.php'; ?>
  <form class= " col-md-6 col-sm-8 col-xs-8" action="gestioneDB.php" method="post">
  <div class="container">
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" name="nome" id="nome" placeholder="Inserisci nome">
    </div>
    <div class="form-group">
      <label for="cognome">Cognome</label>
      <input type="text" class="form-control"  name="cognome" id="cognome" placeholder="Inserisci cognome">
    </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Inserisci email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control"  name="password" id="password" placeholder="Password">
  </div>
  <button type="submit" id="submit" name= "submit" class="btn btn-primary">Iscrivimi!</button>
  </div>
</form>

<!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
