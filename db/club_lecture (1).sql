-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 01 nov. 2022 à 14:56
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
(5, 'voyageur', '98 Rue jacques cartier', '2022-10-19', 'nancy'),
(7, 'qwert', '54 rue boul vert', '2022-10-28', 'raphael');

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
  `login_utilisateur` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mot_de_passe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `utilisateur_email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`numUtilisateur`, `nomUtilisateur`, `prenomUtilisateur`, `dateNaissance`, `etatUtilisateur`, `adresseUtilisateur`, `sexeUtilisateur`, `login_utilisateur`, `mot_de_passe`, `utilisateur_email`, `email_time`) VALUES
(1, 'NTI AkOUMBA', 'Borel Giovanni', '2000-08-21', 'A', '94 rue jacques cartier', 'M', 'borel', 'borel2021', NULL, NULL),
(2, 'philip', 'morris', '2022-09-08', 'I', '94 rue jacques cartier', 'M', 'morris', 'morris2021', NULL, NULL),
(3, 'dom', 'perrin', '2022-10-12', 'A', 'dfffhdfsg', 'm', 'koko', '$2y$10$ORwOA.AYWlsgSkQ8bJLVI.bImNGXEwwEFQsBpgNUwdk5J5uT0853O', 'borelaknti@gmail.com', NULL),
(4, 'gabriel', 'jesus', '2022-10-19', 'I', '96 rue jacques cartier', 'masculin', 'gabi', '$2y$10$HjhJ5duRJd2DIWr92uenjOQB82RTIRFoqXu9WAzjWCo0No8zX8/8a', 'gabriel@gmail.com', '0000-00-00 00:00:00'),
(5, 'john', 'anderson', '2022-10-19', 'A', '97 rue jacques cartier', 'feminin', 'john', '$2y$10$ZVAIWopJoOQ2KApjVcLwqe/oQ9IApBBYEd32dDpoO1rQAOztJ6vRK', 'john@gmail.com', '0000-00-00 00:00:00'),
(6, 'emet', 'jonathan', '2022-10-19', 'A', 'dfffhdfsg', 'masculin', 'emet', '$2y$10$nxRhG4N79u1VQem7dvlUFufytFvaafbvuJhZ3bCeNRSa72SxKcwjG', 'emet@hotmail.com', '0000-00-00 00:00:00'),
(7, 'ewtret', 'anderson', '2022-10-18', 'A', '96 rue jacques cartier', 'masculin', 'anderson', '$2y$10$/MYn/5I13/kIm93BXBE4se4WkOdsjgbU8qfmdg4dUZjvGDvjSAgKq', 'emet@hotmail.com', '0000-00-00 00:00:00'),
(8, 'borel', 'perrin', '2022-10-19', 'A', '96 rue jacques cartier', 'masculin', 'jiji', '$2y$10$.07y9ccm9faM6/YuIRh86O5UNJiLe0lHFOieQfyd/5fddHpgs9YHK', 'emet@hotmail.com', '0000-00-00 00:00:00'),
(9, 'sale', 'bonet', '2022-10-22', 'A', '94 rue jacques cartier', 'masculin', NULL, NULL, 'sale@gmail.com', NULL),
(10, 'fits', 'dev', '2022-10-22', 'I', 'assdadsa', 'masculin', NULL, NULL, 'emet@hotmail.com', '0000-00-00 00:00:00'),
(11, 'fits', 'dev', '2022-10-22', 'A', 'assdadsa', 'masculin', NULL, NULL, 'emet@hotmail.com', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurassocier`
--

CREATE TABLE `utilisateurassocier` (
  `id` int NOT NULL,
  `fknumAssociation` int NOT NULL,
  `fknumUtilisateur` int NOT NULL,
  `dateAjout` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurassocier`
--

INSERT INTO `utilisateurassocier` (`id`, `fknumAssociation`, `fknumUtilisateur`, `dateAjout`) VALUES
(3, 1, 9, NULL),
(4, 1, 9, NULL),
(5, 4, 9, NULL),
(6, 5, 11, NULL),
(7, 2, 11, NULL);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_numAssociation` (`fknumAssociation`),
  ADD KEY `fk_numUtilisateur` (`fknumUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `association`
--
ALTER TABLE `association`
  MODIFY `numAssociation` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `numUtilisateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `utilisateurassocier`
--
ALTER TABLE `utilisateurassocier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
