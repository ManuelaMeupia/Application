-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 17, 2024 at 09:28 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `android`
--

-- --------------------------------------------------------

--
-- Table structure for table `association_1`
--

DROP TABLE IF EXISTS `association_1`;
CREATE TABLE IF NOT EXISTS `association_1` (
  `Id_User` int(8) NOT NULL,
  `Use_Id_User` int(8) NOT NULL,
  PRIMARY KEY (`Id_User`,`Use_Id_User`),
  KEY `FK_Association_2` (`Use_Id_User`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Statut` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `contact_name`, `contact_number`, `created_at`, `Statut`) VALUES
(4, '125', 'yves', '654894522', '2024-09-17 03:35:10', 0),
(3, '125', 'etoga', '65844484', '2024-09-17 03:26:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `Id_User` int(8) NOT NULL AUTO_INCREMENT,
  `Nom` longtext,
  `prenom` longtext,
  `telephone` varchar(11) DEFAULT NULL,
  `email` longtext,
  `localisation` longtext,
  `categorie_activite` longtext,
  `nom_Cmcial` longtext,
  `pass` longtext,
  `role_user` longtext,
  `secteur_act` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id_User`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id_User`, `Nom`, `prenom`, `telephone`, `email`, `localisation`, `categorie_activite`, `nom_Cmcial`, `pass`, `role_user`, `secteur_act`) VALUES
(124, 'yves', 'tony', '12555', 'toto123@gmail.com', '', 'agriculture', 'geek', '$2y$10$V0Uqq33U57PYzj7wbSciGuZW/XYDq8q47e5NQhNPCpLeMHA5.Nm3S', NULL, 'agriculture'),
(125, 'toto', 'toto', '12555', 'tata123@gmail.com', '', 'agriculture', '', '$2y$10$uq6d9MGg0OSBP9jo0pBgA.l4Hoj1jTPfws4odOcEN2j91Isbc86Tm', NULL, 'agriculture'),
(130, '', '', '', '', '', '', '', '', NULL, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `association_1`
--
ALTER TABLE `association_1`
  ADD CONSTRAINT `FK_Association_1` FOREIGN KEY (`Id_User`) REFERENCES `user` (`Id_User`),
  ADD CONSTRAINT `FK_Association_2` FOREIGN KEY (`Use_Id_User`) REFERENCES `user` (`Id_User`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
