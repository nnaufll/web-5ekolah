-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2026 at 08:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sekolahsmp3`
--

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `kategori` varchar(255) NOT NULL DEFAULT 'kbm',
  `warna` varchar(255) NOT NULL DEFAULT '#3788d8',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agenda_sekolah`
--

CREATE TABLE `agenda_sekolah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `tipe` varchar(255) NOT NULL DEFAULT 'event',
  `warna` varchar(255) NOT NULL DEFAULT '#0d6efd',
  `tahun_ajaran` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agenda_sekolah`
--

INSERT INTO `agenda_sekolah` (`id`, `judul`, `tanggal_mulai`, `tanggal_selesai`, `tipe`, `warna`, `tahun_ajaran`, `semester`, `created_at`, `updated_at`) VALUES
(4, 'UAS', '2026-02-03', '2026-02-09', 'ujian', '#ff0000', '2026/2027', 'Genap', '2026-02-03 00:32:27', '2026-02-03 00:37:33'),
(5, 'Rapat', '2026-02-11', '2026-02-12', 'kegiatan', '#fd0d0d', '2026/2027', 'Genap', '2026-02-08 20:43:37', '2026-02-08 20:43:37');

-- --------------------------------------------------------

--
-- Table structure for table `beritas`
--

CREATE TABLE `beritas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `penulis` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beritas`
--

