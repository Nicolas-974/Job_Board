-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 08, 2025 at 09:55 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_job_board`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `ad_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` text,
  `location` varchar(255) DEFAULT NULL,
  `contract_type` varchar(255) DEFAULT NULL,
  `salary` int DEFAULT NULL,
  `posted_date` date DEFAULT NULL,
  `company_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`ad_id`, `title`, `short_description`, `description`, `location`, `contract_type`, `salary`, `posted_date`, `company_id`) VALUES
(1, 'Développeur Web Junior', 'CDI pour un développeur motivé', 'Participation à des projets web en équipe agile.', 'Paris', 'Freelance', 32000, '2025-09-15', 1),
(2, 'Data Analyst', 'Analyse de données clients', 'Missions de reporting et visualisation de données.', 'Lyon', 'CDI', 38000, '2025-09-20', 2),
(3, 'Technicien Support', 'Assistance informatique niveau 1', 'Support aux utilisateurs et maintenance du parc.', 'Marseille', 'CDD', 25000, '2025-09-22', 3),
(4, 'Chef de Projet IT', 'Gestion de projets digitaux', 'Pilotage de projets et coordination des équipes.', 'Toulouse', 'CDI', 48000, '2025-09-25', 4),
(5, 'Vendeur en Boulangerie', 'Accueil et encaissement', 'Mise en rayon, vente et service client.', 'Lyon', 'CDD', 20000, '2025-09-28', 2),
(6, 'Chargé de Communication', 'Communication interne et externe', 'Création de contenus et gestion des réseaux sociaux.', 'Bordeaux', 'Stage', 12000, '2025-09-30', 5),
(7, 'Consultant Environnement', 'Conseil en développement durable', 'Accompagnement des entreprises dans leur transition écologique.', 'Marseille', 'CDI', 42000, '2025-10-01', 3),
(8, 'Assistant RH', 'Gestion administrative du personnel', 'Suivi des dossiers salariés et recrutement.', 'Paris', 'CDD', 28000, '2025-10-02', 1),
(9, 'Ingénieur Réseau', 'Administration réseaux et sécurité', 'Mise en place et supervision des infrastructures.', 'Strasbourg', 'CDI', 45000, '2025-10-03', 9),
(10, 'Commercial B2B', 'Développement du portefeuille clients', 'Prospection et fidélisation des clients professionnels.', 'Lille', 'CDI', 35000, '2025-10-04', 6),
(11, 'Assistant Marketing', 'Support aux campagnes marketing', 'Analyse de marché et suivi des actions commerciales.', 'Nantes', 'Stage', 11000, '2025-10-05', 8),
(12, 'Responsable Qualité', 'Mise en place de procédures qualité', 'Contrôle et amélioration continue des processus.', 'Strasbourg', 'CDI', 40000, '2025-10-06', 9),
(13, 'Développeur Mobile', 'Applications Android/iOS', 'Conception et maintenance d’applications mobiles.', 'Paris', 'CDI', 37000, '2025-10-07', 1),
(14, 'Chargé de Clientèle', 'Relation clients particuliers', 'Accueil, conseil et suivi des dossiers clients.', 'Nice', 'CDD', 26000, '2025-10-08', 7),
(15, 'Consultant Finance', 'Audit et conseil financier', 'Accompagnement des clients dans la gestion financière.', 'Lyon', 'CDI', 50000, '2025-10-09', 10);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `sector` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `name`, `sector`, `location`, `email`, `phone`) VALUES
(1, 'TechNova', 'Informatique', 'Paris', 'contact@technova.fr', '0102030405'),
(2, 'Boulangerie du Coin', 'Agroalimentaire', 'Lyon', 'contact@boulangeriecoin.fr', '0478561234'),
(3, 'GreenSolutions', 'Environnement', 'Marseille', 'info@greensolutions.fr', '0491122233'),
(4, 'MediCare Plus', 'Santé', 'Toulouse', 'contact@medicareplus.fr', '0561782345'),
(5, 'EduSmart', 'Éducation', 'Bordeaux', 'hello@edusmart.fr', '0556349876'),
(6, 'BuildIt', 'Construction', 'Lille', 'contact@buildit.fr', '0320456789'),
(7, 'TravelNow', 'Tourisme', 'Nice', 'info@travelnow.fr', '0493123456'),
(8, 'Foodies', 'Restauration', 'Nantes', 'contact@foodies.fr', '0256781234'),
(9, 'AutoDrive', 'Automobile', 'Strasbourg', 'support@autodrive.fr', '0388123456'),
(10, 'Financia', 'Finance', 'Paris', 'contact@financia.fr', '0156784321'),
(11, 'ArtDesign', 'Design', 'Montpellier', 'hello@artdesign.fr', '0467345678'),
(12, 'Sportify', 'Sport', 'Rennes', 'contact@sportify.fr', '0299345678'),
(13, 'LogiTrans', 'Transport & Logistique', 'Dijon', 'info@logitrans.fr', '0380456789'),
(14, 'MediaWorld', 'Communication', 'Grenoble', 'contact@mediaworld.fr', '0476123456'),
(15, 'AgriPlus', 'Agriculture', 'Clermont-Ferrand', 'hello@agriplus.fr', '0473456789');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `job_id` int NOT NULL,
  `ad_id` int NOT NULL,
  `people_id` int NOT NULL,
  `date_candidature` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`job_id`, `ad_id`, `people_id`, `date_candidature`) VALUES
