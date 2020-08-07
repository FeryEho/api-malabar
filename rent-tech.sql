-- --------------------------------------------------------
-- Host:                         192.168.27.88
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table rent-tech.daftarbank
CREATE TABLE IF NOT EXISTS `daftarbank` (
  `Kode` int(50) NOT NULL AUTO_INCREMENT,
  `NamaBank` varchar(50) DEFAULT NULL,
  `NoRekening` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `NamaPemilikRekening` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Kode`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table rent-tech.daftarbank: ~3 rows (approximately)
/*!40000 ALTER TABLE `daftarbank` DISABLE KEYS */;
INSERT INTO `daftarbank` (`Kode`, `NamaBank`, `NoRekening`, `image`, `NamaPemilikRekening`) VALUES
	(6, 'BANK MANDIRI SYARIAH', '2351234531', '8629-2020-08-03.png', 'MARSTECH GLOBAL'),
	(7, 'BANK BRI', '25532525', '4275-2020-08-03.png', 'BTM MALABAR'),
	(8, 'BANK BCA', '3425256346', '3751-2020-08-03.png', 'MARSTECH');
/*!40000 ALTER TABLE `daftarbank` ENABLE KEYS */;

-- Dumping structure for table rent-tech.datanasabah
CREATE TABLE IF NOT EXISTS `datanasabah` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) DEFAULT NULL,
  `NoTelepon` varchar(30) DEFAULT NULL,
  `JenisKelamin` varchar(30) DEFAULT NULL,
  `TempatLahir` varchar(30) DEFAULT NULL,
  `TglLahir` varchar(50) DEFAULT NULL,
  `Agama` varchar(30) DEFAULT NULL,
  `StatusPerkawinan` varchar(30) DEFAULT NULL,
  `Pendidikan` varchar(30) DEFAULT NULL,
  `Pekerjaan` varchar(30) DEFAULT NULL,
  `Penghasilan` varchar(50) DEFAULT NULL,
  `Alamat` varchar(50) DEFAULT NULL,
  `RtRw` varchar(50) DEFAULT NULL,
  `Kota` varchar(50) DEFAULT NULL,
  `Kecamatan` varchar(50) DEFAULT NULL,
  `Kelurahan` varchar(50) DEFAULT NULL,
  `KTP` varchar(50) DEFAULT NULL,
  `NPWP` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Pasangan` varchar(50) DEFAULT NULL,
  `IbuKandung` varchar(50) DEFAULT NULL,
  `AhliWaris` varchar(50) DEFAULT NULL,
  `TempatLahirAhliWaris` varchar(50) DEFAULT NULL,
  `TglLahirAhliWaris` varchar(50) DEFAULT NULL,
  `HubunganAhliWaris` varchar(50) DEFAULT NULL,
  `PhotoKTP` varchar(50) DEFAULT NULL,
  `PhotoNasabah` varchar(50) DEFAULT NULL,
  `TanggalPermohonan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Dumping data for table rent-tech.datanasabah: ~23 rows (approximately)
/*!40000 ALTER TABLE `datanasabah` DISABLE KEYS */;
INSERT INTO `datanasabah` (`Id`, `Nama`, `NoTelepon`, `JenisKelamin`, `TempatLahir`, `TglLahir`, `Agama`, `StatusPerkawinan`, `Pendidikan`, `Pekerjaan`, `Penghasilan`, `Alamat`, `RtRw`, `Kota`, `Kecamatan`, `Kelurahan`, `KTP`, `NPWP`, `Email`, `Pasangan`, `IbuKandung`, `AhliWaris`, `TempatLahirAhliWaris`, `TglLahirAhliWaris`, `HubunganAhliWaris`, `PhotoKTP`, `PhotoNasabah`, `TanggalPermohonan`) VALUES
	(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, '085', 'Bonek Mania', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, '085', 'Bonek Mania', 'hajananabzbananbabAb', '2020-07-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, '085', 'Bonek Mania', 'hajananabzbananbabAb', '2020-07-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, '085', 'Bonek Mania', 'hajananabzbananbabAb', '2020-07-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 'Bonek Mania', '085', '', 'Madiun', '1996-07-27', 'Islam', '', 's1', 'kuli', 'Rp.2.000.0000 - Rp.3.000.000', '', '', '', '', '', '', '', '', '', '', '', '', '2000-07-02', 'Orang Tua', NULL, NULL, NULL),
	(8, 'Bonek Mania', '085', '', 'Madiun', '1996-07-27', 'Islam', '', 's1', 'kuli', 'Rp.2.000.0000 - Rp.3.000.000', '', '', '', '', '', '', '', '', '', '', '', '', '2000-07-02', 'Orang Tua', NULL, NULL, NULL),
	(9, 'Bonek Mania', '085', '', 'Madiun', '1996-07-27', 'Islam', '', 's1', 'kuli', 'Rp.2.000.0000 - Rp.3.000.000', '', '', '', '', '', '', '', '', '', '', '', '', '2000-07-02', 'Orang Tua', NULL, NULL, NULL),
	(10, 'Bonek Mania', '085', '', 'Madiun', '1996-07-27', 'Islam', '', 's1', 'kuli', 'Rp.2.000.0000 - Rp.3.000.000', '', '', '', '', '', '', '', '', '', '', '', '', '2000-07-02', 'Orang Tua', NULL, NULL, NULL),
	(11, 'Bonek Mania', '085', '', 'cucjf', '2020-07-16', 'Islam', '', 'gxhx', 'hch', 'Kurang Rp.1.000.0000', '', '', '', '', '', '', '', '', '', '', '', '', '2000-07-02', 'Orang Tua', NULL, NULL, NULL),
	(12, 'Bonek Mania', '085', '', 'cucjf', '2020-07-16', 'Islam', '', 'gxhx', 'hch', 'Kurang Rp.1.000.0000', '', '', '', '', '', '', '', '', '', '', '', '', '2000-07-02', 'Orang Tua', NULL, NULL, NULL),
	(13, 'Samidi', '3', '', 'jcjc', '2020-07-27', 'Budha', '', 'jcjc', 'hchc', 'Kurang Rp.1.000.0000', '', '', '', '', '', '', '', '', '', '', '', '', '2000-07-02', 'Orang Tua', NULL, NULL, NULL),
	(14, 'Samidi', '3', '', 'jcjc', '2020-07-27', 'Budha', '', 'jcjc', 'hchc', 'Kurang Rp.1.000.0000', '', '', '', '', '', '', '', '', '', '', '', '', '2000-07-02', 'Orang Tua', NULL, NULL, NULL),
	(15, 'Samidi', '3', '', '', '2020-07-17', 'Islam', '', '', '', 'Kurang Rp.1.000.0000', '', '', '', '', '', '', '', '', '', '', '', '', '2000-07-02', 'Orang Tua', NULL, NULL, NULL),
	(16, 'Samidi', '3', '', 'hchch', '2020-07-27', 'Katolik', '', 'hchcch', 'cufuf', 'Rp.2.000.0000 - Rp.3.000.000', '', '', '', '', '', '', '', '', '', '', '', '', '2000-07-02', 'Orang Tua', NULL, NULL, NULL),
	(17, 'Bonek Mania', '085', '', 'haha', '2020-07-27', 'Islam', '', 'hsha', 'hsh', 'Kurang Rp.1.000.0000', 'hshsh', 'hshsh', 'hshs', 'hshshsh', 'hshs', 'hshs', 'hshs', 'hshs', 'nsnsba', 'habab', 'hahahdbs', 'hshs', '2000-07-02', 'Suami/Istri', NULL, NULL, NULL),
	(18, 'Bonek Mania', '085', '', 'madiun', '2020-07-27', 'Budha', '', 'sarjana ', 'gaming', 'Kurang Rp.1.000.0000', 'jalan barat', '09/89', 'madiun', 'wungu', 'kare', '086764645', '6762727727', 'bonek@gmail.com', 'sarijem', 'samidi', 'sera', 'jakarta', '2000-07-02', 'Suami/Istri', NULL, NULL, NULL),
	(20, 'Bonek Mania', '085', '', 'ggg', '28-07-2020', 'Hindu', '', 'gyggg', 'gg', 'Rp.3.000.0000 - Rp.4.000.000', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Orang Tua', NULL, NULL, NULL),
	(21, 'Bonek Mania', '085', '', 'ggg', '28-07-2020', 'Hindu', '', 'gyggg', 'gg', 'Rp.3.000.0000 - Rp.4.000.000', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Orang Tua', NULL, NULL, NULL),
	(22, 'Samidi', '3', '', 'madiunhs', '28-07-2020', 'Katolik', '', 'bsbsbah', 'havdvs', 'Rp.3.000.0000 - Rp.4.000.000', 'babababa', '949794', 'babsbs', 'bxbabz', 'sbsvxb', '979497', '649497', 'jahs@gahsh.com', 'hahsbsv', 'hahsb', 'bdba', 'bdbahz', '28-07-2020', 'Anak', '979497.jpeg', 'Samidi.jpeg', NULL),
	(23, 'Khusnul', '085892791200', '', 'Jakarta', '29-07-2020', 'Islam', '', 'SMA', 'Wiraswasta', 'Rp.1.000.0000 - Rp.2.000.000', 'Jalan Siliwangi', '21/12', 'Jakarta Utara', 'Koja', 'Kedaeng', '0464848', '64848494', 'Khusnul@gmail.com', 'Sarinah', 'Sariden', 'Putra', 'Jakarta', '29-07-2020', 'Anak', '0464848.jpeg', 'Khusnul.jpeg', NULL),
	(24, 'Samidi', '3', 'Perempuan', 'gxd', '9797', 'Agama', 'Belum Menikah', 'vV', 'gag', 'Kurang Rp.1.000.0000', 'gaha', '644', 'bba', 'haha', 'ah', '3464', '6464', 'hah', 'haha', 'hah', 'yaa', 'haha', '646', 'Saudara', '3464.jpeg', 'Samidi.jpeg', NULL);
/*!40000 ALTER TABLE `datanasabah` ENABLE KEYS */;

-- Dumping structure for table rent-tech.profil
CREATE TABLE IF NOT EXISTS `profil` (
  `Nama` varchar(50) DEFAULT NULL,
  `PhotoProfil` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table rent-tech.profil: ~0 rows (approximately)
/*!40000 ALTER TABLE `profil` DISABLE KEYS */;
/*!40000 ALTER TABLE `profil` ENABLE KEYS */;

-- Dumping structure for table rent-tech.register
CREATE TABLE IF NOT EXISTS `register` (
  `Nama` varchar(32) NOT NULL,
  `NoTelepon` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`NoTelepon`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table rent-tech.register: ~6 rows (approximately)
/*!40000 ALTER TABLE `register` DISABLE KEYS */;
INSERT INTO `register` (`Nama`, `NoTelepon`, `Password`) VALUES
	('Bonek Mania', '085', '914b62192c43efb8aa203ef848054856'),
	('Khusnul', '085892791200', 'c4ca4238a0b923820dcc509a6f75849b'),
	('fery', '085892791204', 'dfd1f77aa12baacdba90554cc7cf4529'),
	('1', '1', 'c4ca4238a0b923820dcc509a6f75849b'),
	('2', '2', 'c81e728d9d4c2f636f067f89cc14862c'),
	('Samidi', '3', 'eccbc87e4b5ce2fe28308fd9f2a7baf3');
/*!40000 ALTER TABLE `register` ENABLE KEYS */;

-- Dumping structure for table rent-tech.tbl_admin
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `user_role` enum('100','101','102') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table rent-tech.tbl_admin: 1 rows
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `full_name`, `user_role`) VALUES
	(5, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'admin@yahoo.com', 'Administrastor', '100');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
