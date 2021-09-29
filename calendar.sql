-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Wrz 2021, 16:35
-- Wersja serwera: 10.4.20-MariaDB
-- Wersja PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `calendar`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210922101848', '2021-09-24 12:53:21', 680),
('DoctrineMigrations\\Version20210924105300', '2021-09-24 12:53:22', 221),
('DoctrineMigrations\\Version20210925101045', '2021-09-25 12:11:23', 366),
('DoctrineMigrations\\Version20210928082153', '2021-09-28 10:22:18', 204),
('DoctrineMigrations\\Version20210928093545', '2021-09-28 11:36:15', 185),
('DoctrineMigrations\\Version20210928094711', '2021-09-28 11:47:18', 257),
('DoctrineMigrations\\Version20210928100638', '2021-09-28 12:06:50', 231);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `this_year`
--

CREATE TABLE `this_year` (
  `id` int(11) NOT NULL,
  `month` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `hour` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `this_year`
--

INSERT INTO `this_year` (`id`, `month`, `userid`, `day`, `hour`, `event`) VALUES
(38, 'September', 1, 29, '15:00', 'eat dinner'),
(40, 'September', 1, 30, '8:00', 'programing'),
(56, 'January', 1, 1, '00:01', 'New Year!'),
(57, 'September', 1, 29, '8:00', 'programing'),
(58, 'September', 1, 29, '7:00', 'wake up');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indeksy dla tabeli `this_year`
--
ALTER TABLE `this_year`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `this_year`
--
ALTER TABLE `this_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
