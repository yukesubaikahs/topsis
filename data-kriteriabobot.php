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
	<div class="col-md-12">
		<h2>Data Kriteria dan Bobot</h2>
		<hr>
		<p>
			<a href='#' class='btn btn-primary glyphicon glyphicon-plus' data-target='#ModalAdd' data-toggle='modal' title='Tambah Data Kriteria'></a>
		</p>
		<p>
			<table id="dataKriteriabobot" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode</th>
						<th>Nama Kriteria</th>
						<th>Atribut</th>
						<th>Bobot Nilai</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$getKriteria = mysqli_query($conn, "select * from kriteria order by kodekriteria ASC");
					$i = 1;
					while ($data = mysqli_fetch_array($getKriteria)) {
						$kodekriteria = $data['kodekriteria'];
						$namakriteria = $data['namakriteria'];
                        $atribut = $data['atribut'];
                        $bobotnilai = $data['bobotnilai'];
						?>
						<tr>
							<td class="text-center"><?= $i++; ?></td>
							<td class="text-center"><?= $kodekriteria; ?></td>
							<td class="text-center"><?= $namakriteria; ?></td>
							<td class="text-center"><?= $atribut; ?></td>
							<td class="text-center"><?= $bobotnilai; ?>%</td>
							<td style="display: flex; justify-content: center;">
							<button style="margin-right: 15px" type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalEdit<?= $kodekriteria; ?>">
							Edit</button>
							<input type="hidden" name="kodekriteria" value="<?= $kodekriteria; ?>">
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $kodekriteria ?>">
							Delete</button>
						</td>
					</tr>

				
<!-- //modal add kriteria -->
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Data Kriteria</h4>
			</div>
			<div class="modal-body">
				<form name="modal_popup" enctype="multipart/form-data" method="POST">
					<div class="form-group" style="padding-bottom: 20px;">
					<label for="KodeKriteria">Kode Kriteria</label>
					<input type="text" name="kodekriteria"  class="form-control" required />
				</div>
				<div class="form-group" style="padding-bottom: 20px;">
				<label for="NamaKriteria">Nama Kriteria</label>
				<input type="text" name="namakriteria"  class="form-control" required />
			</div>
			<div class="form-group" style="padding-bottom: 20px;">
			<label for="Atribut">Atribut</label>
			<select name="atribut" class="form-control" required>
			<option value="" selected>- Pilih Atribut -</option>
			<option value="Cost">Cost</option>
			<option value="Benefit">Benefit</option>
			</select>

		</div>
		<div class="form-group" style="padding-bottom: 20px;">
		<label for="BobotNilai">Bobot Nilai</label>
		<select name="bobotnilai" class="form-control" required>
			<option value="" disabled selected>- Pilih Nilai Bobot -</option>
			<option value="5">5%</option>
			<option value="10">10%</option>
			<option value="15">15%</option>
			<option value="20">20%</option>
			<option value="25">25%</option>
			<option value="30">30%</option>
		</select>
	</div>
	<div class="modal-footer">
		<button class="btn btn-success" name="addKriteria" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
		<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle"></span> Tutup</button>
	</div>
</form>
</div>
</div>
</div>
</div>


<!-- //Modal edit kriteria -->
<div id="ModalEdit<?= $kodekriteria; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title" id="myModalLabel">Edit Data Kriteria</h4>
		</div>
		<div class="modal-body">
			<form name="modal_popup" enctype="multipart/form-data" method="POST">
				<input type="hidden" name='kodekriteria' value="<?= $kodekriteria; ?>">
				<div class="form-group" style="padding-bottom: 20px;">
				<label for="KodeKriteria">Kode Kriteria</label>
				<input type="text" name="kodekriteria" disabled value="<?= $kodekriteria; ?>" class="form-control" required />
			</div>
			<div class="form-group" style="padding-bottom: 20px;">
			<label for="NamaKriteria">Nama Kriteria</label>
			<input type="text" name="namakriteria" value="<?= $namakriteria; ?>"  class="form-control" required />
		</div>
		<div class="form-group" style="padding-bottom: 20px;">
		<label for="Atribut">Atribut</label>
		<select name="atribut" class="form-control" required>
		<option value="" disabled selected>- Pilih Atribut -</option>
		<?php
		if($atribut == "Cost"){
			echo '<option selected value="Cost">Cost</option>';
			echo '<option value="Benefit">Benefit</option>';
		}else if($atribut == "Benefit"){
			echo '<option value="Cost">Cost</option>';
			echo '<option selected value="Benefit">Benefit</option>';
		}
		?>
		</select>
	</div>
	<div class="form-group" style="padding-bottom: 20px;">
	<label for="BobotNilai">Bobot Nilai</label>
	<select name="bobotnilai" class="form-control" required>
		<option value="" disabled selected>- Pilih Bobot Nilai -</option>
		<?php
		if($bobotnilai == "5"){
			echo '<option selected value="5">5%</option>';
			echo '<option value="10">10%</option>';
			echo '<option value="15">15%</option>';
			echo '<option value="20">20%</option>';
			echo '<option value="25">25%</option>';
			echo '<option value="30">30%</option>';
		}else if($bobotnilai == "10"){
			echo '<option value="5">5%</option>';
			echo '<option selected value="10">10%</option>';
			echo '<option value="15">15%</option>';
			echo '<option value="20">20%</option>';
			echo '<option value="25">25%</option>';
			echo '<option value="30">30%</option>';
		}else if($bobotnilai == "15"){
			echo '<option value="5">5%</option>';
			echo '<option value="10">10%</option>';
			echo '<option selected value="15">15%</option>';
			echo '<option value="20">20%</option>';
			echo '<option value="25">25%</option>';
			echo '<option value="30">30%</option>';
		}else if($bobotnilai == "20"){
			echo '<option value="5">5%</option>';
			echo '<option value="10">10%</option>';
			echo '<option value="15">15%</option>';
			echo '<option selected value="20">20%</option>';
			echo '<option value="25">25%</option>';
			echo '<option value="30">30%</option>';
		}else if($bobotnilai == "25"){
			echo '<option value="5">5%</option>';
			echo '<option value="10">10%</option>';
			echo '<option value="15">15%</option>';
			echo '<option value="20">20%</option>';
			echo '<option selected value="25">25%</option>';
			echo '<option value="30">30%</option>';
		}else if($bobotnilai == "30"){
			echo '<option value="5">5%</option>';
			echo '<option value="10">10%</option>';
			echo '<option value="15">15%</option>';
			echo '<option value="20">20%</option>';
			echo '<option value="25">25%</option>';
			echo '<option selected value="30">30%</option>';
		}
		?>
		</select>
	</div>
	<div class="modal-footer">
		<button class="btn btn-success" name="updateKriteria" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span>Update</button>
		<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle"></span>Tutup</button>
	</div>
</form>
</div>
</div>
</div>
</div>

<!-- //Modal delete kriteria -->
<div class="modal fade" id="delete<?= $kodekriteria ?>">
<div class="modal-dialog">
	<div class="modal-content" style="margin-top:100px;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" style="text-align:center;">Anda Yakin Ingin Menghapus Data Ini?</h4>
	</div>
	<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
	<!-- <a href="#" class="btn btn-primary" id="delete_link"><span class="glyphicon glyphicon-ok-sign"></span> Ya</a> -->
	<form method="post">
		<input type="hidden" name='kodekriteria' value="<?= $kodekriteria; ?>">
		<button type="submit" class="btn btn-primary" name="hapusKriteria"><span class="glyphicon glyphicon-ok-sign"></span> Ya</button>
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