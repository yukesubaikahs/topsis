<?php

include "../koneksi.php";

$kode_bobot = $_POST['kode_bobot'];
$jumlah = $_POST['jumlah'];
$keterangan = $_POST['keterangan'];

if($simpan = mysqli_query($connect,"INSERT INTO bobot (kode_bobot, jumlah, keterangan) VALUES ('$kode_bobot','$jumlah','$keterangan')")) {
	echo "<script>alert('Berhasil Simpan Data Bobot');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-kriteria-bobot.php'>";
} else {
	echo "<script>alert('Gagal Simpan Data Bobot');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-kriteria-bobot.php'>";
}

$connect->close();
exit();

?>