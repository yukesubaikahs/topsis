<?php

include "../koneksi.php";

$id = $_POST['id'];
$nip = $_POST['nip'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$no_telp = $_POST['no_telp'];

if($simpan = mysqli_query($connect,"UPDATE karyawan SET nip='$nip',nama='$nama',alamat='$alamat',jenis_kelamin='$jenis_kelamin',no_telp='$no_telp' WHERE id='$id'")) {
	echo "<script>alert('Berhasil Update Data karyawan');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-karyawan.php'>";
} else {
	echo "<script>alert('Gagal Update Data karyawan');</script>";
	echo "<meta http-equiv='refresh' content='0; url=data-karyawan.php'>";
}

$connect->close();
exit();

?>