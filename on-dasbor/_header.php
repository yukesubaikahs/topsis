<?php

session_start();
require '../koneksi.php';

if($_SESSION['username'] == '' ||$_SESSION['username'] == NULL) {
  header('location:../index.php');
}

?>

<!doctype html>
<html lang="en">
<head>
  <title>Sistem Pemilihan Karyawan Terbaik</title>
  <meta content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport"/>
  <meta content="Yuke" name="author"/>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
  <link rel="stylesheet" href="../datatables/dataTables.bootstrap.css"/>
  <script src="../js/jquery-1.11.2.min.js"></script>
  <script src="../bootstrap/js/bootstrap.js"></script>
  <script src="../datatables/jquery.dataTables.js"></script>
  <script src="../datatables/dataTables.bootstrap.js"></script>
  <script type="text/javascript">
    var timer = null;
    function move() {
      window.location = 'hasil-penilaian.php';
    }
  </script>
</head>
<body>

<section id="banner">
  <div class="inner">
    <!-- <h4 style="color: #6d718e;">YAYASAN PENGEMBANGAN SAIN DAN TEKNOLOGI PUSTEK</h4> -->
    <h2 style="color: #6d718e;">PT APP INTI MEDIA</h2>
    <p style="color: #6d718e; font-size: 18px;">Green Lake City Ruko Food City No.23 Duri Kosambi, Kecamatan Cengkareng, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11750, Indonesia</p>
  </div>
</section>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php">Beranda</a></li>
      <li class="dropdown">
      <?php if($_SESSION['hak_akses'] == 'Admin') { ?>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Master Data <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="data-karyawan.php">Data Karyawan</a></li>
          <li><a href="data-kriteria-bobot.php">Data Kriteria & Bobot</a></li>
          <li><a href="data-user.php">Data Users</a></li>
        </ul> 
      </li>
	  <li><a href="penilaian-topsis.php">Penilaian TOPSIS</a></li>
	  <li><a href="hasil-penilaian.php">Hasil Penilaian</a></li>
      <?php } elseif($_SESSION['hak_akses'] == 'User') { ?>
		<li><a href="laporan-hasil.php">Hasil Penilaian</a></li>
	  <?php } ?>
	  
      <li><a href="check-logout.php" title="Logout"><?php echo "".$_SESSION['nama']." (".$_SESSION['hak_akses'].")"; ?> <span class="glyphicon glyphicon-log-out"></span></a></li>  
    </ul>
  </div>
</nav>
    
    <div class="container">     
      