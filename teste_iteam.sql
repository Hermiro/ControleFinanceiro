-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Dez-2020 às 15:21
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teste_iteam`
--
CREATE DATABASE IF NOT EXISTS `teste_iteam` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `teste_iteam`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historicos`
--

CREATE TABLE `historicos` (
  `id` int(11) NOT NULL COMMENT 'Chave Primária da tabela.',
  `pessoa_id` int(11) NOT NULL COMMENT 'Chave estrangeira da tabela pessoas.',
  `pessoa_destino_id` int(11) DEFAULT NULL COMMENT 'Em caso de transferências, informa para quem foi feita (destinatário\n)',
  `operacao_id` int(11) NOT NULL COMMENT 'Chave estrangeira da tabela Operação. ',
  `valor` float(11,2) NOT NULL COMMENT 'Valor da operação.',
  `valor_anterior` float(11,2) NOT NULL COMMENT 'Valor (Saldo) original da operação antes da operação ser realizada.',
  `valor_final` float(11,2) NOT NULL COMMENT 'Valor (saldo) calculado ao final da operação. ',
  `created` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Hora de inserção.',
  `valor_anterior_pessoa_destino` float(11,2) DEFAULT NULL COMMENT 'Valor inicial da pessoa a que se destina a operação.',
  `valor_final_pessoa_destino` float(11,2) DEFAULT NULL COMMENT 'Valor Final da pessoa do destino da operação.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `historicos`
--

INSERT INTO `historicos` (`id`, `pessoa_id`, `pessoa_destino_id`, `operacao_id`, `valor`, `valor_anterior`, `valor_final`, `created`, `valor_anterior_pessoa_destino`, `valor_final_pessoa_destino`) VALUES
(5, 2, NULL, 1, 56.00, 100.00, 156.00, '2020-12-09 22:45:46', NULL, NULL),
(6, 2, NULL, 1, 56.00, 156.00, 212.00, '2020-12-09 22:46:37', NULL, NULL),
(7, 1, NULL, 1, 769.11, 80.00, 849.11, '2020-12-09 22:55:38', NULL, NULL),
(8, 1, NULL, 1, 769.11, 849.11, 1618.22, '2020-12-09 22:56:22', NULL, NULL),
(9, 1, NULL, 2, 100.00, 1618.22, 1518.22, '2020-12-09 22:56:38', NULL, NULL),
(11, 1, NULL, 2, 4.00, 1550.22, 1546.22, '2020-12-10 01:42:03', NULL, NULL),
(13, 1, 2, 3, 10.00, 1578.22, 1568.22, '2020-12-10 03:38:32', 212.00, 222.00),
(14, 2, 1, 3, 15.00, 222.00, 207.00, '2020-12-10 13:20:43', 1568.22, 1583.22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `operacoes`
--

CREATE TABLE `operacoes` (
  `id` int(11) NOT NULL COMMENT 'Chave Primária da tabela.',
  `operacao` varchar(45) NOT NULL COMMENT 'Nome da operação',
  `descricao` varchar(45) DEFAULT NULL COMMENT 'Breve descrição da operação.\n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `operacoes`
--

INSERT INTO `operacoes` (`id`, `operacao`, `descricao`) VALUES
(1, 'credito', 'insere valores'),
(2, 'debito', 'subtrai valores'),
(3, 'transferencias', 'transfere valores entre correntistas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL COMMENT 'Chave Primária da tabela.',
  `nome` varchar(45) NOT NULL COMMENT 'Nome da pessoa',
  `sobrenome` varchar(45) NOT NULL COMMENT 'Sobrenome'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela para armazenar os dados de pessoas';

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `sobrenome`) VALUES
(1, 'Hermiro', 'Carvalho'),
(2, 'Ribamar', 'Mendes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `saldos`
--

CREATE TABLE `saldos` (
  `id` int(11) NOT NULL COMMENT 'Chave primária da tabela.',
  `id_pessoa` int(11) NOT NULL COMMENT 'Chave estrangeira da pessoa. ',
  `total_value` float(11,2) NOT NULL COMMENT 'Valor atual (saldo) do cliente.\n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `saldos`
--

INSERT INTO `saldos` (`id`, `id_pessoa`, `total_value`) VALUES
(1, 1, 1583.22),
(2, 2, 207.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `historicos`
--
ALTER TABLE `historicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `Pessoa_idx` (`pessoa_id`),
  ADD KEY `Operação_idx` (`operacao_id`);

--
-- Indexes for table `operacoes`
--
ALTER TABLE `operacoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `saldos`
--
ALTER TABLE `saldos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `PessoaID_idx` (`id_pessoa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `historicos`
--
ALTER TABLE `historicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave Primária da tabela.', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `operacoes`
--
ALTER TABLE `operacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave Primária da tabela.', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave Primária da tabela.', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `saldos`
--
ALTER TABLE `saldos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave primária da tabela.', AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `historicos`
--
ALTER TABLE `historicos`
  ADD CONSTRAINT `Operação` FOREIGN KEY (`operacao_id`) REFERENCES `operacoes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Pessoa` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `saldos`
--
ALTER TABLE `saldos`
  ADD CONSTRAINT `PessoaID` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
