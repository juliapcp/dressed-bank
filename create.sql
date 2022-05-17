CREATE DATABASE `dressedbank`;

-- dressedbank.usuario definition

CREATE TABLE `usuario` (
  `username` varchar(30) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(200) NOT NULL,
  PRIMARY KEY (`username`)
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
  `numeroConta` varchar(10) NOT NULL,
  `metodoPagamento` varchar(50) DEFAULT NULL,
  `dataTransacao` date DEFAULT current_timestamp(),
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `transacao_FK` FOREIGN KEY (`id`) REFERENCES `conta` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- dressedbank.conta definition

CREATE TABLE `conta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(1) NOT NULL,
  `username` varchar(30) NOT NULL,
  `numero` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `conta_un` (`numero`),
  KEY `conta_FK` (`username`),
  CONSTRAINT `conta_FK` FOREIGN KEY (`username`) REFERENCES `usuario` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;