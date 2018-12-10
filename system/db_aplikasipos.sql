/*
SQLyog Ultimate v10.42 
MySQL - 5.7.17-0ubuntu0.16.04.2 : Database - aplikasipos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`aplikasipos` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `aplikasipos`;

/*Table structure for table `akuns` */

DROP TABLE IF EXISTS `akuns`;

CREATE TABLE `akuns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode_akun` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_akun` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_alias` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subklasifikasi_id` int(11) DEFAULT NULL,
  `kas_bank` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kurs` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departement_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `akuns_kode_akun_unique` (`kode_akun`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `akuns` */

insert  into `akuns`(`id`,`kode_akun`,`nama_akun`,`nama_alias`,`subklasifikasi_id`,`kas_bank`,`is_active`,`kurs`,`departement_id`,`created_at`,`updated_at`) values (1,'110015021','Bank','kas_on_bank',2,'Y',NULL,'$','1','2018-03-24 22:03:01','2018-05-14 09:05:21'),(2,'110099020','Kas','kas',1,'Y',NULL,'IDR','1','2018-03-24 23:03:44','2018-05-14 02:05:21'),(4,'110099022','Cash On Hand','cash_on_hand',1,'Y','Y','IDR','1','2018-04-19 01:04:21','2018-05-14 09:05:43'),(5,'110011001','Piutang Dagang','piutang_dagang',1,'Y',NULL,'IDR',NULL,'2018-05-14 09:05:10','2018-05-14 02:05:46');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode_kategori` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kategori` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sifat_persediaan_disimpan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sifat_persediaan_dibeli` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sifat_persediaan_dijual` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sistem_persediaan_average_costing` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akun_harga_pokok` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akun_penjualan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akun_persediaan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_nama_kategori_unique` (`nama_kategori`),
  UNIQUE KEY `categories_kode_kategori_unique` (`kode_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`kode_kategori`,`nama_kategori`,`departement_id`,`sifat_persediaan_disimpan`,`sifat_persediaan_dibeli`,`sifat_persediaan_dijual`,`sistem_persediaan_average_costing`,`akun_harga_pokok`,`akun_penjualan`,`akun_persediaan`,`gambar`,`created_at`,`updated_at`) values (1,'00101','jasa','11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-04-20 06:54:03','2018-05-14 21:46:24'),(2,'00900','Langka','01',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-04-20 06:54:11','2018-05-14 08:59:20');

/*Table structure for table `departements` */

DROP TABLE IF EXISTS `departements`;

CREATE TABLE `departements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode_departement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_departement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_departement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manager` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bidang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departements_kode_departement_unique` (`kode_departement`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `departements` */

insert  into `departements`(`id`,`kode_departement`,`nama_departement`,`sub_departement`,`manager`,`bidang`,`catatan`,`created_at`,`updated_at`) values (1,'11','Keuangan','Head Quarter','N/A','N/A','N/A','2018-03-23 06:00:37','2018-03-23 06:05:00'),(3,'01','Produksi','Produksi','Mr. An','.','.','2018-04-07 17:11:16','2018-04-11 10:39:44');

/*Table structure for table `gudangs` */

DROP TABLE IF EXISTS `gudangs`;

CREATE TABLE `gudangs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode_gudang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_gudang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dimensi_container` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `negara` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori_gudang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_container` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gudangs_kode_gudang_unique` (`kode_gudang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `gudangs` */

insert  into `gudangs`(`id`,`kode_gudang`,`nama_gudang`,`dimensi_container`,`alamat`,`kota`,`kode_pos`,`negara`,`keterangan`,`kategori_gudang`,`is_container`,`is_active`,`created_at`,`updated_at`) values (1,'Head Quarter','Head Quarter','20',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-04-07 23:04:00','2018-04-07 23:04:00');

/*Table structure for table `harga_juals` */

DROP TABLE IF EXISTS `harga_juals`;

CREATE TABLE `harga_juals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kontak_id` int(10) DEFAULT NULL,
  `kode_kontak` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_add` date NOT NULL,
  `produk` int(10) NOT NULL,
  `harga_jual_satuan` int(11) NOT NULL DEFAULT '0',
  `is_active` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_deleted` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `harga_juals` */

insert  into `harga_juals`(`id`,`kontak_id`,`kode_kontak`,`date_add`,`produk`,`harga_jual_satuan`,`is_active`,`is_deleted`,`created_at`,`updated_at`) values (1,1,'CUST-1','2018-03-14',1,9000,NULL,NULL,'2018-03-30 23:03:57','2018-05-11 06:05:23'),(3,1,'CUST-1','2018-03-27',3,3500,NULL,NULL,'2018-04-10 04:04:59','2018-04-13 09:04:31'),(4,2,'CUST-2','2018-03-25',1,7000,NULL,NULL,'2018-04-10 04:04:40','2018-04-13 09:04:19'),(5,4,'0100','2018-04-10',1,20000,NULL,NULL,'2018-04-13 05:04:37','2018-04-13 05:04:37'),(6,4,'0100','2018-04-18',2,15000,NULL,NULL,'2018-04-13 05:04:09','2018-04-13 05:04:09'),(7,4,'0100','2018-04-04',3,7500,NULL,NULL,'2018-04-13 05:04:41','2018-04-13 05:04:54'),(8,5,'000121','2018-04-01',1,6000,NULL,NULL,'2018-04-15 02:04:32','2018-04-16 03:04:19'),(9,5,'000121','2018-04-01',2,6500,NULL,NULL,'2018-04-15 02:04:48','2018-04-21 02:04:47'),(10,5,'000121','2018-04-08',3,7500,NULL,NULL,'2018-04-15 02:04:07','2018-04-16 03:04:58'),(11,5,'000121','2018-05-14',5,9000,NULL,NULL,'2018-05-14 07:05:45','2018-05-14 07:05:45');

/*Table structure for table `klasifikasis` */

DROP TABLE IF EXISTS `klasifikasis`;

CREATE TABLE `klasifikasis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `klasifikasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `klasifikasis_klasifikasi_unique` (`klasifikasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `klasifikasis` */

/*Table structure for table `kontak_details` */

DROP TABLE IF EXISTS `kontak_details`;

CREATE TABLE `kontak_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kontak_id` int(10) DEFAULT NULL,
  `kode_kontak` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `negara1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_pengiraman1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_pengiraman2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `negara2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `kontak_details` */

insert  into `kontak_details`(`id`,`kontak_id`,`kode_kontak`,`alamat1`,`alamat2`,`kota1`,`kode_pos1`,`negara1`,`alamat_pengiraman1`,`alamat_pengiraman2`,`kota2`,`kode_pos2`,`negara2`,`kontak2`,`catatan`,`photo`,`created_at`,`updated_at`) values (1,1,'CUST-1','JL. Soekarno Hatta No. 483',NULL,'Bandung','40396','Indonesia',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-28 00:03:14'),(2,2,'CUST-2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,3,'0001',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,4,'0100',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,5,'000121',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `kontaks` */

DROP TABLE IF EXISTS `kontaks`;

CREATE TABLE `kontaks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode_kontak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kontak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kurs` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `klasifikasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `handphone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `situs_web` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batas_kredit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari_diskon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hari_jatuh_tempo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diskon_awal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denda_terlambat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kontaks_kode_kontak_unique` (`kode_kontak`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `kontaks` */

insert  into `kontaks`(`id`,`kode_kontak`,`nama_kontak`,`kurs`,`tipe`,`jenis`,`klasifikasi`,`kontak`,`jabatan`,`phone1`,`phone2`,`fax`,`handphone`,`email`,`situs_web`,`npwp`,`batas_kredit`,`hari_diskon`,`hari_jatuh_tempo`,`diskon_awal`,`denda_terlambat`,`created_at`,`updated_at`) values (1,'CUST-1','PT. Bersama Sejahtera','IDR','Customer','Company','General',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-25 00:03:28','2018-03-25 23:03:20'),(2,'CUST-2','PT. Sinar Cemerlang','IDR','Customer','Company','General',NULL,NULL,'022 6034777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'-','-','-',NULL,'2018-03-25 04:03:52','2018-05-11 01:05:18'),(3,'0001','Budi','IDR','Supplier','Personal',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-04-13 05:04:57','2018-04-13 05:04:57'),(4,'0100','Jajang','IDR','Customer','Personal',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-04-13 05:04:49','2018-04-13 05:04:49'),(5,'000121','PT. Karya Mandiri Semesta','IDR','Customer','Company',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-04-15 02:04:41','2018-04-15 02:04:41');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_07_12_145959_create_permission_tables',1),(4,'2018_03_18_021600_create_uoms_table',2),(5,'2018_03_18_021628_create_categories_table',2),(6,'2018_03_18_021642_create_products_table',2),(7,'2018_03_23_123022_create_departements_table',3),(8,'2018_03_23_131055_create_gudangs_table',4),(9,'2018_03_24_081154_create_klasifikasis_table',5),(10,'2018_03_24_081221_create_sub_klasifikasis_table',5),(11,'2018_03_24_082133_create_akuns_table',5),(12,'2018_03_25_182641_create_kontaks_table',6),(13,'2018_03_25_194449_create_kontak_details_table',7),(14,'2018_03_26_215314_create_harga_juals_table',8),(15,'2018_04_04_064401_transactions_table',9),(16,'2018_04_04_143233_create_pembelians_table',10),(17,'2018_04_06_031355_create_pembelian_details_table',10),(18,'2018_04_09_115820_create_penjualans_table',11),(19,'2018_04_09_184214_create_penjualan_deatails_table',11),(20,'2018_04_09_193221_create_transfers_table',12),(21,'2018_04_09_193240_create_transfer_details_table',12),(22,'2018_04_11_213135_create_pembayarans_table',12),(23,'2018_04_11_213208_create_pembayaran_details_table',12),(24,'2018_04_12_185331_create_pengeluaran_kas_table',13),(25,'2018_04_12_185419_create_pengeluaran_kas_details_table',13),(26,'2018_04_12_231957_create_penerimaan_kas_table',14),(27,'2018_04_12_232106_create_penerimaan_detail_kas_table',14),(29,'2018_04_13_033020_create_transfer_kas_table',15),(30,'2018_04_13_220901_create_penyesuaians_table',16),(31,'2018_04_13_221017_create_penyesuaian_details_table',16),(32,'2018_04_14_063029_create_piutangs_table',17),(33,'2018_04_14_063100_create_piutang_details_table',17),(34,'2018_05_11_034146_create_produk_uoms_table',18);

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_id`,`model_type`) values (1,1,'App\\User'),(2,2,'App\\User'),(1,3,'App\\User');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pembayaran_details` */

DROP TABLE IF EXISTS `pembayaran_details`;

CREATE TABLE `pembayaran_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pembayaran_id` int(11) NOT NULL,
  `no_reff` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pembelian_id` int(11) DEFAULT NULL,
  `saldo` int(11) DEFAULT '0',
  `diskon` int(11) DEFAULT '0',
  `jml_dibayar` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pembayaran_details` */

insert  into `pembayaran_details`(`id`,`pembayaran_id`,`no_reff`,`pembelian_id`,`saldo`,`diskon`,`jml_dibayar`,`created_at`,`updated_at`) values (8,22,'CD000000001',12,1000000,0,750000,'2018-04-13 19:29:05','2018-04-13 19:29:05'),(9,23,'CD000000002',12,250000,0,250000,'2018-04-13 21:34:16','2018-04-13 21:34:16');

/*Table structure for table `pembayarans` */

DROP TABLE IF EXISTS `pembayarans`;

CREATE TABLE `pembayarans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_reff` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `nilai` int(11) DEFAULT '0',
  `akun_id` int(11) NOT NULL,
  `kontak_id` int(11) NOT NULL,
  `proyek` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departement_id` int(11) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `denda` int(11) DEFAULT '0',
  `userid` int(11) DEFAULT NULL,
  `is_giro` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_cetak` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_batal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_void` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pembayarans_no_reff_unique` (`no_reff`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pembayarans` */

insert  into `pembayarans`(`id`,`no_reff`,`tanggal`,`nilai`,`akun_id`,`kontak_id`,`proyek`,`departement_id`,`keterangan`,`denda`,`userid`,`is_giro`,`is_cetak`,`is_batal`,`is_void`,`created_at`,`updated_at`) values (22,'CD000000001','2018-03-23',750000,2,3,'App',1,NULL,0,1,'Y','Y',NULL,NULL,'2018-04-13 19:28:56','2018-04-13 19:28:56'),(23,'CD000000002','2018-03-06',250000,1,3,NULL,1,NULL,NULL,1,NULL,'Y',NULL,NULL,'2018-04-13 21:34:07','2018-04-13 21:34:07');

/*Table structure for table `pembelian_details` */

DROP TABLE IF EXISTS `pembelian_details`;

CREATE TABLE `pembelian_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pembelian_id` int(11) NOT NULL,
  `no_faktur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_produk` int(191) NOT NULL,
  `akun_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty_terima` int(11) NOT NULL DEFAULT '0',
  `qty_pesan` int(11) DEFAULT '0',
  `uom_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_beli` int(11) DEFAULT '0',
  `diskon` decimal(8,2) DEFAULT '0.00',
  `total` int(11) DEFAULT '0',
  `pajak` decimal(8,2) DEFAULT '0.00',
  `proyek` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pembelian_details` */

insert  into `pembelian_details`(`id`,`pembelian_id`,`no_faktur`,`kode_produk`,`akun_id`,`qty_terima`,`qty_pesan`,`uom_id`,`harga_beli`,`diskon`,`total`,`pajak`,`proyek`,`created_at`,`updated_at`) values (29,14,'PJ000000001',5,NULL,100,100,'pcs',9000,0.00,900000,0.00,NULL,'2018-05-14 07:10:04','2018-05-14 07:10:04'),(30,14,'PJ000000001',1,NULL,120,120,'pcs',7500,0.00,900000,0.00,NULL,'2018-05-14 07:10:05','2018-05-14 07:10:05');

/*Table structure for table `pembelians` */

DROP TABLE IF EXISTS `pembelians`;

CREATE TABLE `pembelians` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kontak_id` int(11) DEFAULT NULL,
  `no_faktur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_po` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_faktur` date NOT NULL,
  `proyek` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gudang_masuk_id` int(11) DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departement_id` int(11) DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `bagian_pembelian` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denda_terlambat` int(11) DEFAULT '0',
  `debit_kredit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biaya_lain` int(11) DEFAULT '0',
  `total_pajak` int(11) DEFAULT '0',
  `total_setelah_pajak` int(11) DEFAULT '0',
  `uang_muka` int(11) DEFAULT '0',
  `saldo_terutang` float DEFAULT '0',
  `is_tunai` tinyint(1) DEFAULT NULL,
  `is_cetak` tinyint(1) DEFAULT NULL,
  `is_void` tinyint(1) DEFAULT NULL,
  `is_canceled` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pembelians` */

insert  into `pembelians`(`id`,`kontak_id`,`no_faktur`,`no_po`,`tanggal_faktur`,`proyek`,`gudang_masuk_id`,`keterangan`,`departement_id`,`tanggal_kirim`,`bagian_pembelian`,`denda_terlambat`,`debit_kredit`,`biaya_lain`,`total_pajak`,`total_setelah_pajak`,`uang_muka`,`saldo_terutang`,`is_tunai`,`is_cetak`,`is_void`,`is_canceled`,`is_deleted`,`created_at`,`updated_at`) values (14,1,'PJ000000001','1','2018-05-01',NULL,1,NULL,3,'2018-03-15',NULL,0,NULL,0,0,1800000,0,1800000,NULL,1,NULL,NULL,NULL,'2018-05-14 07:10:04','2018-05-14 07:10:04');

/*Table structure for table `penerimaan_detail_kas` */

DROP TABLE IF EXISTS `penerimaan_detail_kas`;

CREATE TABLE `penerimaan_detail_kas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `penerimaan_id` int(11) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `departement_id` int(11) NOT NULL,
  `jml_keluar` int(11) NOT NULL,
  `job` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penerimaan_detail_kas` */

insert  into `penerimaan_detail_kas`(`id`,`penerimaan_id`,`akun_id`,`departement_id`,`jml_keluar`,`job`,`created_at`,`updated_at`) values (1,1,2,1,1000000,'assd','2018-04-16 05:43:51','2018-04-16 05:43:51');

/*Table structure for table `penerimaan_kas` */

DROP TABLE IF EXISTS `penerimaan_kas`;

CREATE TABLE `penerimaan_kas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `akun_id` int(11) NOT NULL,
  `kontak_id` int(11) NOT NULL,
  `no_cek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `nilai` int(11) NOT NULL,
  `proyek` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departement_id` int(11) NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `is_giro` tinyint(1) DEFAULT NULL,
  `is_cetak` tinyint(1) DEFAULT NULL,
  `is_void` tinyint(1) DEFAULT NULL,
  `is_batal` tinyint(1) DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT NULL,
  `is_discharge` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `penerimaan_kas_no_cek_unique` (`no_cek`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penerimaan_kas` */

insert  into `penerimaan_kas`(`id`,`akun_id`,`kontak_id`,`no_cek`,`tanggal`,`nilai`,`proyek`,`departement_id`,`keterangan`,`userid`,`is_giro`,`is_cetak`,`is_void`,`is_batal`,`is_delete`,`is_discharge`,`created_at`,`updated_at`) values (1,1,2,'CR000000001','2018-03-21',1000000,NULL,3,'asdsd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-04-16 05:43:51','2018-04-16 05:43:51');

/*Table structure for table `pengeluaran_kas` */

DROP TABLE IF EXISTS `pengeluaran_kas`;

CREATE TABLE `pengeluaran_kas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `akun_id` int(11) NOT NULL,
  `kontak_id` int(11) NOT NULL,
  `no_cek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `nilai` int(11) NOT NULL,
  `proyek` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departement_id` int(11) NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `is_giro` tinyint(1) DEFAULT NULL,
  `is_cetak` tinyint(1) DEFAULT NULL,
  `is_void` tinyint(1) DEFAULT NULL,
  `is_batal` tinyint(1) DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT NULL,
  `is_discharge` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengeluaran_kas_no_cek_unique` (`no_cek`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pengeluaran_kas` */

insert  into `pengeluaran_kas`(`id`,`akun_id`,`kontak_id`,`no_cek`,`tanggal`,`nilai`,`proyek`,`departement_id`,`keterangan`,`userid`,`is_giro`,`is_cetak`,`is_void`,`is_batal`,`is_delete`,`is_discharge`,`created_at`,`updated_at`) values (1,1,4,'CD000000001','2018-03-13',37500000,'asdf',1,'Biaya Bulanan',NULL,NULL,1,NULL,NULL,NULL,NULL,'2018-04-16 04:57:43','2018-04-16 04:57:43');

/*Table structure for table `pengeluaran_kas_details` */

DROP TABLE IF EXISTS `pengeluaran_kas_details`;

CREATE TABLE `pengeluaran_kas_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pengeluaran_id` int(11) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `departement_id` int(11) NOT NULL,
  `jml_keluar` int(11) NOT NULL,
  `job` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pengeluaran_kas_details` */

insert  into `pengeluaran_kas_details`(`id`,`pengeluaran_id`,`akun_id`,`departement_id`,`jml_keluar`,`job`,`created_at`,`updated_at`) values (1,1,1,1,25000000,'Akuntan','2018-04-16 04:57:43','2018-04-16 04:57:43'),(2,1,2,1,12500000,'Ak','2018-04-16 04:57:43','2018-04-16 04:57:43');

/*Table structure for table `penjualan_deatails` */

DROP TABLE IF EXISTS `penjualan_deatails`;

CREATE TABLE `penjualan_deatails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` int(11) NOT NULL,
  `no_faktur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produk_id` int(11) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `qty_terima` int(11) NOT NULL,
  `qty_pesan` int(11) NOT NULL,
  `uom_id` int(11) NOT NULL,
  `harga_jual` double(8,2) NOT NULL,
  `diskon` decimal(8,2) NOT NULL,
  `total` double(8,2) NOT NULL,
  `pajak` decimal(8,2) NOT NULL,
  `proyek2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penjualan_deatails` */

/*Table structure for table `penjualan_details` */

DROP TABLE IF EXISTS `penjualan_details`;

CREATE TABLE `penjualan_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` int(11) NOT NULL,
  `no_faktur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produk_id` int(11) NOT NULL,
  `akun_id` int(11) DEFAULT NULL,
  `qty_terima` int(11) DEFAULT '0',
  `qty_pesan` int(11) DEFAULT '0',
  `uom_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_jual` int(11) DEFAULT '0',
  `diskon` decimal(8,2) DEFAULT '0.00',
  `total` int(11) DEFAULT '0',
  `pajak` decimal(8,2) DEFAULT '0.00',
  `proyek2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penjualan_details` */

insert  into `penjualan_details`(`id`,`penjualan_id`,`no_faktur`,`produk_id`,`akun_id`,`qty_terima`,`qty_pesan`,`uom_id`,`harga_jual`,`diskon`,`total`,`pajak`,`proyek2`,`created_at`,`updated_at`) values (13,7,'00000000002',1,NULL,12,12,'Dozen',125000,0.00,1500000,0.00,NULL,'2018-04-14 08:53:44','2018-04-14 08:53:44'),(14,7,'00000000002',3,NULL,120,120,NULL,3500,0.00,420000,0.00,NULL,'2018-04-14 08:53:44','2018-04-14 08:53:44'),(15,8,'00000000003',3,NULL,200,200,NULL,7500,0.00,1500000,0.00,NULL,'2018-04-19 03:59:57','2018-04-19 03:59:57'),(16,8,'00000000003',2,NULL,200,200,NULL,5500,0.00,1100000,0.00,NULL,'2018-04-19 03:59:57','2018-04-19 03:59:57');

/*Table structure for table `penjualans` */

DROP TABLE IF EXISTS `penjualans`;

CREATE TABLE `penjualans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kontak_id` int(11) NOT NULL,
  `no_faktur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_po` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_faktur` date NOT NULL,
  `proyek` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gudang_keluar_id` int(11) DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departement_id` int(11) DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `sales` int(11) DEFAULT NULL,
  `term_pembayaran` int(11) DEFAULT NULL,
  `debit_kredit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biaya_lain` int(11) DEFAULT '0',
  `total_pajak` int(11) DEFAULT '0',
  `total_setelah_pajak` int(11) DEFAULT '0',
  `uang_muka` int(11) DEFAULT '0',
  `saldo_terutang` int(11) DEFAULT '0',
  `is_tunai` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_cetak` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_void` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_canceled` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penjualans` */

insert  into `penjualans`(`id`,`kontak_id`,`no_faktur`,`no_po`,`tanggal_faktur`,`proyek`,`gudang_keluar_id`,`keterangan`,`departement_id`,`tanggal_kirim`,`sales`,`term_pembayaran`,`debit_kredit`,`biaya_lain`,`total_pajak`,`total_setelah_pajak`,`uang_muka`,`saldo_terutang`,`is_tunai`,`is_cetak`,`is_void`,`is_canceled`,`created_at`,`updated_at`) values (7,1,'00000000002','0121','2018-03-12','asd',1,'Penjualan',3,'2018-03-20',NULL,60,'Kredit',0,0,1920000,0,1920000,NULL,'Y',NULL,NULL,'2018-04-14 08:53:33','2018-04-14 08:53:33'),(8,5,'00000000003','2','2018-03-21',NULL,1,'Pembelian',3,'2018-03-15',NULL,60,'Kredit',0,0,2600000,0,2600000,NULL,'Y',NULL,NULL,'2018-04-19 03:59:50','2018-04-19 03:59:50');

/*Table structure for table `penyesuaian_details` */

DROP TABLE IF EXISTS `penyesuaian_details`;

CREATE TABLE `penyesuaian_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `penyesuaian_id` int(11) NOT NULL,
  `no_reff` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produk_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `uom_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `akun_id` int(11) DEFAULT NULL,
  `job` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departement_id` int(191) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penyesuaian_details` */

insert  into `penyesuaian_details`(`id`,`penyesuaian_id`,`no_reff`,`produk_id`,`qty`,`uom_id`,`harga_satuan`,`akun_id`,`job`,`departement_id`,`amount`,`created_at`,`updated_at`) values (4,5,'IJ000000001',1,100,'Dozen',15000,1,'aaa',NULL,1500000,'2018-04-13 23:54:52','2018-04-13 23:54:52'),(5,5,'IJ000000001',2,100,NULL,9000,2,'azx',NULL,900000,'2018-04-13 23:54:52','2018-04-13 23:54:52'),(6,5,'IJ000000001',3,100,NULL,3000,1,'qaz',NULL,300000,'2018-04-13 23:54:52','2018-04-13 23:54:52');

/*Table structure for table `penyesuaians` */

DROP TABLE IF EXISTS `penyesuaians`;

CREATE TABLE `penyesuaians` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_reff` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proyek` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `departement_id` int(191) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `gudang_asal` int(11) NOT NULL,
  `gudang_terima` int(11) DEFAULT '0',
  `nilai` int(11) DEFAULT '0',
  `is_cetak` tinyint(1) DEFAULT '0',
  `is_batal` tinyint(1) DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`,`no_reff`,`tanggal`,`departement_id`,`gudang_asal`),
  UNIQUE KEY `penyesuaians_no_reff_unique` (`no_reff`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penyesuaians` */

insert  into `penyesuaians`(`id`,`no_reff`,`proyek`,`tanggal`,`departement_id`,`keterangan`,`gudang_asal`,`gudang_terima`,`nilai`,`is_cetak`,`is_batal`,`is_deleted`,`created_at`,`updated_at`) values (5,'IJ000000001','kkk','2018-03-20',1,'asd',1,0,NULL,1,0,0,'2018-04-13 23:54:43','2018-04-13 23:54:43');

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (1,'users_manage','web','2018-03-17 17:11:05','2018-03-17 17:11:05'),(2,'masters_manage','web','2018-03-17 19:10:30','2018-03-17 19:10:30'),(3,'uoms_view','web','2018-03-17 19:23:29','2018-03-17 19:23:29'),(4,'categorys_view','web','2018-03-17 19:23:48','2018-03-17 19:23:48'),(5,'products_view','web','2018-03-17 19:24:03','2018-03-17 19:24:03'),(6,'departements_view','web','2018-03-23 05:38:01','2018-03-23 05:38:01'),(7,'gudang_view','web','2018-03-23 06:32:39','2018-03-23 06:32:39'),(8,'akun_view','web','2018-03-24 15:25:55','2018-03-24 15:25:55'),(9,'kontak_view','web','2018-03-25 11:34:07','2018-03-25 11:34:07'),(10,'hargajual_view','web','2018-03-30 22:36:36','2018-03-30 22:36:36'),(11,'pembelian_view','web','2018-04-02 21:42:30','2018-04-02 21:42:44'),(12,'transactions_menu','web','2018-04-02 22:04:54','2018-04-02 22:05:07');

/*Table structure for table `piutang_details` */

DROP TABLE IF EXISTS `piutang_details`;

CREATE TABLE `piutang_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `piutang_id` int(11) NOT NULL,
  `no_reff` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjualan_id` int(191) NOT NULL,
  `saldo` int(11) NOT NULL DEFAULT '0',
  `diskon` int(11) NOT NULL DEFAULT '0',
  `jml_dibayar` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `piutang_details` */

insert  into `piutang_details`(`id`,`piutang_id`,`no_reff`,`penjualan_id`,`saldo`,`diskon`,`jml_dibayar`,`created_at`,`updated_at`) values (1,1,'CR000000001',6,0,0,1500000,'2018-04-15 11:40:00','2018-04-15 11:40:00'),(2,2,'CR000000002',6,0,0,500000,'2018-04-15 12:05:07','2018-04-15 12:05:07');

/*Table structure for table `piutangs` */

DROP TABLE IF EXISTS `piutangs`;

CREATE TABLE `piutangs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_reff` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `nilai` int(11) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `kontak_id` int(11) NOT NULL,
  `proyek` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departement_id` int(11) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `denda` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `is_giro` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_cetak` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_batal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_void` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `piutangs_no_reff_unique` (`no_reff`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `piutangs` */

insert  into `piutangs`(`id`,`no_reff`,`tanggal`,`nilai`,`akun_id`,`kontak_id`,`proyek`,`departement_id`,`keterangan`,`denda`,`userid`,`is_giro`,`is_cetak`,`is_batal`,`is_void`,`created_at`,`updated_at`) values (1,'CR000000001','2018-03-22',1500000,1,4,'App',1,NULL,0,1,'Y','Y',NULL,NULL,'2018-04-15 11:40:00','2018-04-15 11:40:00'),(2,'CR000000002','2018-03-31',500000,2,4,'App',1,NULL,0,1,NULL,'Y',NULL,NULL,'2018-04-15 12:05:07','2018-04-15 12:05:07');

/*Table structure for table `product_uoms` */

DROP TABLE IF EXISTS `product_uoms`;

CREATE TABLE `product_uoms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produk_id` int(11) DEFAULT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `nama_uom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `product_uoms` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_produk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_produk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_alias` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_alias` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok` int(11) DEFAULT '0',
  `harga_jual_satuan` int(191) DEFAULT NULL,
  `cash_price` int(11) DEFAULT NULL,
  `supplier_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uom_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pajak_masuk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pajak_keluar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `is_jasa` tinyint(1) DEFAULT '0',
  `photo_produk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`name`,`nama_produk`,`kode_produk`,`kategori_id`,`kode_alias`,`nama_alias`,`stok`,`harga_jual_satuan`,`cash_price`,`supplier_id`,`uom_id`,`pajak_masuk`,`pajak_keluar`,`is_active`,`is_jasa`,`photo_produk`,`created_at`,`updated_at`) values (1,'Baso Sapi','Baso Sapi','b01010001',NULL,NULL,NULL,0,7500,NULL,NULL,'dozen, pcs',NULL,NULL,NULL,NULL,NULL,'2018-04-11 07:46:02','2018-05-14 05:05:02'),(5,'sosis','sosis','sos','sdasd','sos_geb',NULL,0,9000,NULL,NULL,'pcs, dus','0','0',0,0,NULL,'2018-05-11 03:31:06','2018-05-11 03:31:06');

/*Table structure for table `produk_uoms` */

DROP TABLE IF EXISTS `produk_uoms`;

CREATE TABLE `produk_uoms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `produk_id` int(11) DEFAULT NULL,
  `uom_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi_pcs` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `produk_uoms` */

insert  into `produk_uoms`(`id`,`produk_id`,`uom_id`,`isi_pcs`,`created_at`,`updated_at`) values (1,5,'pcs',1,'2018-05-11 14:39:43','2018-05-11 14:39:46'),(2,5,'dus',20,'2018-05-11 14:40:00','2018-05-11 14:40:02'),(7,1,'pcs',1,'2018-05-14 04:05:42','2018-05-14 04:05:42'),(10,1,'dozen',12,'2018-05-14 06:05:39','2018-05-14 06:05:26');

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`) values (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (1,'administrator','web','2018-03-17 17:11:05','2018-03-17 17:11:05'),(2,'user','web','2018-03-18 18:35:59','2018-03-18 18:35:59');

/*Table structure for table `sub_klasifikasis` */

DROP TABLE IF EXISTS `sub_klasifikasis`;

CREATE TABLE `sub_klasifikasis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `klasifikasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subklasifikasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_klasifikasis_subklasifikasi_unique` (`subklasifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sub_klasifikasis` */

insert  into `sub_klasifikasis`(`id`,`klasifikasi`,`subklasifikasi`,`created_at`,`updated_at`) values (1,'Harta','Kas','2018-03-25 10:03:22','2018-03-25 10:03:22'),(2,'Harta','Bank','2018-03-25 10:04:01','2018-03-25 10:04:01'),(3,'Fixed Asset','Harta','2018-04-15 00:57:11','2018-04-15 00:57:11');

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `items` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`invoice_no`,`items`,`customer`,`payment`,`total`,`notes`,`user_id`,`created_at`,`updated_at`) values (1,'18040001','[{\"id\":1,\"name\":\"Jasa - 01\",\"unit\":null,\"price\":null,\"qty\":\"1\",\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":0}]','{\"name\":\"sss\",\"phone\":null}',10,0,NULL,'1','2018-03-24 23:48:13','2018-03-24 23:48:13'),(2,'18040002','[{\"id\":3,\"name\":\"Jasa - 03\",\"unit\":null,\"price\":null,\"qty\":\"5\",\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":0},{\"id\":1,\"name\":\"Jasa - 01\",\"unit\":null,\"price\":null,\"qty\":\"2\",\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":0},{\"id\":2,\"name\":\"Jasa - 02\",\"unit\":null,\"price\":null,\"qty\":\"3\",\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":0}]','{\"name\":\"Jaya\",\"phone\":\"0819\"}',1000,0,'sample dulu','1','2018-03-25 00:20:35','2018-03-25 00:20:35'),(3,'18040003','[{\"id\":1,\"name\":\"Jasa - 01\",\"unit\":null,\"price\":2500000,\"qty\":\"3\",\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":7500000},{\"id\":2,\"name\":\"Jasa - 02\",\"unit\":null,\"price\":3000000,\"qty\":\"2\",\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":6000000}]','{\"name\":\"Utama\",\"phone\":\"022\"}',13500000,13500000,'test','1','2018-03-25 00:44:53','2018-03-25 00:44:53'),(4,'18040004','[{\"id\":3,\"name\":\"Jasa - 03\",\"unit\":null,\"price\":3250000,\"qty\":\"2\",\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":6500000}]','{\"name\":\"sample\",\"phone\":null}',6500000,6500000,'tst','1','2018-03-28 02:17:37','2018-03-28 02:17:37'),(5,'18040005','[{\"id\":2,\"name\":\"Jasa - 02\",\"unit\":null,\"price\":3000000,\"qty\":3,\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":9000000}]','{\"name\":\"Jaya Utama\",\"phone\":null}',9000000,9000000,NULL,'1','2018-03-31 02:34:38','2018-03-31 02:34:38'),(6,'18040006','[{\"id\":1,\"name\":\"Jasa - 01\",\"unit\":null,\"price\":2500000,\"qty\":2,\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":5000000},{\"id\":2,\"name\":\"Jasa - 02\",\"unit\":null,\"price\":3000000,\"qty\":3,\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":9000000}]','{\"name\":\"x\",\"phone\":null}',14000000,14000000,NULL,'1','2018-04-05 19:58:51','2018-04-05 19:58:51');

/*Table structure for table `transfer_details` */

DROP TABLE IF EXISTS `transfer_details`;

CREATE TABLE `transfer_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transfer_id` smallint(6) NOT NULL,
  `no_reff` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produk_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `uom_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ke_gudang` int(11) DEFAULT NULL,
  `jobs` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transfer_details` */

insert  into `transfer_details`(`id`,`transfer_id`,`no_reff`,`produk_id`,`qty`,`uom_id`,`ke_gudang`,`jobs`,`created_at`,`updated_at`) values (3,6,'TR000000001',1,12,'Dozen',1,'as','2018-04-13 23:45:27','2018-04-13 23:45:27'),(4,6,'TR000000001',2,12,NULL,1,'qw','2018-04-13 23:45:27','2018-04-13 23:45:27');

/*Table structure for table `transfer_kas` */

DROP TABLE IF EXISTS `transfer_kas`;

CREATE TABLE `transfer_kas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_akun_id` int(11) NOT NULL,
  `to_akun_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `no_reff` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement_id` int(11) DEFAULT NULL,
  `nilai` int(11) NOT NULL DEFAULT '0',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `userid` int(11) NOT NULL,
  `is_cetak` tinyint(1) DEFAULT '0',
  `is_batal` tinyint(1) DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0',
  `is_void` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transfer_kas_no_reff_unique` (`no_reff`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transfer_kas` */

insert  into `transfer_kas`(`id`,`from_akun_id`,`to_akun_id`,`tanggal`,`no_reff`,`departement_id`,`nilai`,`keterangan`,`userid`,`is_cetak`,`is_batal`,`is_deleted`,`is_void`,`created_at`,`updated_at`) values (1,1,2,'2018-03-13','FT000000001',1,1000000,'asdsd',1,0,0,0,0,'2018-04-16 05:45:59','2018-04-16 05:45:59');

/*Table structure for table `transfers` */

DROP TABLE IF EXISTS `transfers`;

CREATE TABLE `transfers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_reff` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `departement_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gudang_asal` int(11) NOT NULL,
  `gudang_terima` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_cetak` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_tunai` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_batal` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transfers_no_reff_unique` (`no_reff`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transfers` */

insert  into `transfers`(`id`,`no_reff`,`tanggal`,`departement_id`,`keterangan`,`gudang_asal`,`gudang_terima`,`created_at`,`updated_at`,`is_cetak`,`is_tunai`,`is_batal`) values (6,'TR000000001','2018-03-13','3','asd',1,1,'2018-04-13 23:45:18','2018-04-13 23:45:18','Y',NULL,NULL);

/*Table structure for table `uoms` */

DROP TABLE IF EXISTS `uoms`;

CREATE TABLE `uoms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode_uom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_uom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uoms_kode_uom_unique` (`kode_uom`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `uoms` */

insert  into `uoms`(`id`,`kode_uom`,`nama_uom`,`deskripsi`,`name`,`created_at`,`updated_at`) values (22,'pcs','pcs','smalest unit',NULL,'2018-04-20 06:59:27','2018-05-11 03:29:43'),(23,'dus','dus','large unit',NULL,'2018-04-20 06:59:35','2018-05-11 03:30:02'),(24,'dozen','dozen','12 pcs',NULL,'2018-05-14 04:07:23','2018-05-14 04:07:23');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default.jpg',
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`name`,`email`,`password`,`photo`,`remember_token`,`created_at`,`updated_at`) values (1,'admin','Admin','admin@admin.com','$2y$10$XmmbQolfbcdbK2BWmmhVWuu6X26BszRJeTMV3wuY4OMHslWwsv4D.','default.jpg','XsFZxGbLKtOWgJFqCrjhY6NMs7Y2JBXjvHTyhDv39nOMILJuBQHO0JbDFCJO','2018-03-17 17:11:06','2018-03-18 18:29:51'),(2,'user','User','user@localhost.com','$2y$10$FxUM3hhMV2IAHW5/R2emwOTxkRsBn6NwI0kECUQTt7/jj9k742l3y','default.jpg','YVhr29CIGHKBrpJHFaUuDkaO054qTB73FLuGL71E9RZKpdx7Q23UoG4V8wgz','2018-03-18 18:35:13','2018-03-18 18:35:13'),(3,'master','Super Admin','master@admin.com','$2y$10$j9n2ANJX2Ml.RBjBPEafBu3a4zH5CkXeMSd56NlZaG7hg16GbKx5G','default.jpg','beYilJmyzbnb9aHs9dQjoaxo2OkWa8wDloVWSqO5zxuB07ExKQt9s8VwqyNd','2018-04-09 17:05:09','2018-04-09 17:05:09');

/* Function  structure for function  `find_namaKontak` */

/*!50003 DROP FUNCTION IF EXISTS `find_namaKontak` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`homestead`@`%` FUNCTION `find_namaKontak`(p_id int) RETURNS char(255) CHARSET latin1
    DETERMINISTIC
BEGIN
DECLARE namaKontak CHAR(255);
SELECT nama_kontak INTO namaKontak FROM kontaks WHERE id = p_id;
RETURN namaKontak;
END */$$
DELIMITER ;

/*Table structure for table `view_pembayaran_piutang` */

DROP TABLE IF EXISTS `view_pembayaran_piutang`;

/*!50001 DROP VIEW IF EXISTS `view_pembayaran_piutang` */;
/*!50001 DROP TABLE IF EXISTS `view_pembayaran_piutang` */;

/*!50001 CREATE TABLE  `view_pembayaran_piutang`(
 `id` int(10) unsigned ,
 `no_reff` varchar(191) ,
 `tanggal` date ,
 `akun_id` int(11) ,
 `kontak_id` int(11) ,
 `proyek` varchar(191) ,
 `departement_id` int(11) ,
 `keterangan` text ,
 `denda` int(11) ,
 `userid` int(11) ,
 `is_giro` varchar(191) ,
 `is_cetak` varchar(191) ,
 `is_batal` varchar(191) ,
 `is_void` varchar(191) ,
 `created_at` timestamp ,
 `updated_at` timestamp ,
 `ids` int(10) unsigned ,
 `penjualan_id` int(191) ,
 `saldo` int(11) ,
 `diskon` int(11) ,
 `jml_dibayar` int(11) ,
 `created_atx` timestamp ,
 `updated_atx` timestamp 
)*/;

/*Table structure for table `view_saldo_piutang` */

DROP TABLE IF EXISTS `view_saldo_piutang`;

/*!50001 DROP VIEW IF EXISTS `view_saldo_piutang` */;
/*!50001 DROP TABLE IF EXISTS `view_saldo_piutang` */;

/*!50001 CREATE TABLE  `view_saldo_piutang`(
 `kontak_id` int(11) ,
 `namaKontak` char(255) ,
 `saldoTerutang` int(11) ,
 `diBayar` decimal(32,0) ,
 `totalPiutang` decimal(33,0) 
)*/;

/*Table structure for table `view_saldo_utang` */

DROP TABLE IF EXISTS `view_saldo_utang`;

/*!50001 DROP VIEW IF EXISTS `view_saldo_utang` */;
/*!50001 DROP TABLE IF EXISTS `view_saldo_utang` */;

/*!50001 CREATE TABLE  `view_saldo_utang`(
 `id` int(10) unsigned ,
 `kontak_id` int(11) ,
 `saldo_terutang` float ,
 `bayar` decimal(32,0) 
)*/;

/*Table structure for table `views_saldo_hutang` */

DROP TABLE IF EXISTS `views_saldo_hutang`;

/*!50001 DROP VIEW IF EXISTS `views_saldo_hutang` */;
/*!50001 DROP TABLE IF EXISTS `views_saldo_hutang` */;

/*!50001 CREATE TABLE  `views_saldo_hutang`(
 `id` int(10) unsigned ,
 `kontak_id` int(11) ,
 `saldo_terutang` float ,
 `bayar` decimal(32,0) ,
 `saldohutang` double 
)*/;

/*View structure for view view_pembayaran_piutang */

/*!50001 DROP TABLE IF EXISTS `view_pembayaran_piutang` */;
/*!50001 DROP VIEW IF EXISTS `view_pembayaran_piutang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`homestead`@`%` SQL SECURITY DEFINER VIEW `view_pembayaran_piutang` AS (select `a`.`id` AS `id`,`a`.`no_reff` AS `no_reff`,`a`.`tanggal` AS `tanggal`,`a`.`akun_id` AS `akun_id`,`a`.`kontak_id` AS `kontak_id`,`a`.`proyek` AS `proyek`,`a`.`departement_id` AS `departement_id`,`a`.`keterangan` AS `keterangan`,`a`.`denda` AS `denda`,`a`.`userid` AS `userid`,`a`.`is_giro` AS `is_giro`,`a`.`is_cetak` AS `is_cetak`,`a`.`is_batal` AS `is_batal`,`a`.`is_void` AS `is_void`,`a`.`created_at` AS `created_at`,`a`.`updated_at` AS `updated_at`,`b`.`id` AS `ids`,`b`.`penjualan_id` AS `penjualan_id`,`b`.`saldo` AS `saldo`,`b`.`diskon` AS `diskon`,`b`.`jml_dibayar` AS `jml_dibayar`,`b`.`created_at` AS `created_atx`,`b`.`updated_at` AS `updated_atx` from (`piutangs` `a` join `piutang_details` `b`) where (`a`.`id` = `b`.`piutang_id`)) */;

/*View structure for view view_saldo_piutang */

/*!50001 DROP TABLE IF EXISTS `view_saldo_piutang` */;
/*!50001 DROP VIEW IF EXISTS `view_saldo_piutang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`homestead`@`%` SQL SECURITY DEFINER VIEW `view_saldo_piutang` AS (select `a`.`kontak_id` AS `kontak_id`,`find_namaKontak`(`a`.`kontak_id`) AS `namaKontak`,`a`.`saldo_terutang` AS `saldoTerutang`,sum(ifnull(`b`.`jml_dibayar`,0)) AS `diBayar`,(ifnull(`a`.`saldo_terutang`,0) - sum(ifnull(`b`.`jml_dibayar`,0))) AS `totalPiutang` from (`penjualans` `a` left join `view_pembayaran_piutang` `b` on((`a`.`id` = `b`.`penjualan_id`))) group by `a`.`kontak_id`,`find_namaKontak`(`a`.`kontak_id`),`a`.`saldo_terutang`) */;

/*View structure for view view_saldo_utang */

/*!50001 DROP TABLE IF EXISTS `view_saldo_utang` */;
/*!50001 DROP VIEW IF EXISTS `view_saldo_utang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`homestead`@`%` SQL SECURITY DEFINER VIEW `view_saldo_utang` AS (select `pembelians`.`id` AS `id`,`pembelians`.`kontak_id` AS `kontak_id`,`pembelians`.`saldo_terutang` AS `saldo_terutang`,sum(ifnull(`pembayaran_details`.`jml_dibayar`,0)) AS `bayar` from (`pembelians` left join `pembayaran_details` on((`pembelians`.`id` = `pembayaran_details`.`pembelian_id`))) group by `pembelians`.`id`,`pembelians`.`kontak_id`,`pembelians`.`saldo_terutang`) */;

/*View structure for view views_saldo_hutang */

/*!50001 DROP TABLE IF EXISTS `views_saldo_hutang` */;
/*!50001 DROP VIEW IF EXISTS `views_saldo_hutang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`homestead`@`%` SQL SECURITY DEFINER VIEW `views_saldo_hutang` AS (select `view_saldo_utang`.`id` AS `id`,`view_saldo_utang`.`kontak_id` AS `kontak_id`,`view_saldo_utang`.`saldo_terutang` AS `saldo_terutang`,`view_saldo_utang`.`bayar` AS `bayar`,(`view_saldo_utang`.`saldo_terutang` - `view_saldo_utang`.`bayar`) AS `saldohutang` from `view_saldo_utang`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
