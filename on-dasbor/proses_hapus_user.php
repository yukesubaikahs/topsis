<?php

include "../koneksi.php";

$id = $_GET['id'];

if($hapus = mysqli_query($connect,"DELETE FROM user where id='$id'")) {
	echo "<script>alert('Berhasil Hapus Data User');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-user.php'>";
} else {
	echo "<script>alert('Gagal Hapus Data User');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-user.php'>";
}

$connect->close();
exit();

?>