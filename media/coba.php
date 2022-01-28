<?php   
// error_reporting(0);
 session_start();  
 $currency = "Rp. ";
 $koneksi = mysqli_connect("localhost", "root", "", "oplbaru");  

 if(isset($_POST["add_to_cart"]))  
 {  
	  if(isset($_SESSION["shopping_cart"]))  
	  {  
			global $item_array;
		   $item_array = array_column($_SESSION["shopping_cart"], "item_kd_produk");  
		   if(!in_array($_GET["id"], $item_array))  
		   {  
				$count = count($_SESSION["shopping_cart"]);  
				global $item_array;
				$item_array = array(  
					 'item_kd_produk'               =>     $_GET["id"],  
					 'item_nama'               =>     $_POST["hidden_nama"],  
					 'item_harga'          =>     $_POST["hidden_harga"],  
					 'quantity'          =>     $_POST["quantity"]  
				);  
				$_SESSION["shopping_cart"][$count] = $item_array;  
		   }  
		   else  
		   {  
				echo '<script>alert("Item Already Added")</script>';  
				echo '<script>window.location="coba.php"</script>';  
		   }  
	  }  
	  else  
	  {  
		global $item_array;
		   $item_array = array(   
				'item_kd_produk'               =>     $_GET["id"],  
				'item_nama'               =>     $_POST["hidden_nama"],  
				'item_harga'          =>     $_POST["hidden_harga"],  
				'quantity'          =>     $_POST["quantity"]   
		   );  
		   $_SESSION["shopping_cart"][0] = $item_array;  
	  }  
 }  
 if(isset($_GET["action"]))  
 {  
	  if($_GET["action"] == "delete")  
	  {  
		   foreach($_SESSION["shopping_cart"] as $keys => $values)  
		   {  
				if($values["item_kd_produk"] == $_GET["kd_produk"])  
				{  
					 unset($_SESSION["shopping_cart"][$keys]);  
					 echo '<script>alert("Item Removed")</script>';  
					 echo '<script>window.location="coba.php"</script>';  
				}  
		   }  
	  }  
	  if($_GET["action"] == "clear")
	{
		setcookie("shopping_cart", "", time() - 3600);
		header("location:coba.php?clearall=1");
	}
 }
 
 if(isset($_GET["success"]))
 {
	$message = '
	<div class="alert alert-success alert-dismissible">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  Item Added into Cart
	</div>
	';
 }
 
 if(isset($_GET["remove"]))
 {
	$message = '
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Item removed from Cart
	</div>
	';
 }
 if(isset($_GET["clearall"]))
 {
	$message = '
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Your Shopping Cart has been clear...
	</div>
	';
 }
 if(empty($_SESSION['username']) and empty($_SESSION['password'])) {
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
 <html>  
      <head>  
           <title>Webslesson Tutorial | Simple PHP Mysql Shopping Cart</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>    
		   <div style="clear:both"></div>  
                <br />  
                <h3>Pilih Hewan</h3>  
                <div class="table-responsive">  
				<label for="jenis hewan" >Pilih Hewan</label>
													<select style="color:red" name="id_hewan"  class="form-control" required>
														<option value="" >-- Pilih Hewan --</option>
														<?php 
														$ambil = $koneksi->query("SELECT * FROM biohewan WHERE id_pelanggan = {$_SESSION['id_pelanggan']}");
														while($perongkir = $ambil->fetch_assoc()) { 
														?>
														<option value="<?php echo $perongkir['id_hewan']; ?>">
															<?php echo $perongkir['nama_hewan']; ?>
														</option>
														<?php } ?>
													</select> <br>
													</div>
           <div class="container" style="width:700px;">  
                <h3 align="center">Pelayanan Orion Pet Lover</h3><br />  
                <?php  
                $query = "SELECT * FROM produk ORDER BY kd_produk ASC";  
                $result = mysqli_query($koneksi, $query);  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>  
                <div class="col-md-4">  
                     <form method="post" action="coba.php?action=add&id=<?php echo $row["kd_produk"]; ?>">  
                          <div style="border:2px solid #333; background-color:#f1f1f1; border-radius:8px; padding:24px;" align="center">  
                               <h4 class="text-info"><?php echo $row["nama"]; ?></h4>  
                               <h4 class="text-danger">Rp. <?php echo $row["harga"]; ?></h4>  
                               <input type="text" name="quantity" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_nama" value="<?php echo $row["nama"]; ?>" />  
                               <input type="hidden" name="hidden_harga" value="<?php echo $row["harga"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  
                          </div>  
                     </form>  
                </div>  
				
                <?php  
                     }  
                ?>  
                <div style="clear:both"></div>  
                <br />  
                <h3>Order Details</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="20%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>  
						  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_nama"]; ?></td>  
                               <td><?php echo $values["quantity"]; ?></td>  
                               <td>Rp. <?php echo $values["item_harga"]; ?></td>  
                               <td>Rp. <?php echo number_format($values["quantity"] * $values["item_harga"], 2); ?></td>  
                               <td><a href="index.php?action=delete&id=<?php echo $values["item_kd_produk"]; ?>"><span class="text-danger">Remove</span></a></td>  
                          </tr>  
                          <?php  
									$total = $total + ($values["quantity"] * $values["item_harga"]);  
									$item_details[] = [
										'id' => 'ITEM',
										'price' => $values["item_harga"],
										'quantity' => $values["quantity"],
										'name' =>  $values["item_nama"]
									];
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>  
                               <td align="right">Rp. <?php echo number_format($total, 2); ?></td>  
                               <td>								<button class="btn btn-primary" id="pay-button">Order</button><br>
</td>  
                          </tr>  
						  
						  <?php  
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
										'gross_amount' => $total,
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
									);

									$snapToken = \Midtrans\Snap::getSnapToken($transaction);
                          }  
                          ?>  
						 
							</form>
						</div><!-- /.panel -->
					 
					<!--  -->


				</div>
				<!--/row-->
			</div>
		
			<!--/span-->
			<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-YRFDLoC8PhNsZFgK"></script>
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
<?php } }
?>

						 