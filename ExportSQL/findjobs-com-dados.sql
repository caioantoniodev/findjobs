-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 27, 2020 at 12:33 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `findjobs`
--

-- --------------------------------------------------------

--
-- Table structure for table `projetos`
--

DROP TABLE IF EXISTS `projetos`;
CREATE TABLE IF NOT EXISTS `projetos` (
  `idprojetos` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `salario` decimal(10,0) NOT NULL,
  `cpffreela` bigint(200) DEFAULT NULL,
  `imgurl` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linguagem` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dataentrega` date NOT NULL,
  `cliente_cpf` bigint(200) NOT NULL,
  PRIMARY KEY (`idprojetos`),
  KEY `fk_projetos_usuarios_idx` (`cliente_cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `projetos`
--

INSERT INTO `projetos` (`idprojetos`, `titulo`, `descricao`, `salario`, `cpffreela`, `imgurl`, `linguagem`, `dataentrega`, `cliente_cpf`) VALUES
(1, 'API NODE.JS', 'Uma aplicação que consiga acessar a API do IBGE que é disponibilizada gratuitamente.', '800', NULL, 'https://image.flaticon.com/icons/svg/892/892894.svg', 'JavaScript e Node.JS', '2021-12-30', 22234566111);

-- --------------------------------------------------------

--
-- Table structure for table `reclamacoes`
--

DROP TABLE IF EXISTS `reclamacoes`;
CREATE TABLE IF NOT EXISTS `reclamacoes` (
  `idreclamacoes` int(11) NOT NULL AUTO_INCREMENT,
  `opniao` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_cpf` bigint(200) NOT NULL,
  `estrelas` int(10) NOT NULL,
  PRIMARY KEY (`idreclamacoes`),
  KEY `fk_reclamacoes_usuarios1_idx` (`usuario_cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reclamacoes`
--

INSERT INTO `reclamacoes` (`idreclamacoes`, `opniao`, `usuario_cpf`, `estrelas`) VALUES
(1, 'Esse site está ficando ótimo!', 12345487433, 5);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `cpf` bigint(200) NOT NULL,
  `nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `datanascimento` date NOT NULL,
  `telefone` bigint(200) NOT NULL,
  `experiencia` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `avatarurl` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profissao` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`cpf`, `nome`, `email`, `senha`, `datanascimento`, `telefone`, `experiencia`, `avatarurl`, `profissao`) VALUES
(10100111110, 'Caio Cichetti', 'caio_cichetti@outlook.com', 'e10adc3949ba59abbe56e057f20f883e', '2002-08-10', 19971480266, 'Experiente', 'https://image.flaticon.com/icons/svg/813/813445.svg', 'Desenvolvedor Back-end'),
(12345487433, 'Matheus Germano', 'matheus.ggcosta2014@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2003-10-10', 19984488004, 'Experiente', 'https://image.flaticon.com/icons/svg/449/449586.svg', 'Desenvolvedor front-end'),
(22234566111, 'Lucas Vinicius', 'lucas.lv405@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2002-10-10', 19987142390, 'Experiente', 'https://image.flaticon.com/icons/svg/813/813472.svg', 'Desenvolvedor front-end');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projetos`
--
ALTER TABLE `projetos`
  ADD CONSTRAINT `fk_projetos_usuarios` FOREIGN KEY (`cliente_cpf`) REFERENCES `usuarios` (`cpf`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reclamacoes`
--
ALTER TABLE `reclamacoes`
  ADD CONSTRAINT `fk_reclamacoes_usuarios1` FOREIGN KEY (`usuario_cpf`) REFERENCES `usuarios` (`cpf`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
