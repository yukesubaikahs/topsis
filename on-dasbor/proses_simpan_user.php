<?php

include "../koneksi.php";

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$hak_akses = $_POST['hak_akses'];

if($simpan = mysqli_query($connect,"INSERT INTO user (nama, username, password, email, hak_akses) VALUES ('$nama','$username','$password','$email','$hak_akses')")) {
	echo "<script>alert('Berhasil Simpan Data User');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-user.php'>";
} else {
	echo "<script>alert('Gagal Simpan Data User');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-user.php'>";
}

$connect->close();
exit();

?>