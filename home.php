<?php
$koneksi = new mysqli("localhost", "root", "", "oplbaru");
session_start();
if (empty($_SESSION['email']) and empty($_SESSION['password'])) {
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
  <html lang="id">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orion Pet Lover</title>
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/fontello.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/lnr-icon.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/trumbowyg.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png"> <!-- hapus jika tidak mempunyai favicon -->
  </head>

  <body class="preload home2 single-vendor">
    <div class="menu-area">
      <div class="top-menu-area">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-6 v_middle">
              <div class="logo">
                <a href="home.php" class="author-area__seller-btn inline"><i class="lnr lnr-home"></i>Home</a>
                <a href="media/pesanan.php" style="color:black;"><i class="lnr lnr-book"></i>Reservasi</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="konsul.php" style="color:black;"><i class="lnr lnr-users"></i>Konsultasi</a>
              </div>
            </div>
            <div class="col-lg-8 offset-lg-1 col-md-9 col-6 v_middle">
              <div class="author-area">
                <div class="author__notification_area">
                  <ul>
                    <li class="has_dropdown">
                      <div class="icon_wrap">
                        <span class="lnr lnr-cart"></span>
                        <span class="notification_count purch">2</span>
                      </div>
                      <div class="dropdowns dropdown--cart">
                        <div class="cart_area">
                          <div class="cart_product">
                            <div class="product__info">
                              <div class="thumbn">
                                <img src="assets/images/capro2.jpg" alt="cart product thumbnail">
                              </div>
                              <div class="info">
                                <a class="title" href="single-product.html">Flounce - Multipurpose OpenCart Theme</a>
                                <div class="cat">
                                  <a href="#">
                                    <img src="images/catword.png" alt="">Wordpress</a>
                                </div>
                              </div>
                            </div>
                            <div class="product__action">
                              <a href="#">
                                <span class="lnr lnr-trash"></span>
                              </a>
                              <p>$60</p>
                            </div>
                          </div>
                          <div class="total">
                            <p>
                              <span>Total :</span>$80
                            </p>
                          </div>
                          <div class="cart_action">
                            <a class="go_cart" href="cart.html">View Cart</a>
                            <a class="go_checkout" href="checkout.html">Checkout</a>
                          </div>
                        </div>
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
                      <img src="assets/images/usr_avatar.png" alt="user avatar">
                    </div>
                    <div class="autor__info">
                      <p class="name">
                        <?php echo $row["nama_pelanggan"]; ?>
                      </p>
                    </div>
                    <div class="dropdowns dropdown--author">
                      <ul>
                        <li>
                          <a href="ubahdatapelanggan.php?id=<?php echo $row['id_pelanggan']; ?>">
                            <span class="lnr lnr-user"></span> Akun</a>
                        </li>
                        <li>
                          <a href="pages/hewan.php">
                            <span class="lnr lnr-smile"></span> Data Hewan</a>
                        </li>
                        <li>
                          <a href="pages/keranjang.php">
                            <span class="lnr lnr-cart"></span> Pesanan</a>
                        </li>
                        <li>
                          <a href="logout.php" onclick="return confirm('Apakah Anda Yakin Ingin keluar?')">
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
    <section class="hero-area hero--1 bgimage">
      <div class="bg_image_holder">
        <img src="assets/images/A2.jpg" alt="">
      </div>
      <div class="hero-content content_above">
        <div class="content-wrapper">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="hero__content__title">
                  <h1>
                    <span class="light">🐈 Orion Pet Lover</span>
                  </h1>
                  <p class="tagline">Klinik Orion Pet Lover yang berkonsentrasi di layanan online kebutuhan hewan kesayangan.</p>
                </div>
                <div class="hero__btn-area">
                  <a href="all-products.html" class="btn btn--round btn--lg">Lihat semua layanan</a>
                  <a href="all-products-list.html" class="btn btn--round btn--lg">Mulai konsultasi</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="featured-products bgcolor2 section--padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-title">
              <h1>Layanan
                <span class="highlighted">Populer</span>
              </h1>
              <p>Pelanggan sering memesan layanan berikut</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="featured-product-slider prod-slider2">
              <div class="featured__single-slider">
                <div class="featured__preview-img">
                  <img src="assets/images/featprod.jpg" alt="Featured products">
                  <div class="prod_btn">
                    <a href="media/pesanan.php" class="transparent btn--sm btn--round">Pesan</a>
                  </div>
                </div>
                <div class="featured__product-description">
                  <div class="product-desc desc--featured">
                    <a href="single-product.html" class="product_title">
                      <h4>Vitamin B</h4>
                    </a>
                    <ul class="titlebtm">
                      <li>
                        &nbsp;
                        <p>
                          &nbsp;
                        </p>
                      </li>
                      <li class="product_cat">
                        <a href="#">
                          &nbsp;</a>
                      </li>
                    </ul>
                    <p>Menambah nafsu makan, meningkatkan daya tahan tubuh, memperbaiki kekurangan vitamin.</p>
                  </div>
                  <div class="product_data">
                    <div class="product-purchase featured--product-purchase">
                      <div class="price_love">
                        <span>Rp. 15,000</span>
                        <p>
                          <span class="lnr lnr-heart"></span> 90
                        </p>
                      </div>
                      <div class="sell">
                        <p>
                          <span class="lnr lnr-cart"></span>
                          <span>16</span>
                        </p>
                      </div>
                      <div class="rating product--rating">
                        <ul>
                          <li>
                            <span class="fa fa-star"></span>
                          </li>
                          <li>
                            <span class="fa fa-star"></span>
                          </li>
                          <li>
                            <span class="fa fa-star"></span>
                          </li>
                          <li>
                            <span class="fa fa-star"></span>
                          </li>
                          <li>
                            <span class="fa fa-star"></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="featured__single-slider">
                <div class="featured__preview-img">
                  <img src="assets/images/featprod.jpg" alt="Featured products">
                  <div class="prod_btn">
                    <a href="media/pesanan.php" class="transparent btn--sm btn--round">Pesan</a>
                  </div>
                </div>
                <div class="featured__product-description">
                  <div class="product-desc desc--featured">
                    <a href="single-product.html" class="product_title">
                      <h4>Vaksin Tricat</h4>
                    </a>
                    <ul class="titlebtm">
                      <li>
                        &nbsp;
                        <p>
                          &nbsp;
                        </p>
                      </li>
                      <li class="product_cat">
                        <a href="#">
                          &nbsp;</a>
                      </li>
                    </ul>
                    <p>Vaksin tricat berfungsi sebagai antibodi agar hewan terhindar dari serangan penyakit .</p>
                  </div>
                  <div class="product_data">
                    <div class="product-purchase featured--product-purchase">
                      <div class="price_love">
                        <span>Rp. 100,000</span>
                        <p>
                          <span class="lnr lnr-heart"></span> 32
                        </p>
                      </div>
                      <div class="sell">
                        <p>
                          <span class="lnr lnr-cart"></span>
                          <span>10</span>
                        </p>
                      </div>
                      <div class="rating product--rating">
                        <ul>
                          <li>
                            <span class="fa fa-star"></span>
                          </li>
                          <li>
                            <span class="fa fa-star"></span>
                          </li>
                          <li>
                            <span class="fa fa-star"></span>
                          </li>
                          <li>
                            <span class="fa fa-star"></span>
                          </li>
                          <li>
                            <span class="fa fa-star"></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="featured__single-slider">
                <div class="featured__preview-img">
                  <img src="assets/images/featprod.jpg" alt="Featured products">
                  <div class="prod_btn">
                    <a href="media/pesanan.php" class="transparent btn--sm btn--round">Pesan</a>
                  </div>
                </div>
                <div class="featured__product-description">
                  <div class="product-desc desc--featured">
                    <a href="single-product.html" class="product_title">
                      <h4>Vaksin Rabies</h4>
                    </a>
                    <ul class="titlebtm">
                      <li>
                        &nbsp;
                        <p>
                          &nbsp;
                        </p>
                      </li>
                      <li class="product_cat">
                        <a href="#">
                          &nbsp;</a>
                      </li>
                    </ul>
                    <p>Rabies salah satu penyakit yang menakutkan. Penyakit ini tidak hanya bisa mematikan hewan peliharaan.</p>
                  </div>
                  <div class="product_data">
                    <div class="product-purchase featured--product-purchase">
                      <div class="price_love">
                        <span>Rp. 100,000</span>
                        <p>
                          <span class="lnr lnr-heart"></span> 150
                        </p>
                      </div>
                      <div class="sell">
                        <p>
                          <span class="lnr lnr-cart"></span>
                          <span>28</span>
                        </p>
                      </div>
                      <div class="rating product--rating">
                        <ul>
                          <li>
                            <span class="fa fa-star"></span>
                          </li>
                          <li>
                            <span class="fa fa-star"></span>
                          </li>
                          <li>
                            <span class="fa fa-star"></span>
                          </li>
                          <li>
                            <span class="fa fa-star"></span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <span class="lnr lnr-chevron-left prod_slide_prev"></span>
            <span class="lnr lnr-chevron-right prod_slide_next"></span>
          </div>
        </div>
      </div>
    </section>
    <section class="promotion-area">
      <div class="container">
        <div class="row">
          <div class="col-md-6 v_middle">
            <div class="promotion-img">
              <img src="assets/images/vet-22.png" height="550">
            </div>
          </div>
          <div class="col-lg-5 offset-lg-1 col-md-6 v_middle">
            <div class="promotion-content">
              <h1 class="promotion__title">
                <span>Konsultasi</span>
              </h1>
              <p>Konsultasi adalah suatu pertemuan antara dokter dengan pasiennya. Tujuan dari konsultasi ini adalah menjalankan tindakan pencegahan untuk menghentikan berkembangnya berbagai macam penyakit bagi pasien yang memiliki faktor resiko. Hal ini dapat dilakukan dengan berbagai cara. Antara lain, memperoleh diagnosis bagi gejala-gejala yang dialami pasien atau jika pasien rutin melakukan pemeriksaan kesehatan tahunan, dokter dapat meninjau kembali kemungkinan pasien mengidap suatu penyakit.</p>
              <a href="konsul.php" class="btn btn--lg btn--round">Pesan sekarang</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="products section--padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-title">
              <h1>Semua
                <span class="highlighted">Layanan</span>
              </h1>
            </div>
            <div class="row">
              <div class="col-lg-4 col-md-6">
                <div class="product product--card product--card2">
                  <div class="product__thumbnail">
                    <img src="assets/images/p1.jpg" alt="Product Image">
                    <div class="prod_btn">
                      <a href="media/pesanan.php" class="transparent btn--sm btn--round">Pesan</a>
                    </div>
                  </div>
                  <div class="product-desc">
                    <a href="#" class="product_title">
                      <h4>Vaksin Rabies</h4>
                    </a>
                    <p>Rabies salah satu penyakit yang menakutkan. Penyakit ini tidak hanya bisa mematikan hewan peliharaan.</p>
                  </div>
                  <ul class="titlebtm">
                    <li class="rating product--rating">
                      <ul>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <div class="product-purchase">
                    <div class="price_love">
                      <span>Rp. 100,000</span>
                      <p>
                        <span class="lnr lnr-heart"></span> 30
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="product product--card product--card2">
                  <div class="product__thumbnail">
                    <img src="assets/images/p1.jpg" alt="Product Image">
                    <div class="prod_btn">
                      <a href="media/pesanan.php" class="transparent btn--sm btn--round">Pesan</a>
                    </div>
                  </div>
                  <div class="product-desc">
                    <a href="#" class="product_title">
                      <h4>Vaksin Tricat</h4>
                    </a>
                    <p>Vaksin tricat berfungsi sebagai antibodi agar hewan terhindar dari serangan penyakit .</p>
                  </div>
                  <ul class="titlebtm">
                    <li class="rating product--rating">
                      <ul>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <div class="product-purchase">
                    <div class="price_love">
                      <span>Rp. 100,000</span>
                      <p>
                        <span class="lnr lnr-heart"></span> 12
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="product product--card product--card2">
                  <div class="product__thumbnail">
                    <img src="assets/images/p1.jpg" alt="Product Image">
                    <div class="prod_btn">
                      <a href="media/pesanan.php" class="transparent btn--sm btn--round">Pesan</a>
                    </div>
                  </div>
                  <div class="product-desc">
                    <a href="#" class="product_title">
                      <h4>Vaksin Tetracat</h4>
                    </a>
                    <p>Vaksin tetracat diberikan untuk mencegah penyakit feline panleucopenia atau virus Feline panleucopenia.</p>
                  </div>
                  <ul class="titlebtm">
                    <li class="rating product--rating">
                      <ul>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <div class="product-purchase">
                    <div class="price_love">
                      <span>Rp. 170,000</span>
                      <p>
                        <span class="lnr lnr-heart"></span> 17
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="product product--card product--card2">
                  <div class="product__thumbnail">
                    <img src="assets/images/p1.jpg" alt="Product Image">
                    <div class="prod_btn">
                      <a href="media/pesanan.php" class="transparent btn--sm btn--round">Pesan</a>
                    </div>
                  </div>
                  <div class="product-desc">
                    <a href="#" class="product_title">
                      <h4>Vaksin Non Inti</h4>
                    </a>
                    <p>Vaksin tersebut digunakan guna memberikan perlindungan yang berharga bagi seekor hewan.</p>
                  </div>
                  <ul class="titlebtm">
                    <li class="rating product--rating">
                      <ul>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <div class="product-purchase">
                    <div class="price_love">
                      <span>Rp. 100,000</span>
                      <p>
                        <span class="lnr lnr-heart"></span> 41
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="product product--card product--card2">
                  <div class="product__thumbnail">
                    <img src="assets/images/p1.jpg" alt="Product Image">
                    <div class="prod_btn">
                      <a href="media/pesanan.php" class="transparent btn--sm btn--round">Pesan</a>
                    </div>
                  </div>
                  <div class="product-desc">
                    <a href="#" class="product_title">
                      <h4>Vaksin Wormectin</h4>
                    </a>
                    <p>Mengobati penyakit yang disebabkan oleh parasit (kutu, caplak, tungau dan insekta lain).</p>
                  </div>
                  <ul class="titlebtm">
                    <li class="rating product--rating">
                      <ul>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <div class="product-purchase">
                    <div class="price_love">
                      <span>Rp. 80,000</span>
                      <p>
                        <span class="lnr lnr-heart"></span> 12
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="product product--card product--card2">
                  <div class="product__thumbnail">
                    <img src="assets/images/p1.jpg" alt="Product Image">
                    <div class="prod_btn">
                      <a href="media/pesanan.php" class="transparent btn--sm btn--round">Pesan</a>
                    </div>
                  </div>
                  <div class="product-desc">
                    <a href="#" class="product_title">
                      <h4>Suntik Vitamin B</h4>
                    </a>
                    <p>Menambah nafsu makan, meningkatkan daya tahan tubuh, memperbaiki kekurangan vitamin.</p>
                  </div>
                  <ul class="titlebtm">
                    <li class="rating product--rating">
                      <ul>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                        <li>
                          <span class="fa fa-star"></span>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <div class="product-purchase">
                    <div class="price_love">
                      <span>Rp. 15,000</span>
                      <p>
                        <span class="lnr lnr-heart"></span> 21
                      </p>
                    </div>
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

    <script src="assets/js/vendor/jquery/jquery-1.12.3.js"></script>
    <script src="assets/js/vendor/jquery/popper.min.js"></script>
    <script src="assets/js/vendor/jquery/uikit.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/chart.bundle.min.js"></script>
    <script src="assets/js/vendor/grid.min.js"></script>
    <script src="assets/js/vendor/jquery-ui.min.js"></script>
    <script src="assets/js/vendor/jquery.barrating.min.js"></script>
    <script src="assets/js/vendor/jquery.countdown.min.js"></script>
    <script src="assets/js/vendor/jquery.counterup.min.js"></script>
    <script src="assets/js/vendor/jquery.easing1.3.js"></script>
    <script src="assets/js/vendor/owl.carousel.min.js"></script>
    <script src="assets/js/vendor/slick.min.js"></script>
    <script src="assets/js/vendor/tether.min.js"></script>
    <script src="assets/js/vendor/trumbowyg.min.js"></script>
    <script src="assets/js/vendor/waypoints.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/map.js"></script>
  </body>

  </html>
<?php
}
?>