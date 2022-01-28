<?php
session_start();
require_once "../../../koneksi.php";

// idmobil' => string '7' (length=1)
//   'mobil' => string 'Rp 350.000,00' (length=13)
//   'tglawal' => string '2021-04-28' (length=10)
//   'tglakhir' => string '2021-04-30' (length=10)
//   'lamasewa' => string '48 Jam' (length=6)
//   'supir' => string '0' (length=1)
//   'harga' => string '1400000' (length=7)
$data_trx = $_POST["transaksi"];
$data_detail_trx = $_POST['detail'];

$getIdPelanggan = mysqli_query($koneksi, "select id_pelanggan from pelanggan where email = '".$data_trx['email']."' LIMIT 1");
$getIdPelanggan = mysqli_fetch_array($getIdPelanggan);

// $query = "INSERT INTO transaksi(id_pelanggan,tanggal,total,bayar,status,no_pembayaran,pdf)
// VALUES('$')";
$tanggal        = $data_trx['tgl'];
$idpelanggan       = $getIdPelanggan['id_pelanggan'];
$timeslot = $data_trx['time_slot'];
$total = $data_trx['gross_amount'];
$no_pembayaran = $data_trx['order_id'];
// $idadmin       = $getIdAdmin['id_admin'];
$hewan       = $data_trx['hewan'];
// $payment        = json_decode($_POST['data'], true);
// $idpemesanan    = $payment['order_id'];
// $pdf            = $payment['pdf_url'];
// // $jambooking = $_POST['pesanan'];

$cektransaksi = mysqli_query($koneksi, "select no_pembayaran from transaksi where no_pembayaran = '{$no_pembayaran}' LIMIT 1");
$jmltransaksi = mysqli_num_rows($cektransaksi);

if ($jmltransaksi > 0) {
    $update = mysql_query($koneksi, "UPDATE transaksi SET bayar = 'sudah' WHERE no_pembayaran = '{$no_pembayaran}'");
    json_encode(["hasil" => 1]);
    return;
}

$query = "INSERT INTO transaksi(id_pelanggan,id_hewan,tanggal,timeslot,total,bayar,status,no_pembayaran)
 VALUES ('{$idpelanggan}','{$hewan}','$tanggal','{$timeslot}',{$total},'sudah','online','{$no_pembayaran}')";

mysqli_query($koneksi, $query);
$idtransaksi = mysqli_insert_id($koneksi);


foreach ($data_detail_trx as $value) {
    $query = "INSERT INTO det_transaksi(kd_transaksi,kd_produk) 
    VALUES({$idtransaksi},{$value['kd_produk']})";
    mysqli_query($koneksi, $query);
}


echo json_encode(["hasil" => mysqli_affected_rows($koneksi)]);
