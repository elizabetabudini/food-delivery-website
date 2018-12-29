<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Accedi</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../../css/bootstrap.min.css">

    <link href="./../../css/form.css" rel="stylesheet">
    <link href="./../../css/full.css" rel="stylesheet">
    <link href="./../../css/admin.css" rel="stylesheet">
    <link href="./../../css/menubar.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php include '../menu.php'; ?>

  <div class="card card-sm center-msg-box ">
      <h3 class="title text-center">Ecco i ristoranti che non hanno ancora ricevuto l'approvazione</h3>
    <!-- parte in php dove va messo la query che restituisce tutti i ristoranti in attesa di conferma-->
    <div class="row">
      <div class="card card-sm center-msg-box transparent col-sm-8">
        <p>Lorem ipsum dolor sit amet, consectetur adipisic culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      <div class="card card-sm center-msg-box transparent col-sm-4">
          <a href="#" class="btn btn-primary">Approva!</a>">
          <a href="#" class="btn btn-primary">Elimina!</a>">
      </div>
    </div>
    <div class="row">
      <div class="card card-sm center-msg-box transparent col-sm-8">
        <p>Lorem ipsum dolor sit amet, consectetur adipisic culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      <div class="card card-sm center-msg-box transparent col-sm-4">
          <a href="#" class="btn btn-primary">Approva!</a>">
          <a href="#" class="btn btn-primary">Elimina!</a>">
      </div>
    </div>
  </div>







  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../../js/bootstrap.min.js"></script>
  </body>
</html>
