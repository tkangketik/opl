<?php
session_start();

require 'koneksi.php';

$PasswordLama = md5($_POST['passwordlama']);
$PasswordBaru = md5($_POST['passwordbaru']);
$KonfirmasiPassword = md5($_POST['konfirmasipassword']);

$id_pelanggan = $_SESSION['id_pelanggan'];

$ubah = mysqli_query($koneksi, "UPDATE pelanggan SET password='$KonfirmasiPassword' WHERE password='$PasswordLama' AND $id_pelanggan")or die(mysqli_error($koneksi));

if ($ubah)
{
    session_destroy();
    // header("Location:masuk.php");    
   echo "<script>alert('Ubah Password Berhasil! Silahkan Masuk Kembali'); window.location='login.php'</script>";
} else {
     //Data Tidak bisa diubah
    echo "<script>alert('Silahkan Periksa Kembali'); window.location='pages/ubah_password.php'</script>";
}

?>