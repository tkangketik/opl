<?php
$koneksi = new mysqli("localhost","root","","oplbaru");

$ambil = $koneksi->query("SELECT * FROM biohewan WHERE id_hewan = '$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM biohewan WHERE id_hewan = '$_GET[id]'");

echo "<script>alert('Data Hewan Terhapus');</script>";
echo "<script>location='hewan.php';</script>";
?>