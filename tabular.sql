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

 Date: 12/05/2023 13:25:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for criterias
-- ----------------------------
DROP TABLE IF EXISTS `criterias`;
CREATE TABLE `criterias`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_id` int UNSIGNED NOT NULL,
  `criteria` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `criterias_event_id_foreign`(`event_id` ASC) USING BTREE,
  CONSTRAINT `criterias_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of criterias
-- ----------------------------
INSERT INTO `criterias` VALUES (1, 1, 'walk', 25);
INSERT INTO `criterias` VALUES (2, 1, 'attitude', 25);
INSERT INTO `criterias` VALUES (3, 1, 'beauty', 50);
INSERT INTO `criterias` VALUES (4, 4, 'best in gown', 30);
INSERT INTO `criterias` VALUES (5, 4, 'best in talent', 30);
INSERT INTO `criterias` VALUES (6, 4, 'hhhadad', 30);
INSERT INTO `criterias` VALUES (7, 4, 'gf', 10);

-- ----------------------------
-- Table structure for events
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of events
-- ----------------------------
INSERT INTO `events` VALUES (1, 'Ms. Asscat 2023', '2023-04-28', 1, '2023-04-25 06:20:59', '2023-05-08 11:59:54');
INSERT INTO `events` VALUES (2, 'Inactive', '2023-04-20', 0, '2023-04-26 08:29:25', '2023-04-27 02:26:02');
INSERT INTO `events` VALUES (4, 'ms asscat', '2500-02-05', 1, '2023-05-08 11:59:22', '2023-05-08 11:59:22');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (2, '2023_02_14_063101_create_roles_table', 1);
INSERT INTO `migrations` VALUES (3, '2023_02_14_072130_create_events_table', 1);
INSERT INTO `migrations` VALUES (4, '2023_02_14_072920_create_participants_table', 1);
INSERT INTO `migrations` VALUES (5, '2023_02_14_073334_create_users_table', 2);
INSERT INTO `migrations` VALUES (6, '2023_02_14_074008_create_criterias_table', 2);
INSERT INTO `migrations` VALUES (7, '2023_02_14_074248_create_scores_table', 2);
INSERT INTO `migrations` VALUES (8, '2023_02_14_084906_add_foreign_key_event', 2);
INSERT INTO `migrations` VALUES (9, '2023_03_03_135136_create_super_users_table', 2);
INSERT INTO `migrations` VALUES (10, '2023_04_22_105413_alter_table_participants', 2);
INSERT INTO `migrations` VALUES (11, '2023_05_11_023606_add_table_sub_events', 3);
INSERT INTO `migrations` VALUES (12, '2023_05_11_023734_add_table_sub_event_criteria', 3);
INSERT INTO `migrations` VALUES (13, '2023_05_11_083105_add_table_sub_event_score', 4);

-- ----------------------------
-- Table structure for participants
-- ----------------------------
DROP TABLE IF EXISTS `participants`;
CREATE TABLE `participants`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `screen_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `full_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `number` tinyint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `event_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `participants_event_id_foreign`(`event_id` ASC) USING BTREE,
  CONSTRAINT `participants_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of participants
-- ----------------------------
INSERT INTO `participants` VALUES (1, 'p1', 'Participant 1', 'Female', 1, NULL, NULL, 1);
INSERT INTO `participants` VALUES (2, 'p2', 'Participant2', 'Male', 2, NULL, NULL, 1);
INSERT INTO `participants` VALUES (3, 'p3', 'Participant3', 'Male', 3, NULL, NULL, 1);
INSERT INTO `participants` VALUES (4, 'hy', 'honey lee', 'Female', 1, NULL, NULL, 4);
INSERT INTO `participants` VALUES (5, 'kk', 'kkoko jjjjj', 'Female', 2, NULL, NULL, 4);
INSERT INTO `participants` VALUES (6, 'll', 'jih', 'Female', 3, NULL, NULL, 4);

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Admin');
INSERT INTO `roles` VALUES (2, 'Emcee');
INSERT INTO `roles` VALUES (3, 'Judge');

