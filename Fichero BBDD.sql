-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema centimetroscubicos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema centimetroscubicos
-- -----------------------------------------------------
drop database if exists centimetroscubicos;
CREATE database IF NOT EXISTS `centimetroscubicos` DEFAULT CHARACTER SET latin1 ;
USE `centimetroscubicos` ;

-- -----------------------------------------------------
-- Table `centimetroscubicos`.`Equipos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `centimetroscubicos`.`Equipos` ;

CREATE TABLE IF NOT EXISTS `centimetroscubicos`.`Equipos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Puntos` INT NOT NULL default 0,
  nombre varchar(45) not null,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `centimetroscubicos`.`Patrocinadores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `centimetroscubicos`.`Patrocinadores` ;

CREATE TABLE IF NOT EXISTS `centimetroscubicos`.`Patrocinadores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Equipos_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Patrocinadores_Equipos1`
    FOREIGN KEY (`Equipos_id`)
    REFERENCES `centimetroscubicos`.`Equipos` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `centimetroscubicos`.`Pilotos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `centimetroscubicos`.`Pilotos` ;

CREATE TABLE IF NOT EXISTS `centimetroscubicos`.`Pilotos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Puntos` VARCHAR(45) NOT NULL default 0,
  `Dorsal` INT NOT NULL,
  `nacionalidad` VARCHAR(45) NOT NULL,
  `Equipos_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Pilotos_Equipos1`
    FOREIGN KEY (`Equipos_id`)
    REFERENCES `centimetroscubicos`.`Equipos` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `centimetroscubicos`.`Coches`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `centimetroscubicos`.`Coches` ;

CREATE TABLE IF NOT EXISTS `centimetroscubicos`.`Coches` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Modelo` VARCHAR(45) NOT NULL,
  `Motor` VARCHAR(45) NOT NULL,
  `Maniobrabilidad` VARCHAR(45) NOT NULL,
  `Pilotos_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Coches_Pilotos1`
    FOREIGN KEY (`Pilotos_id`)
    REFERENCES `centimetroscubicos`.`Pilotos` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `centimetroscubicos`.`Temporada`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `centimetroscubicos`.`Temporada` ;

CREATE TABLE IF NOT EXISTS `centimetroscubicos`.`Temporada` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Ganador` VARCHAR(45) NULL,
  `Pilotos_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Mundial/Temporada_Pilotos1`
    FOREIGN KEY (`Pilotos_id`)
    REFERENCES `centimetroscubicos`.`Pilotos` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `centimetroscubicos`.`Circuitos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `centimetroscubicos`.`Circuitos` ;

CREATE TABLE IF NOT EXISTS `centimetroscubicos`.`Circuitos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Longitud` VARCHAR(45) NOT NULL,
  `Numero de curvas` INT NOT NULL,
  `Temporada_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Circuitos_Temporada1`
    FOREIGN KEY (`Temporada_id`)
    REFERENCES `centimetroscubicos`.`Temporada` (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `centimetroscubicos`.`Pilotos_has_Circuitos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `centimetroscubicos`.`Pilotos_has_Circuitos` ;

CREATE TABLE IF NOT EXISTS `centimetroscubicos`.`Pilotos_has_Circuitos` (
  `Pilotos_id` INT NOT NULL,
  `Circuitos_id` INT NOT NULL,
  PRIMARY KEY (`Pilotos_id`, `Circuitos_id`),
  CONSTRAINT `fk_Pilotos_has_Circuitos_Pilotos1`
    FOREIGN KEY (`Pilotos_id`)
    REFERENCES `centimetroscubicos`.`Pilotos` (`id`),
  CONSTRAINT `fk_Pilotos_has_Circuitos_Circuitos1`
    FOREIGN KEY (`Circuitos_id`)
    REFERENCES `centimetroscubicos`.`Circuitos` (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



/*
	INSERCIONES EQUIPOS
*/
insert into equipos (nombre) values ('Mercedes');
insert into equipos (nombre) values ('Alpine');
insert into equipos (nombre) values ('Haas');
insert into equipos (nombre) values ('Mclaren');
insert into equipos (nombre) values ('Red Bull');
insert into equipos (nombre) values ('Aston Martin');
insert into equipos (nombre) values ('Alphatauri');
insert into equipos (nombre) values ('Ferrari');
insert into equipos (nombre) values ('Alfa Romeo');
insert into equipos (nombre) values ('Williams');

/*
	INSERCIONES PILOTOS
    
    FUENTE:
    https://formula1.lne.es/pilotos-f1/
*/

insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Lewis Hamilton', default, 44,'Reino Unido',1);
insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('George Russel', default, 63,'Reino Unido',1);

insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Esteban Ocon', default, 31,'Francia',2);
insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Pierre Gasly', default, 10,'Francia',2);

insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Niko Hulkenberg', default, 27,'Alemania',3);
insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Kevin Magnussen', default, 20,'Dinamarca',3);

insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Lando Norris', default, 4,'Reino Unido',4);
insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Oscar Piastri', default, 81,'Australia',4);

insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Max Verstappen', default, 1,'Holanda',5);
insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Sergio Pérez', default, 11,'México',5);

insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Fernando Alonso', default, 14,'España',6);
insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Lance Stroll', default, 18,'Canada',6);

insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Yuki Tsunoda', default, 22,'Japón',7);
insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Nyck De Vries', default, 21,'Paises Bajos',7);

insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Charles Leclerc', default, 16,'Mónaco',8);
insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Carlos Sainz', default, 55,'España',8);

insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Valtteri Bottas', default, 77,'Finlandia',9);
insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Guanyu Zhou', default, 24,'China',9);

insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Alexander Albon', default, 23,'Tailandia',10);
insert into pilotos (nombre,puntos,dorsal,nacionalidad,Equipos_id) values ('Logan Sargeant', default, 2,'Estados Unidos',10);

select * from pilotos inner join Equipos where pilotos.Equipos_id = equipos.id;

/*
	INSERCIONES CIRCUITOS:
*/