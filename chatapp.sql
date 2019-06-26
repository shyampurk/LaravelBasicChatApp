
--
-- Database: `chatapp`
--

CREATE DATABASE chatapp CHARACTER SET utf8 COLLATE utf8_bin;


--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uuid` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`uuid`(30))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

