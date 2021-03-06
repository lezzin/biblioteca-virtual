-- drop database biblioteca;
create database biblioteca;
use biblioteca;

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL auto_increment,
  `nome` varchar(50) NOT NULL,
  -- os campos de números poderiam ser int, mas dá o erro "out of range"
  `CPF` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(12) NOT NULL,
  PRIMARY KEY(`idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `compra` (
  `idCompra` int(11) NOT NULL auto_increment,
  `preco` float(8,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `fk_cliente` int(11) NOT NULL,
  `fk_livro` int(11) NOT NULL,
  primary key(`idCompra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `emprestimo` (
  `idEmprestimo` int(11) NOT NULL auto_increment,
  `inicio` date NOT NULL,
  `termino` date NOT NULL,
  `preco` float(8,2) NOT NULL,
  `fk_cliente` int(11) DEFAULT NULL,
  `fk_livro` int(11) DEFAULT NULL,
  primary key(`idEmprestimo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `livro` (
  `idLivro` int(11) NOT NULL auto_increment,
  `nome` varchar(100) NOT NULL,
  `ano` int(11) NOT NULL,
  `preco` float(8,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `fk_genero` int(11) not null,
  primary key(`idLivro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `genero` (
  `idGenero` int(11) NOT NULL auto_increment,
  `nome` varchar(45) NOT NULL,
  primary key(`idGenero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `compra`
  ADD KEY `fk_cliente` (`fk_cliente`),
  ADD KEY `fk_livro` (`fk_livro`);

ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`fk_cliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`fk_livro`) REFERENCES `livro` (`idLivro`);

ALTER TABLE `emprestimo`
  ADD KEY `fk_cliente` (`fk_cliente`),
  ADD KEY `fk_livro` (`fk_livro`);

ALTER TABLE `livro`
  ADD CONSTRAINT `livro_ibfk_3` FOREIGN KEY (`fk_genero`) REFERENCES `genero` (`idGenero`);
    
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `emprestimo_ibfk_2` FOREIGN KEY (`fk_cliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `emprestimo_ibfk_3` FOREIGN KEY (`fk_livro`) REFERENCES `livro` (`idLivro`);

INSERT INTO genero(nome) VALUES ('programacao');
insert into genero(nome) values ('infantil');
insert into genero(nome) values ('outros');
