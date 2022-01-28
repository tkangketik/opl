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
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Orion Pet Lovers</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <style>
        h1{
            text-align: center;
        @page{
            margin:0;
        }
    </style>
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
                       Orion Pet Lovers
                    </div> -->
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <div class="row">
		<div class="col-xs-12">
		
</div>
    
<h1><font size="5" face="Comic Sans">Jadwal Perawatan Kucing</h1></font>

 <!-- <table border="1">
  <tr>
   <td>No.</td>
   <td>No Pembayaran</td>
   <td>Pemesan</td>
   <td>No Sertifikat</td>
   <td>Nama Kucing</td>
   <td>Jenis Kucing</td>
   <td>Umur Kucing</td>
   <td>Tanggal</td>
   <td>Waktu</td>
   <td>Total</td>
  </tr>
  <?php
			$nomor = 1;
		?> -->
  <?php
  $koneksi = new mysqli("localhost","root","","oplbaru");
//   session_start();

  $id = $_GET['id'];


  function query($query)
  {
      global $koneksi;
      $result = mysqli_query($koneksi, $query);
      $rows = [];
      while ($row = mysqli_fetch_assoc($result)) {
          $rows[] = $row;
      }
      return $rows;
  }

  $queryTransaksi = query("SELECT * FROM transaksi WHERE kd_transaksi = '$id'")[0];
  $idPelanggan =  $queryTransaksi['id_pelanggan'];
  $idBiodataKucing = $queryTransaksi['id_hewan'];
  $queryPelanggan = query("SELECT * FROM pelanggan WHERE id_pelanggan = '$idPelanggan'")[0];
  $queryBidataKucing = query("SELECT * FROM biohewan WHERE id_pelanggan = '$idPelanggan' AND id_hewan = '$idBiodataKucing'")[0];
  // $email = $_POST['email'];
  // $password = md5($_POST['password']);
  
  // $query = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN jenis ON transaksi.kd_transaksi = jenis.id_jenis 
  // INNER JOIN pelanggan ON biodatakucing.id_pelanggan = pelanggan.id_pelanggan");

//   $query = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN biodatakucing ON transaksi.kd_transaksi = biodatakucing.id_kucing ");
  

?>

    <!-- <tr>
        <td><?= $nomor ?></td>
        <td><?= $queryTransaksi['no_pembayaran'] ?></td>
        <td><?= $queryPelanggan['nama_pelanggan'] ?></td>
        <td><?= $queryBidataKucing['nama_hewan'] ?></td>
        <td><?= $queryBidataKucing['umur'] ?></td>
        <td><?= $queryTransaksi['tanggal'] ?></td>
        <td><?= $queryTransaksi['timeslot'] ?></td>
        <td><?= $queryTransaksi['total'] ?></td>
    </tr>  

 </table> -->
 <!-- <p><font size="3" face="Comic Sans">Terima Kasih Atas Pemesanannya <?php echo $_SESSION['nama_pelanggan']  ?> Di Monjali Petshop <br> Kami Memberikan PELAYANAN TERBAIK, HARGA TERBAIK :) </p>
 <p><font size="2" face="Comic Sans">Untuk Perubahan Jadwal Silahkan Menghubungi Admin <br> CP Admin : +6282170507752</p> -->

 <!-- <center> -->
 <table border="0" cellpadding="7">
            <td size="90">No Pembayaran</td>
            <td>: <?= $queryTransaksi['no_pembayaran'] ?></td>
        </tr>
        <tr>
            <td>No Pemesan</td>
            <td>: <?= $queryPelanggan['nama_pelanggan'] ?></td>
        </tr>
        <tr>
            <td>Nama Kucing</td>
            <td>: <?= $queryBidataKucing['nama_hewan'] ?></td>
        </tr>
        <tr>
            <td>Umur Kucing</td>
            <td>: <?= $queryBidataKucing['umur'] ?></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>: <?= $queryTransaksi['tanggal'] ?></td>
        </tr>
        <tr>
            <td>Waktu</td>
            <td>: <?= $queryTransaksi['timeslot'] ?></td>
        </tr>
        <tr>
            <td>Total</td>
            <td>: Rp.<?= $queryTransaksi['total'] ?></td>
        </tr>
        <br><td>
				<!-- <a href="hapusdata.php?id=<?php echo $pecah['kd_transaksi']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ?');" class="btn-danger btn">Hapus Data</a> &nbsp  -->
				<!-- <a href="ubahdata.php?id=<?php echo $pecah['kd_transaksi']; ?>" class="btn btn-primary">Ubah</a> -->
                <a href="transaksi.php" class="btn btn-primary">Kembali</a>
			</td>
        <!-- </center> -->
    </table>
<!-- <script>
    window.print();
</script> -->
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