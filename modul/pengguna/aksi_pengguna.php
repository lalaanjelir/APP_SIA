<?php
session_start();
include_once('../../koneksi.php');
if ($_SERVER['REQUEST_METHOD']=='POST') {
    if ($_GET['act']=="insert") {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $nama_lengkap = $_POST['nama_lengkap'];
        $email = $_POST['email'];
        $jabatan = $_POST['jabatan'];
        $hak_akses = $_POST['hak_akses'];
        $query = "INSERT INTO tbl_pengguna (username, password, nama_lengkap, email, jabatan, hak_akses) VALUES ('$username', '$password', '$nama_lengkap', '$email', '$jabatan', '$hak_akses')";
        $exec = mysqli_query($koneksi, $query);
        if ($exec) {
            $_SESSION['pesan'] = "Berhasil menambahkan data";
            header('location:../../dashboard.php?modul=pengguna'); // Kembali ke index.php di folder pengguna
            exit(); // Pastikan untuk keluar setelah pengalihan header
        } else {
            // Tampilkan pesan kesalahan jika gagal menginput data
            $_SESSION['pesan'] = "Gagal menambahkan data";
            header('location:../../dashboard.php?modul=pengguna');
            exit();
        }  
    }elseif ($_GET['act']=="update") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $email = $_POST['email'];
        $jabatan = $_POST['jabatan'];
        $hak_akses = $_POST['hak_akses'];
        if (empty($password)) {
            $query = "UPDATE tbl_pengguna SET username = '$username', nama_lengkap = '$nama_lengkap', email = '$email', jabatan = '$jabatan', hak_akses = '$hak_akses' WHERE username = '$username'";
            $exec = mysqli_query($koneksi, $query);
            if ($exec) {
                $_SESSION['pesan'] = "Berhasil mengubah data";
                header('location:../../dashboard.php?modul=pengguna');
                exit();
            }else {
                $_SESSION['pesan'] = "Gagal mengubah data";
                header('location:../../dashboard.php?modul=pengguna');
                exit();
            }
        }else {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $query = "UPDATE tbl_pengguna SET username = '$username', password = '$password', nama_lengkap = '$nama_lengkap', email = '$email', jabatan = '$jabatan', hak_akses = '$hak_akses' WHERE username = '$username'";
            $exec = mysqli_query($koneksi, $query);
            if ($exec) {
                $_SESSION['pesan'] = "Berhasil mengubah data dan password";
                header('location:../../dashboard.php?modul=pengguna');
                exit();
            }else {
                $_SESSION['pesan'] = "Gagal mengubah data";
                header('location:../../dashboard.php?modul=pengguna');
                exit();
            }
        }
    }
}elseif ($_GET['act']=="delete") {
    $id = $_GET['id'];
    // Query untuk menghapus data
    $query = "DELETE FROM tbl_pengguna WHERE user_id = '$id'";
    $exec = mysqli_query($koneksi, $query);
    if ($exec) {
        header('location:../../dashboard.php?modul=pengguna'); // Kembali ke index.php di folder pengguna
        exit;
    } else {
        $_SESSION['pesan'] = "Gagal menghapus data";
        header('location:../../dashboard.php?modul=pengguna');
        exit();
    }
}
?>