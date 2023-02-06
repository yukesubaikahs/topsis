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
	<script src="bootstrap/js/jquery.mask.js"></script>
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
		<h2>Data Karyawan</h2>
		<hr>
		<p>
			<a href='#' class='btn btn-primary glyphicon glyphicon-plus' data-target='#ModalAdd' data-toggle='modal' title='Tambah Data Karyawan'></a>
		</p<p>
			<table id="dataKaryawan" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>No.</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Jenis Kelamin</th>
						<th>No. Telp</th>
						<th>Jabatan</th>
						<th>Gaji Saat Ini</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$getKaryawan = mysqli_query($conn, "select * from karyawan order by nama ASC");
					$i = 1;
					while ($data = mysqli_fetch_array($getKaryawan)) {
						$nik = $data['nik'];
						$nama = $data['nama'];
                        $alamat = $data['alamat'];
                        $jenis_kelamin = $data['jenis_kelamin'];
                        $no_telp = $data['no_telp'];
						$jabatan = $data['jabatan'];
                        $gaji = $data['gaji'];
						?>
						<tr>
							<td class="text-center"><?= $i++; ?></td>
							<td class="text-center"><?= $nik; ?></td>
							<td class="text-center"><?= $nama; ?></td>
							<td class="text-center"><?= $alamat; ?></td>
							<td class="text-center"><?= $jenis_kelamin; ?></td>
							<td class="text-center"><?= $no_telp; ?></td>
							<td class="text-center"><?= $jabatan; ?></td>
							<td class="text-center"><?= $gaji; ?></td>
							<td>
								<button style="margin-right: 20px" type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalEdit<?= $nik; ?>">
								Edit
                        </button>
                        <input type="hidden" name="idbarangygmaudihapus" value="<?= $nik; ?>">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $nik ?>">
                    	Delete</button>
					</td>
				</tr>
<!-- //Modal add karyawan -->
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Data Karyawan</h4>
			</div>
			<div class="modal-body">
				<form name="modal_popup" enctype="multipart/form-data" method="POST">
					<div class="form-group" style="padding-bottom: 20px;">
					<label for="NIK">NIK</label>
					<input type="text" name="nik"  class="form-control" required />
					<span id="alert-error" style="color: red;" class="<?= $alertError ? '' : 'd-none' ?>"><?= $alertError ?></span>
				</div>
				<div class="form-group" style="padding-bottom: 20px;">
				<label for="Nama">Nama</label>
				<input type="text" name="nama"  class="form-control" required />
			</div>
			<div class="form-group" style="padding-bottom: 20px;">
			<label for="Alamat">Alamat</label>
			<textarea type="text" name="alamat"  class="form-control" required></textarea>
		</div>
		<div class="form-group" style="padding-bottom: 20px;">
		<label for="Jenis Kelamin">Jenis Kelamin</label>
		<select name="jenis_kelamin" class="form-control" required>
			<option value="" disabled selected>- Pilih Jenis Kelamin -</option>
			<option value="Pria">Pria</option>
			<option value="Wanita">Wanita</option>
		</select>
</div>
	<div class="form-group" style="padding-bottom: 20px;">
	<label for="No. Telp">No. Telp</label>
	<input type="text" name="no_telp"  class="form-control" required />
</div>
	<div class="form-group" style="padding-bottom: 20px;">
	<label for="Jabatan">Jabatan</label>
	<input type="text" name="jabatan" class="form-control" required />
</div>

	<div class="form-group" style="padding-bottom: 20px;">
	<label for="Gaji">Gaji Saat Ini</label>
	<input type="text" id="gaji" name="gaji" class="form-control" required />
</div>
<div class="modal-footer">
	<button class="btn btn-success" name="addKaryawan" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span>Simpan</button>                
	<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle"></span>Tutup</button>
</div>
</form>
</div>
</div>
</div>
</div>

<!-- //Modal Edit Karyawan -->
<div id="ModalEdit<?= $nik; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title" id="myModalLabel">Edit Data Karyawan</h4>
		</div>

		<div class="modal-body">
			<form name="modal_popup" enctype="multipart/form-data" method="POST">
				<input type="hidden" name='nikLama' value="<?= $nik; ?>">
				<div class="form-group" style="padding-bottom: 20px;">
				<label for="NIK">NIK</label>
				<input type="text" name="nik" value="<?= $nik; ?>" class="form-control" required />
				<!-- <span id="alert-error" style="color: red;" class="<?= $alertError ? '' : 'd-none' ?>"><?= $alertError ?></span> -->
			</div>

			<div class="form-group" style="padding-bottom: 20px;">
			<label for="Nama">Nama</label>
			<input type="text" name="nama" value="<?= $nama; ?>"  class="form-control" required />
		</div>

			<div class="form-group" style="padding-bottom: 20px;">
			<label for="Alamat">Alamat</label>
			<textarea type="text" name="alamat" class="form-control" required><?= $alamat; ?></textarea>
		</div>
			<div class="form-group" style="padding-bottom: 20px;">
			<label for="Jenis Kelamin">Jenis Kelamin</label>
			<select name="jenis_kelamin" class="form-control" required>
				<option value="" disabled selected>- Pilih Jenis Kelamin -</option>
				<?php
				if($jenis_kelamin == "Pria"){
					echo '<option selected value="Pria">Pria</option>';
					echo '<option value="Wanita">Wanita</option>';
				}else{
					echo '<option value="Pria">Pria</option>';
					echo '<option selected value="Wanita">Wanita</option>';
				}
				?>
				</select>
			</div>
			<div class="form-group" style="padding-bottom: 20px;">
			<label for="No. Telp">No. Telp</label>
			<input type="text" name="no_telp" value="<?= $no_telp; ?>"  class="form-control" required />
		</div>
			<div class="form-group" style="padding-bottom: 20px;">
			<label for="Jabatan">Jabatan</label>
			<input type="text" name="jabatan" value="<?= $jabatan; ?>"  class="form-control" required />
		</div>
		
			<div class="form-group" style="padding-bottom: 20px;">
			<label for="Gaji">Gaji Saat Ini</label>
			<input type="text" id="gajiedit" name="gaji" value="<?= $gaji; ?>" class="form-control" required />
			
		</div>

            <div class="modal-footer">
				<button class="btn btn-success" name="updateKaryawan" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span>Update</button>
				<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle"></span> Tutup</button>
			</div>
		</form>
	</div>
</div>
</div>
</div>

<!-- //Modal delete karyawan -->
<div class="modal fade" id="delete<?= $nik ?>">
<div class="modal-dialog">
	<div class="modal-content" style="margin-top:100px;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" style="text-align:center;">Anda Yakin Ingin Menghapus Data Ini?</h4>
	</div>
	<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
	<!-- <a href="#" class="btn btn-primary" id="delete_link"><span class="glyphicon glyphicon-ok-sign"></span> Ya</a> -->
	<form method="post">
		<input type="hidden" name='nik' value="<?= $nik; ?>">
		<button type="submit" class="btn btn-primary" name="hapusKaryawan"><span class="glyphicon glyphicon-ok-sign"></span> Ya</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Tidak</button>
	</form>
</div>
</div>
</div>
</div>
<?php
}?>
</tbody>
</table>
<script>
			$('#gajiedit').mask('000.000.000', {
			reverse: true
		});
	</script>
</p>
</div>
<script>
		$('#gaji').mask('000.000.000', {
			reverse: true
		});
	</script>
</div>
		<footer class="panel-footer text-center" style="margin-top: 2em;">
		<p>Copyright &copy; <?php echo date('Y'); ?> PT APP INTI MEDIA</p>
	</footer>

<?php
if (!empty($alertError)) {
	echo("
	<script type='text/javascript'>
	$('#ModalAdd').modal('show');
</script>
		");
	}
?>
</body>
</html>

