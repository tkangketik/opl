<?php 
include 'koneksi.php';
						if (isset($_POST["submit"])) 
						{
							# code...
                            $kategori = $_POST['kategori'];
							$nama = $_POST['nama'];
                            $harga = $_POST['harga'];
                            $keterangan = $_POST['keterangan'];
                            $id_admin = $_POST['id_admin'];
 
                            $ambil = $koneksi->query("SELECT * FROM produk WHERE nama = '{$nama}'");
                            $cocok = $ambil->num_rows;
                            if ($cocok==1) 
                            {
                                # code...
                                echo "<script>alert('Input Data Gagal Jenis Pelayanan Sudah Tersedia Silahkan Periksa Kembali !');</script>";
                                echo "<script>location='tambahpelaynan.php';</script>";
                            }
                            else 
                            {
                                $koneksi->query("INSERT INTO produk (nama ,harga, keterangan, kd_kategori, id_admin) VALUES ('{$nama}','{$harga}','{$keterangan}','{$kategori}','{$id_admin}')");

                                echo "<script>alert('Input Data Sukses!');</script>";
                                echo "<script>location='pelayanan.php';</script>";
                            }

                        }

?>


