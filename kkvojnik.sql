-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 18. avg 2025 ob 14.03
-- Različica strežnika: 10.4.32-MariaDB
-- Različica PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `kkvojnik`
--

-- --------------------------------------------------------

--
-- Struktura tabele `dogodki`
--

CREATE TABLE `dogodki` (
  `id` int(11) NOT NULL,
  `naslov` varchar(255) DEFAULT NULL,
  `lokacija` varchar(255) DEFAULT NULL,
  `cas_dogodka` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `galerija`
--

CREATE TABLE `galerija` (
  `id` int(11) NOT NULL,
  `slika_url` varchar(255) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `kategorija` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Odloži podatke za tabelo `galerija`
--

INSERT INTO `galerija` (`id`, `slika_url`, `opis`, `kategorija`) VALUES
(7, 'slike/1755350960_clani.jpg', 'dawdsd', 'u20');

-- --------------------------------------------------------

--
-- Struktura tabele `igralci`
--

CREATE TABLE `igralci` (
  `id` int(11) NOT NULL,
  `ime_priimek` varchar(255) NOT NULL,
  `selekcija` varchar(50) NOT NULL,
  `je_kapetan` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Odloži podatke za tabelo `igralci`
--

INSERT INTO `igralci` (`id`, `ime_priimek`, `selekcija`, `je_kapetan`) VALUES
(1, 'Petja Berk', 'clani', 0),
(2, 'Nejc Buda', 'clani', 0),
(3, 'Nejc Kovče', 'clani', 0),
(4, 'Jaka Potočnik', 'clani', 1),
(5, 'Tim Rozman', 'clani', 0),
(6, 'Andraž Trafela', 'clani', 0),
(7, 'Luka Verhovšek', 'clani', 0),
(8, 'Gašper Krajnc', 'clani', 0),
(9, 'Urh Rošer', 'clani', 0),
(10, 'Matija Leskovšek', 'clani', 0),
(11, 'Tilen Jelenko', 'clani', 0),
(12, 'Jakob Zidar', 'clani', 0),
(14, 'Tilen Kroflič', 'u18', 1),
(15, 'Jakob Zidar', 'u20', 0),
(16, 'Jakob Zakošek', 'u18', 0),
(17, 'Jos Selčan', 'u18', 0),
(18, 'Tian Točaj', 'u18', 0),
(19, 'Luka Žitnik Tovornik', 'u18', 0),
(20, 'Kevin Kerš', 'u18', 0),
(21, 'Vid Komplet', 'u18', 0),
(22, 'Žan Guček', 'u18', 0),
(23, 'Lovro Špegelj', 'u18', 0),
(24, 'Urh Rošer', 'u20', 0),
(25, 'Petja Berk', 'u20', 1),
(26, 'Enej Baloh', 'u20', 0),
(27, 'Tilen Kroflič', 'u20', 0),
(28, 'Gašper Kranjc', 'u20', 0),
(29, 'Pjotr Kolka', 'u20', 0),
(30, 'Matija Leskovšek', 'u20', 0),
(31, 'Jakob Zakošek', 'u20', 0),
(32, 'Filip Bekovič', 'u20', 0);

-- --------------------------------------------------------

--
-- Struktura tabele `novice`
--

CREATE TABLE `novice` (
  `id` int(11) NOT NULL,
  `naslov` varchar(255) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `slika_url` varchar(255) DEFAULT NULL,
  `dodano_ob` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `trenerji`
--

CREATE TABLE `trenerji` (
  `id` int(11) NOT NULL,
  `ime_priimek` varchar(255) NOT NULL,
  `pozicija` varchar(255) NOT NULL,
  `slika_url` varchar(255) DEFAULT 'slike/profilna.png',
  `selekcija` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Odloži podatke za tabelo `trenerji`
--

INSERT INTO `trenerji` (`id`, `ime_priimek`, `pozicija`, `slika_url`, `selekcija`) VALUES
(1, 'Marjan Oprčkal', 'Vodja kluba', 'slike/marjan oprckal.gif', ''),
(2, 'Rene Žvan', 'Glavni trener', 'slike/rene.webp', 'clani'),
(3, 'Uroš Grešak', 'Trener ekipe U20', 'slike/uros.jpg', 'u20'),
(4, 'Matic Močenik', 'Trener ekipe U18', 'slike/matic.jpg', 'u18'),
(5, 'Mateja Oprčkal', 'Trenerka mlajših selekcij', 'slike/mateja.jpg', 'u16'),
(6, 'Sven Juteršek', 'Trenerka mlajših selekcij', 'slike/profilna.png', 'u14'),
(7, 'Matevž Špes', 'Pomožni trener', 'slike/matevz.jpg', '');

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `dogodki`
--
ALTER TABLE `dogodki`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `galerija`
--
ALTER TABLE `galerija`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `igralci`
--
ALTER TABLE `igralci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `novice`
--
ALTER TABLE `novice`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `trenerji`
--
ALTER TABLE `trenerji`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `dogodki`
--
ALTER TABLE `dogodki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT tabele `galerija`
--
ALTER TABLE `galerija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT tabele `igralci`
--
ALTER TABLE `igralci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT tabele `novice`
--
ALTER TABLE `novice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT tabele `trenerji`
--
ALTER TABLE `trenerji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
