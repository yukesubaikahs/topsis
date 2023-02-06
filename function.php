<?php
session_start();

//koneksi
$conn = mysqli_connect("localhost", "root", "", "apptopsis1");
$alertError = "";

// //add karyawan
if (isset($_POST['addKaryawan'])) {
    $nik = $_POST['nik']; 
    if (strlen($nik) != 16) {
        $alertError = "<strong> Harap Masukkan NIK 16 Digit! </strong>";
    }
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_telp = $_POST['no_telp'];
    $jabatan = $_POST['jabatan'];
    $gaji = $_POST['gaji'];
    
    if (empty($alertError)) {
        $addtotable = mysqli_query($conn, "insert into karyawan(nik, nama, alamat, jenis_kelamin, no_telp, jabatan, gaji) VALUES('$nik','$nama','$alamat','$jenis_kelamin','$no_telp','$jabatan','$gaji')");
        if ($addtotable) {
            header('location:data-karyawan.php');
        }else{
            header('location:data-karyawan.php');
        }
    }
};

// //edit karyawan
if (isset($_POST['updateKaryawan'])) {
    $nikLama = $_POST['nikLama'];
    // if (strlen($nik) != 16) {
    //     $alertError = "<strong> Harap Masukkan NIK 16 Digit! </strong>";
    // }
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_telp = $_POST['no_telp'];
    $jabatan = $_POST['jabatan'];
    $gaji = $_POST['gaji'];

    // if (empty($alertError)) {
    $update = mysqli_query($conn, "update karyawan set nik='$nik', nama='$nama', alamat='$alamat', jenis_kelamin='$jenis_kelamin', no_telp='$no_telp', jabatan='$jabatan', gaji='$gaji' where nik='$nikLama'");
    if ($update) {
        header('location:data-karyawan.php');
    } else {
        echo 'Gagal';
        header('location:data-karyawan.php');
}
}

//delete karyawan
if (isset($_POST['hapusKaryawan'])) {
    $nik = $_POST['nik'];
    $hapus = mysqli_query($conn, "delete from karyawan where nik='$nik'");
    if ($hapus) {
        header('location:data-karyawan.php');
    } else {
        echo 'Gagal';
        header('location:data-karyawan.php');
    }
}

//add kriteria
if (isset($_POST['addKriteria'])) {
    $kodekriteria = $_POST['kodekriteria'];
    $namakriteria = $_POST['namakriteria'];
    $atribut = $_POST['atribut'];
    $bobotnilai = $_POST['bobotnilai'];

    $addtotable = mysqli_query($conn, "insert into kriteria (kodekriteria, namakriteria, atribut, bobotnilai) values('$kodekriteria','$namakriteria','$atribut','$bobotnilai')");
    if ($addtotable) {
        header('location:data-kriteriabobot.php');
    }else{
        echo 'Gagal';
        header('location:data-kriteriabobot.php');
    }
};

//edit kriteria
if (isset($_POST['updateKriteria'])) {
    $kodekriteria = $_POST['kodekriteria'];
    $namakriteria = $_POST['namakriteria'];
    $atribut = $_POST['atribut'];
    $bobotnilai = $_POST['bobotnilai'];

    $update = mysqli_query($conn, "update kriteria set kodekriteria='$kodekriteria', namakriteria='$namakriteria', atribut='$atribut', bobotnilai='$bobotnilai' where kodekriteria='$kodekriteria'");
    if ($update) {
        header('location:data-kriteriabobot.php');
    }else{
        echo 'Gagal';
        header('location:data-kriteriabobot.php');
    }
}

//delete kriteria
if (isset($_POST['hapusKriteria'])) {
    $kodekriteria = $_POST['kodekriteria'];

    $hapus = mysqli_query($conn, "delete from kriteria where kodekriteria='$kodekriteria'");
    if ($hapus) {
        header('location:data-kriteriabobot.php');
    }else{
        echo 'Gagal';
        header('location:data-kriteriabobot.php');
    }
}

//add indikator
if (isset($_POST['addIndikator'])) {
    $kodekriteria = $_POST['kodekriteria'];
    $namaindikator = $_POST['namaindikator'];
    $keteranganindikator5 = $_POST['keterangan5'];
    $keteranganindikator4 = $_POST['keterangan4'];
    $keteranganindikator3 = $_POST['keterangan3'];
    $keteranganindikator2 = $_POST['keterangan2'];
    $keteranganindikator1 = $_POST['keterangan1'];

    $addtotable5 = mysqli_query($conn, "insert into indikator (kodekriteria, namaindikator, ratingnilai, keteranganindikator) values('$kodekriteria','$namaindikator',5,'$keteranganindikator5')");
    $addtotable4 = mysqli_query($conn, "insert into indikator (kodekriteria, namaindikator, ratingnilai, keteranganindikator) values('$kodekriteria','$namaindikator',4,'$keteranganindikator4')");
    $addtotable3 = mysqli_query($conn, "insert into indikator (kodekriteria, namaindikator, ratingnilai,  keteranganindikator) values('$kodekriteria','$namaindikator',3,'$keteranganindikator3')");
    $addtotable2 = mysqli_query($conn, "insert into indikator (kodekriteria, namaindikator, ratingnilai, keteranganindikator) values('$kodekriteria','$namaindikator',2,'$keteranganindikator2')");
    $addtotable1 = mysqli_query($conn, "insert into indikator (kodekriteria, namaindikator, ratingnilai, keteranganindikator) values('$kodekriteria','$namaindikator',1,'$keteranganindikator1')");

    if ($addtotable5 && $addtotable4 && $addtotable3 && $addtotable2 && $addtotable1) {
        header('location:data-indikatorpenilaian.php');
    } else {
        echo 'Gagal';
        header('location:data-indikatorpenilaian.php');
    }
};

//edit indikator
if (isset($_POST['updateIndikator'])) {
    $idkodeindikator = $_POST['idkodeindikator'];
    $kodekriteria = $_POST['kodekriteria'];
    $namaindikator = $_POST['namaindikator'];
    $keteranganindikator = $_POST['keteranganindikator'];

    $update = mysqli_query($conn, "update indikator set keteranganindikator='$keteranganindikator' where idkodeindikator='$idkodeindikator'");
    if ($update) {
        header('location:data-indikatorpenilaian.php');
    } else {
        echo 'Gagal';
        header('location:data-indikatorpenilaian.php');
    }
}

//delete indikator
if (isset($_POST['hapusIndikator'])) {
    $kodekriteria = $_POST['kodekriteria'];

    $hapus = mysqli_query($conn, "delete from indikator where kodekriteria='$kodekriteria'");
    if ($hapus) {
        header('location:data-indikatorpenilaian.php');
    } else {
        echo 'Gagal';
        header('location:data-indikatorpenilaian.php');
    }
}