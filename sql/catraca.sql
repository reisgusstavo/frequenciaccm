-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/09/2024 às 09:25
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `catraca`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_aluno`
--

CREATE TABLE `tb_aluno` (
  `idtb_aluno` int(11) NOT NULL,
  `nomealuno` varchar(100) DEFAULT NULL,
  `celularAluno` varchar(15) DEFAULT NULL,
  `celularResponsavel` varchar(15) DEFAULT NULL,
  `dtnascimento` varchar(10) DEFAULT NULL,
  `tb_turma_idturma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_operadores`
--

CREATE TABLE `tb_operadores` (
  `idoperador` int(11) NOT NULL,
  `nomeoperador` varchar(50) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tb_operadores`
--

INSERT INTO `tb_operadores` (`idoperador`, `nomeoperador`, `senha`) VALUES
(3, 'Gustavo', '81dc9bdb52d04dc20036dbd8313ed055'),
(5, 'Gustavo teste', '5a1e3a5aede16d438c38862cac1a78db');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_responsavel`
--

CREATE TABLE `tb_responsavel` (
  `id_responsavel` int(11) NOT NULL,
  `nome1` varchar(50) DEFAULT NULL,
  `nome2` varchar(50) DEFAULT NULL,
  `tb_responsavelcol` varchar(45) DEFAULT NULL,
  `tb_aluno_idtb_aluno` int(11) NOT NULL,
  `tb_aluno_tb_turma_idturma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_turma`
--

CREATE TABLE `tb_turma` (
  `idturma` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `ano` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tb_turma`
--

INSERT INTO `tb_turma` (`idturma`, `descricao`, `ano`) VALUES
(3, '3 DS', 2024);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_aluno`
--
ALTER TABLE `tb_aluno`
  ADD PRIMARY KEY (`idtb_aluno`,`tb_turma_idturma`),
  ADD KEY `fk_tb_aluno_tb_turma_idx` (`tb_turma_idturma`);

--
-- Índices de tabela `tb_operadores`
--
ALTER TABLE `tb_operadores`
  ADD PRIMARY KEY (`idoperador`);

--
-- Índices de tabela `tb_responsavel`
--
ALTER TABLE `tb_responsavel`
  ADD PRIMARY KEY (`id_responsavel`,`tb_aluno_idtb_aluno`,`tb_aluno_tb_turma_idturma`),
  ADD KEY `fk_tb_responsavel_tb_aluno1_idx` (`tb_aluno_idtb_aluno`,`tb_aluno_tb_turma_idturma`);

--
-- Índices de tabela `tb_turma`
--
ALTER TABLE `tb_turma`
  ADD PRIMARY KEY (`idturma`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_operadores`
--
ALTER TABLE `tb_operadores`
  MODIFY `idoperador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_responsavel`
--
ALTER TABLE `tb_responsavel`
  MODIFY `id_responsavel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_turma`
--
ALTER TABLE `tb_turma`
  MODIFY `idturma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_aluno`
--
ALTER TABLE `tb_aluno`
  ADD CONSTRAINT `fk_tb_aluno_tb_turma` FOREIGN KEY (`tb_turma_idturma`) REFERENCES `tb_turma` (`idturma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_responsavel`
--
ALTER TABLE `tb_responsavel`
  ADD CONSTRAINT `fk_tb_responsavel_tb_aluno1` FOREIGN KEY (`tb_aluno_idtb_aluno`,`tb_aluno_tb_turma_idturma`) REFERENCES `tb_aluno` (`idtb_aluno`, `tb_turma_idturma`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
