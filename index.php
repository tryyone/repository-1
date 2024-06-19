<?php
/*if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}*/
include 'functions.php';
if (empty($_SESSION['login']))
  header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="assets/images/favicon.ico" />

  <title>SPK ELECTREL</title>
  <link href="assets/css/cerulean-bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/general.css" rel="stylesheet" />
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-default static-top ">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">SPK ELECTRE PENILAI KINERJA GURU</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="?m=kriteria">
              <div class="glyphicon glyphicon-book"> Kriteria</div>
            </a></li>
          <li><a href="?m=sub_kriteria">
              <div class="glyphicon glyphicon-th-list"> Sub Kriteria </div>
            </a></li>
          <li><a href="#" class="dropdown" data-toggle="dropdown">
              <div class="glyphicon glyphicon-user"> Alternatif </div><b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><a href="?m=alternatif">Alternatif</a></li>
              <li><a href="?m=rel_alternatif"> Nilai Alternatif</a></li>
            </ul>
          <li><a href="?m=hitung">
              <div class="glyphicon glyphicon-file"> Hitung </div>
            </a></li>
          <li><a href="?m=password">
              <div class="glyphicon glyphicon-sunglasses"> Password</div>
            </a></li>
          <li><a href="aksi.php?act=logout">
              <div class="glyphicon glyphicon-share-alt"> Logout</div>
            </a></li>
          </li>
      </div>
  </nav>
  <div class="container">
    <?php
    if (file_exists($mod . '.php'))
      include $mod . '.php';
    else
      include 'home.php';
    ?>
  </div>
  <footer class="footer bg-primary">
    <div class="container">
      <p>Copyright &copy; Anadea Paramaisela UIN 2015 | <?= date('Y') ?><em class="pull-right"> </em></p>
    </div>
  </footer>

</html>