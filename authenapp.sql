-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 24, 2023 at 10:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `authenapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `biografia` varchar(250) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `contrasena`, `imagen`, `biografia`, `nombre`, `telefono`) VALUES
(1, 'aaa@eee.com', '$2y$10$Lj48tC6zF8lvNT0GGgLXRunktiWO3tKG3eWBInThypmrc2nJdAEiy', 'perfil_64beaedabafeb5.08362840.jpg', 'test de perfil', 'test', '88822222777'),
(5, 'jack@email.com', '$2y$10$wbrzIRbadELdaF/BehH4zeajJz5FRsN39U1PMsV5xQzkvfR1IqZby', 'perfil_64bed46d71b419.01019394.jpg', 'CTU', 'Jack Bauer', '800-555-5555'),
(6, 'pete@email.com', '$2y$10$gunlUBOzKspjxKh9jbDE0ePKsXawsbqsYpbUjasi/cvmCpS/eYssm', 'perfil_64bed4a8d83253.12029758.jpg', 'tech support', 'Pete Joe', '222-444-2222');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
