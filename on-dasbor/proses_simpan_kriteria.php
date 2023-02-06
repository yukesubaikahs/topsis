<?php

include "../koneksi.php";

$kode_kriteria = $_POST['kode_kriteria'];
$nama_kriteria = $_POST['nama_kriteria'];
$kategori = $_POST['kategori'];

if($simpan = mysqli_query($connect,"INSERT INTO kriteria (kode_kriteria, nama_kriteria, kategori) VALUES ('$kode_kriteria','$nama_kriteria','$kategori')")) {
	echo "<script>alert('Berhasil Simpan Data Kriteria');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-kriteria-bobot.php'>";
} else {
	echo "<script>alert('Gagal Simpan Data Kriteria');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-kriteria-bobot.php'>";
}

$connect->close();
exit();

?>