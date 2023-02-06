<?php
session_start();
require 'koneksi.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
 
 
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
 
    $query = mysqli_query($connect,$sql);
 
    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['hak_akses'] = $row['hak_akses'];

        echo "<script>alert('Berhasil Login');</script>";
        echo "<meta http-equiv='refresh' content='0; url=on-dasbor'>"; 
    } else {
        echo "<script>alert('Username & Password Salah'); window.location.href='index.php'</script>";
    }
    $connect->close();
    exit();
}

?>