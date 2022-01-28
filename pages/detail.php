<!DOCTYPE html>
<html>
<head>
 <title>Join Table</title>
</head>
<body>
    <style>
        h1{
            text-align: center;
        @page{
            margin:0;
        }
    </style>
<h1><font size="3" face="Comic Sans">Jadwal Klinik Hewan</h1>
<h1>-------------------------------------------------------------------------------</h1>
<h1>----------------------------------------------------------------------------------------------------------</h1>
<center>
 <table border="1">
  <tr>
   <td>No.</td>
   <td>No Pembayaran</td>
   <td>Pemesan</td>
   <td>Nama Hewan</td>
   <td>Tanggal</td>
   <td>Waktu</td>
   <td>Total</td>
   <td>Bayar</td>
   <td>Status</td>
  </tr>
  <?php
			$nomor = 1;
		?>
  <?php
  $koneksi = new mysqli("localhost","root","","oplbaru");
  session_start();

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
  $queryDataHewan = query("SELECT * FROM biohewan WHERE id_pelanggan = '$idPelanggan'")[0];  

  // $email = $_POST['email'];
  // $password = md5($_POST['password']);
  
  // $query = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN produk ON transaksi.kd_transaksi = produk.id_produk 
  // INNER JOIN pelanggan ON datahewan.id_pelanggan = pelanggan.id_pelanggan");

//   $query = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN datahewan ON transaksi.kd_transaksi = datakucing.id_hewan ");
  

?>

    <tr>
        <td><?= $nomor ?></td>
        <td><?= $queryTransaksi['no_pembayaran'] ?></td>
        <td><?= $_SESSION['nama_pelanggan'] ?></td>
        <td><?= $queryDataHewan['nama_hewan'] ?></td>
        <td><?= $queryTransaksi['tanggal'] ?></td>
        <td><?= $queryTransaksi['timeslot'] ?></td>
        <td><?= $queryTransaksi['total'] ?></td>
        <td><?= $queryTransaksi['bayar'] ?></td>
        <td><?= $queryTransaksi['status'] ?></td>
    </tr>  

 </table>
 <p><font size="3" face="Comic Sans">Terima Kasih Atas Pemesanannya <?php echo $_SESSION['nama_pelanggan']  ?> Di Orion Pet Lovers <br> Kami Memberikan PELAYANAN TERBAIK, HARGA TERBAIK :) </p>
 <p><font size="2" face="Comic Sans">Untuk Informasi Lainnya Silahkan Menghubungi Admin <br> CP Admin : +6282170507752</p>

 </center>
<script>
    window.print();
</script>
</body>

</html>