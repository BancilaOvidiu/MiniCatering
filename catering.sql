-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2023 at 05:17 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catering`
--

-- --------------------------------------------------------

--
-- Table structure for table `comenzi`
--

CREATE TABLE `comenzi` (
  `ID` int(11) NOT NULL,
  `NumeMeniu` varchar(50) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `DataRezervare` date NOT NULL,
  `NumarPersoane` int(11) NOT NULL,
  `Ora` varchar(50) NOT NULL,
  `Telefon` varchar(50) NOT NULL,
  `Pret` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comenzi`
--

INSERT INTO `comenzi` (`ID`, `NumeMeniu`, `ID_user`, `DataRezervare`, `NumarPersoane`, `Ora`, `Telefon`, `Pret`) VALUES
(5, 'meniulzilei', 2, '2023-09-21', 32, '14:45', '07324534', 800),
(6, 'cina', 2, '2023-09-12', 2, '16:41', '1', 36),
(7, 'dejun', 2, '2023-09-05', 3, '18:42', '07324534', 30),
(8, 'dejun', 2, '2023-09-05', 3, '18:42', '07324534', 30),
(9, 'dejun', 2, '2023-09-05', 2, '14:45', '071234', 20),
(10, 'dejun', 2, '2023-09-05', 2, '14:45', '071234', 20),
(11, 'dejun', 3, '2023-09-06', 3, '22:27', '071234', 30);

-- --------------------------------------------------------

--
-- Table structure for table `meniuri`
--

CREATE TABLE `meniuri` (
  `ID` int(11) NOT NULL,
  `Meniu` varchar(50) NOT NULL,
  `Ingredient` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meniuri`
--

INSERT INTO `meniuri` (`ID`, `Meniu`, `Ingredient`) VALUES
(1, 'dejun', 'Bacon'),
(2, 'dejun', 'Oua'),
(3, 'dejun', 'Rosii'),
(4, 'meniulzilei', 'Ciorba de perisoare'),
(5, 'meniulzilei', 'Snitel'),
(6, 'meniulzilei', 'Salata'),
(7, 'cina', 'Somon'),
(8, 'cina', 'Pastai');

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE `utilizatori` (
  `ID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Parola` varchar(50) NOT NULL,
  `Admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`ID`, `Username`, `Parola`, `Admin`) VALUES
(1, 'admin', 'admin', 1),
(2, 'User1', 'User123', 0),
(3, 'User2', 'User123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comenzi`
--
ALTER TABLE `comenzi`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Indexes for table `meniuri`
--
ALTER TABLE `meniuri`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comenzi`
--
ALTER TABLE `comenzi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `meniuri`
--
ALTER TABLE `meniuri`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comenzi`
--
ALTER TABLE `comenzi`
  ADD CONSTRAINT `comenzi_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `utilizatori` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
