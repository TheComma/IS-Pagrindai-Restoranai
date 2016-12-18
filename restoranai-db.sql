-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2016 at 06:48 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `administratorius`
--

CREATE TABLE `administratorius` (
  `id` int(11) NOT NULL,
  `vardas` varchar(20) NOT NULL,
  `pavarde` varchar(20) NOT NULL,
  `telefonas` varchar(13) NOT NULL,
  `el_pastas` varchar(25) NOT NULL,
  `adresas` varchar(50) NOT NULL,
  `asmens_kodas` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `isdirbtas_laikas` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `pradzia` time NOT NULL,
  `pabaiga` time NOT NULL,
  `komentarai` text,
  `uzdarbis` float NOT NULL,
  `fk_padavejas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `klientas`
--

CREATE TABLE `klientas` (
  `id` int(11) NOT NULL,
  `vardas` varchar(20) NOT NULL,
  `pavarde` varchar(20) NOT NULL,
  `telefonas` varchar(13) NOT NULL,
  `miestas` varchar(50) NOT NULL,
  `el_pastas` varchar(25) NOT NULL,
  `adresas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `padavejas` (
  `id` int(11) NOT NULL,
  `vardas` varchar(20) NOT NULL,
  `pavarde` varchar(20) NOT NULL,
  `adresas` varchar(50) NOT NULL,
  `saskaitos_numeris` varchar(50) NOT NULL,
  `telefonas` varchar(13) NOT NULL,
  `asmens_kodas` varchar(13) NOT NULL,
  `etatas` float NOT NULL,
  `idarbinimo_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `padavejo_maistas`
--

CREATE TABLE `padavejo_maistas` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `kiekis` int(11) NOT NULL,
  `fk_padavejas` int(11) NOT NULL,
  `fk_patiekalas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patiekalas`
--

CREATE TABLE `patiekalas` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(50) NOT NULL,
  `kaina` float NOT NULL,
  `sukurimo_data` datetime NOT NULL,
  `modifikavimo_data` datetime NOT NULL,
  `aktyvus` tinyint(1) NOT NULL,
  `komentarai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patiekalo_produktas`
--

CREATE TABLE `patiekalo_produktas` (
  `id` int(11) NOT NULL,
  `kiekis` int(11) NOT NULL,
  `fk_patiekalas` int(11) NOT NULL,
  `fk_produktas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patiekalo_tipas`
--

CREATE TABLE `patiekalo_tipas` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(20) NOT NULL,
  `ivedimo_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prisijungimu_istorija`
--

CREATE TABLE `prisijungimu_istorija` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `ip_adresas` varchar(20) NOT NULL,
  `ar_pavyko` tinyint(1) NOT NULL,
  `fk_vartotojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produktas`
--

CREATE TABLE `produktas` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(50) NOT NULL,
  `kaina` float NOT NULL,
  `sukurimo_data` datetime NOT NULL,
  `svoris` float NOT NULL,
  `Galiojimo_laikas` int(11) NOT NULL,
  `komentarai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produktas`
--

INSERT INTO `produktas` (`id`, `pavadinimas`, `kaina`, `sukurimo_data`, `svoris`, `Galiojimo_laikas`, `komentarai`) VALUES
(1, 'Miltai', 2, '2016-12-18 20:05:14', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `produktu_uzsakymas`
--

CREATE TABLE `produktu_uzsakymas` (
  `id` int(11) NOT NULL,
  `ivedimo_data` datetime NOT NULL,
  `kiekis` int(11) NOT NULL,
  `pristatymo_data` datetime DEFAULT NULL,
  `komentarai` text CHARACTER SET utf8,
  `redagavimo_data` datetime DEFAULT NULL,
  `fk_produktas` int(11) NOT NULL,
  `fk_busena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produktu_uzsakymas`
--

INSERT INTO `produktu_uzsakymas` (`id`, `ivedimo_data`, `kiekis`, `pristatymo_data`, `komentarai`, `redagavimo_data`, `fk_produktas`, `fk_busena`) VALUES
(1, '2016-12-18 20:06:29', 5, '2016-12-01 00:00:00', '', '2016-12-01 00:00:00', 1, 1),
(2, '2016-12-18 20:06:29', 5, '2016-12-01 00:00:00', '', '2016-12-01 00:00:00', 1, 1),
(3, '2016-12-18 20:06:29', 5, '2016-12-01 00:00:00', '', '2016-12-01 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produktu_uzsakymo_busena`
--

CREATE TABLE `produktu_uzsakymo_busena` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(25) NOT NULL,
  `ivedimo_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produktu_uzsakymo_busena`
--

INSERT INTO `produktu_uzsakymo_busena` (`id`, `pavadinimas`, `ivedimo_data`) VALUES
(1, 'sukurtas', '2016-12-18 20:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `restoranas`
--

CREATE TABLE `restoranas` (
  `id` int(11) NOT NULL,
  `miestas` varchar(50) NOT NULL,
  `adresas` varchar(50) NOT NULL,
  `telefonas` varchar(13) NOT NULL,
  `sukurimo_data` datetime NOT NULL,
  `fk_administratorius` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `rezervacija` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `sukurimo_data` datetime NOT NULL,
  `pakeitimo_data` datetime NOT NULL,
  `zmoniu_skaicius` int(11) NOT NULL,
  `komentarai` text NOT NULL,
  `fk_valandos` time NOT NULL,
  `fk_klientas` int(11) NOT NULL,
  `fk_restoranas` int(11) NOT NULL,
  `fk_busena` int(11) NOT NULL,
  `fk_staliukas` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rezervacijos_busenos`
--

CREATE TABLE `rezervacijos_busenos` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rezervacijos_valandos`
--

CREATE TABLE `rezervacijos_valandos` (
  `id` int(11) NOT NULL,
  `valandos` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

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

CREATE TABLE `staliukas` (
  `staliuko_indentifikatorius` varchar(6) NOT NULL,
  `vietu_skaicius` int(11) NOT NULL,
  `ar_aktyvus` tinyint(1) NOT NULL,
  `fk_padavejas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uzsakymas`
--

CREATE TABLE `uzsakymas` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `komentarai` text,
  `busena` int(11) NOT NULL,
  `uzsakymo_pabaiga` datetime DEFAULT NULL,
  `fk_staliukas` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uzsakymo_patiekalas`
--

CREATE TABLE `uzsakymo_patiekalas` (
  `id` int(11) NOT NULL,
  `kiekis` int(11) NOT NULL,
  `fk_patiekalas` int(11) NOT NULL,
  `fk_uzsakymas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vartotojas`
--

CREATE TABLE `vartotojas` (
  `id` int(11) NOT NULL,
  `vartotojo_vardas` varchar(20) NOT NULL,
  `slaptazodis` varchar(50) NOT NULL,
  `vartotojo_tipas` int(11) NOT NULL,
  `vartotojo_nuoroda` int(11) NOT NULL,
  `sukurimo_data` datetime NOT NULL,
  `ar_blokuotas` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vartotojas`
--

INSERT INTO `vartotojas` (`id`, `vartotojo_vardas`, `slaptazodis`, `vartotojo_tipas`, `vartotojo_nuoroda`, `sukurimo_data`, `ar_blokuotas`) VALUES
(1, 'tadrad', '1a1dc91c907325c69271ddf0c944bc72', 1, 1, '2016-12-18 13:00:00', 0),
(2, 'Rokkac', '1a1dc91c907325c69271ddf0c944bc72', 1, 6, '2016-12-18 13:00:00', 0),
(3, 'admin1', '1a1dc91c907325c69271ddf0c944bc72', 9, 1, '2016-12-18 13:00:00', 0),
(4, 'admin2', '1a1dc91c907325c69271ddf0c944bc72', 9, 2, '2016-12-18 15:00:00', 0);

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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patiekalas`
--
ALTER TABLE `patiekalas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patiekalo_tipas`
--
ALTER TABLE `patiekalo_tipas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prisijungimu_istorija`
--
ALTER TABLE `prisijungimu_istorija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produktas`
--
ALTER TABLE `produktas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produktu_uzsakymas`
--
ALTER TABLE `produktu_uzsakymas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produktu_uzsakymo_busena`
--
ALTER TABLE `produktu_uzsakymo_busena`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restoranas`
--
ALTER TABLE `restoranas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`staliuko_indentifikatorius`);

--
-- Indexes for table `uzsakymas`
--
ALTER TABLE `uzsakymas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzsakymo_patiekalas`
--
ALTER TABLE `uzsakymo_patiekalas`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `klientas`
--
ALTER TABLE `klientas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `padavejas`
--
ALTER TABLE `padavejas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `padavejo_maistas`
--
ALTER TABLE `padavejo_maistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patiekalas`
--
ALTER TABLE `patiekalas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patiekalo_tipas`
--
ALTER TABLE `patiekalo_tipas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prisijungimu_istorija`
--
ALTER TABLE `prisijungimu_istorija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produktas`
--
ALTER TABLE `produktas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `produktu_uzsakymas`
--
ALTER TABLE `produktu_uzsakymas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `produktu_uzsakymo_busena`
--
ALTER TABLE `produktu_uzsakymo_busena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `restoranas`
--
ALTER TABLE `restoranas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rezervacijos_busenos`
--
ALTER TABLE `rezervacijos_busenos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rezervacijos_valandos`
--
ALTER TABLE `rezervacijos_valandos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `uzsakymas`
--
ALTER TABLE `uzsakymas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uzsakymo_patiekalas`
--
ALTER TABLE `uzsakymo_patiekalas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vartotojas`
--
ALTER TABLE `vartotojas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