-- ----------------------------
-- Table structure for scores
-- ----------------------------
DROP TABLE IF EXISTS `scores`;
CREATE TABLE `scores`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `participant_id` int UNSIGNED NOT NULL,
  `criteria_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL COMMENT 'given by judges',
  `event_id` int UNSIGNED NOT NULL,
  `score` decimal(8, 2) NOT NULL COMMENT 'raw score',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `scores_participant_id_foreign`(`participant_id` ASC) USING BTREE,
  INDEX `scores_criteria_id_foreign`(`criteria_id` ASC) USING BTREE,
  INDEX `scores_user_id_foreign`(`user_id` ASC) USING BTREE,
  INDEX `scores_event_id_foreign`(`event_id` ASC) USING BTREE,
  CONSTRAINT `scores_criteria_id_foreign` FOREIGN KEY (`criteria_id`) REFERENCES `criterias` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `scores_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `scores_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `scores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 56 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of scores
-- ----------------------------
INSERT INTO `scores` VALUES (1, 1, 1, 2, 1, 10.00, NULL, NULL);
INSERT INTO `scores` VALUES (2, 1, 2, 2, 1, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (3, 1, 3, 2, 1, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (4, 2, 1, 2, 1, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (5, 2, 2, 2, 1, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (6, 2, 3, 2, 1, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (7, 3, 1, 2, 1, 80.00, NULL, NULL);
INSERT INTO `scores` VALUES (8, 3, 2, 2, 1, 80.00, NULL, NULL);
INSERT INTO `scores` VALUES (9, 3, 3, 2, 1, 80.00, NULL, NULL);
INSERT INTO `scores` VALUES (10, 1, 1, 3, 1, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (11, 1, 2, 3, 1, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (12, 1, 3, 3, 1, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (13, 2, 1, 3, 1, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (14, 2, 2, 3, 1, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (15, 2, 3, 3, 1, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (16, 3, 1, 3, 1, 70.00, NULL, NULL);
INSERT INTO `scores` VALUES (17, 3, 2, 3, 1, 70.00, NULL, NULL);
INSERT INTO `scores` VALUES (18, 3, 3, 3, 1, 70.00, NULL, NULL);
INSERT INTO `scores` VALUES (19, 4, 4, 4, 4, 80.00, NULL, NULL);
INSERT INTO `scores` VALUES (20, 4, 5, 4, 4, 99.00, NULL, NULL);
INSERT INTO `scores` VALUES (21, 4, 6, 4, 4, 85.00, NULL, NULL);
INSERT INTO `scores` VALUES (22, 4, 7, 4, 4, 95.00, NULL, NULL);
INSERT INTO `scores` VALUES (23, 5, 4, 4, 4, 95.00, NULL, NULL);
INSERT INTO `scores` VALUES (24, 5, 5, 4, 4, 88.00, NULL, NULL);
INSERT INTO `scores` VALUES (25, 5, 6, 4, 4, 99.00, NULL, NULL);
INSERT INTO `scores` VALUES (26, 5, 7, 4, 4, 84.00, NULL, NULL);
INSERT INTO `scores` VALUES (27, 6, 7, 4, 4, 94.00, NULL, NULL);
INSERT INTO `scores` VALUES (28, 6, 6, 4, 4, 85.00, NULL, NULL);
INSERT INTO `scores` VALUES (29, 6, 5, 4, 4, 88.00, NULL, NULL);
INSERT INTO `scores` VALUES (30, 6, 4, 4, 4, 99.00, NULL, NULL);
INSERT INTO `scores` VALUES (31, 4, 7, 5, 4, 84.00, NULL, NULL);
INSERT INTO `scores` VALUES (32, 4, 6, 5, 4, 90.00, NULL, NULL);
INSERT INTO `scores` VALUES (34, 4, 4, 5, 4, 88.00, NULL, NULL);
INSERT INTO `scores` VALUES (35, 5, 7, 5, 4, 88.00, NULL, NULL);
INSERT INTO `scores` VALUES (36, 5, 6, 5, 4, 95.00, NULL, NULL);
INSERT INTO `scores` VALUES (37, 5, 5, 5, 4, 80.00, NULL, NULL);
INSERT INTO `scores` VALUES (38, 5, 4, 5, 4, 95.00, NULL, NULL);
INSERT INTO `scores` VALUES (39, 6, 7, 5, 4, 80.00, NULL, NULL);
INSERT INTO `scores` VALUES (40, 6, 6, 5, 4, 88.50, NULL, NULL);
INSERT INTO `scores` VALUES (41, 6, 5, 5, 4, 88.00, NULL, NULL);
INSERT INTO `scores` VALUES (42, 6, 4, 5, 4, 99.00, NULL, NULL);
INSERT INTO `scores` VALUES (43, 4, 7, 6, 4, 90.00, NULL, NULL);
INSERT INTO `scores` VALUES (44, 4, 6, 6, 4, 80.00, NULL, NULL);
INSERT INTO `scores` VALUES (45, 4, 5, 6, 4, 58.00, NULL, NULL);
INSERT INTO `scores` VALUES (46, 4, 4, 6, 4, 88.50, NULL, NULL);
INSERT INTO `scores` VALUES (47, 5, 4, 6, 4, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (48, 5, 5, 6, 4, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (49, 5, 6, 6, 4, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (50, 5, 7, 6, 4, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (51, 6, 7, 6, 4, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (52, 6, 6, 6, 4, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (53, 6, 5, 6, 4, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (54, 6, 4, 6, 4, 100.00, NULL, NULL);
INSERT INTO `scores` VALUES (55, 4, 5, 5, 4, 90.00, NULL, NULL);

-- ----------------------------
-- Table structure for sub_event_criterias
-- ----------------------------
DROP TABLE IF EXISTS `sub_event_criterias`;
CREATE TABLE `sub_event_criterias`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_id` int UNSIGNED NOT NULL,
  `sub_event_id` int UNSIGNED NOT NULL,
  `criteria` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sub_event_criterias_event_id_foreign`(`event_id` ASC) USING BTREE,
  INDEX `sub_event_criterias_sub_event_id_foreign`(`sub_event_id` ASC) USING BTREE,
  CONSTRAINT `sub_event_criterias_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sub_event_criterias_sub_event_id_foreign` FOREIGN KEY (`sub_event_id`) REFERENCES `sub_events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_event_criterias
-- ----------------------------
INSERT INTO `sub_event_criterias` VALUES (1, 1, 1, 'Consider the Over All Performance', 30);
INSERT INTO `sub_event_criterias` VALUES (2, 1, 1, 'Pay attention to Audience Engagement', 10);
INSERT INTO `sub_event_criterias` VALUES (3, 1, 1, 'Evaluate the Stage Apperance', 20);
INSERT INTO `sub_event_criterias` VALUES (4, 1, 1, 'Look of Originality', 20);
INSERT INTO `sub_event_criterias` VALUES (5, 1, 1, 'Check for personality', 20);
INSERT INTO `sub_event_criterias` VALUES (6, 1, 2, 'Poise', 20);
INSERT INTO `sub_event_criterias` VALUES (7, 1, 2, 'Grace/Elegance', 20);
INSERT INTO `sub_event_criterias` VALUES (8, 1, 2, 'Eye Contact', 20);
INSERT INTO `sub_event_criterias` VALUES (9, 1, 2, 'Confidence', 10);
INSERT INTO `sub_event_criterias` VALUES (10, 1, 2, 'Overall Presentation', 30);
INSERT INTO `sub_event_criterias` VALUES (11, 1, 3, 'Neatness', 10);
INSERT INTO `sub_event_criterias` VALUES (12, 1, 3, 'Joolyness', 20);
INSERT INTO `sub_event_criterias` VALUES (13, 1, 3, 'Secretness', 20);
INSERT INTO `sub_event_criterias` VALUES (14, 1, 3, 'Fragrance', 50);
INSERT INTO `sub_event_criterias` VALUES (15, 1, 4, 'Hyper', 50);
INSERT INTO `sub_event_criterias` VALUES (16, 1, 4, 'Audience Influence', 50);

-- ----------------------------
-- Table structure for sub_event_scores
-- ----------------------------
DROP TABLE IF EXISTS `sub_event_scores`;
CREATE TABLE `sub_event_scores`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_id` int UNSIGNED NOT NULL,
  `sub_event_id` int UNSIGNED NOT NULL,
  `participant_id` int UNSIGNED NOT NULL,
  `sub_criteria_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL COMMENT 'given by judges',
  `score` decimal(8, 2) NOT NULL COMMENT 'raw score 1-100',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sub_event_scores_participant_id_foreign`(`participant_id` ASC) USING BTREE,
  INDEX `sub_event_scores_sub_criteria_id_foreign`(`sub_criteria_id` ASC) USING BTREE,
  INDEX `sub_event_scores_user_id_foreign`(`user_id` ASC) USING BTREE,
  INDEX `sub_event_scores_event_id_foreign`(`event_id` ASC) USING BTREE,
  INDEX `sub_event_scores_sub_event_id_foreign`(`sub_event_id` ASC) USING BTREE,
  CONSTRAINT `sub_event_scores_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `sub_event_scores_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `sub_event_scores_sub_criteria_id_foreign` FOREIGN KEY (`sub_criteria_id`) REFERENCES `sub_event_criterias` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `sub_event_scores_sub_event_id_foreign` FOREIGN KEY (`sub_event_id`) REFERENCES `sub_events` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `sub_event_scores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 97 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_event_scores
-- ----------------------------
INSERT INTO `sub_event_scores` VALUES (1, 1, 1, 1, 1, 2, 10.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (2, 1, 1, 1, 5, 2, 10.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (3, 1, 1, 1, 2, 2, 10.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (4, 1, 1, 1, 3, 2, 20.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (5, 1, 1, 1, 4, 2, 10.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (6, 1, 3, 3, 11, 2, 10.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (7, 1, 2, 1, 6, 2, 10.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (8, 1, 1, 2, 1, 2, 30.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (9, 1, 1, 2, 2, 2, 80.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (10, 1, 1, 2, 3, 2, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (11, 1, 1, 2, 4, 2, 75.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (12, 1, 1, 2, 5, 2, 100.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (13, 1, 1, 3, 1, 2, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (14, 1, 1, 3, 2, 2, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (15, 1, 1, 3, 3, 2, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (16, 1, 1, 3, 4, 2, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (17, 1, 1, 3, 5, 2, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (18, 1, 2, 1, 7, 2, 100.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (19, 1, 2, 1, 8, 2, 100.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (20, 1, 2, 1, 9, 2, 99.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (21, 1, 2, 1, 10, 2, 98.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (22, 1, 2, 2, 10, 2, 98.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (23, 1, 2, 2, 9, 2, 98.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (24, 1, 2, 2, 8, 2, 98.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (25, 1, 2, 2, 7, 2, 98.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (26, 1, 2, 2, 6, 2, 98.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (27, 1, 2, 3, 10, 2, 94.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (28, 1, 2, 3, 9, 2, 94.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (29, 1, 2, 3, 8, 2, 94.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (30, 1, 2, 3, 7, 2, 94.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (31, 1, 2, 3, 6, 2, 94.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (32, 1, 3, 1, 11, 2, 60.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (33, 1, 3, 1, 14, 2, 60.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (34, 1, 3, 1, 13, 2, 60.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (35, 1, 3, 1, 12, 2, 60.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (36, 1, 3, 2, 14, 2, 75.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (37, 1, 3, 2, 13, 2, 75.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (38, 1, 3, 2, 12, 2, 75.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (39, 1, 3, 2, 11, 2, 60.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (40, 1, 3, 3, 12, 2, 100.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (41, 1, 3, 3, 14, 2, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (42, 1, 3, 3, 13, 2, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (43, 1, 4, 1, 16, 2, 80.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (44, 1, 4, 1, 15, 2, 80.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (45, 1, 4, 2, 16, 2, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (46, 1, 4, 2, 15, 2, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (47, 1, 4, 3, 16, 2, 100.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (48, 1, 4, 3, 15, 2, 100.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (49, 1, 1, 1, 5, 3, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (50, 1, 1, 1, 4, 3, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (51, 1, 1, 1, 3, 3, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (52, 1, 1, 1, 2, 3, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (53, 1, 1, 1, 1, 3, 90.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (54, 1, 1, 2, 5, 3, 98.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (55, 1, 1, 2, 4, 3, 98.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (56, 1, 1, 2, 3, 3, 98.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (57, 1, 1, 2, 2, 3, 98.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (58, 1, 1, 2, 1, 3, 98.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (59, 1, 1, 3, 5, 3, 99.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (60, 1, 1, 3, 4, 3, 99.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (61, 1, 1, 3, 3, 3, 99.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (62, 1, 1, 3, 2, 3, 99.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (63, 1, 1, 3, 1, 3, 99.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (64, 1, 2, 1, 10, 3, 50.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (65, 1, 2, 1, 9, 3, 50.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (66, 1, 2, 1, 8, 3, 50.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (67, 1, 2, 1, 7, 3, 50.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (68, 1, 2, 1, 6, 3, 50.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (69, 1, 2, 3, 8, 3, 60.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (70, 1, 2, 3, 7, 3, 60.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (71, 1, 2, 3, 6, 3, 60.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (72, 1, 2, 3, 9, 3, 60.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (73, 1, 2, 3, 10, 3, 70.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (74, 1, 2, 2, 10, 3, 88.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (75, 1, 2, 2, 9, 3, 88.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (76, 1, 2, 2, 8, 3, 88.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (77, 1, 2, 2, 7, 3, 88.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (78, 1, 2, 2, 6, 3, 88.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (79, 1, 3, 1, 14, 3, 79.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (80, 1, 3, 1, 13, 3, 79.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (81, 1, 3, 1, 12, 3, 79.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (82, 1, 3, 1, 11, 3, 79.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (83, 1, 3, 2, 14, 3, 77.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (84, 1, 3, 2, 13, 3, 77.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (85, 1, 3, 2, 12, 3, 77.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (86, 1, 3, 2, 11, 3, 77.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (87, 1, 3, 3, 14, 3, 86.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (88, 1, 3, 3, 13, 3, 86.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (89, 1, 3, 3, 12, 3, 86.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (90, 1, 3, 3, 11, 3, 86.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (91, 1, 4, 1, 15, 3, 99.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (92, 1, 4, 1, 16, 3, 99.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (93, 1, 4, 2, 15, 3, 70.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (94, 1, 4, 2, 16, 3, 70.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (95, 1, 4, 3, 16, 3, 40.00, NULL, NULL);
INSERT INTO `sub_event_scores` VALUES (96, 1, 4, 3, 15, 3, 40.00, NULL, NULL);

-- ----------------------------
-- Table structure for sub_events
-- ----------------------------
DROP TABLE IF EXISTS `sub_events`;
CREATE TABLE `sub_events`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_id` int UNSIGNED NOT NULL,
  `sub_event_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sub_events_event_id_foreign`(`event_id` ASC) USING BTREE,
  CONSTRAINT `sub_events_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_events
-- ----------------------------
INSERT INTO `sub_events` VALUES (1, 1, 'Talent', 30, '2023-05-11 03:30:30', '2023-05-11 03:30:30');
INSERT INTO `sub_events` VALUES (2, 1, 'Evening Gown', 20, '2023-05-11 03:42:50', '2023-05-11 03:42:50');
INSERT INTO `sub_events` VALUES (3, 1, 'School Uniform', 10, '2023-05-11 05:23:29', '2023-05-11 05:23:29');
INSERT INTO `sub_events` VALUES (4, 1, 'Active', 50, '2023-05-11 11:05:53', '2023-05-11 11:05:53');

-- ----------------------------
-- Table structure for super_users
-- ----------------------------
DROP TABLE IF EXISTS `super_users`;
CREATE TABLE `super_users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `super_users_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `super_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of super_users
-- ----------------------------
INSERT INTO `super_users` VALUES (1, 'Admin Account', 'admin', 1);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `password` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  `full_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `screen_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `users_event_id_foreign`(`event_id` ASC) USING BTREE,
  INDEX `users_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `users_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'emcee', 1, 2, 'Emceee Name', 'Emcee', '2023-04-25 06:24:13', '2023-04-25 06:24:13');
INSERT INTO `users` VALUES (2, 'judge1', 1, 3, 'Judge1 Name', 'judge1', '2023-04-25 06:24:38', '2023-04-25 06:24:38');
INSERT INTO `users` VALUES (3, 'judge2', 1, 3, 'Judge2 Name', 'judge2', '2023-04-25 06:24:57', '2023-04-25 06:24:57');
INSERT INTO `users` VALUES (4, 'j1', 4, 3, 'judge1', 'j1', '2023-05-08 12:04:31', '2023-05-08 12:04:31');
INSERT INTO `users` VALUES (5, 'j2', 4, 3, 'judge2', 'j2', '2023-05-08 12:04:52', '2023-05-08 12:04:52');
INSERT INTO `users` VALUES (6, 'j3', 4, 3, 'judge3', 'j3', '2023-05-08 12:05:23', '2023-05-08 12:05:23');

SET FOREIGN_KEY_CHECKS = 1;
