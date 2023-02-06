<?php

include "../koneksi.php";

$id = $_GET['id'];

if($hapus = mysqli_query($connect,"DELETE FROM karyawan where id='$id'")) {
	echo "<script>alert('Berhasil Hapus Data karyawan');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-guru.php'>";
} else {
	echo "<script>alert('Gagal Hapus Data karyawan');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-guru.php'>";
}

$connect->close();
exit();

?>