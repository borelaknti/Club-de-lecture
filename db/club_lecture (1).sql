-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 18 oct. 2022 à 12:07
-- Version du serveur : 8.0.21
-- Version de PHP : 7.4.9

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

--
-- Déchargement des données de la table `association`
--

INSERT INTO `association` (`numAssociation`, `nomAssociation`, `adresseAssociation`, `Datecreation`, `nomCreateur`) VALUES
(1, 'Fitness', '94 Rue jacques cartier', '2022-10-19', 'Jesus'),
(2, 'Cardio', '95 Rue jasques cartier', '2022-10-19', 'Binam'),
(3, 'Stikers', '96 Rue jacques cartier', '2022-10-21', 'rodrigo'),
(4, 'binance', '97 rue Jacques cartier', '2022-10-21', 'jiji'),
(5, 'voyageur', '98 Rue jacques cartier', '2022-10-19', 'nancy');

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
  `sexeUtilisateur` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `login_utilisateur` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mot_de_passe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `utilisateur_email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`numUtilisateur`, `nomUtilisateur`, `prenomUtilisateur`, `dateNaissance`, `etatUtilisateur`, `adresseUtilisateur`, `sexeUtilisateur`, `login_utilisateur`, `mot_de_passe`, `utilisateur_email`) VALUES
(1, 'NTI AkOUMBA', 'Borel Giovanni', '2000-08-21', 'A', '94 rue jacques cartier', 'M', 'borel', 'borel2021', NULL),
(2, 'philip', 'morris', '2022-09-08', 'A', '94 rue jacques cartier', 'M', 'morris', 'morris2021', NULL),
(3, 'dom', 'perrin', '2022-10-12', 'A', 'dfffhdfsg', 'm', 'koko', '$2y$10$ORwOA.AYWlsgSkQ8bJLVI.bImNGXEwwEFQsBpgNUwdk5J5uT0853O', 'borelaknti@gmail.com'),
(4, 'gabriel', 'jesus', '2022-10-19', 'A', '96 rue jacques cartier', 'masculin', 'gabi', '$2y$10$HjhJ5duRJd2DIWr92uenjOQB82RTIRFoqXu9WAzjWCo0No8zX8/8a', 'gabriel@gmail.com'),
(5, 'john', 'anderson', '2022-10-19', 'A', '97 rue jacques cartier', 'feminin', 'john', '$2y$10$ZVAIWopJoOQ2KApjVcLwqe/oQ9IApBBYEd32dDpoO1rQAOztJ6vRK', 'john@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurassocier`
--

CREATE TABLE `utilisateurassocier` (
  `fknumAssociation` int NOT NULL,
  `fknumUtilisateur` int NOT NULL,
  `dateAjout` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurassocier`
--

INSERT INTO `utilisateurassocier` (`fknumAssociation`, `fknumUtilisateur`, `dateAjout`) VALUES
(2, 4, '0000-00-00'),
(3, 1, '0000-00-00'),
(3, 2, '0000-00-00'),
(4, 4, '0000-00-00'),
(4, 5, '0000-00-00');

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
  MODIFY `numAssociation` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `numUtilisateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
