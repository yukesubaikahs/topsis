<?php

include "../koneksi.php";

$id = $_POST['id'];
$kode_kriteria = $_POST['kode_kriteria'];
$nama_kriteria = $_POST['nama_kriteria'];
$kategori = $_POST['kategori'];

if($simpan = mysqli_query($connect,"UPDATE kriteria SET kode_kriteria='$kode_kriteria',nama_kriteria='$nama_kriteria',kategori='$kategori' WHERE id='$id'")) {
	echo "<script>alert('Berhasil Update Data Kriteria');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-kriteria-bobot.php'>";
} else {
	echo "<script>alert('Gagal Update Data Kriteria');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-kriteria-bobot.php'>";
}

$connect->close();
exit();

?>