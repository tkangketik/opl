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
				<div class="col-md-4">
      <div class="row">
        <div class="col-md-4">
          <div class="form-wrapper">
          <div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">
            <div class="panel panel-skin">
            <div class="panel-heading">
              <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Data Hewan </h3></div>
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Hewan</th>
                  <th>Umur hewan</th>
                  <th>Jenis hewan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
    $nomor = 1;
  ?>
  <?php 
    $ambil = $koneksi->query("SELECT * FROM biohewan WHERE id_pelanggan='$_SESSION[id_pelanggan]'");
    // $ambil = $koneksi->query("SELECT h.nama_hewan, h.umur, j.jenis_hewan, h.alamat FROM biohewan AS h INNERJOIN jenis_hewan AS j ON h. WHERE id_pelanggan='$_SESSION[id_pelanggan]'");
    
  ?>
  <?php
    while ($pecah = $ambil->fetch_assoc()) {
      # code...
  ?>
  <tr>
    <td style="color:red; text-align:center;"><?php echo $nomor; ?></td>
    <td style="color:red; text-align:center;"><?php echo $pecah['nama_hewan']; ?></td>
    <td style="color:red; text-align:center;"><?php echo $pecah['umur']; ?></td>
    <td style="color:red; text-align:center;"><?php echo $pecah['id_jenishewan']; ?></td>
    <td>
      <a href="hapusdatahewan.php?id=<?php echo $pecah['id_hewan']; ?>" class="btn-danger btn">Hapus</a>
      <a href="ubahdatahewan.php?id=<?php echo $pecah['id_hewan']; ?>" class="btn btn-warning" >Ubah</a>
    </td>
  </tr>
  <?php
    $nomor++;
  ?>
  <?php
    }
  ?>
</tbody>
</table>
              </div>
          </div>
        </div>					
      </div>		
    </div>
  </div>		
  </section> 
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