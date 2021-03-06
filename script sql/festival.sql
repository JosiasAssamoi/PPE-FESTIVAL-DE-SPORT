-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 01 oct. 2018 à 08:35
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `festival`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresseip`
--

DROP TABLE IF EXISTS `adresseip`;
CREATE TABLE IF NOT EXISTS `adresseip` (
  `numip` varchar(20) NOT NULL,
  PRIMARY KEY (`numip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adresseip`
--

INSERT INTO `adresseip` (`numip`) VALUES
(''),
('127.0.0.1'),
('::1');

-- --------------------------------------------------------

--
-- Structure de la table `attribution`
--

DROP TABLE IF EXISTS `attribution`;
CREATE TABLE IF NOT EXISTS `attribution` (
  `idEtab` char(8) NOT NULL,
  `idGroupe` char(4) NOT NULL,
  `nombreChambres` int(11) NOT NULL,
  PRIMARY KEY (`idEtab`,`idGroupe`),
  KEY `fk2_Attribution` (`idGroupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `attribution`
--

INSERT INTO `attribution` (`idEtab`, `idGroupe`, `nombreChambres`) VALUES
('0350123A', 'g004', 13),
('0350123A', 'g005', 8),
('0350785N', 'g001', 11),
('0350785N', 'g002', 8),
('0350785N', 'g014', 1),
('0351234W', 'g001', 3),
('0351234W', 'g002', 3),
('0351234W', 'g006', 10),
('0351234W', 'g007', 7);

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

DROP TABLE IF EXISTS `etablissement`;
CREATE TABLE IF NOT EXISTS `etablissement` (
  `id` char(8) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `adresseRue` varchar(45) NOT NULL,
  `codePostal` char(5) NOT NULL,
  `ville` varchar(35) NOT NULL,
  `tel` varchar(13) NOT NULL,
  `adresseElectronique` varchar(70) DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `civiliteResponsable` varchar(12) NOT NULL,
  `nomResponsable` varchar(25) NOT NULL,
  `prenomResponsable` varchar(25) DEFAULT NULL,
  `nombreChambresOffertes` int(11) DEFAULT NULL,
  `motDePasse` varchar(50) NOT NULL,
  `informationsPratiques` varchar(100) NOT NULL,
  `conventionSignee` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etablissement`
--

INSERT INTO `etablissement` (`id`, `nom`, `adresseRue`, `codePostal`, `ville`, `tel`, `adresseElectronique`, `type`, `civiliteResponsable`, `nomResponsable`, `prenomResponsable`, `nombreChambresOffertes`, `motDePasse`, `informationsPratiques`, `conventionSignee`) VALUES
('0350123A', 'Collège Lamartines', '3, avenue des corsaires', '35404', 'Paramé', '0299561459', 'jayywol23@gmail.com', 1, 'Mme', 'Lefort', 'Anne', 58, 'ebyjrdivffj', 'Tests', 1),
('0350785N', 'Collège de Moka', '2 avenue Aristide Briand BP 6', '35401', 'Saint-Malo', '0299206990', NULL, 1, 'M.', 'Dupont', 'Alain', 20, '', '', 1),
('0351234W', 'Collège Léonard de Vinci', '2 rue Rabelais', '35418', 'Saint-Malo', '0299117474', NULL, 1, 'M.', 'Durand', 'Pierre', 60, '', '', 0),
('11111111', 'Centre de rencontres internationales', '37 avenue du R.P. Umbricht BP 108', '35407', 'Saint-Malo', '0299000000', NULL, 0, 'M.', 'Guenroc', 'Guy', 200, '', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id` char(4) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `identiteResponsable` varchar(40) DEFAULT NULL,
  `adressePostale` varchar(120) DEFAULT NULL,
  `nombrePersonnes` int(11) NOT NULL,
  `nomPays` varchar(40) NOT NULL,
  `hebergement` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `nom`, `identiteResponsable`, `adressePostale`, `nombrePersonnes`, `nomPays`, `hebergement`) VALUES
