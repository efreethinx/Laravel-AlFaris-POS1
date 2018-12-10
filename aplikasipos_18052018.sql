-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: aplikasipos
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `akuns`
--

DROP TABLE IF EXISTS `akuns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akuns`
--

LOCK TABLES `akuns` WRITE;
/*!40000 ALTER TABLE `akuns` DISABLE KEYS */;
INSERT INTO `akuns` VALUES (1,'110015021','Bank','kas_on_bank',2,NULL,NULL,'$','1','2018-03-25 02:03:01','2018-05-15 05:05:27'),(2,'110099020','Kas','kas',1,'Y',NULL,'IDR','1','2018-03-25 03:03:44','2018-05-14 06:05:21'),(4,'110099022','Cash On Hand','cash_on_hand',1,'Y','Y','IDR','1','2018-04-19 05:04:21','2018-05-14 13:05:43'),(5,'110011001','Piutang Dagang','piutang_dagang',1,'Y',NULL,'IDR',NULL,'2018-05-14 13:05:10','2018-05-14 06:05:46');
/*!40000 ALTER TABLE `akuns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (7,'K001','PRODUK SENDIRI','01','Y',NULL,'Y',NULL,NULL,NULL,NULL,NULL,'2018-05-15 06:08:22','2018-05-15 06:08:22'),(8,'K002','PRODUK MITRA','DEPT004','Y','Y','Y','Y',NULL,NULL,NULL,NULL,'2018-05-15 06:17:09','2018-05-15 06:17:09'),(11,'Produk sendiri','Frozen','DEPT002',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-05-16 12:37:18','2018-05-16 12:37:18');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departements`
--

DROP TABLE IF EXISTS `departements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departements`
--

LOCK TABLES `departements` WRITE;
/*!40000 ALTER TABLE `departements` DISABLE KEYS */;
INSERT INTO `departements` VALUES (1,'DEPT003','KEUANGAN','Head Quarter','HASBI','N/A','N/A','2018-03-23 10:00:37','2018-05-15 06:13:43'),(3,'DEPT002','PRODUKSI','Produksi','HASBI','.','.','2018-04-07 21:11:16','2018-05-15 06:12:58'),(10,'DEPT001','TOKO UTAMA',NULL,'HASBI',NULL,NULL,'2018-05-15 06:12:20','2018-05-15 06:12:20'),(11,'DEPT004','MITRA PRODUSEN',NULL,'-',NULL,NULL,'2018-05-15 06:14:26','2018-05-15 06:14:26');
/*!40000 ALTER TABLE `departements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gudangs`
--

DROP TABLE IF EXISTS `gudangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gudangs`
--

LOCK TABLES `gudangs` WRITE;
/*!40000 ALTER TABLE `gudangs` DISABLE KEYS */;
INSERT INTO `gudangs` VALUES (1,'GD001','GUDANG UTAMA','20',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'on','2018-05-15 07:05:37','2018-05-15 07:05:37');
/*!40000 ALTER TABLE `gudangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `harga_juals`
--

DROP TABLE IF EXISTS `harga_juals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `harga_juals`
--

LOCK TABLES `harga_juals` WRITE;
/*!40000 ALTER TABLE `harga_juals` DISABLE KEYS */;
INSERT INTO `harga_juals` VALUES (1,1,'CUST-1','2018-03-14',1,9000,NULL,NULL,'2018-03-31 03:03:57','2018-05-11 10:05:23'),(3,1,'CUST-1','2018-03-27',3,3500,NULL,NULL,'2018-04-10 08:04:59','2018-04-13 13:04:31'),(4,2,'CUST-2','2018-03-25',1,7000,NULL,NULL,'2018-04-10 08:04:40','2018-04-13 13:04:19'),(5,4,'0100','2018-04-10',1,20000,NULL,NULL,'2018-04-13 09:04:37','2018-04-13 09:04:37'),(6,4,'0100','2018-04-18',2,15000,NULL,NULL,'2018-04-13 09:04:09','2018-04-13 09:04:09'),(7,4,'0100','2018-04-04',3,7500,NULL,NULL,'2018-04-13 09:04:41','2018-04-13 09:04:54'),(8,5,'000121','2018-04-01',1,6000,NULL,NULL,'2018-04-15 06:04:32','2018-04-16 07:04:19'),(9,5,'000121','2018-04-01',2,6500,NULL,NULL,'2018-04-15 06:04:48','2018-04-21 06:04:47'),(10,5,'000121','2018-04-08',3,7500,NULL,NULL,'2018-04-15 06:04:07','2018-04-16 07:04:58'),(11,5,'000121','2018-05-14',5,9000,NULL,NULL,'2018-05-14 11:05:45','2018-05-14 11:05:45'),(12,2,'CUST-2','2018-04-30',5,6500,NULL,NULL,'2018-05-14 15:05:22','2018-05-15 05:05:51');
/*!40000 ALTER TABLE `harga_juals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hargajual`
--

DROP TABLE IF EXISTS `hargajual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hargajual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `harga_id` int(11) DEFAULT NULL,
  `kontak_id` int(11) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `kode_produk` varchar(191) DEFAULT NULL,
  `uom_id` varchar(191) DEFAULT NULL,
  `harga_jual_standar` double DEFAULT '0',
  `harga_jual_pelanggan` double DEFAULT '0',
  `harga` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hargajual`
--

LOCK TABLES `hargajual` WRITE;
/*!40000 ALTER TABLE `hargajual` DISABLE KEYS */;
INSERT INTO `hargajual` VALUES (13,11,4,NULL,'0001',NULL,70000,6980,NULL,'2018-05-17 22:36:40','2018-05-17 22:36:40');
/*!40000 ALTER TABLE `hargajual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hargajual_hdr`
--

DROP TABLE IF EXISTS `hargajual_hdr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hargajual_hdr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kontak_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hargajual_hdr`
--

LOCK TABLES `hargajual_hdr` WRITE;
/*!40000 ALTER TABLE `hargajual_hdr` DISABLE KEYS */;
INSERT INTO `hargajual_hdr` VALUES (11,4,'2018-05-18 02:36:40','2018-05-18 02:36:40');
/*!40000 ALTER TABLE `hargajual_hdr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `klasifikasis`
--

DROP TABLE IF EXISTS `klasifikasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `klasifikasis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `klasifikasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `klasifikasis_klasifikasi_unique` (`klasifikasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `klasifikasis`
--

LOCK TABLES `klasifikasis` WRITE;
/*!40000 ALTER TABLE `klasifikasis` DISABLE KEYS */;
/*!40000 ALTER TABLE `klasifikasis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kontak_details`
--

DROP TABLE IF EXISTS `kontak_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kontak_details`
--

LOCK TABLES `kontak_details` WRITE;
/*!40000 ALTER TABLE `kontak_details` DISABLE KEYS */;
INSERT INTO `kontak_details` VALUES (1,1,'CUST-1','JL. Soekarno Hatta No. 483',NULL,'Bandung','40396','Indonesia',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-28 04:03:14'),(2,2,'CUST-2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,3,'0001',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,4,'0100',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,5,'000121',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,6,'1123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `kontak_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kontaks`
--

DROP TABLE IF EXISTS `kontaks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kontaks`
--

LOCK TABLES `kontaks` WRITE;
/*!40000 ALTER TABLE `kontaks` DISABLE KEYS */;
INSERT INTO `kontaks` VALUES (1,'CUST-1','PT. Bersama Sejahtera','IDR','Customer','Company','General',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-25 04:03:28','2018-03-26 03:03:20'),(2,'CUST-2','PT. Sinar Cemerlang','IDR','Customer','Company','General',NULL,NULL,'022 6034777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'-','-','-',NULL,'2018-03-25 08:03:52','2018-05-11 05:05:18'),(3,'0001','Budi','IDR','Supplier','Personal',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-04-13 09:04:57','2018-04-13 09:04:57'),(4,'0100','Jajang','IDR','Customer','Personal',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-04-13 09:04:49','2018-04-13 09:04:49'),(5,'000121','PT. Karya Mandiri Semesta','IDR','Customer','Company',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-04-15 06:04:41','2018-04-15 06:04:41'),(6,'1123','Acum','Idr','Customer','Company','Cirebon',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-05-16 12:05:07','2018-05-16 12:05:07');
/*!40000 ALTER TABLE `kontaks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_07_12_145959_create_permission_tables',1),(4,'2018_03_18_021600_create_uoms_table',2),(5,'2018_03_18_021628_create_categories_table',2),(6,'2018_03_18_021642_create_products_table',2),(7,'2018_03_23_123022_create_departements_table',3),(8,'2018_03_23_131055_create_gudangs_table',4),(9,'2018_03_24_081154_create_klasifikasis_table',5),(10,'2018_03_24_081221_create_sub_klasifikasis_table',5),(11,'2018_03_24_082133_create_akuns_table',5),(12,'2018_03_25_182641_create_kontaks_table',6),(13,'2018_03_25_194449_create_kontak_details_table',7),(14,'2018_03_26_215314_create_harga_juals_table',8),(15,'2018_04_04_064401_transactions_table',9),(16,'2018_04_04_143233_create_pembelians_table',10),(17,'2018_04_06_031355_create_pembelian_details_table',10),(18,'2018_04_09_115820_create_penjualans_table',11),(19,'2018_04_09_184214_create_penjualan_deatails_table',11),(20,'2018_04_09_193221_create_transfers_table',12),(21,'2018_04_09_193240_create_transfer_details_table',12),(22,'2018_04_11_213135_create_pembayarans_table',12),(23,'2018_04_11_213208_create_pembayaran_details_table',12),(24,'2018_04_12_185331_create_pengeluaran_kas_table',13),(25,'2018_04_12_185419_create_pengeluaran_kas_details_table',13),(26,'2018_04_12_231957_create_penerimaan_kas_table',14),(27,'2018_04_12_232106_create_penerimaan_detail_kas_table',14),(29,'2018_04_13_033020_create_transfer_kas_table',15),(30,'2018_04_13_220901_create_penyesuaians_table',16),(31,'2018_04_13_221017_create_penyesuaian_details_table',16),(32,'2018_04_14_063029_create_piutangs_table',17),(33,'2018_04_14_063100_create_piutang_details_table',17),(34,'2018_05_11_034146_create_produk_uoms_table',18);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,1,'App\\User'),(2,2,'App\\User'),(1,3,'App\\User');
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran_details`
--

DROP TABLE IF EXISTS `pembayaran_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran_details`
--

LOCK TABLES `pembayaran_details` WRITE;
/*!40000 ALTER TABLE `pembayaran_details` DISABLE KEYS */;
INSERT INTO `pembayaran_details` VALUES (8,22,'CD000000001',12,1000000,0,750000,'2018-04-13 23:29:05','2018-04-13 23:29:05'),(9,23,'CD000000002',12,250000,0,250000,'2018-04-14 01:34:16','2018-04-14 01:34:16');
/*!40000 ALTER TABLE `pembayaran_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayarans`
--

DROP TABLE IF EXISTS `pembayarans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayarans`
--

LOCK TABLES `pembayarans` WRITE;
/*!40000 ALTER TABLE `pembayarans` DISABLE KEYS */;
INSERT INTO `pembayarans` VALUES (22,'CD000000001','2018-03-23',750000,2,3,'App',1,NULL,0,1,'Y','Y',NULL,NULL,'2018-04-13 23:28:56','2018-04-13 23:28:56'),(23,'CD000000002','2018-03-06',250000,1,3,NULL,1,NULL,NULL,1,NULL,'Y',NULL,NULL,'2018-04-14 01:34:07','2018-04-14 01:34:07');
/*!40000 ALTER TABLE `pembayarans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembelian_details`
--

DROP TABLE IF EXISTS `pembelian_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembelian_details`
--

LOCK TABLES `pembelian_details` WRITE;
/*!40000 ALTER TABLE `pembelian_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `pembelian_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembelians`
--

DROP TABLE IF EXISTS `pembelians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembelians`
--

LOCK TABLES `pembelians` WRITE;
/*!40000 ALTER TABLE `pembelians` DISABLE KEYS */;
/*!40000 ALTER TABLE `pembelians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penerimaan_detail_kas`
--

DROP TABLE IF EXISTS `penerimaan_detail_kas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penerimaan_detail_kas`
--

LOCK TABLES `penerimaan_detail_kas` WRITE;
/*!40000 ALTER TABLE `penerimaan_detail_kas` DISABLE KEYS */;
INSERT INTO `penerimaan_detail_kas` VALUES (1,1,2,1,1000000,'assd','2018-04-16 09:43:51','2018-04-16 09:43:51');
/*!40000 ALTER TABLE `penerimaan_detail_kas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penerimaan_kas`
--

DROP TABLE IF EXISTS `penerimaan_kas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penerimaan_kas`
--

LOCK TABLES `penerimaan_kas` WRITE;
/*!40000 ALTER TABLE `penerimaan_kas` DISABLE KEYS */;
INSERT INTO `penerimaan_kas` VALUES (1,1,2,'CR000000001','2018-03-21',1000000,NULL,3,'asdsd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-04-16 09:43:51','2018-04-16 09:43:51');
/*!40000 ALTER TABLE `penerimaan_kas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengeluaran_kas`
--

DROP TABLE IF EXISTS `pengeluaran_kas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengeluaran_kas`
--

LOCK TABLES `pengeluaran_kas` WRITE;
/*!40000 ALTER TABLE `pengeluaran_kas` DISABLE KEYS */;
INSERT INTO `pengeluaran_kas` VALUES (1,1,4,'CD000000001','2018-03-13',37500000,'asdf',1,'Biaya Bulanan',NULL,NULL,1,NULL,NULL,NULL,NULL,'2018-04-16 08:57:43','2018-04-16 08:57:43');
/*!40000 ALTER TABLE `pengeluaran_kas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengeluaran_kas_details`
--

DROP TABLE IF EXISTS `pengeluaran_kas_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengeluaran_kas_details`
--

LOCK TABLES `pengeluaran_kas_details` WRITE;
/*!40000 ALTER TABLE `pengeluaran_kas_details` DISABLE KEYS */;
INSERT INTO `pengeluaran_kas_details` VALUES (1,1,1,1,25000000,'Akuntan','2018-04-16 08:57:43','2018-04-16 08:57:43'),(2,1,2,1,12500000,'Ak','2018-04-16 08:57:43','2018-04-16 08:57:43');
/*!40000 ALTER TABLE `pengeluaran_kas_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penjualan_deatails`
--

DROP TABLE IF EXISTS `penjualan_deatails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penjualan_deatails`
--

LOCK TABLES `penjualan_deatails` WRITE;
/*!40000 ALTER TABLE `penjualan_deatails` DISABLE KEYS */;
/*!40000 ALTER TABLE `penjualan_deatails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penjualan_details`
--

DROP TABLE IF EXISTS `penjualan_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penjualan_details`
--

LOCK TABLES `penjualan_details` WRITE;
/*!40000 ALTER TABLE `penjualan_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `penjualan_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penjualans`
--

DROP TABLE IF EXISTS `penjualans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penjualans`
--

LOCK TABLES `penjualans` WRITE;
/*!40000 ALTER TABLE `penjualans` DISABLE KEYS */;
/*!40000 ALTER TABLE `penjualans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penyesuaian_details`
--

DROP TABLE IF EXISTS `penyesuaian_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penyesuaian_details`
--

LOCK TABLES `penyesuaian_details` WRITE;
/*!40000 ALTER TABLE `penyesuaian_details` DISABLE KEYS */;
INSERT INTO `penyesuaian_details` VALUES (4,5,'IJ000000001',1,100,'Dozen',15000,1,'aaa',NULL,1500000,'2018-04-14 03:54:52','2018-04-14 03:54:52'),(5,5,'IJ000000001',2,100,NULL,9000,2,'azx',NULL,900000,'2018-04-14 03:54:52','2018-04-14 03:54:52'),(6,5,'IJ000000001',3,100,NULL,3000,1,'qaz',NULL,300000,'2018-04-14 03:54:52','2018-04-14 03:54:52');
/*!40000 ALTER TABLE `penyesuaian_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penyesuaians`
--

DROP TABLE IF EXISTS `penyesuaians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penyesuaians`
--

LOCK TABLES `penyesuaians` WRITE;
/*!40000 ALTER TABLE `penyesuaians` DISABLE KEYS */;
INSERT INTO `penyesuaians` VALUES (5,'IJ000000001','kkk','2018-03-20',1,'asd',1,0,NULL,1,0,0,'2018-04-14 03:54:43','2018-04-14 03:54:43');
/*!40000 ALTER TABLE `penyesuaians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'users_manage','web','2018-03-17 21:11:05','2018-03-17 21:11:05'),(2,'masters_manage','web','2018-03-17 23:10:30','2018-03-17 23:10:30'),(3,'uoms_view','web','2018-03-17 23:23:29','2018-03-17 23:23:29'),(4,'categorys_view','web','2018-03-17 23:23:48','2018-03-17 23:23:48'),(5,'products_view','web','2018-03-17 23:24:03','2018-03-17 23:24:03'),(6,'departements_view','web','2018-03-23 09:38:01','2018-03-23 09:38:01'),(7,'gudang_view','web','2018-03-23 10:32:39','2018-03-23 10:32:39'),(8,'akun_view','web','2018-03-24 19:25:55','2018-03-24 19:25:55'),(9,'kontak_view','web','2018-03-25 15:34:07','2018-03-25 15:34:07'),(10,'hargajual_view','web','2018-03-31 02:36:36','2018-03-31 02:36:36'),(11,'pembelian_view','web','2018-04-03 01:42:30','2018-04-03 01:42:44'),(12,'transactions_menu','web','2018-04-03 02:04:54','2018-04-03 02:05:07');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `piutang_details`
--

DROP TABLE IF EXISTS `piutang_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `piutang_details`
--

LOCK TABLES `piutang_details` WRITE;
/*!40000 ALTER TABLE `piutang_details` DISABLE KEYS */;
INSERT INTO `piutang_details` VALUES (1,1,'CR000000001',6,0,0,1500000,'2018-04-15 15:40:00','2018-04-15 15:40:00'),(2,2,'CR000000002',6,0,0,500000,'2018-04-15 16:05:07','2018-04-15 16:05:07');
/*!40000 ALTER TABLE `piutang_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `piutangs`
--

DROP TABLE IF EXISTS `piutangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `piutangs`
--

LOCK TABLES `piutangs` WRITE;
/*!40000 ALTER TABLE `piutangs` DISABLE KEYS */;
INSERT INTO `piutangs` VALUES (1,'CR000000001','2018-03-22',1500000,1,4,'App',1,NULL,0,1,'Y','Y',NULL,NULL,'2018-04-15 15:40:00','2018-04-15 15:40:00'),(2,'CR000000002','2018-03-31',500000,2,4,'App',1,NULL,0,1,NULL,'Y',NULL,NULL,'2018-04-15 16:05:07','2018-04-15 16:05:07');
/*!40000 ALTER TABLE `piutangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_uoms`
--

DROP TABLE IF EXISTS `product_uoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_uoms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produk_id` int(11) DEFAULT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `nama_uom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_uoms`
--

LOCK TABLES `product_uoms` WRITE;
/*!40000 ALTER TABLE `product_uoms` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_uoms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (6,'OTAK','OTAK','0001','PRODUK MITRA',NULL,NULL,0,70000,NULL,'1','dus, pcs',NULL,NULL,NULL,NULL,NULL,'2018-05-15 07:31:07','2018-05-15 08:05:00'),(7,'Basis','Basis','Basis','Frozen',NULL,NULL,0,14000,NULL,'1','pcs',NULL,NULL,NULL,NULL,NULL,'2018-05-16 12:43:39','2018-05-16 12:43:39');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produk_uoms`
--

DROP TABLE IF EXISTS `produk_uoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produk_uoms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `produk_id` int(11) DEFAULT NULL,
  `uom_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi_pcs` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produk_uoms`
--

LOCK TABLES `produk_uoms` WRITE;
/*!40000 ALTER TABLE `produk_uoms` DISABLE KEYS */;
INSERT INTO `produk_uoms` VALUES (1,5,'pcs',1,'2018-05-11 18:39:43','2018-05-11 18:39:46'),(2,5,'dus',20,'2018-05-11 18:40:00','2018-05-11 18:40:02'),(7,1,'pcs',1,'2018-05-14 08:05:42','2018-05-14 08:05:42'),(10,1,'dozen',12,'2018-05-14 10:05:39','2018-05-14 10:05:26'),(11,6,'pcs',1,'2018-05-15 08:05:16','2018-05-15 08:05:16'),(12,6,'dus',10,'2018-05-15 08:05:25','2018-05-15 08:05:35');
/*!40000 ALTER TABLE `produk_uoms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrator','web','2018-03-17 21:11:05','2018-03-17 21:11:05'),(2,'user','web','2018-03-18 22:35:59','2018-03-18 22:35:59');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_klasifikasis`
--

DROP TABLE IF EXISTS `sub_klasifikasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_klasifikasis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `klasifikasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subklasifikasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_klasifikasis_subklasifikasi_unique` (`subklasifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_klasifikasis`
--

LOCK TABLES `sub_klasifikasis` WRITE;
/*!40000 ALTER TABLE `sub_klasifikasis` DISABLE KEYS */;
INSERT INTO `sub_klasifikasis` VALUES (1,'Harta','Kas','2018-03-25 14:03:22','2018-03-25 14:03:22'),(2,'Harta','Bank','2018-03-25 14:04:01','2018-03-25 14:04:01'),(3,'Fixed Asset','Harta','2018-04-15 04:57:11','2018-04-15 04:57:11');
/*!40000 ALTER TABLE `sub_klasifikasis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,'18040001','[{\"id\":1,\"name\":\"Jasa - 01\",\"unit\":null,\"price\":null,\"qty\":\"1\",\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":0}]','{\"name\":\"sss\",\"phone\":null}',10,0,NULL,'1','2018-03-25 03:48:13','2018-03-25 03:48:13'),(2,'18040002','[{\"id\":3,\"name\":\"Jasa - 03\",\"unit\":null,\"price\":null,\"qty\":\"5\",\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":0},{\"id\":1,\"name\":\"Jasa - 01\",\"unit\":null,\"price\":null,\"qty\":\"2\",\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":0},{\"id\":2,\"name\":\"Jasa - 02\",\"unit\":null,\"price\":null,\"qty\":\"3\",\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":0}]','{\"name\":\"Jaya\",\"phone\":\"0819\"}',1000,0,'sample dulu','1','2018-03-25 04:20:35','2018-03-25 04:20:35'),(3,'18040003','[{\"id\":1,\"name\":\"Jasa - 01\",\"unit\":null,\"price\":2500000,\"qty\":\"3\",\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":7500000},{\"id\":2,\"name\":\"Jasa - 02\",\"unit\":null,\"price\":3000000,\"qty\":\"2\",\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":6000000}]','{\"name\":\"Utama\",\"phone\":\"022\"}',13500000,13500000,'test','1','2018-03-25 04:44:53','2018-03-25 04:44:53'),(4,'18040004','[{\"id\":3,\"name\":\"Jasa - 03\",\"unit\":null,\"price\":3250000,\"qty\":\"2\",\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":6500000}]','{\"name\":\"sample\",\"phone\":null}',6500000,6500000,'tst','1','2018-03-28 06:17:37','2018-03-28 06:17:37'),(5,'18040005','[{\"id\":2,\"name\":\"Jasa - 02\",\"unit\":null,\"price\":3000000,\"qty\":3,\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":9000000}]','{\"name\":\"Jaya Utama\",\"phone\":null}',9000000,9000000,NULL,'1','2018-03-31 06:34:38','2018-03-31 06:34:38'),(6,'18040006','[{\"id\":1,\"name\":\"Jasa - 01\",\"unit\":null,\"price\":2500000,\"qty\":2,\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":5000000},{\"id\":2,\"name\":\"Jasa - 02\",\"unit\":null,\"price\":3000000,\"qty\":3,\"item_discount\":0,\"item_discount_subtotal\":0,\"subtotal\":9000000}]','{\"name\":\"x\",\"phone\":null}',14000000,14000000,NULL,'1','2018-04-05 23:58:51','2018-04-05 23:58:51');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfer_details`
--

DROP TABLE IF EXISTS `transfer_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfer_details`
--

LOCK TABLES `transfer_details` WRITE;
/*!40000 ALTER TABLE `transfer_details` DISABLE KEYS */;
INSERT INTO `transfer_details` VALUES (3,6,'TR000000001',1,12,'Dozen',1,'as','2018-04-14 03:45:27','2018-04-14 03:45:27'),(4,6,'TR000000001',2,12,NULL,1,'qw','2018-04-14 03:45:27','2018-04-14 03:45:27');
/*!40000 ALTER TABLE `transfer_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfer_kas`
--

DROP TABLE IF EXISTS `transfer_kas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfer_kas`
--

LOCK TABLES `transfer_kas` WRITE;
/*!40000 ALTER TABLE `transfer_kas` DISABLE KEYS */;
INSERT INTO `transfer_kas` VALUES (1,1,2,'2018-03-13','FT000000001',1,1000000,'asdsd',1,0,0,0,0,'2018-04-16 09:45:59','2018-04-16 09:45:59');
/*!40000 ALTER TABLE `transfer_kas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfers`
--

LOCK TABLES `transfers` WRITE;
/*!40000 ALTER TABLE `transfers` DISABLE KEYS */;
INSERT INTO `transfers` VALUES (6,'TR000000001','2018-03-13','3','asd',1,1,'2018-04-14 03:45:18','2018-04-14 03:45:18','Y',NULL,NULL);
/*!40000 ALTER TABLE `transfers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uoms`
--

DROP TABLE IF EXISTS `uoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uoms`
--

LOCK TABLES `uoms` WRITE;
/*!40000 ALTER TABLE `uoms` DISABLE KEYS */;
INSERT INTO `uoms` VALUES (22,'pcs','pcs','smalest unit',NULL,'2018-04-20 10:59:27','2018-05-11 07:29:43'),(23,'dus','dus','large unit',NULL,'2018-04-20 10:59:35','2018-05-11 07:30:02'),(24,'dozen','dozen','12 pcs',NULL,'2018-05-14 08:07:23','2018-05-14 08:07:23'),(25,'Pack','Pack',NULL,NULL,'2018-05-16 12:32:07','2018-05-16 12:32:07'),(26,'Renteng','Rent',NULL,NULL,'2018-05-17 12:20:41','2018-05-17 12:20:41'),(27,'Ball','Ball',NULL,NULL,'2018-05-17 12:21:00','2018-05-17 12:21:00');
/*!40000 ALTER TABLE `uoms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','Admin','admin@admin.com','$2y$10$XmmbQolfbcdbK2BWmmhVWuu6X26BszRJeTMV3wuY4OMHslWwsv4D.','default.jpg','ml8yWyCVmmLooNfgDnrtwBBH5mPnkDxet6T0bpQccKnMPfUBfpIUuGUaZTpG','2018-03-17 21:11:06','2018-03-18 22:29:51'),(2,'user','User','user@localhost.com','$2y$10$FxUM3hhMV2IAHW5/R2emwOTxkRsBn6NwI0kECUQTt7/jj9k742l3y','default.jpg','Puiq7gKKxlKEQfmdC8Q1qJ19pwr96H877vYWOwGLcn0z80aX4WsWpZvKQJyW','2018-03-18 22:35:13','2018-03-18 22:35:13'),(3,'master','Super Admin','master@admin.com','$2y$10$j9n2ANJX2Ml.RBjBPEafBu3a4zH5CkXeMSd56NlZaG7hg16GbKx5G','default.jpg','beYilJmyzbnb9aHs9dQjoaxo2OkWa8wDloVWSqO5zxuB07ExKQt9s8VwqyNd','2018-04-09 21:05:09','2018-04-09 21:05:09');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `view_pembayaran_piutang`
--

DROP TABLE IF EXISTS `view_pembayaran_piutang`;
/*!50001 DROP VIEW IF EXISTS `view_pembayaran_piutang`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `view_pembayaran_piutang` AS SELECT 
 1 AS `id`,
 1 AS `no_reff`,
 1 AS `tanggal`,
 1 AS `akun_id`,
 1 AS `kontak_id`,
 1 AS `proyek`,
 1 AS `departement_id`,
 1 AS `keterangan`,
 1 AS `denda`,
 1 AS `userid`,
 1 AS `is_giro`,
 1 AS `is_cetak`,
 1 AS `is_batal`,
 1 AS `is_void`,
 1 AS `created_at`,
 1 AS `updated_at`,
 1 AS `ids`,
 1 AS `penjualan_id`,
 1 AS `saldo`,
 1 AS `diskon`,
 1 AS `jml_dibayar`,
 1 AS `created_atx`,
 1 AS `updated_atx`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `view_saldo_utang`
--

DROP TABLE IF EXISTS `view_saldo_utang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `view_saldo_utang` (
  `id` int(10) unsigned DEFAULT NULL,
  `kontak_id` int(11) DEFAULT NULL,
  `saldo_terutang` float DEFAULT NULL,
  `bayar` decimal(32,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `view_saldo_utang`
--

LOCK TABLES `view_saldo_utang` WRITE;
/*!40000 ALTER TABLE `view_saldo_utang` DISABLE KEYS */;
/*!40000 ALTER TABLE `view_saldo_utang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `views_saldo_hutang`
--

DROP TABLE IF EXISTS `views_saldo_hutang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `views_saldo_hutang` (
  `id` int(10) unsigned DEFAULT NULL,
  `kontak_id` int(11) DEFAULT NULL,
  `saldo_terutang` float DEFAULT NULL,
  `bayar` decimal(32,0) DEFAULT NULL,
  `saldohutang` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `views_saldo_hutang`
--

LOCK TABLES `views_saldo_hutang` WRITE;
/*!40000 ALTER TABLE `views_saldo_hutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `views_saldo_hutang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `view_pembayaran_piutang`
--

/*!50001 DROP VIEW IF EXISTS `view_pembayaran_piutang`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`homestead`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `view_pembayaran_piutang` AS (select `a`.`id` AS `id`,`a`.`no_reff` AS `no_reff`,`a`.`tanggal` AS `tanggal`,`a`.`akun_id` AS `akun_id`,`a`.`kontak_id` AS `kontak_id`,`a`.`proyek` AS `proyek`,`a`.`departement_id` AS `departement_id`,`a`.`keterangan` AS `keterangan`,`a`.`denda` AS `denda`,`a`.`userid` AS `userid`,`a`.`is_giro` AS `is_giro`,`a`.`is_cetak` AS `is_cetak`,`a`.`is_batal` AS `is_batal`,`a`.`is_void` AS `is_void`,`a`.`created_at` AS `created_at`,`a`.`updated_at` AS `updated_at`,`b`.`id` AS `ids`,`b`.`penjualan_id` AS `penjualan_id`,`b`.`saldo` AS `saldo`,`b`.`diskon` AS `diskon`,`b`.`jml_dibayar` AS `jml_dibayar`,`b`.`created_at` AS `created_atx`,`b`.`updated_at` AS `updated_atx` from (`piutangs` `a` join `piutang_details` `b`) where (`a`.`id` = `b`.`piutang_id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-17 23:35:15
