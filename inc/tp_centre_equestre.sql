-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 30 mai 2023 à 06:50
-- Version du serveur : 5.7.40
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tp_centre_equestre`
--

-- --------------------------------------------------------

--
-- Structure de la table `cheval`
--

DROP TABLE IF EXISTS `cheval`;
CREATE TABLE IF NOT EXISTS `cheval` (
  `id_cheval` int(11) NOT NULL AUTO_INCREMENT,
  `SIRE` varchar(9) NOT NULL,
  `nom_cheval` varchar(65) NOT NULL,
  `id_robe` int(11) NOT NULL,
  `id_cav` int(11) DEFAULT NULL,
  `photo_cheval` varchar(255) DEFAULT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cheval`),
  KEY `fk_id_rob` (`id_robe`),
  KEY `fk_id_cav` (`id_cav`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cheval`
--

INSERT INTO `cheval` (`id_cheval`, `SIRE`, `nom_cheval`, `id_robe`, `id_cav`, `photo_cheval`, `valid`) VALUES
(1, '000000001', 'BIP BOP', 1, 5, 'BIP BOP202304270820.jpg', 1),
(2, '000000002', 'Aurore pure', 2, 2, 'Aurore pure202305240110.jpg', 0),
(3, '000000003', 'Horizon fluiviale', 3, 1, 'Horizon fluiviale202304270852.jpg', 1),
(4, '000000004', 'Rosee printaniere', 4, 1, 'Rosee printaniere202305240157.jpg', 1),
(5, '000000005', 'Vanille', 5, 4, 'Vanille202304270808.jpg', 1),
(6, '000000006', 'Chemin pourpre', 6, 5, 'Chemin pourpre202304270833.jpg', 1),
(7, '123456789', 'Fantaisy du clos', 9, 105, 'Fantaisy du clos202305240129.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `id_cours` int(11) NOT NULL,
  `id_week_cours` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `actif` tinyint(4) NOT NULL DEFAULT '1',
  `end_event` datetime NOT NULL,
  `start_event` datetime NOT NULL,
  PRIMARY KEY (`id_cours`,`id_week_cours`),
  UNIQUE KEY `composed_key_cours` (`id_cours`,`id_week_cours`),
  KEY `fk_id_cours` (`id_cours`),
  KEY `fk_id_week_cours` (`id_week_cours`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id_cours`, `id_week_cours`, `title`, `actif`, `end_event`, `start_event`) VALUES
