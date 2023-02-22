-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 22 fév. 2023 à 19:14
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tdl`
--

-- --------------------------------------------------------

--
-- Structure de la table `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE IF NOT EXISTS `todo` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `task` text NOT NULL,
  `dateStart` datetime NOT NULL,
  `dateEnd` datetime DEFAULT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `id_utilisateur` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `todo`
--

INSERT INTO `todo` (`id`, `task`, `dateStart`, `dateEnd`, `state`, `id_utilisateur`) VALUES
(15, 'test 1', '2023-02-21 22:31:07', '2023-02-21 22:47:57', 1, 1),
(19, 'test 1', '2023-02-22 00:41:52', '2023-02-22 13:37:20', 1, 1),
(21, 'le responsive est ok', '2023-02-22 11:52:19', NULL, 0, 1),
(18, 'test 2', '2023-02-21 22:47:54', NULL, 0, 1),
(25, 'Bonjour visiteur, tu as deviné les identifiants qui évitent de créer un compte !', '2023-02-22 15:44:05', '2023-02-22 15:44:20', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `nom`, `prenom`) VALUES
(1, 'x', '$2y$10$QTcxOC6.t1eGCPebX.ljh.5ui6ZyBYhSqoaWTcBOuVa/wW5XafLUu', 'x', 'x'),
(2, 'admin', '$2y$10$uiSHaEBwtLrf7jrQWWaSaueuTwDNe70sGSsDiNt32PZsJrl5p2xsG', 'admin', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
