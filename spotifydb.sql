-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2024 at 08:25 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spotifydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE IF NOT EXISTS `albums` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titlu` varchar(200) NOT NULL,
  `an_aparitie` year NOT NULL,
  `id_band` int NOT NULL,
  `durata` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_album_band` (`id_band`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `titlu`, `an_aparitie`, `id_band`, `durata`) VALUES
(1, 'Back in Black', '1980', 1, '23:11:00'),
(2, 'Highway to Hell', '1979', 1, '41:31:00'),
(3, 'Master of Puppets', '1986', 2, '54:47:00'),
(4, '...And Justice for All', '1988', 2, '65:25:00'),
(5, 'A Night at the Opera', '1975', 3, '43:08:00'),
(6, 'The Game', '1980', 3, '35:39:00'),
(7, 'The Dark Side of the Moon', '1973', 4, '42:49:00'),
(8, 'The Wall', '1979', 4, '81:09:00'),
(9, 'Led Zeppelin IV', '1971', 5, '42:34:00'),
(10, 'Physical Graffiti', '1975', 5, '82:15:00'),
(11, 'Sticky Fingers', '1971', 6, '46:25:00'),
(12, 'Some Girls', '1978', 6, '40:45:00'),
(13, 'Nevermind', '1991', 7, '42:38:00'),
(14, 'In Utero', '1993', 7, '41:23:00'),
(15, 'Hotel California', '1976', 8, '43:28:00'),
(16, 'Desperado', '1973', 8, '35:40:00'),
(17, 'Toys in the Attic', '1975', 9, '37:08:00'),
(18, 'Pump', '1989', 9, '47:44:00'),
(19, 'Arrival', '1976', 10, '33:05:00'),
(20, 'Super Trouper', '1980', 10, '41:57:00'),
(21, 'Saturday Night Fever', '1977', 11, '75:54:00'),
(22, 'Spirits Having Flown', '1979', 11, '45:28:00'),
(23, 'Parachutes', '2000', 12, '41:49:00'),
(24, 'A Rush of Blood to the Head', '2002', 12, '54:08:00'),
(25, 'Discovery', '2001', 13, '60:34:00'),
(26, 'Random Access Memories', '2013', 13, '74:24:00'),
(27, 'Sweet Dreams (Are Made of This)', '1983', 14, '42:34:00'),
(28, 'Touch', '1983', 14, '45:30:00'),
(29, 'Rumours', '1977', 15, '39:43:00'),
(30, 'Tusk', '1979', 15, '74:25:00'),
(31, 'Gorillaz', '2001', 16, '63:48:00'),
(32, 'Demon Days', '2005', 16, '50:47:00'),
(33, 'Night Visions', '2012', 17, '44:06:00'),
(34, 'Smoke + Mirrors', '2015', 17, '50:54:00'),
(35, 'Escape', '1981', 18, '42:46:00'),
(36, 'Frontiers', '1983', 18, '44:25:00'),
(37, 'Autobahn', '1974', 19, '42:36:00'),
(38, 'The Man-Machine', '1978', 19, '36:19:00'),
(39, 'Sgt. Pepper\'s Lonely Hearts Club Band', '1967', 20, '39:36:00'),
(41, 'Osod', '2003', 12, '23:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_band` int NOT NULL,
  `nume_artist` varchar(200) NOT NULL,
  `prenume_artist` varchar(200) NOT NULL,
  `data_nasterii` date NOT NULL,
  `tara_origine` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_artist_band` (`id_band`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `id_band`, `nume_artist`, `prenume_artist`, `data_nasterii`, `tara_origine`) VALUES
(1, 1, 'Angus', 'Young', '1955-03-31', 'Scotland'),
(2, 2, 'James', 'Hetfield', '1963-08-03', 'USA'),
(3, 3, 'Freddie', 'Mercury', '1946-09-05', 'Zanzibar'),
(4, 4, 'David', 'Gilmour', '1946-03-06', 'UK'),
(5, 5, 'Robert', 'Plant', '1948-08-20', 'UK'),
(6, 6, 'Mick', 'Jagger', '1943-07-26', 'UK'),
(7, 7, 'Kurt', 'Cobain', '1967-02-20', 'USA'),
(8, 8, 'Don', 'Henley', '1947-07-22', 'USA'),
(9, 9, 'Steven', 'Tyler', '1948-03-26', 'USA'),
(10, 10, 'Agnetha', 'Faltskog', '1950-04-05', 'Sweden'),
(11, 11, 'Barry', 'Gibb', '1946-09-01', 'UK'),
(12, 12, 'Chris', 'Martin', '1977-03-02', 'UK'),
(13, 13, 'Thomas', 'Bangalter', '1975-01-03', 'France'),
(14, 14, 'Annie', 'Lennox', '1954-12-25', 'UK'),
(15, 15, 'Stevie', 'Nicks', '1948-05-26', 'USA'),
(16, 16, 'Damon', 'Albarn', '1968-03-23', 'UK'),
(17, 17, 'Dan', 'Reynolds', '1987-07-14', 'USA'),
(18, 18, 'Steve', 'Perry', '1949-01-22', 'USA'),
(19, 19, 'Ralf', 'Hutter', '1946-08-20', 'Germany');

-- --------------------------------------------------------

--
-- Table structure for table `bands`
--

DROP TABLE IF EXISTS `bands`;
CREATE TABLE IF NOT EXISTS `bands` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nume` varchar(200) NOT NULL,
  `nr_membrii` int NOT NULL,
  `an_fondare` year DEFAULT NULL,
  `tara_origine` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bands`
--

INSERT INTO `bands` (`id`, `nume`, `nr_membrii`, `an_fondare`, `tara_origine`) VALUES
(1, 'AC/DC', 5, '1973', 'Australia'),
(2, 'Metallica', 4, '1981', 'SUA'),
(3, 'Queen', 4, '1970', 'UK'),
(4, 'Pink Floyd', 5, '1965', 'UK'),
(5, 'Led Zeppelin', 4, '1968', 'UK'),
(6, 'The Rolling Stones', 5, '1962', 'UK'),
(7, 'Nirvana', 3, '1987', 'SUA'),
(8, 'The Eagles', 5, '1971', 'SUA'),
(9, 'Aerosmith', 5, '1970', 'SUA'),
(10, 'ABBA', 4, '1972', 'Suedia'),
(11, 'Bee Gees', 3, '1958', 'UK'),
(12, 'Coldplay', 4, '1996', 'UK'),
(13, 'Daft Punk', 2, '1993', 'Franta'),
(14, 'Eurythmics', 2, '1980', 'UK'),
(15, 'Fleetwood Mac', 7, '1967', 'UK'),
(16, 'Gorillaz', 4, '1998', 'UK'),
(17, 'Imagine Dragons', 4, '2008', 'SUA'),
(18, 'Journey', 5, '1973', 'SUA'),
(19, 'Kraftwerk', 4, '1970', 'Germania'),
(20, 'The Beatles', 4, '1960', 'UK');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categorie` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categorie` (`categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categorie`) VALUES
(1, 'Pop'),
(2, 'Disco'),
(3, 'Rock/Pop'),
(4, 'Electronic'),
(5, 'New Wave'),
(6, 'Rock'),
(7, 'Virtual Band'),
(8, 'Pop Rock'),
(9, 'Soft Rock'),
(10, 'Electronic/Experimental');

-- --------------------------------------------------------

--
-- Table structure for table `composers`
--

DROP TABLE IF EXISTS `composers`;
CREATE TABLE IF NOT EXISTS `composers` (
  `id_compozitor` int NOT NULL AUTO_INCREMENT,
  `id_melodie` int NOT NULL,
  `id_band` int NOT NULL,
  `nume_compozitor` varchar(200) NOT NULL,
  `prenume_compozitor` varchar(200) NOT NULL,
  PRIMARY KEY (`id_compozitor`),
  KEY `fk_composer_band` (`id_band`),
  KEY `fk_composer_song` (`id_melodie`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `composers`
--

INSERT INTO `composers` (`id_compozitor`, `id_melodie`, `id_band`, `nume_compozitor`, `prenume_compozitor`) VALUES
(1, 1, 1, 'Young', 'Angus'),
(2, 2, 1, 'Young', 'Angus'),
(3, 3, 2, 'Hetfield', 'James'),
(4, 4, 2, 'Hetfield', 'James'),
(5, 5, 3, 'Mercury', 'Freddie'),
(6, 6, 3, 'Deacon', 'John'),
(7, 7, 4, 'Waters', 'Roger'),
(8, 8, 4, 'Gilmour', 'David'),
(9, 9, 5, 'Page', 'Jimmy'),
(10, 10, 5, 'Page', 'Jimmy'),
(11, 11, 6, 'Jagger', 'Mick'),
(12, 12, 6, 'Jagger', 'Mick'),
(13, 13, 7, 'Cobain', 'Kurt'),
(14, 14, 7, 'Cobain', 'Kurt'),
(15, 15, 8, 'Frey', 'Glenn'),
(16, 16, 8, 'Henley', 'Don'),
(17, 17, 9, 'Tyler', 'Steven'),
(18, 18, 9, 'Tyler', 'Steven'),
(19, 19, 10, 'Andersson', 'Benny'),
(20, 20, 10, 'Andersson', 'Benny'),
(21, 21, 11, 'Gibb', 'Barry'),
(22, 22, 11, 'Gibb', 'Barry'),
(23, 23, 12, 'Martin', 'Chris'),
(24, 24, 12, 'Martin', 'Chris'),
(25, 25, 13, 'Bangalter', 'Thomas'),
(26, 26, 13, 'Bangalter', 'Thomas'),
(27, 27, 14, 'Lennox', 'Annie'),
(28, 28, 14, 'Lennox', 'Annie'),
(29, 29, 15, 'Nicks', 'Stevie'),
(30, 30, 15, 'Nicks', 'Stevie'),
(31, 31, 16, 'Albarn', 'Damon'),
(32, 32, 16, 'Albarn', 'Damon'),
(33, 33, 17, 'Reynolds', 'Dan'),
(34, 34, 17, 'Reynolds', 'Dan'),
(35, 35, 18, 'Perry', 'Steve'),
(36, 36, 18, 'Perry', 'Steve'),
(37, 37, 19, 'Hutter', 'Ralf'),
(38, 38, 19, 'Hutter', 'Ralf'),
(39, 39, 20, 'Lennon', 'John'),
(40, 40, 20, 'Lennon', 'John');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE IF NOT EXISTS `songs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_categorie` int NOT NULL,
  `id_album` int NOT NULL,
  `titlu` varchar(200) NOT NULL,
  `durata_melodie` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_song_album` (`id_album`),
  KEY `fk_song_category` (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `id_categorie`, `id_album`, `titlu`, `durata_melodie`) VALUES
(1, 6, 1, 'Back in Black', '00:04:15'),
(2, 6, 2, 'Highway to Hell', '00:03:28'),
(3, 6, 3, 'Master of Puppets', '00:08:35'),
(4, 6, 4, '...And Justice for All', '00:09:44'),
(5, 1, 5, 'Bohemian Rhapsody', '00:05:55'),
(6, 1, 6, 'Another One Bites the Dust', '00:06:28'),
(7, 3, 7, 'Time', '00:03:09'),
(8, 3, 8, 'Comfortably Numb', '00:05:15'),
(9, 6, 9, 'Stairway to Heaven', '00:08:07'),
(10, 6, 10, 'Kashmir', '00:04:36'),
(11, 6, 11, 'Brown Sugar', '00:05:36'),
(12, 6, 12, 'Miss You', '00:03:43'),
(13, 6, 13, 'Smells Like Teen Spirit', '00:07:15'),
(14, 6, 14, 'Heart-Shaped Box', '00:04:30'),
(15, 6, 15, 'Hotel California', '00:07:21'),
(16, 6, 16, 'Desperado', '00:04:44'),
(17, 8, 17, 'Sweet Emotion', '00:06:37'),
(18, 8, 18, 'Love in an Elevator', '00:03:41'),
(19, 5, 19, 'Dancing Queen', '00:06:59'),
(20, 5, 20, 'The Winner Takes It All', '00:06:22'),
(21, 9, 21, 'Stayin\' Alive', '00:07:38'),
(22, 9, 22, 'Tragedy', '00:04:09'),
(23, 1, 23, 'Yellow', '00:04:31'),
(24, 1, 24, 'Clocks', '00:05:24'),
(25, 10, 25, 'One More Time', '00:05:37'),
(26, 10, 26, 'Get Lucky', '00:04:57'),
(27, 1, 27, 'Sweet Dreams (Are Made of This)', '00:04:27'),
(28, 1, 28, 'Here Comes the Rain Again', '00:05:59'),
(29, 9, 29, 'Go Your Own Way', '00:04:50'),
(30, 9, 30, 'Tusk', '00:03:42'),
(31, 7, 31, 'Clint Eastwood', '00:04:36'),
(32, 7, 32, 'Feel Good Inc.', '00:04:59'),
(33, 1, 33, 'Radioactive', '00:04:23'),
(34, 1, 34, 'I Bet My Life', '00:04:59'),
(35, 6, 35, 'Don\'t Stop Believin\'', '00:06:29'),
(36, 6, 36, 'Separate Ways (Worlds Apart)', '00:06:33'),
(37, 2, 37, 'Autobahn', '00:05:30'),
(38, 2, 38, 'The Robots', '00:04:39'),
(39, 1, 39, 'Lucy in the Sky with Diamonds', '00:03:38'),
(40, 1, 41, 'Come Together', '00:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'Indius', 'gablion999@gmail.com', '$2y$10$V9NjlgfA8asEDOseVWfGCeX2gQFIqlH8PoUIUya6.G1S5DLFMkf5G', 'admin'),
(2, 'dandan', 'email@email.com', '$2y$10$b86g2rV3LGAwwDaV.QNN5uxpPUehLHXnQYYhMGv0nLbXzwS89Q8dq', 'admin'),
(5, 'test', 'email@gmail.com', '$2y$10$0Lc0xMmKHguL1ebOk7ZVu.RS0VdVqnNxOwjqs80jGnWtdnYiKbJlG', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
