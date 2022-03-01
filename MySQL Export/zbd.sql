-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Lis 2020, 18:57
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `zbd`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adres`
--

CREATE TABLE `adres` (
  `id_adres` int(11) NOT NULL,
  `kraj` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL,
  `miasto` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `kod_pocztowy` varchar(10) COLLATE utf8mb4_polish_ci NOT NULL,
  `ulica` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `adres`
--

INSERT INTO `adres` (`id_adres`, `kraj`, `miasto`, `kod_pocztowy`, `ulica`) VALUES
(1, 'Polska', 'Prudnik', '48-200', 'ul. Łucznicza 1'),
(2, 'Polska', 'Wrocław', '50-123', 'Politechniczna 1/1'),
(3, 'Polska', 'Prudnik', '48-200', 'ul. Łucznicza 1'),
(4, 'Krajowo', 'Miastewko', '40-200', 'Uliczna'),
(5, 'Polska', 'Koniec Drogi', '42-500', 'Miodowa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dyscyplina`
--

CREATE TABLE `dyscyplina` (
  `id_dyscyplina` int(11) NOT NULL,
  `dyscyplina` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `dyscyplina`
--

INSERT INTO `dyscyplina` (`id_dyscyplina`, `dyscyplina`) VALUES
(1, 'Szachy'),
(2, 'Go');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentatorzy`
--

CREATE TABLE `komentatorzy` (
  `id_komentatorzy` int(11) NOT NULL,
  `imie` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `komentatorzy`
--

INSERT INTO `komentatorzy` (`id_komentatorzy`, `imie`, `nazwisko`) VALUES
(1, 'Michael', 'Sheller');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentatorzy_turn`
--

CREATE TABLE `komentatorzy_turn` (
  `id_turniej` int(11) NOT NULL,
  `id_komentatorzy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `komentatorzy_turn`
--

INSERT INTO `komentatorzy_turn` (`id_turniej`, `id_komentatorzy`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `organizatorzy`
--

CREATE TABLE `organizatorzy` (
  `id_organizatorzy` int(11) NOT NULL,
  `id_adres` int(11) NOT NULL,
  `nazwa` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `telefon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `organizatorzy`
--

INSERT INTO `organizatorzy` (`id_organizatorzy`, `id_adres`, `nazwa`, `email`, `telefon`) VALUES
(1, 1, 'KS Obuwnik', 'email@mail.com', 123456789);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `organizatorzy_turn`
--

CREATE TABLE `organizatorzy_turn` (
  `id_turniej` int(11) NOT NULL,
  `id_organizatorzy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `organizatorzy_turn`
--

INSERT INTO `organizatorzy_turn` (`id_turniej`, `id_organizatorzy`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ranking`
--

CREATE TABLE `ranking` (
  `id` int(11) NOT NULL,
  `id_dyscyplina` int(11) NOT NULL,
  `id_zawodnik` int(11) NOT NULL,
  `punkty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `ranking`
--

INSERT INTO `ranking` (`id`, `id_dyscyplina`, `id_zawodnik`, `punkty`) VALUES
(1, 1, 1, 6),
(2, 2, 2, 9),
(3, 1, 3, 2),
(4, 1, 4, 11),
(5, 2, 5, 5),
(6, 2, 6, 1),
(7, 2, 7, 13),
(8, 2, 8, 0),
(9, 2, 9, 12),
(10, 1, 10, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `turniej`
--

CREATE TABLE `turniej` (
  `id_turniej` int(11) NOT NULL,
  `nazwa` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `data` datetime NOT NULL,
  `id_adres` int(11) NOT NULL,
  `id_dyscyplina` int(11) NOT NULL,
  `opis` varchar(250) COLLATE utf8mb4_polish_ci NOT NULL,
  `zasady` varchar(250) COLLATE utf8mb4_polish_ci NOT NULL,
  `transmisja` varchar(3) COLLATE utf8mb4_polish_ci NOT NULL,
  `wpisowe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `turniej`
--

INSERT INTO `turniej` (`id_turniej`, `nazwa`, `data`, `id_adres`, `id_dyscyplina`, `opis`, `zasady`, `transmisja`, `wpisowe`) VALUES
(1, 'Turniej w Szachy', '2020-11-20 14:00:00', 1, 1, 'opis', 'zasady', 'Nie', 0),
(2, 'Turniej w Go', '2020-11-25 12:30:00', 2, 2, 'opis', 'zasady', 'Nie', 0),
(3, 'II Turniej w Szachy', '2020-11-28 20:15:00', 4, 1, 'Opis', 'Zasady', 'Tak', 5),
(4, 'II Turniej w GO', '2021-03-05 20:40:00', 5, 2, 'Opis', 'Zasady', 'Nie', 15);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `user` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL,
  `pass` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `user`, `pass`) VALUES
(1, 'patrick', '12345');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zawodnicy`
--

CREATE TABLE `zawodnicy` (
  `id_zawodnicy` int(11) NOT NULL,
  `id_dyscyplina` int(11) NOT NULL,
  `imie` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `klub` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `opis` varchar(250) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `zawodnicy`
--

INSERT INTO `zawodnicy` (`id_zawodnicy`, `id_dyscyplina`, `imie`, `nazwisko`, `klub`, `opis`) VALUES
(1, 1, 'Aleksander ', 'Piaseczny', 'Giants', 'OPIS'),
(2, 2, 'Hubert ', 'Jach', 'Giants', 'OPIS'),
(3, 1, 'Krzysztof', 'Hymon', 'Enigmas', 'OPIS'),
(4, 1, 'Królik', 'Królikowski', 'Trolls', 'OPIS'),
(5, 2, 'Szymon', 'Bóbr', 'Enigmas', 'OPIS'),
(6, 2, 'Walter ', 'Laskoski', 'The Terrors', 'OPIS'),
(7, 2, 'Chwalibóg ', 'Graczyk', 'Yetis', 'OPIS'),
(8, 2, 'Lesław ', 'Skop', 'Monsters', 'OPIS'),
(9, 2, 'Florentyn ', 'Osiecki', 'Gnomes', 'OPIS'),
(10, 1, 'Bolesław ', 'Bochenek', 'Stars', 'OPIS');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zawodnicy_turn`
--

CREATE TABLE `zawodnicy_turn` (
  `id` int(11) NOT NULL,
  `id_turniej` int(11) NOT NULL,
  `id_zawodnicy` int(11) NOT NULL,
  `punkty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `zawodnicy_turn`
--

INSERT INTO `zawodnicy_turn` (`id`, `id_turniej`, `id_zawodnicy`, `punkty`) VALUES
(1, 3, 1, 3),
(2, 1, 1, 3),
(3, 3, 3, 1),
(4, 3, 4, 4),
(5, 4, 7, 12),
(6, 4, 9, 9),
(7, 2, 5, 5),
(8, 2, 9, 3),
(9, 1, 4, 7),
(10, 2, 2, 9),
(11, 1, 3, 1),
(12, 4, 6, 1),
(13, 2, 7, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adres`
--
ALTER TABLE `adres`
  ADD PRIMARY KEY (`id_adres`);

--
-- Indeksy dla tabeli `dyscyplina`
--
ALTER TABLE `dyscyplina`
  ADD PRIMARY KEY (`id_dyscyplina`);

--
-- Indeksy dla tabeli `komentatorzy`
--
ALTER TABLE `komentatorzy`
  ADD PRIMARY KEY (`id_komentatorzy`);

--
-- Indeksy dla tabeli `organizatorzy`
--
ALTER TABLE `organizatorzy`
  ADD PRIMARY KEY (`id_organizatorzy`);

--
-- Indeksy dla tabeli `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `turniej`
--
ALTER TABLE `turniej`
  ADD PRIMARY KEY (`id_turniej`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zawodnicy`
--
ALTER TABLE `zawodnicy`
  ADD PRIMARY KEY (`id_zawodnicy`);

--
-- Indeksy dla tabeli `zawodnicy_turn`
--
ALTER TABLE `zawodnicy_turn`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `adres`
--
ALTER TABLE `adres`
  MODIFY `id_adres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `dyscyplina`
--
ALTER TABLE `dyscyplina`
  MODIFY `id_dyscyplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `komentatorzy`
--
ALTER TABLE `komentatorzy`
  MODIFY `id_komentatorzy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `organizatorzy`
--
ALTER TABLE `organizatorzy`
  MODIFY `id_organizatorzy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `ranking`
--
ALTER TABLE `ranking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `turniej`
--
ALTER TABLE `turniej`
  MODIFY `id_turniej` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `zawodnicy`
--
ALTER TABLE `zawodnicy`
  MODIFY `id_zawodnicy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `zawodnicy_turn`
--
ALTER TABLE `zawodnicy_turn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