INSERT INTO `beritas` (`id`, `judul`, `slug`, `isi`, `gambar`, `penulis`, `created_at`, `updated_at`) VALUES
(7, 'Demo Ekstrakurikuler SMAN GARUDA CENDEKIA Berlangsung Sangat Meriah', 'demo-ekstrakurikuler-sman-garuda-cendekia-berlangsung-sangat-meriah', 'Demo Ekstrakurikuler SMAN GARUDA CENDEKIA Berlangsung Sangat Meriah\r\n\r\nSMAN GARUDA CENDEKIA menggelar kegiatan Demo Ekstrakurikuler yang berlangsung dengan sangat meriah dan penuh antusiasme. Acara ini diikuti oleh berbagai ekstrakurikuler yang ada di sekolah, seperti Pramuka, Paskibra, seni tari, musik, olahraga, dan ekstrakurikuler lainnya.\r\n\r\nKegiatan demo ini bertujuan untuk memperkenalkan berbagai pilihan ekstrakurikuler kepada para siswa, khususnya peserta didik baru, agar dapat memilih kegiatan sesuai dengan minat dan bakat mereka. Setiap ekstrakurikuler menampilkan pertunjukan terbaiknya, mulai dari atraksi baris-berbaris, penampilan seni, hingga demonstrasi keterampilan olahraga.\r\n\r\nAntusiasme siswa terlihat jelas dari sorak sorai dan tepuk tangan yang mengiringi setiap penampilan. Selain menghibur, kegiatan ini juga menjadi ajang untuk menumbuhkan rasa percaya diri, kebersamaan, serta semangat berprestasi di kalangan siswa.\r\n\r\nDengan terselenggaranya demo ekstrakurikuler ini, diharapkan siswa SMAN GARUDA CENDEKIA semakin termotivasi untuk aktif mengikuti kegiatan nonakademik sebagai sarana pengembangan diri dan karakter.', 'berita-images/2cJDlUhtUbkKWlDiAw31w0EfR2bzvrHzMQYt86ZT.jpg', 'Admin Sekolah', '2026-01-21 20:43:28', '2026-02-05 00:03:52'),
(8, 'Pramuka SMAN GARUDA CENDEKIA Kembali Ikuti Ajang Lomba Nasional', 'pramuka-sman-garuda-cendekia-kembali-ikuti-ajang-lomba-nasional', 'Gerakan Pramuka SMAN GARUDA CENDEKIA kembali menunjukkan semangat dan komitmennya dalam berprestasi dengan mengikuti ajang lomba nasional GSS (Gebyar Scout Spensa) yang diselenggarakan di SMP Negeri 1 Sumedang. Kegiatan ini diikuti oleh berbagai pangkalan Pramuka tingkat SMA dari berbagai daerah di Indonesia.\r\n\r\nKeikutsertaan Pramuka SMAN GARUDA CENDEKIAi dalam ajang ini menjadi bukti nyata pembinaan karakter, kedisiplinan, dan keterampilan kepramukaan yang terus dikembangkan di sekolah. Para peserta mengikuti berbagai mata lomba yang menguji kemampuan baris-berbaris, sandi, tali-temali, P3K, pengetahuan kepramukaan, serta kerja sama tim.', 'berita-images/nn2YciumjjR3Oqgs4tIEoE0yPYIYzVRUVzZ2DWSB.jpg', 'Admin Sekolah', '2026-01-21 20:45:45', '2026-02-05 00:03:30'),
(11, 'MEMBANGUN AKAL BERBUDI LUHUR3', 'membangun-akal-berbudi-luhur3', 'MEMBANGUN AKAL BERBUDI LUHUR', 'berita-images/sgns06sybxfBx7122etcJ2pR493JxI8Df2trqmzZ.png', 'Admin Sekolah', '2026-02-08 20:21:07', '2026-02-11 00:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ekskul_galeries`
--

CREATE TABLE `ekskul_galeries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ekskul_id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ekskul_galeries`
--

INSERT INTO `ekskul_galeries` (`id`, `ekskul_id`, `foto`, `created_at`, `updated_at`) VALUES
(1, 1, 'galeri-eskul/oagaAmTH58AEwmKeXh5r5WXmpMKvxemuetg4gUM5.jpg', '2026-01-20 21:27:34', '2026-01-20 21:27:34'),
(2, 1, 'galeri-eskul/r9IYaFrcSAvPqrtGCNCFCfZ3oyZbI571Fxv7mE78.jpg', '2026-01-20 21:27:35', '2026-01-20 21:27:35'),
(3, 1, 'galeri-eskul/Ctp2KLmIAZVKtvzq8nnpnlAWuin4PEefNGgcJsBY.jpg', '2026-01-20 21:27:35', '2026-01-20 21:27:35'),
(4, 1, 'galeri-eskul/dCp2Arp5ruHV8prCMviuZcBXAeykx4UQ89XuQpLj.jpg', '2026-01-20 21:27:35', '2026-01-20 21:27:35'),
(5, 1, 'galeri-eskul/DupsImc7VEckq1mDtgmHhUL6yGBWvrcMO3ubMGgo.jpg', '2026-01-20 21:27:35', '2026-01-20 21:27:35'),
(6, 1, 'galeri-eskul/vTe4TYnx9xP1DfSGP7GD9TkegXPUAyBBN0VqvMUd.jpg', '2026-01-20 21:27:35', '2026-01-20 21:27:35'),
(7, 1, 'galeri-eskul/Iw1UeKoWF0Ixy1ioRMWjGiO8xE5i6j4rh7XfnJu6.jpg', '2026-01-20 21:27:35', '2026-01-20 21:27:35');

-- --------------------------------------------------------

--
-- Table structure for table `eskuls`
--

CREATE TABLE `eskuls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_eskul` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `pembina` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `prestasi` text DEFAULT NULL,
  `jadwal` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eskuls`
--

INSERT INTO `eskuls` (`id`, `nama_eskul`, `slug`, `pembina`, `no_hp`, `deskripsi`, `prestasi`, `jadwal`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Pramuka Pandu Wira Nata', 'pramuka-pandu-wira-nata', 'Viki Prianto - Kiki Anggraeni', '81322696005', 'PRAMUKA PANDU WIRA NATA\r\nKI PANDU WIRAKUSUMA - NYI MAS NATA WIJAYA\r\nGUGUS DEPAN 20.079 - 20.080.\r\nSMAN GARUDA CENDEKIA\r\nBROOKLYN, AMERIKA SERIKAT', 'TREBLE WINNER SCC 2016, 2017, 2018\r\njuara 1', 'Kamis, 14.30 - 16.30 (Khusus), Jumat, 13.30 -16.00 (Wajib)', 'eskul/DtRiiCp4BxMKLANrPP54uS0GKBKlW9Csp5hzuChs.jpg', '2026-01-20 21:27:34', '2026-02-05 00:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `order`, `created_at`, `updated_at`) VALUES
(3, 'apa itu what', 'what itu apa', 2, '2026-01-21 20:13:34', '2026-01-21 20:13:34'),
(4, 'apa itu faq', 'FAQ adalah singkatan dari Frequently Asked Questions (Pertanyaan yang Sering Diajukan), yaitu kumpulan pertanyaan umum beserta jawabannya yang sering ditanyakan oleh pengguna, pelanggan, atau masyarakat tentang suatu topik, produk, atau layanan tertentu, biasanya disajikan dalam bentuk halaman khusus di situs web atau aplikasi untuk efisiensi informasi. Tujuannya adalah untuk memberikan solusi cepat, menghemat waktu baik bagi pengguna maupun penyedia informasi, serta membangun kepercayaan.', 1, '2026-01-21 20:13:46', '2026-01-21 20:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_fasilitas` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'bi-building',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama_fasilitas`, `slug`, `deskripsi`, `foto`, `icon`, `created_at`, `updated_at`) VALUES
(2, 'Wc siswa', 'wc-siswa', 'wc yang di rancang bersih dan nyaman seta layak di gunakan', 'fasilitas-images/qtg4oWuf8OorhJjiotZW9rJFwsHjnb9jSvIsrFDQ.jpg', 'U+F796', '2026-01-20 21:34:47', '2026-01-26 19:51:24'),
(3, 'Meja dan Kursi LAYAK', 'meja-dan-kursi-layak', 'Meja dan Kursi yang Proper dan Layak Digunakan', 'fasilitas-images/SNnnWqT7nGq7kX7QAGFKw0BcdTvDY76yKamBSIQc.jpg', 'airplane', '2026-01-26 19:43:20', '2026-02-03 00:46:16');

-- --------------------------------------------------------

--
-- Table structure for table `galeris`
--

CREATE TABLE `galeris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `link_youtube` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeris`
--

INSERT INTO `galeris` (`id`, `judul`, `foto`, `link_youtube`, `caption`, `created_at`, `updated_at`) VALUES
(12, 'Kegiatan UCT 2026', 'galeri-sekolah/VfxJxpXelSWEqTaVdJhkqa8J0UBtp3IzvG4iKwhS.jpg', NULL, 'Pramuka Pwn Menang di latgab Kegiatan UCT 2026 di SMPN 1 Sindang', '2026-01-26 19:24:40', '2026-01-26 19:24:40'),
(13, 'Dewan PMR MADYA UNIT 1286', 'galeri-sekolah/jzr4pimoalR8OHWoCQh6RljCSASq5J0mL48OxUfL.jpg', NULL, 'Dewan PMR MADYA UNIT 1286', '2026-01-26 19:27:59', '2026-01-26 19:27:59'),
(14, 'Pelantikan Eskul gabungan 2025', 'galeri-sekolah/63TE2KsUMS3m3KcuUf4GtTZLpJDYsXshVajFwCUh.jpg', NULL, 'Pelantikan Eskul gabungan 2025', '2026-01-26 19:28:30', '2026-01-26 19:28:30'),
(15, 'UCT ON FIREE', 'galeri-sekolah/ZFozXzBza8FGzclN8MMdHzG3a7XevPRxn2ZXyO1t.jpg', NULL, NULL, '2026-01-26 19:28:49', '2026-01-26 19:28:49'),
(16, 'Kegiatan Penghijauan Sekolah', 'galeri-sekolah/0HUDw27LOFiI0Y67PTZhMQFpvTL5l5zxaeG8eY1c.jpg', NULL, NULL, '2026-01-26 19:29:30', '2026-01-26 19:29:30'),
(17, 'Dewan OSIS 25/26', 'galeri-sekolah/dLIKaU2TLcYToaTnSsmWCK8VWIufAYPRe3o3dIBz.jpg', NULL, NULL, '2026-01-26 19:29:58', '2026-01-26 19:29:58'),
(18, 'DOK lomba UCT', 'galeri-sekolah/ZrBrDJb3GvFJDQRvuEZKHXoRIOtLsWefDBwzegBY.jpg', NULL, NULL, '2026-01-26 19:30:17', '2026-01-26 19:30:17'),
(19, 'DOK lomba UCT', 'galeri-sekolah/Oy9vK4PMgLG6JHaeo6FgJyEQOTrSJ9Qksc9w1qvF.jpg', NULL, NULL, '2026-01-26 19:30:32', '2026-01-26 19:30:32'),
(20, 'Kemah Gabungan 2025', 'galeri-sekolah/o22N6MMqFMPPbcNPM31SmDJMT7Fq2KPNGOhMdKm5.jpg', NULL, NULL, '2026-01-26 19:31:15', '2026-01-26 19:31:15'),
(21, 'DOK lomba UCT', 'galeri-sekolah/a77uwmDIUa1hEfIHV8M7uGrJzcViUFBLGzP1JsKO.jpg', NULL, NULL, '2026-01-26 19:32:36', '2026-01-26 19:32:36'),
(23, 'musical', NULL, NULL, NULL, '2026-01-28 20:09:53', '2026-01-28 20:09:53'),
(24, 'wleeeeee', NULL, NULL, 'aaa', '2026-01-28 20:10:37', '2026-01-28 20:10:37'),
(35, 'BEBERES SEKOLAH - UPTD SMP NEGERI 3 TERISI KECAMATAN TERISI KABUPATEN INDRAMAYU', NULL, 'https://www.youtube.com/watch?v=cFYAlTDBL2I', 'Giat Beberes Sekolah bersama warga UPTD SMP Negeri 3 Terisi dalam rangka menanamkan rasa tanggung jawab terhadap lingkungan dan mewujudkan sikap gotong royong, kami tetap berupaya untuk berkontribusi nyata dalam mewujudkan INDRAMAYU REANG !!', '2026-02-03 00:50:07', '2026-02-03 00:50:07'),
(36, 'Lomba Senam Anak Indonesia Hebat 2025_UPTD SMP Negeri 3 Terisi - Indramayu - Jawa Barat', NULL, 'https://www.youtube.com/watch?v=BUhS2En3ur8', NULL, '2026-02-03 00:50:48', '2026-02-03 00:50:48'),
(37, 'PELAKSANAAN KEGIATAN PKRS DALAM P5 \"GAYA HIDUP BERKELANJUTAN\" _UPTD SMP NEGERI 3 TERISI - INDRAMAYU', NULL, 'https://www.youtube.com/watch?v=V8Ae3X07n9M', NULL, '2026-02-03 00:51:27', '2026-02-03 00:51:27'),
(38, 'BOKASHI PRESTISE || UPTD SMP NEGERI 3 TERISI || KEC. TERISI - INDRAMAYU', NULL, 'https://www.youtube.com/watch?v=DRPvHV8PnEY', NULL, '2026-02-03 00:51:58', '2026-02-03 00:51:58'),
(39, 'BOKASHI PRESTISE PART 2 || GINCU AYU || UPTD SMP NEGERI 3 TERISI || KEC. TERISI - INDRAMAYU', NULL, 'https://www.youtube.com/watch?v=atOM4KbMN7A', NULL, '2026-02-03 00:52:19', '2026-02-03 00:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `gurus`
--

CREATE TABLE `gurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gurus`
--

INSERT INTO `gurus` (`id`, `nama`, `nip`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES
(2, 'Prof. Zaidi, S.Pd., M.Pd.', NULL, 'KEPALA SEKOLAH', 'foto-guru/qI7ayTkpwlBanM9qeeLO7mVBNuS2qA4whfDDiJeA.jpg', '2026-01-22 00:54:41', '2026-02-04 23:58:31'),
(10, 'WINDAH BASUDARA', NULL, 'INFORMATIKA', 'foto-guru/l1RtiPTKHZe5Ys2L7mJymMjoszGU1Ez2qUYAOXKX.jpg', '2026-01-25 23:28:12', '2026-02-04 23:59:02'),
(11, 'LUTHFI HALIMAWAN', NULL, 'IPA', 'foto-guru/R7zuuUBC3lb5nGo1iFQzLKair9jzM2rfHpUNv5OM.jpg', '2026-01-25 23:29:20', '2026-02-04 23:59:18'),
(12, 'KEENAN INARA ATHALLA', NULL, 'PENJAS', 'foto-guru/MJPc9bfT7wQVUQ3k0yQWv0seesM3cjOoHraSE9L1.jpg', '2026-01-25 23:37:10', '2026-02-05 00:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pelajarans`
--

CREATE TABLE `jadwal_pelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `guru` varchar(255) DEFAULT NULL,
  `guru_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hari` varchar(255) NOT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `mapel` varchar(255) NOT NULL,
  `mapel_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahun_ajaran` varchar(255) DEFAULT NULL,
  `semester` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_pelajarans`
--

INSERT INTO `jadwal_pelajarans` (`id`, `nama_kelas`, `guru`, `guru_id`, `hari`, `kelas_id`, `jam_mulai`, `jam_selesai`, `mapel`, `mapel_id`, `created_at`, `updated_at`, `tahun_ajaran`, `semester`) VALUES
(30, 'X IPA 2', 'LUTHFI HALIMAWAN', 11, 'Senin', 13, '07:00:00', '08:00:00', 'Informatika', 7, '2026-02-02 00:47:24', '2026-02-05 00:09:39', '2024/2025', 'Genap'),
(32, 'X IPA 3', 'WINDAH BASUDARA', 10, 'Senin', 12, '07:00:00', '08:00:00', 'IPA', 4, '2026-02-02 00:55:05', '2026-02-05 00:09:46', '2024/2025', 'Genap'),
(35, 'X IPA 1', 'KEENAN INARA ATHALLA', 12, 'Senin', 11, '07:00:00', '08:00:00', 'PENJAS', 11, '2026-02-02 01:05:25', '2026-02-05 00:09:28', '2026/2027', 'Genap');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, 'VII-A', '2026-01-22 20:00:29', '2026-01-22 20:00:29'),
(2, 'VII-B', '2026-01-22 20:00:36', '2026-01-22 20:00:36'),
(3, 'VII-C', '2026-01-22 20:00:44', '2026-01-22 20:00:44'),
(4, 'VII-D', '2026-01-22 20:00:52', '2026-01-22 20:00:52'),
(5, 'VII-E', '2026-01-22 20:01:02', '2026-01-22 20:01:02'),
(6, 'VII-F', '2026-01-22 20:01:13', '2026-01-22 20:01:13'),
(7, 'VII-G', '2026-01-22 20:01:25', '2026-01-22 20:01:25'),
(9, 'VIII-A', '2026-01-25 23:09:56', '2026-01-25 23:09:56'),
(10, 'VIIIB', '2026-01-27 20:26:54', '2026-01-27 20:26:54'),
(11, 'X IPA 1', '2026-02-05 00:08:57', '2026-02-05 00:08:57'),
(12, 'X IPA 3', '2026-02-05 00:09:04', '2026-02-05 00:09:04'),
(13, 'X IPA 2', '2026-02-05 00:09:08', '2026-02-05 00:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajarans`
--

CREATE TABLE `mata_pelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_mapel` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_pelajarans`
--

INSERT INTO `mata_pelajarans` (`id`, `nama_mapel`, `created_at`, `updated_at`) VALUES
(1, 'Bahasa Indonesia', '2026-01-22 20:01:42', '2026-01-22 20:01:42'),
(2, 'Bahasa Inggris', '2026-01-22 20:01:52', '2026-01-22 20:01:52'),
(3, 'Matematika', '2026-01-22 20:02:01', '2026-01-22 20:02:01'),
(4, 'IPA', '2026-01-22 20:02:04', '2026-01-22 20:02:04'),
(5, 'IPS', '2026-01-22 20:02:08', '2026-01-22 20:02:08'),
(6, 'PKN', '2026-01-22 20:02:14', '2026-01-22 20:02:14'),
(7, 'Informatika', '2026-01-22 20:02:21', '2026-01-22 20:02:21'),
(8, 'UPACARA', '2026-01-22 20:02:59', '2026-01-22 20:02:59'),
(9, 'ISTIRAHAT', '2026-01-22 20:05:44', '2026-01-22 20:05:44'),
(11, 'PENJAS', '2026-01-25 23:09:59', '2026-01-25 23:09:59'),
(12, 'JEPANG', '2026-01-27 20:27:07', '2026-01-27 20:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_19_030930_create_beritas_table', 1),
(5, '2026_01_19_070854_create_profil_sekolahs_table', 1),
(6, '2026_01_20_023601_create_eskuls_table', 1),
(7, '2026_01_20_033459_create_fasilitas_table', 1),
(8, '2026_01_20_041449_create_ekskul_galeries_table', 1),
(9, '2026_01_20_041450_add_prestasi_to_ekskuls_table', 1),
(10, '2026_01_20_062935_add_slug_to_eskuls_table', 1),
(11, '2026_01_20_071539_add_no_hp_to_eskuls_table', 1),
(12, '2026_01_21_062907_create_agendas_table', 2),
(13, '2026_01_21_062908_create_jadwal_pelajarans_table', 2),
(14, '2026_01_21_072953_tambah_jam_ke_jadwal_pelajarans', 3),
(15, '2026_01_21_073125_tambah_kolom_guru', 4),
(16, '2026_01_21_073305_hapus_kolom_jam_lama', 5),
(17, '2026_01_22_021600_create_faqs_table', 6),
(18, '2026_01_22_064503_create_gurus_table', 7),
(19, '2026_01_23_024840_create_masters_table', 8),
(20, '2026_01_26_030053_create_galeris_table', 9),
(21, '2026_01_26_062125_add_nip_to_gurus_table', 10),
(22, '2026_01_29_024154_add_link_youtube_to_galeris_table', 11),
(23, '2026_01_29_041925_create_spmb_links_table', 12),
(24, '2026_01_30_023159_add_header_to_profils_table', 13),
(25, '2026_01_30_025320_create_sliders_table', 14),
(26, '2026_01_30_062718_create_misis_table', 15),
(27, '2026_02_02_024709_create_visis_table', 16),
(28, '2026_02_02_035837_ubah_kolom_tabel_visis', 17),
(29, '2026_02_02_060314_create_agenda_sekolah_table', 18),
(30, '2026_02_02_062049_add_semester_to_jadwal_pelajarans_table', 19),
(31, '2026_02_02_070450_update_tabel_jadwal_pelajaran', 20),
(32, '2026_02_02_073242_add_warna_to_agenda_sekolah_table', 21),
(33, '2026_02_03_032650_add_kelas_id_to_jadwal_pelajarans_table', 22),
(34, '2026_02_03_033114_add_missing_ids_to_jadwal_table', 23),
(35, '2026_02_26_030649_alter_gambar_nullable_on_sliders_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `misis`
--

CREATE TABLE `misis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi_singkat` text NOT NULL,
  `deskripsi_lengkap` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `misis`
--

INSERT INTO `misis` (`id`, `judul`, `deskripsi_singkat`, `deskripsi_lengkap`, `gambar`, `urutan`, `created_at`, `updated_at`) VALUES
(4, 'Menyelenggarakan kegiatan pembinaan prestasi bidang akademik.', 'Sekolah tidak membiarkan siswa belajar sendiri, melainkan secara aktif memfasilitasi pendalaman materi. Ini berarti sekolah mengadakan kelas tambahan, klub belajar (seperti klub Sains, Matematika), atau bimbingan intensif khusus untuk siswa yang memiliki potensi akademis, agar mereka menguasai materi pelajaran melampaui standar kurikulum biasa.', 'Sekolah tidak membiarkan siswa belajar sendiri, melainkan secara aktif memfasilitasi pendalaman materi. Ini berarti sekolah mengadakan kelas tambahan, klub belajar (seperti klub Sains, Matematika), atau bimbingan intensif khusus untuk siswa yang memiliki potensi akademis, agar mereka menguasai materi pelajaran melampaui standar kurikulum biasa.', NULL, 1, '2026-02-01 21:35:43', '2026-02-01 21:35:43'),
(5, 'Mengikutsertakan peserta didik dalam berbagai lomba bidang akademik', 'Sekolah berupaya menguji dan memvalidasi kemampuan akademis siswa di kancah luar sekolah. Sekolah aktif mencari informasi dan mendaftarkan siswa ke kompetisi seperti Olimpiade Sains Nasional (OSN), cerdas cermat, atau lomba karya ilmiah remaja untuk melatih daya saing dan mental juara siswa.', 'Sekolah berupaya menguji dan memvalidasi kemampuan akademis siswa di kancah luar sekolah. Sekolah aktif mencari informasi dan mendaftarkan siswa ke kompetisi seperti Olimpiade Sains Nasional (OSN), cerdas cermat, atau lomba karya ilmiah remaja untuk melatih daya saing dan mental juara siswa.', NULL, 2, '2026-02-01 21:36:31', '2026-02-01 21:36:31'),
(7, 'Mengikutsertakan peserta didik dalam berbagai kegiatan lomba bidang ekstrakurikuler', 'Misi ini menjamin keseimbangan antara otak kiri dan kanan. Sekolah mendukung pengembangan bakat non-akademik (seni, olahraga, kepramukaan) dengan mengirimkan siswa ke ajang seperti O2SN (Olahraga), FLS2N (Seni), atau lomba Paskibra, sehingga siswa yang berbakat di luar pelajaran tetap mendapatkan panggung apresiasi.', 'Misi ini menjamin keseimbangan antara otak kiri dan kanan. Sekolah mendukung pengembangan bakat non-akademik (seni, olahraga, kepramukaan) dengan mengirimkan siswa ke ajang seperti O2SN (Olahraga), FLS2N (Seni), atau lomba Paskibra, sehingga siswa yang berbakat di luar pelajaran tetap mendapatkan panggung apresiasi.', NULL, 3, '2026-02-01 21:38:29', '2026-02-01 21:38:29'),
(8, 'Melaksanakan program pembiasaan mengaji, salat zuhur, dan salat dhuha bersama di sekolah', 'Fokus pada pembentukan habituasi (kebiasaan) religius. Agama tidak hanya diajarkan sebagai teori di kelas, tetapi dipraktikkan secara rutin. Tujuannya adalah agar ibadah menjadi kebutuhan dan budaya sehari-hari siswa, bukan sekadar kewajiban saat diawasi guru.', 'Fokus pada pembentukan habituasi (kebiasaan) religius. Agama tidak hanya diajarkan sebagai teori di kelas, tetapi dipraktikkan secara rutin. Tujuannya adalah agar ibadah menjadi kebutuhan dan budaya sehari-hari siswa, bukan sekadar kewajiban saat diawasi guru.', NULL, 4, '2026-02-01 21:38:44', '2026-02-01 21:38:44'),
(9, 'Melaksanakan peringatan hari besar keagamaan dengan berbagai kegiatan yang positif', 'Sekolah memanfaatkan momen sejarah agama (seperti Maulid Nabi, Isra Mi\'raj, atau Tahun Baru Hijriah) sebagai sarana edukasi. Kegiatannya tidak hanya seremonial, tetapi diisi dengan ceramah motivasi, bakti sosial, atau refleksi diri untuk meningkatkan kecintaan siswa pada ajaran agamanya.', 'Sekolah memanfaatkan momen sejarah agama (seperti Maulid Nabi, Isra Mi\'raj, atau Tahun Baru Hijriah) sebagai sarana edukasi. Kegiatannya tidak hanya seremonial, tetapi diisi dengan ceramah motivasi, bakti sosial, atau refleksi diri untuk meningkatkan kecintaan siswa pada ajaran agamanya.', NULL, 5, '2026-02-01 21:39:01', '2026-02-01 21:39:01'),
(10, 'Melaksanakan berbagai lomba-lomba keagamaan di sekolah', 'Ini adalah upaya untuk memicu semangat beribadah melalui kompetisi yang sehat di lingkungan internal sekolah. Contohnya mengadakan lomba tahfidz (hafalan Quran), lomba adzan, lomba kaligrafi, atau pidato keagamaan untuk menggali bibit-bibit unggul di bidang keagamaan.', 'Ini adalah upaya untuk memicu semangat beribadah melalui kompetisi yang sehat di lingkungan internal sekolah. Contohnya mengadakan lomba tahfidz (hafalan Quran), lomba adzan, lomba kaligrafi, atau pidato keagamaan untuk menggali bibit-bibit unggul di bidang keagamaan.', NULL, 6, '2026-02-01 21:39:16', '2026-02-01 21:39:16'),
(11, 'Menyelenggarakan kegiatan pembelajaran berbasis proyek (Project Based Learning)', 'Mengubah cara belajar dari \"hanya mendengarkan guru\" menjadi \"menciptakan sesuatu\". Siswa diajak memecahkan masalah nyata dan menghasilkan karya (produk, laporan, atau aksi nyata) sehingga mereka memahami kegunaan ilmu yang dipelajari dalam kehidupan sehari-hari.', 'Mengubah cara belajar dari \"hanya mendengarkan guru\" menjadi \"menciptakan sesuatu\". Siswa diajak memecahkan masalah nyata dan menghasilkan karya (produk, laporan, atau aksi nyata) sehingga mereka memahami kegunaan ilmu yang dipelajari dalam kehidupan sehari-hari.', NULL, 7, '2026-02-01 21:39:32', '2026-02-01 21:39:32'),
(12, 'Menyediakan sarana fasilitas publikasi karya siswa secara luring dan daring', 'Sekolah menghargai karya siswa dengan memberikannya \"panggung\".\r\n\r\nLuring (Offline): Menyediakan majalah dinding (mading), pameran karya, atau papan pajangan di kelas.\r\n\r\nDaring (Online): Memuat karya siswa di website sekolah, media sosial resmi, atau channel YouTube sekolah. Tujuannya agar siswa merasa bangga dan termotivasi untuk terus berkarya.', 'Sekolah menghargai karya siswa dengan memberikannya \"panggung\".\r\n\r\nLuring (Offline): Menyediakan majalah dinding (mading), pameran karya, atau papan pajangan di kelas.\r\n\r\nDaring (Online): Memuat karya siswa di website sekolah, media sosial resmi, atau channel YouTube sekolah. Tujuannya agar siswa merasa bangga dan termotivasi untuk terus berkarya.', NULL, 8, '2026-02-01 21:40:06', '2026-02-01 21:40:06'),
(13, 'Mengikutsertakan pendidik dalam berbagai kegiatan peningkatan kompetensi profesional dan kompetensi pedagogis', 'Sekolah sadar bahwa kualitas murid bergantung pada kualitas guru. Misi ini mewajibkan sekolah mengirim guru mengikuti pelatihan, seminar, lokakarya, atau MGMP. Fokusnya pada dua hal: penguasaan materi ajar (profesional) dan kemampuan cara mengajar yang menarik (pedagogis).', 'Sekolah sadar bahwa kualitas murid bergantung pada kualitas guru. Misi ini mewajibkan sekolah mengirim guru mengikuti pelatihan, seminar, lokakarya, atau MGMP. Fokusnya pada dua hal: penguasaan materi ajar (profesional) dan kemampuan cara mengajar yang menarik (pedagogis).', NULL, 9, '2026-02-01 21:40:29', '2026-02-01 21:40:29'),
(14, 'Melaksanakan proses pembelajaran yang kreatif, inovatif, dan berorientasi pada keterampilan abad 21', 'Pembelajaran di kelas diarahkan untuk melatih kemampuan 4C: Critical Thinking (berpikir kritis), Creativity (kreativitas), Collaboration (kerjasama), dan Communication (komunikasi). Metode mengajar tidak lagi kaku/monoton, melainkan menggunakan teknologi dan diskusi interaktif.', 'Pembelajaran di kelas diarahkan untuk melatih kemampuan 4C: Critical Thinking (berpikir kritis), Creativity (kreativitas), Collaboration (kerjasama), dan Communication (komunikasi). Metode mengajar tidak lagi kaku/monoton, melainkan menggunakan teknologi dan diskusi interaktif.', NULL, 10, '2026-02-01 21:40:49', '2026-02-01 21:40:49'),
(15, 'Melaksanakan gerakan literasi sekolah melalui pembiasaan budaya baca dan optimalisasi perpustakaan sekolah', 'Sekolah bertekad melawan rendahnya minat baca. Ini dilakukan dengan mewajibkan waktu baca (misal: 15 menit sebelum pelajaran), membuat pojok baca di kelas, serta menjadikan perpustakaan sebagai tempat yang menyenangkan dan lengkap sumber belajarnya, bukan sekadar gudang buku.', 'Sekolah bertekad melawan rendahnya minat baca. Ini dilakukan dengan mewajibkan waktu baca (misal: 15 menit sebelum pelajaran), membuat pojok baca di kelas, serta menjadikan perpustakaan sebagai tempat yang menyenangkan dan lengkap sumber belajarnya, bukan sekadar gudang buku.', NULL, 11, '2026-02-01 21:41:05', '2026-02-01 21:41:05'),
(16, 'Melaksanakan proses pembelajaran yang terintegrasi dengan penanaman nilai karakter, serta nilai-nilai Profil Pelajar Pancasila', 'Pendidikan karakter tidak berdiri sendiri sebagai mata pelajaran terpisah, melainkan \"diselipkan\" dalam setiap pelajaran. Guru menanamkan nilai kejujuran saat ujian, gotong royong saat kerja kelompok, dan kebinekaan global, sesuai dengan dimensi Profil Pelajar Pancasila.', 'Pendidikan karakter tidak berdiri sendiri sebagai mata pelajaran terpisah, melainkan \"diselipkan\" dalam setiap pelajaran. Guru menanamkan nilai kejujuran saat ujian, gotong royong saat kerja kelompok, dan kebinekaan global, sesuai dengan dimensi Profil Pelajar Pancasila.', NULL, 12, '2026-02-01 21:41:20', '2026-02-01 21:41:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profil_sekolahs`
--

CREATE TABLE `profil_sekolahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header_file` varchar(255) DEFAULT NULL,
  `header_type` varchar(255) NOT NULL DEFAULT 'image',
  `nama_sekolah` varchar(255) DEFAULT NULL,
  `akreditasi` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `nama_kepsek` varchar(255) DEFAULT NULL,
  `foto_kepsek` varchar(255) DEFAULT NULL,
  `sambutan_kepsek` text DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `link_youtube` varchar(255) DEFAULT NULL,
  `jml_guru` int(11) DEFAULT NULL,
  `jml_siswa` int(11) DEFAULT NULL,
  `jml_staf` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profil_sekolahs`
--

INSERT INTO `profil_sekolahs` (`id`, `header_file`, `header_type`, `nama_sekolah`, `akreditasi`, `alamat`, `email`, `telepon`, `nama_kepsek`, `foto_kepsek`, `sambutan_kepsek`, `instagram`, `youtube`, `link_youtube`, `jml_guru`, `jml_siswa`, `jml_staf`, `created_at`, `updated_at`, `logo`) VALUES
(1, 'header-sekolah/9fbw2EGjUwmRYD2pPv5J53L60ZEmvFmmajPzFUMv.jpg', 'image', 'SMAN AMBARAWI', 'A', 'Jl. Los Angeles, No. 09. Brooklyn, Amerika Serikat.', 'smangarudacendikia@gmail.com', '02345745730', 'Prof. Zaidi, S.Pd., M.Pd.', 'foto-kepsek/FuoZGQTQc4NbmUZssF9xGHlpxKRZAajO5rgOAV5u.jpg', '“Assalamu’alaikum warahmatullahi wabarakatuh. Puji dan syukur kita panjatkan ke hadirat Allah SWT atas rahmat-Nya sehingga kita dapat melaksanakan kegiatan ini dengan baik. Saya selaku Kepala Sekolah SMAN GARUDA CENDEKIA mengucapkan terima kasih kepada seluruh guru, staf, siswa, serta pihak yang telah berkontribusi. Semoga kegiatan ini dapat menumbuhkan semangat belajar, mempererat kebersamaan, dan membawa manfaat bagi kemajuan sekolah serta masa depan peserta didik. Wassalamu’alaikum warahmatullahi wabarakatuh.”', 'https://www.instagram.com/smpnegeri3terisi?igsh=MTdmazRxb2Vjd3Jj', 'https://www.youtube.com/@SMPN3Terisi', NULL, 20, 695, 7, '2026-01-20 21:20:33', '2026-02-25 23:16:32', 'logo-sekolah/rehFVsOwCFBeP3ISdw8tg8WB3nVHtjvWPEXHWRzs.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('c0WcRyC0klo1FO3zHAjUHNNL0BSGorr2jETj6eBC', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMHJrbU94dkptVG9zdVVibUY0MWNuN3daMWtXeFd0aDZsclJjdUo2USI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rYWxlbmRlci1ha2FkZW1payI7czo1OiJyb3V0ZSI7czoxNToicHVibGljLmthbGVuZGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1770608635),
('czYfPhT7NcSyqFX8muW1XVugJVBQTcbAOXJW8dcM', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiemVyOVdVNGFISjVMZWZIWEkyZEsxWFFrTWN1ZkROamU5TGdkUEx0OSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vYWdlbmRhIjtzOjU6InJvdXRlIjtzOjEyOiJhZ2VuZGEuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1772089564),
('SDVqVgAUkxTYINclJmbJ7k9tBUqhrN3SWDoWaYJ9', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieFF5UWs5cjZrcHRlc2d5UFRhc3ZFUDQ3eWpqdER3eXZiMUZIRlp6RiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1772076297),
('y2yMg7BohRpfZdMEO383q7DwC5FMhTLG2UaXPUL5', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNVpTOFFhWjVmcmczNG4yRHhvTG9YZDVtdkhrWVpTSEJjbW9sVkMxbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9uZXdzLWFkbWluLzExL2VkaXQiO3M6NToicm91dGUiO3M6MTc6ImFkbWluLmJlcml0YS5lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1770795482);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sumber` varchar(50) DEFAULT 'manual',
  `berita_id` int(11) DEFAULT NULL,
  `is_hero` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `gambar`, `judul`, `deskripsi`, `urutan`, `created_at`, `updated_at`, `sumber`, `berita_id`, `is_hero`) VALUES
