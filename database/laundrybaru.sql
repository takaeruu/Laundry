/*
 Navicat Premium Data Transfer

 Source Server         : yoga
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : laundrybaru

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 13/08/2024 14:01:39
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
-- Table structure for jpakaian_backup
-- ----------------------------
DROP TABLE IF EXISTS `jpakaian_backup`;
CREATE TABLE `jpakaian_backup`  (
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
-- Records of jpakaian_backup
-- ----------------------------
INSERT INTO `jpakaian_backup` VALUES (1, 'Baju Lengan Panjang', NULL, 1, NULL, NULL, '2024-07-31 09:32:43', NULL);
INSERT INTO `jpakaian_backup` VALUES (2, 'Celana', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jpakaian_backup` VALUES (3, 'Celana Dalam', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jpakaian_backup` VALUES (6, 'Kemeja', 1, 1, NULL, '2024-07-31 09:33:56', '2024-07-31 09:34:01', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

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
-- Table structure for jpelayanan_backup
-- ----------------------------
DROP TABLE IF EXISTS `jpelayanan_backup`;
CREATE TABLE `jpelayanan_backup`  (
  `id_jpelayanan` int NOT NULL AUTO_INCREMENT,
  `jenis_pelayanan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_jpelayanan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jpelayanan_backup
-- ----------------------------
INSERT INTO `jpelayanan_backup` VALUES (1, 'Cuci Basah', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jpelayanan_backup` VALUES (2, 'Cuci Kering', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jpelayanan_backup` VALUES (3, 'Cuci Basah + Setrika', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jpelayanan_backup` VALUES (4, 'Setrika', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jpelayanan_backup` VALUES (5, 'Cuci Kering + Setrika', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `jpelayanan_backup` VALUES (7, 'Cuci Kering Setengah Matang', 1, 1, NULL, '2024-07-31 09:29:00', '2024-07-31 09:29:39', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 73 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pemesanan
-- ----------------------------
INSERT INTO `pemesanan` VALUES (70, 17, 1, '6', 6000, 1, 'DiKerjakan', 'PS00000001', 1, NULL, NULL, '2024-08-12 11:30:48', NULL, NULL, 'Antar & Bayar Langsung');
INSERT INTO `pemesanan` VALUES (71, 8, 2, '65555', 2147483647, 2, 'DiKerjakan', 'PS00000002', 1, NULL, NULL, '2024-08-12 11:43:19', NULL, NULL, 'Pickup & Bayar Langsung');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, 'Family Laundry', 'family_tree.png', 'family_tree.png', 'family_tree.png', NULL, 1, NULL, NULL, '2024-08-07 10:52:03', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 97 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES (90, '0124080401', '2024-08-04 20:43:20', 40000, 1, 'PS00000010', 50000, 10000, 1, NULL, NULL, '2024-08-04 20:43:22', NULL, NULL, 15);
INSERT INTO `transaksi` VALUES (91, '0124080402', '2024-08-04 20:46:39', 250000, 1, 'PS00000004', 300000, 50000, 8, NULL, NULL, '2024-08-04 20:46:42', NULL, NULL, 8);
INSERT INTO `transaksi` VALUES (92, '0124080501', '2024-08-05 13:47:44', 260000, 1, 'PS00000011', 300000, 40000, 1, NULL, NULL, '2024-08-05 13:48:02', NULL, NULL, 17);
INSERT INTO `transaksi` VALUES (93, '0124080502', '2024-08-05 13:51:14', 20000, 1, 'PS00000015', 20000, 0, 1, NULL, NULL, '2024-08-05 13:51:18', NULL, NULL, 16);
INSERT INTO `transaksi` VALUES (94, '0124080503', '2024-08-05 20:38:56', 50000, 1, 'PS00000016', 100000, 50000, 1, NULL, NULL, '2024-08-05 20:39:00', NULL, NULL, 16);
INSERT INTO `transaksi` VALUES (95, '0124080504', '2024-08-05 21:16:25', 20000, 1, 'PS00000019', 20000, 0, 1, NULL, NULL, '2024-08-05 21:16:27', NULL, NULL, 17);
INSERT INTO `transaksi` VALUES (96, '0124081101', '2024-08-11 21:35:46', 20000, 1, 'PS00000002', 100000, 80000, 1, NULL, NULL, '2024-08-11 21:35:50', NULL, NULL, 2);

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
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'admin@gmail.com', 'Admin', '085157206615', 'Batam Centre', '1722492978_ea8f1452bc82faad9ceb.jpeg', 1, '2024-08-01 01:17:44');
INSERT INTO `user` VALUES (2, 'pelanggan', 'c4ca4238a0b923820dcc509a6f75849b', 'pelanggan@gmail.com', 'Pelanggan', '087216617', 'Nagoya', NULL, NULL, NULL);
INSERT INTO `user` VALUES (3, 'karyawan', 'c4ca4238a0b923820dcc509a6f75849b', 'karyawan@gmail.com', 'Karyawan', '0882768281', 'Bengkong', NULL, NULL, NULL);
INSERT INTO `user` VALUES (8, 'deren', 'c4ca4238a0b923820dcc509a6f75849b', 'deren@gmail.com', 'Pelanggan', '0812712', 'Nagoya', NULL, NULL, NULL);
INSERT INTO `user` VALUES (15, 'Sterling', 'c4ca4238a0b923820dcc509a6f75849b', 'sterling@gmail.com', 'Pelanggan', '08576288191', 'London', NULL, NULL, NULL);
INSERT INTO `user` VALUES (16, 'Ahmad', 'c4ca4238a0b923820dcc509a6f75849b', 'ahmad@gmail.com', 'Pelanggan', '0821997212', 'London', NULL, 16, '2024-08-05 21:29:05');
INSERT INTO `user` VALUES (17, 'Messi2', 'c4ca4238a0b923820dcc509a6f75849b', 'messi2@gmail.com', 'Pelanggan', '911', 'Amerika, Inter Miami Blok M', NULL, NULL, NULL);

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
