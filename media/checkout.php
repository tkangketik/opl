<?php
// Report All PHP Errors
error_reporting(E_ALL);

// Session start
session_start();

// Currency symbol, you can change it
$currency = "Rp. ";
// include "koneksi.php";
$koneksi = new mysqli("localhost","root","","oplbaru");

// session_start();

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
$end = "22:00";

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
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="PHP Session Based Cart System is pretty simple and fast way for listing small amount of products. This script doesn't include any payment method or payment page. This script lists manually added products, you can add that products to your shopping cart, remove them, change quantity via sessions.">
  <meta name="author" content="anbarli.org">

  <title>Pesanan</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script language="Javascript">
    // <!-- Allows only numeric chars -->
    function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
      return true;
    }
  </script>

  <style>
    .quantity {
      width: 20px;
      float: left;
      margin-right: 10px;
      height: 23px;
      font-size: 30px;
      padding: 8px;
    }
    table {
            border-collapse: collapse;
            font-family: sans-serif;
            color: #444;
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #f2f5f7;
        }
        table, th, td {
          background: #35A9DB;
          color: #fff;
          font-weight: normal;
        }
        th, td {
          background: #35A9DB;
          color: black;
          font-weight: normal;
        }
        th {
            background-color: #ffd191;
            color: black;
        }
  </style>



</head>

