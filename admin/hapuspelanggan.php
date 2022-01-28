<?php
$koneksi = new mysqli("localhost","root","","oplbaru");


$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE pelanggan, biohewan
FROM pelanggan
JOIN biohewan
ON pelanggan.id_pelanggan = biohewan.id_pelanggan
AND biohewan.id_pelanggan='$_GET[id]'");

echo "<script>alert('Data Pelanggan Terhapus');</script>";
echo "<script>location='pelanggan.php';</script>";
?>