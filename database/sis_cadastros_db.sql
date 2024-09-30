-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/10/2024 às 01:20
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sis_cadastros_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` char(1) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf`, `data_nascimento`, `sexo`, `telefone`, `email`, `login`, `senha`, `criado_em`) VALUES
(6, 'Arthur Rodrigues', '11111111111', '2002-10-05', 'M', '77777777777', 'as@sd.sd', 'arthur', '$2y$10$azBVrvbnw9d9n2s/EXyoV.Z1lkz0DYrM2V6/Zt5641tozjkCn88h6', '2024-09-30 02:49:23'),
(16, 'Arthur Vinicius Rodrigues', '74537853785', '2004-04-05', 'M', '75745376836', 'as@gmail.com', 'artu', '$2y$10$5QSh5kPYeN2TmpEmZJ5II.0tczCSmZo68eXxJx0Y/nmVlss.Q/tEW', '2024-09-30 05:08:17'),
(17, 'João Víctor', '75637563786', '2002-02-02', 'M', '75753787636', 'a@gmail.com', 'asdf', '$2y$10$GQXGrkb8a4GrVjjwZt4HWeGsgZBdNDaMSiCvxwN95pNZX9xl0KxSG', '2024-09-30 05:53:26'),
(24, 'Paola Coelho', '75751274471', '2002-06-08', 'F', '74174252522', 'b@gmail.com', 'qwer', '$2y$10$uYPqUEqqcwenhKwjWmMYI.JjoDq5v1ryHLwMcg.2spRPdzvn99tHS', '2024-09-30 05:55:05'),
(29, 'Saulo', '43576345636', '1977-05-04', 'M', '75637857285', 'fe@gmail.com', 'sdfdf', '$2y$10$SIx0z3IxCbosmoDfHLxP1uAICJADqbKHzOJ.m3KgLyxDbc.X8tSRG', '2024-09-30 17:48:55');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `nome`, `login`, `senha`, `criado_em`) VALUES
(1, 'Arthur', 'adm', '$2y$10$bVC2K847zQpqeT2zROIJgOPvFWVYbUYe3tzeMooRzyLZouX71W1Ya', '2024-09-27 19:53:31');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `telefone` (`telefone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
