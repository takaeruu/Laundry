/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : laundry

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 15/08/2024 14:53:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jpakaian
-- ----------------------------
DROP TABLE IF EXISTS `jpakaian`;
CREATE TABLE `jpakaian`  (
  `id_jpakaian` int NOT NULL AUTO_INCREMENT,
  `jenis_pakaian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_jpakaian`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jpakaian
-- ----------------------------
INSERT INTO `jpakaian` VALUES (1, 'Baju Lengan Panjang', NULL, 1, NULL, NULL, '2024-07-31 09:32:43', NULL);
INSERT INTO `jpakaian` VALUES (2, 'Celana', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jpakaian` VALUES (3, 'Celana Dalam', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jpakaian` VALUES (6, 'Kemeja', 1, 1, NULL, '2024-07-31 09:33:56', '2024-07-31 09:34:01', NULL);

-- ----------------------------
-- Table structure for jpelayanan
-- ----------------------------
DROP TABLE IF EXISTS `jpelayanan`;
CREATE TABLE `jpelayanan`  (
  `id_jpelayanan` int NOT NULL AUTO_INCREMENT,
  `jenis_pelayanan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_jpelayanan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jpelayanan
-- ----------------------------
INSERT INTO `jpelayanan` VALUES (1, 'Cuci Basah', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jpelayanan` VALUES (2, 'Cuci Kering', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jpelayanan` VALUES (3, 'Cuci Basah + Setrika', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jpelayanan` VALUES (4, 'Setrika', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jpelayanan` VALUES (5, 'Cuci Kering + Setrika', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jpelayanan` VALUES (7, 'Cuci Kering Setengah Matang', 1, 1, NULL, '2024-07-31 09:29:00', '2024-07-31 09:29:39', NULL);

-- ----------------------------
-- Table structure for pemesanan
-- ----------------------------
DROP TABLE IF EXISTS `pemesanan`;
CREATE TABLE `pemesanan`  (
  `id_pemesanan` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `id_jpakaian` int NULL DEFAULT NULL,
  `berat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` int NULL DEFAULT NULL,
  `id_jpelayanan` int NULL DEFAULT NULL,
  `status` enum('DiKerjakan','DiAntar','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_pemesanan` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `tipe` enum('Antar & Bayar Nanti','Pickup & Bayar Nanti','Antar & Bayar Langsung','Pickup & Bayar Langsung') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pemesanan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 79 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pemesanan
-- ----------------------------
INSERT INTO `pemesanan` VALUES (78, 38, 2, '1kg', 20000, 4, 'DiKerjakan', 'PS00000003', 1, 1, NULL, '2024-08-14 08:37:04', '2024-08-15 13:39:47', NULL, 'Pickup & Bayar Nanti');

-- ----------------------------
-- Table structure for pemesanan_backup
-- ----------------------------
DROP TABLE IF EXISTS `pemesanan_backup`;
CREATE TABLE `pemesanan_backup`  (
  `id_pemesanan` int NOT NULL,
  `id_user` int NULL DEFAULT NULL,
  `id_jpakaian` int NULL DEFAULT NULL,
  `berat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` int NULL DEFAULT NULL,
  `id_jpelayanan` int NULL DEFAULT NULL,
  `status` enum('DiKerjakan','DiAntar','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_pemesanan` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `tipe` enum('Antar & Bayar Nanti','Pickup & Bayar Nanti','Antar & Bayar Langsung','Pickup & Bayar Langsung') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `backup_at` datetime NULL DEFAULT NULL,
  `backup_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_pemesanan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pemesanan_backup
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id_permission` int NOT NULL AUTO_INCREMENT,
  `level` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `can_access` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_permission`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 285 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (184, 'Pelanggan', 'dashboard', 1);
INSERT INTO `permissions` VALUES (185, 'Pelanggan', 'pemesanan', 1);
INSERT INTO `permissions` VALUES (186, 'Pelanggan', 'transaksi', 1);
INSERT INTO `permissions` VALUES (241, 'Admin', 'dashboard', 1);
INSERT INTO `permissions` VALUES (242, 'Admin', 'pemesanan_karyawan', 1);
INSERT INTO `permissions` VALUES (243, 'Admin', 'transaksi_karyawan', 1);
INSERT INTO `permissions` VALUES (244, 'Admin', 'laporan', 1);
INSERT INTO `permissions` VALUES (245, 'Admin', 'jenis_paket', 1);
INSERT INTO `permissions` VALUES (246, 'Admin', 'jenis_pelayanan', 1);
INSERT INTO `permissions` VALUES (247, 'Admin', 'karyawan', 1);
INSERT INTO `permissions` VALUES (248, 'Admin', 'setting', 1);
INSERT INTO `permissions` VALUES (249, 'Admin', 'log_activity', 1);
INSERT INTO `permissions` VALUES (250, 'Admin', 'restore_data', 1);
INSERT INTO `permissions` VALUES (251, 'Admin', 'level', 1);
INSERT INTO `permissions` VALUES (252, 'Admin', 'restore_edit', 1);
INSERT INTO `permissions` VALUES (277, 'Karyawan', 'dashboard', 1);
INSERT INTO `permissions` VALUES (278, 'Karyawan', 'pemesanan', 1);
INSERT INTO `permissions` VALUES (279, 'Karyawan', 'transaksi', 1);
INSERT INTO `permissions` VALUES (280, 'Karyawan', 'pemesanan_karyawan', 1);
INSERT INTO `permissions` VALUES (281, 'Karyawan', 'transaksi_karyawan', 1);
INSERT INTO `permissions` VALUES (282, 'Karyawan', 'laporan', 1);
INSERT INTO `permissions` VALUES (283, 'Karyawan', 'jenis_paket', 1);
INSERT INTO `permissions` VALUES (284, 'Karyawan', 'jenis_pelayanan', 1);

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `logo_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tab_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `login_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, '', '1722867534_b68fa85da1dcdafcedd8.jpeg', '1722867524_3eb4cf9f54223f002474.png', '1722867534_4b659a2e04aa2671b071.jpeg', NULL, 1, NULL, NULL, '2024-08-05 21:18:54', NULL);

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_nota` datetime NULL DEFAULT NULL,
  `total_harga` int NULL DEFAULT NULL,
  `id_user` int NULL DEFAULT NULL,
  `kode_pemesanan` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bayar` int NULL DEFAULT NULL,
  `kembalian` int NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `pelanggan` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 99 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transaksi
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` enum('Admin','Pelanggan','Karyawan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nohp` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'admin@gmail.com', 'Admin', '085157206615', 'Batam Centre', '1722923297_de4fb58b45f1e5c6efc1.jpg', 1, '2024-08-01 01:17:44');
INSERT INTO `user` VALUES (3, 'karyawan', 'c4ca4238a0b923820dcc509a6f75849b', 'karyawan@gmail.com', 'Karyawan', '0882768281', 'Bengkong', NULL, NULL, NULL);
INSERT INTO `user` VALUES (15, 'Sterling', 'c4ca4238a0b923820dcc509a6f75849b', 'sterling@gmail.com', 'Pelanggan', '08576288191', 'London', NULL, NULL, NULL);
INSERT INTO `user` VALUES (16, 'Ahmad', 'c4ca4238a0b923820dcc509a6f75849b', 'ahmad@gmail.com', 'Pelanggan', '0821997212', 'London', NULL, 16, '2024-08-05 21:29:05');
INSERT INTO `user` VALUES (17, 'Messi2', 'c4ca4238a0b923820dcc509a6f75849b', 'messi2@gmail.com', 'Pelanggan', '911', 'Amerika, Inter Miami Blok M', NULL, NULL, NULL);
INSERT INTO `user` VALUES (18, 'yoga gautama', 'c4ca4238a0b923820dcc509a6f75849b', 'yoga@gmail.com', 'Pelanggan', '08121121212', 'Golden land', NULL, NULL, NULL);
INSERT INTO `user` VALUES (19, 'Tinardo', 'c4ca4238a0b923820dcc509a6f75849b', 'tinardo@gmail.com', 'Karyawan', '0871628819191', 'bengkong', NULL, NULL, NULL);
INSERT INTO `user` VALUES (38, 'Pelanggan', 'c4ca4238a0b923820dcc509a6f75849b', '1wellsonriki@gmail.com', 'Pelanggan', '1', '1', '1723005680_599f22bc45122806ed30.jpg', NULL, NULL);

-- ----------------------------
-- Table structure for user_activity
-- ----------------------------
DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE `user_activity`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `menu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 230 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_activity
-- ----------------------------
INSERT INTO `user_activity` VALUES (229, 1, 'Menghapus Activity', NULL, '2024-08-15 14:50:34', '2024-08-15 14:50:34');

-- ----------------------------
-- Triggers structure for table transaksi
-- ----------------------------
DROP TRIGGER IF EXISTS `tes`;
delimiter ;;
CREATE TRIGGER `tes` AFTER INSERT ON `transaksi` FOR EACH ROW UPDATE pemesanan
    SET status = 'Selesai'
    WHERE kode_pemesanan = NEW.kode_pemesanan
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
