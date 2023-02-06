<?php

include '../koneksi.php';

$jumlah_data = count($_GET['kode_kriteria']);
$kode_kriteria = $_GET['kode_kriteria'];
$jumlah_bobot = $_GET['jumlah_bobot'];

$simpan = false;

for($i=0;$i<$jumlah_data;$i++) {
	if($sql = mysqli_query($connect, "UPDATE kriteria SET bobot='$jumlah_bobot[$i]' WHERE kode_kriteria='$kode_kriteria[$i]'")) {
		$simpan = true;
	} else {
		$simpan = false;
	}
}

if($simpan) {
	echo "<script>alert('Berhasil Simpan Data Kriteria Terbobot')</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-kriteria-bobot.php'>";
} else {
	echo "<script>alert('Gagal Simpan Data Kriteria Terbobot')</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-kriteria-bobot.php'>";
}

$connect->close();
exit();

?>