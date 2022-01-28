<?php 
    include 'koneksi.php';
                            if (isset($_POST["submit"])) 
                            {
                                # code...
                                $namaHewan = $_POST['nama'];
                                $umurHewan = $_POST['umur'];
                                $gejalaHewan = $_POST['gejala'];
                                $id_pelanggan = $_POST['id_pelanggan'];

                                header("location:https://api.whatsapp.com/send?phone=$no_hp&text=Hallo bisakah saya konsultasi%20%0DNama:%20$namaHewan%20%0DUmurHewan:%20$umurHewan%20%0DGejala:%20$gejalaHewan");

                                $ambil = $koneksi->query("SELECT * FROM konsul WHERE nama = '{$namaHewan}'");
                                $cocok = $ambil->num_rows;
                                if ($cocok==1) 
                                {
                                    # code...
                                    echo "<script>alert('Input Data Gagal No Sertifikat Sudah Terdaftar Silahkan Periksa Kembali !');</script>";
                                    echo "<script>location='konsul.php';</script>";
                                }
                                else 
                                {
                                    $koneksi->query("INSERT INTO konsul (nama, umur, gejala, id_pelanggan,) VALUES ('{$namaHewan}','{$umurHewan}','{$gejalaHewan}','{$id_pelanggan}',)");

                                    echo "<script>alert('Input Data Sukses!');</script>";
                                    echo "<script>location='home.php';</script>";
                                }

                            }

    ?>