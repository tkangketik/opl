<?php 
    include '../koneksi.php';
                            if (isset($_POST["insert"])) 
                            {
                                # code...
                                $namaHewan = $_POST['nama_hewan'];
                                $umurHewan = $_POST['umur'];
                                $id_pelanggan = $_POST['id_pelanggan'];
                                $id_jenishewan = $_POST['id_jenishewan'];

                                $ambil = $koneksi->query("SELECT * FROM biohewan WHERE nama_hewan = '{$namaHewan}'");
                                $cocok = $ambil->num_rows;
                                if ($cocok==1) 
                                {
                                    # code...
                                    echo "<script>alert('Input Data Gagal Data Hewan Sudah Terdaftar Silahkan Periksa Kembali !');</script>";
                                    echo "<script>location='daftarhewan.php';</script>";
                                }
                                else 
                                {
                                    $koneksi->query("INSERT INTO biohewan (nama_hewan, umur, id_pelanggan, id_jenishewan) 
                                    VALUES ('{$namaHewan}','{$umurHewan}','{$id_pelanggan}','{$id_jenishewan}')");

                                    echo "<script>alert('Input Data Sukses!');</script>";
                                    echo "<script>location='pesanan.php';</script>";
                                }

                            }

    ?>