-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05 Des 2017 pada 09.33
-- Versi Server: 5.7.9
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minang_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `category` int(1) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`menu_id`, `name`, `description`, `price`, `category`, `thumbnail`) VALUES
(1, 'Nama Makanan Satu', 'lorem', 10000, 1, 'menu-makanan.png'),
(2, 'Nama Makana Dua', 'lorem', 1000, 1, 'menu-makanan.jpg'),
(3, 'Nama Makanan Tiga', 'lorem ', 10000, 1, 'menu-makanan1.png'),
(4, 'Nama Makanan Empat', 'lorem', 10000, 1, 'menu-makanan2.png'),
(5, 'Nama Minuman Satu Update', 'lorem Update', 11000, 2, 'menu-minuman.png'),
(8, 'Test Makanan', 'Lorem ', 20000, 1, 'menu-makanan1.jpg'),
(9, 'Minuman Test', 'Lorem Dua', 2000, 2, 'menu-minuman.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `menu_view`
--
DROP VIEW IF EXISTS `menu_view`;
CREATE TABLE IF NOT EXISTS `menu_view` (
`menu_id` int(11)
,`name` varchar(255)
,`description` text
,`price` int(11)
,`category` int(1)
,`category_label` varchar(7)
,`thumbnail` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `option`
--

DROP TABLE IF EXISTS `option`;
CREATE TABLE IF NOT EXISTS `option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `option`
--

INSERT INTO `option` (`option_id`, `key`, `value`) VALUES
(1, 'app_name', 'Minang App'),
(2, 'greeting', 'Selamat Datang :)'),
(3, 'app_description', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi, ad, officiis. Nostrum possimus, odio quia, odit placeat debitis! Placeat suscipit nam, quibusdam veniam ipsum et deleniti obcaecati nemo optio iste! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi, ad, officiis. Nostrum possimus, odio quia, odit placeat debitis! Placeat suscipit nam, quibusdam veniam ipsum et deleniti obcaecati nemo optio iste!'),
(4, 'banner', 'banner.jpg'),
(5, 'nama_penerima', 'Keroro Gunsou'),
(6, 'no_rek', '1234234 21341234'),
(7, 'bank', 'BRI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `reservasi_id` int(11) NOT NULL,
  `no_account` varchar(20) NOT NULL,
  `name_account` varchar(100) NOT NULL,
  `bank_account` varchar(10) NOT NULL,
  `proof` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `reservasi_id` (`reservasi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`payment_id`, `reservasi_id`, `no_account`, `name_account`, `bank_account`, `proof`, `created_at`) VALUES
(2, 9, '43523452345', 'Keroro Gunsou', 'BRI', 'proof3.jpg', '2017-12-05 13:54:28'),
(3, 8, '5414351345', 'Keroro Gunsou', 'BTN', 'proof4.jpg', '2017-12-05 16:09:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `place`
--

DROP TABLE IF EXISTS `place`;
CREATE TABLE IF NOT EXISTS `place` (
  `place_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  PRIMARY KEY (`place_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `place`
--

INSERT INTO `place` (`place_id`, `name`, `thumbnail`) VALUES
(1, 'Lantai Satu', 'denah.PNG'),
(2, 'Lantai Dua', 'denah1.PNG'),
(3, 'Lantai Tiga', 'denah2.PNG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `place_detail`
--

DROP TABLE IF EXISTS `place_detail`;
CREATE TABLE IF NOT EXISTS `place_detail` (
  `place_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `place_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`place_detail_id`),
  KEY `place_id` (`place_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `place_detail`
--

INSERT INTO `place_detail` (`place_detail_id`, `place_id`, `name`) VALUES
(1, 1, 'Meja 1'),
(2, 1, 'Meja 2'),
(3, 1, 'Meja 3'),
(4, 1, 'Meja 4'),
(5, 1, 'Meja 5'),
(6, 2, 'Meja 6'),
(7, 2, 'Meja 7'),
(8, 2, 'Meja 8'),
(9, 2, 'Meja 9'),
(10, 2, 'Meja 10'),
(13, 3, 'Meja 12'),
(14, 3, 'Meja 13'),
(15, 3, 'Meja 14'),
(16, 3, 'Meja 15'),
(17, 1, 'Meja Asd');

-- --------------------------------------------------------

--
-- Stand-in structure for view `place_detail_view`
--
DROP VIEW IF EXISTS `place_detail_view`;
CREATE TABLE IF NOT EXISTS `place_detail_view` (
`place_id` int(11)
,`name` varchar(255)
,`thumbnail` varchar(255)
,`place_detail_id` int(11)
,`table_name` varchar(100)
,`reservasi_place_id` int(11)
,`user_id` int(11)
,`reservasi_id` int(11)
,`date` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `place_view`
--
DROP VIEW IF EXISTS `place_view`;
CREATE TABLE IF NOT EXISTS `place_view` (
`place_id` int(11)
,`name` varchar(255)
,`thumbnail` varchar(255)
,`place_detail_id` int(11)
,`table_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi`
--

DROP TABLE IF EXISTS `reservasi`;
CREATE TABLE IF NOT EXISTS `reservasi` (
  `reservasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`reservasi_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reservasi`
--

INSERT INTO `reservasi` (`reservasi_id`, `user_id`, `date`, `status`, `created_at`, `updated_at`) VALUES
(8, 9, '2017-12-30 10:00:00', 7, '2017-12-05 03:17:39', '2017-12-05 16:10:00'),
(9, 2, '2017-11-30 10:00:00', 7, '2017-12-05 12:29:07', '2017-12-05 15:36:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi_menu`
--

DROP TABLE IF EXISTS `reservasi_menu`;
CREATE TABLE IF NOT EXISTS `reservasi_menu` (
  `reservasi_menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `reservasi_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `sum` int(11) NOT NULL,
  PRIMARY KEY (`reservasi_menu_id`),
  KEY `menu_id` (`menu_id`),
  KEY `reservasi_id` (`reservasi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reservasi_menu`
--

INSERT INTO `reservasi_menu` (`reservasi_menu_id`, `reservasi_id`, `menu_id`, `sum`) VALUES
(19, 8, 1, 5),
(20, 8, 9, 2),
(21, 9, 2, 2),
(22, 9, 5, 3),
(23, 8, 2, 3),
(24, 8, 3, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `reservasi_menu_view`
--
DROP VIEW IF EXISTS `reservasi_menu_view`;
CREATE TABLE IF NOT EXISTS `reservasi_menu_view` (
`reservasi_menu_id` int(11)
,`reservasi_id` int(11)
,`user_id` int(11)
,`menu_id` int(11)
,`name` varchar(255)
,`price` int(11)
,`thumbnail` varchar(255)
,`sum` int(11)
,`total` bigint(21)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi_place`
--

DROP TABLE IF EXISTS `reservasi_place`;
CREATE TABLE IF NOT EXISTS `reservasi_place` (
  `reservasi_place_id` int(11) NOT NULL AUTO_INCREMENT,
  `reservasi_id` int(11) NOT NULL,
  `place_detail_id` int(11) NOT NULL,
  PRIMARY KEY (`reservasi_place_id`),
  KEY `reservasi_id` (`reservasi_id`),
  KEY `place_detail_id` (`place_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reservasi_place`
--

INSERT INTO `reservasi_place` (`reservasi_place_id`, `reservasi_id`, `place_detail_id`) VALUES
(13, 8, 1),
(14, 8, 2),
(20, 9, 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `reservasi_view`
--
DROP VIEW IF EXISTS `reservasi_view`;
CREATE TABLE IF NOT EXISTS `reservasi_view` (
`reservasi_id` int(11)
,`user_id` int(11)
,`name` varchar(255)
,`email` varchar(255)
,`menu` text
,`detail_table` text
,`jumlah_minuman` bigint(21) unsigned
,`jumlah_makanan` bigint(21) unsigned
,`can_add_table` decimal(16,0)
,`table` bigint(21)
,`date` datetime
,`total` decimal(42,0)
,`status` int(1)
,`created_at` datetime
,`updated_at` datetime
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(255) NOT NULL,
  `capability` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `name`, `capability`, `created_at`, `updated_at`) VALUES
(1, 'admin@minang.id', '933c33f8cb9d291c155eb07c6b3de9c8afac8b1f', 'Kero Kero', 2, '2017-11-29 18:44:47', '2017-11-30 14:17:32'),
(2, 'member@minang.id', '933c33f8cb9d291c155eb07c6b3de9c8afac8b1f', 'Member Minang', 1, '2017-11-29 18:45:19', '2017-11-29 18:45:23'),
(8, 'admin2@minang.id', '933c33f8cb9d291c155eb07c6b3de9c8afac8b1f', 'Admin Dua Update', 2, '2017-11-30 06:40:12', '2017-11-30 06:49:09'),
(9, 'member2@minang.id', '933c33f8cb9d291c155eb07c6b3de9c8afac8b1f', 'Member Dua', 1, '2017-11-30 07:02:46', '2017-11-30 07:03:53'),
(12, 'asdf@minang.id', '933c33f8cb9d291c155eb07c6b3de9c8afac8b1f', 'asdf', 1, '2017-11-30 14:32:09', '2017-11-30 14:32:09'),
(14, '', 'ceab7500327540a00763db21310f91c3253038b1', 'Lantai Dasar', 2, '2017-12-01 13:17:03', '2017-12-01 13:17:03');

-- --------------------------------------------------------

--
-- Struktur untuk view `menu_view`
--
DROP TABLE IF EXISTS `menu_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `menu_view`  AS  select `menu`.`menu_id` AS `menu_id`,`menu`.`name` AS `name`,`menu`.`description` AS `description`,`menu`.`price` AS `price`,`menu`.`category` AS `category`,if((`menu`.`category` = 1),'makanan','minuman') AS `category_label`,`menu`.`thumbnail` AS `thumbnail` from `menu` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `place_detail_view`
--
DROP TABLE IF EXISTS `place_detail_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `place_detail_view`  AS  select `place_view`.`place_id` AS `place_id`,`place_view`.`name` AS `name`,`place_view`.`thumbnail` AS `thumbnail`,`place_view`.`place_detail_id` AS `place_detail_id`,`place_view`.`table_name` AS `table_name`,`reservasi_place`.`reservasi_place_id` AS `reservasi_place_id`,`reservasi`.`user_id` AS `user_id`,`reservasi`.`reservasi_id` AS `reservasi_id`,`reservasi`.`date` AS `date` from ((`place_view` join `reservasi_place` on((`place_view`.`place_detail_id` = `reservasi_place`.`place_detail_id`))) join `reservasi` on((`reservasi`.`reservasi_id` = `reservasi_place`.`reservasi_id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `place_view`
--
DROP TABLE IF EXISTS `place_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `place_view`  AS  select `place`.`place_id` AS `place_id`,`place`.`name` AS `name`,`place`.`thumbnail` AS `thumbnail`,`place_detail`.`place_detail_id` AS `place_detail_id`,`place_detail`.`name` AS `table_name` from (`place` left join `place_detail` on((`place_detail`.`place_id` = `place`.`place_id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `reservasi_menu_view`
--
DROP TABLE IF EXISTS `reservasi_menu_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reservasi_menu_view`  AS  select `reservasi_menu`.`reservasi_menu_id` AS `reservasi_menu_id`,`reservasi_menu`.`reservasi_id` AS `reservasi_id`,`reservasi`.`user_id` AS `user_id`,`reservasi_menu`.`menu_id` AS `menu_id`,`menu`.`name` AS `name`,`menu`.`price` AS `price`,`menu`.`thumbnail` AS `thumbnail`,`reservasi_menu`.`sum` AS `sum`,(`reservasi_menu`.`sum` * `menu`.`price`) AS `total` from ((`reservasi_menu` join `reservasi` on((`reservasi`.`reservasi_id` = `reservasi_menu`.`reservasi_id`))) join `menu` on((`menu`.`menu_id` = `reservasi_menu`.`menu_id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `reservasi_view`
--
DROP TABLE IF EXISTS `reservasi_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reservasi_view`  AS  select `reservasi`.`reservasi_id` AS `reservasi_id`,`reservasi`.`user_id` AS `user_id`,`user`.`name` AS `name`,`user`.`email` AS `email`,ifnull(concat('[',group_concat(distinct concat('[',`menu`.`category`,',',`reservasi_menu`.`sum`,',"',`menu`.`name`,'"]') separator ','),']'),'[]') AS `menu`,ifnull(concat('[',group_concat(distinct concat('["',`place_detail`.`name`,'","',`place`.`name`,'"]') separator ','),']'),'[]') AS `detail_table`,cast(ifnull((sum(if((`menu`.`category` = 2),(1 * `reservasi_menu`.`sum`),0)) / count(distinct `reservasi_place`.`place_detail_id`)),sum(if((`menu`.`category` = 2),(1 * `reservasi_menu`.`sum`),0))) as unsigned) AS `jumlah_minuman`,cast(ifnull((sum(if((`menu`.`category` = 1),(1 * `reservasi_menu`.`sum`),0)) / count(distinct `reservasi_place`.`place_detail_id`)),sum(if((`menu`.`category` = 1),(1 * `reservasi_menu`.`sum`),0))) as unsigned) AS `jumlah_makanan`,ifnull(ceiling((sum((if((`menu`.`category` = 1),(1 * `reservasi_menu`.`sum`),0) / 2)) / count(distinct `reservasi_place`.`place_detail_id`))),ceiling(sum((if((`menu`.`category` = 1),(1 * `reservasi_menu`.`sum`),0) / 2)))) AS `can_add_table`,count(distinct `reservasi_place`.`place_detail_id`) AS `table`,`reservasi`.`date` AS `date`,sum((`menu`.`price` * `reservasi_menu`.`sum`)) AS `total`,`reservasi`.`status` AS `status`,`reservasi`.`created_at` AS `created_at`,`reservasi`.`updated_at` AS `updated_at` from ((((((`reservasi` join `user` on((`reservasi`.`user_id` = `user`.`user_id`))) join `reservasi_menu` on((`reservasi`.`reservasi_id` = `reservasi_menu`.`reservasi_id`))) join `menu` on((`menu`.`menu_id` = `reservasi_menu`.`menu_id`))) left join `reservasi_place` on((`reservasi_place`.`reservasi_id` = `reservasi`.`reservasi_id`))) left join `place_detail` on((`place_detail`.`place_detail_id` = `reservasi_place`.`place_detail_id`))) left join `place` on((`place`.`place_id` = `place_detail`.`place_id`))) group by `reservasi`.`reservasi_id` order by `reservasi`.`reservasi_id` desc ;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`reservasi_id`) REFERENCES `reservasi` (`reservasi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `place_detail`
--
ALTER TABLE `place_detail`
  ADD CONSTRAINT `place_detail_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  ADD CONSTRAINT `reservasi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reservasi_menu`
--
ALTER TABLE `reservasi_menu`
  ADD CONSTRAINT `reservasi_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservasi_menu_ibfk_2` FOREIGN KEY (`reservasi_id`) REFERENCES `reservasi` (`reservasi_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reservasi_place`
--
ALTER TABLE `reservasi_place`
  ADD CONSTRAINT `reservasi_place_ibfk_1` FOREIGN KEY (`reservasi_id`) REFERENCES `reservasi` (`reservasi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservasi_place_ibfk_2` FOREIGN KEY (`place_detail_id`) REFERENCES `place_detail` (`place_detail_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
