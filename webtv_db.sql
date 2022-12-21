-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 05 juil. 2022 à 02:30
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `webtv_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(12) NOT NULL AUTO_INCREMENT,
  `course_libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_teacher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_level` int(11) NOT NULL,
  `course_degree` int(11) NOT NULL,
  `course_file` int(11) DEFAULT NULL,
  `course_date` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`course_id`),
  KEY `course_level` (`course_level`),
  KEY `course_degree` (`course_degree`),
  KEY `course_file` (`course_file`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `course`
--

INSERT INTO `course` (`course_id`, `course_libelle`, `course_description`, `course_teacher`, `course_level`, `course_degree`, `course_file`, `course_date`) VALUES
(23, 'Genie Logiciel', 'Importance du génie logiciel', 'jean DUPONT', 1, 2, 32, '04/07/22');

-- --------------------------------------------------------

--
-- Structure de la table `degree`
--

DROP TABLE IF EXISTS `degree`;
CREATE TABLE IF NOT EXISTS `degree` (
  `degree_id` int(12) NOT NULL AUTO_INCREMENT,
  `degree_libelle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`degree_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `degree`
--

INSERT INTO `degree` (`degree_id`, `degree_libelle`) VALUES
(1, 'securite informatique'),
(2, 'internet et multimedia'),
(3, 'Genie Logiciel'),
(4, 'administration des systemes informatiques et des reseaux');

-- --------------------------------------------------------

--
-- Structure de la table `file`
--

DROP TABLE IF EXISTS `file`;
CREATE TABLE IF NOT EXISTS `file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `file`
--

INSERT INTO `file` (`file_id`, `file_name`, `file_extension`, `file_size`) VALUES
(32, 'uploads_418205739', 'mp4', '542703');

-- --------------------------------------------------------

--
-- Structure de la table `level`
--

DROP TABLE IF EXISTS `level`;
CREATE TABLE IF NOT EXISTS `level` (
  `level_id` int(12) NOT NULL AUTO_INCREMENT,
  `level_libelle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `level`
--

INSERT INTO `level` (`level_id`, `level_libelle`) VALUES
(1, 'licence 1'),
(2, 'licence 2'),
(3, 'licence 3'),
(4, 'master 1'),
(5, 'master 2');

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `profil_id` int(12) NOT NULL AUTO_INCREMENT,
  `profill_libelle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`profil_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`profil_id`, `profill_libelle`) VALUES
(1, 'etudiant'),
(2, 'administration');

-- --------------------------------------------------------

--
-- Structure de la table `program`
--

DROP TABLE IF EXISTS `program`;
CREATE TABLE IF NOT EXISTS `program` (
  `prog_id` int(11) NOT NULL AUTO_INCREMENT,
  `prog_libelle` varchar(255) NOT NULL,
  `prog_description` text NOT NULL,
  `prog_date` varchar(255) NOT NULL,
  `prog_hours` varchar(255) NOT NULL,
  `prog_prof` varchar(255) NOT NULL,
  `prog_level` int(11) NOT NULL,
  `prog_degree` int(11) NOT NULL,
  PRIMARY KEY (`prog_id`),
  KEY `prog_level` (`prog_level`) USING BTREE,
  KEY `prog_degree` (`prog_degree`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `program`
--

INSERT INTO `program` (`prog_id`, `prog_libelle`, `prog_description`, `prog_date`, `prog_hours`, `prog_prof`, `prog_level`, `prog_degree`) VALUES
(1, 'Algorithme ', 'Samba est un service permettant de partager des répertoires et imprimantes entre des stations Linux et des stations\r\nWindows. Un How-To très complet peut être trouvé là : http:/ / www. samba. org/ samba/ docs/ man/\r\nSamba-HOWTO-Collection/', '2022-07-08', '18:00', 'qwertza', 1, 1),
(2, 'TeleInformatique et REseaux', 'Samba est un service permettant de partager des répertoires et imprimantes entre des stations Linux et des stations\r\nWindows. Un How-To très complet peut être trouvé là : http:/ / www. samba. org/ samba/ docs/ man/\r\nSamba-HOWTO-Collection/', '2022-07-06', '18:00', 'Mathieu AGBEDJI', 1, 2),
(4, 'Langage C++', 'Samba est un service permettant de partager des répertoires et imprimantes entre des stations Linux et des stations\r\nWindows. Un How-To très complet peut être trouvé là : http:/ / www. samba. org/ samba/ docs/ man/\r\nSamba-HOWTO-Collection/', '2022-07-06', '22:00', 'Yves Laurent', 1, 1),
(5, 'JAVA', 'Samba est un service permettant de partager des répertoires et imprimantes entre des stations Linux et des stations\r\nWindows. Un How-To très complet peut être trouvé là : http:/ / www. samba. org/ samba/ docs/ man/\r\nSamba-HOWTO-Collection/', '2022-07-03', '12:00', 'Rogers ZANGNON', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_mail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_profil` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_birthday` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_level` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_degree` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_passwd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `use_profil` (`user_profil`),
  KEY `user_level` (`user_level`),
  KEY `user_degree` (`user_degree`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_mail`, `user_profil`, `user_birthday`, `user_level`, `user_degree`, `user_passwd`) VALUES
(1000000000, 'DUPONT jean', 'dupontjean@gmail.com', '1', '10/02/2001', '1', '1', ' $2y$10$JEZVoI6vWBKK8DndGTbLfuDLU8ftlSWvSqPP/JfizWFh0puivScz2 '),
(1000000002, 'Franck PIAGER', 'admin@ifritv.com', '2', '02/09/1986', '0', '0', '$2y$10$iHOVC0cyYJ3aqMxCvzc55.G2csiqERJCEF2YH0y1kdvRnTb.zKHOC'),
(1000000036, 'Azerty BELY', 'belyazerty@gmail.com', '1', '12/11/2012', '1', '2', '$2y$10$/Yxt8koPhx1Z7P70Q5.sv.1Hr/4MnnO7SXLOBU7g52pMUFs6QSvjW'),
(1000000005, 'Tino AMOUSSOU', 'avro@gmail.com', '1', '15/02/2000', '1', '2', '$2y$10$yKvQDyPzUOULsqNTTeQlmuEyIELoegY2TKDMM2NCVbBQ5b3eDDc8i'),
(1000000035, 'BOCO Qwerty', '', '1', '31/12/1986', '3', '3', NULL),
(1000000008, 'AVOCE Régis', 'boss@gmail.com', '1', '15/02/2000', '1', '2\r\n', ' $2y$10$28EMWSc3FOD.tn7GClyeEu9HZE9bHQSZ9Z83iX2M.khfJ9bmiynzm '),
(1000000033, 'Donné BELY', 'donabely@gmail.com', '1', '12/11/2002', '1', '1\r\n', '$2y$10$yzPrnN.c6wvDgxNTnLYYBujA3BaevNcmWvSzNlgCbMZR2TXnu2ty2'),
(1000000034, 'POUVISTE Qwertz', '', '1', '02/06/1998', '1', '2', NULL),
(1000000030, 'TONGOLO arobaz', 'arobaz@gmail.com', '1', '15/02/2000', '1', '1', '$2y$10$07yfGdRqtpvr5INb0heYROvkL3Q6xELsTKruvi1YwKAATAWttxNqa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
