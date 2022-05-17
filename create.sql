CREATE DATABASE `dressedbank`;

-- dressedbank.usuario definition

CREATE TABLE `usuario` (
  `username` varchar(30) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(200) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- dressedbank.conta definition

CREATE TABLE `conta` (
  `tipo` varchar(1) NOT NULL,
  `username` varchar(30) NOT NULL,
  `numero` varchar(10) NOT NULL,
  PRIMARY KEY (`numero`),
  KEY `conta_FK` (`username`),
  CONSTRAINT `conta_FK` FOREIGN KEY (`username`) REFERENCES `usuario` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- dressedbank.logevento definition

CREATE TABLE `logevento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `dataEvento` datetime NOT NULL DEFAULT current_timestamp(),
  `tipoEvento` varchar(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `logevento_FK` (`username`),
  CONSTRAINT `logevento_FK` FOREIGN KEY (`username`) REFERENCES `usuario` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- dressedbank.transacao definition

CREATE TABLE `transacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` char(1) NOT NULL,
  `valor` float NOT NULL,
  `conta` varchar(10) NOT NULL,
  `metodoPagamento` varchar(50) DEFAULT NULL,
  `dataTransacao` date DEFAULT current_timestamp(),
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transacao_FK` (`conta`),
  CONSTRAINT `transacao_FK` FOREIGN KEY (`conta`) REFERENCES `conta` (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;