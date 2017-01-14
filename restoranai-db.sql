-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2017 at 10:59 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoranai-db`
--
CREATE DATABASE IF NOT EXISTS `restoranai-db` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `restoranai-db`;

-- --------------------------------------------------------

--
-- Table structure for table `administratorius`
--

DROP TABLE IF EXISTS `administratorius`;
CREATE TABLE `administratorius` (
  `id` int(11) NOT NULL,
  `vardas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pavarde` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `telefonas` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `el_pastas` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `adresas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `asmens_kodas` varchar(13) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `administratorius`
--

INSERT INTO `administratorius` (`id`, `vardas`, `pavarde`, `telefonas`, `el_pastas`, `adresas`, `asmens_kodas`) VALUES
(1, 'Jonas', 'Rimkus', '+37063254485', 'admin@restoranas.lt', 'Test g. 1', '38506259854'),
(2, 'Petras', 'Stankevicius', '+37065215869', 'info@restoranas.lt', 'Test g,3', '39102129563');

-- --------------------------------------------------------

--
-- Table structure for table `isdirbtas_laikas`
--

DROP TABLE IF EXISTS `isdirbtas_laikas`;
CREATE TABLE `isdirbtas_laikas` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `pradzia` time NOT NULL,
  `pabaiga` time NOT NULL,
  `komentarai` text COLLATE utf8_unicode_ci,
  `uzdarbis` float DEFAULT NULL,
  `fk_padavejas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `isdirbtas_laikas`
--

INSERT INTO `isdirbtas_laikas` (`id`, `data`, `pradzia`, `pabaiga`, `komentarai`, `uzdarbis`, `fk_padavejas`) VALUES
(1, '2017-01-12', '08:00:00', '20:00:00', '12 darbo valandÅ³', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `klientas`
--

DROP TABLE IF EXISTS `klientas`;
CREATE TABLE `klientas` (
  `id` int(11) NOT NULL,
  `vardas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pavarde` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `telefonas` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `miestas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `el_pastas` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `adresas` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `klientas`
--

INSERT INTO `klientas` (`id`, `vardas`, `pavarde`, `telefonas`, `miestas`, `el_pastas`, `adresas`) VALUES
(1, 'Tadas', 'Radvilavicius', '+37063728870', 'Kaunas', 'radvilt@gmail.com', 'A. Juozapaviciaus 21-34'),
(6, 'Rokas', 'Kaciurinas', 'pasikeisi', 'pasikeisi', 'pasikeisi@gmail.com', 'pasikeisi');

-- --------------------------------------------------------

--
-- Table structure for table `padavejas`
--

