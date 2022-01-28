<?php
require_once "../koneksi.php";


$kd_buku = $_POST['id'];
?>

<div class="row">
    <div class="col-xl-4 col-lg-3 col-md-6">
        <?php

        $sql = mysqli_query($koneksi, "select * from buku INNER JOIN penerbit ON buku.penerbit = penerbit.kd_penerbit where kd_buku=$kd_buku");
        $data = mysqli_fetch_array($sql);
        $varGbr = $data['gambar'];
        ?>
        <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active"> <img class="d-block w-100" src="admin/<?php echo $data['gambar']; ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-7 col-lg-7 col-md-6">
        <div class="single-product-details">
            <div>
                <div class="col-xs-12"> </div>
                <h2><?php echo $data['judul'] ?></h2>
                <div class="row">
                    <div class="col-xs-5 col-md-3">Judul</div>
                    <div class="col-xs-7 col-md-9"><?php echo $data['judul'] ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-5 col-md-3">Penulis</div>
                    <div class="col-xs-7 col-md-9"><?php echo $data['penulis'] ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-5 col-md-3">Penerbit</div>
                    <div class="col-xs-7 col-md-9"><?php echo $data['nama_penerbit'] ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-5 col-md-3">Tahun terbit</div>
                    <div class="col-xs-7 col-md-9"><?php echo $data['tahun_terbit'] ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-5 col-md-3">Dimensi (cm)</div>
                    <div class="col-xs-7 col-md-9"><?php echo $data['dimensi'] ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-5 col-md-3">Berat (gr)</div>
                    <div class="col-xs-7 col-md-9"><?php echo $data['berat'] ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-5 col-md-3">Jumlah Halaman</div>
                    <div class="col-xs-7 col-md-9"><?php echo $data['jumlah_hlm'] ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-5 col-md-3">Jenis Cover</div>
                    <div class="col-xs-7 col-md-9"><?php echo $data['jenis_cover'] ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-5 col-md-3">No.ISBN</div>
                    <div class="col-xs-7 col-md-9"><?php echo $data['no_ISBN'] ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-5 col-md-3">Stok</div>
                    <div class="col-xs-7 col-md-9"><?php echo $data['stok'] ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-5 col-md-3">Sinopsis</div>
                    <div class="col-xs-7 col-md-9"><?php echo $data['sinopsis'] ?></div>
                </div>

                <div class="row">
                    <div class="col-xs-5 col-md-3">Harga</div>
                    <div class="col-xs-7 col-md-9">


                        <?php if ($data['diskon']) : ?>
                            <del>Rp <?= $data['harga'] ?></del>
                            <p>Hemat : <?= $data['diskon'] ?></p>
                            <h5>
                                Rp<?php echo $data['harga'] - $data['diskon'] ?>

                            </h5>

                        <?php else : ?>
                            Rp<?php echo $data['harga'] ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>

            <div class="row">

                <div class="col-xs-7 col-md-9">
                    <a href="detail.php?kd_buku=<?= $kd_buku ?>">
                        <button class="btn btn-success btn-block">Detail Buku</button>
                    </a>
                </div>
            </div>
        </div>
    </div>