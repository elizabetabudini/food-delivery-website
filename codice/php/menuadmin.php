
<?php
if ( isset( $_SESSION['email'] ) ) {
  ?>
  <li class="nav-item">
    <a class="nav-link" href="homeadmin.php"<?php if($current == 'homeadmin') {echo 'id="current"';} ?>>Strumenti <i class="fa fa-wrench"></i> <span class="sr-only">(current)</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="messaggi.php"<?php if($current == 'messaggi') {echo 'id="current"';} ?>>Messaggi <i class="fa fa-envelope-o"></i> <span class="msg badge badge-primary"><?php if($_SESSION["unread"]>0) echo $_SESSION["unread"];?></span>
      <span class="sr-only">unread messages</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="logout" href="logout.php"<?php if($current == 'logout') {echo 'id="current"';} ?>>Logout <i class="fa fa-sign-out"></i></a>
    </li>
    <?php
  } else {
    ?>
    <li class="nav-item">
      <a class="nav-link" href="homeclienti.php"<?php if($current == 'homeclienti') {echo 'id="current"';} ?>>Home <i class="fa fa-home"></i>
        <i class="fa fa-home"></i><span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="accedi.php"<?php if($current == 'accedi') {echo 'id="current"';} ?>>Accedi <i class="fa fa-user"></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="signinutente.php"<?php if($current == 'signinutente') {echo 'id="current"';} ?>>Registrati <i class="fa fa-pencil"></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="areafornitori.php"<?php if($current == 'areafornitori') {echo 'id="current"';} ?>>Area Fornitori <i class="fa fa-handshake-o"></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"<?php if($current == 'contatti') {echo 'id="current"';} ?>>Contatti <i class="fa fa-question"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="accedi.php"<?php if($current == 'accedi') {echo 'id="current"';} ?>>Amministratore <i class="fa fa-unlock-alt"></i></a>
    </li>
    <?php
  }
  ?>
