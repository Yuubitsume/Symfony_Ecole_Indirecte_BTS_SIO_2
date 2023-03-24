-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db_symfony_bts
-- Généré le : lun. 28 nov. 2022 à 09:51
-- Version du serveur : 8.0.30
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220916120334', '2022-09-16 14:03:57', 542),
('DoctrineMigrations\\Version20220916125653', '2022-09-16 15:32:27', 523),
('DoctrineMigrations\\Version20220919061845', '2022-09-19 08:18:56', 620),
('DoctrineMigrations\\Version20220919065705', '2022-09-19 08:57:15', 468),
('DoctrineMigrations\\Version20220929150131', '2022-09-29 17:01:54', 628),
('DoctrineMigrations\\Version20221021135137', '2022-10-21 15:54:08', 515),
('DoctrineMigrations\\Version20221128094720', '2022-11-28 10:48:37', 600);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id` int NOT NULL,
  `libellé` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id`, `libellé`) VALUES
(1, 'DEV'),
(2, 'MATH');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `note_controle`
--

CREATE TABLE `note_controle` (
  `id` int NOT NULL,
  `note` double DEFAULT NULL,
  `coefficient` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `matiere_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `note_controle`
--

INSERT INTO `note_controle` (`id`, `note`, `coefficient`, `user_id`, `matiere_id`) VALUES
(1, 14, 2, NULL, NULL),
(2, 17, 1, NULL, NULL),
(3, 13, 1, NULL, NULL),
(4, 19, 2, NULL, NULL),
(5, 14, 3, NULL, NULL),
(24, 12, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `surname`, `mail`, `pseudo`) VALUES
(1, 'julien', '[\"ROLE_ADMIN\"]', '$2y$13$yQsaBLZ/uMhxdZ4LNMFofOhIOYdSdkY.KHaA8sY6ELjbsE5v.oV3q', 'perez', 'admin@gmail.com', ''),
(2, 'patrick', '[\"ROLE_ADMIN\"]', '$2y$13$t6X74m9xmMZV3ZODf0EnRuxZb2LD/vbOnXghNfV6SBq12hOtUwRn.', 'patrick', 'patrick@gmail.com', ''),
(3, 'michel', '[]', '$2y$13$XyD73Eq6lxzgNbYF.pKEPeT/02Cp5NcmGmiNi2PXZmOcuRN.T3fYq', 'dupont', 'michel@gmail.com', ''),
(4, 'Xavier', '[]', '$2y$13$HH..7/gZMtEe..JQgfB9H.pnsGvGQ4PhABCW9GVWhz363dIk7OtTe', 'plaitil', 'xavier.plaitil@gmail.com', ''),
(5, 'Albert', '[]', '$2y$13$EUP8JCX0jh4H1K4X0WujPuRLI9QgTlmvdo/J22pMbRwYrWujlIzrO', 'Simon', 'Albert.Simon@gmail.com', ''),
(6, 'Vigile', '[]', '$2y$13$d36LXahJsQeOiCLDzMULuefHjYYjHgoMFWdTNkzy6u.m86ZVfEWGq', 'class', 'vigile.class@gmail.com', ''),
(7, 'Flick', '[]', '$2y$13$F8.a9HOeEkwym18m.Oo2ducENoQfz3svRN6VQ8wmUKujdEhlxUJsO', 'Rl', 'flick.RL@gmail.com', ''),
(8, 'oui', '[]', '$2y$13$Sp4e/Hyq0nd/haa2Lz5JkeadJWeA2fEkzdav5msLCjnAAKi5iryQi', 'non', 'michel2@gmail.com', ''),
(9, 'Lizard', '[]', '$2y$13$ibdWua5TRbnC3taeIucp6OUIMZjxG6xVvfqCEzhhqnUW6Jm9Q1gke', 'Fly', 'michel34@gmail.com', ''),
(13, 'Lizard2', '[]', '$2y$13$1iw5OcahdY0n0ihccPjRhuNxzYaWo6chjMn9EZ79siDG6Nf6y.lTW', 'gggg', 'michel88@gmail.com', 'lllll'),
(14, 'oui4', '[]', '$2y$13$89zVkNEvmdCx0R1MGgkLbu87Q//dxduCZHYkPjJH4L2kGzuZVrhya', 'hgdfhd', 'michel89@gmail.com', 'dfgdgffdh');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `note_controle`
--
ALTER TABLE `note_controle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1E62E5F0A76ED395` (`user_id`),
  ADD KEY `IDX_1E62E5F0F46CD258` (`matiere_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `note_controle`
--
ALTER TABLE `note_controle`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;


--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `note_controle`
--
ALTER TABLE `note_controle`
  ADD CONSTRAINT `FK_1E62E5F0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_1E62E5F0F46CD258` FOREIGN KEY (`matiere_id`) REFERENCES `matiere` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
