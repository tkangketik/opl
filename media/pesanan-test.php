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
     
      <h1><a href="index.html">Orion Pet Lover</a></h1>
   
    </div>
    <nav id="mainav" class="fl_right"> 
    
      <ul class="clear">
        <li><a href="home.php">Home</a></li>
        <li class="active"><a class="drop" href="pesanan.php">Pelayanan</a>
          <ul>
            <li><a href="#">Vaksin</a></li>
            <li><a href="#">Suntik Jamur</a></li>
            <li><a href="#">Suntik Obat Cacing</a></li>
          </ul>
        </li>
        <li><a href="pages/Keranjang.php">Keranjang</a></li>
        <li><a class="drop" href="#">Data Onwer</a>
              <ul>
              <li><a href="pages/pelanggan.php">Data Pelanggan</a></li>
              <li><a href="pages/hewan.php">Data Hewan</a></li>
              </ul>
        </li>
        <li><a class="drop" href="#">Akun</a>
              <ul>
              <li><a href="pages/ubah_password.php">Ubah Password</a></li>
              <li><a href="logout.php" onclick="return confirm('Apakah Anda Yakin Ingin keluar?')">Keluar</a></li>
              </ul>
        </li>
      </ul>
     
    </nav>
  </header>
  