<?php
require_once "../../koneksi.php";
$input_source   = file_get_contents('php://input');


$data           = json_decode($input_source);
$oderid         = $data->order_id;


if ($data->status_code == 200) {
    mysqli_query($koneksi, "UPDATE transaksi SET bayar = 'sudah' WHERE no_pembayaran = '{$oderid}'");
}
