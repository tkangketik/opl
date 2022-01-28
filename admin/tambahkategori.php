<?php
// session_start();
// //Koneksi
include 'cektambahkategori.php';
$koneksi = new mysqli('localhost', 'root', '', 'oplbaru');
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
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
} else {
     ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="home.php">Orion Pet Lovers</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <!-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> -->
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="ubahpass.php">Ubah Password</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="home.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="pelanggan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Pelanggan
                            </a>
                            <a class="nav-link" href="datahewan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Data Hewan
                            </a>
                            <a class="nav-link" href="transaksi.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Transaksi
                            </a>
                            <a class="nav-link" href="kategori.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Kategori
                            </a>
                            <a class="nav-link" href="pelayanan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Pelayanan
                            </a>
                    </div>
                    <!-- <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                       Monjali Petshop
                    </div> -->
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <div class="row">
		<div class="col-xs-12">
		
</div>
<!-- Konten -->
<div class="page-content"><br>
<div class="row">

									<center><h3 class="panel-title"></span><font size="5" face="Times new roman"> Tambah Kategori </h3></center></font>
									</div>
									<div class="panel-body">
									<form action="" method="POST" role="form" class="lead">
									<div class="btn btn-skin btn-block btn-lg">
										<!-- <div class="cta-btn"> -->
										<!-- <a href="media/pesanan.php" class="btn btn-skin btn-lg">Pesan Sekarang!</a>	 -->
									</div><br>
									<input type="text"  hidden name="id_admin" value="<?= $_SESSION['id_admin'] ?>">
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-12">
												<div class="form-group">
													<label><font face="Times new roman">Nama Kategori</label>
													<input type="text" name="nama_kategori" onkeypress='return harusHuruf(event)' placeholder="Nama" id="nama_kategori" class="form-control input-md" required data-error="">
												<script>
													function harusHuruf(evt){
															var charCode = (evt.which) ? evt.which : event.keyCode
															if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
																return false;
															return true;
													}
												</script>
                                                </div>
											</div>
										</div>
                                        <div><br>
										<input type="submit" value="Submit" name="submit" class="btn btn-primary pull-right">
</div>
									</form>
								</div>
							</div>	
                            </div>
                        </div>
                    </div>
                </main>
						    </div>
						</div>
					</div>					
				</div>		
			</div>
		</div>		
    </section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php
}
?>			