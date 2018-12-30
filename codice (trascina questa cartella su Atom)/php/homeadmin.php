<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Accedi</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">

    <link href="./../css/form.css" rel="stylesheet">
    <link href="./../css/full.css" rel="stylesheet">
    <!--<link href="./../css/admin.css" rel="stylesheet"> -->
    <link href="./../css/menubar.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php include 'menu.php';
  if(! isset($_SESSION["email"])){
     header("Location: accedi.php");
  }?>
  <div class="card card-sm center-msg-box transparent">

  <div class="row">
    <div class="col-md-4 ">
      <div class="card dark">
        <div class="card-body">
          <h5 class="card-title">Elimina utente</h5>
          <p class="card-text-center">Sicuro? nessuno vuole essere eliminato D:</p>
          <a href="elencoutenti.php" class="btn btn-primary">Vai all'elenco utenti!</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card dark">
        <div class="card-body ">
          <h5 class="card-title">Convalida ristoranti</h5>
          <p class="card-text-center">Aumenta la scelta! :D</p>
          <a href="adminapprovazione.php" class="btn btn-primary">Approva!</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 ">
      <div class="card dark">
        <div class="card-body ">
          <h5 class="card-title">Gestisci le categorie</h5>
          <p class="card-text-center">Mi raccomando non eliminare le pizze.</p>
          <a href="accedi.php" class="btn btn-primary">Alle categorie!</a>
        </div>
      </div>
    </div>
  </div>
</div>







<!--  <form class=" center-msg-box card card-sm">
    <h1>Bacheca di amministrazione</h1>
    <h2>Cesena Food University</h2>
    <h3>Seleziona un'attività:</h3>
    <div class="card-body row no-gutters align-items-center">
      <div class="col-auto">
          <i class="fas fa-search h4 text-body"></i>
      </div>-->
      <!--end of col-->
  <!--      <div class="col-auto">
          <button class="btn btn-lg btn-success" type="button">Elimina utente</button>
      </div>
      <div class="col-auto">
          <button class="btn btn-lg btn-success" type="button">Aggiungi categoria cibo</button>
      </div>
      <div class="col-auto">
          <button class="btn btn-lg btn-success" type="button">Visualizza utenti</button>
      </div>-->
      <!--end of col-->
  <!--  </div>
  </form> -->

 <!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
