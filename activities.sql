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

 Date: 14/05/2023 09:22:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activities
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of activities
-- ----------------------------
INSERT INTO `activities` VALUES (2, 'Test', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores sint praesentium perspiciatis repellat corrupti obcaecati debitis illum, libero aut optio non officia commodi ullam unde delectus eveniet in animi quasi?', '2023-05-19', 1, '2023-05-13 15:26:23', '2023-05-13 15:48:10');

SET FOREIGN_KEY_CHECKS = 1;
