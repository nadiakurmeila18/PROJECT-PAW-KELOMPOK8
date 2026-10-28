<?php
$host = "localhost";
$user = "root";
$pass = "";

// 1. Hubungkan ke MySQL tanpa memilih database dulu
$koneksi_awal = mysqli_connect($host, $user, $pass);

// 2. Buat database secara otomatis jika belum ada
$sql_create_db = "CREATE DATABASE IF NOT EXISTS db_paw_kelompok";
mysqli_query($koneksi_awal, $sql_create_db);

// 3. Sekarang hubungkan ke database yang sudah dibuat
$db   = "db_paw_kelompok";
$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
echo "Koneksi ke database berhasil (Database otomatis dibuat jika belum ada)!";
?>