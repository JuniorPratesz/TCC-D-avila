-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 31/10/2025 às 20:43
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mercado`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

DROP TABLE IF EXISTS `carrinho`;
CREATE TABLE IF NOT EXISTS `carrinho` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_carrinho_usuario` (`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_carrinho`
--

DROP TABLE IF EXISTS `itens_carrinho`;
CREATE TABLE IF NOT EXISTS `itens_carrinho` (
  `id` int NOT NULL,
  `id_produto` int NOT NULL,
  `id_carrinho` int NOT NULL,
  `quantidade` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item_produto` (`id_produto`),
  KEY `fk_carrinho_item` (`id_carrinho`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `imagem` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `categoria` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `imagem`, `categoria`) VALUES
(1, 'Coca-Cola 2L', 8.50, 'imagens/coca.png', 'Bebidas'),
(2, 'Arroz 5kg', 20.00, 'imagens/arroz.png', 'Alimentos'),
(3, 'Sabonete', 2.50, 'imagens/sabonete.png', 'Higiene'),
(4, 'Feijão Carioca 1kg', 8.50, 'imagens/feijao.png', 'Mercearia'),
(5, 'Açúcar Refinado 1kg', 4.20, 'imagens/acucar.png', 'Mercearia'),
(6, 'Café Pilão 500g', 12.90, 'imagens/cafe.png', 'Bebidas'),
(7, 'Leite Integral 1L', 3.50, 'imagens/leite.png', 'Laticínios'),
(8, 'Queijo Mussarela 200g', 10.90, 'imagens/queijo.png', 'Laticínios'),
(9, 'Manteiga 200g', 9.70, 'imagens/manteiga.png', 'Laticínios'),
(10, 'Suco de Laranja 1L', 6.50, 'imagens/suco_laranja.png', 'Bebidas'),
(11, 'Macarrão Espaguete 500g', 5.40, 'imagens/macarrao.png', 'Massas'),
(12, 'Molho de Tomate 340g', 4.10, 'imagens/molho.png', 'Massas'),
(13, 'Sabão em Pó 1kg', 12.30, 'imagens/sabao_po.png', 'Limpeza'),
(14, 'Detergente 500ml', 2.90, 'imagens/detergente.png', 'Limpeza'),
(15, 'Shampoo 400ml', 11.50, 'imagens/shampoo.png', 'Higiene'),
(16, 'Papel Higiênico 12 rolos', 15.80, 'imagens/papel_h.png', 'Higiene');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'junior', 'pratesjunior@gmail.com', '$2y$10$G2cCqFA1FOr2a4LloYNEIOJzdAcAdz9QWUsaCfNQ3QzJ32lhJ.Rym'),
(2, 'guilherme', 'g2@gmail.com', '$2y$10$SSaDczaPJZZwX7eUM6JmOe.y3LzUB0F3rYg827P5u661Qxy2GE4Pu'),
(3, 'thiago', 'thiag@jk.v', '$2y$10$nYyXZwNAZb75Zk/G8REGcOJxOcPvYnbI7h0rKn8pl39SONYJbWiGu'),
(4, 'guileme', 'guileme@gmail.com', '$2y$10$5Me1TD.qeYldG7ve0A7freQlS6m8UG48xwlBXh6rzQ3wlhanw5Zj2'),
(5, 'thiago', 'thiag0@jk.v', '$2y$10$jhfZTdjvohi9/G5QP1b1iu6QXPBGf.UjVin.Dd2fyyfNES/uM/qcu'),
(6, 'Matheus gay', 'matheusgay@gmail.com', '$2y$10$Ja4OGLNgxCLMtTfejXwk9uTfyeSBTspmu7HcDwGK5wzY0zPO5xcAa'),
(7, 'Matheus', 'matheus@gmail.com', '$2y$10$RjCF4RVdT3wtCNrGQk6BtuZD0bBx0Ayy5Q1QqHmc5MYZsr6GuylOC');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
