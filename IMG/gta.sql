-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Maio-2025 às 12:34
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

--
-- Extraindo dados da tabela `equipe_carro_piloto`
--

INSERT INTO `equipe_carro_piloto` (`ID_Equipe`, `ID_Carro`, `ID_Piloto`) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 1, 3),
(2, 2, 4),
(2, 2, 5),
(2, 2, 6),
(3, 2, 7),
(3, 2, 8),
(3, 2, 9),
(4, 3, 10),
(4, 3, 11),
(4, 3, 12),
(5, 4, 13),
(5, 4, 14),
(5, 4, 15),
(6, 4, 16),
(6, 4, 17),
(6, 4, 18),
(7, 1, 19),
(7, 1, 20),
(7, 1, 21),
(8, 5, 22),
(8, 5, 23),
(8, 5, 24),
(9, 2, 25),
(9, 2, 26),
(9, 2, 27),
(10, 1, 28),
(10, 1, 29),
(10, 1, 30);

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
(1, 'BMW M4 GT3 EVO', 'BMW'),
(2, 'Porsche 911 GT3 R 992', 'Porsche'),
(3, 'Mercedes-AMG GT3 EVO', 'Mercedes'),
(4, 'Audi R8 LMS GT3 EVO II', 'Audi'),
(5, 'Aston Martin Vantage GT3', 'Aston Martin');

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
(5, '2025-05-10', '0205-05-10', 1, 1, 1);

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
(1, 'Bélgica', 'Team WRT'),
(2, 'Alemanha', 'Rutronik Racing'),
(3, 'Alemanha', 'Schumacher CLRT'),
(4, 'Alemanha', 'Mercedes-AMG Team MANN-FILTER'),
(5, 'França', 'Comtoyou Racing'),
(6, 'França', 'CSA Racing'),
(7, 'Alemanha', 'ROWE Racing'),
(8, 'Alemanha', 'Walkenhorst Motorsport'),
(9, 'Holanda', 'Verstappen.com Racing'),
(10, 'Bélgica', 'AlManar Racing by WRT');

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
(1, 'Kelvin van der Linde', 'Platina', 'Sul-africano'),
(2, 'Charles Weerts', 'Gold', 'Belga'),
(3, 'Ugo De Wilde', 'Silver', 'Belga'),
(4, 'Sven Müller', 'Gold', 'Alemão'),
(5, 'Patric Niederhauser', 'Silver', 'Suíço'),
(6, 'Alessio Picariello', 'Bronze', 'Italiano'),
(7, 'Ayhancan Güven', 'Bronze', 'Turco'),
(8, 'Laurin Heinrich', 'Silver', 'Alemão'),
(9, 'Klaus Bachler', 'Gold', 'Austríaco'),
(10, 'Lucas Auer', 'Platina', 'Austríaco'),
(11, 'Matteo Cairoli', 'Gold', 'Italiano'),
(12, 'Maro Engel', 'Silver', 'Alemão'),
(13, 'Mattia Drudi', 'Bronze', 'Italiano'),
(14, 'Marco Sørensen', 'Gold', 'Dinamarquês'),
(15, 'Nicki Thiim', 'Silver', 'Dinamarquês'),
(16, 'Simon Gachet', 'Gold', 'Francês'),
(17, 'James Kell', 'Silver', 'Britânico'),
(18, 'Arthur Rougier', 'Bronze', 'Francês'),
(19, 'Augusto Farfus', 'Platina', 'Brasileiro'),
(20, 'Jesse Krohn', 'Gold', 'Finlandês'),
(21, 'Raffaele Marciello', 'Silver', 'Italiano'),
(22, 'Henrique Chaves', 'Gold', 'Brasileiro'),
(23, 'Christian Krognes', 'Bronze', 'Norueguês'),
(24, 'David Pittard', 'Silver', 'Britânico'),
(25, 'Harry King', 'Gold', 'Britânico'),
(26, 'Chris Lulham', 'Bronze', 'Britânico'),
(27, 'Thierry Vermeulen', 'Gold', 'Belga'),
(28, 'Al Faisal Al Zubair', 'Platina', 'Emirati'),
(29, 'Jens Klingmann', 'Silver', 'Alemão'),
(30, 'Ben Tuck', 'Bronze', 'Britânico');

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
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbcarros`
--
ALTER TABLE `tbcarros`
  MODIFY `ID_Carro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tbcorridas`
--
ALTER TABLE `tbcorridas`
  MODIFY `ID_Corrida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbequipes`
--
ALTER TABLE `tbequipes`
  MODIFY `ID_Equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tbpilotos`
--
ALTER TABLE `tbpilotos`
  MODIFY `ID_Piloto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
