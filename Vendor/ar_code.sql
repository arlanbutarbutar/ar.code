-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Feb 2021 pada 15.50
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ar.code`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cal_days`
--

CREATE TABLE `cal_days` (
  `id_cal` int(11) NOT NULL,
  `income` int(11) NOT NULL,
  `expense` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` varchar(35) NOT NULL,
  `tgl_cari` date NOT NULL,
  `time` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cal_grafik`
--

CREATE TABLE `cal_grafik` (
  `id_grafik` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `jan` int(11) NOT NULL,
  `feb` int(11) NOT NULL,
  `mar` int(11) NOT NULL,
  `apr` int(11) NOT NULL,
  `may` int(11) NOT NULL,
  `jun` int(11) NOT NULL,
  `jul` int(11) NOT NULL,
  `aug` int(11) NOT NULL,
  `sep` int(11) NOT NULL,
  `oct` int(11) NOT NULL,
  `nov` int(11) NOT NULL,
  `dex` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cal_grafik`
--

INSERT INTO `cal_grafik` (`id_grafik`, `category`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `aug`, `sep`, `oct`, `nov`, `dex`) VALUES
(1, 'Income', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'Expense', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'DP', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'Sparepart', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cal_month`
--

CREATE TABLE `cal_month` (
  `id_montly` int(11) NOT NULL,
  `report` int(11) NOT NULL,
  `dp` int(11) NOT NULL,
  `spareparts` int(11) NOT NULL,
  `expense` int(11) NOT NULL,
  `date` varchar(35) NOT NULL,
  `tgl_cari` date NOT NULL,
  `time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_services`
--

CREATE TABLE `category_services` (
  `id_category` int(11) NOT NULL,
  `product` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `category_services`
--

INSERT INTO `category_services` (`id_category`, `product`) VALUES
(1, 'Handphone'),
(2, 'Laptop/PC'),
(3, 'Website'),
(4, 'not available');

-- --------------------------------------------------------

--
-- Struktur dari tabel `faq`
--

CREATE TABLE `faq` (
  `id_faq` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `date_time` varchar(35) NOT NULL,
  `is_active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `handphone`
--

CREATE TABLE `handphone` (
  `id_hp` int(11) NOT NULL,
  `akses` char(6) NOT NULL DEFAULT 'H4nS3r',
  `type` varchar(100) NOT NULL,
  `seri` varchar(100) NOT NULL DEFAULT '-',
  `imei` varchar(100) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_pengeluaran`
--

CREATE TABLE `laporan_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `jenis_pengeluaran` varchar(250) NOT NULL,
  `ket` text NOT NULL,
  `biaya_pengeluaran` text NOT NULL,
  `tgl_pengeluaran` varchar(35) NOT NULL,
  `tgl_cari` char(10) NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_spareparts`
--

CREATE TABLE `laporan_spareparts` (
  `id_sparepart` int(11) NOT NULL,
  `tgl_masuk` varchar(35) NOT NULL,
  `tgl_cari` varchar(15) NOT NULL,
  `time` varchar(15) NOT NULL,
  `ket` text NOT NULL,
  `suplayer` varchar(20) NOT NULL,
  `jmlh_barang` varchar(5) NOT NULL,
  `harga` text NOT NULL,
  `total` text NOT NULL,
  `ket_plus` varchar(100) NOT NULL DEFAULT '-',
  `id_pegawai` int(11) NOT NULL,
  `id_nota` varchar(12) NOT NULL,
  `barcode` varchar(35) NOT NULL,
  `status_sparepart` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laptop`
--

CREATE TABLE `laptop` (
  `id_laptop` int(11) NOT NULL,
  `akses` char(6) NOT NULL DEFAULT 'L4pS3r',
  `merek` varchar(50) NOT NULL DEFAULT '-',
  `seri` varchar(50) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `menu`) VALUES
(1, 'Menu Management'),
(5, 'Administrator'),
(6, 'Users'),
(8, 'Utilities'),
(9, 'Services'),
(10, 'Report'),
(11, 'Calculation'),
(16, 'Client Services');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_access`
--

CREATE TABLE `menu_access` (
  `id_access_menu` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu_access`
--

INSERT INTO `menu_access` (`id_access_menu`, `role_id`, `id_menu`) VALUES
(1, 1, 1),
(31, 1, 5),
(32, 1, 6),
(33, 1, 8),
(34, 1, 9),
(35, 1, 10),
(36, 1, 11),
(37, 2, 5),
(38, 2, 6),
(39, 2, 8),
(40, 2, 9),
(41, 2, 10),
(42, 2, 11),
(43, 3, 8),
(44, 3, 9),
(45, 3, 10),
(46, 4, 9),
(47, 5, 9),
(48, 6, 16),
(49, 3, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_status`
--

CREATE TABLE `menu_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu_status`
--

INSERT INTO `menu_status` (`id_status`, `status`) VALUES
(1, 'Active'),
(2, 'No Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_sub`
--

CREATE TABLE `menu_sub` (
  `id_sub_menu` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu_sub`
--

INSERT INTO `menu_sub` (`id_sub_menu`, `id_menu`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Menu', 'menu', 'fas fa-fw fa-bars', 1),
(2, 1, 'Sub Menu', 'sub-menu', 'fas fa-fw fa-file-code', 1),
(3, 1, 'Access Menu', 'access-menu', 'fas fa-fw fa-low-vision', 1),
(4, 1, 'Access Sub Menu', 'access-sub-menu', 'fas fa-fw fa-low-vision', 1),
(7, 5, 'Privacy Policy', 'privacy-policy', 'fas fa-user-secret fa-fw', 1),
(8, 5, 'Term Of Service', 'term-of-service', 'fab fa-slideshare fa-fw', 1),
(13, 6, 'Users', 'users', 'fas fa-fw fa-users', 1),
(22, 9, 'Nota Tinggal Or DP', 'nota-tinggal', 'fas fa-fw fa-notes-medical', 1),
(24, 9, 'Nota Lunas', 'nota-lunas', 'fas fa-fw fa-receipt', 1),
(25, 8, 'Setting Nota', 'setting-nota', 'fas fa-fw fa-tools', 1),
(26, 10, 'Day', 'report-day', 'fas fa-fw fa-calendar-day', 1),
(28, 10, 'Expense', 'report-expense', 'fas fa-fw fa-credit-card', 1),
(29, 10, 'Spareparts Belum Terpakai', 'report-spareparts', 'fas fa-fw fa-file-invoice-dollar', 1),
(30, 10, 'DP (Down Payment)', 'report-dp', 'fas fa-fw fa-file-invoice-dollar', 1),
(31, 11, 'Daily', 'cal-daily', 'fas fa-fw fa-calculator', 1),
(32, 11, 'Monthly', 'cal-monthly', 'fas fa-fw fa-calculator', 1),
(45, 10, 'Spareparts Dipakai', 'report-spareparts-pickup', 'fas fa-fw fa-file-invoice-dollar', 1),
(46, 10, 'Spareparts Diambil/Terpakai', 'report-spareparts-out', 'fas fa-fw fa-archive', 1),
(47, 10, 'Spareparts All', 'report-spareparts-all', 'fas fa-fw fa-clipboard-list', 1),
(49, 9, 'Nota Cancel', 'nota-cancel', 'fas fa-fw fa-file-excel', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_sub_access`
--

CREATE TABLE `menu_sub_access` (
  `id_access_sub_menu` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `id_sub_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu_sub_access`
--

INSERT INTO `menu_sub_access` (`id_access_sub_menu`, `role_id`, `id_sub_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(93, 1, 7),
(94, 1, 8),
(95, 1, 13),
(96, 1, 25),
(97, 1, 22),
(98, 1, 24),
(99, 1, 26),
(100, 1, 28),
(102, 1, 30),
(103, 1, 29),
(104, 1, 45),
(105, 1, 46),
(106, 1, 47),
(109, 1, 31),
(110, 1, 32),
(111, 2, 7),
(112, 2, 8),
(113, 2, 13),
(114, 2, 22),
(115, 2, 24),
(116, 2, 26),
(117, 2, 28),
(118, 2, 30),
(119, 1, 29),
(120, 2, 45),
(121, 2, 46),
(122, 2, 47),
(124, 3, 13),
(125, 3, 25),
(126, 3, 22),
(127, 3, 24),
(128, 3, 26),
(129, 3, 28),
(130, 3, 30),
(131, 3, 29),
(132, 3, 45),
(133, 3, 46),
(134, 4, 22),
(135, 4, 24),
(136, 1, 49),
(137, 2, 49),
(138, 3, 49),
(139, 4, 49);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notes`
--

CREATE TABLE `notes` (
  `id_data` int(11) NOT NULL,
  `id_nota` int(11) NOT NULL DEFAULT 1,
  `id_nota_tinggal` int(11) NOT NULL,
  `id_nota_dp` int(11) NOT NULL,
  `id_nota_Lunas` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_status` int(11) NOT NULL DEFAULT 1,
  `tgl_cari` varchar(15) NOT NULL DEFAULT '-',
  `tgl_masuk` varchar(35) NOT NULL DEFAULT '-',
  `tgl_lunas` varchar(35) NOT NULL DEFAULT '-',
  `tgl_laporan` varchar(35) NOT NULL DEFAULT '-',
  `tgl_cancel` varchar(35) NOT NULL DEFAULT '-',
  `tgl_status` varchar(35) NOT NULL DEFAULT '-',
  `tgl_ambil` varchar(35) NOT NULL DEFAULT '-',
  `kerusakan` varchar(100) NOT NULL,
  `kondisi` varchar(100) NOT NULL DEFAULT '-',
  `kelengkapan` text NOT NULL DEFAULT '-',
  `ket_text` text NOT NULL DEFAULT '-',
  `ket_img` varchar(100) NOT NULL DEFAULT 'default.png',
  `garansi` varchar(35) NOT NULL,
  `dp` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `pemasukan` int(11) NOT NULL,
  `barcode` varchar(100) NOT NULL DEFAULT 'error'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notes_status`
--

CREATE TABLE `notes_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `notes_status`
--

INSERT INTO `notes_status` (`id_status`, `status`) VALUES
(1, 'Pending'),
(2, 'Cancel'),
(3, 'On Progress'),
(4, 'Waiting to be taken'),
(5, 'Finish/Success'),
(6, 'Block');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notes_type`
--

CREATE TABLE `notes_type` (
  `id_nota` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `no_nota` int(11) NOT NULL,
  `kombinasi` varchar(10) NOT NULL,
  `date` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `notes_type`
--

INSERT INTO `notes_type` (`id_nota`, `name`, `no_nota`, `kombinasi`, `date`) VALUES
(1, 'Nota Tinggal', 23640, 'T', 'Friday, 09 Oct 2020'),
(2, 'Nota DP', 23459, 'DP', 'Friday, 09 Oct 2020'),
(3, 'Nota Lunas', 1278, 'L', 'Friday, 09 Oct 2020'),
(4, 'Nota Cancel', 0, 'C', '__'),
(5, 'Laporan Harian', 0, 'LH', '__'),
(6, 'Laporan DP', 0, 'LDP', '__');

-- --------------------------------------------------------

--
-- Struktur dari tabel `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id_pp` int(11) NOT NULL,
  `privacy_policy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `privacy_policy`
--

INSERT INTO `privacy_policy` (`id_pp`, `privacy_policy`) VALUES
(2, '<p class=\"text-justify\">Privacy Policy / Kebijakan Privasi ini menjelaskan komitmen di UGD HP Kota Kupang, NTT, Indonesia untuk privasi dari pengunjung dan pelanggan ke situs UGD HP berada di domain www.ugdhp.com. Kecuali seperti yang dipersyaratkan oleh hukum atau seperti yang tercantum di sini, UGD HP akan mengambil langkah-langkah yang wajar secara komersial untuk memastikan hak privasi Anda. UGD HP berkomitmen untuk mengembangkan hubungan jangka panjang yang dibangun atas dasar kepercayaan dan tidak akan pernah melanggar kepercayaan tersebut.</p>\r\n                        <h4 class=\"text-black-100 mt-5\">Siapakah UGD HP disini?</h4>\r\n                        <p class=\"text-justify\">UGD HP menyediakan layanan perbaikan handphone, laptop, dan penyedia jasa pembuatan website.</p>\r\n                        <h4 class=\"text-black-100 mt-5\">Informasi Yang Kami Kumpulkan</h4>\r\n                        <div class=\"row\">\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Informasi Pelanggan</h5>\r\n                                <p class=\"text-justify ml-3\">Pelanggan diminta untuk memberikan informasi pribadi tertentu ketika mendaftarkan layanan UGD HP termasuk nama, alamat email, nomor telepon, dan informasi penagihan (termasuk nomor kartu kredit). Selain itu, untuk pemesanan website, nama website  kepada kami, Pelanggan akan diminta untuk memberikan informasi ini untuk pendaftaran, kontak administratif, kontak teknis dan kontak penagihan dari nama website (secara kolektif, “Informasi Pendaftaran Nama Website”), untuk diserahkan ke developer yang dimana akan dilakuakan pengerjaan tingkat lanjut.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ SESSION untuk mengatur akun pelanggan</h5>\r\n                                <p class=\"text-justify ml-3\">Untuk pelanggan UGD HP, kami menggunakan SESSION untuk mengatur pelanggan mana yang boleh masuk di laman yang aman dan tidak. Kami akan secara kolektif untuk mengatur akun anda dengan secara rahasia dan tidak dapat diketahui oleh orang lain. Apa yang kami atur dengan SESSION merupakan keamanan kami dan juga privasi anda yang akan terjaga dengan aman di server kami.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Survey Pelanggan</h5>\r\n                                <p class=\"text-justify ml-3\">UGD HP secara berkala akan mengadakan survei pelanggan. Partisipasi dalam survei pelanggan kami adalah bersifat sukarela. Namun, kami mendorong Pelanggan untuk berpartisipasi dalam survei ini karena mereka memberikan UGD HP dengan informasi penting yang membantu meningkatkan jenis layanan yang kami miliki. Informasi pribadi Anda, jika disediakan akan tetap dirahasiakan, bahkan itu jika survei dilakukan oleh penyedia layanan pihak ketiga atas nama kami.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Website Berhubungan</h5>\r\n                                <p class=\"text-justify ml-3\">UGD HP mungkin menyediakan link ke beberapa situs web pihak ketiga sebagai bentuk penawaran. Namun harap tetap berhati-hati ketika mengunjungi situs terkait. Situs yang terhubung memiliki pernyataan privasi yang terpisah dan independen dari yang kami miliki, pemberitahuan dan persyaratan penggunaan yang kami sarankan Anda membaca dengan seksama. Ketika Anda mengunjungi atau melakukan pembelian melalui situs-situs pihak ketiga, Anda mungkin diminta untuk memberikan informasi pribadi, seperti nama, alamat, alamat email, nomor telepon, dan informasi kartu kredit / debit. Harap dicatat bahwa dalam kasus tersebut, Anda memberikan informasi kepada pihak ketiga dan UGD HP tidak memiliki kontrol apapun atas penggunaan data dari pihak ketiga tersebut dari informasi yang Anda berikan dan UGD HP tidak akan memberikan informasi pribadi Anda kepada pihak ketiga tanpa persetujuan dari Anda.</p>\r\n                            </div>\r\n                        </div>\r\n                        <h4 class=\"text-black-100 mt-5\">Penggunaan Informasi</h4>\r\n                        <p class=\"text-justify\">UGD HP menggunakan informasi yang dikumpulkan terutama untuk memberikan dan mengumpulkan pembayaran untuk solusi berbasis cloud dan layanan lainnya. Informasi yang dikumpulkan secara pasif, seperti informasi yang dikumpulkan dari atau tentang perangkat Anda, termasuk melalui penempatan atau membaca cookie dengan teknologi pelacakan lain digunakan untuk memberikan pengalaman yang disesuaikan, sebagai penggunakan layanan UGD HP.</p>\r\n                        <div class=\"row\">\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Data Kontak atau Informasi Pelanggan</h5>\r\n                                <p class=\"text-justify ml-3\">Informasi yang dikumpulkan dari Pelanggan, digunakan untuk mengelola account setiap Pelanggan (seperti untuk tujuan penagihan dan manajemen akun) dan untuk mempromosikan produk atau jasa lain yang bahwa kami percaya mungkin Anda akan tertarik. UGD HP juga dapat mengidentifikasi dari informasi yang Pelanggan sediakan saat melakukan pendaftaran (seperti jumlah total Pelanggan dalam kategori tertentu, tetapi tidak dengan nama mereka). Seperti dijelaskan lebih rinci di bawah, INDOWEBSITE mungkin dalam kasus tertentu menggunakan informasi agregat dan non-identifikasi ini untuk mempromosikan iklan yang muncul di website INDOWEBSITE yang berhubungan dengan layanan. Informasi tersebut dikumpulkan dan non-mengidentifikasi bahwa INDOWEBSITE akan mengumpulkan, dan menganalisis setiap informasi yang dihasilkan.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Analytics atau Statistik</h5>\r\n                                <p class=\"text-justify ml-3\">UGD HP menggunakan informasi yang dikumpulkan dari analisis website (misalnya, alamat IP Pengguna) untuk membantu mendiagnosa masalah dengan server UGD HP, dan untuk mengelola serta mengoptimalkan situs UGD HP. Kami juga mengumpulkan informasi demografis yang luas dari data yang dihasilkan untuk membantu meningkatkan situs web dan memberikan pengalaman browsing dan pembelian Anda yang lebih responsif, efisien, atau menyenangkan. Setiap statistik yang dikumpulkan dari situs kami adalah eksklusif milik UGD HP.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Tanggapan Email Pertanyaan</h5>\r\n                                <p class=\"text-justify ml-3\">Ketika Pelanggan mengirimkan pertanyaan melalui email ke UGD HP, alamat email penjawaban (dan informasi pribadi lain yang disediakan dalam penyelidikan) digunakan untuk menjawab pertanyaan email yang kami terima.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Survey Pelanggan</h5>\r\n                                <p class=\"text-justify ml-3\">UGD HP dapat menggunakan informasi kontak yang disediakan dalam survei pelanggan untuk menindaklanjuti jawaban survei. UGD HP juga dapat menghubungi Anda untuk menyoroti perubahan UGD HP dalam menanggapi umpan balik Anda.</p>\r\n                            </div>\r\n                        </div>\r\n                        <h4 class=\"text-black-100 mt-5\">Penggunaan Informasi</h4>\r\n                        <div class=\"row\">\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Kerahasiaan</h5>\r\n                                <p class=\"text-justify ml-3\">UGD HP tidak akan memberikan atau menjual kepada pihak ketiga tentang apapun informasi pribadi Anda dan akan menyimpan semua informasi pelanggan dengan sangat rahasia.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Penyedia Jasa</h5>\r\n                                <p class=\"text-justify ml-3\">Setelah melakukan pendaftaran layanan UGD HP, informasi pelanggan tertentu dapat ditransfer ke pihak ketiga yang membantu UGD HP menyediakan layanan tertentu. Misalnya, informasi Pelanggan dapat ditransfer ke registrar berhubungan dengan UGD HP.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Aktifitas Co-Marketing</h5>\r\n                                <p class=\"text-justify ml-3\">Beberapa layanan yang ditawarkan atau dipromosikan dalam hubungan dengan mitra UGD HP atau sponsor. Misalnya, UGD HP mungkin bermitra dengan afiliasi perusahaan lain atau dengan mitra terpercaya non-afiliasi untuk co-promosi dari produk atau jasa tertentu. UGD HP dapat berbagi informasi kontak pelanggan tertentu, tetapi tidak untuk informasi penagihan atau yang bersifat kerahasiaan. Sponsor dalam rangka memberikan layanan yang relevan atau untuk menjalankan promosi. Jika informasi saham pelanggan UGD HP dengan mitra dan sponsor, UGD HP mengharuskan menjaga kepercayaan pelanggan, dan penggunaan informasi ini semata-mata untuk tujuan menyediakan jasa atau melaksanakan promosi yang telah disepakati.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Iklan Online</h5>\r\n                                <p class=\"text-justify ml-3\">UGD HP tidak berbagi informasi pribadi pengguna secara individu dengan pengiklan. UGD HP mungkin menampilkan iklan online dan berbagi non-identified informasi tentang Pelanggan yang dikumpulkan melalui proses pendaftaran atau melalui survei online dan promosi terhadap pengiklan tertentu. Ini dikumpulkan dan informasi yang bersifat non-indentified dapat digunakan untuk mengirim iklan yang disesuaikan. Misalnya, pengiklan dapat memberitahu UGD HP tentang viewers website (misalnya, laki-laki antara 25 dan 55 tahun) dan menyediakan UGD HP dengan iklan yang disesuaikan dengan viewers tersebut. Berdasarkan informasi non-identified dikumpulkan oleh UGD HP, kami mungkin kemudian akan menampilkan iklan kepada audiens yang dituju.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Survey Pelanggan</h5>\r\n                                <p class=\"text-justify ml-3\">Selain berbagi informasi survei dengan penyedia layanan seperti dijelaskan di atas, UGD HP dapat berbagi informasi yang diperoleh dari survei pelanggan dalam lingkup perusahaan atau dengan pihak ketiga yang dipercaya UGD HP.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Penegakan Hukum</h5>\r\n                                <p class=\"text-justify ml-3\">UGD HP akan menanggapi panggilan dari pengadilan, perintah pengadilan, atau proses hukum lainnya, dan akan menggunakan informasi Pelanggan yang diperlukan untuk membangun atau menggunakan hak hukum UGD HP atau membela terhadap klaim hukum yang dilakukan. Selain itu, UGD HP akan berbagi informasi kepada penyidik untuk menyelidiki, mencegah, atau mengambil tindakan terkait dengan aktivitas ilegal, dugaan penipuan, situasi yang melibatkan potensi ancaman terhadap keselamatan fisik seseorang, pelanggaran atau dugaan pelanggaran Syarat dan Ketentuan UGD HP tentang Layanan Kami, atau seperti yang dipersyaratkan oleh hukum yang berlaku di Indonesia.</p>\r\n                            </div>\r\n                        </div>\r\n                        <h4 class=\"text-black-100 mt-5\">Pilihan Anda</h4>\r\n                        <div class=\"row\">\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Public Terbuka</h5>\r\n                                <p class=\"text-justify ml-3\">Harap diingat bahwa setiap informasi yang Anda bagikan atau posting di forum atau tempat umum selain dari situs UGD HP, sehingga menjadi informasi publik. Anda harus berhati-hati ketika memutuskan untuk melakukan hal tersebut. Untuk request penghapusan informasi pribadi Anda dari situs web kami. Dalam beberapa kasus, UGD HP mungkin tidak dapat menghapus informasi pribadi Anda, dalam hal ini UGD HP akan memberitahukan kepada Anda.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Unsuscribe</h5>\r\n                                <p class=\"text-justify ml-3\">Ketika Anda menjadi Pelanggan UGD HP, Anda secara otomatis berlangganan untuk menerima pemberitahuan transaksional tentang akun Anda, newsletter email dan berita promosi khusus yang ditawarkan melalui UGD HP dan / atau dalam hubungannya dengan mitra UGD HP.Untuk berhenti berlangganan dari UGD HP newsletter dan promosi, perbarui preferensi Anda di control panel pelanggan area UGD HP atau hubungi support kami.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h5>_ Cara Akses Dan Perbaharui Kontak Anda</h5>\r\n                                <p class=\"text-justify ml-3\">UGD HP memungkinkan Anda untuk mengakses, dan memperbarui informasi pribadi Anda dalam tatanan UGD HP, tunduk pada pengecualian tertentu yang ditentukan oleh hukum. Anda bisa mengakses, memperbarui dan koreksi ketidakakuratan informasi pribadi Anda pada kami dengan mengakses pelanggan area UGD HP.</p>\r\n                            </div>\r\n                        </div>\r\n                        <h4 class=\"text-black-100 mt-5\">Anak Usia dibawah 12 Tahun</h4>\r\n                        <p class=\"text-justify\">Website ini tidak ditujukan untuk anak-anak dan UGD HP tidak berusaha untuk mengumpulkan informasi pribadi dari anak-anak. Jika UGD HP menjadi sadar bahwa informasi pribadi dari anak di bawah usia 12 telah dikumpulkan, UGD HP akan menggunakan semua upaya yang wajar untuk menghapus informasi tersebut dari database kami.</p>\r\n                        <h4 class=\"text-black-100 mt-5\">Keamanan Data</h4>\r\n                        <p class=\"text-justify\">Enkripsi Data. Ketika akses pelanggan dari dan ke UGD HP, transmisi data pribadi anda dienkripsi dan semua informasi pribadi pelanggan dilindungi. UGD HP menggunakan Secure Sockets Layer (SSL), standar industri, untuk mengenkripsi semua informasi pribadi, termasuk nama, alamat dan nomor kartu kredit.</p>\r\n                        <h4 class=\"text-black-100 mt-5\">Revisi Kebijakan Ini</h4>\r\n                        <p class=\"text-justify\">UGD HP berhak untuk merevisi, mengubah, atau memodifikasi Kebijakan Privasi ini kapanpun.</p>\r\n                        <div class=\"row\">\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <p class=\"text-justify ml-3\">\r\n                                    Hubungi Kami Terkait Kebijakan Ini<br>\r\n                                    Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini atau yang dijelaskan di sini, Anda dapat menghubungi:<br>\r\n                                    ATTN: UGD HP<br>\r\n                                    Alamat:\r\n                                    Jln. W.J Lalamentil no.95 (UGD HP), Kota kupang, Nusa Tenggara Timur, Indonesia<br>\r\n                                    E-mail: ugdhpcode27@gmail.com\r\n                                </p>\r\n                            </div>\r\n                        </div>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `report_problem`
--

CREATE TABLE `report_problem` (
  `id` int(11) NOT NULL,
  `problem_message` text NOT NULL,
  `date` varchar(35) NOT NULL,
  `tgl_cari` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `report_problem`
--

INSERT INTO `report_problem` (`id`, `problem_message`, `date`, `tgl_cari`) VALUES
(1, 'system mulai membaik!', 'Friday, 05 Feb 2021', '2021-02-05'),
(2, 'System mulai berjalan baik', 'Friday, 05 Feb 2021', '2021-02-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_spareparts`
--

CREATE TABLE `status_spareparts` (
  `id_status` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status_spareparts`
--

INSERT INTO `status_spareparts` (`id_status`, `status`) VALUES
(1, 'Stock'),
(2, 'Terpakai'),
(3, 'Diambil/Keluar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `term_of_service`
--

CREATE TABLE `term_of_service` (
  `id_term` int(11) NOT NULL,
  `term_of_service` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `term_of_service`
--

INSERT INTO `term_of_service` (`id_term`, `term_of_service`) VALUES
(2, '<p class=\"text-justify\">Calon pelanggan UGD HP wajib membaca dan memahami perjanjian berikut ini sebelum memutuskan untuk menggunakan layanan UGD HP. Sebaliknya, pelanggan akan tetap menyetujui perjanjian ini selama menjadi pelanggan, termasuk penggantinya atau yang diijinkan menggantikannya.<br>\r\n                        Perjanjian ini dibuat sedemikian rupa demi kepentingan bersama, juga demi keamanan dan keleluasaan pelanggan dalam menggunakan produk/layanan UGD HP. Perjanjian ini juga telah dilampirkan pada Form Pemesanan UGD HP dan harus disetujui oleh pelanggan. Dokumen ini dapat berubah sewaktu-waktu sesuai kebutuhan. Term Of Services ini merupakan satu kesatuan.</p>\r\n                        <h4 class=\"text-black-100 mt-5\">KONDISI BERLAKU</h4>\r\n                        <p class=\"text-justify\">Term Of Services Agreement ini berlaku antara UGD HP dan Pelanggan UGD HP yang tertera pada database pelanggan UGD HP atau penggantinya yang telah disetujui perubahan datanya.</p>\r\n                        <h4 class=\"text-black-100 mt-5\">KEWAJIBAN PELANGGAN</h4>\r\n                        <p class=\"text-justify\">Semua pelanggan UGD HP Berkewajiban untuk:</p>\r\n                        <div class=\"row\">\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <p class=\"text-justify ml-3\">\r\n                                    1. Membaca, memahami dan menyetujui Term Of Services UGD HP.<br>\r\n                                    2. Menggunakan Identitas Asli dan masih berlaku.<br>\r\n                                    3. Mendaftarkan alamat e-mail yang masih berfungsi (dapat menerima email dengan baik) ke database pelanggan UGD HP, berhubung alamat email tersebut akan digunakan untuk informasi account Anda, penagihan, pengumuman dan pemberitahuan lainnya. Apabila dikemudian hari pelanggan mengganti alamat emailnya, pelanggan diwajibkan untuk meng-update alamat emailnya sendiri ke database pelanggan UGD HP.<br>\r\n                                    4. Mematuhi semua peraturan atau instruksi yang diberikan oleh UGD HP setiap waktu yang berhubungan dengan penggunaan layanan, agar website pelanggan tetap exist dan dapat diakses dengan baik. Misalnya e-mail pengumuman tentang perubahan alamat DNS, kontak, perpindahan server atau instruksi lainnya mengenai jasa pembuatan website kami.<br>\r\n                                    5. Membayar tepat waktu atas service yang pelanggan pesan selambat-lambatnya pada due-date yang tertera pada invoice.<br>\r\n                                    6. Membayar sesuai dengan harga yang telah ditetapkan sebagai Layanan Tambahan / service addon Pengiriman Dokumen (Bukti Invoice Fisik Bermaterai, Faktur Pajak, dsb) pengiriman invoice bermaterai dikenakan biaya sebesar Rp. 30.000 untuk seluruh wilayah Republik Indonesia. Apabila menghendaki dokumen yang diperlukan dikirimkan ke alamat anda. Jika kemudian ditemukan Pelanggan UGD HP tidak melakukan pembayaran sesuai invoice dan konfirmasi pembayaran dan pembayaran tersebut terbaca oleh Support UGD HP sebagai pembayaran invoice pelanggan lain, maka UGD HP BERHAK UNTUK TIDAK MEMBERIKAN ganti rugi dalam bentuk apapun. Setiap pengiriman dokumen yang diminta oleh pelanggan dan ditanda tangani oleh UGD HP, semua biaya pengiriman sepenuhnya ditanggung pelanggan. Pada saat melakukan transfer pelanggan/calon pelanggan di harapkan mengisi nomor invoice di berita acara atau keterangan transfer. Pembayaran juga dapat melalui Kartu Kredit (Credit Card), yang mana dilakukan melalui Payment Gateway pihak ketiga. Keputusan Penangguhan, Persetujuan ataupun Penolakan pembayaran bergantung pada kebijakan Payment Gateway.<br>\r\n                                    7. Mengirimkan konfirmasi setelah melakukan pembayaran serta menerangkan keperluan pembayarannya. Pelanggan harus mengisi Standard Konfirmasi Pembayaran (Non Payment Gateway), yaitu melalui Website UGD HP seperti yang telah diberitahukan melalui reply email pengisian order form pendaftaran website. Konfirmasi pembayaran bisa di lakukan dengan cara :<br>\r\n                                    - Mengisi form konfirmasi pembayaran untuk layanan handphone, laptop dan jasa pembuatan website.<br>\r\n                                    - Melakukan konfirmasi melalui VIA WhatsApp atau Email pada contact yang tertera di website hanya untuk jasa pembuatan website.<br>\r\n                                    - Mengirim konfirmasi pembayaran melalui CS kami di Contact Service hanya untuk jasa pembuatan website.<br>\r\n                                    8. Bila dalam selang waktu 1 s/d 3 hari pembayaran yang telah Anda lakukan belum kami proses, mohon Anda segera memberitahukan kepada kami. Pembayaran yang tidak di isi nomor invoice pada keterangan transfer dan tidak melakukan konfirmasi pembayaran maka dana akan kami biarkan dan akan kami proses setelah kami mendapatkan konfirmasi pembayaran.<br>\r\n                                    9. Melakukan verifikasi pada email terdaftar untuk mengkonfirmasi bahwa website anda bebas dari penggunaan abuse oleh pihak registry. Kami tidak bertanggung jawab apabila website akan tersuspend oleh pihak registry jika tidak melakukan verifikasi dalam waktu lebih dari 1 minggu setelah email verifikasi dikirimkan.<br>\r\n                                    10. Bertanggung jawab untuk memperoleh dengan biaya sendiri, semua lisensi, ijin-ijin, persetujuan, dan hak milik intelektual atau hak-hak lainnya yang mungkin diperlukan untuk menggunakan Layanan tersebut.\r\n                                    11. Bertanggung jawab untuk semua informasi yang diambil, disimpan, dan dikirimkan oleh pelanggan melalui layanan.<br>\r\n                                    12. Bertanggung jawab untuk mengatur penggunaan kapasitas penyimpanan yang disediakan sehingga tidak melebihi kapasitas yang sudah dialokasikan untuknya.<br>\r\n                                    13. Mentaati peraturan dan ketentuan yang telah berlaku dan akan berlaku di UGD HP. Hal-hal yang belum ditetapkan di halaman ini akan ditetapkan di lain waktu.<br>\r\n                                    14. UGD HP tidak bertanggung jawab apabila terdapat kesalahan aktivasi yang dikarenakan pelanggan melakukan kesalahan penulisan nama website / nomor invoice pada saat konfirmasi pembayaran baik melalui Form Konfirmasi Pembayaran, VIA WhatsApp maupun Contact Service.<br>\r\n                                    15. Nama website yang sudah aktif setelah proses aktivasi tidak dapat di batalkan dan dana tidak dapat di refund atau dikembalikan.<br>\r\n                                    16. UGD HP tidak bertanggung jawab apabila nama website yang sudah di pesan ternyata sudah dimiliki oleh orang lain.<br>\r\n                                    17. Jika pelanggan membutuhkan Faktur Pajak silahkan dapat konfirmasikan terlebih dahulu pada email kami netmedia2708@gmail.com diharuskan melampirkan scan NPWP perusahaan/instansi untuk keperluan pembuatan faktur pajak dan invoice. Diwajibkan melampirkan Purchase Order (PO) jika pelanggan belum melakukan pembayaran namun membutuhkan Faktur Pajak.\r\n                                </p>\r\n                            </div>\r\n                        </div>\r\n                        <h4 class=\"text-black-100 mt-5\">SISTEM KEANGGOTAAN DAN BERLANGGANAN</h4>\r\n                        <h5 class=\"text-black-100 mt-3\">Ketentuan Khusus</h5>\r\n                        <p class=\"text-justify\">\r\n                            <div style=\"font-weight: 700\">Masa Kontrak:</div> Pelanggan menyetujui untuk mengikuti masa kontrak untuk jasa pembuatan website yang disediakan oleh UGD HP yaitu, 1 Bulan, 3 Bulan, 6 Bulan, 1 Tahun, 2 Tahun dan 3 Tahun.<br>\r\n                            <div style=\"font-weight: 700\">Tagihan:</div> Tagihan (Invoice) akan dikirimkan 60 hari sebelum jatuh tempo (Untuk pelanggan dengan masa kontrak 1 Tahun) dan 7 hari sebelum jatuh tempo (Untuk pelanggan dengan masa kontrak dibawah atau sama dengan 3 bulan). Pelanggan wajib melunasi tagihan sebelum tanggal jatuh tempo yang tertera di Invoice. Tanggal terbit invoice adalah sah dan berlaku sebagai perpanjangan masa layanan dengan jumlah tagihan sesuai dengan invoice yang telah diterbitkan yang tidak dapat diganggu gugat. *) Semua harga produk yang kami tampilkan pada halaman website belum termasuk tambahan biaya PPN sebesar 10% sebagai kewajiban terhadap negara.<br>\r\n                            <div style=\"font-weight: 700\">Pendaftaran :</div> Pelanggan yang melakukan pendaftaran wajib mengisi formulir yang telah di sediakan secara Online, atau bisa dengan bantuan Operator kami. Pelanggan bertanggung jawab sepenuhnya atas keabsyahan pengisian data dan tidak akan membebankan tanggung jawab ke pihak UGD HP jika ada kesalahan pengisian data seperti kesalahan ejaan nama website, dan sebagainya.<br>\r\n                            Pelanggan yang melakukan pendaftaran adalah orang atau badan hukum atau organisasi, namun tetap harus mencantumkan nama penanggung jawab dan nomor telepon/email yang bisa di hubungi.<br>\r\n                            <div style=\"font-weight: 700\">Suspensi :</div> Suspensi atau penonaktifan layanan akan dilakukan 1 hari setelah tagihan jatuh tempo. Pelanggan bisa mengaktifkan layanan kembali setelah melakukan pembayaran tagihan.<br>\r\n                            <div style=\"font-weight: 700\">Terminasi :</div> Terminasi atau penghapusan layanan dari sistem kami akan dilakukan 14 hari setelah tagihan jatuh tempo. Pelanggan masih bisa mengaktifkan layanan selama data backup akun anda masih tersedia dengan membayar tagihan dan Biaya Restorenya. Pelanggan setuju untuk tidak menuntut UGD HP apabila ternyata data backup sudah terhapus dari sistem backup kami.<br>\r\n                            <div style=\"font-weight: 700\">Penghapusan Data Permanen :</div> UGD HP akan menghapus data server secara permanen dari server backup apabila pelanggan belum melunasi tagihannya. Jika pelanggan ingin mengaktifkan websitenya kembali, maka status websitenya akan sama dengan pendaftaran baru.<br>\r\n                            <div style=\"font-weight: 700\">Pembayaran :</div> Pembayaran dapat melalui Kartu Kredit (Credit Card), yang mana dilakukan melalui Payment Gateway pihak ketiga. Keputusan Penangguhan, Persetujuan ataupun Penolakan pembayaran bergantung pada kebijakan Payment Gateway.<br>\r\n                        </p>\r\n                        <h5 class=\"text-black-100 mt-3\">Pengalihan atau Pemindah Tangan Pelanggan</h5>\r\n                        <p class=\"text-justify\">\r\n                            1. Pelanggan yang terdaftar baik atas nama orang ataupun perusahaan / Organisasi. Dapat memindahkan / mengganti data pelanggan langsung melalui halaman pelanggan area.<br>\r\n                            2. UGD HP berhak untuk menonaktifkan layanan secara sementara atau permanen apabila perubahan data pelanggan dianggap tidak sesuai atau tidak Valid.<br>\r\n                            3. UGD HP berhak untuk menanyakan data yang valid berupa nama penanggung jawab, email aktif, telepon atau alamat surat menyurat.<br>\r\n                            4. Apabila ada perubahan data dikarenakan pelanggan lama sudah tidak bekerja/mengundurkan diri atau tidak bisa di hubungi, pelanggan harus menyerahkan legalitas perusahaan (SIUP, Akta Notaris, NPWP Perusahaan), surat pernyataan bermaterai diatas kop surat perusahaan disertai Foto Copy KTP yang dikirimkan ke alamat kantor UGD HP ataupun email, kemudian kami proses dalam 3×24 jam untuk dapat mengontak ke pihak pendaftar pertama kali. Jika pihak pendaftar tidak dapat kami hubungi dalam 7×24 jam, baik melalui telepon ataupun email, maka kami akan alihkan langsung kepada pemohon (Perusahaan) sesuai dengan data yang di submit dan tervalidasi.<br>\r\n                            5. UGD HP tidak bertanggung jawab terhadap perselisihan antara pelanggan dan pemilik website, dalam hal ini kami tetap akan memberikan layanan kepada pendaftar yang tertera di Database kami, atau pelanggan yang sudah memberikan surat pernyataan.\r\n                        </p>\r\n                        <h5 class=\"text-black-100 mt-3\">Perjanjian Layanan</h5>\r\n                        <div class=\"row\">\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h6 style=\"font-weight: 700\">Layanan Handphone</h6>\r\n                                <p class=\"text-justify ml-3\">UGD HP memberikan layanan perbaikan sesuai dengan kerusakan HP pada saat proses status Pending berlangsung. UGD HP pun berhak membatalkan perbaikan apabila di rasa tidak dapat mengerjakan perbaikan karena satu dan lain hal. Apabila status barang telah di berubah On Progress, maka pelanggan tidak berhak untuk membatalkan perbaikan yang sedang berlangsung.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h6 style=\"font-weight: 700\">Laptop</h6>\r\n                                <p class=\"text-justify ml-3\">UGD HP memberikan layanan perbaikan sesuai dengan kerusakan Laptop pada saat proses status Pending berlangsung. UGD HP pun berhak membatalkan perbaikan apabila di rasa tidak dapat mengerjakan perbaikan karena satu dan lain hal. Apabila status barang telah di berubah On Progress, maka pelanggan tidak berhak untuk membatalkan perbaikan yang sedang berlangsung.</p>\r\n                            </div>\r\n                            <div class=\"col-md-12 text-justify\">\r\n                                <h6 style=\"font-weight: 700\">Web Aplications</h6>\r\n                                <p class=\"text-justify ml-3\">UGD HP memberikan layanan pembuatan website dimana merupakan layanan dari pihak ketiga dengan bekerja sama dengan UGD HP. Untuk Ketentuan Layanan ini kami sepakat untuk menyamakannya. Jika pihak ketiga merasa ada perlu perombakan Ketentuan ini maka pihak ketiga berhak merubah yang ada, dan masih dalam batas hukum yang berlaku di Indonesia.</p>\r\n                            </div>\r\n                        </div>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `data_encrypt` int(11) NOT NULL,
  `img` varchar(50) NOT NULL DEFAULT 'default.png',
  `first_name` varchar(50) NOT NULL DEFAULT '-',
  `last_name` varchar(50) NOT NULL DEFAULT '-',
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_category` int(11) NOT NULL DEFAULT 4,
  `phone` varchar(13) NOT NULL DEFAULT '+62',
  `address` varchar(200) NOT NULL DEFAULT '-',
  `postal` varchar(15) NOT NULL DEFAULT '-',
  `kebijakan` varchar(15) NOT NULL DEFAULT 'AGREE',
  `id_role` int(11) NOT NULL DEFAULT 7,
  `is_active` int(2) NOT NULL DEFAULT 2,
  `id_access` int(11) NOT NULL DEFAULT 3,
  `date_created` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `data_encrypt`, `img`, `first_name`, `last_name`, `email`, `password`, `id_category`, `phone`, `address`, `postal`, `kebijakan`, `id_role`, `is_active`, `id_access`, `date_created`) VALUES
(1, 1816629144, '3398552288.jpg', 'Developer', 'UGD HP', 'developer@gmail.com', '$2y$10$IeFPzaeKOrNgH2.4ajQtB.ws0ia3yWzjbOxU3me6ofsLRzE49wgdC', 4, '08113827421', 'Jln W.J Lalamentik no.95(UGD HP)', '85111', 'SETUJU', 1, 1, 1, 'Sunday, 31 Jan 2021'),
(2, 2147483647, 'default.png', 'Administrasi', 'UGD HP', 'administrasi@gmail.com', '$2y$10$yaK6dCMMj.4zkhYpfnOsm.bzpZA0RwKWnSxim0tpXrXxczYqhvSFa', 4, '+62', '-', '-', 'SETUJU', 3, 1, 2, 'Thursday, 04 Feb 2021'),
(3, 1816629145, 'default.png', 'Founder', 'UGD HP', 'founder@gmail.com', '$2y$10$.0Vij31CzQFZD4flbALU1.GvsPvDnvhZnn3DL7rLokLQSatNhPD/K', 4, '+62', '-', '-', 'SETUJU', 2, 1, 1, 'Friday, 05 Feb 2021'),
(7, 1816629147, 'default.png', 'Technician', 'UGD HP', 'technician@gmail.com', '$2y$10$PXqlupVWi1KMzlb5.eATMunWPSsBsZ5EoO1oN5u3FvEm4gZONtSa2', 4, '+62', '-', '-', 'SETUJU', 4, 1, 2, 'Saturday, 06 Feb 2021'),
(8, 1816629148, 'default.png', 'Web Dev/Des', 'UGD HP', 'webdevndes@gmail.com', '$2y$10$vththZXk9vrclfLsrd4egeKjxHywxFaiuemQuhidJxRFkL2xFUV1q', 4, '+62', '-', '-', 'SETUJU', 5, 1, 2, 'Saturday, 06 Feb 2021'),
(9, 1816629149, 'default.png', 'Web Client Services', 'UGD HP', 'clientservices@gmail.com', '$2y$10$Ap7mh/vBLKXhKOts1Bb4kupJy13zysxbG7z.6r3fy9c43r/sW/J5W', 4, '+62', '-', '-', 'SETUJU', 6, 1, 3, 'Saturday, 06 Feb 2021');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_access`
--

CREATE TABLE `users_access` (
  `id_access` int(11) NOT NULL,
  `access` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_access`
--

INSERT INTO `users_access` (`id_access`, `access`) VALUES
(1, 'Full Access'),
(2, 'Standart User Access'),
(3, 'Visitor Access');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_help`
--

CREATE TABLE `users_help` (
  `id_help` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `help_message` text NOT NULL,
  `answer` text NOT NULL DEFAULT 'Segera dibalas!',
  `date` varchar(35) NOT NULL,
  `tgl_cari` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_help`
--

INSERT INTO `users_help` (`id_help`, `id_user`, `help_message`, `answer`, `date`, `tgl_cari`) VALUES
(1, 2, 'saya ingin coba krim pesan bantuan ini saja, apakah bisa atau gagal.', 'jika pesan balasan berhasil terbalas maka berhasil', '0000-00-00', '2021-02-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_log`
--

CREATE TABLE `users_log` (
  `id` int(11) NOT NULL,
  `id_log` int(20) NOT NULL,
  `log` text NOT NULL,
  `date` varchar(35) NOT NULL,
  `time` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_log`
--

INSERT INTO `users_log` (`id`, `id_log`, `log`, `date`, `time`) VALUES
(1, 1, 'Ubah email dari arlan270899@gmail.com menjadi email baru putriraki240800@gmail.com.', 'Thursday, 04 Feb 2021', '16:25:55'),
(2, 1, 'Ubah email dari putriraki240800@gmail.com menjadi email baru arlan270899@gmail.com.', 'Thursday, 04 Feb 2021', '16:33:51'),
(3, 1, 'Ubah biodata diri menjadi Putri Raki, nomor handphone 08113827421, alamat Liliba, kode pos 85111.', 'Thursday, 04 Feb 2021', '16:39:13'),
(4, 1, 'Ubah biodata diri menjadi Arlan Butar Butar, nomor handphone 08113827421, alamat Jln W.J Lalamentik no.95(UGD HP), kode pos 85111.', 'Thursday, 04 Feb 2021', '16:39:39'),
(5, 2, 'Mengirimkan pesan help kepada Client Service UGD HP', 'Friday, 05 Feb 2021', '3:17:09'),
(6, 1, 'Membalas help dengan id help #1', 'Friday, 05 Feb 2021', '3:32:16'),
(7, 1, 'Menambahkan report a problem: system mulai membaik!', 'Friday, 05 Feb 2021', '4:00:35'),
(8, 1, 'Menambahkan report a problem: system mulai membaik!', 'Friday, 05 Feb 2021', '4:01:42'),
(9, 1, 'Menambahkan report a problem: System mulai berjalan baik', 'Friday, 05 Feb 2021', '4:01:59'),
(10, 1, 'Menambahkan menu menejemen baru', 'Friday, 05 Feb 2021', '9:49:43'),
(11, 1, 'Mengubah nama menu dari tes menjadi tesapa', 'Friday, 05 Feb 2021', '10:51:39'),
(12, 1, 'Menghapus menu tesapa', 'Friday, 05 Feb 2021', '10:53:13'),
(13, 1, 'Menambahkan sub menu dengan nama tes', 'Friday, 05 Feb 2021', '12:20:46'),
(14, 1, 'Mengedit sub menu dengan nama tesapa', 'Friday, 05 Feb 2021', '17:13:36'),
(15, 1, 'Menghapus sub menu dengan nama tesapa', 'Friday, 05 Feb 2021', '17:14:48'),
(16, 1, 'Menghapus sub menu dengan nama Laporan Spearpart Lama', 'Friday, 05 Feb 2021', '17:18:38'),
(17, 1, 'Menghapus sub menu dengan nama Nota Tinggal', 'Friday, 05 Feb 2021', '17:19:49'),
(18, 1, 'Menghapus sub menu dengan nama Nota DP', 'Friday, 05 Feb 2021', '17:19:56'),
(19, 1, 'Menghapus sub menu dengan nama Nota Cancel', 'Friday, 05 Feb 2021', '17:20:10'),
(20, 1, 'Menghapus sub menu dengan nama Laporan Harian', 'Friday, 05 Feb 2021', '17:20:33'),
(21, 1, 'Menghapus sub menu dengan nama Nota Lunas', 'Friday, 05 Feb 2021', '17:20:42'),
(22, 1, 'Menghapus sub menu dengan nama Laporan Pengeluaran', 'Friday, 05 Feb 2021', '17:20:49'),
(23, 1, 'Menghapus sub menu dengan nama Laporan Spearpart', 'Friday, 05 Feb 2021', '17:20:58'),
(24, 1, 'Menghapus sub menu dengan nama Laporan Down Payment', 'Friday, 05 Feb 2021', '17:21:04'),
(25, 1, 'Menghapus sub menu dengan nama Controller', 'Friday, 05 Feb 2021', '17:22:25'),
(26, 1, 'Menghapus sub menu dengan nama Security', 'Friday, 05 Feb 2021', '17:22:29'),
(27, 1, 'Menghapus sub menu dengan nama UI', 'Friday, 05 Feb 2021', '17:22:33'),
(28, 1, 'Menghapus sub menu dengan nama Databases', 'Friday, 05 Feb 2021', '17:22:39'),
(29, 1, 'Menghapus sub menu dengan nama Users Local', 'Friday, 05 Feb 2021', '17:23:06'),
(30, 1, 'Menghapus sub menu dengan nama Employee', 'Friday, 05 Feb 2021', '17:23:09'),
(31, 1, 'Menghapus sub menu dengan nama Technicians', 'Friday, 05 Feb 2021', '17:23:12'),
(32, 1, 'Menghapus sub menu dengan nama Developer', 'Friday, 05 Feb 2021', '17:23:14'),
(33, 1, 'Menghapus sub menu dengan nama Web Client', 'Friday, 05 Feb 2021', '17:23:56'),
(34, 1, 'Menghapus sub menu dengan nama JS Aksi', 'Friday, 05 Feb 2021', '17:25:17'),
(35, 1, 'Mengedit sub menu dengan nama Users', 'Friday, 05 Feb 2021', '17:26:45'),
(36, 1, 'Menghapus menu Archives', 'Friday, 05 Feb 2021', '18:02:06'),
(37, 1, 'Menghapus menu Apps', 'Friday, 05 Feb 2021', '18:02:18'),
(38, 1, 'Menambahkan hak akses menu kepada id role #2', 'Friday, 05 Feb 2021', '18:16:03'),
(39, 1, 'Menghapus hak akses menu dengan id #30', 'Friday, 05 Feb 2021', '18:16:27'),
(40, 1, 'Menambahkan hak akses menu kepada id role #1', 'Friday, 05 Feb 2021', '18:16:34'),
(41, 1, 'Menambahkan hak akses menu kepada id role #1', 'Friday, 05 Feb 2021', '18:16:40'),
(42, 1, 'Menambahkan hak akses menu kepada id role #1', 'Friday, 05 Feb 2021', '18:16:45'),
(43, 1, 'Menambahkan hak akses menu kepada id role #1', 'Friday, 05 Feb 2021', '18:16:53'),
(44, 1, 'Menambahkan hak akses menu kepada id role #1', 'Friday, 05 Feb 2021', '18:16:59'),
(45, 1, 'Menambahkan hak akses menu kepada id role #1', 'Friday, 05 Feb 2021', '18:17:07'),
(46, 1, 'Menambahkan hak akses menu kepada id role #2', 'Friday, 05 Feb 2021', '18:17:20'),
(47, 1, 'Menambahkan hak akses menu kepada id role #2', 'Friday, 05 Feb 2021', '18:17:25'),
(48, 1, 'Menambahkan hak akses menu kepada id role #2', 'Friday, 05 Feb 2021', '18:17:30'),
(49, 1, 'Menambahkan hak akses menu kepada id role #2', 'Friday, 05 Feb 2021', '18:17:37'),
(50, 1, 'Menambahkan hak akses menu kepada id role #2', 'Friday, 05 Feb 2021', '18:17:43'),
(51, 1, 'Menambahkan hak akses menu kepada id role #2', 'Friday, 05 Feb 2021', '18:17:51'),
(52, 1, 'Menambahkan hak akses menu kepada id role #3', 'Friday, 05 Feb 2021', '18:18:10'),
(53, 1, 'Menambahkan hak akses menu kepada id role #3', 'Friday, 05 Feb 2021', '18:18:19'),
(54, 1, 'Menambahkan hak akses menu kepada id role #3', 'Friday, 05 Feb 2021', '18:18:25'),
(55, 1, 'Menambahkan hak akses menu kepada id role #4', 'Friday, 05 Feb 2021', '18:18:36'),
(56, 1, 'Menambahkan hak akses menu kepada id role #5', 'Friday, 05 Feb 2021', '18:18:44'),
(57, 1, 'Menambahkan menu menejemen baru', 'Friday, 05 Feb 2021', '18:19:35'),
(58, 1, 'Menambahkan hak akses menu kepada id role #6', 'Friday, 05 Feb 2021', '18:19:47'),
(59, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '18:33:06'),
(60, 1, 'Menghapus hak akses sub menu dengan id #92', 'Friday, 05 Feb 2021', '18:33:10'),
(61, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:41:20'),
(62, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:41:36'),
(63, 1, 'Menghapus sub menu dengan nama FAQ', 'Friday, 05 Feb 2021', '19:41:44'),
(64, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:41:55'),
(65, 1, 'Menghapus sub menu dengan nama Error Page', 'Friday, 05 Feb 2021', '19:42:15'),
(66, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:42:30'),
(67, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:42:50'),
(68, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:42:59'),
(69, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:43:43'),
(70, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:43:47'),
(71, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:43:54'),
(72, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:44:03'),
(73, 1, 'Menghapus hak akses sub menu dengan id #101', 'Friday, 05 Feb 2021', '19:44:21'),
(74, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:44:31'),
(75, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:44:41'),
(76, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:44:52'),
(77, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:44:57'),
(78, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:45:01'),
(79, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:45:08'),
(80, 1, 'Menghapus hak akses sub menu dengan id #108', 'Friday, 05 Feb 2021', '19:45:12'),
(81, 1, 'Menghapus hak akses sub menu dengan id #107', 'Friday, 05 Feb 2021', '19:45:15'),
(82, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:45:19'),
(83, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:45:23'),
(84, 1, 'Menambahkan hak akses sub menu kepada id role #2', 'Friday, 05 Feb 2021', '19:46:13'),
(85, 1, 'Menambahkan hak akses sub menu kepada id role #2', 'Friday, 05 Feb 2021', '19:46:20'),
(86, 1, 'Menambahkan hak akses sub menu kepada id role #2', 'Friday, 05 Feb 2021', '19:46:30'),
(87, 1, 'Menambahkan hak akses sub menu kepada id role #2', 'Friday, 05 Feb 2021', '19:46:41'),
(88, 1, 'Menambahkan hak akses sub menu kepada id role #2', 'Friday, 05 Feb 2021', '19:46:58'),
(89, 1, 'Menambahkan hak akses sub menu kepada id role #2', 'Friday, 05 Feb 2021', '19:47:08'),
(90, 1, 'Menambahkan hak akses sub menu kepada id role #2', 'Friday, 05 Feb 2021', '19:47:12'),
(91, 1, 'Menambahkan hak akses sub menu kepada id role #2', 'Friday, 05 Feb 2021', '19:47:22'),
(92, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:47:31'),
(93, 1, 'Menambahkan hak akses sub menu kepada id role #2', 'Friday, 05 Feb 2021', '19:47:37'),
(94, 1, 'Menambahkan hak akses sub menu kepada id role #2', 'Friday, 05 Feb 2021', '19:47:42'),
(95, 1, 'Menambahkan hak akses sub menu kepada id role #2', 'Friday, 05 Feb 2021', '19:47:48'),
(96, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Friday, 05 Feb 2021', '19:47:53'),
(97, 1, 'Menghapus hak akses sub menu dengan id #123', 'Friday, 05 Feb 2021', '19:49:10'),
(98, 1, 'Menghapus sub menu dengan nama Month', 'Friday, 05 Feb 2021', '19:49:27'),
(99, 1, 'Menambahkan hak akses sub menu kepada id role #3', 'Friday, 05 Feb 2021', '19:51:21'),
(100, 1, 'Menambahkan hak akses sub menu kepada id role #3', 'Friday, 05 Feb 2021', '19:51:28'),
(101, 1, 'Menambahkan hak akses sub menu kepada id role #3', 'Friday, 05 Feb 2021', '19:52:09'),
(102, 1, 'Menambahkan hak akses sub menu kepada id role #3', 'Friday, 05 Feb 2021', '19:52:17'),
(103, 1, 'Menambahkan hak akses sub menu kepada id role #3', 'Friday, 05 Feb 2021', '19:52:34'),
(104, 1, 'Menambahkan hak akses sub menu kepada id role #3', 'Friday, 05 Feb 2021', '19:52:42'),
(105, 1, 'Menambahkan hak akses sub menu kepada id role #3', 'Friday, 05 Feb 2021', '19:52:55'),
(106, 1, 'Menambahkan hak akses sub menu kepada id role #3', 'Friday, 05 Feb 2021', '19:53:02'),
(107, 1, 'Menambahkan hak akses sub menu kepada id role #3', 'Friday, 05 Feb 2021', '19:53:09'),
(108, 1, 'Menambahkan hak akses sub menu kepada id role #3', 'Friday, 05 Feb 2021', '19:53:17'),
(109, 1, 'Menambahkan hak akses sub menu kepada id role #4', 'Friday, 05 Feb 2021', '19:54:18'),
(110, 1, 'Menambahkan hak akses sub menu kepada id role #4', 'Friday, 05 Feb 2021', '19:54:24'),
(111, 1, 'Menambahkan hak akses menu kepada id role #3', 'Saturday, 06 Feb 2021', '3:03:28'),
(112, 1, 'Menambahkan nota baru dengan nama tes', 'Saturday, 06 Feb 2021', '14:25:38'),
(113, 1, 'Mengubah nota  dengan nomor nota 3535', 'Saturday, 06 Feb 2021', '14:26:53'),
(114, 1, 'Mengubah nota tes dengan nomor nota 3535', 'Saturday, 06 Feb 2021', '14:29:04'),
(115, 1, 'Menghapus nota tes', 'Saturday, 06 Feb 2021', '14:29:24'),
(116, 1, 'Menambahkan sub menu dengan nama Nota Cancel', 'Saturday, 06 Feb 2021', '14:35:56'),
(117, 1, 'Menambahkan hak akses sub menu kepada id role #1', 'Saturday, 06 Feb 2021', '14:36:12'),
(118, 1, 'Menambahkan hak akses sub menu kepada id role #2', 'Saturday, 06 Feb 2021', '14:36:33'),
(119, 1, 'Menambahkan hak akses sub menu kepada id role #3', 'Saturday, 06 Feb 2021', '14:36:38'),
(120, 1, 'Menambahkan hak akses sub menu kepada id role #4', 'Saturday, 06 Feb 2021', '14:36:43'),
(121, 1, 'Mengedit sub menu dengan nama Nota Cancel', 'Saturday, 06 Feb 2021', '14:41:11'),
(122, 1, 'Mengedit sub menu dengan nama Nota Cancel', 'Saturday, 06 Feb 2021', '14:41:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_role`
--

CREATE TABLE `users_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_role`
--

INSERT INTO `users_role` (`id_role`, `role`) VALUES
(1, 'Full Administrator'),
(2, 'Founder'),
(3, 'Employee'),
(4, 'Technician'),
(5, 'Web Dev/Des'),
(6, 'Web Client Services'),
(7, 'Users'),
(8, 'Visitor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_status`
--

CREATE TABLE `users_status` (
  `is_active` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_status`
--

INSERT INTO `users_status` (`is_active`, `status`) VALUES
(1, 'Active'),
(2, 'Not Active');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cal_days`
--
ALTER TABLE `cal_days`
  ADD PRIMARY KEY (`id_cal`);

--
-- Indeks untuk tabel `cal_grafik`
--
ALTER TABLE `cal_grafik`
  ADD PRIMARY KEY (`id_grafik`);

--
-- Indeks untuk tabel `cal_month`
--
ALTER TABLE `cal_month`
  ADD PRIMARY KEY (`id_montly`);

--
-- Indeks untuk tabel `category_services`
--
ALTER TABLE `category_services`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id_faq`);

--
-- Indeks untuk tabel `handphone`
--
ALTER TABLE `handphone`
  ADD PRIMARY KEY (`id_hp`);

--
-- Indeks untuk tabel `laporan_pengeluaran`
--
ALTER TABLE `laporan_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `laporan_spareparts`
--
ALTER TABLE `laporan_spareparts`
  ADD PRIMARY KEY (`id_sparepart`);

--
-- Indeks untuk tabel `laptop`
--
ALTER TABLE `laptop`
  ADD PRIMARY KEY (`id_laptop`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `menu_access`
--
ALTER TABLE `menu_access`
  ADD PRIMARY KEY (`id_access_menu`);

--
-- Indeks untuk tabel `menu_status`
--
ALTER TABLE `menu_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `menu_sub`
--
ALTER TABLE `menu_sub`
  ADD PRIMARY KEY (`id_sub_menu`);

--
-- Indeks untuk tabel `menu_sub_access`
--
ALTER TABLE `menu_sub_access`
  ADD PRIMARY KEY (`id_access_sub_menu`);

--
-- Indeks untuk tabel `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id_data`);

--
-- Indeks untuk tabel `notes_status`
--
ALTER TABLE `notes_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `notes_type`
--
ALTER TABLE `notes_type`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indeks untuk tabel `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id_pp`);

--
-- Indeks untuk tabel `report_problem`
--
ALTER TABLE `report_problem`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `status_spareparts`
--
ALTER TABLE `status_spareparts`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `term_of_service`
--
ALTER TABLE `term_of_service`
  ADD PRIMARY KEY (`id_term`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `users_access`
--
ALTER TABLE `users_access`
  ADD PRIMARY KEY (`id_access`);

--
-- Indeks untuk tabel `users_help`
--
ALTER TABLE `users_help`
  ADD PRIMARY KEY (`id_help`);

--
-- Indeks untuk tabel `users_log`
--
ALTER TABLE `users_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `users_status`
--
ALTER TABLE `users_status`
  ADD PRIMARY KEY (`is_active`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cal_days`
--
ALTER TABLE `cal_days`
  MODIFY `id_cal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cal_month`
--
ALTER TABLE `cal_month`
  MODIFY `id_montly` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `category_services`
--
ALTER TABLE `category_services`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `faq`
--
ALTER TABLE `faq`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `handphone`
--
ALTER TABLE `handphone`
  MODIFY `id_hp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202308;

--
-- AUTO_INCREMENT untuk tabel `laporan_pengeluaran`
--
ALTER TABLE `laporan_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202799;

--
-- AUTO_INCREMENT untuk tabel `laporan_spareparts`
--
ALTER TABLE `laporan_spareparts`
  MODIFY `id_sparepart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202029;

--
-- AUTO_INCREMENT untuk tabel `laptop`
--
ALTER TABLE `laptop`
  MODIFY `id_laptop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202283;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `menu_access`
--
ALTER TABLE `menu_access`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `menu_status`
--
ALTER TABLE `menu_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `menu_sub`
--
ALTER TABLE `menu_sub`
  MODIFY `id_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `menu_sub_access`
--
ALTER TABLE `menu_sub_access`
  MODIFY `id_access_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT untuk tabel `notes`
--
ALTER TABLE `notes`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `notes_status`
--
ALTER TABLE `notes_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `notes_type`
--
ALTER TABLE `notes_type`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id_pp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `report_problem`
--
ALTER TABLE `report_problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `status_spareparts`
--
ALTER TABLE `status_spareparts`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `term_of_service`
--
ALTER TABLE `term_of_service`
  MODIFY `id_term` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users_access`
--
ALTER TABLE `users_access`
  MODIFY `id_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users_help`
--
ALTER TABLE `users_help`
  MODIFY `id_help` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users_log`
--
ALTER TABLE `users_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT untuk tabel `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users_status`
--
ALTER TABLE `users_status`
  MODIFY `is_active` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
