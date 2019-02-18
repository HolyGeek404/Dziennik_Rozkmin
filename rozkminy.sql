-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Lis 2018, 16:37
-- Wersja serwera: 10.1.13-MariaDB
-- Wersja PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `przemyslenia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rozkminy`
--

CREATE TABLE `rozkminy` (
  `idrozkminy` int(11) NOT NULL,
  `temat` text COLLATE utf8_polish_ci NOT NULL,
  `tresc` longtext COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rozkminy`
--

INSERT INTO `rozkminy` (`idrozkminy`, `temat`, `tresc`) VALUES
(1, 'Jak działa wszechświat ?', 'Nie wiem.'),
(2, 'Jak zdać z sieci ?', 'Czytaj CISCO'),
(5, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus euismod iaculis sagittis. Nulla lectus nulla, bibendum ultrices imperdiet ut, consectetur eu tortor. Nam consectetur commodo nisi, ut condimentum tortor placerat ut. Nunc a mattis leo, nec pharetra sapien. Morbi at nibh aliquet, tempor urna ac, aliquet lorem. Ut quis magna porta, tristique nibh in, laoreet est. Vestibulum dignissim malesuada mollis. Vestibulum arcu augue, efficitur non magna et, dignissim rutrum nisl. Proin nibh mauris, aliquet et quam eu, cursus ornare velit. Etiam facilisis pellentesque libero luctus consectetur. Duis iaculis vitae sapien at porta. Duis tempus interdum consequat. Nulla interdum tellus ac erat suscipit imperdiet. Etiam aliquet laoreet est sed ultricies.\r\n\r\nPhasellus bibendum turpis id sem sollicitudin tempor. Morbi vulputate tempus tortor. Nullam bibendum bibendum condimentum. Mauris tempus auctor velit vitae maximus. In varius semper euismod. Donec vulputate in diam eu pretium. Nulla nisl felis, porttitor sed fermentum in, porttitor et eros. Curabitur massa metus, mollis eget fringilla eget, semper gravida enim. Cras urna purus, convallis vel faucibus nec, cursus et dolor. Nullam non ipsum luctus, commodo sem ac, sagittis lacus. Sed lectus nulla, semper id elit sit amet, lobortis aliquam augue. Ut sit amet nisi vitae erat tristique gravida.\r\n\r\nVivamus eget semper urna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse ut diam eu metus pellentesque lobortis sed sit amet felis. Morbi egestas tincidunt purus nec auctor. Nam quis bibendum eros. Fusce sed nisi consequat, cursus odio vel, sagittis nisl. Donec gravida efficitur lorem, eu faucibus enim accumsan ac. In sit amet fermentum sem. Donec sit amet blandit massa, sed efficitur lectus. Nam nec nisl nec diam tincidunt lacinia. Duis non diam ac velit dignissim auctor. Aliquam erat volutpat. Sed scelerisque dignissim risus sed placerat. Nunc blandit a nisi sed euismod. Cras tempus volutpat diam, et faucibus massa elementum eget. Suspendisse auctor venenatis vestibulum.');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `rozkminy`
--
ALTER TABLE `rozkminy`
  ADD PRIMARY KEY (`idrozkminy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `rozkminy`
--
ALTER TABLE `rozkminy`
  MODIFY `idrozkminy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
