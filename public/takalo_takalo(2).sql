-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 27 sep. 2024 à 22:53
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `takalo_takalo`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Électronique'),
(2, 'Meubles'),
(3, 'Vêtements'),
(5, 'Jouets'),
(6, 'Outils'),
(7, 'Équipements de sport'),
(8, 'Appareils ménagers'),
(9, 'Bijoux'),
(10, 'Art'),
(11, 'Livres');

-- --------------------------------------------------------

--
-- Structure de la table `exchanges`
--

CREATE TABLE `exchanges` (
  `id` int(11) NOT NULL,
  `offered_item_id` int(11) NOT NULL,
  `requested_item_id` int(11) NOT NULL,
  `exchange_date` datetime DEFAULT current_timestamp(),
  `status` enum('proposed','accepted','declined') DEFAULT 'proposed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `exchanges`
--

INSERT INTO `exchanges` (`id`, `offered_item_id`, `requested_item_id`, `exchange_date`, `status`) VALUES
(5, 13, 16, '2024-09-26 13:22:10', 'accepted'),
(9, 16, 15, '2024-09-27 00:26:38', 'accepted'),
(10, 15, 13, '2024-09-27 08:39:17', 'accepted');

--
-- Déclencheurs `exchanges`
--
DELIMITER $$
CREATE TRIGGER `increment_exchange_count` AFTER INSERT ON `exchanges` FOR EACH ROW BEGIN
    UPDATE usage_statistics SET exchange_count = exchange_count + 1 WHERE id = 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `exchange_history`
--

CREATE TABLE `exchange_history` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `previous_owner_id` int(11) NOT NULL,
  `new_owner_id` int(11) NOT NULL,
  `exchange_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `exchange_history`
--

INSERT INTO `exchange_history` (`id`, `item_id`, `previous_owner_id`, `new_owner_id`, `exchange_date`) VALUES
(1, 16, 3, 4, '2024-09-27 00:33:21'),
(2, 15, 4, 3, '2024-09-27 00:33:21'),
(3, 15, 3, 5, '2024-09-27 08:39:39'),
(4, 13, 5, 3, '2024-09-27 08:39:39');

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `estimated_price` decimal(10,2) NOT NULL,
  `added_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id`, `user_id`, `category_id`, `title`, `description`, `estimated_price`, `added_date`) VALUES
(13, 3, 1, 'google pixel 4', 'En tres bon etat', 650000.00, '2024-09-25 02:39:56'),
(15, 5, 5, 'Ballon', 'Tres beau ballon', 20000.00, '2024-09-25 23:00:51'),
(16, 4, 9, 'Collier', 'En argent ', 21000.00, '2024-09-25 23:02:16'),
(17, 3, 1, 'Smartphone Samsung Galaxy S21', 'Smartphone haut de gamme avec écran 6.2 pouces, 128 Go de stockage, appareil photo 64 MP.', 1200000.00, '2024-09-27 08:15:34'),
(18, 3, 1, 'Casque Audio Sony WH-1000XM4', 'Casque Bluetooth avec réduction de bruit active, autonomie jusqu’à 30 heures.', 500000.00, '2024-09-27 08:16:38'),
(19, 3, 3, 'Basket Adidas Yeezy Boost 350 V2', 'Sneakers édition limitée, taille 42, état neuf.', 490000.00, '2024-09-27 08:17:20'),
(20, 4, 3, 'Veste en cuir Zara', 'este en cuir noir pour hommes, taille M, en parfait état.', 200000.00, '2024-09-27 08:18:08'),
(21, 4, 11, 'Manuel de programmation \"Python pour les débutants\"', 'Guide complet pour apprendre à programmer en Python.', 25000.00, '2024-09-27 08:18:58'),
(22, 5, 1, 'Console de jeux PlayStation 5', 'Console de jeux dernière génération avec une manette incluse.', 1250000.00, '2024-09-27 08:20:00'),
(23, 5, 7, 'Vélo de montagne Scott', 'Vélo tout-terrain Scott Aspect 940, cadre aluminium, 29 pouces.', 1300000.00, '2024-09-27 08:21:03'),
(24, 5, 7, 'Tapis de course ProForm 505 CST', 'Tapis de course pliable avec écran LCD, 18 programmes d\'entraînement.', 1230000.00, '2024-09-27 08:21:57'),
(25, 3, 11, 'Livre \"Sapiens: Une brève histoire de l’humanité\"', 'Livre d’histoire best-seller par Yuval Noah Harari.', 20000.00, '2024-09-27 08:23:16');

-- --------------------------------------------------------

--
-- Structure de la table `item_photos`
--

CREATE TABLE `item_photos` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `photo_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `item_photos`
--

INSERT INTO `item_photos` (`id`, `item_id`, `photo_url`) VALUES
(8, 13, '5175303.jpg'),
(9, 13, '742504.jpg'),
(11, 15, 'bc13aeda287f8b812ee4b48c64209ae4.png');

-- --------------------------------------------------------

--
-- Structure de la table `usage_statistics`
--

CREATE TABLE `usage_statistics` (
  `id` int(11) NOT NULL,
  `user_count` int(11) DEFAULT 0,
  `exchange_count` int(11) DEFAULT 0,
  `last_update` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `usage_statistics`
--

INSERT INTO `usage_statistics` (`id`, `user_count`, `exchange_count`, `last_update`) VALUES
(1, 5, 11, '2024-09-27 11:44:21');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('client','admin') DEFAULT 'client',
  `registration_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `registration_date`) VALUES
(2, 'admin', 'root@admin.com', '$2y$10$XnOv6iuGMUv47H7PcJ4/IO0cyWCbYDZxe9bDaSOZYcvWcyVnzmV8C', 'admin', '2024-09-24 18:12:22'),
(3, 'Rabe Jerena', 'rabe@test.com', '$2y$10$Mksxwc69/ZMqwp2aVsD7AOgygWNfzeN2j4i7L2p.Rp51YihIZIXTa', 'client', '2024-09-24 18:29:42'),
(4, 'Ampela Soa', 'ampela@gmail.com', '$2y$10$9yCl29IuRgRR0dVFjaTpauaJ11ZwtKtuBH4R.p9WWHptUuaG0JtqK', 'client', '2024-09-25 22:57:27'),
(5, 'Rakoto kely', 'rak@example.com', '$2y$10$tAI0p/oug7Ld3kXzVe2Z1eQdBMUOlkTyOgCkkWVy0qdc6XqFKG77G', 'client', '2024-09-25 23:00:07');

--
-- Déclencheurs `users`
--
DELIMITER $$
CREATE TRIGGER `increment_user_count` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    UPDATE usage_statistics SET user_count = user_count + 1 WHERE id = 1;
END
$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `exchanges`
--
ALTER TABLE `exchanges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offered_item_id` (`offered_item_id`),
  ADD KEY `requested_item_id` (`requested_item_id`);

--
-- Index pour la table `exchange_history`
--
ALTER TABLE `exchange_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `previous_owner_id` (`previous_owner_id`),
  ADD KEY `new_owner_id` (`new_owner_id`);

--
-- Index pour la table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `item_photos`
--
ALTER TABLE `item_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Index pour la table `usage_statistics`
--
ALTER TABLE `usage_statistics`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `exchanges`
--
ALTER TABLE `exchanges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `exchange_history`
--
ALTER TABLE `exchange_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `item_photos`
--
ALTER TABLE `item_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `usage_statistics`
--
ALTER TABLE `usage_statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `exchanges`
--
ALTER TABLE `exchanges`
  ADD CONSTRAINT `exchanges_ibfk_1` FOREIGN KEY (`offered_item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exchanges_ibfk_2` FOREIGN KEY (`requested_item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `exchange_history`
--
ALTER TABLE `exchange_history`
  ADD CONSTRAINT `exchange_history_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exchange_history_ibfk_2` FOREIGN KEY (`previous_owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exchange_history_ibfk_3` FOREIGN KEY (`new_owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `item_photos`
--
ALTER TABLE `item_photos`
  ADD CONSTRAINT `item_photos_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