(1, 1, 'test-cours', 1, '2023-04-03 13:00:00', '2023-04-03 13:00:00'),
(2, 2, 'Cours G4', 1, '2023-04-04 10:00:00', '2023-04-04 09:00:00'),
(3, 1, 'test', 1, '2023-04-23 08:04:00', '2023-04-23 08:04:00'),
(4, 1, 'test', 1, '2023-04-30 08:04:00', '2023-04-30 06:04:00'),
(5, 2, 'test', 1, '2023-05-07 08:05:00', '2023-05-07 06:05:00'),
(6, 1, 'cours_mercredi', 0, '2023-04-05 10:04:00', '2023-04-05 08:04:00'),
(7, 1, 'cours_mercredi2', 0, '2023-04-05 10:04:00', '2023-04-05 08:04:00'),
(8, 1, 'cours_mercredi3', 0, '2023-04-05 08:04:00', '2023-04-05 06:04:00'),
(9, 1, 'cours_occurrence', 1, '2023-04-22 12:48:39', '2023-04-22 12:48:39'),
(9, 2, 'cours_occurrence', 1, '2023-04-29 14:48:39', '2023-04-29 14:48:39'),
(10, 1, 'test-1001', 1, '2023-04-06 09:05:00', '2023-04-06 06:04:00'),
(10, 2, 'test-1001', 1, '2023-04-13 09:05:00', '2023-04-20 06:04:00'),
(11, 1, 'Mewtwo', 0, '2023-04-05 08:04:00', '2023-04-05 06:04:00'),
(11, 2, 'Mewtwo', 0, '2023-04-12 08:04:00', '2023-04-12 06:04:00'),
(12, 1, 'Mew', 1, '2023-04-06 08:04:00', '2023-04-06 06:04:00'),
(12, 2, 'Mew', 1, '2023-04-12 08:04:00', '2023-04-12 06:04:00'),
(12, 3, 'Mew', 1, '2023-04-19 08:04:00', '2023-04-19 06:04:00'),
(12, 4, 'Mew', 1, '2023-04-26 08:04:00', '2023-04-26 06:04:00'),
(13, 1, 'cours3', 0, '2023-03-30 10:02:00', '2023-03-27 12:03:00'),
(13, 2, 'cours3', 0, '2023-04-06 10:02:00', '2023-04-03 12:04:00'),
(13, 3, 'cours3', 0, '2023-04-13 10:02:00', '2023-04-10 12:04:00'),
(13, 4, 'cours3', 0, '2023-04-20 10:02:00', '2023-04-17 12:04:00'),
(13, 5, 'cours3', 0, '2023-04-27 10:02:00', '2023-04-24 12:04:00'),
(14, 1, 'cours2', 0, '2023-05-04 12:05:00', '2023-05-02 12:05:00'),
(15, 1, 'cours2jours', 0, '2023-04-02 12:04:00', '2023-03-31 12:03:00'),
(15, 2, 'cours2jours', 0, '2023-04-09 12:04:00', '2023-04-07 12:04:00'),
(15, 3, 'cours2jours', 0, '2023-04-16 12:04:00', '2023-04-14 12:04:00'),
(15, 4, 'cours2jours', 0, '2023-04-23 12:04:00', '2023-04-21 12:04:00'),
(16, 1, 'Cours du vendredi', 0, '2023-04-09 05:05:00', '2023-04-08 02:04:00'),
(16, 2, 'Cours du vendredi', 0, '2023-04-16 05:05:00', '2023-04-15 02:04:00'),
(16, 3, 'Cours du vendredi', 0, '2023-04-23 05:05:00', '2023-04-22 02:04:00'),
(16, 4, 'Cours du vendredi', 0, '2023-04-30 05:05:00', '2023-04-29 02:04:00'),
(17, 1, '', 0, '2023-04-29 06:04:04', '2023-04-29 06:04:04'),
(18, 1, '', 0, '2023-04-29 06:04:11', '2023-04-29 06:04:11'),
(19, 1, '', 0, '2023-04-29 06:04:14', '2023-04-29 06:04:14'),
(20, 1, '', 0, '2023-04-29 06:04:59', '2023-04-29 06:04:59'),
(21, 1, 'UnCoursDuVendredi', 1, '2023-04-08 11:04:00', '2023-04-08 09:04:00'),
(22, 1, '', 0, '2023-04-09 12:04:00', '2023-04-08 12:04:00'),
(22, 2, '', 0, '2023-04-16 12:04:00', '2023-04-15 12:04:00'),
(22, 3, '', 0, '2023-04-23 12:04:00', '2023-04-22 12:04:00'),
(22, 4, '', 0, '2023-04-30 12:04:00', '2023-04-29 12:04:00'),
(23, 1, '', 0, '2023-04-09 12:04:00', '2023-04-08 12:04:00'),
(23, 2, '', 0, '2023-04-16 12:04:00', '2023-04-15 12:04:00'),
(23, 3, '', 0, '2023-04-23 12:04:00', '2023-04-22 12:04:00'),
(23, 4, '', 0, '2023-04-30 12:04:00', '2023-04-29 12:04:00'),
(24, 1, 'CoursG1', 0, '2023-05-03 10:05:00', '2023-05-03 08:05:00'),
(25, 1, 'CoursG3', 0, '2023-05-03 12:05:00', '2023-05-03 10:05:00'),
(26, 1, 'Cours2', 0, '2023-05-03 11:05:00', '2023-05-03 08:05:00'),
(27, 1, 'Cours3', 0, '2023-05-03 11:05:00', '2023-05-03 09:05:00'),
(28, 1, 'CoursTest', 1, '2023-05-03 10:05:00', '2023-05-03 08:05:00'),
(29, 1, 'CoursTest2', 1, '2023-05-02 09:04:00', '2023-05-02 08:05:00'),
(30, 1, 'CoursDuLundi', 0, '2023-05-01 10:05:00', '2023-05-01 08:05:00'),
(31, 1, 'CoursDuLundi2', 0, '2023-05-01 08:05:00', '2023-05-01 07:05:00'),
(32, 1, 'CoursDuJeudi', 1, '2023-06-22 11:06:00', '2023-06-22 09:06:00'),
(33, 1, 'Cours5', 1, '2023-06-15 12:06:00', '2023-06-15 08:06:00'),
(33, 2, 'Cours5', 1, '2023-06-22 12:06:00', '2023-06-22 08:06:00'),
(33, 3, 'Cours5', 1, '2023-06-29 12:06:00', '2023-06-29 08:06:00'),
(33, 4, 'Cours5', 1, '2023-07-06 12:07:00', '2023-07-06 08:07:00'),
(34, 1, 'Cours4Mai', 0, '2023-05-04 10:05:00', '2023-05-04 08:05:00'),
(34, 2, 'Cours4Mai', 0, '2023-05-11 10:05:00', '2023-05-11 08:05:00'),
(34, 3, 'Cours4Mai', 0, '2023-05-18 10:05:00', '2023-05-18 08:05:00'),
(34, 4, 'Cours4Mai', 0, '2023-05-25 10:05:00', '2023-05-25 08:05:00'),
(35, 1, 'cours4', 0, '2023-05-04 08:05:00', '2023-05-04 05:05:00'),
(35, 2, 'cours4', 0, '2023-05-11 08:05:00', '2023-05-11 05:05:00'),
(35, 3, 'cours4', 0, '2023-05-18 08:05:00', '2023-05-18 05:05:00'),
(35, 4, 'cours4', 0, '2023-05-25 08:05:00', '2023-05-25 05:05:00'),
(36, 1, 'test4', 0, '2023-05-04 08:05:00', '2023-05-04 05:05:00'),
(36, 2, 'test4', 0, '2023-05-11 08:05:00', '2023-05-11 05:05:00'),
(36, 3, 'test4', 0, '2023-05-18 08:05:00', '2023-05-18 05:05:00'),
(36, 4, 'test4', 0, '2023-05-25 08:05:00', '2023-05-25 05:05:00'),
(37, 1, 'test4empty', 0, '2023-05-04 09:05:00', '2023-05-04 06:05:00'),
(38, 1, 'test4notempty', 0, '2023-05-04 10:05:00', '2023-05-04 09:05:00'),
(38, 2, 'test4notempty', 0, '2023-05-11 10:05:00', '2023-05-11 09:05:00'),
(38, 3, 'test4notempty', 0, '2023-05-18 10:05:00', '2023-05-18 09:05:00');

