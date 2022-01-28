<?php
    $koneksi = new mysqli("localhost","root","","oplbaru");
   session_start();
   
$PasswordLama = md5($_POST['passwordlama']);
$PasswordBaru = md5($_POST['passwordbaru']);
$KonfirmasiPassword = md5($_POST['konfirmasipassword']);

$id_admin = $_SESSION['id_admin'];

$ubah = mysqli_query($koneksi, "UPDATE admin SET password='$KonfirmasiPassword' WHERE password='$PasswordLama' AND $id_admin")or die(mysqli_error($koneksi));

if ($ubah)
{
    session_destroy();
    // header("Location:masuk.php");    
   echo "<script>alert('Ubah Password Berhasil! Silahkan Masuk Kembali'); window.location='home.php'</script>";
} else {
     //Data Tidak bisa diubah
    echo "<script>alert('Silahkan Periksa Kembali'); window.location='ubahpass.php'</script>";
}

?>