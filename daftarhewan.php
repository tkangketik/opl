<?php
session_start();
include "fungsi.php";

if (isset($_POST['insert'])) {
    if (BiodataKucing($_POST) > 0) {
        echo "<script>alert('Input Data Berhasil Silahkan Masuk!'); window.location='checkout.php'</script>";
    } else {
        echo "<script>alert('Gagal Input Data Silahkan Periksa Kembali!'); window.location='media/pesan.php'</script>";
    }
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
<html lang="">

<head>
<title>Orion Pet Lover</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">

<!-- Top Background Image Wrapper -->
<div class="bgded overlay padtop" style="background-image:url('images/demo/backgrounds/bg4.png');"> 

  <header id="header" class="hoc clear">
    <div id="logo" class="fl_left"> 
     
      <h1><a href="index.html">Orion Pet Lover</a></h1>
   
    </div>
    <nav id="mainav" class="fl_right"> 
    
      <ul class="clear">
        <li class="active"><a href="home.php">Home</a></li>
        <li><a class="drop" href="#">Pelayanan</a>
          <ul>
            <li><a href="#">Vaksin</a></li>
            <li><a href="#">Suntik Jamur</a></li>
            <li><a href="#">Suntik Obat Cacing</a></li>
          </ul>
        </li>
        <li><a href="Keranjang.php">Keranjang</a></li>
        <li><a class="drop" href="#">Data Onwer</a>
              <ul>
              <li><a href="pages/pelanggan.php">Data Pelanggan</a></li>
              <li><a href="pages/hewan.php">Data Hewan</a></li>
              </ul>
        </li>
        <li><a class="drop" href="#">Akun</a>
              <ul>
              <li><a href="pelanggan.php">Ubah Password</a></li>
              <li><a href="hewan.php">Keluar</a></li>
              </ul>
        </li>
      </ul>
     
    </nav>
  </header>
  
    <section id="home" class="home">
		<div class="intro-content">
			<div class="container">
				<div class="row">
				<!-- <div class="col-md-5">	 -->
						<!-- <div class="form-wrapper"> -->
						<!-- <div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s"></div> -->
							<!-- <div class="panel panel-skin"> -->
							<!-- <div class="panel-heading"> -->
									</div>
									<!-- <div class="panel-body"> -->
									<form style=" margin-left:230px;" action="" method="POST" role="form" class="lead">
									<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Form Biodata Hewan </h3>
									
									<input type="hidden" hidden name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?>">
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-12">
											
												<div class="form-group">
								 					<label>Nama Hewan</label>
													<input style="color:red" type="text" name="nama_hewan" placeholder="Nama" id="nama_hewan" class="form-control input-md" required data-error="">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-12">
												<div class="form-group">
													<label>Umur Hewan</label>
													<input style="color:red" type="text" name="umur" placeholder="Umur" id="umur" class="form-control input-md" required data-error="">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="jenis hewan" >Jenis Hewan</label>
													<select style="color:red" name="id_jenishewan"  class="form-control" required>
														<option value="" >-- Pilih Kategori --</option>
														<?php 
														$ambil = $koneksi->query("SELECT * FROM jenis_hewan");
														while($perongkir = $ambil->fetch_assoc()) { 
														?>
														<option value="<?php echo $perongkir['id_jenishewan']; ?>">
															<?php echo $perongkir['jenis_hewan']; ?>
														</option>
														<?php } ?>
													</select> 
										</div>
										<br>
										<input type="submit" value="Submit" name="insert" class="btn btn-skin btn-block btn-lg">
										
									</form>
								</div>
							</div>				
						
						</div>
						</div>
					</div>					
				</div>		
			</div>
		</div>		
    </section>
	
  
  
  </div>
  
</div>
<!-- End Top Background Image Wrapper -->

<div class="wrapper row1">
  <section id="ctdetails" class="hoc clear"> 
    
    <ul class="nospace clear">
      <li class="one_quarter first">
        <div class="block clear"><a href="#"><i class="fas fa-phone"></i></a> <span><strong>Give us a call:</strong> 0819 0420 0708</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear"><a href="#"><i class="fas fa-envelope"></i></a> <span><strong>Send us a mail:</strong> support@domain.com</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear"><a href="#"><i class="fas fa-clock"></i></a> <span><strong> Mon. - Sat.:</strong> 08:30 s/d 22:00 WIB</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear"><a href="#"><i class="fas fa-map-marker-alt"></i></a> <span><strong>Come visit us:</strong> Directions to <a href="#">our location</a></span></div>
      </li>
    </ul>
    
  </section>
</div>

	
	<!-- /Section: intro -->

	
<!-- JAVASCRIPTS -->
<script src="../layout/scripts/jquery.min.js"></script>
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>
<?php
}
?>