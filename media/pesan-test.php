<?php
// Report All PHP Errors
error_reporting(E_ALL);

// Session start
session_start();
include "fungsi.php";

if (isset($_POST['insert'])) {
    if (BiodataKucing($_POST) > 0) {
        echo "<script>alert('Input Data Berhasil Silahkan Masuk!'); window.location='checkout.php'</script>";
    } else {
        echo "<script>alert('Gagal Input Data Silahkan Periksa Kembali!'); window.location='media/pesan.php'</script>";
    }
}


// Currency symbol, you can change it
$currency = "Rp. ";
// include "koneksi.php";
$koneksi = new mysqli("localhost", "root", "", "oplbaru");

if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo '
    <center>
        <br><br><br><br><br><br><br><br><br>
        <b> Maaf silahkan Login kembali </b><br>
        <b> Anda telah keluar dari sistem</b>
        <br>
        <a href="../login.php" tittle="Klik Gambar Untuk Kembali ke Halaman MASUK">
        <img src="img/logo/icons8-login.GIF" height="100" width="120"></img>
        </a>
    </center>';
} else {


    // session_start();

    // require_once dirname(__FILE__) . '/vendor/midtrans/midtrans-php/Midtrans.php';


    if (isset($_GET['date'])) {
        $date = $_GET['date'];
        $stmt = $koneksi->prepare("select * from transaksi where tanggal = ?");
        $stmt->bind_param('s', $date);
        $bookings = array();
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bookings[] = $row['timeslot'];
                }

                $stmt->close();
            }
        }
    }
    $duration = 60;
    $cleanup = 0;
    $start = "09:00";
    $end = "20:00";

    function timeslots($duration, $cleanup, $start, $end)
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $interval = new DateInterval("PT" . $duration . "M");
        $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
        $slots = array();

        for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
            $endPeriod = clone $intStart;
            $endPeriod->add($interval);
            if ($endPeriod > $end) {
                break;
            }

            $slots[] = $intStart->format("H:iA") . " - " . $endPeriod->format("H:iA");
        }
        return $slots;
    }
    $msg = "";
    $v = "1.6.2";
