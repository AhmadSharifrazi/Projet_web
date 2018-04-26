-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 26 avr. 2018 à 21:32
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_web`
--

-- --------------------------------------------------------

--
-- Structure de la table `day_workout`
--

DROP TABLE IF EXISTS `day_workout`;
CREATE TABLE IF NOT EXISTS `day_workout` (
  `day` date NOT NULL,
  `workout_no` int(11) NOT NULL,
  `description` text,
  PRIMARY KEY (`day`,`workout_no`) USING BTREE,
  KEY `workout_no` (`workout_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_no` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `starting_date` date DEFAULT NULL,
  `ending_date` date DEFAULT NULL,
  `place` varchar(20) DEFAULT NULL,
  `description` text,
  `URL` varchar(30) DEFAULT NULL,
  `approximative_cost` decimal(10,0) DEFAULT NULL,
  `registered_number` int(11) DEFAULT NULL,
  `interested_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`event_no`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`event_no`, `title`, `starting_date`, `ending_date`, `place`, `description`, `URL`, `approximative_cost`, `registered_number`, `interested_number`) VALUES
(2, 'nouveau', '2012-12-21', '2012-12-22', 'Monde', 'fin du monde', 'finDuMonde.html', '10', NULL, NULL),
(3, 'nouveau', '2012-12-21', NULL, 'Monde', 'fin du monde', 'finDuMonde.html', '10', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `follows`
--

DROP TABLE IF EXISTS `follows`;
CREATE TABLE IF NOT EXISTS `follows` (
  `email` varchar(30) NOT NULL,
  `workout_no` int(11) NOT NULL,
  PRIMARY KEY (`email`,`workout_no`),
  KEY `workout_no` (`workout_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `interested_people`
--

DROP TABLE IF EXISTS `interested_people`;
CREATE TABLE IF NOT EXISTS `interested_people` (
  `email` varchar(30) NOT NULL,
  `event_no` int(11) NOT NULL,
  PRIMARY KEY (`email`,`event_no`),
  KEY `event_no` (`event_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `email` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `adress` varchar(50) DEFAULT NULL,
  `account_number` varchar(30) DEFAULT NULL,
  `profil_picture` varchar(30) DEFAULT NULL,
  `training_no` int(5) NOT NULL DEFAULT '1',
  `responsability_level` varchar(20) NOT NULL DEFAULT 'member',
  `validated` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`email`, `last_name`, `first_name`, `phone_number`, `adress`, `account_number`, `profil_picture`, `training_no`, `responsability_level`, `validated`) VALUES
('xavier@gmail.com', 'Linet', 'Xavier', '048840526', 'rue des Aulnois', '651465464', NULL, 1, 'member', 1),
('xavierLINET', 'Linet', 'Xavier', '04584694684', 'rue des aulnois', 'BE64564645', NULL, 1, 'member', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `payements`
--

DROP TABLE IF EXISTS `payements`;
CREATE TABLE IF NOT EXISTS `payements` (
  `email` varchar(30) NOT NULL,
  `year` int(11) NOT NULL,
  `amount_payed` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`email`,`year`),
  KEY `year` (`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `registered_people`
--

DROP TABLE IF EXISTS `registered_people`;
CREATE TABLE IF NOT EXISTS `registered_people` (
  `email` varchar(30) NOT NULL,
  `event_no` int(11) NOT NULL,
  `has_payed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`event_no`,`email`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `year` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  PRIMARY KEY (`year`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `subscriptions`
--

INSERT INTO `subscriptions` (`year`, `amount`) VALUES
(2018, '150');

-- --------------------------------------------------------

--
-- Structure de la table `workout_plan`
--

DROP TABLE IF EXISTS `workout_plan`;
CREATE TABLE IF NOT EXISTS `workout_plan` (
  `workout_no` int(11) NOT NULL AUTO_INCREMENT,
  `workout_name` varchar(20) NOT NULL,
  `starting_date` date DEFAULT NULL,
  `ending_date` date DEFAULT NULL,
  PRIMARY KEY (`workout_no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `workout_plan`
--

INSERT INTO `workout_plan` (`workout_no`, `workout_name`, `starting_date`, `ending_date`) VALUES
(1, '100m', '2018-02-12', '2018-02-13'),
(2, 'sprint', '2018-12-06', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `day_workout`
--
ALTER TABLE `day_workout`
  ADD CONSTRAINT `day_workout_ibfk_1` FOREIGN KEY (`workout_no`) REFERENCES `workout_plan` (`workout_no`);

--
-- Contraintes pour la table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`email`) REFERENCES `members` (`email`),
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`workout_no`) REFERENCES `workout_plan` (`workout_no`);

--
-- Contraintes pour la table `interested_people`
--
ALTER TABLE `interested_people`
  ADD CONSTRAINT `interested_people_ibfk_1` FOREIGN KEY (`email`) REFERENCES `members` (`email`),
  ADD CONSTRAINT `interested_people_ibfk_2` FOREIGN KEY (`event_no`) REFERENCES `events` (`event_no`);

--
-- Contraintes pour la table `payements`
--
ALTER TABLE `payements`
  ADD CONSTRAINT `payements_ibfk_1` FOREIGN KEY (`email`) REFERENCES `members` (`email`),
  ADD CONSTRAINT `payements_ibfk_2` FOREIGN KEY (`year`) REFERENCES `subscriptions` (`year`);

--
-- Contraintes pour la table `registered_people`
--
ALTER TABLE `registered_people`
  ADD CONSTRAINT `registered_people_ibfk_1` FOREIGN KEY (`email`) REFERENCES `members` (`email`),
  ADD CONSTRAINT `registered_people_ibfk_2` FOREIGN KEY (`event_no`) REFERENCES `events` (`event_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
