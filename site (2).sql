-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Jun-2021 às 01:03
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `site`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `email` varchar(50) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `empresa` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`email`, `senha`, `nome`, `nascimento`, `empresa`) VALUES
('usuario', '1', 'nome', '0000-00-00', 'empresa'),
('filipe_golfe@yahoo.com', 'asd', 'asd', '2021-04-23', 'asd'),
('teste@teste.teste', 'teste', 'teste', '2021-04-25', 'teste'),
('teste2@teste2.teste2', 'teste', 'teste', '2021-04-25', 'teste'),
('asd@asd.asd', 'sadf', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `logradouro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `limite_credito` float DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `id_uf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_cliente`
--

INSERT INTO `tb_cliente` (`id_cliente`, `nome`, `cep`, `numero`, `logradouro`, `cidade`, `limite_credito`, `cpf`, `cnpj`, `status`, `id_uf`) VALUES
(17, 'Filipe Golfe', '89707-091', 154, 'Angelo Redin', 'Concórdia', 1, '106.109.819-27', '', 'A', 24),
(43, 'Filipe Golfe1111', '89707-091', 15411, '1111', 'Concórdia111', 1111, '', '00.445.335/0001-13', 'A', 1),
(45, 'Filipe Golfe1111', '89707-091', 15411, '1111', 'Concórdia111', 1111, '', '00.445.335/0001-13', 'A', 1),
(46, 'Filipe Golfe1111', '89707-091', 15411, '1111', 'Concórdia111', 1111, '', '00.445.335/0001-13', 'A', 1),
(47, 'Filipe Golfe1111', '89707-091', 15411, '1111', 'Concórdia111', 1111, '', '00.445.335/0001-13', 'A', 1),
(48, 'Filipe Golfe1111', '89707-091', 15411, '1111', 'Concórdia111', 1111, '', '00.445.335/0001-13', 'A', 1),
(49, 'Filipe Golfe1111', '89707-091', 15411, '1111', 'Concórdia111', 1111, '', '00.445.335/0001-13', 'A', 1),
(50, 'Filipe Golfe1111', '89707-091', 15411, '1111', 'Concórdia111', 1111, '', '00.445.335/0001-13', 'A', 1),
(51, 'Filipe Golfe', '89707-091', 154, 'Angelo Redin', 'Concórdia', 1, '106.109.819-27', '', 'A', 1),
(53, 'Filipe Golfe', '89707-091', 154, 'Angelo Redin', 'Concórdia', 1, '106.109.819-27', '', 'A', 17),
(54, 'Filipe Golfe', '89707-091', 154, 'Angelo Redin', 'Concórdia', 1, '106.109.819-27', '', 'A', 1),
(55, 'Filipe Golfe', '89707-091', 154, 'Angelo Redin', 'Concórdia', 1, '106.109.819-27', '', 'A', 1),
(56, 'Filipe Golfe', '89707-091', 154, 'Angelo Redin', 'Concórdia', 1, '106.109.819-27', '', 'A', 16),
(57, 'Filipe Golfe', '89707-091', 154, 'Angelo Redin', 'Concórdia', 1, '106.109.819-27', '', 'A', 15),
(58, 'Filipe Golfe', '89707-091', 154, 'Angelo Redin', 'Concórdia', 1, '106.109.819-27', '', 'A', 1),
(59, 'Filipe Golfe', '89707-091', 154, 'Angelo Redin', 'Concórdia', 1, '106.109.819-27', '', 'A', 1),
(60, 'Filipe Golfe', '89707-091', 154, 'Angelo Redin', 'Concórdia', 1, '106.109.819-27', '', 'A', 1),
(61, 'Filipe Golfe', '89707-091', 154, 'Angelo Redin', 'Concórdia', 1, '106.109.819-27', '', 'A', 17),
(62, 'Filipe Golfe', '89707-091', 154, 'Angelo Redin', 'Concórdia', 1, '106.109.819-27', '', 'A', 1),
(63, 'Filipe Golfe', '89707-091', 154, '12312', 'Concórdia', 123, '657.732.100-02', '', 'A', 22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produto`
--

CREATE TABLE `tb_produto` (
  `id_produto` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `preco` float DEFAULT NULL,
  `id_unidade_medida` int(11) NOT NULL,
  `custo` float DEFAULT NULL,
  `quantidade` float DEFAULT NULL,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_produto`
--

INSERT INTO `tb_produto` (`id_produto`, `descricao`, `preco`, `id_unidade_medida`, `custo`, `quantidade`, `status`) VALUES
(5, 'Concórdia2', 12, 2, 12, 12, 'A'),
(6, 'produt 2', 2, 2, 2, 222, 'A'),
(52, 'a', 1, 1, 1.1, 1, 'A'),
(53, '5', 5, 1, 5, 5, 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produto_venda`
--

CREATE TABLE `tb_produto_venda` (
  `id_produto_venda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `valor_unit` float DEFAULT NULL,
  `quantidade` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_produto_venda`
--

INSERT INTO `tb_produto_venda` (`id_produto_venda`, `id_produto`, `id_venda`, `valor_unit`, `quantidade`) VALUES
(12, 6, 35, 5, 5),
(47, 6, 57, 2, 2),
(48, 6, 58, 2, 2),
(49, 6, 59, 2, 2),
(50, 6, 60, 1, 1),
(51, 6, 61, 3, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_uf`
--

CREATE TABLE `tb_uf` (
  `id_uf` int(11) NOT NULL,
  `descricao` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_uf`
--

INSERT INTO `tb_uf` (`id_uf`, `descricao`) VALUES
(1, 'AC'),
(2, 'AL'),
(3, 'AP'),
(4, 'AM'),
(5, 'BA'),
(6, 'CE'),
(7, 'DF'),
(8, 'ES'),
(9, 'GO'),
(10, 'MA'),
(11, 'MT'),
(12, 'MS'),
(13, 'MG'),
(14, 'PA'),
(15, 'PB'),
(16, 'PR'),
(17, 'PE'),
(18, 'PI'),
(19, 'RJ'),
(20, 'RN'),
(21, 'RS'),
(22, 'RO'),
(23, 'RR'),
(24, 'SC'),
(25, 'SP'),
(26, 'SE'),
(27, 'TO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_unidade_medida`
--

CREATE TABLE `tb_unidade_medida` (
  `id_unidade_medida` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_unidade_medida`
--

INSERT INTO `tb_unidade_medida` (`id_unidade_medida`, `descricao`) VALUES
(1, 'unidade'),
(2, 'kilograma'),
(3, 'metro'),
(4, 'metro cubico'),
(5, 'tonelada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_venda`
--

CREATE TABLE `tb_venda` (
  `id_venda` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_venda`
--

INSERT INTO `tb_venda` (`id_venda`, `data`, `id_cliente`) VALUES
(35, '2021-09-15', 17),
(57, '2021-06-05', 43),
(58, '2021-06-05', 45),
(59, '2021-06-05', 46),
(60, '2022-02-10', 47),
(61, '2021-06-05', 48);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `FK_cliente_uf` (`id_uf`);

--
-- Índices para tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `fk_unidade_medida` (`id_unidade_medida`);

--
-- Índices para tabela `tb_produto_venda`
--
ALTER TABLE `tb_produto_venda`
  ADD PRIMARY KEY (`id_produto_venda`),
  ADD KEY `fk_produto_venda` (`id_produto`),
  ADD KEY `fk_venda_produto` (`id_venda`);

--
-- Índices para tabela `tb_uf`
--
ALTER TABLE `tb_uf`
  ADD PRIMARY KEY (`id_uf`);

--
-- Índices para tabela `tb_unidade_medida`
--
ALTER TABLE `tb_unidade_medida`
  ADD PRIMARY KEY (`id_unidade_medida`);

--
-- Índices para tabela `tb_venda`
--
ALTER TABLE `tb_venda`
  ADD PRIMARY KEY (`id_venda`),
  ADD KEY `fk_venda_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `tb_produto_venda`
--
ALTER TABLE `tb_produto_venda`
  MODIFY `id_produto_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de tabela `tb_uf`
--
ALTER TABLE `tb_uf`
  MODIFY `id_uf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `tb_unidade_medida`
--
ALTER TABLE `tb_unidade_medida`
  MODIFY `id_unidade_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_venda`
--
ALTER TABLE `tb_venda`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD CONSTRAINT `FK_cliente_uf` FOREIGN KEY (`id_uf`) REFERENCES `tb_uf` (`id_uf`);

--
-- Limitadores para a tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD CONSTRAINT `fk_unidade_medida` FOREIGN KEY (`id_unidade_medida`) REFERENCES `tb_unidade_medida` (`id_unidade_medida`);

--
-- Limitadores para a tabela `tb_produto_venda`
--
ALTER TABLE `tb_produto_venda`
  ADD CONSTRAINT `fk_produto_venda` FOREIGN KEY (`id_produto`) REFERENCES `tb_produto` (`id_produto`),
  ADD CONSTRAINT `fk_venda_produto` FOREIGN KEY (`id_venda`) REFERENCES `tb_venda` (`id_venda`);

--
-- Limitadores para a tabela `tb_venda`
--
ALTER TABLE `tb_venda`
  ADD CONSTRAINT `fk_venda_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
