-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 13 déc. 2022 à 15:26
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
  `login_utilisateur` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mot_de_passe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `utilisateur_email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_time` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`numUtilisateur`, `nomUtilisateur`, `prenomUtilisateur`, `dateNaissance`, `etatUtilisateur`, `adresseUtilisateur`, `sexeUtilisateur`, `login_utilisateur`, `mot_de_passe`, `utilisateur_email`, `email_time`) VALUES
(3, 'dom', 'perrin', '2022-10-12', 'A', 'dfffhdfsg', 'm', 'koko', '$2y$10$ORwOA.AYWlsgSkQ8bJLVI.bImNGXEwwEFQsBpgNUwdk5J5uT0853O', 'borelaknti@gmail.com', NULL),
(4, 'gabriel', 'jesus', '2022-10-19', 'I', '96 rue jacques cartier', 'masculin', 'gabi', '$2y$10$nsdYvswBf/7qvoNYk8AKj.vYAPVRzV4OG3eaVVn7B/KPlYq74D82C', 'gabriel@gmail.com', '1667393731'),
(5, 'john', 'anderson', '2022-10-19', 'A', '97 rue jacques cartier', 'feminin', 'john', '$2y$10$4nRc9/ydeC1lUccvJG3/u.CH/JzsbKeugpq6P9zHg0ihh9K8uZqFa', 'john@gmail.com', '1667568408'),
(6, 'emet', 'jonathan', '2022-10-19', 'A', 'dfffhdfsg', 'masculin', 'emet', '$2y$10$nxRhG4N79u1VQem7dvlUFufytFvaafbvuJhZ3bCeNRSa72SxKcwjG', 'emet@hotmail.com', '0000-00-00 00:0'),
(7, 'ewtret', 'anderson', '2022-10-18', 'A', '96 rue jacques cartier', 'masculin', 'anderson', '$2y$10$/MYn/5I13/kIm93BXBE4se4WkOdsjgbU8qfmdg4dUZjvGDvjSAgKq', 'emet@hotmail.com', '0000-00-00 00:0'),
(8, 'borel', 'perrin', '2022-10-19', 'A', '96 rue jacques cartier', 'masculin', 'jiji', '$2y$10$.07y9ccm9faM6/YuIRh86O5UNJiLe0lHFOieQfyd/5fddHpgs9YHK', 'emet@hotmail.com', '0000-00-00 00:0'),
(9, 'sale', 'bonet', '2022-10-22', 'A', '94 rue jacques cartier', 'masculin', NULL, NULL, 'sale@gmail.com', NULL),
(10, 'fits', 'dev', '2022-10-22', 'A', 'assdadsa', 'masculin', NULL, NULL, 'emet@hotmail.com', '0000-00-00 00:0'),
(11, 'fits', 'dev', '2022-10-22', 'I', 'assdadsa', 'masculin', NULL, NULL, 'emet@hotmail.com', '0000-00-00 00:0'),
(12, 'jerry', 'perry', '2011-02-04', 'A', '96 rue jacques cartier', 'masculin', 'jerry', '$2y$10$33RsY3JQqQbdAWr5Q19JWeq3/4eK/wi5r0FU2FbheJD4VfG43Kvnm', 'jerry@gmail.com', NULL),
(14, 'philip', 'morris', '2011-02-10', 'A', '96 rue jacques cartier', 'masculin', 'morris', '$2y$10$za6eCTc58FKcue8PzM.7v.wUN/Vt4zxbmqQOaDn433tTJtNVdh25.', 'philip@gmail.com', '1670942029'),
(16, 'joel', 'mathiew', '2015-07-08', 'I', '192.168.0.0', 'masculin', NULL, NULL, 'emet@hotmail.com', NULL),
(17, 'charles', 'nanga', '2015-03-08', 'I', '192.168.0.0', 'masculin', NULL, NULL, 'emet@hotmail.com', NULL),
(18, 'thuck', 'norris', '2011-06-30', 'A', '96 rue jacques cartier', 'masculin', 'norris', '$2y$10$qOH5MirYxNBgFlbLvnKVOOAsiUOu9Aj/e7jOtD7pxi4rE5kkLhTlW', 'norris@gmail.com', NULL),
(19, 'dev', 'fits', '2011-06-30', 'A', '96 rue jacques cartier', 'masculin', 'fits', '$2y$10$RStf6SmJnxaD2Jy8/FC9W.ZuNpLA6qjUXjo3t0LtqLO0yMzYMteqq', 'fits@gmail.com', '1669738213'),
(20, 'joseph', 'donne', '2008-07-11', 'I', '94 rue', 'masculin', NULL, NULL, 'emet@hotmail.com', NULL),
(21, 'carl', 'santos', '2009-06-13', 'A', '96 rue jacques cartier', 'masculin', 'carl', '$2y$10$EksG3djJnQO3i6BbjpBkc.4S8BOH5EmYAXQsMWAf5WlEC2i4OAyq6', 'santos@gmail.com', '1670937527'),
(22, 'gabriel', 'jesus', '2014-03-13', 'A', '94 rue jacques cartier', 'masculin', NULL, NULL, 'art@gmail.com', NULL);

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
(7, 2, 11, NULL),
(8, 2, 16, NULL),
(9, 2, 10, NULL),
(10, 4, 16, NULL),
(11, 5, 9, NULL),
(12, 3, 9, NULL);

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
  MODIFY `numAssociation` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `numUtilisateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `utilisateurassocier`
--
ALTER TABLE `utilisateurassocier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
