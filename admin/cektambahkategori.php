<?php
include 'koneksi.php';
if (isset($_POST['submit'])) {
    # code...
    $nama_kategori = $_POST['nama_kategori'];
    $id_admin = $_POST['id_admin'];

    $ambil = $koneksi->query(
        "SELECT * FROM kategori WHERE nama_kategori = '{$nama_kategori}'"
    );
    $cocok = $ambil->num_rows;
    if ($cocok == 1) {
        # code...
        echo "<script>alert('Input Data Gagal Kategori Sudah Tersedia Silahkan Periksa Kembali !');</script>";
        echo "<script>location='tambahkategori.php';</script>";
    } else {
        $koneksi->query(
            "INSERT INTO kategori (nama_kategori ,id_admin) VALUES ('{$nama_kategori}','{$id_admin}')"
        );

        echo "<script>alert('Input Data Sukses!');</script>";
        echo "<script>location='kategori.php';</script>";
    }
}
?>
