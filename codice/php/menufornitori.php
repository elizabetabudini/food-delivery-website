
<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
if ( isset( $_SESSION['email'] ) ) {
  ?>
  <li class="nav-item">
    <a class="nav-link" href="strumenti.php"<?php if($current == 'strumenti') {echo 'id="current"';} ?>>Strumenti <i class="fa fa-wrench"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="profilofornitore.php"<?php if($current == 'profilofornitore') {echo 'id="current"';} ?>>Profilo <?php echo $_SESSION["nome"]; ?> <i class="fa fa-user"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="messaggi.php"<?php if($current == 'messaggi') {echo 'id="current"';} ?>>Messaggi <i class="fa fa-envelope-o"></i> <span class="msg badge badge-primary"><?php if($_SESSION["unread"]>0) echo $_SESSION["unread"];?></span>
      <span class="sr-only">unread messages</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="contatti.php"<?php if($current == 'contatti') {echo 'id="current"';} ?>>Contatti <i class="fa fa-question"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php"<?php if($current == 'logout') {echo 'id="current"';} ?>>Logout <i class="fa fa-sign-out"></i></a>
    </li>
    <?php
  } else {
    ?>
    <li class="nav-item">
      <a class="nav-link" href="areafornitori.php"<?php if($current == 'areafornitori') {echo 'id="current"';} ?>>Home <i class="fa fa-home"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="accedi.php"<?php if($current == 'accedi') {echo 'id="current"';} ?>>Accedi <i class="fa fa-user"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="signinfornitore.php"<?php if($current == 'signinfornitore') {echo 'id="current"';} ?>>Registra ristorante <i class="fa fa-pencil"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="homeclienti.php"<?php if($current == 'homeclienti') {echo 'id="current"';} ?>>Area Clienti <i class="fa fa-spoon"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="contatti.php"<?php if($current == 'contatti') {echo 'id="current"';} ?>>Contatti <i class="fa fa-question"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="accedi.php">Amministratore <i class="fa fa-unlock-alt"></i></a>
    </li>
    <?php
  }
  ?>
