-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 26 nov. 2023 à 15:59
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `location`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `id_membre` int(11) DEFAULT NULL,
  `id_vehicule` int(11) DEFAULT NULL,
  `date_heure_depart` datetime NOT NULL,
  `date_heure_fin` datetime NOT NULL,
  `prix_total` int(11) DEFAULT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `id_vehicule`, `date_heure_depart`, `date_heure_fin`, `prix_total`, `date_enregistrement`) VALUES
(39, 6, 16, '2023-11-24 00:00:00', '2023-12-02 00:00:00', 3600, '2023-11-24 07:36:27'),
(43, 6, 17, '2023-11-24 00:00:00', '2023-11-30 00:00:00', 2394, '2023-11-24 15:38:32');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231114133740', '2023-11-14 14:38:42', 56),
('DoctrineMigrations\\Version20231115094645', '2023-11-15 10:47:01', 60),
('DoctrineMigrations\\Version20231115100508', '2023-11-15 11:05:17', 24),
('DoctrineMigrations\\Version20231115101113', '2023-11-15 11:11:20', 75),
('DoctrineMigrations\\Version20231115101353', '2023-11-15 11:13:59', 53),
('DoctrineMigrations\\Version20231115131851', '2023-11-15 14:18:57', 33),
('DoctrineMigrations\\Version20231124124637', '2023-11-24 13:46:55', 90),
('DoctrineMigrations\\Version20231124143410', '2023-11-26 15:54:10', 78);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` tinyint(1) NOT NULL,
  `statut` int(11) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`) VALUES
(6, 'admin', '$2y$13$JhVoBIj05NOJykkQ7YGpTeuLyjKUREWVJMn6ZeeHsgFmF.YYr6MJ6', 'admin', 'admin', 'admin@admin.fr', 1, 1, '2023-11-22 21:02:37'),
(10, 'Fantik', '$2y$13$D/PBgXSd2blNXEq8nuzWMuMG40e8xnh7n6xL7/yirtf2p4CRXBhLO', 'Baptiste', 'RINGLER', 'ringlerbaptiste@gmail.com', 1, 0, '2023-11-24 17:23:05'),
(12, 'Membre account', '$2y$13$J3nBgKVNRey1PcQj4QsXg.YAi3KZ5FOkT.73nVAo24XapidSzzBaq', 'membre', 'membre', 'membre@membre.fr', 1, 0, '2023-11-24 18:33:18');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id_vehicule` int(11) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `marque` varchar(50) NOT NULL,
  `modele` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `photo` varchar(200) NOT NULL,
  `prix_journalier` int(11) NOT NULL,
  `date_enregistrement` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id_vehicule`, `titre`, `marque`, `modele`, `description`, `photo`, `prix_journalier`, `date_enregistrement`) VALUES
(1, 'Sportive', 'Nissan', 'S14', 'VOITURE', 'https://imagebee.org/vehicles/nissan-silvia-s14/nissan-silvia-s14-10-1920x1200.jpg', 409, '2023-11-22 15:29:42'),
(2, 'Sportive', 'Toyota', 'Supra', 'Toyota Supra', 'https://images.caradisiac.com/images/7/3/0/5/177305/S0-une-toyota-supra-vendue-plus-de-150-000-eur-596078.jpg', 500, '0000-00-00 00:00:00'),
(14, 'Sportive', 'Nissan', 'S15 200sx 1999', 'Cette voiture est juste la meilleure voiture de tous les temps', 'https://wallpapercave.com/wp/wp2171191.jpg', 399, NULL),
(16, 'Sportive', 'Nissan', 'GTR R34', 'Nissan GTR R34', 'https://motoristprod.s3.amazonaws.com/uploads/redactor_rails/picture/data/5266/JDMs-All-Car-Enthusiasts-Should-Know-Nissan-skyline.jpg', 450, NULL),
(17, 'Sportive', 'Mazda', 'RX7', 'Mazda RX7', 'https://www.motortrend.com/uploads/sites/25/2011/04/Top-20-JDM-Cars-Of-All-Time-1996-180SX-Type-X-Front-Bumper.jpg', 399, NULL),
(18, 'Sportive', 'Nissan', 'GTR R33', 'Nissan GTR R33', 'https://m.atcdn.co.uk/ect/media/%7Bresize%7D/81647090036d44218026d27fd242c405.jpg', 299, NULL),
(19, 'Citadine Sportive', 'Toyota', 'GT 86', 'Toyota GT86', 'https://rare-gallery.com/uploads/posts/990108-Toyota-GT-86-JDM-Japanese-cars-Toyota-tuning-sports-car.jpg', 199, NULL),
(20, 'Toyota', 'Toyota', 'Supra MK5', 'Toyota Supra MK5', 'https://www.carscoops.com/wp-content/uploads/2019/01/90e6952c-jdm-2020-toyota-gr-supra-1355.jpg', 210, NULL),
(22, 'voiture de sport cambriolet', 'audi', 'r8', 'rouge', 'https://www.largus.fr/images/images/audi-r8-v10-plus-2015-rouge-nouvelle-essai-52.jpg', 150, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `IDX_6EEAA67D79F41388` (`id_vehicule`),
  ADD KEY `IDX_6EEAA67DD0834EC4` (`id_membre`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id_vehicule`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id_vehicule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D79F41388` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id_vehicule`),
  ADD CONSTRAINT `FK_6EEAA67DD0834EC4` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
