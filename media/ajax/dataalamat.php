<?php
session_start();
require "../koneksi.php";



$provinsi   = $_SESSION['user']['provinsi'];
$kabupaten  = $_SESSION['user']['kabupaten'];
$pos        = $_SESSION['user']['kodepos'];
$alamat     = $_SESSION['user']['alamat'];


$idprovinsi = 0;

//cari id provinsi
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: 54a472b3dae09f792220714155997828"
    ),
));

$response   = curl_exec($curl);
$err        = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response, true);
    $data = $data['rajaongkir']['results'];

    foreach ($data as $d) {
        if ($d['province'] == $provinsi) $idprovinsi = $d['province_id'];
    }
}


//cari id kabupaten 
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$idprovinsi",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: 54a472b3dae09f792220714155997828"
    ),
));

$response   = curl_exec($curl);
$err        = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response, true);
    $data = $data['rajaongkir']['results'];
    foreach ($data as $d) {
        if ($d['city_name'] == $kabupaten) {
            $kabupaten = "<option id_distrik='{$d['city_id']}' nama_provinsi='{$d['province']}' nama_distrik='{$d['city_name']}' tipe_distrik='Kabupaten' kodepos='{$d['postal_code']}'>{$d['city_name']}</option>";
        }
    }
}
$provinsi = "<option>{$provinsi}</option>";


$data = [
    "kodepos" => $pos,
    "alamat" => $alamat,
    "provinsi" => $provinsi,
    "kabupaten" => $kabupaten
];
echo json_encode($data);

// <option value="" id_distrik="27" nama_provinsi="Bangka Belitung" nama_distrik="Bangka" tipe_distrik="Kabupaten" kodepos="33212">Kabupaten Bangka</option>