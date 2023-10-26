-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 16-Set-2022 às 18:11
-- Versão do servidor: 5.7.17-log
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banco_jessica_yasmim`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `idade` smallint(6) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `estadocivil` varchar(16) NOT NULL,
  `humanas` tinyint(4) NOT NULL,
  `exatas` tinyint(4) NOT NULL,
  `biologicas` tinyint(4) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `idade`, `sexo`, `estadocivil`, `humanas`, `exatas`, `biologicas`, `senha`) VALUES
(1, 'Yasmim Stefany', 'yasmimlinda@gmail.com', 10, 'F', 'Casado(a)', 1, 0, 0, '63a9f0ea7bb98050796b649e85481845'),
(3, 'Jéssica Souza', 'jessilinda@gmail.com', 32, 'F', 'Casado(a)', 1, 1, 1, '63a9f0ea7bb98050796b649e85481845');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
