<?php
include_once "koneksi.php";
$password = password_hash('123', PASSWORD_BCRYPT);
$query = "INSERT INTO tbl_pengguna (
    username,
    password,
    nama_lengkap,
    email,
    jabatan,
    hak_akses
    )
    VALUES (
        'pimpinan',
        '$password',
        'pimpinan',
        'pimpinan@gmail.com',
        'pimpinan',
        'pimpinan'
        )
        ";
        if($koneksi->query($query)){
            echo "Data user berhasil di tambah";
        }else{
            echo "Data user gagal di tambah";
        }
        mysqli_close($koneksi);
        ?>