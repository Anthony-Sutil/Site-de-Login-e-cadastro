CREATE DATABASE ccs;

use ccs;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `sobrenome` varchar(45) NOT NULL,
  `email` varchar(110) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `data_nasc` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ccs`.`usuarios` (`nome`, `sobrenome`, `email`, `senha`, `data_nasc`) VALUES
('Jobs', 'Teste', 'admin@puc.br', 'jobs@123', '2000-01-01'),
('Tim', 'Teste', 'admin@puc.br', 'tim@456', '2000-01-01'),
('Ada', 'Teste', 'admin@puc.br', 'ada@321', '2000-01-01');