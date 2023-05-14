/*
 Navicat Premium Data Transfer

 Source Server         : general_services
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3309
 Source Schema         : tabular

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 14/05/2023 09:22:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for announcement
-- ----------------------------
DROP TABLE IF EXISTS `announcement`;
CREATE TABLE `announcement`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of announcement
-- ----------------------------
INSERT INTO `announcement` VALUES (3, 'Announement test', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores sint praesentium perspiciatis repellat corrupti obcaecati debitis illum, libero aut optio non officia commodi ullam unde delectus eveniet in animi quasi?', 1, '2023-05-13 15:41:35', '2023-05-13 15:48:03');

SET FOREIGN_KEY_CHECKS = 1;
