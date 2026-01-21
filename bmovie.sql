-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sty 18, 2026 at 01:35 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmovie`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `haslo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `login`, `haslo`) VALUES
(1, 'admin', '$2y$10$1GhELtuYn7/JVJFl44X2k.nZmVhhfz8BpqD6SZN0yquKbwis12Qe.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aktorzy`
--

CREATE TABLE `aktorzy` (
  `id` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `data_urodzenia` text NOT NULL,
  `zdjecie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktorzy`
--

INSERT INTO `aktorzy` (`id`, `imie`, `nazwisko`, `data_urodzenia`, `zdjecie`) VALUES
(1, 'Jerry', 'Seinfeld', '1954-04-29', 'jerry_seinfeld-128462.jpg'),
(2, 'Renée', 'Zellweger', '1969-04-25', 'renee_zellweger-458312.jpg'),
(3, 'Matthew', 'Broderick', '1962-03-21', 'matthew_broderick-294721.jpg'),
(4, 'Jared', 'Harris', '1961-08-24', 'jared_harris-582236.jpg'),
(5, 'Stellan', 'Skarsgård', '1951-06-13', 'stellan_skarsgard-289471.jpg'),
(6, 'Emily', 'Watson', '1967-01-14', 'emily_watson-291723.jpg'),
(7, 'Patrick', 'Warburton', '1964-11-14', 'patrick_warburton-561873.jpeg'),
(8, 'John', 'Goodman', '1952-06-20', 'john_goodman-583622.jpeg'),
(9, 'Chris', 'Rock', '1965-02-07', 'chris_rock-587212.jpeg'),
(10, 'Kathy', 'Bates', '1948-06-28', 'kathy_bates-547865.jpeg'),
(11, 'Barry', 'Levinson', '1942-04-06', 'barry_levinson-481663.jpeg'),
(12, 'Larry', 'King', '1933-11-19', 'larry_king-597213.jpeg'),
(13, 'Tim', 'Robbins', '1958-10-16', 'tim-robbins_371623.jpeg'),
(14, 'Morgan', 'Freeman', '1937-06-01', 'morgan_freeman-274421.jpeg'),
(15, 'Bob', 'Gunton', '1945-11-15', 'bob_gunton-857312.jpeg'),
(16, 'Elijah', 'Wood', '1981-01-28', 'elijah_wood-583166.jpeg'),
(17, 'Sean', 'Astin', '1971-02-25', 'sean_astin-434761.jpeg'),
(18, 'Marlon', 'Brando', '1924-04-03', 'marlon_brando-589123.jpeg'),
(19, 'Al', 'Pacino', '1940-04-25', 'al_pacino-197323.jpeg'),
(20, 'Anthony', 'Gonzalez', '2004-09-23', 'anthony_gonzalez-481223.jpeg'),
(21, 'Gael García', 'Bernal ', '1978-11-30', 'gael_garcia_bernal-587423.jpeg'),
(22, 'Matthew ', 'McConaughey', '1969-11-04', 'matthew_mcconaughey-697342.jpeg'),
(23, 'Anne', 'Hathaway', '1982-11-12', 'anne_hathaway-682435.jpeg'),
(24, 'John', 'Travolta', '1954-02-18', 'john_travolta-283975.jpeg'),
(25, 'Samuel L.', 'Jackson', '1948-12-21', 'samuel_l_ackson-597432.jpeg'),
(26, 'Moira', 'Kelly', '1968-03-06', 'moira_kelly_458126.jpeg'),
(27, 'François', 'Cluzet ', '1955-09-21', 'francois_cluzet-587132.jpeg'),
(28, 'Omar', 'Sy', '1978-01-20', 'omar_sy-573142.jpeg'),
(29, 'Leonardo', 'DiCaprio', '1974-11-11', 'leonardo_dicaprio-687532.jpeg'),
(30, 'Joseph', 'Gordon-Levitt', '1981-02-17', 'joseph_gordon_levitt-453245.jpeg'),
(31, 'Bryan', 'Cranston', '1956-03-07', 'bryan_cranston-552621.jpeg'),
(32, 'Aaron', 'Paul', '1979-08-27', 'aaron_paul.jpeg'),
(33, 'Peter', 'Dinklage', '1969-06-11', 'peter_dinklage-954231.jpeg'),
(34, 'Lena', 'Headey', '1973-10-03', 'lena_headey-594212.jpeg'),
(35, 'David', 'Attenborough', '1926-05-08', 'david_attenborough-624234.jpeg'),
(36, 'Krystyna', 'Czubówna', '1954-08-02', 'krystyna_czubowna-689212.jpg'),
(37, 'Steve', 'Carell', '1962-08-16', 'steve_carell-597831.jpeg'),
(38, 'Jenna', 'Fischer', '1974-03-07', 'jenna_fischer-681723.jpeg'),
(39, 'Damian', 'Lewis', '1971-02-11', 'damian_lewis-821144.jpeg'),
(40, 'Dale', 'Dye', '1944-10-08', 'dale_dye-443242.jpeg'),
(41, 'Justin', 'Roiland', '1980-02-21', 'justin_roiland-842624.jpeg'),
(42, 'Ian', 'Cardoni', '1990-06-12', 'ian_cardoni-517632.webp'),
(43, 'Cillian', 'Murphy', '1976-05-25', 'cillian_murphy-487123.jpeg'),
(44, 'Helen', 'McCrory', '1968-08-17', 'helen_mccrory-672411.jpeg'),
(45, 'Benedict', 'Cumberbatch', '1976-07-19', 'benedict_cumberbatch-563462.jpeg'),
(46, 'Martin', 'Freeman', '1971-09-08', 'martin_freeman-643345.jpeg'),
(47, 'Will', 'Arnett', '1970-05-04', 'will_arnett-944384.jpeg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dostepnosc_na_platformach`
--

CREATE TABLE `dostepnosc_na_platformach` (
  `id` int(11) NOT NULL,
  `typ_tresci` text NOT NULL,
  `id_tresci` int(11) NOT NULL,
  `id_platformy` int(11) NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dostepnosc_na_platformach`
--

INSERT INTO `dostepnosc_na_platformach` (`id`, `typ_tresci`, `id_tresci`, `id_platformy`, `link`) VALUES
(1, 'film', 1, 1, 'https://www.netflix.com/pl/title/70060010'),
(2, 'serial', 1, 2, 'https://www.hbomax.com/pl/pl/shows/czarnobyl/396999a6-3fff-4af3-802b-10c46d10deff'),
(3, 'film', 2, 1, 'https://www.netflix.com/pl/title/70005379'),
(4, 'film', 3, 2, 'https://www.hbomax.com/pl/pl/movies/wladca-pierscieni-druzyna-pierscienia/fb9f961f-6302-4776-91d7-f1b7a69fb61d'),
(5, 'film', 3, 1, 'https://www.netflix.com/pl/title/60004480'),
(6, 'film', 3, 3, 'https://www.primevideo.com/detail/0N0CRBLY1S5GDA4EVTQ34LF5GN/?language=pl'),
(7, 'film', 4, 4, 'https://www.skyshowtime.com/watch/asset/movies/ojciec-chrzestny/44b917c8-bf71-3297-850f-dfcc4e39edd6'),
(8, 'film', 4, 1, 'https://www.netflix.com/pl/title/60011152'),
(9, 'film', 5, 5, 'https://www.disneyplus.com/pl-pl/browse/entity-ce1ccdca-f468-4960-b67c-026b01ba42ab'),
(10, 'film', 6, 3, 'https://www.primevideo.com/detail/0PUNMGZEWOMYFKR1XIGOLTL2YM/?language=pl'),
(11, 'film', 7, 4, 'https://www.skyshowtime.com/watch/asset/movies/pulp-fiction/95cd515e-8c9f-3c93-aa64-4fa155ad37bd'),
(12, 'film', 7, 1, 'https://www.netflix.com/pl/title/880640'),
(13, 'film', 8, 5, 'https://www.disneyplus.com/pl-pl/browse/entity-a3ae7371-39a5-4c0b-a1f2-29a70b372848'),
(14, 'serial', 2, 1, 'https://www.netflix.com/pl/title/70143836'),
(15, 'serial', 3, 3, 'https://www.primevideo.com/detail/0GQTRXWTJFHS0DKID09GPGGYKY/?language=pl'),
(16, 'serial', 3, 2, 'https://www.hbomax.com/pl/pl/shows/gra-o-tron/4f6b4985-2dc9-4ab6-ac79-d60f0860b0ac'),
(17, 'serial', 4, 1, 'https://www.netflix.com/pl/title/80049832'),
(18, 'serial', 5, 3, 'https://www.primevideo.com/detail/0PM4PU8J04LIPT01GMPPMG4D9K/?language=pl'),
(19, 'serial', 5, 2, 'https://www.hbomax.com/pl/pl/shows/kompania-braci/6a0a0227-f567-46ba-9a2d-04374c5f6193'),
(20, 'serial', 6, 3, 'https://www.primevideo.com/detail/0H7JFOPK2QO9WVZ8D9D0J5ZRQN/?language=pl'),
(21, 'serial', 6, 4, 'https://www.skyshowtime.com/watch/asset/tv/the-office/3ccdfdde-91cd-3021-93af-9337210a95da'),
(22, 'serial', 6, 1, 'https://www.netflix.com/pl/title/70136120'),
(23, 'serial', 6, 5, 'https://www.disneyplus.com/pl-pl/browse/entity-d78edbe8-7897-4a3a-b358-c705986c71ad'),
(24, 'serial', 7, 3, 'https://www.primevideo.com/detail/0O5DTUU5FKCR487B3G08H826NL/?language=pl'),
(25, 'serial', 7, 2, 'https://www.hbomax.com/pl/pl/shows/rick-i-morty/ab553cdc-e15d-4597-b65f-bec9201fd2dd'),
(26, 'serial', 7, 1, 'https://www.netflix.com/pl/title/80014749'),
(27, 'serial', 8, 6, 'https://vod.tvp.pl/seriale,18/peaky-blinders-odcinki,1891508'),
(28, 'serial', 8, 7, 'https://www.cda.pl/smediaPL/folder/36111429?fw=1'),
(29, 'serial', 9, 3, 'https://www.primevideo.com/detail/0QBPAEOS9TM1WB3TW5M8VGDS05/?language=pl'),
(30, 'serial', 9, 1, 'https://www.netflix.com/pl/title/70202589'),
(31, 'serial', 10, 1, 'https://www.netflix.com/pl/title/70300800');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `filmy`
--

CREATE TABLE `filmy` (
  `id` int(11) NOT NULL,
  `tytul` text NOT NULL,
  `rok_produkcji` int(11) NOT NULL,
  `czas_trwania` int(11) NOT NULL,
  `opis` text NOT NULL,
  `plakat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filmy`
--

INSERT INTO `filmy` (`id`, `tytul`, `rok_produkcji`, `czas_trwania`, `opis`, `plakat`) VALUES
(1, 'Film o pszczołach', 2007, 90, 'Niepozorna pszczoła postanawia położyć kres wyzyskiwaniu swojego gatunku przez ludzkość i rozpoczyna sądową batalię z handlującymi miodem korporacjami.', 'film_o_pszczolach-839201.jpg'),
(2, 'Skazani na Shawshank', 1994, 142, 'Adaptacja opowiadania Stephena Kinga. Niesłusznie skazany na dożywocie bankier, stara się przetrwać w brutalnym, więziennym świecie.', 'skazani_na_shawshank-482621.jpg'),
(3, 'Władca Pierścieni: Drużyna Pierścienia', 2001, 178, 'Podróż hobbita z Shire i jego ośmiu towarzyszy, której celem jest zniszczenie potężnego pierścienia pożądanego przez Czarnego Władcę - Saurona. ', 'wladca_pierscieni_druzyna_pierscienia-481902.jpg'),
(4, 'Ojciec chrzestny', 1972, 175, 'Opowieść o nowojorskiej rodzinie mafijnej. Starzejący się Don Corleone pragnie przekazać władzę swojemu synowi.', 'ojciec_chrzestny-4972112.jpg'),
(5, 'Coco', 2017, 105, 'Dwunastoletni meksykański chłopiec imieniem Miguel usiłuje zgłębić tajemnice rodzinnej legendy.', 'coco-295731.jpeg'),
(6, 'Interstellar', 2014, 169, 'Byt ludzkości na Ziemi dobiega końca wskutek zmian klimatycznych. Grupa naukowców odkrywa tunel czasoprzestrzenny, który umożliwia poszukiwanie nowego domu.', 'interstellar-568422.jpg'),
(7, 'Pulp Fiction', 1994, 154, 'Przemoc i odkupienie w opowieści o dwóch płatnych mordercach pracujących na zlecenie mafii, żonie gangstera, bokserze i parze okradającej ludzi w restauracji.', 'pulp_fiction-581973.jpg'),
(8, 'Król Lew', 1994, 89, 'Targany niesłusznymi wyrzutami sumienia po śmierci ojca mały lew Simba skazuje się na wygnanie, rezygnując z przynależnego mu miejsca na czele stada.', 'krol_lew-482632.jpg'),
(9, 'Nietykalni', 2011, 112, 'Sparaliżowany milioner zatrudnia do opieki młodego chłopaka z przedmieścia, który właśnie wyszedł z więzienia.', 'nietykalni-486623.webp'),
(10, 'Incepcja', 2010, 148, 'Czasy, gdy technologia pozwala na wchodzenie w świat snów. Złodziej Cobb ma za zadanie wszczepić myśl do śpiącego umysłu.', 'incepcja-573326.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `nazwa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`) VALUES
(1, 'Komedia'),
(2, 'Animacja'),
(3, 'Dramat'),
(4, 'Fantasy'),
(5, 'Przygodowy'),
(6, 'Gangsterski'),
(7, 'Familijny'),
(8, 'Sci-Fi'),
(9, 'Biograficzny'),
(10, 'Thriller'),
(11, 'Surrealistyczny'),
(12, 'Kryminał'),
(13, 'Dokumentalny'),
(14, 'Przyrodniczy'),
(15, 'Wojenny'),
(16, 'Animacja dla dorosłych'),
(17, 'Dramat historyczny');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie_tresci`
--

CREATE TABLE `kategorie_tresci` (
  `id` int(11) NOT NULL,
  `typ_tresci` text NOT NULL,
  `id_tresci` int(11) NOT NULL,
  `id_kategorii` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorie_tresci`
--

INSERT INTO `kategorie_tresci` (`id`, `typ_tresci`, `id_tresci`, `id_kategorii`) VALUES
(1, 'film', 1, 1),
(2, 'film', 1, 2),
(3, 'serial', 1, 3),
(4, 'film', 2, 3),
(5, 'film', 3, 4),
(6, 'film', 3, 5),
(7, 'film', 4, 3),
(8, 'film', 4, 6),
(9, 'film', 5, 2),
(10, 'film', 5, 7),
(11, 'film', 5, 5),
(12, 'film', 6, 8),
(13, 'film', 7, 6),
(14, 'film', 8, 2),
(15, 'film', 8, 7),
(16, 'film', 9, 9),
(17, 'film', 9, 3),
(18, 'film', 9, 1),
(19, 'film', 10, 8),
(20, 'film', 10, 10),
(21, 'film', 10, 11),
(22, 'serial', 2, 12),
(23, 'serial', 2, 3),
(24, 'serial', 3, 5),
(25, 'serial', 3, 3),
(26, 'serial', 3, 4),
(27, 'serial', 4, 13),
(28, 'serial', 4, 14),
(29, 'serial', 5, 3),
(30, 'serial', 5, 15),
(31, 'serial', 6, 1),
(32, 'serial', 7, 5),
(33, 'serial', 7, 1),
(34, 'serial', 7, 8),
(35, 'serial', 7, 16),
(36, 'serial', 8, 17),
(37, 'serial', 8, 12),
(38, 'serial', 9, 3),
(39, 'serial', 9, 12),
(40, 'serial', 10, 3),
(41, 'serial', 10, 1),
(42, 'serial', 10, 16);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentarze`
--

CREATE TABLE `komentarze` (
  `id` int(11) NOT NULL,
  `typ_tresci` text NOT NULL,
  `id_tresci` int(11) NOT NULL,
  `nazwa_uzytkownika` text NOT NULL,
  `komentarz` text NOT NULL,
  `polubienia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentarze`
--

INSERT INTO `komentarze` (`id`, `typ_tresci`, `id_tresci`, `nazwa_uzytkownika`, `komentarz`, `polubienia`) VALUES
(1, 'film', 1, 'user123', 'fajny film', 3),
(2, 'serial', 1, 'user123', 'fajny serial', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
  `id` int(11) NOT NULL,
  `typ_tresci` text NOT NULL,
  `id_tresci` int(11) NOT NULL,
  `ocena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oceny`
--

INSERT INTO `oceny` (`id`, `typ_tresci`, `id_tresci`, `ocena`) VALUES
(1, 'film', 1, 7),
(2, 'serial', 1, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `platformy`
--

CREATE TABLE `platformy` (
  `id` int(11) NOT NULL,
  `nazwa` text NOT NULL,
  `ikona` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `platformy`
--

INSERT INTO `platformy` (`id`, `nazwa`, `ikona`) VALUES
(1, 'Netflix', 'netflix-271631.png'),
(2, 'HBO Max', 'hbo_max-284671.jpg'),
(3, 'Prime Video', 'prime_video-673451.png'),
(4, 'SkyShowtime', 'skyshowtime-432141.png'),
(5, 'Disney+', 'disney_plus-584562.png'),
(6, 'TVP VOD', 'tvp_vod-375242.png'),
(7, 'CDA Premium', 'cda_premium-568834.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkcje_rezyserow`
--

CREATE TABLE `produkcje_rezyserow` (
  `id` int(11) NOT NULL,
  `typ_tresci` text NOT NULL,
  `id_tresci` int(11) NOT NULL,
  `id_rezysera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkcje_rezyserow`
--

INSERT INTO `produkcje_rezyserow` (`id`, `typ_tresci`, `id_tresci`, `id_rezysera`) VALUES
(1, 'film', 1, 1),
(2, 'film', 1, 2),
(3, 'serial', 1, 3),
(4, 'film', 2, 4),
(5, 'film', 3, 5),
(6, 'film', 4, 6),
(7, 'film', 5, 7),
(8, 'film', 6, 8),
(9, 'film', 7, 9),
(10, 'film', 8, 10),
(11, 'film', 8, 11),
(12, 'film', 5, 12),
(13, 'film', 9, 13),
(14, 'film', 9, 14),
(15, 'serial', 2, 15),
(16, 'serial', 3, 16),
(17, 'serial', 3, 17),
(18, 'serial', 4, 18),
(19, 'serial', 5, 19),
(20, 'serial', 6, 20),
(21, 'serial', 7, 21),
(22, 'serial', 8, 22),
(23, 'serial', 9, 23),
(24, 'serial', 10, 24),
(25, 'film', 10, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezyserzy`
--

CREATE TABLE `rezyserzy` (
  `id` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `data_urodzenia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rezyserzy`
--

INSERT INTO `rezyserzy` (`id`, `imie`, `nazwisko`, `data_urodzenia`) VALUES
(1, 'Steve', 'Hickner', '1961-01-10'),
(2, 'Simon James', 'Smith', '1968-09-16'),
(3, 'Johan', 'Renck', '1966-12-05'),
(4, 'Frank', 'Darabont', '1959-01-28'),
(5, 'Peter', 'Jackson', '1961-10-31'),
(6, 'Francis Ford', 'Coppola', '1939-04-07'),
(7, 'Lee', 'Unkrich', '1967-08-08'),
(8, 'Christopher', 'Nolan', '1970-07-30'),
(9, 'Quentin', 'Tarantino', '1963-03-27'),
(10, 'Rob', 'Minkoff', '1962-08-11'),
(11, 'Roger ', 'Allers', '1949-06-29'),
(12, 'Adrian', 'Molina', '1985-08-25'),
(13, 'Olivier', 'Nakache', '1973-04-14'),
(14, 'Éric', 'Toledano', '1971-07-03'),
(15, 'Vince', 'Gilligan', '1967-02-10'),
(16, 'David', 'Benioff', '1970-09-25'),
(17, 'Daniel Brett', 'Weiss', '1971-04-23'),
(18, 'Alastair', 'Fothergill', '1960-04-10'),
(19, 'Steven', 'Spielberg', '1946-12-18'),
(20, 'Randall', 'Einhorn', '1963-12-07'),
(21, 'Pete', 'Michels', '1964-12-15'),
(22, 'Steven', 'Knight', '1959-08-05'),
(23, 'Mark', 'Gatiss', '1966-10-17'),
(24, 'Amy', 'Winfrey', '1976-05-13');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `seriale`
--

CREATE TABLE `seriale` (
  `id` int(11) NOT NULL,
  `tytul` text NOT NULL,
  `rok_produkcji` text NOT NULL,
  `ilosc_sezonow` int(11) NOT NULL,
  `opis` text NOT NULL,
  `plakat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seriale`
--

INSERT INTO `seriale` (`id`, `tytul`, `rok_produkcji`, `ilosc_sezonow`, `opis`, `plakat`) VALUES
(1, 'Czarnobyl', '2019', 1, 'Po wybuchu elektrowni jądrowej w Czarnobylu ratownicy poświęcają zdrowie i życie, by ratować Europę przed skutkami katastrofy.', 'czarnobyl-482362.jpg'),
(2, 'Breaking Bad', '2008 - 2013', 5, 'Gdy nauczyciel chemii dowiaduje się, że ma raka, postanawia rozpocząć produkcję metamfetaminy, by finansowo zabezpieczyć swoją rodzinę.', 'breaking_bad-234821.jpg'),
(3, 'Gra o tron', '2011 - 2019', 8, 'Adaptacja sagi George\'a R.R. Martina. W królestwie Westeros walka o władzę, spiski oraz zbrodnie są na porządku dziennym.', 'gra_o_tron-523412.jpg'),
(4, 'Nasza planeta', '2019 - 2023', 2, 'Widowiskowe ujęcia rzadko spotykanych zwierząt zostają zestawione z gorzkimi refleksjami o wpływie ludzkości na ich siedliska i inne gatunki zamieszkujące naszą planetę.', 'nasza_planeta-634531.webp'),
(5, 'Kompania braci', '2001', 1, 'Losy Kompanii E, 506 pułku piechoty spadochronowej, 101 Dywizji Powietrznodesantowej Armii USA opowiedziane z perspektywy tych, którzy przeżyli drugą wojnę światową. ', 'kompania_braci-587236.jpg'),
(6, 'Biuro', '2005 - 2013', 9, 'Kamery towarzyszą pracownikom oddziału firmy sprzedającej artykuły papierowe w czasie ich codziennych obowiązków.', 'biuro-571623.jpg'),
(7, 'Rick i Morty', '2013', 8, 'Ekscentryczny naukowiec Rick udaje się ze swoim wnukiem Mortym do najdziwniejszych miejsc w galaktyce i alternatywnych rzeczywistości.', 'rick_i_morty-343212.jpg'),
(8, 'Peaky Blinders', '2013 - 2022', 6, 'Należący do gangsterskiej rodziny z Birmingham Tommy Shelby usiłuje zwiększyć swoje wpływy, wykorzystując skradziony transport broni.', 'peaky_blinders-636386.jpg'),
(9, 'Sherlock', '2010 - 2017', 4, 'John Watson jest lekarzem wojskowym, który niedawno wrócił z wojny. Gdy poznaje genialnego detektywa Sherlocka Holmesa, zaczyna pomagać mu w rozwiązywaniu zagadek kryminalnych.', 'sherlock-627412.jpg'),
(10, 'BoJack Horseman', '2014 - 2020', 6, 'BoJack Horseman, koń-aktor znany z emitowanego w latach 90. sitcomu, próbuje ratować swoją karierę w brutalnym świecie gwiazd i celebrytów.', 'bojack_horseman-458282.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wystepy_aktorow`
--

CREATE TABLE `wystepy_aktorow` (
  `id` int(11) NOT NULL,
  `typ_tresci` text NOT NULL,
  `id_tresci` int(11) NOT NULL,
  `id_aktora` int(11) NOT NULL,
  `rola` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wystepy_aktorow`
--

INSERT INTO `wystepy_aktorow` (`id`, `typ_tresci`, `id_tresci`, `id_aktora`, `rola`) VALUES
(1, 'film', 1, 1, 'Barry B. Benson'),
(2, 'film', 1, 2, 'Vanessa Bloome'),
(3, 'film', 1, 3, 'Adam Flayman'),
(4, 'serial', 1, 4, 'Walerij Legasow'),
(5, 'serial', 1, 5, 'Boris Szczerbina'),
(6, 'serial', 1, 6, 'Uliana Chomiuk'),
(7, 'film', 1, 7, 'Ken'),
(8, 'film', 1, 8, 'Layton T. Montgomery'),
(9, 'film', 1, 9, 'Mooseblood'),
(10, 'film', 1, 10, 'Janet Benson'),
(11, 'film', 1, 11, 'Martin Benson'),
(12, 'film', 1, 12, 'Bee Larry King'),
(13, 'filmy', 2, 13, 'Andy Dufresne'),
(14, 'film', 2, 14, 'Ellis Boyd \"Red\" Redding'),
(15, 'film', 2, 15, 'Naczelnik Samuel Norton'),
(16, 'film', 3, 16, 'Frodo Baggins'),
(17, 'film', 3, 17, 'Samwise \"Sam\" Gamgee'),
(18, 'film', 4, 18, 'Don Vito Corleone'),
(19, 'film', 4, 19, 'Michael Corleone'),
(20, 'film', 5, 20, 'Miguel'),
(21, 'film', 5, 21, 'Hector'),
(22, 'film', 6, 22, 'Cooper'),
(23, 'film', 6, 23, 'Brand'),
(24, 'film', 7, 24, 'Vincent Vega'),
(25, 'film', 7, 25, 'Jules Winnfield'),
(26, 'film', 8, 3, 'Dorosły Simba'),
(27, 'film', 8, 26, 'Dorosła Nala'),
(28, 'film', 9, 27, 'Philippe'),
(29, 'film', 9, 28, 'Driss'),
(30, 'film', 10, 29, 'Cobb'),
(31, 'film', 10, 30, 'Arthur'),
(32, 'serial', 2, 31, 'Walter Hartwell White'),
(33, 'serial', 2, 32, 'Jesse Pinkman'),
(34, 'serial', 3, 33, 'Tyrion Lannister'),
(35, 'serial', 3, 34, 'Cersei Lannister'),
(36, 'serial', 4, 35, 'lektor'),
(37, 'serial', 4, 36, 'lektor'),
(38, 'serial', 6, 37, 'Michael Scott'),
(39, 'serial', 6, 38, 'Pam Beesly'),
(40, 'serial', 5, 39, 'Major Richard D. Winters'),
(41, 'serial', 5, 40, 'Pułkownik Robert Sink'),
(42, 'serial', 7, 41, 'Morty Smith'),
(43, 'serial', 7, 42, 'Rick Sanchez'),
(44, 'serial', 8, 43, 'Thomas \"Tommy\" Shelby'),
(45, 'serial', 8, 44, 'Ciotka Polly Gray'),
(46, 'serial', 9, 45, 'Sherlock Holmes'),
(47, 'serial', 9, 46, 'Doktor John Watson'),
(48, 'serial', 10, 47, 'BoJack Horseman'),
(49, 'serial', 10, 32, 'Todd Chavez');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `aktorzy`
--
ALTER TABLE `aktorzy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `dostepnosc_na_platformach`
--
ALTER TABLE `dostepnosc_na_platformach`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_platformy` (`id_platformy`);

--
-- Indeksy dla tabeli `filmy`
--
ALTER TABLE `filmy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kategorie_tresci`
--
ALTER TABLE `kategorie_tresci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategorii` (`id_kategorii`);

--
-- Indeksy dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `platformy`
--
ALTER TABLE `platformy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `produkcje_rezyserow`
--
ALTER TABLE `produkcje_rezyserow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rezysera` (`id_rezysera`);

--
-- Indeksy dla tabeli `rezyserzy`
--
ALTER TABLE `rezyserzy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `seriale`
--
ALTER TABLE `seriale`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wystepy_aktorow`
--
ALTER TABLE `wystepy_aktorow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aktora` (`id_aktora`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `aktorzy`
--
ALTER TABLE `aktorzy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `dostepnosc_na_platformach`
--
ALTER TABLE `dostepnosc_na_platformach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `filmy`
--
ALTER TABLE `filmy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kategorie_tresci`
--
ALTER TABLE `kategorie_tresci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `komentarze`
--
ALTER TABLE `komentarze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oceny`
--
ALTER TABLE `oceny`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `platformy`
--
ALTER TABLE `platformy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produkcje_rezyserow`
--
ALTER TABLE `produkcje_rezyserow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rezyserzy`
--
ALTER TABLE `rezyserzy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `seriale`
--
ALTER TABLE `seriale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wystepy_aktorow`
--
ALTER TABLE `wystepy_aktorow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dostepnosc_na_platformach`
--
ALTER TABLE `dostepnosc_na_platformach`
  ADD CONSTRAINT `dostepnosc_na_platformach_ibfk_1` FOREIGN KEY (`id_platformy`) REFERENCES `platformy` (`id`);

--
-- Constraints for table `kategorie_tresci`
--
ALTER TABLE `kategorie_tresci`
  ADD CONSTRAINT `kategorie_tresci_ibfk_1` FOREIGN KEY (`id_kategorii`) REFERENCES `kategorie` (`id`);

--
-- Constraints for table `produkcje_rezyserow`
--
ALTER TABLE `produkcje_rezyserow`
  ADD CONSTRAINT `produkcje_rezyserow_ibfk_1` FOREIGN KEY (`id_rezysera`) REFERENCES `rezyserzy` (`id`);

--
-- Constraints for table `wystepy_aktorow`
--
ALTER TABLE `wystepy_aktorow`
  ADD CONSTRAINT `wystepy_aktorow_ibfk_1` FOREIGN KEY (`id_aktora`) REFERENCES `aktorzy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