(6, 'sliders/JOXcd4biSQ6ejIY9WnYtxUtXp9NrGmXky2La3RCK.jpg', 'kursi', 'kursi', 0, '2026-02-25 19:58:01', '2026-02-25 19:58:01', 'manual', NULL, 0),
(8, NULL, NULL, NULL, 0, '2026-02-25 20:08:37', '2026-02-25 20:08:37', 'berita', 7, 0),
(9, 'sliders/LPqwsWjSpSwQdJNal2lpwypM2AFf7y0ACdm0LWAj.png', 'WEB RESMI SMAN 1 AMBARAWI', 'aaegasegsrhsesheshesehsehshshsez', 0, '2026-02-25 20:24:40', '2026-02-25 20:24:40', 'manual', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `spmb_links`
--

CREATE TABLE `spmb_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spmb_links`
--

INSERT INTO `spmb_links` (`id`, `judul`, `url`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Mandiri', 'https://docs.google.com/forms/d/e/1FAIpQLSeep8wUzlQ1nPBLmpMs5ksU2wpj73e0Jtck-4DR2v82u8AULg/viewform?usp=publish-editor', 'bi-link-45deg', 1, '2026-01-28 22:05:02', '2026-01-28 22:05:02'),
(3, 'Negeri', 'https://indramayu.demo.spmb.id/', 'bi-link-45deg', 1, '2026-01-28 23:27:02', '2026-02-03 00:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Sekolah', 'admin@sekolah.com', NULL, '$2y$12$CHlMgHpBFGuQRj2Fc/tAu.viex0Wx54/h4WFvzoS/vB10LDPoq6wO', 'admin', NULL, '2026-01-20 21:20:33', '2026-01-20 21:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `visis`
--

CREATE TABLE `visis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isi` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visis`
--

INSERT INTO `visis` (`id`, `isi`, `keterangan`, `gambar`, `created_at`, `updated_at`) VALUES
(3, 'Terwujudnya Peserta Didik yang ber-PRESTISE', '(Prestasi, Religius, Terampil, Intelek, Sopan, dan Estetis)', NULL, '2026-02-01 21:23:22', '2026-02-01 21:23:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agenda_sekolah`
--
ALTER TABLE `agenda_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `beritas_slug_unique` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `ekskul_galeries`
--
ALTER TABLE `ekskul_galeries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ekskul_galeries_ekskul_id_foreign` (`ekskul_id`);

--
-- Indexes for table `eskuls`
--
ALTER TABLE `eskuls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fasilitas_slug_unique` (`slug`);

--
-- Indexes for table `galeris`
--
ALTER TABLE `galeris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gurus`
--
ALTER TABLE `gurus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_pelajarans`
--
ALTER TABLE `jadwal_pelajarans`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `misis`
--
ALTER TABLE `misis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `profil_sekolahs`
--
ALTER TABLE `profil_sekolahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spmb_links`
--
ALTER TABLE `spmb_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visis`
--
ALTER TABLE `visis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agenda_sekolah`
--
ALTER TABLE `agenda_sekolah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `beritas`
--
ALTER TABLE `beritas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ekskul_galeries`
--
ALTER TABLE `ekskul_galeries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `eskuls`
--
ALTER TABLE `eskuls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `galeris`
--
ALTER TABLE `galeris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `gurus`
--
ALTER TABLE `gurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jadwal_pelajarans`
--
ALTER TABLE `jadwal_pelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `misis`
--
ALTER TABLE `misis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `profil_sekolahs`
--
ALTER TABLE `profil_sekolahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `spmb_links`
--
ALTER TABLE `spmb_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visis`
--
ALTER TABLE `visis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ekskul_galeries`
--
ALTER TABLE `ekskul_galeries`
  ADD CONSTRAINT `ekskul_galeries_ekskul_id_foreign` FOREIGN KEY (`ekskul_id`) REFERENCES `eskuls` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