(1, 1, 5, '2025-10-01 00:00:00'),
(2, 2, 3, '2025-10-02 00:00:00'),
(3, 3, 7, '2025-10-02 00:00:00'),
(4, 4, 1, '2025-10-03 00:00:00'),
(5, 5, 9, '2025-10-03 00:00:00'),
(6, 6, 2, '2025-10-04 00:00:00'),
(7, 7, 10, '2025-10-04 00:00:00'),
(8, 8, 4, '2025-10-05 00:00:00'),
(9, 9, 6, '2025-10-05 00:00:00'),
(10, 10, 12, '2025-10-06 00:00:00'),
(11, 11, 8, '2025-10-06 00:00:00'),
(12, 12, 14, '2025-10-07 00:00:00'),
(13, 13, 11, '2025-10-07 00:00:00'),
(14, 14, 13, '2025-10-08 00:00:00'),
(15, 15, 15, '2025-10-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `people_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`people_id`, `name`, `firstname`, `password`, `phone`, `address`) VALUES
(1, 'Dupont', 'Jean', 'mdp123', '0601020301', '12 rue de Paris, Paris'),
(2, 'Martin', 'Sophie', 'mdp456', '0601020302', '45 avenue de Lyon, Lyon'),
(3, 'Durand', 'Paul', 'mdp789', '0601020303', '78 boulevard de Marseille, Marseille'),
(4, 'Bernard', 'Claire', 'mdp321', '0601020304', '5 place du Capitole, Toulouse'),
(5, 'Petit', 'Luc', 'mdp654', '0601020305', '99 cours Victor Hugo, Bordeaux'),
(6, 'Robert', 'Julie', 'mdp987', '0601020306', '14 rue Nationale, Lille'),
(7, 'Richard', 'Nicolas', 'mdp111', '0601020307', '22 promenade des Anglais, Nice'),
(8, 'Moreau', 'Emma', 'mdp222', '0601020308', '7 quai de la Fosse, Nantes'),
(9, 'Laurent', 'Hugo', 'mdp333', '0601020309', '3 rue des Orfèvres, Strasbourg'),
(10, 'Simon', 'Camille', 'mdp444', '0601020310', '11 rue Foch, Montpellier'),
(11, 'Michel', 'Thomas', 'mdp555', '0601020311', '8 rue de Rennes, Rennes'),
(12, 'Lefebvre', 'Laura', 'mdp666', '0601020312', '2 rue de la République, Dijon'),
(13, 'David', 'Antoine', 'mdp777', '0601020313', '6 rue Lesdiguières, Grenoble'),
(14, 'Garcia', 'Elise', 'mdp888', '0601020314', '10 rue Blatin, Clermont-Ferrand'),
(15, 'Roux', 'Maxime', 'mdp999', '0601020315', '4 rue de la Liberté, Saint-Denis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`ad_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `ad_id` (`ad_id`),
  ADD KEY `people_id` (`people_id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`people_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `ad_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `job_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `people_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD CONSTRAINT `advertisements_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`);

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `advertisements` (`ad_id`),
  ADD CONSTRAINT `job_applications_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `people` (`people_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