<body>

  <?php
  // Add item to cart
  if (empty($_POST['item']) || empty($_POST['price']) || empty($_POST['quantity'])) {
  } else {

    # Take values
    $SBCSprice = $_POST['price'];
    $SBCSitem = $_POST['item'];
    $SBCSquantity = $_POST['quantity'];
    $SBCSuniquid = rand();
    $SBCSexist = false;
    $SBCScount = 0;
    // If SESSION Generated?
    if ($_SESSION['SBCScart'] != "") {
      // Look for item
      foreach ($_SESSION['SBCScart'] as $SBCSproduct) {
        // Yes we found it
        if ($SBCSitem == $SBCSproduct['item']) {
          $SBCSexist = true;
          break;
        }
        $SBCScount++;
      }
    }
    // If we found same item
    if ($SBCSexist) {
      // Update quantity
      $_SESSION['SBCScart'][$SBCScount]['quantity'] += $SBCSquantity;
      // Write down the message and then we open in modal at the bottom
      $msg = "
			<script type=\"text/javascript\">
				$(document).ready(function(){
					$('#myDialogText').text('" . $SBCSitem . " quantity updated..');
					$('#modal-cart').modal('show');
				});
			</script>
			";
    } else {

      // If we do not found, insert new
      $SBCSmycartrow = array(
        'item' => $SBCSitem,
        'unitprice' => $SBCSprice,
        'quantity' => $SBCSquantity,
        'id' => $SBCSuniquid
      );

      // If session not exist, create
      if (!isset($_SESSION['SBCScart']))
        $_SESSION['SBCScart'] = array();

      // Add item to cart
      $_SESSION['SBCScart'][] = $SBCSmycartrow;

      // Write down the message and then we open in modal at the bottom
      $msg = "
			<script type=\"text/javascript\">
				$(document).ready(function(){
					$('#myDialogText').text('" . $SBCSitem . " added to your cart');
					$('#modal-cart').modal('show');
				});
			</script>
			";
    }
  }

  // Clear cart
  if (isset($_GET["clear"])) {
    session_unset();
    session_destroy();
    // Write down the message and then we open in modal at the bottom
    $msg = "
		<script type=\"text/javascript\">
			$(document).ready(function(){
				$('#myDialogText').text('Your cart is empty now..');
				$('#modal-cart').modal('show');
			});
		</script>
		";
  }

  // Remove item from cart (Updating quantity to 0)
  $remove = isset($_GET['remove']) ? $_GET['remove'] : '';
  if ($remove != "") {
    $_SESSION['SBCScart'][$_GET["remove"]]['quantity'] = 0;
  }
  ?>

 
      <!-- <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
			<li class="active"><a href="/" target="blank">Who Am I</a></li>
			<li class="active"><a href="https://github.com/ganbarli/PHP-SBCS" target="blank">GitHub Project Page</a></li>
          </ul>
        </div>/.nav-collapse -->
    </div><!-- /.container -->
  </div><!-- /.navbar -->

  <div class="container" style="margin-left:350px;">
    <!-- <div class="row"> -->
      <center>
      <div class="col-xs-12 col-sm-6 col-md-8 ">
        <p class="pull-right visible-xs">
          <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</button>
        </p>
        <!-- /.jumbotron -->
        <div class="col-sm-13">
          <?php if (isset($_GET["pay"])) { ?>
            <div class="panel panel-success">
            <div style="clear:both"></div>  
                <br />  
                <h3>Order Details</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered"> 

                <b style= "color: white;"><?php echo $_POST["pesanan"]; ?></b><br>
                <?php 
                $idkucing = $_POST["Hewan"];
                $queryKucing = mysqli_query($koneksi, "SELECT * FROM biohewan WHERE id_hewan ='$idkucing' ");
                $tampilKucing = mysqli_fetch_array($queryKucing);
                
                ?>
                <b style= "color: white;"><?= $tampilKucing['nama_hewan'] ?></b>
                <br><br>
                
                <?php echo $_POST["OrderDetail"]; ?><br>
              <!-- <div class="container mb-4"> -->
                <a href="pesanan.php" class="btn btn-primary">Kembali Ke Pesanan</a>
                <button class="btn btn-primary" id="pay-button">Order</button><br><br>
              </div>
            </div><!-- /.panel -->
          <?php } ?>
          </center>
        </div>
        <!--/row-->
      </div>
      <!--/span-->

      <div class="" id="sidebar" role="navigation">
        <div class="sidebar-nav">
          <?php
          // If cart is empty
          if (!isset($_SESSION['SBCScart']) || (count($_SESSION['SBCScart']) == 0)) {
          ?>
            <!-- <div class="panel panel-default">
              <div class="panel-heading"> -->
                <h3 class="panel-title"><span class="glyphicon glyphicon-shopping-cart"></span> Pesanan </h3>
              </div>
              <div class="panel-body">Pesanan Kosong..</div>
            </div>
          <?php
            // If cart is not empty
          } else {
          ?>
            <div class="panel panel-default">
              <div class="table-responsive">
                <table class="table">

                  <?php
                  // List cart items
                  // We store order detail in HTML
                  $OrderDetail = '
						<table>
							<thead>
								<tr>
                <tr>  
                <th width="40%">Nama</th>  
                <th width="20%">Harga</th> 
                <th width="10%">Quantity</th>   
                <th width="40%">Total</th>  
           </tr>  
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




                <?php } # End Cart Listing 
                ?>
              </div>
              <!--/.well -->
            </div>
            <!--/span-->
        </div>
        <!--/row-->



        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- ALL JS FILES -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-3.2.1.min.js"></script>

        <!-- ALL PLUGINS -->
        <script src="js/bootstrap-select.js"></script>
        <script src="js/inewsticker.js"></script>
        <script src="js/bootsnav.js."></script>
        <script src="js/images-loded.min.js"></script>
        <script src="js/isotope.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/baguetteBox.min.js"></script>
        <script src="js/form-validator.min.js"></script>
        <script src="js/contact-form-script.js"></script>
        <script src="js/custom.js"></script>
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-YRFDLoC8PhNsZFgK"></script>
        <script type="text/javascript">
        function transaksi(trx, detail_trx) {
            const sendData = {
              transaksi: trx,
              detail: detail_trx
            };

            $.ajax({
              url: "ajax/payment/insert.php",
              data: sendData,
              method: "POST",
              success: function(data) {
                const dataobj = JSON.parse(data);
                if (dataobj.hasil) {
                  alert("Pesanan berhasil dibuat");
                  document.location.href = 'pesanan.php';
                } else {
                  alert("Pesanan gagal dibuat silahkan coba beberapa saat lagi");
                  document.location.href = 'pesanan.php';
                }
              }
            })
          }

       // document.getElementById('pay-butto').onclick = function() {
          //   const data_trx = {
          //     email: "<?= $_SESSION['email'] ?>",
          //     time_slot: "<?= $_POST["pesanan"] ?>",
          //     status_code: '201', 
          //     status_message: 'Transaksi sedang diproses', 
          //     transaction_id: 'e5f71828-2f99-4bcd-aefd-93e2136035f5', 
          //     order_id: '1233794794', 
          //     gross_amount: '390000.00'
          //   };
          //   const detail_trx = <?= json_encode($_SESSION['SBCScart']) ?>;
          //   transaksi(data_trx, detail_trx);
          // }
          document.getElementById('pay-button').onclick = function() {
            snap.pay('<?= $snapToken ?>', {
              onSuccess: function(result) {
                const data_trx = {
                  email: "<?= $_SESSION['email'] ?>",
                  time_slot: "<?= $_POST["pesanan"] ?>",
                  tgl: "<?= $_POST["tgl"] ?>",
                  hewan: "<?= $_POST["Hewan"] ?>",

                  ...result,
                };
                const detail_trx = <?= json_encode($_SESSION['SBCScart']) ?>;
                transaksi(data_trx, detail_trx);
              },
              onPending: function(result) {
                const data_trx = {
                  email: "<?= $_SESSION['email'] ?>",
                  time_slot: "<?= $_POST["pesanan"] ?>",
                  tgl: "<?= $_POST["tgl"] ?>",
                  hewan: "<?= $_POST["Hewan"] ?>",

                  ...result,
                };
                const detail_trx = <?= json_encode($_SESSION['SBCScart']) ?>;
                transaksi(data_trx, detail_trx);
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

                // $query = "INSERT INTO transaksi (id_transaksi, nama, email, tanggal, timeslot, trans_status) VALUES ($idtransaksi ,$pembeli,$email,$date,$jambooking,'Success')";

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
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <?php if ($msg != "") {
          echo $msg;
        } ?>

        <script>
          (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
              (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
              m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
          })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

          ga('create', 'UA-928914-3', 'anbarli.org');
          ga('send', 'pageview');
        </script>

        <script>
          function transaksi(fd) {
            //  fd.append("payment", coba)
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


          $(document).ready(function() {


                $(".pilihan").change(function() {
                  let val = $(this).val()

                  if (val == "1") {
                    $.ajax({
                      url: "ajax/dataalamat.php",
                      dataType: "json",
                      success: res => {
                        $("#nama_provinsi").empty()
                        $("#nama_provinsi").append(res.provinsi)
                        $("#nama_distrik").empty()
                        $("#nama_distrik").append(res.kabupaten)
                        $("#nama_ekspedisi").val("0")
                        $("#alamat").html(res.alamat)
                        $("#alamat").attr("readonly", true)
                      }
                    })
                  } else if (val == "2") {
                    $("#nama_provinsi").empty()
                    $("#nama_distrik").empty()
                    $.ajax({
                      type: 'post',
                      url: 'dataprovinsi.php',
                      success: function(hasil_provinsi) {
                        $("select[name=nama_provinsi]").html(hasil_provinsi);
                        $("#alamat").html('')
                        $("#alamat").attr("readonly", false)
                      }
                    });
                  }

                })


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



           </body>
           </html >