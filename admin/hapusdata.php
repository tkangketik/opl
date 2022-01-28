<?php
$koneksi = new mysqli("localhost","root","","oplbaru");


$ambil = $koneksi->query("SELECT * FROM transaksi WHERE kd_transaksi='$_GET[id]'");
$ambilDet = $koneksi->query("SELECT * FROM det_transaksi WHERE kd_transaksi='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM transaksi WHERE kd_transaksi = '$_GET[id]'");
$koneksi->query("DELETE FROM det_transaksi WHERE kd_transaksi = '$_GET[id]'");

echo "<script>alert('Data Transaksi Terhapus');</script>";
echo "<script>location='transaksi.php';</script>";
?>