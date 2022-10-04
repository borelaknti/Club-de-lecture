-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 20 sep. 2022 à 15:34
-- Version du serveur : 8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `club_lecture`
--

-- --------------------------------------------------------

--
-- Structure de la table `association`
--

CREATE TABLE `association` (
  `numAssociation` int NOT NULL,
  `nomAssociation` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `adresseAssociation` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `Datecreation` date NOT NULL,
  `nomCreateur` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `numUtilisateur` int NOT NULL,
  `nomUtilisateur` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `prenomUtilisateur` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `dateNaissance` date NOT NULL,
  `etatUtilisateur` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `adresseUtilisateur` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `sexeUtilisateur` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `loginUtilisateur` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `motDePasse` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurassocier`
--

CREATE TABLE `utilisateurassocier` (
  `fknumAssociation` int NOT NULL,
  `fknumUtilisateur` int NOT NULL,
  `dateAjout` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `association`
--
ALTER TABLE `association`
  ADD PRIMARY KEY (`numAssociation`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`numUtilisateur`);

--
-- Index pour la table `utilisateurassocier`
--
ALTER TABLE `utilisateurassocier`
  ADD PRIMARY KEY (`fknumAssociation`,`fknumUtilisateur`),
  ADD KEY `fk_numUtilisateur` (`fknumUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `association`
--
ALTER TABLE `association`
  MODIFY `numAssociation` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `numUtilisateur` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `utilisateurassocier`
--
ALTER TABLE `utilisateurassocier`
  ADD CONSTRAINT `fk_numAssociation` FOREIGN KEY (`fknumAssociation`) REFERENCES `association` (`numAssociation`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_numUtilisateur` FOREIGN KEY (`fknumUtilisateur`) REFERENCES `utilisateur` (`numUtilisateur`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