?>

    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Orion Pet Lover</title>
        <link rel="stylesheet" href="../assets/css/animate.css">
        <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/fontello.css">
        <link rel="stylesheet" href="../assets/css/jquery-ui.css">
        <link rel="stylesheet" href="../assets/css/lnr-icon.css">
        <link rel="stylesheet" href="../assets/css/owl.carousel.css">
        <link rel="stylesheet" href="../assets/css/slick.css">
        <link rel="stylesheet" href="../assets/css/trumbowyg.min.css">
        <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/style.css">
        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png"> <!-- hapus jika tidak mempunyai favicon -->
    </head>

    <body class="preload home2 single-vendor">
        <div class="menu-area">
            <div class="top-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-3">
                            <div class="logo">
                                <a href="../home.php" style="color:black;"><i class="lnr lnr-home"></i>Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="pesanan.php" class="author-area__seller-btn inline"><i class="lnr lnr-book"></i>Reservasi</a>
                                <a href="../konsul.php" style="color:black;"><i class="lnr lnr-users"></i>Konsultasi</a>
                            </div>
                        </div>
                        <div class="col-lg-8 offset-lg-1 col-md-9 col-6 v_middle">
                            <div class="author-area">
                                <div class="author__notification_area">
                                    <ul>
                                        <li class="has_dropdown">
                                            <div class="icon_wrap">
                                                <a href="../pages/keranjang.php">
                                                    <span class="lnr lnr-cart"></span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <?php
                                $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email='$_SESSION[email]'");
                                while ($row = $ambil->fetch_assoc()) {
                                ?>
                                    <div class="author-author__info inline has_dropdown">
                                        <div class="author__avatar">
                                            <img src="../assets/images/usr_avatar.png" alt="user avatar">
                                        </div>
                                        <div class="autor__info">
                                            <p class="name">
                                                <?php echo $row["nama_pelanggan"]; ?>
                                            </p>
                                        </div>
                                        <div class="dropdowns dropdown--author">
                                            <ul>
                                                <li>
                                                    <a href="ubahdatapelanggan.php?id=<?php echo $row['id_pelanggan']; ?>">
                                                        <span class="lnr lnr-user"></span> Akun</a>
                                                </li>
                                                <li>
                                                    <a href="pages/hewan.php">
                                                        <span class="lnr lnr-smile"></span> Data Hewan</a>
                                                </li>
                                                <li>
                                                    <a href="pages/keranjang.php">
                                                        <span class="lnr lnr-cart"></span> Pesanan</a>
                                                </li>
                                                <li>
                                                    <a href="logout.php" onclick="return confirm('Apakah Anda Yakin Ingin keluar?')">
                                                        <span class="lnr lnr-exit"></span>Logout</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb">
                            <ul>
                                <li>
                                    <a href="../home.php">Home</a>
                                </li>
                                <li class="active">
                                    <a href="#">Reservasi</a>
                                </li>
                            </ul>
                        </div>
                        <h1 class="page-title">Reservasi</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="section--padding2 bgcolor">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shortcode_modules">
                            <div class="modules__title">
                                <h3>Reservasi</h3>
                            </div>
                            <div class="modules__content">
                                <div class="panel-group accordion" role="tablist" id="accordion">
                                    <div class="panel accordion__single" id="panel-one">
                                        <div class="single_acco_title">
                                            <h4>
                                                <a data-toggle="collapse" href="#collapse1" class="collapsed" aria-expanded="false" data-target="#collapse1" aria-controls="collapse1">
                                                    <span>Pilih Layanan</span>
                                                    <i class="lnr lnr-chevron-down indicator"></i>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse" aria-labelledby="panel-one" data-parent="#accordion">
                                            <div class="panel-body">
                                                <section class="products section--padding">
                                                    <?php
                                                    $sql = mysqli_query($koneksi, 'SELECT kd_produk, nama, harga, nama_kategori,keterangan FROM produk natural join kategori');
                                                    if (mysqli_num_rows($sql) == 0) {
                                                        echo "tidak ada produk";
                                                    } else {
                                                        while ($data = mysqli_fetch_array($sql)) {
                                                    ?>
                                                            <div class="col-lg-4 col-sm-6">
                                                                <form action="?date=<?= $date ?>&" method="post">
                                                                    <div class="product product--card product--card2">
                                                                        <div class="product-desc">
                                                                            <a href="#" class="product_title">
                                                                                <h4><?php echo $data['nama']; ?></h4>
                                                                            </a>
                                                                            <h2><?php echo $currency; ?> <?php echo $data['harga']; ?> </h2>
                                                                            <p>
                                                                                <input type="text" name="quantity" class="form-control" value="1" />
                                                                            </p>
                                                                        </div>
                                                                        <div class="product-purchase">
                                                                            <div class="price_love">
                                                                                <button type="submit" class="btn btn--icon btn-sm btn--round btn-info ml-3"><span class="lnr lnr-cart"></span>Keranjang</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="item" value="<?php echo $data['nama']; ?>" />
                                                                    <input type="hidden" name="price" value="<?php echo $data['harga']; ?>" />
                                                                    <input type="hidden" name="kd_produk" value="<?php echo $data['kd_produk']; ?>" />
                                                                </form>
                                                            </div>
                                                        <?php } ?>
                                                </section>
                                            </div>
                                        </div>
                                        <div class="panel accordion__single" id="panel-two">
                                            <div class="single_acco_title">
                                                <h4>
                                                    <a data-toggle="collapse" href="#collapse2" class="collapsed" aria-expanded="false" data-target="#collapse2" aria-controls="collapse2">
                                                        <span>Booking</span>
                                                        <i class="lnr lnr-chevron-down indicator"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse2" class="panel-collapse collapse" aria-labelledby="panel-two" data-parent="#accordion">
                                                <div class="panel-body">
                                                    <div class="col-md-12">
                                                        <div class="">
                                                            <div class="modules__content">
                                                                <div class="withdraw_module withdraw_history">
                                                                    <div class="withdraw_table_header">
                                                                        <h3>Keranjang</h3>
                                                                    </div>
                                                                    <div class="table-responsive">
                                                                        <?php
                                                                        // If cart is empty
                                                                        if (!isset($_SESSION['SBCScart']) || (count($_SESSION['SBCScart']) == 0)) {
                                                                        ?>
                                                                            <div class="panel panel-default">
                                                                                <div class="panel-heading">
                                                                                    <h3 class="panel-title"><span class="glyphicon glyphicon-shopping-cart"></span> Pesanan </h3>
                                                                                </div>
                                                                                <div class="panel-body">Pesanan Kosong..</div>
                                                                            </div>
                                                                        <?php
                                                                            // If cart is not empty
                                                                        } else {
                                                                        ?>
                                                                            <table class="table withdraw__table">
                                                                                <tr>
                                                                                    <th width="40%">Jenis Pelayanan</th>
                                                                                    <th width="10%">Harga</th>
                                                                                    <th width="20%">Jumlah</th>
                                                                                    <th width="20%">Total</th>
                                                                                </tr>
                                                                                <?php
                                                                                // List cart items
                                                                                // We store order detail in HTML
                                                                                $OrderDetail = '
						<table border=1 cellpadding=5 cellspacing=5>
							<thead>
								<tr>
									<th>Pesanan</th>
									<th>Harga</th>
									<th>Jumlah	</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>';

                                                                                // Equal total to 0
                                                                                $total = 0;

                                                                                // For finding session elements line number
                                                                                $linenumber = 0;

                                                                                // Run loop for cart array
                                                                                foreach ($_SESSION['SBCScart'] as $SBCSitem) {
                                                                                    // Don't list items with 0 qty
                                                                                    if ($SBCSitem['quantity'] != 0) {

                                                                                        // For calculating total values with decimals
                                                                                        $pricedecimal = str_replace(",", ".", $SBCSitem['unitprice']);
                                                                                        $qtydecimal = str_replace(",", ".", $SBCSitem['quantity']);

                                                                                        $pricedecimal = (float)$pricedecimal;
                                                                                        $qtydecimal = (float)$qtydecimal;
                                                                                        // $qtydecimaltotal = $qtydecimaltotal + $qtydecimal;

                                                                                        $totaldecimal = $pricedecimal * $qtydecimal;

                                                                                        // We store order detail in HTML
                                                                                        $OrderDetail .= "<tr><td>" . $SBCSitem['item'] . "</td><td>" . $currency . " " . $SBCSitem['unitprice'] . " </td><td>" . $SBCSitem['quantity'] . "</td><td>" . $currency . " " . $totaldecimal . " </td></tr>";

                                                                                        // Write cart to screen
                                                                                        echo
                                                                                        "
							<tr class='tablerow'>
								<td><a href=\"?date=" . $date . "&remove=" . $linenumber . "\" class=\"btn btn-danger btn-xs\" onclick=\"return confirm('Are you sure?')\">Hapus</a> " . $SBCSitem['item'] . "</td>
								<td>" . $currency . " " . $SBCSitem['unitprice'] . " </td>
								<td>" . $SBCSitem['quantity'] . "</td>
								<td>" . $currency . " " . $totaldecimal . " </td>
							</tr>
							";

                                                                                        $item_details[] = [
                                                                                            'id' => 'ITEM',
                                                                                            'price' => $SBCSitem['unitprice'],
                                                                                            'quantity' => $SBCSitem['quantity'],
                                                                                            'name' => $SBCSitem['item']
                                                                                        ];

                                                                                        // Total
                                                                                        $total += $totaldecimal;
                                                                                    }
                                                                                    $linenumber++;
                                                                                }

                                                                                // We store order detail in HTML
                                                                                $OrderDetail .= "<tr><td>Total</td><td></td><td></td><td>" . $currency . " " . $total . " </td></tr></tbody></table>";

                                                                                require_once  'vendor/midtrans/midtrans-php/Midtrans.php';

                                                                                // Set your Merchant Server Key
                                                                                \Midtrans\Config::$serverKey = 'SB-Mid-server-uVKMZ5mc-E0VvT4HjBRh5Vpk';
                                                                                // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
                                                                                \Midtrans\Config::$isProduction = false;
                                                                                // Set sanitization on (default)
                                                                                \Midtrans\Config::$isSanitized = true;
                                                                                // Set 3DS transaction for credit card to true
                                                                                \Midtrans\Config::$is3ds = true;

                                                                                $pembeli = $_SESSION['nama_pelanggan'];
                                                                                $email = $_SESSION['email'];
                                                                                $telepon = $_SESSION['no_hp'];

                                                                                $transaction_details = array(
                                                                                    'order_id' => rand(),
                                                                                    'gross_amount' => $totaldecimal,
                                                                                    'item_details' => $item_details,

                                                                                );

                                                                                //   $item_details[] = [
                                                                                //     'id' => 'ITEM',
                                                                                //     'price' => $SBCSitem['unitprice'],
                                                                                //     'quantity' => $SBCSitem['quantity'],
                                                                                //     'name' => $SBCSitem['item']
                                                                                //   ];

                                                                                // Optional
                                                                                $billing_address = array(
                                                                                    'first_name'    =>  $pembeli,
                                                                                    'phone'         =>  $telepon,
                                                                                    'country_code'  => 'IDN'
                                                                                );

                                                                                // Optional
                                                                                $shipping_address = array(
                                                                                    'first_name'    =>  $pembeli,
                                                                                    'phone'         =>  $telepon,
                                                                                    'country_code'  => 'IDN'
                                                                                );

                                                                                // Optional
                                                                                $customer_details = array(
                                                                                    'first_name'    => $pembeli,
                                                                                    'email'         => $email,
                                                                                    'phone'         => $telepon,
                                                                                    'billing_address'  => $billing_address,
                                                                                    'shipping_address' => $shipping_address
                                                                                );

                                                                                //   $enable_payments = array('credit_card','cimb_clicks','mandiri_clickpay','echannel','alfamart');

                                                                                $transaction = array(
                                                                                    'transaction_details' => $transaction_details,
                                                                                    'customer_details' => $customer_details,
                                                                                    'item_details' => $item_details,
                                                                                );

                                                                                $snapToken = \Midtrans\Snap::getSnapToken($transaction);

                                                                                ?>
                                                                                <tr class='tableactive'>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td class='text-right'>Total</td>
                                                                                    <!-- <td><?php echo $qtydecimaltotal; ?></td> -->
                                                                                    <td><?php echo $currency; ?> <?php echo $total; ?> </td>
                                                                                </tr>
                                                                            </table>

                                                                    </div>
                                                                </div>

                                                                <section class="products section--padding">
                                                                    <div class="container">
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <form role="form" method="post" action="checkout.php?date=<?= $date ?>&pay">
                                                                                    <div class="form-group">
                                                                                        <label for="exampleFormControlSelect1">Jam Booking</label>
                                                                                        <select name="pesanan" class="form-control" id="jambooking">
                                                                                            <option value="0">Jam</option>
                                                                                            <?php $timeslots = timeslots($duration, $cleanup, $start, $end);
                                                                                            foreach ($timeslots as $ts) {
                                                                                            ?>
                                                                                                <?php if (in_array($ts, $bookings)) { ?>
                                                                                                    <option value="<?php echo $ts; ?>" disabled><?php echo $ts; ?></option>
                                                                                                <?php } else { ?>
                                                                                                    <option data-timeslot="<?php echo $ts; ?>" value="<?php echo $ts; ?>"><?php echo $ts; ?></option>
                                                                                            <?php }
                                                                                            } ?>
                                                                                        </select><br>
                                                                                    </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label for="exampleFormControlSelect1">Hewan Kesayangan</label>
                                                                                    <select name="Hewan" class="form-control" id="nama_hewan">
                                                                                        <option>Hewan</option>
                                                                                        <?php
                                                                                        // $id_pelanggan = $_POST['id_pelanggan'];

                                                                                        $koneksi = mysqli_query($koneksi, "SELECT * FROM biohewan WHERE id_pelanggan = {$_SESSION['id_pelanggan']}");
                                                                                        while ($nama_hewan = mysqli_fetch_assoc($koneksi)) {
                                                                                        ?>
                                                                                            <option value="<?= $nama_hewan['id_hewan'] ?>"><?= $nama_hewan['nama_hewan'] ?></option>
                                                                                        <?php
                                                                                        } ?>
                                                                                        <input type="hidden" name="total" value="<?php echo $total; ?>">
                                                                    <input type="hidden" name="tgl" value="<?php echo $_GET['date']; ?>">
                                                                    <input type="hidden" name="OrderDetail" value="<?php echo htmlentities($OrderDetail); ?>">
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div>
                                                                                <a href="../home.php" class="btn btn-primary">Kembali Ke Pesanan</a>
                                                                                <button type="submit" class="btn btn-primary pull-right">Pesan Sekarang</button>
                                                                                <br> <br> <br> <br>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                    <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>



        <script src="../assets/js/vendor/jquery/jquery-1.12.3.js"></script>
        <script src="../assets/js/vendor/jquery/popper.min.js"></script>
        <script src="../assets/js/vendor/jquery/uikit.min.js"></script>
        <script src="../assets/js/vendor/bootstrap.min.js"></script>
        <script src="../assets/js/vendor/chart.bundle.min.js"></script>
        <script src="../assets/js/vendor/grid.min.js"></script>
        <script src="../assets/js/vendor/jquery-ui.min.js"></script>
        <script src="../assets/js/vendor/jquery.barrating.min.js"></script>
        <script src="../assets/js/vendor/jquery.countdown.min.js"></script>
        <script src="../assets/js/vendor/jquery.counterup.min.js"></script>
        <script src="../assets/js/vendor/jquery.easing1.3.js"></script>
        <script src="../assets/js/vendor/owl.carousel.min.js"></script>
        <script src="../assets/js/vendor/slick.min.js"></script>
        <script src="../assets/js/vendor/tether.min.js"></script>
        <script src="../assets/js/vendor/trumbowyg.min.js"></script>
        <script src="../assets/js/vendor/waypoints.min.js"></script>
        <script src="../assets/js/dashboard.js"></script>
        <script src="../assets/js/main.js"></script>
        <script src="../assets/js/map.js"></script>
        <script type="text/javascript">
            function transaksi(fd) {
                //  fd.append("payment", coba)
                let form = document.getElementById("formcheckout");
                var fd = new FormData(form);

                $.ajax({
                    url: "ajax/payment/insert.php",
                    data: fd,
                    processData: false,
                    contentType: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    method: "post",
                    dataType: "json",
                    success: res => {
                        if (res.hasil) {
                            alert("Pesanan berhasil dibuat silahkan lakukan pembayaran");
                            document.location.href = 'home.php';
                        } else {
                            alert("Pesanan gagal dibuat silahkan coba beberapa saat lagi");
                            document.location.href = 'pesanan.php';
                        }
                    }
                })
            }

            document.getElementById('pay-button').onclick = function() {
                snap.pay('<?= $snapToken ?>', {
                    onSuccess: function(result) {
                        fd.append("data", JSON.stringify(result))
                        transaksi(fd);

                    },
                    onPending: function(result) {
                        fd.append("data", JSON.stringify(result))
                        transaksi(fd);
                    },
                    onError: function(result) {
                        document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    }
                });
            };
        </script>
        <!-- // <?php
                                                                            // $idtransaksi = mysqli_insert_id($koneksi);
                                                                            // $jambooking = $_POST['pesanan'];

                                                                            // $query = "INSERT INTO transaksi (kd_transaksi, nama, email, tanggal, timeslot, trans_status) VALUES ($idtransaksi ,$pembeli,$email,$date,$jambooking,'Success')";

                                                                            // mysqli_query($koneksi, $query);

                                                                            // // foreach ($_SESSION['SBCScart'] as $SBCSitem) {
                                                                            // // 		$query = "INSERT INTO detail_transaksi(kd_transaksi,kd_buku,qty) VALUES({$idtransaksi},$key,{$value['jumlah']})";
                                                                            // // 		mysqli_query($koneksi, $query);
                                                                            // // 		unset($_SESSION['SBCScart'][$SBCSitem]);
                                                                            // // }
                                                                            // 
                ?> -->
        <script>
            $(document).ready(function() {
                $("#login").click(function() {
                    alert("Login dulu");
                    document.location.href = 'login.php';
                })

                $("#pesan").click(function() {
                    let form = document.getElementById("formcheckout");
                    var fd = new FormData(form);

                    $.ajax({
                        url: "ajax/payment/checkout.php",
                        data: fd,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
                        method: "post",
                        dataType: "json",
                        success: Response => {
                            snap.pay(Response.token, {
                                // Optional
                                onSuccess: function(result) {
                                    /* You may add your own js here, this is just example */
                                    fd.append("data", JSON.stringify(result))
                                    transaksi(fd);
                                },
                                // Optional
                                onPending: function(result) {
                                    /* You may add your own js here, this is just example */
                                    fd.append("data", JSON.stringify(result))
                                    transaksi(fd);
                                },
                                // Optional
                                onError: function(result) {
                                    /* You may add your own js here, this is just example */
                                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                                }
                            });
                        }
                    })
                })
            });
        </script>
<?php } } ?>