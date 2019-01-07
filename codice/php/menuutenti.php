
<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
if ( isset( $_SESSION['email'] ) ) {
  ?>

  <li class="nav-item">
    <a class="nav-link" href="homeclienti.php"<?php if($current == 'homeclienti') {echo 'id="current"';} ?>>Home <i class="fa fa-home"></i><span class="sr-only">(current)</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="profiloutente.php"<?php if($current == 'profiloutente') {echo 'id="current"';} ?>>Profilo <?php echo $_SESSION["nome"]; ?> <i class="fa fa-user"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="messaggi.php"<?php if($current == 'messaggi') {echo 'id="current"';} ?>>Messaggi <i class="fa fa-envelope-o"></i> <span id="" class="msg badge badge-primary"></span>
      <span class="sr-only">unread messages</span> </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="visualizzaCarrello.php"<?php if($current == 'carrello') {echo 'id="current"';} ?>>Carrello <i class="fa fa-shopping-cart"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"<?php if($current == 'contatti') {echo 'id="current"';} ?>>Contatti <i class="fa fa-question"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php"<?php if($current == 'logout') {echo 'id="current"';} ?>>Logout <i class="fa fa-sign-out"></i></a>
    </li>
    <?php
  } else {
    ?>
    <li class="nav-item ">
      <a class="nav-link" href="homeclienti.php"<?php if($current == 'homeclienti') {echo 'id="current"';} ?>>Home <i class="fa fa-home"></i><span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="accedi.php" <?php if($current == 'accedi') {echo 'id="current"';} ?>>Accedi <i class="fa fa-user"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="signinutente.php"<?php if($current == 'signinutente') {echo 'id="current"';} ?>>Registrati <i class="fa fa-pencil"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="areafornitori.php"<?php if($current == 'areafornitori') {echo 'id="current"';} ?>>Area Fornitori <i class="fa fa-handshake-o"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"<?php if($current == 'contatti') {echo 'id="current"';} ?>>Contatti <i class="fa fa-question"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="accedi.php">Amministratore <i class="fa fa-unlock-alt"></i></a>
    </li>
    <?php
  }
  ?>
