-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jan 2022 pada 17.41
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oplbaru`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `jabatan` enum('owner','karyawan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `email`, `jabatan`) VALUES
(1, 'bagus', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'bagus@gmail.com', 'owner');

-- --------------------------------------------------------

--
-- Struktur dari tabel `biohewan`
--

CREATE TABLE `biohewan` (
  `id_hewan` int(11) NOT NULL,
  `nama_hewan` varchar(60) NOT NULL,
  `umur` varchar(10) NOT NULL,
  `id_jenishewan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `biohewan`
--

INSERT INTO `biohewan` (`id_hewan`, `nama_hewan`, `umur`, `id_jenishewan`, `id_pelanggan`) VALUES
(10, 'bobo', '6 tahun', 1, 21),
(11, 'Bibi', '4', 2, 21),
(15, 'pigi', '8 tahun', 2, 20),
(22, 'gugu', '4 tahun', 1, 26),
(28, 'tetew', '4 bulan', 1, 26),
(30, 'coba', '8 bulan', 1, 27);

-- --------------------------------------------------------

--
-- Struktur dari tabel `det_transaksi`
--

CREATE TABLE `det_transaksi` (
  `id_det_transaksi` int(11) NOT NULL,
  `kd_transaksi` int(11) NOT NULL,
  `kd_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `det_transaksi`
--

INSERT INTO `det_transaksi` (`id_det_transaksi`, `kd_transaksi`, `kd_produk`) VALUES
(9, 10, 1),
(8, 10, 2),
(11, 11, 1),
(10, 11, 2),
(12, 12, 3),
(13, 13, 3),
(14, 14, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_hewan`
--

CREATE TABLE `jenis_hewan` (
  `id_jenishewan` int(11) NOT NULL,
  `jenis_hewan` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_hewan`
--

INSERT INTO `jenis_hewan` (`id_jenishewan`, `jenis_hewan`) VALUES
(1, 'Kucing'),
(2, 'Anjing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kd_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(60) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kd_kategori`, `nama_kategori`, `id_admin`) VALUES
(1, 'Vaksin ', 1),
(2, 'Suntik Jamur', 1),
(10, 'Obat Cacing', 1),
(13, 'Suntik Vitamin', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsul`
--

CREATE TABLE `konsul` (
  `kd_konsul` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `umur` varchar(10) NOT NULL,
  `gejala` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konsul`
--

INSERT INTO `konsul` (`kd_konsul`, `id_pelanggan`, `nama`, `umur`, `gejala`) VALUES
(1, 20, 'mono', '6 thn', 'Masuk Angin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(50) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `email`, `password`, `no_hp`, `alamat`) VALUES
(20, 'Bagus Nuzullul ', 'bagusnuzullulfatwa@gmail.com', '202cb962ac59075b964b07152d234b70', '08775876347', 'Pacitan'),
(21, 'bagusnuzullul', 'bagusnf01@gmail.com', '202cb962ac59075b964b07152d234b70', '087765456777', 'pacitan'),
(23, 'Coba', 'coba@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '085111222333', 'Jogja'),
(24, 'fatwanuzullul', 'fatwanuzullul@gmail.com', '202cb962ac59075b964b07152d234b70', '085776355462', 'Pacitan'),
(25, 'Baguss', 'baguss@gmail.com', '202cb962ac59075b964b07152d234b70', '087756789879', 'Pacitan'),
(26, 'guss', 'nuzullul@gmail.com', '202cb962ac59075b964b07152d234b70', '087758763221', 'Pacitan'),
(27, 'coba', 'cobalagi@gmail.com', '202cb962ac59075b964b07152d234b70', '09877383422', 'Pacitan'),
(28, 'aw', 'aw@gmail.com', '202cb962ac59075b964b07152d234b70', '0876636772', 'kulon');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `kd_produk` int(11) NOT NULL,
  `kd_kategori` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `harga` int(10) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`kd_produk`, `kd_kategori`, `nama`, `harga`, `keterangan`, `id_admin`) VALUES
(1, 1, 'Vaksin Rabies ', 25000, 'Rabies salah satu penyakit yang menakutkan. Penyakit ini tidak hanya bisa mematikan hewan peliharaan', 1),
(2, 1, 'Vaksin Strain-19', 150000, 'Vaksin ini tidak hanya diberikan kepada anjing atau kucing saja tetapi juga kepada hewan besar seper', 1),
(3, 1, 'Vaksin Inaktif ', 75000, 'Penyakit lain yang biasanya menyerang sapi adalah IBR. Penyakit ini disebabkan oleh virus BHV-1 ', 1),
(4, 1, 'Vaksin Tricat', 100000, 'Vaksin tricat berfungsi sebagai antibodi agar hewan terhindar dari serangan penyakit .', 1),
(5, 1, 'Vaksin Tetracat', 170000, 'Vaksin tetracat diberikan untuk mencegah penyakit feline panleucopenia.', 1),
(6, 1, 'Vaksin Non Inti', 100000, 'Vaksin tersebut digunakan guna memberikan perlindungan yang berharga bagi seekor hewan.', 1),
(7, 2, 'Suntik Wormectin', 80000, 'Mengobati penyakit yang disebabkan oleh parasit (kutu, caplak, tungau dan insekta lain).', 1),
(8, 13, 'Suntik Vitamin B', 15000, 'Menambah nafsu makan, meningkatkan daya tahan tubuh, memperbaiki kekurangan vitamin.', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `kd_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_hewan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `timeslot` varchar(250) NOT NULL,
  `total` double NOT NULL,
  `bayar` enum('sudah','belum') NOT NULL,
  `status` enum('online','offline') NOT NULL,
  `no_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`kd_transaksi`, `id_pelanggan`, `id_hewan`, `tanggal`, `timeslot`, `total`, `bayar`, `status`, `no_pembayaran`) VALUES
(10, 20, 15, '2022-01-17', '08:30AM - 09:30AM', 175000, 'sudah', 'online', '563751382'),
(11, 20, 15, '2022-01-17', '09:30AM - 10:30AM', 175000, 'sudah', 'online', '596272574'),
(12, 20, 15, '2022-01-20', '12:30PM - 13:30PM', 150000, 'sudah', 'online', '1776494566'),
(13, 27, 30, '2022-01-21', '09:00AM - 10:00AM', 75000, 'sudah', 'online', '426315569'),
(14, 27, 30, '2022-01-24', '11:00AM - 12:00PM', 300000, 'sudah', 'online', '746935511');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `biohewan`
--
ALTER TABLE `biohewan`
  ADD PRIMARY KEY (`id_hewan`),
  ADD KEY `id_jenishewan` (`id_jenishewan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `det_transaksi`
--
ALTER TABLE `det_transaksi`
  ADD PRIMARY KEY (`id_det_transaksi`),
  ADD KEY `id_det_transaksi` (`kd_transaksi`,`kd_produk`),
  ADD KEY `kd_produk` (`kd_produk`);

--
-- Indeks untuk tabel `jenis_hewan`
--
ALTER TABLE `jenis_hewan`
  ADD PRIMARY KEY (`id_jenishewan`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kd_kategori`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `konsul`
--
ALTER TABLE `konsul`
  ADD PRIMARY KEY (`kd_konsul`),
  ADD KEY `id_admin` (`id_pelanggan`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kd_produk`),
  ADD KEY `kd_kategori` (`kd_kategori`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kd_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_hewan` (`id_hewan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `biohewan`
--
ALTER TABLE `biohewan`
  MODIFY `id_hewan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `det_transaksi`
--
ALTER TABLE `det_transaksi`
  MODIFY `id_det_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `jenis_hewan`
--
ALTER TABLE `jenis_hewan`
  MODIFY `id_jenishewan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kd_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `konsul`
--
ALTER TABLE `konsul`
  MODIFY `kd_konsul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `kd_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `biohewan`
--
ALTER TABLE `biohewan`
  ADD CONSTRAINT `biohewan_ibfk_1` FOREIGN KEY (`id_jenishewan`) REFERENCES `jenis_hewan` (`id_jenishewan`),
  ADD CONSTRAINT `biohewan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Ketidakleluasaan untuk tabel `det_transaksi`
--
ALTER TABLE `det_transaksi`
  ADD CONSTRAINT `det_transaksi_ibfk_1` FOREIGN KEY (`kd_produk`) REFERENCES `produk` (`kd_produk`),
  ADD CONSTRAINT `det_transaksi_ibfk_2` FOREIGN KEY (`kd_transaksi`) REFERENCES `transaksi` (`kd_transaksi`);

--
-- Ketidakleluasaan untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `kategori_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Ketidakleluasaan untuk tabel `konsul`
--
ALTER TABLE `konsul`
  ADD CONSTRAINT `konsul_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kd_kategori`) REFERENCES `kategori` (`kd_kategori`),
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_hewan`) REFERENCES `biohewan` (`id_hewan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
