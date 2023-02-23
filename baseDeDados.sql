-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2023 at 02:47 AM
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
-- Database: `aromatica`
--
CREATE DATABASE IF NOT EXISTS `aromatica` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `aromatica`;

-- --------------------------------------------------------

--
-- Table structure for table `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carrinho`
--

INSERT INTO `carrinho` (`id`, `cliente_id`, `produto_id`, `quantidade`) VALUES
(29, 1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `sobrenome`, `endereco`, `email`, `telefone`, `senha`) VALUES
(1, 'teste', '', 'rua do teste, 123', 'teste@teste.com', '', 'teste123'),
(4, 'Teste', '', 'casa do caralho', 'teste.1@gmail.com', '', 'teste1'),

-- --------------------------------------------------------

--
-- Table structure for table `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `valor_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itens_compra`
--

CREATE TABLE `itens_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_perfume` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perfumes`
--

CREATE TABLE `perfumes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `tamanho` varchar(20) NOT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `estoque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perfumes`
--

INSERT INTO `perfumes` (`id`, `nome`, `marca`, `descricao`, `preco`, `categoria`, `tamanho`, `imagem`, `estoque`) VALUES
(1, 'Kusuado', 'Marca 1', 'Descrição do perfume 1', '100.00', 'Fragrâncias masculinas', '100 ml', './imagens/Masculino-1.png', 50),
(2, 'Perfume 2', 'Marca 2', 'Descrição do perfume 2', '80.00', 'Fragrâncias masculinas', '50 ml', './imagens/Masculino-2.png', 20),
(3, 'Perfume 3', 'Marca 3', 'Descrição do perfume 3', '120.00', 'Fragrâncias femininas', '50 ml', './imagens/Feminino-1.png', 30),
(4, 'Perfume 4', 'Marca 1', 'Descrição do perfume 4', '60.00', 'Fragrâncias femininas', '30 ml', './imagens/Feminino-2.png', 15),
(5, 'Forest Trail', '100 ml', 'Um perfume masculino fresco e aromático, com notas de folhas de violeta, sálvia, musgo de carvalho e madeira de cedro.', '150.00', 'Fragrâncias masculinas', '100 ml', './imagens/Masculino-3.png', 40),
(6, 'City Lights', '50 ml', 'Um perfume masculino moderno e sofisticado, com notas de toranja, vetiver e tabaco.', '90.00', 'Fragrâncias masculinas', '50 ml', './imagens/Masculino-4.png', 10),
(7, 'Velvet Petals', '100 ml', 'Um perfume feminino floral e sedutor, com notas de pétalas de rosa, frésia, pêssego e sândalo.', '110.00', 'Fragrâncias femininas', '100 ml', './imagens/Feminino-3.png', 20),
(8, 'Sea Breeze', '30 ml', 'Um perfume feminino fresco e revigorante, com notas de bergamota, chá verde, flor de laranjeira e âmbar.', '75.00', 'Fragrâncias femininas', '30 ml', './imagens/Feminino-4.png', 5),
(9, 'Midnight Ice', '100 ml', 'Um perfume masculino misterioso e intenso, com notas de canela, bergamota e lavanda.', '130.00', 'Fragrâncias masculinas', '100 ml', './imagens/Neutro-1.png', 25),
(10, 'Gold Twilight', '50 ml', 'Um perfume feminino exótico e envolvente, com notas de patchouli, mel, âmbar e almíscar.', '95.00', 'Fragrâncias femininas', '50 ml', './imagens/Neutro-2.png', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `itens_compra`
--
ALTER TABLE `itens_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_perfume` (`id_perfume`);

--
-- Indexes for table `perfumes`
--
ALTER TABLE `perfumes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itens_compra`
--
ALTER TABLE `itens_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perfumes`
--
ALTER TABLE `perfumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `perfumes` (`id`);

--
-- Constraints for table `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Constraints for table `itens_compra`
--
ALTER TABLE `itens_compra`
  ADD CONSTRAINT `itens_compra_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id`),
  ADD CONSTRAINT `itens_compra_ibfk_2` FOREIGN KEY (`id_perfume`) REFERENCES `perfumes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
