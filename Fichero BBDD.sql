
drop database if exists centimetroscubicos;
create database if not exists centimetroscubicos;
use centimetroscubicos;

create table if not exists Equipos (
  id int not null auto_increment,
  Puntos int not null default 0,
  nombre varchar(45) not null,
  primary key (id)
  );

create table if not exists Patrocinadores (
  id int not null auto_increment,
  Nombre varchar(45) not null,
  Equipos_id int not null,
  primary key (id),
  constraint foreign key (Equipos_id) references Equipos(id)
    );


create table if not exists Pilotos (
  id int not null auto_increment,
  Nombre varchar(45) not null,
  Puntos varchar(45) not null default 0,
  Dorsal int not null,
  nacionalidad varchar(45) not null,
  Equipos_id int not null,
  primary key (id),
  constraint foreign key (Equipos_id) references Equipos (id)
    );

create table if not exists Coches (
  id int not null auto_increment,
  nombre varchar(45) not null,
  Modelo varchar(45) not null,
  Motor varchar(45) not null,
  Pilotos_id int not null,
  Equipos_id int not null,
  primary key (id),
  constraint foreign key (Pilotos_id) references Pilotos (id),
  constraint foreign key (Equipos_id) references Equipos (id)
    );

create table if not exists Temporada (
  id int not null auto_increment,
  Ganador varchar(45),
  Pilotos_id int not null,
  primary key (id),
  constraint foreign key (Pilotos_id) references Pilotos (id)
  );

create table if not exists Circuitos (
  id int not null auto_increment,
  Nombre varchar(45) not null,
  Longitud varchar(45) not null,
  Numero_de_curvas int not null,
  Temporada_id int not null,
  primary key (id),
  constraint foreign key(Temporada_id) references Temporada (id)
    );

create table if not exists Pilotos_has_Circuitos (
  Pilotos_id int not null,
  Circuitos_id int not null,
  constraint foreign key (Pilotos_id) references Pilotos (id),
  constraint foreign key (Circuitos_id) references Circuitos (id)
    );

/*
	INSERCIONES EQUIPOS
*/
insert into equipos (nombre) values ('Mercedes');
insert into equipos (nombre) values ('Alpine');
insert into equipos (nombre) values ('Haas');
insert into equipos (nombre) values ('McLaren');
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


/*
	INSERCIONES TEMPORADAS
*/

insert into temporada (Ganador,pilotos_id) values ('No',1);
insert into temporada (Ganador,pilotos_id) values ('No',2);
insert into temporada (Ganador,pilotos_id) values ('No',3);
insert into temporada (Ganador,pilotos_id) values ('No',4);
insert into temporada (Ganador,pilotos_id) values ('No',5);
insert into temporada (Ganador,pilotos_id) values ('No',6);
insert into temporada (Ganador,pilotos_id) values ('No',7);
insert into temporada (Ganador,pilotos_id) values ('No',8);
insert into temporada (Ganador,pilotos_id) values ('No',9);
insert into temporada (Ganador,pilotos_id) values ('No',10);
insert into temporada (Ganador,pilotos_id) values ('No',11);
insert into temporada (Ganador,pilotos_id) values ('No',12);
insert into temporada (Ganador,pilotos_id) values ('No',13);
insert into temporada (Ganador,pilotos_id) values ('No',14);
insert into temporada (Ganador,pilotos_id) values ('No',15);
insert into temporada (Ganador,pilotos_id) values ('No',16);
insert into temporada (Ganador,pilotos_id) values ('No',17);
insert into temporada (Ganador,pilotos_id) values ('No',18);
insert into temporada (Ganador,pilotos_id) values ('No',19);
insert into temporada (Ganador,pilotos_id) values ('No',20);

/*
	INSERCIONES CIRCUITOS:
    
    FUENTE: https://www.caranddriver.com/es/formula-1/calendario/g41289401/formula-1-calendario-2023/
*/

insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Bahréin','5.412 km', 15, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Arabia Saudi','6.175 km', 27, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Australia','5.303 km', 16, 1);

insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Azerbaiyán','6.003 km', 20, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Miami','5.41 km', 19, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Emilia Romaña','4.908 km', 20, 1);

insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Mónaco','3.34 km', 19, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de España','4.655 km', 16, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Canadá','4.361 km', 12, 1);

insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Austria','4.326 km', 10, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Gran Bretaña','5.891 km', 18, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Hungría','4.381 km', 14, 1);

insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Bélgica','7.004 km', 19, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de los Países Bajos','4.259 km', 14, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Italia','5.793 km', 11, 1);

insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Singapur','5.073 km', 23, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Japón','5.807 km', 18, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Qatar','5.380 km', 16, 1);

insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de los Estados Unidos','5.513 km', 20, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de México','4.421 km', 16, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Sao Paulo','4.309 km', 15, 1);

insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Las Vegas','Por confirmar', 14, 1);
insert into circuitos (Nombre, Longitud, Numero_de_curvas,Temporada_id) values ('Gran Premio de Abu Dhabi','5.554 km', 21, 1);


/*
	INSERCIONES COCHES
    
    FUENTES:
    https://www.caranddriver.com/es/formula-1/a42431350/nuevos-formula-1-2023/
    https://www.dazn.com/es-ES/news/f%C3%B3rmula-1/que-motores-llevan-los-f1/1j67pbs71cs021gdygwcwxkahs
*/

insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Red Bull','RB19', 'Honda RBPT', 9,5);
insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Red Bull','RB19', 'Honda RBPT', 10,5);

insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Ferrari','SF-23', 'Ferrari', 15,8);
insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Ferrari','SF-23', 'Ferrari', 16,8);

insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Mercedes','W14', 'Mercedes', 1,1);
insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Mercedes','W14', 'Mercedes', 2,1);

insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Alpine','A523', 'Renault', 3,2);
insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Alpine','A523', 'Renault', 4,2);

insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('McLaren','MCL60', 'Mercedes', 7,4);
insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('McLaren','MCL60', 'Mercedes', 8,4);

insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Alfa Romeo','C43', 'Ferrari', 17,9);
insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Alfa Romeo','C43', 'Ferrari', 18,9);

insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Aston Martin','AMR23', 'Mercedes', 11,6);
insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Aston Martin','AMR23', 'Mercedes', 12,6);

insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Haas','VF-23', 'Ferrari', 5,3);
insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Haas','VF-23', 'Ferrari', 6,3);

insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('AlphaTauri','AT04', 'Honda RBPT', 13,7);
insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('AlphaTauri','AT04', 'Honda RBPT', 14,7);

insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Williams','FW45', 'Mercedes', 19,10);
insert into coches (nombre,Modelo,Motor,Pilotos_id,Equipos_id) values ('Williams','FW45', 'Mercedes', 20,10);

