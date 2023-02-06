<!doctype html>
<html lang="en">
<head>
  <title>Sistem Penilaian Kinerja Karyawan</title>
  <meta content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport"/>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
  <link rel="stylesheet" href="datatables/dataTables.bootstrap.css"/>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
  <script src="datatables/jquery.dataTables.js"></script>
  <script src="datatables/dataTables.bootstrap.js"></script>
</head>
<body style="font-family: Poppins">


<section id="banner">
  <div class="inner"> 
  <img src="img/logoapp.png" alt="" style="width: 100px">
    <h2 style="color: #444444;">SISTEM PENILAIAN KINERJA - PT APP INTI MEDIA</h2>
    </div>
</section>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav navbar-center">
      <li><a href="#">Beranda</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Master Data<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="data-karyawan.php">Data Karyawan</a></li>
          <li><a href="data-kriteriabobot.php">Data Kriteria & Bobot</a></li>
          <li><a href="data-indikatorpenilaian.php">Data Indikator Penilaian</a></li>
        </ul> 
      </li>
	  <li><a href="penilaian-topsis.php">Penilaian TOPSIS</a></li>
	  <li><a href="hasil-penilaian.php">Hasil Penilaian</a></li>
		<li><a href="laporan-hasil.php">Laporan Hasil Penilaian</a></li>
	  </ul>
  </div>
</nav>

    <div class="container">    

			<div class="col-md-12 text-center">
				<h2>Selamat Datang</h2>
				<hr>
				<p>Sistem penilaian kinerja karyawan ini merupakan sistem yang digunakan untuk membantu 
					PT App Inti Media dalam melakukan penilaian kinerja karyawan untuk kenaikan gaji dengan metode yang 
					digunakan yaitu <i>Technique for Order Preference by Similarity 
					to Ideal Solution</i> (TOPSIS).</p>

				<p>Metode TOPSIS ini merupakan suatu metode untuk mencari solusi ideal berdasarkan nilai 
					preferensi. Sistem Pendukung keputusan dengan metode TOPSIS ini diharapkan dapat membantu 
					dalam penilaian kinerja karyawan Terbaik pada PT App Inti Media.</p>

                <h3>Visi Perusahaan</h3>
				<hr>
				<p>Menjadi perusahaan terbuka berskala nasional terkemuka yang dikenal sebagaimitra yang dapat menyediakan solusi teknologi informasi terbaik untuk masyarakat Indonesia pada umumnya dan perusahaan-perusahaan pada khususnya.</p>
			
                <h3>Misi Perusahaan</h3>
				<hr>
				<p>
                    1. Mengutamakan profesionalisme dan kompetensi tim untuk menghasilkan sistem terintegrasi antara satu dengan lainnya yang dapat membantu mengurangi permasalahan dan dapat meningkatkan pertumbuhan laba pelanggan kami.<br>
                    2. Menjalin kerja sama dengan business partner dalam mendistribusikan produk unggulan maupun solusi teknologi informasi.<br>
                    3. Mengubah tantangan teknologi informasi menjadi peluang dan solusi bermanfaat untuk masyarakat pada umumnya dan untuk perusahaan-perusahaan pada khususnya.<br>
                </p>	
            </div>
</div>
            <footer class="panel-footer text-center" style="margin-top: 2em;">
	<p>Copyright &copy; <?php echo date('Y'); ?> PT APP INTI MEDIA</p>

</footer>

</body>
</html>

