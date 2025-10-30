/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - db_simplecrud
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_simplecrud` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_simplecrud`;

/*Table structure for table `tb_category` */

DROP TABLE IF EXISTS `tb_category`;

CREATE TABLE `tb_category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `nm_category` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_category` */

insert  into `tb_category`(`id_category`,`nm_category`) values 
(1,'Novel'),
(2,'Majalah'),
(3,'Komik'),
(4,'Fiksi'),
(5,'Antologi'),
(6,' Ensiklopedi'),
(7,'Fotografi');

/*Table structure for table `tb_daftar_buku` */

DROP TABLE IF EXISTS `tb_daftar_buku`;

CREATE TABLE `tb_daftar_buku` (
  `id_book` int NOT NULL AUTO_INCREMENT,
  `book_nm` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ISBN` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `category` int DEFAULT NULL,
  `stock` int DEFAULT NULL,
  PRIMARY KEY (`id_book`),
  KEY `category` (`category`),
  CONSTRAINT `tb_daftar_buku_ibfk_1` FOREIGN KEY (`category`) REFERENCES `tb_category` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_daftar_buku` */

insert  into `tb_daftar_buku`(`id_book`,`book_nm`,`ISBN`,`release_date`,`category`,`stock`) values 
(1,'Melangkah','9786020523316','2020-03-23',1,80),
(2,'Membunuh Itu Gampang (Murder Is Easy)\r\n','9786020339375','2017-05-15',1,20);

/*Table structure for table `tb_mahasiswa` */

DROP TABLE IF EXISTS `tb_mahasiswa`;

CREATE TABLE `tb_mahasiswa` (
  `id_mhs` int NOT NULL AUTO_INCREMENT,
  `nim_mhs` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nama_mhs` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `prodi_mhs` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status_mhs` tinyint(1) NOT NULL,
  `kategori_buku` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buku_pinjam` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_mhs`),
  KEY `kategori_buku` (`kategori_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_mahasiswa` */

insert  into `tb_mahasiswa`(`id_mhs`,`nim_mhs`,`nama_mhs`,`prodi_mhs`,`alamat`,`email`,`telp`,`status_mhs`,`kategori_buku`,`buku_pinjam`) values 
(1,'1234567890','ryan pradnyana','STI','legian,kuta','ryanpradnyanaaaa@gmail.com','0987654321',1,'novel',NULL),
(2,'1234567890','ryan pradnyana','STI','legian,kuta','ryanpradnyanaaaa@gmail.com','0987654321',1,'novel',NULL),
(3,'245920140004','I Made Ryan Pradnyana','STI','Legian, Kuta','ryanpradnyanaaaa@gmail.com','081615771090',1,'novel',NULL);

/*Table structure for table `tb_prodi` */

DROP TABLE IF EXISTS `tb_prodi`;

CREATE TABLE `tb_prodi` (
  `kode_prodi` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_prodi` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`kode_prodi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_prodi` */

insert  into `tb_prodi`(`kode_prodi`,`nama_prodi`) values 
('ARS','Arsitek'),
('BD','Bisnis Digital'),
('DI','Desain Interior'),
('DKV','Desain Komunikasi Visual'),
('DM','Desain Mode'),
('MBD','Magister Bisnis Digital'),
('MDS','Magister Desain'),
('MR','Manajemen Ritel'),
('STI','Sistem dan Teknologi Informasi');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
