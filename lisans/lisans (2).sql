-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2023 at 11:20 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lisans`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_kadi` varchar(300) NOT NULL,
  `admin_posta` varchar(300) NOT NULL,
  `admin_sifre` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_kadi`, `admin_posta`, `admin_sifre`) VALUES
(1, 'Halit Ergül', 'halitergul18@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350');

-- --------------------------------------------------------

--
-- Table structure for table `lisanslar`
--

CREATE TABLE `lisanslar` (
  `lisans_id` int(11) NOT NULL,
  `lisans_key` varchar(300) NOT NULL,
  `lisans_domain` varchar(300) NOT NULL,
  `lisans_urun` varchar(300) NOT NULL,
  `lisans_eklenme` timestamp NOT NULL DEFAULT current_timestamp(),
  `lisans_bitis` datetime NOT NULL,
  `lisans_durum` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lisanslar`
--

INSERT INTO `lisanslar` (`lisans_id`, `lisans_key`, `lisans_domain`, `lisans_urun`, `lisans_eklenme`, `lisans_bitis`, `lisans_durum`) VALUES
(13, 'aQQF0bsMS8DEBG2CcBlb57EiTrAJsnkT', 'test.com', 'nEiscuiXIWct', '2023-06-08 09:32:13', '2023-06-08 20:00:00', 2),
(14, 'ZksRzdorWJ4byx3CLSXo8FD9vm8vZAs9', 'test.com', 'XWKhhtgNJaan', '2023-06-08 09:32:29', '2023-06-08 20:00:00', 2),
(12, 'btH24UUcmG6y6ha4Pi0sblPfhLNruAvm', 'test.com', 'nEiscuiXIWct', '2023-06-08 07:02:04', '2023-06-09 23:57:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `urunler`
--

CREATE TABLE `urunler` (
  `urun_id` int(11) NOT NULL,
  `urun_adi` varchar(300) NOT NULL,
  `urun_key` varchar(300) NOT NULL,
  `urun_eklenme` timestamp NOT NULL DEFAULT current_timestamp(),
  `urun_durum` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `urunler`
--

INSERT INTO `urunler` (`urun_id`, `urun_adi`, `urun_key`, `urun_eklenme`, `urun_durum`) VALUES
(10, 'TEST', 'XWKhhtgNJaan', '2023-06-08 08:45:05', 1),
(9, 'TEST', 'nEiscuiXIWct', '2023-06-08 07:06:28', 1),
(8, 'TEST', 'u5MkzxJ2EJyJ', '2023-06-08 06:59:52', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `lisanslar`
--
ALTER TABLE `lisanslar`
  ADD PRIMARY KEY (`lisans_id`);

--
-- Indexes for table `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`urun_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lisanslar`
--
ALTER TABLE `lisanslar`
  MODIFY `lisans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `urunler`
--
ALTER TABLE `urunler`
  MODIFY `urun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