DROP TABLE IF EXISTS `padavejas`;
CREATE TABLE `padavejas` (
  `id` int(11) NOT NULL,
  `vardas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pavarde` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `adresas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `saskaitos_numeris` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefonas` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `asmens_kodas` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `etatas` float NOT NULL,
  `idarbinimo_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `padavejas`
--

INSERT INTO `padavejas` (`id`, `vardas`, `pavarde`, `adresas`, `saskaitos_numeris`, `telefonas`, `asmens_kodas`, `etatas`, `idarbinimo_data`) VALUES
(1, 'Juozas', 'Juozaitis', 'Test g.5', 'LT109515912661985052156', '+37069852001', '39005257894', 1, '2016-12-14 00:00:00'),
(2, 'Tomas', 'Gargaliauskas', 'GatvÄ—s g. 15', 'LT6173000100886112', '+37061122587', '39012345674', 0.2, '2017-01-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `padavejo_maistas`
--

DROP TABLE IF EXISTS `padavejo_maistas`;
CREATE TABLE `padavejo_maistas` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `kiekis` int(11) NOT NULL,
  `fk_padavejas` int(11) NOT NULL,
  `fk_patiekalas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patiekalas`
--

DROP TABLE IF EXISTS `patiekalas`;
CREATE TABLE `patiekalas` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kaina` float NOT NULL,
  `sukurimo_data` datetime NOT NULL,
  `modifikavimo_data` datetime NOT NULL,
  `aktyvus` tinyint(1) NOT NULL,
  `komentarai` text COLLATE utf8_unicode_ci NOT NULL,
  `fk_tipas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patiekalas`
--

INSERT INTO `patiekalas` (`id`, `pavadinimas`, `kaina`, `sukurimo_data`, `modifikavimo_data`, `aktyvus`, `komentarai`, `fk_tipas`) VALUES
(1, 'Salotos', 2, '2016-12-21 11:21:20', '2016-12-21 11:21:20', 1, '', 1),
(2, 'Pyragas', 5, '2016-12-21 11:22:05', '2016-12-21 11:22:05', 1, '', 3),
(3, 'Mini salotos', 10, '2016-12-21 11:34:01', '2016-12-21 11:34:01', 1, '', 2),
(4, 'Pyragas su riešutais', 2, '2016-12-21 11:38:38', '2016-12-21 11:38:38', 1, '', 3),
(5, 'Sumuštinis', 1, '2016-12-25 20:53:05', '2016-12-25 20:53:05', 1, 'ęįęįėę', 2);

-- --------------------------------------------------------

--
-- Table structure for table `patiekalo_busena`
--

DROP TABLE IF EXISTS `patiekalo_busena`;
CREATE TABLE `patiekalo_busena` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ivedimo_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patiekalo_busena`
--

INSERT INTO `patiekalo_busena` (`id`, `pavadinimas`, `ivedimo_data`) VALUES
(1, 'Pridėtas', '2016-12-21 04:08:38'),
(2, 'Gaminamas', '2016-12-21 04:09:15'),
(3, 'Pagamintas', '2016-12-21 04:09:15'),
(4, 'Atšauktas', '2016-12-21 04:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `patiekalo_produktas`
--

DROP TABLE IF EXISTS `patiekalo_produktas`;
CREATE TABLE `patiekalo_produktas` (
  `id` int(11) NOT NULL,
  `kiekis` int(11) NOT NULL,
  `fk_patiekalas` int(11) NOT NULL,
  `fk_produktas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patiekalo_produktas`
--

INSERT INTO `patiekalo_produktas` (`id`, `kiekis`, `fk_patiekalas`, `fk_produktas`) VALUES
(1, 8, 4, 2),
(2, 1, 4, 5),
(3, 0, 4, 1),
(4, 1, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `patiekalo_tipas`
--

DROP TABLE IF EXISTS `patiekalo_tipas`;
CREATE TABLE `patiekalo_tipas` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ivedimo_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patiekalo_tipas`
--

INSERT INTO `patiekalo_tipas` (`id`, `pavadinimas`, `ivedimo_data`) VALUES
(1, 'Vegetariška', '2016-12-21 11:18:00'),
(2, 'Užkandžiai', '2016-12-21 11:18:00'),
(3, 'Desertas', '2016-12-21 11:18:10');

-- --------------------------------------------------------

--
-- Table structure for table `prisijungimu_istorija`
--

DROP TABLE IF EXISTS `prisijungimu_istorija`;
CREATE TABLE `prisijungimu_istorija` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `ip_adresas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ar_pavyko` tinyint(1) NOT NULL,
  `fk_vartotojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produktas`
--

DROP TABLE IF EXISTS `produktas`;
CREATE TABLE `produktas` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kaina` float NOT NULL,
  `sukurimo_data` datetime NOT NULL,
  `svoris` float NOT NULL,
  `Galiojimo_laikas` int(11) NOT NULL,
  `komentarai` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `produktas`
--

INSERT INTO `produktas` (`id`, `pavadinimas`, `kaina`, `sukurimo_data`, `svoris`, `Galiojimo_laikas`, `komentarai`) VALUES
(1, 'miltai', 5, '2016-12-21 11:19:16', 10, 100, ''),
(2, 'Kiaušiniai', 2, '2016-12-21 11:19:43', 10, 20, ''),
(3, 'Salotos', 5, '2016-12-21 11:20:20', 0.2, 5, ''),
(4, 'Cukrus', 4, '2016-12-21 11:20:52', 1, 100, 'Brangu'),
(5, 'Riešutai', 10, '2016-12-21 11:37:56', 1, 50, '');

-- --------------------------------------------------------

--
-- Table structure for table `produktu_uzsakymas`
--

DROP TABLE IF EXISTS `produktu_uzsakymas`;
CREATE TABLE `produktu_uzsakymas` (
  `id` int(11) NOT NULL,
  `ivedimo_data` datetime NOT NULL,
  `kiekis` int(11) NOT NULL,
  `pristatymo_data` datetime NOT NULL,
  `komentarai` text COLLATE utf8_unicode_ci NOT NULL,
  `redagavimo_data` datetime NOT NULL,
  `fk_produktas` int(11) NOT NULL,
  `fk_busena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `produktu_uzsakymas`
--

INSERT INTO `produktu_uzsakymas` (`id`, `ivedimo_data`, `kiekis`, `pristatymo_data`, `komentarai`, `redagavimo_data`, `fk_produktas`, `fk_busena`) VALUES
(1, '2016-12-21 11:32:20', 100, '2016-12-21 11:32:20', '', '2016-12-21 11:32:20', 2, 2),
(2, '2016-12-21 11:33:05', 20, '2016-12-21 11:33:05', '', '2016-12-21 11:33:05', 3, 3),
(3, '2016-12-21 11:33:12', 10, '2016-12-21 11:33:12', '', '2016-12-21 11:33:12', 1, 3),
(4, '2016-12-25 20:56:46', 10, '2016-12-25 20:56:46', '', '2016-12-25 20:56:46', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produktu_uzsakymo_busena`
--

DROP TABLE IF EXISTS `produktu_uzsakymo_busena`;
CREATE TABLE `produktu_uzsakymo_busena` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `ivedimo_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `produktu_uzsakymo_busena`
--

INSERT INTO `produktu_uzsakymo_busena` (`id`, `pavadinimas`, `ivedimo_data`) VALUES
(1, 'Sukurtas', '2016-12-18 20:04:43'),
(2, 'Patvirtintas', '2016-12-21 03:24:53'),
(3, 'Atmestas', '2016-12-21 03:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `restoranas`
--

DROP TABLE IF EXISTS `restoranas`;
CREATE TABLE `restoranas` (
  `id` int(11) NOT NULL,
  `miestas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adresas` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefonas` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `sukurimo_data` datetime NOT NULL,
  `fk_administratorius` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `restoranas`
--

INSERT INTO `restoranas` (`id`, `miestas`, `adresas`, `telefonas`, `sukurimo_data`, `fk_administratorius`) VALUES
(1, 'Kaunas', 'Test g. 2 ', '+37063216548', '2016-12-18 13:00:00', 1),
(2, 'Kaunas', 'Test g.4', '+37062541520', '2016-12-18 15:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

DROP TABLE IF EXISTS `rezervacija`;
CREATE TABLE `rezervacija` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `sukurimo_data` datetime NOT NULL,
  `pakeitimo_data` datetime NOT NULL,
  `zmoniu_skaicius` int(11) NOT NULL,
  `komentarai` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `fk_valandos` int(11) NOT NULL,
  `fk_klientas` int(11) NOT NULL,
  `fk_restoranas` int(11) NOT NULL,
  `fk_busena` int(11) NOT NULL,
  `fk_staliukas` varchar(6) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`id`, `data`, `sukurimo_data`, `pakeitimo_data`, `zmoniu_skaicius`, `komentarai`, `fk_valandos`, `fk_klientas`, `fk_restoranas`, `fk_busena`, `fk_staliukas`) VALUES
(9, '2016-12-23', '2016-12-19 13:08:33', '2016-12-19 17:41:08', 4, 'Gražus tekstas', 3, 1, 1, 2, 'TOP241'),
(10, '2016-12-22', '2016-12-19 13:08:56', '2016-12-19 17:41:23', 4, 'Gražesnis tekstas', 3, 1, 1, 1, 'TOP241'),
(11, '2016-12-21', '2016-12-20 22:46:00', '2016-12-20 22:46:00', 5, 'O reikia?', 5, 6, 1, 1, 'TOP241'),
(12, '2016-12-29', '2016-12-20 22:46:21', '2016-12-20 22:46:21', 2, 'Kam?', 1, 6, 1, 1, 'TOP241'),
(13, '2016-12-22', '2016-12-21 01:11:33', '2016-12-21 01:11:33', 5, 'Bla', 4, 1, 1, 1, 'TOP241'),
(14, '2016-12-29', '2016-12-21 01:11:48', '2016-12-21 01:11:48', 2, 'dsgsf', 4, 1, 1, 1, 'TOP241');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacijos_busenos`
--

DROP TABLE IF EXISTS `rezervacijos_busenos`;
CREATE TABLE `rezervacijos_busenos` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rezervacijos_busenos`
--

INSERT INTO `rezervacijos_busenos` (`id`, `pavadinimas`) VALUES
(1, 'Naujas'),
(2, 'Patvirtintas'),
(3, 'Atmestas');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacijos_valandos`
--

DROP TABLE IF EXISTS `rezervacijos_valandos`;
CREATE TABLE `rezervacijos_valandos` (
  `id` int(11) NOT NULL,
  `valandos` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rezervacijos_valandos`
--

INSERT INTO `rezervacijos_valandos` (`id`, `valandos`) VALUES
(1, '14:00:00'),
(2, '15:00:00'),
(3, '16:00:00'),
(4, '17:00:00'),
(5, '18:00:00'),
(6, '19:00:00'),
(7, '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `staliukas`
--

DROP TABLE IF EXISTS `staliukas`;
CREATE TABLE `staliukas` (
  `staliuko_indentifikatorius` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `vietu_skaicius` int(11) NOT NULL,
  `ar_aktyvus` tinyint(1) NOT NULL,
  `fk_padavejas` int(11) NOT NULL,
  `fk_restoranas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staliukas`
--

INSERT INTO `staliukas` (`staliuko_indentifikatorius`, `vietu_skaicius`, `ar_aktyvus`, `fk_padavejas`, `fk_restoranas`) VALUES
('TOP241', 4, 1, 1, 1),
('TOP252', 4, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `uzsakymas`
--

DROP TABLE IF EXISTS `uzsakymas`;
CREATE TABLE `uzsakymas` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `komentarai` text COLLATE utf8_unicode_ci,
  `fk_busena` int(11) NOT NULL,
  `uzsakymo_pabaiga` datetime DEFAULT NULL,
  `fk_staliukas` varchar(6) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uzsakymas`
--

INSERT INTO `uzsakymas` (`id`, `data`, `komentarai`, `fk_busena`, `uzsakymo_pabaiga`, `fk_staliukas`) VALUES
(1, '2016-12-21 11:17:21', NULL, 2, '2016-12-21 11:35:21', 'TOP241'),
(2, '2016-12-21 13:00:04', NULL, 2, '2016-12-25 20:57:57', 'TOP241');

-- --------------------------------------------------------

--
-- Table structure for table `uzsakymo_busena`
--

DROP TABLE IF EXISTS `uzsakymo_busena`;
CREATE TABLE `uzsakymo_busena` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ivedimo_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uzsakymo_busena`
--

INSERT INTO `uzsakymo_busena` (`id`, `pavadinimas`, `ivedimo_data`) VALUES
(1, 'Vykdomas', '2016-12-21 04:12:21'),
(2, 'Užbaigtas', '2016-12-21 04:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `uzsakymo_patiekalas`
--

DROP TABLE IF EXISTS `uzsakymo_patiekalas`;
CREATE TABLE `uzsakymo_patiekalas` (
  `id` int(11) NOT NULL,
  `fk_patiekalas` int(11) NOT NULL,
  `fk_uzsakymas` int(11) NOT NULL,
  `fk_busena` int(11) NOT NULL,
  `komentaras` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uzsakymo_patiekalas`
--

INSERT INTO `uzsakymo_patiekalas` (`id`, `fk_patiekalas`, `fk_uzsakymas`, `fk_busena`, `komentaras`) VALUES
(1, 1, 1, 3, ''),
(2, 3, 1, 4, ''),
(3, 1, 1, 4, ''),
(4, 2, 1, 4, ''),
(5, 3, 2, 3, ''),
(6, 2, 2, 3, 'Be riešutų'),
(7, 1, 2, 4, 'ĖĘįėęęįėęį');

-- --------------------------------------------------------

--
-- Table structure for table `vartotojas`
--

DROP TABLE IF EXISTS `vartotojas`;
CREATE TABLE `vartotojas` (
  `id` int(11) NOT NULL,
  `vartotojo_vardas` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `slaptazodis` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vartotojo_tipas` int(11) NOT NULL,
  `vartotojo_nuoroda` int(11) NOT NULL,
  `sukurimo_data` datetime NOT NULL,
  `ar_blokuotas` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vartotojas`
--

INSERT INTO `vartotojas` (`id`, `vartotojo_vardas`, `slaptazodis`, `vartotojo_tipas`, `vartotojo_nuoroda`, `sukurimo_data`, `ar_blokuotas`) VALUES
(1, 'tadrad', '1a1dc91c907325c69271ddf0c944bc72', 1, 1, '2016-12-18 13:00:00', 0),
(2, 'Rokkac', '1a1dc91c907325c69271ddf0c944bc72', 1, 6, '2016-12-18 13:00:00', 0),
(3, 'admin1', '1a1dc91c907325c69271ddf0c944bc72', 9, 1, '2016-12-18 13:00:00', 0),
(4, 'admin2', '1a1dc91c907325c69271ddf0c944bc72', 9, 2, '2016-12-18 15:00:00', 0),
(5, 'waiter1', '1a1dc91c907325c69271ddf0c944bc72', 5, 1, '2016-12-21 00:00:00', 0),
(6, 'cook1', '1a1dc91c907325c69271ddf0c944bc72', 3, -1, '2016-12-21 11:25:19', 0),
(7, 'padav1', '1a1dc91c907325c69271ddf0c944bc72', 5, 2, '2017-01-14 10:52:31', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administratorius`
--
ALTER TABLE `administratorius`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `isdirbtas_laikas`
--
ALTER TABLE `isdirbtas_laikas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_padavejas` (`fk_padavejas`);

--
-- Indexes for table `klientas`
--
ALTER TABLE `klientas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `padavejas`
--
ALTER TABLE `padavejas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `padavejo_maistas`
--
ALTER TABLE `padavejo_maistas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_padavejas` (`fk_padavejas`),
  ADD KEY `fk_patiekalas` (`fk_patiekalas`);

--
-- Indexes for table `patiekalas`
--
ALTER TABLE `patiekalas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipas` (`fk_tipas`);

--
-- Indexes for table `patiekalo_busena`
--
ALTER TABLE `patiekalo_busena`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patiekalo_produktas`
--
ALTER TABLE `patiekalo_produktas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patiekalas` (`fk_patiekalas`),
  ADD KEY `fk_produktas` (`fk_produktas`);

--
-- Indexes for table `patiekalo_tipas`
--
ALTER TABLE `patiekalo_tipas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prisijungimu_istorija`
--
ALTER TABLE `prisijungimu_istorija`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vartotojas` (`fk_vartotojas`);

--
-- Indexes for table `produktas`
--
ALTER TABLE `produktas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produktu_uzsakymas`
--
ALTER TABLE `produktu_uzsakymas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produktas` (`fk_produktas`),
  ADD KEY `fk_busena` (`fk_busena`);

--
-- Indexes for table `produktu_uzsakymo_busena`
--
ALTER TABLE `produktu_uzsakymo_busena`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restoranas`
--
ALTER TABLE `restoranas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_administratorius` (`fk_administratorius`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_valandos` (`fk_valandos`),
  ADD KEY `fk_klientas` (`fk_klientas`),
  ADD KEY `fk_restoranas` (`fk_restoranas`),
  ADD KEY `fk_busena` (`fk_busena`),
  ADD KEY `fk_staliukas` (`fk_staliukas`);

--
-- Indexes for table `rezervacijos_busenos`
--
ALTER TABLE `rezervacijos_busenos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rezervacijos_valandos`
--
ALTER TABLE `rezervacijos_valandos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staliukas`
--
ALTER TABLE `staliukas`
  ADD PRIMARY KEY (`staliuko_indentifikatorius`),
  ADD KEY `fk_padavejas` (`fk_padavejas`),
  ADD KEY `fk_restoranas` (`fk_restoranas`);

--
-- Indexes for table `uzsakymas`
--
ALTER TABLE `uzsakymas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_busena` (`fk_busena`),
  ADD KEY `fk_staliukas` (`fk_staliukas`);

--
-- Indexes for table `uzsakymo_busena`
--
ALTER TABLE `uzsakymo_busena`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzsakymo_patiekalas`
--
ALTER TABLE `uzsakymo_patiekalas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patiekalas` (`fk_patiekalas`),
  ADD KEY `fk_uzsakymas` (`fk_uzsakymas`),
  ADD KEY `fk_busena` (`fk_busena`);

--
-- Indexes for table `vartotojas`
--
ALTER TABLE `vartotojas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vartotojo_vardas` (`vartotojo_vardas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administratorius`
--
ALTER TABLE `administratorius`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `isdirbtas_laikas`
--
ALTER TABLE `isdirbtas_laikas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `klientas`
--
ALTER TABLE `klientas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `padavejas`
--
ALTER TABLE `padavejas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `padavejo_maistas`
--
ALTER TABLE `padavejo_maistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patiekalas`
--
ALTER TABLE `patiekalas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `patiekalo_busena`
--
ALTER TABLE `patiekalo_busena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `patiekalo_produktas`
--
ALTER TABLE `patiekalo_produktas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `patiekalo_tipas`
--
ALTER TABLE `patiekalo_tipas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `prisijungimu_istorija`
--
ALTER TABLE `prisijungimu_istorija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produktas`
--
ALTER TABLE `produktas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `produktu_uzsakymas`
--
ALTER TABLE `produktu_uzsakymas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `produktu_uzsakymo_busena`
--
ALTER TABLE `produktu_uzsakymo_busena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `restoranas`
--
ALTER TABLE `restoranas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `rezervacijos_busenos`
--
ALTER TABLE `rezervacijos_busenos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rezervacijos_valandos`
--
ALTER TABLE `rezervacijos_valandos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `uzsakymas`
--
ALTER TABLE `uzsakymas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `uzsakymo_busena`
--
ALTER TABLE `uzsakymo_busena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `uzsakymo_patiekalas`
--
ALTER TABLE `uzsakymo_patiekalas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `vartotojas`
--
ALTER TABLE `vartotojas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `isdirbtas_laikas`
--
ALTER TABLE `isdirbtas_laikas`
  ADD CONSTRAINT `fkc_laikas_padavejas` FOREIGN KEY (`fk_padavejas`) REFERENCES `padavejas` (`id`);

--
-- Constraints for table `padavejo_maistas`
--
ALTER TABLE `padavejo_maistas`
  ADD CONSTRAINT `fkc_maistas_padavejas` FOREIGN KEY (`fk_padavejas`) REFERENCES `padavejas` (`id`),
  ADD CONSTRAINT `fkc_maistas_patiekalas` FOREIGN KEY (`fk_patiekalas`) REFERENCES `patiekalas` (`id`);

--
-- Constraints for table `patiekalas`
--
ALTER TABLE `patiekalas`
  ADD CONSTRAINT `fkc_patiekalas_tipas` FOREIGN KEY (`fk_tipas`) REFERENCES `patiekalo_tipas` (`id`);

--
-- Constraints for table `patiekalo_produktas`
--
ALTER TABLE `patiekalo_produktas`
  ADD CONSTRAINT `fkc_patprod_pat` FOREIGN KEY (`fk_patiekalas`) REFERENCES `patiekalas` (`id`),
  ADD CONSTRAINT `fkc_patprod_prod` FOREIGN KEY (`fk_produktas`) REFERENCES `produktas` (`id`);

--
-- Constraints for table `prisijungimu_istorija`
--
ALTER TABLE `prisijungimu_istorija`
  ADD CONSTRAINT `fkc_priistorija_vartotojas` FOREIGN KEY (`fk_vartotojas`) REFERENCES `vartotojas` (`id`);

--
-- Constraints for table `produktu_uzsakymas`
--
ALTER TABLE `produktu_uzsakymas`
  ADD CONSTRAINT `fkc_produzsakyma_prod` FOREIGN KEY (`fk_produktas`) REFERENCES `produktas` (`id`),
  ADD CONSTRAINT `fkc_produzsakymas_busena` FOREIGN KEY (`fk_busena`) REFERENCES `produktu_uzsakymo_busena` (`id`);

--
-- Constraints for table `restoranas`
--
ALTER TABLE `restoranas`
  ADD CONSTRAINT `fkc_restoranas_admin` FOREIGN KEY (`fk_administratorius`) REFERENCES `administratorius` (`id`);

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `fkc_rezervacija_busena` FOREIGN KEY (`fk_busena`) REFERENCES `rezervacijos_busenos` (`id`),
  ADD CONSTRAINT `fkc_rezervacija_klientas` FOREIGN KEY (`fk_klientas`) REFERENCES `klientas` (`id`),
  ADD CONSTRAINT `fkc_rezervacija_restoranas` FOREIGN KEY (`fk_restoranas`) REFERENCES `restoranas` (`id`),
  ADD CONSTRAINT `fkc_rezervacija_valandos` FOREIGN KEY (`fk_valandos`) REFERENCES `rezervacijos_valandos` (`id`),
  ADD CONSTRAINT `fkc_staliukas` FOREIGN KEY (`fk_staliukas`) REFERENCES `staliukas` (`staliuko_indentifikatorius`);

--
-- Constraints for table `staliukas`
--
ALTER TABLE `staliukas`
  ADD CONSTRAINT `fkc_staliukas_padavejas` FOREIGN KEY (`fk_padavejas`) REFERENCES `padavejas` (`id`),
  ADD CONSTRAINT `fkc_staliukas_restranas` FOREIGN KEY (`fk_restoranas`) REFERENCES `restoranas` (`id`);

--
-- Constraints for table `uzsakymas`
--
ALTER TABLE `uzsakymas`
  ADD CONSTRAINT `fkc_uzsakymas_busena` FOREIGN KEY (`fk_busena`) REFERENCES `uzsakymo_busena` (`id`),
  ADD CONSTRAINT `fkc_uzsakymas_staliukas` FOREIGN KEY (`fk_staliukas`) REFERENCES `staliukas` (`staliuko_indentifikatorius`);

--
-- Constraints for table `uzsakymo_patiekalas`
--
ALTER TABLE `uzsakymo_patiekalas`
  ADD CONSTRAINT `fkc_uzspatiekalas_busena` FOREIGN KEY (`fk_busena`) REFERENCES `patiekalo_busena` (`id`),
  ADD CONSTRAINT `fkc_uzspatiekalas_patiekalas` FOREIGN KEY (`fk_patiekalas`) REFERENCES `patiekalas` (`id`),
  ADD CONSTRAINT `fkc_uzspatiekalas_uzsakymas` FOREIGN KEY (`fk_uzsakymas`) REFERENCES `uzsakymas` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
