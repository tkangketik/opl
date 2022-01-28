<?php
$provinsi = $_POST['provinsi'];
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$provinsi",
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

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response, true);
    $data = $data['rajaongkir']['results'];

    echo "<option value='0' selected>- Pilih Kabupaten - </option>";
    foreach ($data as $d) {
        echo "<option value='{$d['city_id']}' data-pos='{$d['postal_code']}'>{$d['city_name']}</option>";
    }
}