-- --------------------------------------------------------

--
-- Structure de la table `epreuve`
--

DROP TABLE IF EXISTS `epreuve`;
CREATE TABLE IF NOT EXISTS `epreuve` (
  `id_epreuve` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `actif` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_epreuve`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `epreuve`
--

INSERT INTO `epreuve` (`id_epreuve`, `date`, `libelle`, `actif`) VALUES
(1, '2023-03-09 14:20:37', 'Epreuve 1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `est_pensionnaire`
--

DROP TABLE IF EXISTS `est_pensionnaire`;
CREATE TABLE IF NOT EXISTS `est_pensionnaire` (
  `id_pension` int(11) NOT NULL,
  `id_personne` int(11) NOT NULL,
  PRIMARY KEY (`id_pension`,`id_personne`),
  KEY `fk_id_personne` (`id_personne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `est_pensionnaire`
--

INSERT INTO `est_pensionnaire` (`id_pension`, `id_personne`) VALUES
(25, 1),
(26, 2),
(27, 2),
(1, 3),
(7, 5),
(7, 9),
(4, 10),
(14, 10);

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `id_inscription` int(11) NOT NULL AUTO_INCREMENT,
  `montant_cotisation` int(11) NOT NULL,
  `montant_ffe` int(11) NOT NULL,
  `annee` varchar(255) NOT NULL,
  `id_cav` int(11) NOT NULL,
  `valid` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_inscription`),
  KEY `fk_id_cav_inscription` (`id_cav`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`id_inscription`, `montant_cotisation`, `montant_ffe`, `annee`, `id_cav`, `valid`) VALUES
(1, 2, 2, '2023-03-02', 6, 0),
(2, 2, 2, '2023-03-01', 6, 0),
(3, 2, 2, '2023-03-02', 6, 0),
(4, 2, 2, '2023-03-02', 6, 0),
(5, 4, 1, '2023-03-08', 6, 0),
(6, 4, 1, '2023-03-08', 6, 0),
(7, 4, 1, '2023-03-08', 6, 0),
(8, 7, 7, '2023-03-02', 6, 0),
(9, 2, 4, '2023-03-08', 6, 0),
(10, 2, 4, '2023-03-08', 6, 0),
(11, 3, 3, '2023-03-08', 6, 0),
(12, 3, 3, '2023-03-08', 6, 0),
(13, 3, 3, '2023-03-08', 6, 0),
(14, 4, 1, '2023-02-28', 6, 0),
(15, 2, 3, '2023-03-01', 6, 0),
(16, 5, 6, '2023-03-02', 6, 0),
(17, 20, 6, '2023-03-09', 6, 1),
(18, 2, 2, '2023-03-19', 6, 1),
(19, 8, 5, '2023-03-02', 6, 1),
(20, 4, 2, '2023-03-09', 6, 1),
(21, 600, 110, '2022-12-31', 6, 1),
(22, 50, 80, '2023-03-03', 6, 1),
(23, 123, 123, '2023-03-06', 6, 1),
(24, 4, 4, '2023-03-06', 6, 1),
(25, 50, 150, '2019-02-27', 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

DROP TABLE IF EXISTS `participation`;
CREATE TABLE IF NOT EXISTS `participation` (
  `id_cour` int(11) NOT NULL,
  `id_week_cour` int(11) NOT NULL,
  `id_cav` int(11) NOT NULL,
  `actif` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cour`,`id_cav`,`id_week_cour`) USING BTREE,
  KEY `fk_id_cav_idx` (`id_cav`),
  KEY `fk_id_week_cours` (`id_week_cour`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `participation`
--

INSERT INTO `participation` (`id_cour`, `id_week_cour`, `id_cav`, `actif`) VALUES
(1, 2, 1, 0),
(2, 2, 1, 1),
(2, 1, 6, 1),
(3, 1, 1, 1),
(4, 1, 1, 0),
(9, 1, 1, 0),
(9, 2, 1, 0),
(10, 1, 1, 1),
(11, 1, 1, 1),
(12, 1, 1, 1),
(12, 2, 1, 1),
(12, 3, 1, 1),
(12, 4, 1, 1),
(12, 1, 2, 1),
(12, 2, 2, 1),
(12, 3, 2, 1),
(12, 4, 2, 1),
(16, 1, 1, 0),
(16, 2, 1, 0),
(16, 3, 1, 0),
(16, 4, 1, 0),
(28, 1, 1, 0),
(29, 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

DROP TABLE IF EXISTS `participe`;
CREATE TABLE IF NOT EXISTS `participe` (
  `id_cav` int(11) NOT NULL,
  `id_epreuve` int(11) NOT NULL,
  KEY `fk_id_cav` (`id_cav`),
  KEY `fk_id_epreuve` (`id_epreuve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pension`
--

DROP TABLE IF EXISTS `pension`;
CREATE TABLE IF NOT EXISTS `pension` (
  `id_pension` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_pension` varchar(65) NOT NULL,
  `tarif` int(11) NOT NULL,
  `date_de_debut` date NOT NULL,
  `duree` int(11) NOT NULL,
  `id_cheval` int(11) NOT NULL,
  `actif` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_pension`),
  KEY `id_cheval` (`id_cheval`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pension`
--

INSERT INTO `pension` (`id_pension`, `libelle_pension`, `tarif`, `date_de_debut`, `duree`, `id_cheval`, `actif`) VALUES
(1, 'Demi-pension', 1200, '2022-10-11', 1, 1, 1),
(2, 'azef', 10, '2022-10-20', 0, 4, 1),
(3, 'rxr', 17, '1997-05-31', 4, 2, 0),
(4, 'azofin', 31, '2022-08-05', 15, 5, 1),
(6, 'Demi-pension', 15, '2022-07-08', 7, 2, 0),
(7, 'aaaaaaaaaa', 15, '2022-07-08', 7, 6, 0),
(8, 'aaaaaaaaaa', 15, '2022-07-08', 7, 3, 1),
(10, 'simnon', 9, '2022-10-08', 3, 4, 1),
(11, '', 0, '0000-00-00', 0, 5, 1),
(12, 'simnon', 9, '2022-10-08', 3, 1, 0),
(13, 'a', 1, '2022-10-01', 1, 6, 1),
(14, '', 0, '0000-00-00', 0, 3, 0),
(15, 'Pension', 250, '2023-03-16', 6, 3, 1),
(16, 'Pension', 250, '2023-04-20', 10, 3, 1),
(17, 'Pension', 50, '2023-09-04', 2, 2, 1),
(18, 'Pension', 51, '2023-09-04', 5, 1, 1),
(19, 'Pension', 55, '2023-09-04', 4, 2, 1),
(20, 'Pension', 41, '2023-09-04', 1, 1, 1),
(21, 'Pension', 22, '2023-08-10', 4, 1, 1),
(22, 'Pension', 10, '2023-05-26', 1, 1, 1),
(23, 'Pension', 123, '2023-07-14', 1, 2, 1),
(24, 'Pension', 123, '2023-04-28', 1, 1, 1),
(25, 'Pension', 46, '2023-06-30', 1, 1, 1),
(26, 'Pension', 30, '2023-04-29', 2, 1, 1),
(27, 'Pension', 50, '2023-05-26', 6, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int(11) NOT NULL AUTO_INCREMENT,
  `nom_personne` varchar(255) NOT NULL,
  `prenom_personne` varchar(255) NOT NULL,
  `date_de_naissance` varchar(10) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `photo` varchar(125) DEFAULT NULL,
  `actif` tinyint(4) NOT NULL,
  `num_licence` varchar(9) DEFAULT NULL,
  `galop` int(11) DEFAULT NULL,
  `rue` varchar(85) DEFAULT NULL,
  `complement` varchar(85) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `ville` varchar(85) DEFAULT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`id_personne`, `nom_personne`, `prenom_personne`, `date_de_naissance`, `mail`, `tel`, `photo`, `actif`, `num_licence`, `galop`, `rue`, `complement`, `code_postal`, `ville`) VALUES
(1, 'Legrand', 'Robert', '2009-06-20', 'robert.legrand@mail.com', '0700000000', 'Legrand202305240127.jpg', 1, 'ASJXGSO5', 1, 'rue', '10', 19100, 'brive'),
(2, 'Legrand', 'Colette', '1991-01-05', 'colette.legrand@mail.com', '07xxxxxxxx', 'default.jpg', 1, 'LSHDIEV2', 2, '', '', NULL, ''),
(3, 'Bernard', 'Michel', '09/09/1979', 'bernard.michel@mail.com', '07.xxxxxxxx', 'default.jpg', 1, '', 0, 'Avenue Saint Honoré', '53 bis', 19053, 'Saint Astier'),
(4, 'Richard', 'Tom', '1982-04-23', 'richard.tom@mail.com', '07xxxxxxxx', 'default.jpg', 1, 'PSSXGSO5', 2, '', '', NULL, ''),
(5, 'Durand', 'Axel', '23/04/1982', 'durand.axel@mail.com', '07xxxxxxxx', 'default.jpg', 1, '', 0, 'Rue Malbec', '05', 33800, 'Bordeaux'),
(6, 'Agel', 'Tome', '2001-05-10', 'agel.tom@mail.com', '07xxxxxxxx', 'Agel202305250945.jpg', 1, 'CHJDLMW5', 2, '', '', 19100, 'Brive-la-Gaillarde'),
(7, 'Petit', 'Pierre', '1992-04-03', 'petit.pierre@mail.com', '07xxxxxxxx', 'default.jpg', 1, 'MXSXTSO5', 2, '', '', NULL, ''),
(8, 'André', 'René', '07/06/1996', 'andre.rene@mail.com', '07xxxxxxxx', 'default.jpg', 1, '', 0, 'Place de la liverte', '1', 25600, 'Libourne'),
(9, 'Charles', 'Renault', '1972-02-14', 'charles.renault@mail.com', '07xxxxxxxx', 'default.jpg', 1, 'ASSXGSO5', 2, '', '', NULL, ''),
(10, 'Francois', 'Chevalier', '10/11/1982', 'chevalier.francois@mail.com', '07xxxxxxxx', 'default.jpg', 1, '', 0, 'Chemin du Pouget', '8', 19100, 'Brive-la-Gaillarde'),
(100, 'NomDuCav', 'PrenomDuCav', '2023-12-31', 'brice.murat@protonmail.com', '0000000000', 'NomDuCav202304140421.jpg', 1, 'SLGDHBA7', 5, 'rue', '10', 19100, 'brive'),
(101, 'NomDuCav', 'PrenomDuCav', '2023-12-31', 'aqhbd.l@gmail.com', '0000000000', 'choose-image.png', 1, 'SLGDHBA7', 4, 'rue', '10', 19100, 'brive'),
(105, 'Murat', 'Brice', '2023-12-30', 'brice@mail.com', '0000000000', 'Murat202305040356.jpg', 1, 'SLGDHBA8', 7, NULL, NULL, NULL, NULL),
(106, 'NomRep1', 'PrenomRep1', '1997-12-30', 'test@mail.com', '0000000000', NULL, 1, NULL, NULL, 'rue', '10', 19100, 'brive'),
(107, 'cav1', 'cav1', '2023-12-31', 'cav1@mail.com', '0000000000', 'choose-image.png', 1, 'SLGDHBA7', 1, 'rue', '10', 19100, 'brive'),
(108, 'cavimage', 'cavimage', '2023-12-31', 'cavimage@mail.com', '0000000000', 'cavimage202304150508.jpg', 1, 'SLGDHBA7', 1, 'rue', '10', 19100, 'brive'),
(109, 'testimage', 'testimage', '2023-12-31', 'sqd@dmf.com', '0000000000', 'choose-image.png', 1, 'SLGDHBA7', 1, 'rue', '10', 19100, 'brive'),
(110, 'Autocomplete', 'Autocomplete', '1984-06-23', 'autoco.complete@mail.com', '0700000000', 'choose-image.png', 0, 'SLGDHBA9', 1, 'rue', '10', 19100, 'Brive-la-Gaillarde'),
(111, 'Autocomplete', 'Autocomplete', '1976-05-06', 'autoco.complete2@mail.com', '0700000007', 'Autocomplete202305230155.jpg', 1, 'LSHDIEV2', 1, 'rue', '10', 19100, 'Brive-la-Gaillarde');

-- --------------------------------------------------------

--
-- Structure de la table `robe`
--

DROP TABLE IF EXISTS `robe`;
CREATE TABLE IF NOT EXISTS `robe` (
  `id_robe` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_robe` varchar(65) NOT NULL,
  `actif` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_robe`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `robe`
--

INSERT INTO `robe` (`id_robe`, `libelle_robe`, `actif`) VALUES
(1, 'Alezan', 1),
(2, 'Café au lait', 1),
(3, 'Noir', 1),
(4, 'Blanc', 1),
(5, 'Bai', 1),
(6, 'Isabelle', 1),
(7, 'Souris', 1),
(8, 'Aubère', 1),
(9, 'Grise', 0),
(10, 'Louvet', 1),
(11, 'Rouan', 1),
(12, 'Pie', 1),
(17, 'Crème', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

DROP TABLE IF EXISTS `tarif`;
CREATE TABLE IF NOT EXISTS `tarif` (
  `id_tarif` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_tarif` varchar(65) NOT NULL,
  `pap_mois` int(11) NOT NULL,
  PRIMARY KEY (`id_tarif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `id_personne` int(11) DEFAULT NULL,
  `nom_utilisateur` varchar(35) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `type` varchar(35) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `id_personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `id_personne`, `nom_utilisateur`, `mdp`, `type`) VALUES
(1, 1, 'robert.legrand@mail.com', '21232f297a57a5a743894a0e4a801fc3', 'u'),
(2, 2, 'catherineL.compta', '81dc9bdb52d04dc20036dbd8313ed055', 'a'),
(96, 100, 'brice.murat@protonmail.com', '9c2dd7b7ceb02cb46e2625cd282ea688', 'u'),
(98, 101, 'aqhbd.l@gmail.com', '22562fd9ded14a2061f882048d323b22', 'u'),
(100, 106, 'test@mail.com', '1e1de950f99830e8ff40b36eca67f356', 'u'),
(101, 107, 'cav1@mail.com', 'b353667748a0ca8de68013a5f529f48e', 'u'),
(102, 108, 'cavimage@mail.com', 'c239a90424fc679b1563c3bb740bf32b', 'u'),
(103, 109, 'sqd@dmf.com', 'da054dd13dcaffa101b7a0147f5b4700', 'u'),
(105, NULL, 'AdminDuCentre', '0440058eee4871bcf69699c852296b41', 'a'),
(106, 110, 'autoco.complete@mail.com', 'a153870c2436fb1660aaf479115afa89', 'u'),
(107, 111, 'autoco.complete2@mail.com', 'b052c64e1e75ec8a64c104cc71d4bcde', 'u');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cheval`
--
ALTER TABLE `cheval`
  ADD CONSTRAINT `fk_id_cav` FOREIGN KEY (`id_cav`) REFERENCES `personne` (`id_personne`),
  ADD CONSTRAINT `fk_id_robe` FOREIGN KEY (`id_robe`) REFERENCES `robe` (`id_robe`);

--
-- Contraintes pour la table `est_pensionnaire`
--
ALTER TABLE `est_pensionnaire`
  ADD CONSTRAINT `fk_id_pension` FOREIGN KEY (`id_pension`) REFERENCES `pension` (`id_pension`),
  ADD CONSTRAINT `fk_id_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`);

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `fk_id_cav_inscription` FOREIGN KEY (`id_cav`) REFERENCES `personne` (`id_personne`);

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `fk_id_cav_participation` FOREIGN KEY (`id_cav`) REFERENCES `personne` (`id_personne`),
  ADD CONSTRAINT `fk_id_cours` FOREIGN KEY (`id_cour`) REFERENCES `cours` (`id_cours`),
  ADD CONSTRAINT `fk_id_week_cours` FOREIGN KEY (`id_week_cour`) REFERENCES `cours` (`id_week_cours`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `fk_id_cav_participe` FOREIGN KEY (`id_cav`) REFERENCES `personne` (`id_personne`),
  ADD CONSTRAINT `fk_id_epreuve_participe` FOREIGN KEY (`id_epreuve`) REFERENCES `epreuve` (`id_epreuve`);

--
-- Contraintes pour la table `pension`
--
ALTER TABLE `pension`
  ADD CONSTRAINT `fk_id_cheval` FOREIGN KEY (`id_cheval`) REFERENCES `cheval` (`id_cheval`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_id_personne_utilisateur` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
