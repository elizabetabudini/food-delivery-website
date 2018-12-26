<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Accedi</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/form.css" rel="stylesheet">
    <link href="./../css/admin.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php include 'menu.php'; ?>
  <form class="card card-sm">
    <h1>Bacheca di amministrazione</h1>
    <h2>Cesena Food University</h2>
    <h3>Seleziona un'attività:</h3>
    <div class="card-body row no-gutters align-items-center">
      <div class="col-auto">
          <i class="fas fa-search h4 text-body"></i>
      </div>
      <!--end of col-->
      <div class="col-auto">
          <button class="btn btn-lg btn-success" type="button">Elimina utente</button>
      </div>
      <div class="col-auto">
          <button class="btn btn-lg btn-success" type="button">Aggiungi categoria cibo</button>
      </div>
      <div class="col-auto">
          <button class="btn btn-lg btn-success" type="button">Visualizza utenti</button>
      </div>
      <!--end of col-->
    </div>
  </form>
 <!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
