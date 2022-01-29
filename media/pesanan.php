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
    <title>Reservasi - Orion Pet Lover</title>
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
                <a href="../home.php" style="color:black;"><i class="lnr lnr-home"></i>Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="pesanan.php" class="author-area__seller-btn inline"><i class="lnr lnr-book"></i>Reservasi</a>
                <a href="../konsul.php" style="color:black;"><i class="lnr lnr-users"></i>Konsultasi</a>
              </div>
            </div>
            <div class="col-lg-8 offset-lg-1 col-md-9 col-6 v_middle">
              <div class="author-area">
                <div class="author__notification_area">
                  <ul>
                    <li class="has_dropdown">
                      <div class="icon_wrap">
                        <a href="../pages/keranjang.php">
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
                          <a href="../pages/pelanggan.php">
                            <span class="lnr lnr-user"></span> Akun</a>
                        </li>
                        <li>
                          <a href="../pages/hewan.php">
                            <span class="lnr lnr-smile"></span> Data Hewan</a>
                        </li>
                        <li>
                          <a href="../pages/keranjang.php">
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
                  <a href="#">Reservasi</a>
                </li>
              </ul>
            </div>
            <h1 class="page-title">Reservasi</h1>
          </div>
        </div>
      </div>
    </section>
    <?php
    function build_calendar($month, $year)
    {
      global $koneksi;
      $daysOfWeek = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
      $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
      $numberDays = date('t', $firstDayOfMonth);
      $dateComponents = getdate($firstDayOfMonth);
      $monthName = $dateComponents['month'];
      $dayOfWeek = $dateComponents['wday'];
      $datetoday = date('Y-m-d');
      $calendar = "<table class='table table-bordered'>";
      $calendar .= "<div class='modules__content'><div class='pagination-area pagination-area2'><nav class='navigation pagination' role='navigation'><div class='nav-links'><a class='prev page-numbers' href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) . "'><span class='lnr lnr-arrow-left'></span></a>";
      $calendar .= "<h3 class='page-numbers'>$monthName $year</h3>";
      $calendar .= "<a class='next page-numbers' href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) . "'><span class='lnr lnr-arrow-right'></span></a></div></nav></div></div></div>";
      $calendar .= "<tr>";
      foreach ($daysOfWeek as $day) {
        $calendar .= "<th  class='header'>$day</th>";
      }
      $currentDay = 1;
      $calendar .= "</tr><tr>";
      if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
          $calendar .= "<td  class='empty'></td>";
        }
      }
      $month = str_pad($month, 2, "0", STR_PAD_LEFT);
      while ($currentDay <= $numberDays) {
        if ($dayOfWeek == 7) {
          $dayOfWeek = 0;
          $calendar .= "</tr><tr>";
        }
        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
        $dayname = strtolower(date('l', strtotime($date)));
        $eventNum = 0;
        $today = $date == date('Y-m-d') ? "today" : "";
        if ($dayname == 'sunday') {
          $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn--icon btn-sm btn--round btn-warning mt-4'>Libur</button>";
        } else if ($date < date('Y-m-d')) {
          $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn--icon btn-sm btn--round btn-danger mt-4'><span class='lnr lnr-cross'></span></button>";
        } else {
          $totalbookings = checkSlots($koneksi, $date);
          if ($totalbookings == 11) {
            $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='#' class='btn btn-danger btn-xs'>Penuh</a>";
          } else {
            $availableslots = 11 - $totalbookings;
            $calendar .= "<td class='$today'><small><i>$availableslots slot </i></small><h4><strong>$currentDay</strong></h4> <a href='pesan.php?date=" . $date . "' class='btn btn--icon btn-sm btn--round btn-info mt-2'><span class='lnr lnr-checkmark-circle'></span>Pesan</a>";
          }
        }
        $calendar .= "</td>";
        $currentDay++;
        $dayOfWeek++;
      }
      if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        for ($l = 0; $l < $remainingDays; $l++) {
          $calendar .= "<td class='empty'></td>";
        }
      }
      $calendar .= "</tr>";
      $calendar .= "</table>";
      echo $calendar;
    }
    function checkSlots($koneksi, $date)
    {
      $stmt = $koneksi->prepare("select * from transaksi where tanggal = ?");
      $stmt->bind_param('s', $date);
      $totalbookings = 0;
      if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $totalbookings++;
          }
          $stmt->close();
        }
      }
      return $totalbookings;
    }
    ?>
    <section class="section--padding2 bgcolor">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="">
              <div class="modules__content">
                <div class="withdraw_module withdraw_history">
                  <div class="withdraw_table_header">
                    <h3>Pilih Tanggal</h3>
                  </div>
                  <div class="col-md-12">
                    <?php
                    $dateComponents = getdate();
                    if (isset($_GET['month']) && isset($_GET['year'])) {
                      $month = $_GET['month'];
                      $year = $_GET['year'];
                    } else {
                      $month = $dateComponents['mon'];
                      $year = $dateComponents['year'];
                    }
                    echo build_calendar($month, $year);
                    ?>
                  </div>
                </div>
              </div>
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