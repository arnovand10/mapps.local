-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 29, 2016 at 07:05 PM
-- Server version: 5.5.49-log
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hoteldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `gasten`
--

CREATE TABLE IF NOT EXISTS `gasten` (
  `gasten_id` int(11) NOT NULL,
  `voornaam` varchar(255) NOT NULL,
  `familienaam` varchar(255) NOT NULL,
  `aantal` int(11) NOT NULL,
  `checkin` datetime NOT NULL,
  `checkout` datetime NOT NULL,
  `checkedOutAt` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gasten`
--

INSERT INTO `gasten` (`gasten_id`, `voornaam`, `familienaam`, `aantal`, `checkin`, `checkout`, `checkedOutAt`) VALUES
(3, 'Bjorn', 'Truye', 5, '2016-12-30 07:18:20', '2016-12-31 00:00:00', NULL),
(4, 'De Ridder', 'Dirk', 6, '2016-12-27 21:45:22', '2017-01-02 00:00:00', NULL),
(5, 'Sharmaine', 'Aberin', 2, '2016-12-27 21:55:24', '2017-01-03 00:00:00', NULL),
(6, 'Dabi', 'Abu', 2, '2016-12-27 21:56:44', '2016-12-29 00:00:00', NULL),
(7, 'Arno', 'Van Den Bossche', 2, '2016-12-28 00:27:07', '2017-01-30 00:00:00', '2016-12-28 22:38:54'),
(8, 'Arno', 'Van', 4, '2016-12-28 15:58:02', '2016-12-22 00:00:00', NULL),
(9, 'Antonio', 'Aberin', 5, '2016-12-28 16:00:07', '2016-12-15 00:00:00', NULL),
(10, 'Berend', 'Brokkepap', 2, '2016-12-28 16:02:23', '2016-12-15 00:00:00', NULL),
(11, 'Piet', 'Zwarte', 2, '2016-12-28 16:13:56', '0000-00-00 00:00:00', '2016-12-29 13:07:46'),
(12, 'Joris', 'Boris', 1, '2016-12-28 19:57:28', '0000-00-00 00:00:00', '2016-12-29 13:09:05'),
(13, 'Bert', 'De Kabouter', 1, '2016-12-28 22:40:27', '0000-00-00 00:00:00', '2016-12-29 13:09:16'),
(14, 'Gert', 'Verhulst', 2, '2016-12-29 13:02:05', '0000-00-00 00:00:00', '2016-12-29 13:03:20'),
(15, 'Katrina', 'Aberin', 2, '2016-12-29 13:06:27', '2016-12-30 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `geboekt`
--

CREATE TABLE IF NOT EXISTS `geboekt` (
  `geboekt_id` int(11) NOT NULL,
  `gast_id` int(11) NOT NULL,
  `kamers_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `geboekt`
--

INSERT INTO `geboekt` (`geboekt_id`, `gast_id`, `kamers_id`) VALUES
(4, 3, 227),
(5, 4, 241),
(6, 5, 231),
(7, 6, 230),
(9, 8, 245),
(10, 9, 246),
(11, 10, 249),
(16, 15, 252);

-- --------------------------------------------------------

--
-- Table structure for table `kamers`
--

CREATE TABLE IF NOT EXISTS `kamers` (
  `id` int(11) NOT NULL,
  `nummer` int(11) NOT NULL,
  `vrij` tinyint(1) NOT NULL,
  `personen` int(11) NOT NULL,
  `prijs` int(11) NOT NULL,
  `klasse` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamers`
--

INSERT INTO `kamers` (`id`, `nummer`, `vrij`, `personen`, `prijs`, `klasse`) VALUES
(225, 1, 1, 4, 12, 3),
(226, 2, 1, 8, 100, 3),
(227, 3, 0, 2, 200, 3),
(228, 4, 1, 4, 150, 1),
(230, 6, 0, 2, 50, 1),
(231, 7, 0, 2, 200, 3),
(241, 9, 0, 6, 200, 2),
(244, 12, 1, 3, 50, 1),
(245, 11, 0, 4, 200, 2),
(246, 10, 0, 6, 200, 1),
(247, 15, 1, 4, 100, 2),
(249, 13, 0, 2, 50, 2),
(250, 5, 1, 2, 50, 1),
(251, 8, 1, 4, 100, 2),
(252, 14, 0, 2, 200, 3);

-- --------------------------------------------------------

--
-- Table structure for table `klasseopties`
--

CREATE TABLE IF NOT EXISTS `klasseopties` (
  `klasse_id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `ontbijt` tinyint(1) NOT NULL,
  `middagmaal` tinyint(1) NOT NULL,
  `avondmaal` tinyint(1) NOT NULL,
  `drankNA` tinyint(1) NOT NULL,
  `drankA` tinyint(1) NOT NULL,
  `drankSterk` tinyint(1) NOT NULL,
  `cocktail` tinyint(1) NOT NULL,
  `tussendoor` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klasseopties`
--

INSERT INTO `klasseopties` (`klasse_id`, `naam`, `ontbijt`, `middagmaal`, `avondmaal`, `drankNA`, `drankA`, `drankSterk`, `cocktail`, `tussendoor`) VALUES
(1, 'standaard', 1, 0, 0, 0, 0, 0, 0, 0),
(2, 'halfpension', 1, 0, 1, 1, 0, 0, 0, 0),
(3, 'volpension', 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL,
  `gebruikersnaam` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `familienaam` varchar(255) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `gebruikersnaam`, `wachtwoord`, `lastlogin`, `admin`, `familienaam`, `naam`, `foto`) VALUES
(1, 'vereri', 'test', '2016-12-29 11:39:48', 0, 'Verhulst', 'Erik', 'user-image3.201629291212165037.jpg'),
(2, 'arnovand10', 'test', '2016-12-29 16:12:29', 1, 'Van Den Bossche', 'Arno', 'arno.201629291212180213.PNG'),
(4, 'verpie', 'test', '2016-12-28 00:01:23', 0, 'Verhellen', 'Pieter', 'user-image.201629291212164836.jpg'),
(6, 'truye_bjorn', 'test', '0000-00-00 00:00:00', 1, 'Truye', 'Bjorn', 'bjron.201629291212165432.jpg'),
(18, 'admin', 'admin', '2016-12-29 18:12:28', 1, 'admin', 'admin', 'Knipsel.201629291212182942.PNG'),
(19, 'debsie', 'test', '0000-00-00 00:00:00', 0, 'De Bouw', 'Sien', 'user-image2.201629291212164953.jpg'),
(21, 'dereme', 'test', '0000-00-00 00:00:00', 0, 'De Ridder', 'Emely', 'user-image4.201629291212165144.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gasten`
--
ALTER TABLE `gasten`
  ADD PRIMARY KEY (`gasten_id`),
  ADD KEY `gasten_id` (`gasten_id`),
  ADD KEY `gasten_id_2` (`gasten_id`);

--
-- Indexes for table `geboekt`
--
ALTER TABLE `geboekt`
  ADD PRIMARY KEY (`geboekt_id`),
  ADD KEY `gast_id` (`gast_id`),
  ADD KEY `kamers_id` (`kamers_id`);

--
-- Indexes for table `kamers`
--
ALTER TABLE `kamers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `klasse` (`klasse`);

--
-- Indexes for table `klasseopties`
--
ALTER TABLE `klasseopties`
  ADD PRIMARY KEY (`klasse_id`),
  ADD KEY `klasse_id` (`klasse_id`),
  ADD KEY `klasse_id_2` (`klasse_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gasten`
--
ALTER TABLE `gasten`
  MODIFY `gasten_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `geboekt`
--
ALTER TABLE `geboekt`
  MODIFY `geboekt_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `kamers`
--
ALTER TABLE `kamers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=253;
--
-- AUTO_INCREMENT for table `klasseopties`
--
ALTER TABLE `klasseopties`
  MODIFY `klasse_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `geboekt`
--
ALTER TABLE `geboekt`
  ADD CONSTRAINT `geboekt_ibfk_1` FOREIGN KEY (`gast_id`) REFERENCES `gasten` (`gasten_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `geboekt_ibfk_2` FOREIGN KEY (`kamers_id`) REFERENCES `kamers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
