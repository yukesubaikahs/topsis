<?php
require 'function.php';
?>
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
			<li><a href="home.php">Beranda</a></li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Master Data <span class="caret"></span></a>
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
	<div class="col-md-12">
		<h2>Data Indikator Penilaian</h2>
		<hr>
		<p>
			<a href='#' class='btn btn-primary glyphicon glyphicon-plus' data-target='#ModalAdd' data-toggle='modal' title='Tambah Data Indikator Kriteria'></a></p>
			<p>
				<table id="dataIndikator" class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>Kode Kriteria</th>
							<th>Nama Indikator</th>
							<th>Rating Nilai</th>
							<th>Keterangan Indikator</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$getIndikator = mysqli_query($conn, "select * from indikator");
						$i = 1;
						while ($data = mysqli_fetch_array($getIndikator)) {
							$idkodeindikator = $data['idkodeindikator'];	
							$kodekriteria = $data['kodekriteria'];
							$namaindikator = $data['namaindikator'];
							$ratingnilai = $data['ratingnilai'];
							$keteranganindikator = $data['keteranganindikator'];
							?>
						<tr>
							<td class="text-center"><?= $i++; ?></td>
							<td class="text-center"><?= $kodekriteria; ?></td>
							<td class="text-center"><?= $namaindikator; ?></td>
							<td class="text-center" style="width: 10%"><?= $ratingnilai; ?></td>
							<td class="text-center" style="width: 35%"><?= $keteranganindikator; ?></td>
							<td style="display: flex; justify-content: center;">
							<button style="margin-right: 15px" type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalEdit<?= $idkodeindikator; ?>">
							Edit
						</button>
						<input type="hidden" name="idkodeindikator" value="<?= $idkodeindikator; ?>">
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $kodekriteria ?>">
						Delete
					</button>
				</td>
			</tr>

<!-- //Modal add indikator -->
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Data Indikator Kriteria</h4>
			</div>
			<div class="modal-body">
				<form name="modal_popup" enctype="multipart/form-data" method="POST">
					<div class="form-group" style="padding-bottom: 20px;">
					<label for="kodekriteria">Kode Kriteria</label>
					<input type="text" name="kodekriteria" class="form-control" required />
				</div>
				<div class="form-group" style="padding-bottom: 20px;">
				<label for="Namaindikator">Nama Indikator</label>
				<input type="text" name="namaindikator"  class="form-control" required />
			</div>
			<div class="form-group" style="padding-bottom: 20px;">
			<label for="keterangan5">Keterangan Indikator 5</label>
			<textarea type="text" name="keterangan5" class="form-control" required></textarea>
		</div>
		<div class="form-group" style="padding-bottom: 20px;">
		<label for="keterangan4">Keterangan Indikator 4</label>
		<textarea type="text" name="keterangan4" class="form-control" required></textarea>
	</div>
	<div class="form-group" style="padding-bottom: 20px;">
	<label for="keterangan3">Keterangan Indikator 3</label>
	<textarea type="text" name="keterangan3" class="form-control" required></textarea>
</div>
<div class="form-group" style="padding-bottom: 20px;">
<label for="keterangan2">Keterangan Indikator 2</label>
<textarea type="text" name="keterangan2" class="form-control" required></textarea>
</div>
<div class="form-group" style="padding-bottom: 20px;">
<label for="keterangan1">Keterangan Indikator 1</label>
<textarea type="text" name="keterangan1" class="form-control" required></textarea>
</div>
<div class="modal-footer">
	<button class="btn btn-success" name="addIndikator" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span>Simpan</button>                
	<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle"></span> Tutup</button>
</div>
</form>
</div>
</div>
</div>
</div>

<!-- //Modal edit indikator -->
<div id="ModalEdit<?= $idkodeindikator; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title" id="myModalLabel">Edit Data Indikator Kriteria</h4>
		</div>
		<div class="modal-body">
			<form name="modal_popup" enctype="multipart/form-data" method="POST">
				<input type="hidden" name='idkodeindikator' value="<?= $idkodeindikator; ?>">
				<div class="form-group" style="padding-bottom: 20px;">
				<label for="kodekriteria">Kode Kriteria</label>
				<input type="text" name="kodekriteria" disabled value="<?= $kodekriteria; ?>" class="form-control" required />
			</div>
			<div class="form-group" style="padding-bottom: 20px;">
			<label for="Namaindikator">Nama Indikator</label>
			<input type="text" name="namaindikator" disabled value="<?= $namaindikator; ?>"  class="form-control" required />
		</div>
		<div class="form-group" style="padding-bottom: 20px;">
		<label for="Keteranganindikator">Keterangan Indikator</label>
		<textarea type="text" name="keteranganindikator" class="form-control" required><?= $keteranganindikator; ?></textarea>
	</div>
	<div class="modal-footer">
		<button class="btn btn-success" name="updateIndikator" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Update</button>
		<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle"></span> Tutup</button>
	</div>
</form>
</div>
</div>
</div>
</div>

<!-- //Modal delete indikator -->
<div class="modal fade" id="delete<?= $kodekriteria ?>">
<div class="modal-dialog">
	<div class="modal-content" style="margin-top:100px;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" style="text-align:center;">Anda Yakin Ingin Menghapus Data Ini?</h4>
		<h5 class="modal-title" style="text-align:center;">Jika anda menghapus 1 indikator, maka semua data keterangan indikator tersebut akan terhapus.</h5>
	</div>
	<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
	<!-- <a href="#" class="btn btn-primary" id="delete_link"><span class="glyphicon glyphicon-ok-sign"></span> Ya</a> -->
	<form method="post">
		<input type="hidden" name='kodekriteria' value="<?= $kodekriteria; ?>">
		<button type="submit" class="btn btn-primary" name="hapusIndikator"><span class="glyphicon glyphicon-ok-sign"></span> Ya</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Tidak</button>
	</form>
</div>
</div>
</div>
</div>
<?php
}
?>
</tbody>
</table>
</p>
</div>
</div>
<footer class="panel-footer text-center" style="margin-top: 2em;">
<p>Copyright &copy; <?php echo date('Y'); ?> PT APP INTI MEDIA</p>
</footer>
</body>
</html>

