-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Jul-2025 às 18:43
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gta`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipe_carro_piloto`
--

CREATE TABLE `equipe_carro_piloto` (
  `ID_Equipe` int(11) NOT NULL,
  `ID_Carro` int(11) NOT NULL,
  `ID_Piloto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcarros`
--

CREATE TABLE `tbcarros` (
  `ID_Carro` int(11) NOT NULL,
  `Modelo` varchar(100) DEFAULT NULL,
  `Fabricante` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tbcarros`
--

INSERT INTO `tbcarros` (`ID_Carro`, `Modelo`, `Fabricante`) VALUES
(1, '911 GT3 Cup (996)', 'Porsche ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcorridas`
--

CREATE TABLE `tbcorridas` (
  `ID_Corrida` int(11) NOT NULL,
  `Data_Inicio` date NOT NULL,
  `Data_fim` date NOT NULL,
  `ID_Piloto` int(11) NOT NULL,
  `ID_Equipe` int(11) NOT NULL,
  `ID_Carro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tbcorridas`
--

INSERT INTO `tbcorridas` (`ID_Corrida`, `Data_Inicio`, `Data_fim`, `ID_Piloto`, `ID_Equipe`, `ID_Carro`) VALUES
(1, '2025-06-27', '2025-06-29', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbequipes`
--

CREATE TABLE `tbequipes` (
  `ID_Equipe` int(11) NOT NULL,
  `Pais_sede` varchar(100) DEFAULT NULL,
  `Nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tbequipes`
--

INSERT INTO `tbequipes` (`ID_Equipe`, `Pais_sede`, `Nome`) VALUES
(1, 'Remchingen', 'Rutronik Racing');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpilotos`
--

CREATE TABLE `tbpilotos` (
  `ID_Piloto` int(11) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Graduacao` varchar(50) DEFAULT NULL,
  `Nacionalidade` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tbpilotos`
--

INSERT INTO `tbpilotos` (`ID_Piloto`, `Nome`, `Graduacao`, `Nacionalidade`) VALUES
(1, 'Patric Niederhauser', 'Platinum', 'Germany');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `id_usuario` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`id_usuario`, `Nome`, `Senha`) VALUES
(1, 'jota', '1234'),
(13, 'SASASA', 'SASASA'),
(14, 'SAS', 'ASAS'),
(15, 'jota', '123');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `equipe_carro_piloto`
--
ALTER TABLE `equipe_carro_piloto`
  ADD PRIMARY KEY (`ID_Equipe`,`ID_Carro`,`ID_Piloto`),
  ADD KEY `ID_Piloto` (`ID_Piloto`),
  ADD KEY `ID_Carro` (`ID_Carro`);

--
-- Índices para tabela `tbcarros`
--
ALTER TABLE `tbcarros`
  ADD PRIMARY KEY (`ID_Carro`);

--
-- Índices para tabela `tbcorridas`
--
ALTER TABLE `tbcorridas`
  ADD PRIMARY KEY (`ID_Corrida`),
  ADD KEY `ID_Piloto` (`ID_Piloto`),
  ADD KEY `ID_Equipe` (`ID_Equipe`),
  ADD KEY `ID_Carro` (`ID_Carro`);

--
-- Índices para tabela `tbequipes`
--
ALTER TABLE `tbequipes`
  ADD PRIMARY KEY (`ID_Equipe`);

--
-- Índices para tabela `tbpilotos`
--
ALTER TABLE `tbpilotos`
  ADD PRIMARY KEY (`ID_Piloto`);

--
-- Índices para tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbcarros`
--
ALTER TABLE `tbcarros`
  MODIFY `ID_Carro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbcorridas`
--
ALTER TABLE `tbcorridas`
  MODIFY `ID_Corrida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbequipes`
--
ALTER TABLE `tbequipes`
  MODIFY `ID_Equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbpilotos`
--
ALTER TABLE `tbpilotos`
  MODIFY `ID_Piloto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `equipe_carro_piloto`
--
ALTER TABLE `equipe_carro_piloto`
  ADD CONSTRAINT `equipe_carro_piloto_ibfk_1` FOREIGN KEY (`ID_Piloto`) REFERENCES `tbpilotos` (`ID_Piloto`) ON DELETE NO ACTION,
  ADD CONSTRAINT `equipe_carro_piloto_ibfk_2` FOREIGN KEY (`ID_Equipe`) REFERENCES `tbequipes` (`ID_Equipe`) ON DELETE NO ACTION,
  ADD CONSTRAINT `equipe_carro_piloto_ibfk_3` FOREIGN KEY (`ID_Carro`) REFERENCES `tbcarros` (`ID_Carro`) ON DELETE NO ACTION;

--
-- Limitadores para a tabela `tbcorridas`
--
ALTER TABLE `tbcorridas`
  ADD CONSTRAINT `tbcorridas_ibfk_1` FOREIGN KEY (`ID_Piloto`) REFERENCES `tbpilotos` (`ID_Piloto`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbcorridas_ibfk_2` FOREIGN KEY (`ID_Equipe`) REFERENCES `tbequipes` (`ID_Equipe`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbcorridas_ibfk_3` FOREIGN KEY (`ID_Carro`) REFERENCES `tbcarros` (`ID_Carro`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
