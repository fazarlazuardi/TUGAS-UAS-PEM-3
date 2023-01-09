-- Adminer 4.8.1 MySQL 5.5.5-10.4.27-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `barang` (`id_barang`, `nama`, `kategori_id`, `satuan_id`) VALUES
(1,	'Buku Tulis',	1,	1),
(2,	'Air Mineran Aqua',	3,	1);

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
(1,	'ATK'),
(2,	'Makanan'),
(3,	'Minuman');

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` char(20) NOT NULL,
  `no_telp` varchar(14) NOT NULL,
  `status` char(10) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_telp`, `status`) VALUES
(1,	'Saya Sendri',	'20349859845',	'Active');

DROP TABLE IF EXISTS `satuan`;
CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `satuan` (`id_satuan`, `nama`) VALUES
(1,	'Pcs'),
(2,	'Pck'),
(3,	'Kg'),
(4,	'Lt');

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_transaksi` varchar(100) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `transaksi` (`id_transaksi`, `nama_transaksi`, `tgl_transaksi`, `harga`, `qty`, `id_barang`, `diskon`, `id_pelanggan`) VALUES
(5,	'test 4',	'2023-01-19',	50000,	20,	1,	5,	1),
(6,	'test',	'2023-01-09',	10000,	30,	1,	0,	0);

-- 2023-01-09 08:18:01
