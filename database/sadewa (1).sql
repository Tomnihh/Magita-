-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2026 at 12:53 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sadewa`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_trails`
--

CREATE TABLE `audit_trails` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `aksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint UNSIGNED DEFAULT NULL,
  `data_lama` json DEFAULT NULL,
  `data_baru` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_trails`
--

INSERT INTO `audit_trails` (`id`, `user_id`, `aksi`, `model_type`, `model_id`, `data_lama`, `data_baru`, `ip_address`, `user_agent`, `keterangan`, `created_at`) VALUES
(1, 2, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Login berhasil.', '2026-10-21 22:21:08'),
(2, 2, 'LOGOUT', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Logout berhasil.', '2026-10-21 22:21:34'),
(3, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Login berhasil.', '2026-10-21 22:27:37'),
(4, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Login berhasil.', '2026-10-21 23:43:51'),
(5, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Login berhasil.', '2026-10-22 00:14:27'),
(6, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Login berhasil.', '2026-10-22 22:15:34'),
(7, 1, 'LOGOUT', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Logout berhasil.', '2026-10-22 22:30:14'),
(8, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Login berhasil.', '2026-10-22 22:30:40'),
(9, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Login berhasil.', '2026-10-22 22:34:58'),
(10, 1, 'LOGOUT', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Logout berhasil.', '2026-10-22 22:35:14'),
(11, 2, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Login berhasil.', '2026-10-22 22:35:32'),
(12, 2, 'LOGOUT', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Logout berhasil.', '2026-10-22 22:35:50'),
(13, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Login berhasil.', '2026-10-22 22:38:42'),
(14, 1, 'LOGOUT', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Logout berhasil.', '2026-10-22 23:09:22'),
(15, 2, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Login berhasil.', '2026-10-22 23:09:36'),
(16, 2, 'LOGOUT', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Logout berhasil.', '2026-10-22 23:27:14'),
(17, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Login berhasil.', '2026-10-22 23:27:34'),
(18, 1, 'LOGOUT', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'Logout berhasil.', '2026-10-22 23:28:13'),
(19, 2, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Login berhasil.', '2026-10-26 09:27:14'),
(20, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Login berhasil.', '2026-10-27 07:28:53'),
(21, 1, 'LOGOUT', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Logout berhasil.', '2026-10-27 07:30:12'),
(22, 2, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Login berhasil.', '2026-10-27 07:30:20'),
(23, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Login berhasil.', '2026-10-28 09:04:58'),
(24, 1, 'LOGOUT', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Logout berhasil.', '2026-10-28 09:34:49'),
(25, 2, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Login berhasil.', '2026-10-28 09:37:08'),
(26, 2, 'LOGOUT', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Logout berhasil.', '2026-10-28 09:38:02'),
(27, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Login berhasil.', '2026-10-28 09:38:06'),
(28, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Login berhasil.', '2026-10-30 00:34:04'),
(29, 1, 'LOGOUT', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Logout berhasil.', '2026-10-30 00:34:41'),
(30, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Login berhasil.', '2026-11-01 20:19:59'),
(31, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Login berhasil.', '2026-11-02 00:07:31'),
(32, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Login berhasil.', '2026-11-03 21:26:25'),
(33, 1, 'LOGOUT', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Logout berhasil.', '2026-11-03 21:26:36'),
(34, 2, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Login berhasil.', '2026-11-03 21:26:53'),
(35, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Login berhasil.', '2026-11-04 04:19:45'),
(36, 1, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Login berhasil.', '2026-11-04 08:53:14'),
(37, 1, 'LOGOUT', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Logout berhasil.', '2026-11-04 08:53:26'),
(38, 2, 'LOGIN_BERHASIL', NULL, NULL, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'Login berhasil.', '2026-11-04 08:53:37');

-- --------------------------------------------------------

--
-- Table structure for table `bukti_pelaporans`
--

CREATE TABLE `bukti_pelaporans` (
  `id` bigint UNSIGNED NOT NULL,
  `pelaporan_id` bigint UNSIGNED NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` bigint UNSIGNED DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `urutan` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kewenangan_desas`
--

CREATE TABLE `kewenangan_desas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `desa_id` bigint UNSIGNED NOT NULL,
  `level_akses` enum('BACA','TULIS','PENUH') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BACA',
  `berlaku_mulai` timestamp NULL DEFAULT NULL,
  `berlaku_sampai` timestamp NULL DEFAULT NULL,
  `assigned_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_desas`
--

CREATE TABLE `master_desas` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_desa` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `status_risiko` enum('HIJAU','KUNING','MERAH') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'HIJAU',
  `pagu_anggaran` decimal(15,2) NOT NULL DEFAULT '0.00',
  `realisasi_anggaran` decimal(15,2) NOT NULL DEFAULT '0.00',
  `tahun_anggaran` year NOT NULL DEFAULT '2026',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_desas`
--

INSERT INTO `master_desas` (`id`, `kode_desa`, `nama_desa`, `kecamatan`, `latitude`, `longitude`, `status_risiko`, `pagu_anggaran`, `realisasi_anggaran`, `tahun_anggaran`, `keterangan`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Kalimango', 'Alas', '-8.5494864', '116.9994489', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(2, NULL, 'Baru', 'Alas', '-8.5353925', '116.9907862', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(3, NULL, 'Dalam', 'Alas', '-8.5298024', '117.0274929', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(4, NULL, 'Juranalas', 'Alas', '-8.5984324', '117.0188279', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(5, NULL, 'Luar', 'Alas', '-8.5161700', '117.0090485', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(6, NULL, 'Marente', 'Alas', '-8.6550000', '116.9800000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(7, NULL, 'Pulau Bungin', 'Alas', '-8.4769963', '116.9947681', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(8, NULL, 'Mapin Rea', 'Alas', '-8.5574037', '116.9486884', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(9, NULL, 'Gontar', 'Alas Barat', '-8.5006975', '116.9761088', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(10, NULL, 'Gontar Baru', 'Alas Barat', '-8.5197921', '116.9845389', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(11, NULL, 'Mapin Baru', 'Alas Barat', '-8.6600000', '116.8800000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(12, NULL, 'Mapin Beru', 'Alas Barat', '-8.6550000', '116.8750000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(13, NULL, 'Mapin Kebak', 'Alas Barat', '-8.5484510', '116.9433551', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(14, NULL, 'Mapin Loka', 'Alas Barat', '-8.6720000', '116.8620000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(15, NULL, 'Labuhan Mapin', 'Alas Barat', '-8.6450000', '116.8650000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(16, NULL, 'Usar Mapin', 'Alas Barat', '-8.6780000', '116.8950000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(17, NULL, 'Bao Desa', 'Batu Lanteh', '-8.6353633', '117.1521939', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(18, NULL, 'Batudulang', 'Batu Lanteh', '-8.6101766', '117.2715351', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(19, NULL, 'Baturotok', 'Batu Lanteh', '-8.6774255', '117.1453519', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(20, NULL, 'Kelungkung', 'Batu Lanteh', '-8.5740625', '117.3223488', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(21, NULL, 'Tangkan Pulit', 'Batu Lanteh', '-8.6785431', '117.2148894', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(22, NULL, 'Tepal', 'Batu Lanteh', '-8.6387830', '117.2185050', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(23, NULL, 'Kalabeso', 'Buer', '-8.4636066', '117.0899934', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(24, NULL, 'Jurumapin', 'Buer', '-8.3700000', '117.2550000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(25, NULL, 'Labuhan Burung', 'Buer', '-8.4524665', '117.0634029', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(26, NULL, 'Buin Baru', 'Buer', '-8.4756162', '117.0742942', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(27, NULL, 'Pulau Kaung', 'Buer', '-8.5248657', '117.0588599', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(28, NULL, 'Tarusa', 'Buer', '-8.4892383', '117.0415019', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(29, NULL, 'Empang Atas', 'Empang', '-8.7662343', '118.0065182', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(30, NULL, 'Empang Bawah', 'Empang', '-8.7681909', '118.0037007', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(31, NULL, 'Jotang', 'Empang', '-8.7703610', '118.0083016', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(32, NULL, 'Jotang Beru', 'Empang', '-8.7729468', '118.0106433', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(33, NULL, 'Lamusung', 'Empang', '-8.6577000', '116.8430000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(34, NULL, 'Ongko', 'Empang', '-8.7425655', '118.0466021', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(35, NULL, 'Pamanto', 'Empang', '-8.7700727', '118.0028060', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(36, NULL, 'Gapit', 'Empang', '-8.7691090', '117.9415692', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(37, NULL, 'Pedanka', 'Empang', '-8.8350000', '117.6400000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(38, NULL, 'Bunga Eja', 'Empang', '-8.7589720', '117.9980266', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(39, NULL, 'Labangka', 'Labangka', '-8.9002180', '117.7417911', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(40, NULL, 'Labangka 1', 'Labangka', '-8.9002180', '117.7417911', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(41, NULL, 'Labangka 2', 'Labangka', '-8.9002180', '117.7417911', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(42, NULL, 'Labangka 3', 'Labangka', '-8.9002180', '117.7417911', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(43, NULL, 'Labangka 4', 'Labangka', '-8.9002180', '117.7417911', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(44, NULL, 'Karang Dima', 'Labuhan Badas', '-8.5121849', '117.3648725', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(45, NULL, 'Labuhan Sumbawa', 'Labuhan Badas', '-8.4618813', '117.3704805', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(46, NULL, 'Bajak', 'Labuhan Badas', '-8.5150000', '117.4650000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(47, NULL, 'Badas', 'Labuhan Badas', '-8.4618813', '117.3704805', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(48, NULL, 'Labuhan Aji', 'Labuhan Badas', '-8.5100000', '117.4600000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(49, NULL, 'Sebotok', 'Labuhan Badas', '-8.1711257', '117.5811625', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(50, NULL, 'Bugis Medang', 'Labuhan Badas', '-8.1455687', '117.3815972', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(51, NULL, 'Lantung', 'Lantung', '-8.7739611', '117.5185543', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(52, NULL, 'Lantung Ai Mual', 'Lantung', '-8.7500000', '117.3200000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(53, NULL, 'Sepukur', 'Lantung', '-8.9858849', '117.4122439', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(54, NULL, 'Padang Seloka', 'Lantung', '-8.7600000', '117.3300000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(55, NULL, 'Lape', 'Lape', '-8.6425933', '117.6291975', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(56, NULL, 'Dete', 'Lape', '-8.6120234', '117.5975850', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(57, NULL, 'Labuhan Kuris', 'Lape', '-8.5200000', '117.6600000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(58, NULL, 'Ngali', 'Lape', '-8.5213808', '117.7219434', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(59, NULL, 'Lenangguar', 'Lenangguar', '-8.7332326', '117.4121063', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(60, NULL, 'Tatebal', 'Lenangguar', '-8.8451761', '117.3826342', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(61, NULL, 'Ledang', 'Lenangguar', '-8.7230477', '117.3219061', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(62, NULL, 'Telaga', 'Lenangguar', '-8.5176958', '116.9949197', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(63, NULL, 'Lopok', 'Lopok', '-8.5690826', '117.5579477', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(64, NULL, 'Lopok Beru', 'Lopok', '-8.6200000', '117.5800000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(65, NULL, 'Langam', 'Lopok', '-8.6025498', '117.5656330', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(66, NULL, 'Mama', 'Lopok', '-8.7022982', '117.5958289', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(67, NULL, 'Pungkit', 'Lopok', '-8.4227712', '117.5529979', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(68, NULL, 'Berora', 'Lopok', '-8.6437031', '117.5806760', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(69, NULL, 'Tatede', 'Lopok', '-8.5700000', '117.5300000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(70, NULL, 'Lunyuk Rea', 'Lunyuk', '-8.8711927', '117.2585454', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(71, NULL, 'Lunyuk Ode', 'Lunyuk', '-8.9240756', '117.3124108', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(72, NULL, 'Perung', 'Lunyuk', '-9.0002717', '117.2836991', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(73, NULL, 'Padas', 'Lunyuk', '-9.0800000', '117.3800000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(74, NULL, 'Jamu', 'Lunyuk', '-8.8756800', '117.1451017', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(75, NULL, 'Sukamaju', 'Lunyuk', '-8.9792356', '117.2094714', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(76, NULL, 'Emang Lestari', 'Lunyuk', '-9.0367639', '117.0942199', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(77, NULL, 'Maronge', 'Maronge', '-8.7943284', '117.6636657', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(78, NULL, 'Labuhan Sangoro', 'Maronge', '-8.7100000', '117.7100000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(79, NULL, 'Pemasar', 'Maronge', '-8.7756782', '117.6114671', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(80, NULL, 'Simu', 'Maronge', '-8.7640493', '117.6454032', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(81, NULL, 'Kakiang', 'Moyo Hilir', '-8.4300938', '117.6528239', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(82, NULL, 'Moyo', 'Moyo Hilir', '-8.5307449', '117.4996646', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(83, NULL, 'Berare', 'Moyo Hilir', '-8.4909970', '117.5298360', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(84, NULL, 'Batu Tering', 'Moyo Hilir', '-8.5450000', '117.5050000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(85, NULL, 'Ngeru', 'Moyo Hilir', '-8.4931019', '117.5514652', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(86, NULL, 'Olat Marang', 'Moyo Hilir', '-8.5950000', '117.5550000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(87, NULL, 'Poto', 'Moyo Hilir', '-8.4882122', '117.4967288', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(88, NULL, 'Serading', 'Moyo Hilir', '-8.5687992', '117.5062311', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(89, NULL, 'Serading Baru', 'Moyo Hilir', '-8.6150000', '117.5750000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(90, NULL, 'Labuhan Ijuk', 'Moyo Hilir', '-8.5150000', '117.4750000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(91, NULL, 'Marga Karya', 'Moyo Hulu', '-8.6203439', '117.3669507', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(92, NULL, 'Mokong', 'Moyo Hulu', '-8.5887320', '117.4653962', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(93, NULL, 'Lito', 'Moyo Hulu', '-8.6901862', '117.5105300', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(94, NULL, 'Leseng', 'Moyo Hulu', '-8.6299191', '117.4210458', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(95, NULL, 'Sebasang', 'Moyo Hulu', '-8.6481852', '117.4551754', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(96, NULL, 'Semamung', 'Moyo Hulu', '-8.6647959', '117.4103838', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(97, NULL, 'Berang Rea', 'Moyo Hulu', '-8.6300000', '117.4100000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(98, NULL, 'Pernek', 'Moyo Hulu', '-8.5975427', '117.4208250', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(99, NULL, 'Batu Bulan', 'Moyo Hulu', '-8.6233530', '117.4629595', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(100, NULL, 'Sempe', 'Moyo Hulu', '-8.6583050', '117.3398548', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(101, NULL, 'Brang Belo', 'Moyo Hulu', '-8.6900000', '117.4700000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(102, NULL, 'Liang', 'Moyo Hulu', '-8.4904119', '117.6623940', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(103, NULL, 'Baru Tahan', 'Moyo Utara', '-8.4465689', '117.4846832', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(104, NULL, 'Kukin', 'Moyo Utara', '-8.4322212', '117.5238529', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(105, NULL, 'Pungkit', 'Moyo Utara', '-8.4227712', '117.5529979', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(106, NULL, 'Sebewe', 'Moyo Utara', '-8.4662420', '117.4936395', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(107, NULL, 'Songkar', 'Moyo Utara', '-8.4537955', '117.5405236', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(108, NULL, 'Penyaring', 'Moyo Utara', '-8.4245993', '117.4792436', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(109, NULL, 'Kelawis', 'Orong Telu', '-8.7198480', '117.1955643', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(110, NULL, 'Sebeok', 'Orong Telu', '-8.7669790', '117.1822938', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(111, NULL, 'Senawang', 'Orong Telu', '-8.7726694', '117.2470813', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(112, NULL, 'Muchir', 'Orong Telu', '-8.7800000', '117.1700000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(113, NULL, 'Plampang', 'Plampang', '-8.7890209', '117.7367650', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(114, NULL, 'Sepakat', 'Plampang', '-8.8372373', '117.7284985', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(115, NULL, 'Selante', 'Plampang', '-8.8143519', '117.7673922', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(116, NULL, 'Usar', 'Plampang', '-8.8088555', '117.8175530', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(117, NULL, 'Brang Kolong', 'Plampang', '-8.7075659', '117.7333489', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(118, NULL, 'Muer', 'Plampang', '-8.7492454', '117.7142607', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(119, NULL, 'SP I Plampang', 'Plampang', '-8.3100000', '117.7900000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(120, NULL, 'SP II Plampang', 'Plampang', '-8.3200000', '117.8000000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(121, NULL, 'SP III Plampang', 'Plampang', '-8.2400000', '117.7200000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(122, NULL, 'Teluk Santong', 'Plampang', '-8.7229795', '117.8867131', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(123, NULL, 'Marga Mulya', 'Plampang', '-8.2500000', '117.7300000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(124, NULL, 'Rhee', 'Rhee', '-8.4422118', '117.2392551', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(125, NULL, 'Rhee Baru', 'Rhee', '-8.7200000', '117.2600000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(126, NULL, 'Luk', 'Rhee', '-8.4995587', '117.2789981', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(127, NULL, 'Sampe', 'Rhee', '-8.5617635', '117.2112296', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(128, NULL, 'Ropang', 'Ropang', '-8.5280560', '117.2802780', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(129, NULL, 'Lawin', 'Ropang', '-8.9544420', '117.5374126', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(130, NULL, 'Lebangkar', 'Ropang', '-8.8724296', '117.6807972', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(131, NULL, 'Ranan', 'Ropang', '-8.8844439', '117.5005270', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(132, NULL, 'Labuhan Bontong', 'Tarano', '-8.8900000', '117.8300000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(133, NULL, 'Bantulanteh', 'Tarano', '-8.7491450', '118.0218890', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(134, NULL, 'Labuhan Jontal', 'Tarano', '-8.9100000', '117.8500000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(135, NULL, 'Labuhan Kanar', 'Tarano', '-8.9200000', '117.8600000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(136, NULL, 'Mata', 'Tarano', '-8.7522246', '118.1988036', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(137, NULL, 'Labuhan Bajo', 'Tarano', '-8.9300000', '117.8700000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(138, NULL, 'Kerato', 'Unter Iwes', '-8.5045868', '117.4057505', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(139, NULL, 'Kerekeh', 'Unter Iwes', '-8.5617507', '117.4269945', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(140, NULL, 'Boak', 'Unter Iwes', '-8.5539239', '117.4556149', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(141, NULL, 'Nijang', 'Unter Iwes', '-8.4978034', '117.4054168', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(142, NULL, 'Pelat', 'Unter Iwes', '-8.5475269', '117.3899342', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(143, NULL, 'Uma Beringin', 'Unter Iwes', '-8.5142225', '117.4152622', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(144, NULL, 'Pungka', 'Unter Iwes', '-8.5290566', '117.4193501', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(145, NULL, 'Jorok', 'Unter Iwes', '-8.5329541', '117.4383848', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(146, NULL, 'Dalam', 'Utan', '-8.5298024', '117.0274929', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(147, NULL, 'Jorok', 'Utan', '-8.5329541', '117.4383848', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(148, NULL, 'Motong', 'Utan', '-8.3867753', '117.1376635', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(149, NULL, 'Bale Brang', 'Utan', '-8.4081907', '117.1703233', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(150, NULL, 'Pukat', 'Utan', '-8.3976855', '117.1205912', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(151, NULL, 'Sabedo', 'Utan', '-8.4642376', '117.2023789', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(152, NULL, 'Stowe Brang', 'Utan', '-8.4517768', '117.1183030', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(153, NULL, 'Labuhan Bajo', 'Utan', '-8.5300000', '117.0300000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48'),
(154, NULL, 'Orong Ramas', 'Utan', '-8.5700000', '117.0700000', 'HIJAU', '0.00', '0.00', 2026, NULL, 1, '2026-10-21 22:18:48', '2026-10-21 22:18:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_01_01_000010_create_master_desas_table', 1),
(5, '2024_01_01_000020_create_kewenangan_desas_table', 1),
(6, '2024_01_01_000030_create_pelaporans_table', 1),
(7, '2024_01_01_000040_create_audit_trails_table', 1),
(8, '2024_01_01_000050_create_bukti_pelaporans_table', 1),
(9, '2026_10_26_174452_update_kategori_enum_in_pelaporans_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelaporans`
--

CREATE TABLE `pelaporans` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_laporan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desa_id` bigint UNSIGNED NOT NULL,
  `pelapor_id` bigint UNSIGNED DEFAULT NULL,
  `is_anonim` tinyint(1) NOT NULL DEFAULT '0',
  `nama_pelapor_terenkripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_wa_terenkripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_laporan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` enum('GRATIFIKASI','KORUPSI','PENYALAHGUNAAN','MARK_UP','LAINNYA') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'LAINNYA',
  `status` enum('BARU','DIPROSES','SELESAI','DITOLAK') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BARU',
  `tindak_lanjut` text COLLATE utf8mb4_unicode_ci,
  `kanal` enum('WHATSAPP','WEB','LANGSUNG') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'WEB',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9hKgUhh4tEsY5LBdYXD74c4kH8tDUaQDObtHhWPs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'eyJfdG9rZW4iOiJmS2hvVzVXRDFQU2gwQ2RFcXhkSG90QzNtb052TkFTUWxadXV4RlZxIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbWFnaXRhLnRlc3RcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9fQ==', 1793349282),
('b924CxvTVvwQpHQsIvzGHIPpnTIUiiviAl7oIkIW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'eyJfdG9rZW4iOiI3YXpXOFFSYjZ2T1E3VERmTU8wckhDbTBLeGxyeFUyckxyWXRwNjVyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21hZ2l0YS50ZXN0XC9hZG1pblwvZGFzaGJvYXJkIiwicm91dGUiOiJhZG1pbi5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF93ZWIiOiIxNmNmOTBiYzMzNzRiNGM4YzE5OTk4ZWQ0NzQyMTdjZDVjMTgyZjNiNGNlM2Q0NTY1YzI0Y2Q4MDUzM2I0ODE1In0=', 1793794787),
('c1jwgEP9wo4iT2FDfBm9cBpQdFFEZNiHnwvL2V1A', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'eyJfdG9rZW4iOiJJRDV6ZFFXeU1kcXJKaTV3c0ZXM29Rc2ZFU2tybk5jalhvMEVwOTlqIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbWFnaXRhLnRlc3RcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9fQ==', 1792740493),
('Fo8H3fcNqHXL86OoRizZhTBWGraN6LA5BDaKGszd', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'eyJfdG9rZW4iOiJGT1VyZUZnZjdjc0N5QlVWMjM0ZzFXRlI2ZEloQUtiaXh0NTg2TnZLIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21hZ2l0YS50ZXN0XC9hZG1pblwvZGFzaGJvYXJkIiwicm91dGUiOiJhZG1pbi5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF93ZWIiOiIxNmNmOTBiYzMzNzRiNGM4YzE5OTk4ZWQ0NzQyMTdjZDVjMTgyZjNiNGNlM2Q0NTY1YzI0Y2Q4MDUzM2I0ODE1In0=', 1793594242),
('FV2zHlEq6tC84tYNDsBUgdA0B4gasWb1clAGfAbG', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'eyJfdG9rZW4iOiIyQkJLenA0SjFCY1pBWFA1MWM3WHhOZmVrOXNTd3FlbU9jb1V4QWVmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21hZ2l0YS50ZXN0XC93YXJnYVwvbGFwb3JhblwvYnVhdCIsInJvdXRlIjoid2FyZ2EubGFwb3Jhbi5jcmVhdGUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MiwicGFzc3dvcmRfaGFzaF93ZWIiOiIzYTk3OGY4Mjg0MmRmZmE1YzlhOTQ5N2U4YjY0YTA4NjIzODNiYWFkZGRjYzMwNDY2Zjc0MjMwYmViOGQxYjEwIn0=', 1793037716),
('GzfgJvGNlzi7Mth5p5g8MRA4zOxcQE5jdGsDfrol', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'eyJfdG9rZW4iOiI2VGljZm5KcUMza1RRSlBiWVNkemxuME5kYTlPb3BPTU1tdmlBWkNjIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvbWFnaXRhLnRlc3RcL2FkbWluXC9kYXNoYm9hcmQifSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21hZ2l0YS50ZXN0XC9hZG1pblwvZGFzaGJvYXJkIiwicm91dGUiOiJhZG1pbi5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF93ZWIiOiIxNmNmOTBiYzMzNzRiNGM4YzE5OTk4ZWQ0NzQyMTdjZDVjMTgyZjNiNGNlM2Q0NTY1YzI0Y2Q4MDUzM2I0ODE1In0=', 1793606852),
('KjoWYhzgEwjhRcTGKVSUGIVBZYBzkmXI5Liml150', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'eyJfdG9rZW4iOiI5aERLQ1ZRTjZRNm9RN3pJc05nRGdseDZscFNSUFhRN2ZTN282YkwzIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbWFnaXRhLnRlc3RcL3dhcmdhXC9sYXBvcmFuXC9idWF0Iiwicm91dGUiOiJ3YXJnYS5sYXBvcmFuLmNyZWF0ZSJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MiwicGFzc3dvcmRfaGFzaF93ZWIiOiIzYTk3OGY4Mjg0MmRmZmE1YzlhOTQ5N2U4YjY0YTA4NjIzODNiYWFkZGRjYzMwNDY2Zjc0MjMwYmViOGQxYjEwIn0=', 1793811224),
('n5YIHzoSVffp3O9MYCjIVYix80OKu73n0MTRPuQM', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'eyJfdG9rZW4iOiJlMW5IYWxOTjJVTTM1MFZKVVUwc0lndXZiYWROb2tvQmp5TXFvYmFVIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbWFnaXRhLnRlc3RcL3dhcmdhXC9sYXBvcmFuXC9idWF0Iiwicm91dGUiOiJ3YXJnYS5sYXBvcmFuLmNyZWF0ZSJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MiwicGFzc3dvcmRfaGFzaF93ZWIiOiIzYTk3OGY4Mjg0MmRmZmE1YzlhOTQ5N2U4YjY0YTA4NjIzODNiYWFkZGRjYzMwNDY2Zjc0MjMwYmViOGQxYjEwIn0=', 1793115034),
('O3V7abOCZduuIBZRCwO2EZBB1pNGOAir44thV1f3', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'eyJfdG9rZW4iOiJkb2FreUZWOHNwWDZBSHFRNVdicTlGQ01pUUdYM0hGMUE0Qzl5YzFIIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbWFnaXRhLnRlc3RcL3dhcmdhXC9sYXBvcmFuXC9idWF0Iiwicm91dGUiOiJ3YXJnYS5sYXBvcmFuLmNyZWF0ZSJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MiwicGFzc3dvcmRfaGFzaF93ZWIiOiIzYTk3OGY4Mjg0MmRmZmE1YzlhOTQ5N2U4YjY0YTA4NjIzODNiYWFkZGRjYzMwNDY2Zjc0MjMwYmViOGQxYjEwIn0=', 1793770018),
('RgPeDVdY3l7bb4MAA8UPqbJ1lQymK2cjcVKnnKy2', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'eyJfdG9rZW4iOiJveWFMS1h4RzNRNk43V1FycE9sRFVjZFJOUThxZllzUjI5NDNDOUk1IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvc2FkZXdhLnRlc3RcL2FkbWluXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImFkbWluLmRhc2hib2FyZCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF93ZWIiOiIxNmNmOTBiYzMzNzRiNGM4YzE5OTk4ZWQ0NzQyMTdjZDVjMTgyZjNiNGNlM2Q0NTY1YzI0Y2Q4MDUzM2I0ODE1In0=', 1792737041),
('x0C7qvsT7HtDcHTAqvkOfmee5Cdncq9jJ3hAquFd', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36 Edg/156.0.0.0', 'eyJfdG9rZW4iOiJIUTFJRDRiOENiQnZTNjBHSThMaFhTZkRhYzlKakE2NVJkY3AwTFFBIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbWFnaXRhLnRlc3RcL2FkbWluXC9tYXN0ZXItZGVzYSIsInJvdXRlIjoiYWRtaW4ubWFzdGVyLWRlc2EuaW5kZXgifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiMTZjZjkwYmMzMzc0YjRjOGMxOTk5OGVkNDc0MjE3Y2Q1YzE4MmYzYjRjZTNkNDU2NWMyNGNkODA1MzNiNDgxNSJ9', 1793209125);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_whatsapp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_ktp_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('ADMIN_INSPEKTORAT','WARGA') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'WARGA',
  `status_akun` enum('PENDING','VERIFIED','AKTIF','DITOLAK') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `catatan_verifikasi` text COLLATE utf8mb4_unicode_ci,
  `verified_by` bigint UNSIGNED DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `nama_lengkap`, `email`, `email_verified_at`, `password`, `no_whatsapp`, `foto_ktp_url`, `role`, `status_akun`, `catatan_verifikasi`, `verified_by`, `verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '5208010101010001', 'Admin Inspektorat Sumbawa', 'admin@inspektorat-sumbawa.go.id', NULL, '$2y$12$WE26kncwSyQdatqA0ygmSOr87/1mNIy40f248qJWBj60Cofp.tT5K', '081234567890', NULL, 'ADMIN_INSPEKTORAT', 'AKTIF', NULL, NULL, NULL, NULL, '2026-10-21 22:18:47', '2026-10-21 22:18:47'),
(2, '5208010101010003', 'Warga Contoh', 'warga@example.com', NULL, '$2y$12$SeQdSdxSbd2uhZKxwzJQ0uorWfqSV8YeJ5yVagzniUzF0rn/bre4S', '081234567892', NULL, 'WARGA', 'AKTIF', NULL, NULL, NULL, NULL, '2026-10-21 22:18:47', '2026-10-21 22:18:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_trails`
--
ALTER TABLE `audit_trails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_trails_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `audit_trails_user_id_index` (`user_id`),
  ADD KEY `audit_trails_created_at_index` (`created_at`);

--
-- Indexes for table `bukti_pelaporans`
--
ALTER TABLE `bukti_pelaporans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bukti_pelaporans_pelaporan_id_foreign` (`pelaporan_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kewenangan_desas`
--
ALTER TABLE `kewenangan_desas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kewenangan_desas_user_id_desa_id_unique` (`user_id`,`desa_id`),
  ADD KEY `kewenangan_desas_desa_id_foreign` (`desa_id`),
  ADD KEY `kewenangan_desas_assigned_by_foreign` (`assigned_by`);

--
-- Indexes for table `master_desas`
--
ALTER TABLE `master_desas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_desas_kode_desa_unique` (`kode_desa`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pelaporans`
--
ALTER TABLE `pelaporans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pelaporans_kode_laporan_unique` (`kode_laporan`),
  ADD KEY `pelaporans_desa_id_foreign` (`desa_id`),
  ADD KEY `pelaporans_pelapor_id_foreign` (`pelapor_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_verified_by_foreign` (`verified_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_trails`
--
ALTER TABLE `audit_trails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `bukti_pelaporans`
--
ALTER TABLE `bukti_pelaporans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kewenangan_desas`
--
ALTER TABLE `kewenangan_desas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_desas`
--
ALTER TABLE `master_desas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pelaporans`
--
ALTER TABLE `pelaporans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_trails`
--
ALTER TABLE `audit_trails`
  ADD CONSTRAINT `audit_trails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `bukti_pelaporans`
--
ALTER TABLE `bukti_pelaporans`
  ADD CONSTRAINT `bukti_pelaporans_pelaporan_id_foreign` FOREIGN KEY (`pelaporan_id`) REFERENCES `pelaporans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kewenangan_desas`
--
ALTER TABLE `kewenangan_desas`
  ADD CONSTRAINT `kewenangan_desas_assigned_by_foreign` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kewenangan_desas_desa_id_foreign` FOREIGN KEY (`desa_id`) REFERENCES `master_desas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kewenangan_desas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pelaporans`
--
ALTER TABLE `pelaporans`
  ADD CONSTRAINT `pelaporans_desa_id_foreign` FOREIGN KEY (`desa_id`) REFERENCES `master_desas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pelaporans_pelapor_id_foreign` FOREIGN KEY (`pelapor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
