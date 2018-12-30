<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Home</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/home.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
    <?php include 'menu.php';
    var_dump($_SESSION)?>
    <div class="row h-100 justify-content-center align-items-center ">
        <div class="col-12 col-md-10 col-lg-8 ">
          <form class="card card-sm center-msg-box">
            <h1>CFU</h1>
            <h2>Cesena Food University</h2>
            <h3>Their food at your university</h3>
            <div class="card-body row no-gutters align-items-center">
              <div class="col-auto">
                  <i class="fas fa-search h4 text-body"></i>
              </div>
              <!--end of col-->
              <div class="col">
                  <input class="form-control form-control-lg form-control-borderless" type="search" autofocus="on" placeholder="Aula 2.2, Laboratorio 3.3, Studio 4.2 ...">
              </div>
              <!--end of col-->
              <div class="col-auto">
                  <button class="btn btn-lg btn-success" type="submit">Cerca</button>
              </div>
              <!--end of col-->
            </div>
          </form>
        </div>
        <!--end of col-->
    </div>

<!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./../js/bootstrap.min.js"></script>
  </body>
</html>
