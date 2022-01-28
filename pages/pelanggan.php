<?php
// session_start();
// //Koneksi
$koneksi = new mysqli("localhost","root","","oplbaru");
session_start();
if(empty($_SESSION['email']) and empty($_SESSION['password'])) {
    echo '
    <center>
        <br><br><br><br><br><br><br><br><br>
        <b> Maaf silahkan Login kembali </b><br>
        <b> Anda telah keluar dari sistem</b>
        <br>
        <a href="masuk.php" tittle="Klik Gambar Untuk Kembali ke Halaman MASUK">
        <img src="img/photo/logo2.png" height="100" width="120"></img>
        </a>
    </center>';
} else{

?>

<!DOCTYPE html>
<html lang="">

<head>
<title>Orion Pet Lover</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">

<!-- Top Background Image Wrapper -->
<div class="bgded overlay padtop" style="background-image:url('../images/demo/backgrounds/bg4.png');"> 
  <header id="header" class="hoc clear">
    <div id="logo" class="fl_left"> 
     
      <h1><a href="../index.html">Orion Pet Lover</a></h1>
      
    </div>
    <nav id="mainav" class="fl_right"> 
      
      <ul class="clear">
        <li><a href="../home.php">Home</a></li>
        <li><a class="drop" href="../home.php">Pelayanan</a>
          <ul>
            <li><a href="#">Vaksin</a></li>
            <li><a href="#">Suntik Jamur</a></li>
            <li><a href="#">Suntik Obat Cacing</a></li>
          </ul>
        </li>
        <li><a href="Keranjang.php">Keranjang</a></li>
        <li><a class="drop" href="#">Data Onwer</a>
              <ul>
              <li><a href="pelanggan.php">Data Pelanggan</a></li>
              <li><a href="hewan.php">Data Hewan</a></li>
              </ul>
        </li>
        <li><a class="drop" href="#">Akun</a>
              <ul>
              <li><a href="ubah_password.php">Ubah Password</a></li>
              <li><a href="hewan.php">Keluar</a></li>
              </ul>
        </li>
      </ul>
     
    </nav>
  </header>
 
  <div id="breadcrumb" class="hoc clear">  
  <div class="wrapper row3">
  <!-- <main class="hoc container clear">  -->
  <!-- <div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s"> -->
							<div class="panel panel-skin">
							<div class="panel-heading">
								<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Data Pelanggan </h3></div>
                                    <div class="form-wrapper">
                                        <div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">
                                            <div class="panel-heading">
                                                <table class="table-form" border="0" width="100%" cellpadding="0" cellspacing="0">
                                                    <?php
                                                        $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email='$_SESSION[email]'");
                                                        // $pecah = $ambil->fetch_assoc();
                                                        while($row = $ambil->fetch_assoc()){
                                                    ?>
                                                    <tr>
                                                        <td width="20%">Nama Lengkap</td>
                                                        <td width="1%">:</td>
                                                        <td><?php echo $row["nama_pelanggan"]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td width="1%">:</td>
                                                        <td><?php echo $row["email"]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>No Handphone</td>
                                                        <td width="1%">:</td>
                                                        <td><?php echo $row["no_hp"]; ?></td>
                                                    </tr>
												                          	<tr>
                                                        <td>Alamat</td>
                                                        <td width="1%">:</td>
                                                        <td><?php echo $row["alamat"]; ?></td>
                                                    </tr>
                                                    
                                                </table><br>
                                                <div class="wow lightSpeedIn" data-wow-delay="0.1s">
                                                    <a href="ubahdatapelanggan.php?id=<?php echo $row['id_pelanggan']; ?>" class="btn btn-skin btn-lg">Ubah Data</a>	
                                                    <a href="home.php" class="btn btn-skin btn-lg">Kembali</a>	
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
                    </div>		
                  </div>
      
     
     
    </div>
    
  </div>
 
</div>
<div>
  <section id="ctdetails" class="hoc clear"> 
    
    <ul class="nospace clear">
      <li class="one_quarter first">
        <div class="block clear"><a href="#"><i class="fas fa-phone"></i></a> <span><strong>Give us a call:</strong> +00 (123) 456 7890</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear"><a href="#"><i class="fas fa-envelope"></i></a> <span><strong>Send us a mail:</strong> support@domain.com</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear"><a href="#"><i class="fas fa-clock"></i></a> <span><strong> Mon. - Sat.:</strong> 08.00am - 18.00pm</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear"><a href="#"><i class="fas fa-map-marker-alt"></i></a> <span><strong>Come visit us:</strong> Directions to <a href="#">our location</a></span></div>
      </li>
    </ul>
  </section>
</div>


  
<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="../layout/scripts/jquery.min.js"></script>
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>
<?php
}
?>