-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 27 Août 2016 à 13:17
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `movieorparody`
--

-- --------------------------------------------------------

--
-- Structure de la table `highscore`
--

CREATE TABLE IF NOT EXISTS `highscore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(45) NOT NULL,
  `score` int(11) NOT NULL,
  `timer` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `highscore`
--

INSERT INTO `highscore` (`id`, `pseudo`, `score`, `timer`) VALUES
(1, 'alex', 1, '0:5:3');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` mediumtext NOT NULL,
  `description` longtext NOT NULL,
  `x1` int(11) NOT NULL,
  `x2` int(11) NOT NULL,
  `y1` int(11) NOT NULL,
  `y2` int(11) NOT NULL,
  `reality` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id`, `src`, `description`, `x1`, `x2`, `y1`, `y2`, `reality`) VALUES
(1, 'images/harry-potter.jpeg', 'Le bon vieux Harry', 41, 421, 119, 318, 1),
(2, 'images/costume-harry-potter-halloween.jpg', 'Un peu grossier le Harry', 58, 204, 265, 413, 0),
(3, 'images/batman.jpg', 'Le vrai Batman avec Bane', 481, 782, 15, 387, 1),
(4, 'images/Lady-Bane-and-Batman.png', 'Mhhh Lady Bane ...', 255, 355, 49, 172, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
