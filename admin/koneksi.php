<?php
$currency = 'Rp.';
$server = 'localhost';
$username = 'root';
$password = '';
$db_name = 'oplbaru';

$koneksi = mysqli_connect($server, $username, $password, $db_name);

if (!$koneksi) {
    echo 'Koneksi Gagal';
} else {
    //echo "Koneksi Berhasil";
}
function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
?>