-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-mechatechnologie.alwaysdata.net
-- Generation Time: Nov 10, 2024 at 07:37 PM
-- Server version: 10.11.9-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mechatechnologie_siteweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `TypeProduit` enum('brasero','Garde-Corp','Escalier','autre') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `url`, `description`, `TypeProduit`) VALUES
(1, 'img/image_brasero.jpg', 'Brasero en métal élégant pour l’extérieur', 'brasero'),
(2, 'img/image_garde_corps.jpg', 'Garde-corps design en métal pour la sécurité', 'Garde-Corp'),
(3, 'img/image_escalier.jpg', 'Escalier métallique moderne et robuste', 'Escalier'),
(5, 'img/brasero_icon.jpg', 'Icône de brasero en métal', 'autre'),
(6, 'img/innovation_icon.jpg', 'Icône illustrant l’innovation', 'autre'),
(7, 'img/experience_icon.jpg', 'Icône illustrant l’expérience de l’entreprise', 'autre'),
(8, 'img/quality_icon.jpg', 'Icône représentant la qualité des produits', 'autre'),
(9, 'img/facebook_icon.jpg', 'Icône de Facebook pour les réseaux sociaux', 'autre'),
(10, 'img/linkedin_icon.jpg', 'Icône de LinkedIn pour les réseaux sociaux', 'autre'),
(11, 'img/twitter_icon.jpg', 'Icône de Twitter pour les réseaux sociaux', 'autre'),
(12, 'img/brasero-clever.jpg', 'Brasero en métal avec espace de rangement pour le bois, idéal pour dehors', 'brasero'),
(25, '../img/brasero_sol.jpg', 'Bol_braséro', 'brasero');

-- --------------------------------------------------------

--
-- Table structure for table `renseignements`
--

CREATE TABLE `renseignements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `renseignements`
--

INSERT INTO `renseignements` (`id`, `user_id`, `product_id`, `message`) VALUES
(1, 2, 2, 'test'),
(2, 2, 1, 'brasero'),
(3, 2, 3, 'Escalier limon central debillardé');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_type` varchar(50) DEFAULT NULL,
  `request_details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `admin`) VALUES
(1, 'hugo.vacquier@gmail.com', 'JShv151003', 1),
(2, 'eliott.vacquier@gmail.com', 'JSev110906', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renseignements`
--
ALTER TABLE `renseignements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `renseignements`
--
ALTER TABLE `renseignements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `renseignements`
--
ALTER TABLE `renseignements`
  ADD CONSTRAINT `renseignements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `renseignements_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `images` (`id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
