-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2023 at 04:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestiondemandemodules`
--

-- --------------------------------------------------------

--
-- Table structure for table `demande`
--

CREATE TABLE `demande` (
  `iddemande` int(11) NOT NULL,
  `idetud` int(11) NOT NULL,
  `datedemande` date DEFAULT NULL,
  `modulesdemandees` varchar(255) DEFAULT NULL,
  `file_releve` varchar(255) DEFAULT NULL,
  `file_carte` varchar(255) DEFAULT NULL,
  `iduser` int(11) NOT NULL,
  `reponseadmin` tinyint(1) DEFAULT NULL,
  `datereponse` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `demande`
--

INSERT INTO `demande` (`iddemande`, `idetud`, `datedemande`, `modulesdemandees`, `file_releve`, `file_carte`, `iduser`, `reponseadmin`, `datereponse`) VALUES
(17, 26, '2023-04-10', 'm22-m23', 'Dolor vel laborum L_Quia enim amet veni_releve.pdf', 'Dolor vel laborum L_Quia enim amet veni_carte.png', 0, 0, NULL),
(19, 35, '2023-04-12', 'm24-m30', 'Ahmad_N._releve.pdf', 'Ahmad_N._carte.png', 11, NULL, NULL),
(21, 31, '2023-04-13', 'm31', 'Aut optio qui nesci_Tempore Nam deserun_releve.pdf', 'Aut optio qui nesci_Tempore Nam deserun_carte.png', 7, 0, NULL),
(28, 36, '2023-04-14', 'm30', 'NABIL_ILYASS_releve.pdf', 'NABIL_ILYASS_carte.png', 6, 0, NULL),
(29, 39, '2023-04-14', 'm24-m29-m30-m31', 'Ahmed_chawki_releve.pdf', 'Ahmed_chawki_carte.png', 6, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `idetud` int(11) NOT NULL,
  `apogee` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `datenaissance` date DEFAULT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `filiere` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`idetud`, `apogee`, `nom`, `prenom`, `datenaissance`, `statut`, `filiere`) VALUES
(26, '1999', 'Said1', 'Tallouk', '2014-11-11', '1', 'GI'),
(30, 'Ut assumenda quisqua', 'Accusamus cillum lab', 'Ea unde aut voluptat', '1990-01-05', '1', 'Hic magnam non aliqu'),
(31, 'Iusto hic et placeat', 'Aut optio qui nesci', 'Tempore Nam deserun', '1998-07-28', '1', 'Ad dicta quisquam no'),
(32, 'Et nostrud enim omni', 'Labore nesciunt ven', 'Similique commodi om', '1974-04-10', '1', 'Maiores alias ipsum'),
(33, 'Consectetur labore d', 'Omnis voluptatem Et', 'Occaecat placeat vo', '1994-05-15', '1', 'Tempora lorem lorem '),
(34, 'Quod cillum sint nat', 'Aspernatur sed reici', 'Doloribus dolorem qu', '1986-09-12', '1', 'Cupidatat sunt prov'),
(35, '1221', 'Ahmad', 'N.', '2023-04-12', '1', 'GI'),
(36, '067', 'NABIL', 'ILYASS', '1997-03-11', '1', 'GI'),
(37, '2023', 'Nabil', 'Mohammad', '1111-01-01', '1', 'SI'),
(38, 'GI', 'Quam minim ullam sun', 'In consectetur aut i', '1997-08-25', '1', 'Dignissimos esse pro'),
(39, '00', 'Ahmed', 'chawki', '1111-01-01', '1', 'SI');

-- --------------------------------------------------------

--
-- Table structure for table `eventuser`
--

CREATE TABLE `eventuser` (
  `idevent` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `dateevent` date DEFAULT NULL,
  `ipadress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventuser`
--

INSERT INTO `eventuser` (`idevent`, `iduser`, `dateevent`, `ipadress`) VALUES
(1, 6, '0000-00-00', '0'),
(2, 6, '0000-00-00', '0'),
(3, 6, '0000-00-00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `iduser` int(11) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profil` varchar(255) DEFAULT NULL,
  `statut` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`iduser`, `login`, `password`, `profil`, `statut`) VALUES
(6, 'taha@gmail.com', '1122', '1', '1'),
(7, 'hamza@gmail.com', '1111', '0', '1'),
(8, '1999@gmail.com', '111222', '1', '1'),
(9, 'hamza@gmail.com', '3224', '1', '1'),
(10, 'a.ali@gmail.com', '1234', '1', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`iddemande`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idetud` (`idetud`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`idetud`);

--
-- Indexes for table `eventuser`
--
ALTER TABLE `eventuser`
  ADD PRIMARY KEY (`idevent`),
  ADD KEY `iduser` (`iduser`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `demande`
--
ALTER TABLE `demande`
  MODIFY `iddemande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `idetud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `eventuser`
--
ALTER TABLE `eventuser`
  MODIFY `idevent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `utilisateur` (`iduser`),
  ADD CONSTRAINT `demande_ibfk_2` FOREIGN KEY (`idetud`) REFERENCES `etudiant` (`idetud`);

--
-- Constraints for table `eventuser`
--
ALTER TABLE `eventuser`
  ADD CONSTRAINT `eventuser_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `utilisateur` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
