#DROP DATABASE IF EXISTS prova
CREATE DATABASE prova
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

  USE `prova`;

CREATE TABLE `iscritti` (
 `id` int NOT NULL AUTO_INCREMENT,
 `nominativo` varchar(50) NOT NULL,
 `datanascita` char(10) NOT NULL,
 `luogonascita` varchar(50) NOT NULL,
 `via` varchar(50),
 `cap` char(5),
 `citta` varchar(50),
 `email` varchar(50) NOT NULL,
 `telefono` varchar(50),
 `documento` tinyint(1) DEFAULT 0,
 `scadenza_visita` char(10),
 `varie` text,
 `contributo` int,
 `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `codicefiscale` char(16) NOT NULL,
 `barcode` char(6) DEFAULT NULL,
 `acconto` int,
 `dataacconto` char(10),
 `cauzione` int,
 `datacauzione` char(10),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `eventi` (
 #`id` int NOT NULL AUTO_INCREMENT,
 `nomeevento` varchar(50) NOT NULL,
 `dataevento` char(10) NOT NULL,
 `luogoevento` varchar(50),
 `costoevento` int,
 `altro` text,
 PRIMARY KEY (`nomeevento`)
) ENGINE=InnoDB;

CREATE TABLE `concorrenti` (
 `id` int NOT NULL AUTO_INCREMENT,
 `idconcorrente` int NOT NULL,
 `nomeevento` char(50) NOT NULL,
 `squadra` varchar(20),
 `moto` varchar(50),
 `motorclub` varchar(50),
 `categoria` varchar(50),
 `numero` int(11) NOT NULL,
 `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `nominativo1` varchar(50),
 `nominativo2` varchar(50),
 `varie` text,
 FOREIGN KEY(idconcorrente) REFERENCES iscritti(id) ON DELETE CASCADE,
 FOREIGN KEY(nomeevento) REFERENCES eventi(nomeevento) ON DELETE CASCADE,
 primary KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `varie` (
 `altro1` varchar(100),
 `altro2` varchar(100),
 `cauzione` tinyint(1) DEFAULT 0,
 `certificato` tinyint(1) DEFAULT 0,
 `acconto` tinyint(1) DEFAULT 0,
 `codicefiscale` tinyint(1) DEFAULT 0,
 `assicurazione` tinyint(1) DEFAULT 0
) ENGINE=InnoDB;

CREATE TABLE `tessere` (
	`id` int NOT NULL AUTO_INCREMENT,
	primary KEY (`id`),
	`tessera` varchar(10) not null,
	`dataemissione` char(10) not null,
	`datascadenza` char(10),
	`tipo` char(10),
	`proprietario` int NOT NULL,
	FOREIGN KEY(proprietario) REFERENCES iscritti(id) ON DELETE CASCADE,
	`assicurazione` char(10) DEFAULT 'Base'
) ENGINE=InnoDB;