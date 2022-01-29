<?php
$koneksi = new mysqli("localhost", "root", "", "oplbaru");
session_start();
if (empty($_SESSION['email']) and empty($_SESSION['password'])) {
  echo '<script>window.location="login.php";</script>';
} else {
?>
  <!DOCTYPE html>
  <html lang="id">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Data Hewan - Orion Pet Lover</title>
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
                <a href="../home.php" class="author-area__seller-btn inline"><i class="lnr lnr-home"></i>Home</a>
                <a href="../media/pesanan.php" style="color:black;"><i class="lnr lnr-book"></i>Reservasi</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="../konsul.php" style="color:black;"><i class="lnr lnr-users"></i>Konsultasi</a>
              </div>
            </div>
            <div class="col-lg-8 offset-lg-1 col-md-9 col-6 v_middle">
              <div class="author-area">
                <div class="author__notification_area">
                  <ul>
                    <li class="has_dropdown">
                      <div class="icon_wrap">
                        <a href="/keranjang.php">
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
                          <a href="pelanggan.php">
                            <span class="lnr lnr-user"></span> Akun</a>
                        </li>
                        <li>
                          <a href="hewan.php">
                            <span class="lnr lnr-smile"></span> Data Hewan</a>
                        </li>
                        <li>
                          <a href="keranjang.php">
                            <span class="lnr lnr-cart"></span> Pesanan</a>
                        </li>
                        <li>
                          <a href="../logout.php" onclick="return confirm('Apakah Anda Yakin Ingin keluar?')">
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
                  <a href="#">Data Hewan</a>
                </li>
              </ul>
            </div>
            <h1 class="page-title">Ubah Data Hewan</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="signup_area section--padding2">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 offset-lg-3">
            <div class="cardify signup_form">
              <div class="login--header">
                <h3>Ubah Data Hewan</h3>
              </div>
              <?php
              $ambil = $koneksi->query("SELECT * FROM biohewan WHERE id_hewan='$_GET[id]'");
              $pecah = $ambil->fetch_assoc(); ?>
              <form name="ubahpassword" id="ubahpassword" action="../cekubahpassword.php" method="POST" role="form" class="lead">
                <div class="login--form">
                  <div class="form-group">
                    <label for="urname">Nama Hewan</label>
                    <input type="text" class="text_field" name="nama_hewan" value="<?php echo $pecah['nama_hewan']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="urname">Umur Hewan</label>
                    <input type="text" class="text_field" name="umur" value="<?php echo $pecah['umur']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="urname">Jenis Hewan</label>
                    <select name="id_jenishewan" class="form-control" required>
                      <option value="">-- Pilih Kategori --</option>
                      <?php
                      $ambil = $koneksi->query("SELECT * FROM jenis_hewan");
                      while ($perongkir = $ambil->fetch_assoc()) {
                      ?>
                        <option value="<?php echo $perongkir['id_jenishewan']; ?>">
                          <?php echo $perongkir['jenis_hewan']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                  <button class="btn btn--md btn--round register_btn" type="submit">Ubah</button>
                </div>
                <?php
                if (isset($_POST['submit'])) {
                  $koneksi->query("UPDATE biohewan SET id_jenishewan='$_POST[jenis_hewan]', nama_hewan='$_POST[nama_hewan]',umur='$_POST[umur]' WHERE id_hewan='$_GET[id]'");

                  echo "<script>alert('Data hewan telah diubah');</script>";
                  echo "<script>location='hewan.php';</script>";
                }
                ?>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer class="footer-area">
      <div class="footer-big section--padding">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6">
              <div class="info-footer">
                <p class="info--text">Klinik Orion Pet Lover yang berkonsentrasi di layanan online kebutuhan hewan kesayangan.</p>
                <ul class="info-contact">
                  <li>
                    <span class="lnr lnr-phone info-icon"></span>
                    <span class="info">Telepon: <a href="tel:081904200708">0819 0420 0708</a></span>
                  </li>
                  <li>
                    <span class="lnr lnr-map-marker info-icon"></span>
                    <span class="info">Jl. Kebon Agung No.6, Area Sawah, Tlogoadi, Kec. Mlati, Kabupaten Sleman Daerah Istimewa Yogyakarta 55286</span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-5 col-md-6">
              <div class="footer-menu">
                <h4 class="footer-widget-title text--white">Link</h4>
                <ul>
                  <li>
                    <a href="#">Beranda</a>
                  </li>
                  <li>
                    <a href="#">Kebijakan Layanan</a>
                  </li>
                  <li>
                    <a href="#">Kebijakan Privasi</a>
                  </li>
                  <li>
                    <a href="#">Sitemap</a>
                  </li>
                  <li>
                    <a href="#">Login</a>
                  </li>
                  <li>
                    <a href="#">Daftar</a>
                  </li>
                </ul>
              </div>
              <div class="footer-menu">
                <h4 class="footer-widget-title text--white">Layanan</h4>
                <ul>
                  <li>
                    <a href="#">Semua Layanan</a>
                  </li>
                  <li>
                    <a href="#">Konsultasi</a>
                  </li>
                  <li>
                    <a href="#">&nbsp;</a>
                  </li>
                  <li>
                    <a href="#">&nbsp;</a>
                  </li>
                  <li>
                    <a href="#">&nbsp;</a>
                  </li>
                  <li>
                    <a href="#">&nbsp;</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-4 col-md-12">
              <div class="newsletter">
                <h4 class="footer-widget-title text--white">Penawaran</h4>
                <p>Masukkan email untuk mendapatkan promo dari kami</p>
                <div class="newsletter__form">
                  <form action="#">
                    <div class="field-wrapper">
                      <input class="relative-field rounded" type="text" placeholder="Masukkan email">
                      <button class="btn btn--round" type="submit">Langganan</button>
                    </div>
                  </form>
                </div>
                <div class="social social--color--filled">
                  <ul>
                    <li>
                      <a href="#">
                        <span class="fa fa-facebook"></span>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <span class="fa fa-twitter"></span>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <span class="fa fa-google-plus"></span>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <span class="fa fa-pinterest"></span>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <span class="fa fa-linkedin"></span>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <span class="fa fa-dribbble"></span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mini-footer">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="copyright-text">
                <p>&copy; 2022
                  <a href="#">Orion Pet Lover</a>. Hak cipta dilindungi undang - undang.
                </p>
              </div>
              <div class="go_top">
                <span class="lnr lnr-chevron-up"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
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
  </body>

  </html>
<?php } ?>