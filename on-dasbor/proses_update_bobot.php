<?php

include "../koneksi.php";

$id = $_POST['id'];
$kode_bobot = $_POST['kode_bobot'];
$jumlah = $_POST['jumlah'];
$keterangan = $_POST['keterangan'];

if($simpan = mysqli_query($connect,"UPDATE bobot SET kode_bobot='$kode_bobot',jumlah='$jumlah',keterangan='$keterangan' WHERE id='$id'")) {
	echo "<script>alert('Berhasil Update Data Bobot');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-kriteria-bobot.php'>";
} else {
	echo "<script>alert('Gagal Update Data Bobot');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-kriteria-bobot.php'>";
}

$connect->close();
exit();

?>