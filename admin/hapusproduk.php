<?php
$koneksi = new mysqli("localhost","root","","oplbaru");


$ambil = $koneksi->query("SELECT * FROM produk WHERE kd_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM produk WHERE kd_produk = '$_GET[id]'");

echo "<script>alert('Data Pelayanan Terhapus');</script>";
echo "<script>location='pelayanan.php';</script>";
?>