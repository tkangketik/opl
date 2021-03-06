<?php
// session_start();
// //Koneksi
include 'koneksi.php';
session_start();
if (empty($_SESSION['email']) and empty($_SESSION['password'])) {
    echo '
    <center>
        <br><br><br><br><br><br><br><br><br>
        <b> Maaf silahkan Login kembali </b><br>
        <b> Anda telah keluar dari sistem</b>
        <br>
        <a href="index.php" tittle="Klik Gambar Untuk Kembali ke Halaman MASUK"><br>
        <img src="../img/photo/logo2.png" height="100" width="120"></img>
        </a>
    </center>';
} else {

    $idPelayanan = $_GET['id'];
    $queryPelayanan = query(
        "SELECT * FROM  produk WHERE kd_produk = '$idPelayanan'"
    )[0];
    ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Orion Pet Lover - Pelanggan</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Orion Pet Lover</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Reservasi</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data:</h6>
                        <a class="collapse-item" href="pelanggan.php">Pelanggan</a>
                        <a class="collapse-item" href="hewan.php">Hewan</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Pelayanan</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pelayanan:</h6>
                        <a class="collapse-item" href="kategori.php">Kategori</a>
                        <a class="collapse-item" href="pelayanan.php">Pelayanan</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Transaksi</span></a>
            </li>

            <!-- Nav Item - Tables -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ubah Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-8">
                    <div class="row">
		<div class="col-xs-12">
		
</div>
<div class="page-content"><br>

        
									<form action="" method="POST" role="form" class="lead">
									<div class="btn btn-skin btn-block btn-lg">
										<!-- <div class="cta-btn"> -->
										<!-- <a href="media/pesanan.php" class="btn btn-skin btn-lg">Pesan Sekarang!</a>	 -->
									</div><br>
									<input type="text"  hidden name="id_admin" value="<?= $_SESSION['id_admin'] ?>">
										<div class="row">
											<div class="col-xs-10 col-sm-6 col-md-12">
												<div class="form-group">
													<label><font face="Times new roman">Nama</label>
													<input type="text" name="nama" onkeypress='return harusHuruf(event)' placeholder="Nama" id="nama" class="form-control input-md" value="<?= $queryPelayanan['nama'] ?>">
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
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-12">
												<div class="form-group">
													<label>Harga</label>
													<input type="number" name="harga" placeholder="Harga" id="harga" class="form-control input-md" value="<?= $queryPelayanan['harga' ] ?>" onkeypress="return hanyaAngka(event)">
												<script>
															function hanyaAngka(evt) {
															var charCode = (evt.which) ? evt.which : event.keyCode
															if (charCode > 31 && (charCode < 48 || charCode > 57))
													
																return false;
															return true;
															}
												</script>
                                                </div>
											</div>
										</div>
                                        <!-- <div class="row"> -->
                                           
                                        <label for="exampleFormControlSelect1">Kategori</label>
										<select name="kategori" class="form-control" id="nama_kategori">
											<option>----Pilih Kategori---</option>
                                            <?php
                                            $kategori = query(
                                                'SELECT * FROM kategori'
                                            );

                                            foreach ($kategori as $row): ?>
                                                <option <?= $row[
                                                    'kd_kategori'
                                                ] ==
                                                $queryPelayanan['kd_kategori']
                                                    ? 'selected'
                                                    : '' ?> value="<?= $row['kd_kategori'] ?>"> 
                                                
                                                <?= $row['nama_kategori'] ?>

                                                 </option>
                                            <?php endforeach;
                                            ?>
										</select>
										</div></font>
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-12">
													<label><font size="4" face="Times new roman">Keterangan</label>
													<textarea class="col-xs-12 col-sm-12" type="text" name="keterangan" id="keterangan" class="form-control input-md"><?= $queryPelayanan[
                                                        'keterangan'
                                                    ] ?></textarea>
												</div>
											</div></font>
										</div>
                                        <div>
										<input type="submit" value="Submit" name="submit" class="btn btn-primary pull-right">
                                        <div>
									</form>
                                     <?php 
                                     if (isset($_POST['submit'])) {
                                         $koneksi->query("UPDATE produk SET kd_kategori='$_POST[kategori]', nama='$_POST[nama]',
                                        harga='$_POST[harga]',keterangan='$_POST[keterangan]' WHERE kd_produk='$_GET[id]'");

                                         echo "<script>alert('Data pelayanan telah diubah');</script>";
                                         echo "<script>location='pelayanan.php?halaman=pelayanan';</script>";
                                     } ?>
								</div>
							</div>	
                            </div>
                        </div>
                    </div>
                </main>
                            </div>
                            
                            
                            <footer class="sticky-footer bg-white">
<div class="container my-auto">
<div class="copyright text-center my-auto">
    <span>Copyright &copy; Your Website 2020</span>
</div>
</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">??</span>
</button>
</div>
<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<a class="btn btn-primary" href="login.html">Logout</a>
</div>
</div>
</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>

<?php
}
?>