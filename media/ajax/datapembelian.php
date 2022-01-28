<?php
require_once "../koneksi.php";


$kdtransaksi = $_POST['id'];
$data = ambilData("SELECT * FROM buku INNER JOIN detail_transaksi USING(kd_buku) WHERE kd_transaksi = {$kdtransaksi}");
$member = ambilData("SELECT * FROM member INNER JOIN transaksi USING(id_member) WHERE kd_transaksi = {$kdtransaksi}");
$alamat = ambilData("SELECT * FROM alamat_pengiriman WHERE kd_transaksi = {$kdtransaksi}")[0];

$i = 1;
$total = 0;
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Cover</th>
            <th scope="col">Judul</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Harga per pcs</th>

        </tr>
    </thead>
    <tbody>


        <?php
        foreach ($data as $d) :
            $harga      = $d['diskon'] ? ($d['harga'] - $d['diskon']) : $d['harga'];
            $total      += $harga * $d['qty'];
        ?>

            <tr>
                <th scope="row"><?= $i++ ?></th>
                <td><img src="admin/<?= $d['gambar'] ?>" alt="" style="height: 100;width:130px;"></td>
                <td><?= $d['judul'] ?></td>
                <td><?= $d['qty'] ?></td>
                <td>
                     <?php if ($d['diskon']) : ?>
                                        <del>Rp.<?= number_format($d['harga']) ?></del><br>
                                        Rp.<?php echo number_format($harga); ?>
                                    <?php else : ?>
                                        Rp.<?php echo number_format($harga); ?>
                                    <?php endif; ?>
                    
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="4">Total</td>
         <td><?= number_format($total + $member[0]['ongkir']) ?></td>
        </tr>
    </tbody>
</table>

<div>
    <h3>Pesanan Anda Akan Terkirim Ke :</h3>
    <p>Penermima : <?= $member[0]['nama_member'] ?></p>
    <p>Alamat : <?= $alamat['alamat'] ?></p>
    <p>Kota : <?= $alamat['kabupaten'] ?></p>
    <p>Provinsi : <?= $alamat['provinsi'] ?></p>
    <p>Kode Pos : <?= $alamat['kodepos'] ?></p>
    <p>Hp : <?= $member[0]['no_hp'] ?></p>

</div>