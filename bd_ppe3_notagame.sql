-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 28 Août 2016 à 19:06
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bd_ppe3_notagame`
--
CREATE DATABASE IF NOT EXISTS `bd_ppe3_notagame` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bd_ppe3_notagame`;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `IDU` int(11) NOT NULL,
  `IDJV` int(11) NOT NULL,
  `LIBELLE` char(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`IDU`,`IDJV`),
  KEY `IDJV` (`IDJV`),
  KEY `IDU` (`IDU`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`IDU`, `IDJV`, `LIBELLE`) VALUES
(1, 1, 'Jeu très original par son graphisme. Jeu très intéressant pour tous les enfants à partir de 6 ans.'),
(2, 2, 'Il est super...'),
(3, 1, 'Génial, j''adore ce jeu. Je le recommande à tous !'),
(2, 1, 'Jeu décevant qui manque un peu d''action.');

-- --------------------------------------------------------

--
-- Structure de la table `compatible`
--

CREATE TABLE IF NOT EXISTS `compatible` (
  `IDJV` int(11) NOT NULL,
  `IDS` int(11) NOT NULL,
  PRIMARY KEY (`IDJV`,`IDS`),
  KEY `I_FK_COMPATIBLE_JEUXVIDEOS` (`IDJV`),
  KEY `I_FK_COMPATIBLE_SUPPORT` (`IDS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `compatible`
--

INSERT INTO `compatible` (`IDJV`, `IDS`) VALUES
(1, 1),
(1, 3),
(1, 4),
(2, 2),
(2, 3),
(3, 1),
(3, 3),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 2),
(5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `constructeur`
--

CREATE TABLE IF NOT EXISTS `constructeur` (
  `IDC` int(11) NOT NULL AUTO_INCREMENT,
  `NOMC` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`IDC`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Contenu de la table `constructeur`
--

INSERT INTO `constructeur` (`IDC`, `NOMC`) VALUES
(1, 'Nintendo'),
(2, 'Atari'),
(3, 'Sega'),
(4, 'VTech'),
(5, 'Sony'),
(6, 'Microsoft');

-- --------------------------------------------------------

--
-- Structure de la table `jeuxvideos`
--

CREATE TABLE IF NOT EXISTS `jeuxvideos` (
  `IDJV` int(11) NOT NULL AUTO_INCREMENT,
  `NOMJV` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `ANNEESORTIE` int(11) DEFAULT NULL,
  `CLASSIFICATION` int(11) DEFAULT NULL,
  `EDITEUR` char(255) COLLATE utf8_bin DEFAULT NULL,
  `DESCRIPTION` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`IDJV`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Contenu de la table `jeuxvideos`
--

INSERT INTO `jeuxvideos` (`IDJV`, `NOMJV`, `ANNEESORTIE`, `CLASSIFICATION`, `EDITEUR`, `DESCRIPTION`) VALUES
(1, 'Minecraft', 2009, 7, 'Suédois Markus Persson, alias Notch, puis par le studio de développement Mojang', 'Ce jeu vidéo plonge le joueur dans un univers généré aléatoirement et composé de voxels'),
(2, 'Halo: Combat Evolved', 2002, 16, 'Microsoft Game Studios', 'L''histoire se déroule au XXVIe siècle. Un vaisseau de guerre humain tombe sur une structure inconnue du nom de Halo en tentant d''échapper à une armada covenant. Le joueur incarne un super-soldat, le Spartan John-117 (Master Chief pour son grade en VO et A'),
(3, 'MotoGP14', 2014, 3, 'Milestone', 'jeu de course de moto avec les pilotes de la saison 2013-2014 sur les circuits officiels'),
(4, 'NBA 2K16', 2015, 3, '2K Sports', 'jeu vidéo de basketball avec les joueurs de la saison'),
(5, 'Grand Theft Auto V', 2013, 18, 'Rockstar Games', 'Jeu d''action-aventure en monde ouvert, Grand Theft Auto (GTA) V vous place dans la peau de trois personnages inédits : Michael, Trevor et Franklin qui ont élu domicile à Los Santos, ville de la région de San Andreas.');

-- --------------------------------------------------------

--
-- Structure de la table `support`
--

CREATE TABLE IF NOT EXISTS `support` (
  `IDS` int(11) NOT NULL AUTO_INCREMENT,
  `IDC` int(11) NOT NULL,
  `NOMS` char(255) COLLATE utf8_bin DEFAULT NULL,
  `CARACTERISTIQUES` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `ANNEESORTIE` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDS`),
  KEY `I_FK_SUPPORT_CONSTRUCTEUR` (`IDC`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Contenu de la table `support`
--

INSERT INTO `support` (`IDS`, `IDC`, `NOMS`, `CARACTERISTIQUES`, `ANNEESORTIE`) VALUES
(1, 5, 'PlayStation 4', 'Console de jeux vidéos de salon de huitième génération, succède à PS3', 2013),
(2, 6, 'Xbox One', 'Console de jeux vidéos de salon de huitième génération, succède à Xbox 360', 2013),
(3, 6, 'Xbox 360', 'Console de jeux vidéos de septième génération, succède à Xbox.', 2005),
(4, 1, 'Wii', 'Console de jeux vidéos de salon, capable de détecter la position.', 2006);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `IDU` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(255) COLLATE utf8_bin NOT NULL,
  `PSEUDO` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `COMMUNAUTE` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`IDU`),
  UNIQUE KEY `EMAIL` (`EMAIL`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`IDU`, `EMAIL`, `PSEUDO`, `COMMUNAUTE`) VALUES
(1, 'fderobien@gmail.com', 'fdr', 'débutant'),
(2, 'carine.autret@gmail.com', 'ca', 'testeur'),
(3, '1fo.sio.49@gmail.com', '1fo', 'geek');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_jeuxvideos` FOREIGN KEY (`IDJV`) REFERENCES `jeuxvideos` (`IDJV`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentaire_ibfk_users` FOREIGN KEY (`IDU`) REFERENCES `users` (`IDU`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `compatible`
--
ALTER TABLE `compatible`
  ADD CONSTRAINT `compatible_ibfk_1` FOREIGN KEY (`IDJV`) REFERENCES `jeuxvideos` (`IDJV`),
  ADD CONSTRAINT `compatible_ibfk_2` FOREIGN KEY (`IDS`) REFERENCES `support` (`IDS`);

--
-- Contraintes pour la table `support`
--
ALTER TABLE `support`
  ADD CONSTRAINT `support_ibfk_1` FOREIGN KEY (`IDC`) REFERENCES `constructeur` (`IDC`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