('g001', 'Equipe de foot : Bachkortostan', NULL, NULL, 40, 'Bachkirie', 'O'),
('g002', 'Equipe de basket : Bolivie', NULL, NULL, 25, 'Bolivie', 'O'),
('g003', 'Equipe de baby-foot : SaoPaulo', NULL, NULL, 34, 'Brésil', 'O'),
('g004', 'Equipe de basket : Bulgarie', '', '', 38, 'Bulgarie', 'O'),
('g005', 'Equipe de foot : Douala', NULL, NULL, 22, 'Cameroun', 'O'),
('g006', 'Equipe de foot : Seoul', NULL, NULL, 29, 'Corée du Sud', 'O'),
('g007', 'Equipe de foot : Ecosse', NULL, NULL, 19, 'Ecosse', 'O'),
('g008', 'Equipe de foot : Barcelone', NULL, NULL, 5, 'Espagne', 'O'),
('g009', 'Equipe de basket : Jersey', NULL, NULL, 21, 'Jersey', 'O'),
('g010', 'Equipe de ping-pong : Emirats', NULL, NULL, 30, 'Emirats arabes unis', 'O'),
('g011', 'Equipe de volleyball : Mexique', NULL, NULL, 38, 'Mexique', 'O'),
('g012', 'Equipe de basket : Panama', NULL, NULL, 22, 'Panama', 'O'),
('g013', 'Equipe de baby-foot : Papouasie', NULL, NULL, 13, 'Papouasie', 'O'),
('g014', 'Equipe de ping- pong : Paraguay', NULL, NULL, 26, 'Paraguay', 'O'),
('g015', 'Equipe de foot : Quebec', NULL, NULL, 8, 'Québec', 'O'),
('g016', 'Equipe de basket : RDB', NULL, NULL, 40, 'République de Bachkirie', 'O'),
('g017', 'Equipe de volleyball : Turquie', NULL, NULL, 40, 'Turquie', 'O'),
('g018', 'Equipe de basket : Moscou', NULL, NULL, 43, 'Russie', 'O'),
('g019', 'Ruhunu Ballet du village de Kosgoda', NULL, NULL, 27, 'Sri Lanka', 'O'),
('g020', 'Equipe de ping-pong : Orlean', NULL, NULL, 34, 'France - Provence', 'O'),
('g021', 'Equipe de foot : Orlean', NULL, NULL, 40, 'France - Provence', 'O'),
('g022', 'Equipe de foot : FR_Vannes', NULL, NULL, 1, 'France - Bretagne', 'O'),
('g023', 'Equipe de ping-pong : FR_Vannes', NULL, NULL, 5, 'France - Bretagne', 'O'),
('g024', 'Equipe de volleyball : FR_Vannes', NULL, NULL, 5, 'France - Bretagne', 'O'),
('g025', 'Equipe de foot : FR_Vire', NULL, NULL, 2, 'France - Bretagne', 'O'),
('g026', 'Cercle Gwik Alet', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g027', 'Bagad Quic En Groigne', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g028', 'Penn Treuz', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g029', 'Savidan Launay', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g030', 'Cercle Boked Er Lann', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g031', 'Bagad Montfortais', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g032', 'Vent de Noroise', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g033', 'Cercle Strollad', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g034', 'Bagad An Hanternoz', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g035', 'Cercle Ar Vro Melenig', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g036', 'Cercle An Abadenn Nevez', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g037', 'Kerc\'h Keltiek Roazhon', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g038', 'Bagad Plougastel', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g039', 'Bagad Nozeganed Bro Porh-Loeiz', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g040', 'Bagad Nozeganed Bro Porh-Loeiz', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g041', 'Jackie Molard Quartet', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g042', 'Deomp', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g043', 'Cercle Olivier de Clisson', NULL, NULL, 0, 'France - Bretagne', 'N'),
('g044', 'Kan Tri', NULL, NULL, 0, 'France - Bretagne', 'N');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `attribution`
--
ALTER TABLE `attribution`
  ADD CONSTRAINT `fk1_Attribution` FOREIGN KEY (`idEtab`) REFERENCES `etablissement` (`id`),
  ADD CONSTRAINT `fk2_Attribution` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
