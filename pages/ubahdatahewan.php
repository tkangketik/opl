<?php
$koneksi = new mysqli("localhost","root","","oplbaru");
session_start();

$ambil = $koneksi->query("SELECT * FROM biohewan WHERE id_hewan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
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
                  <div class="col-lg-5">
									<h3 class="panel-title" style=" margin-left:230px;"><span class="fa fa-pencil-square-o"></span> Ubah Data Hewan </h3>
									</div>
									<div class="panel-body">
									<form style=" margin-left:230px;" name="ubahdatahewan.php" id="ubahdata" method="POST" role="form" class="lead">
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-12">
												<div class="form-group">
													<label>Nama Hewan</label>
		                          <input style="color:red" type="text" class="form-control" name="nama_hewan" value="<?php echo $pecah['nama_hewan']; ?>">
                        </div>
											</div>
										</div>
                    <div class="row">
											<div class="col-xs-6 col-sm-6 col-md-12">
												<div class="form-group">
													<label>Umur Hewan</label>
                            <input style="color:red" type="text" class="form-control" name="umur" value="<?php echo $pecah['umur']; ?>">
                        </div>
											</div>
										</div>
										<div class="form-group">
											<label for="jenis hewan" >Jenis Hewan</label>
													<select style="color:red" name="id_jenishewan"  class="form-control" required>
														<option value="">-- Pilih Kategori --</option>
														<?php 
														$ambil = $koneksi->query("SELECT * FROM jenis_hewan");
														while($perongkir = $ambil->fetch_assoc()) { 
														?>
														<option value="<?php echo $perongkir['id_jenishewan']; ?>">
															<?php echo $perongkir['jenis_hewan']; ?>
														</option>
														<?php } ?>
													</select>
										</div><br>
										<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-skin btn-block btn-lg">
									</form>
                                    <?php
                                        if (isset($_POST['submit'])) 
                                        { 
                                            $koneksi->query("UPDATE biohewan SET id_jenishewan='$_POST[jenis_hewan]', nama_hewan='$_POST[nama_hewan]',umur='$_POST[umur]' WHERE id_hewan='$_GET[id]'");

                                            echo "<script>alert('Data hewan telah diubah');</script>";
                                            echo "<script>location='hewan.php';</script>";
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
    </section>
  
    
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
