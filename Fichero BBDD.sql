
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
  Ganador int,
  primary key (id),
  constraint foreign key (Ganador) references Pilotos (id)
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
    
create table if not exists Temporada_has_circuitos (
	Temporada_id int not null,
    Circuito_id int not null,
    constraint foreign key (Temporada_id) references Temporada (id),
    constraint foreign key (Circuito_id) references Circuitos (id)
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

insert into temporada (Ganador) values (null);

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
	INSERCIONES TEMPORADAS_HAS_CIRCUITOS
*/

select * from temporada_has_circuitos inner join circuitos where temporada_has_circuitos.circuito_id = circuitos.id;

insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 1);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 2);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 3);

insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 4);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 5);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 6);

insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 7);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 8);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 9);

insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 10);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 11);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 12);

insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 13);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 14);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 15);

insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 16);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 17);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 18);

insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 19);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 20);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 21);

insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 22);
insert into temporada_has_circuitos (temporada_id, circuito_id) values (1 , 23);

/*
	INSERCIONES PILOTOS_HAS_CIRCUITOS
*/

select * from pilotos_has_circuitos;

insert into pilotos_has_circuitos values (1, 1);
insert into pilotos_has_circuitos values (1, 2);
insert into pilotos_has_circuitos values (1, 3);
insert into pilotos_has_circuitos values (1, 4);
insert into pilotos_has_circuitos values (1, 5);
insert into pilotos_has_circuitos values (1, 6);
insert into pilotos_has_circuitos values (1, 7);
insert into pilotos_has_circuitos values (1, 8);
insert into pilotos_has_circuitos values (1, 9);
insert into pilotos_has_circuitos values (1, 10);
insert into pilotos_has_circuitos values (1, 11);
insert into pilotos_has_circuitos values (1, 12);
insert into pilotos_has_circuitos values (1, 13);
insert into pilotos_has_circuitos values (1, 14);
insert into pilotos_has_circuitos values (1, 15);
insert into pilotos_has_circuitos values (1, 16);
insert into pilotos_has_circuitos values (1, 17);
insert into pilotos_has_circuitos values (1, 18);
insert into pilotos_has_circuitos values (1, 19);
insert into pilotos_has_circuitos values (1, 20);
insert into pilotos_has_circuitos values (1, 21);
insert into pilotos_has_circuitos values (1, 22);
insert into pilotos_has_circuitos values (1, 23);

insert into pilotos_has_circuitos values (2, 1);
insert into pilotos_has_circuitos values (2, 2);
insert into pilotos_has_circuitos values (2, 3);
insert into pilotos_has_circuitos values (2, 4);
insert into pilotos_has_circuitos values (2, 5);
insert into pilotos_has_circuitos values (2, 6);
insert into pilotos_has_circuitos values (2, 7);
insert into pilotos_has_circuitos values (2, 8);
insert into pilotos_has_circuitos values (2, 9);
insert into pilotos_has_circuitos values (2, 10);
insert into pilotos_has_circuitos values (2, 11);
insert into pilotos_has_circuitos values (2, 12);
insert into pilotos_has_circuitos values (2, 13);
insert into pilotos_has_circuitos values (2, 14);
insert into pilotos_has_circuitos values (2, 15);
insert into pilotos_has_circuitos values (2, 16);
insert into pilotos_has_circuitos values (2, 17);
insert into pilotos_has_circuitos values (2, 18);
insert into pilotos_has_circuitos values (2, 19);
insert into pilotos_has_circuitos values (2, 20);
insert into pilotos_has_circuitos values (2, 21);
insert into pilotos_has_circuitos values (2, 22);
insert into pilotos_has_circuitos values (2, 23);

insert into pilotos_has_circuitos values (3, 1);
insert into pilotos_has_circuitos values (3, 2);
insert into pilotos_has_circuitos values (3, 3);
insert into pilotos_has_circuitos values (3, 4);
insert into pilotos_has_circuitos values (3, 5);
insert into pilotos_has_circuitos values (3, 6);
insert into pilotos_has_circuitos values (3, 7);
insert into pilotos_has_circuitos values (3, 8);
insert into pilotos_has_circuitos values (3, 9);
insert into pilotos_has_circuitos values (3, 10);
insert into pilotos_has_circuitos values (3, 11);
insert into pilotos_has_circuitos values (3, 12);
insert into pilotos_has_circuitos values (3, 13);
insert into pilotos_has_circuitos values (3, 14);
insert into pilotos_has_circuitos values (3, 15);
insert into pilotos_has_circuitos values (3, 16);
insert into pilotos_has_circuitos values (3, 17);
insert into pilotos_has_circuitos values (3, 18);
insert into pilotos_has_circuitos values (3, 19);
insert into pilotos_has_circuitos values (3, 20);
insert into pilotos_has_circuitos values (3, 21);
insert into pilotos_has_circuitos values (3, 22);
insert into pilotos_has_circuitos values (3, 23);

insert into pilotos_has_circuitos values (4, 1);
insert into pilotos_has_circuitos values (4, 2);
insert into pilotos_has_circuitos values (4, 3);
insert into pilotos_has_circuitos values (4, 4);
insert into pilotos_has_circuitos values (4, 5);
insert into pilotos_has_circuitos values (4, 6);
insert into pilotos_has_circuitos values (4, 7);
insert into pilotos_has_circuitos values (4, 8);
insert into pilotos_has_circuitos values (4, 9);
insert into pilotos_has_circuitos values (4, 10);
insert into pilotos_has_circuitos values (4, 11);
insert into pilotos_has_circuitos values (4, 12);
insert into pilotos_has_circuitos values (4, 13);
insert into pilotos_has_circuitos values (4, 14);
insert into pilotos_has_circuitos values (4, 15);
insert into pilotos_has_circuitos values (4, 16);
insert into pilotos_has_circuitos values (4, 17);
insert into pilotos_has_circuitos values (4, 18);
insert into pilotos_has_circuitos values (4, 19);
insert into pilotos_has_circuitos values (4, 20);
insert into pilotos_has_circuitos values (4, 21);
insert into pilotos_has_circuitos values (4, 22);
insert into pilotos_has_circuitos values (4, 23);

insert into pilotos_has_circuitos values (5, 1);
insert into pilotos_has_circuitos values (5, 2);
insert into pilotos_has_circuitos values (5, 3);
insert into pilotos_has_circuitos values (5, 4);
insert into pilotos_has_circuitos values (5, 5);
insert into pilotos_has_circuitos values (5, 6);
insert into pilotos_has_circuitos values (5, 7);
insert into pilotos_has_circuitos values (5, 8);
insert into pilotos_has_circuitos values (5, 9);
insert into pilotos_has_circuitos values (5, 10);
insert into pilotos_has_circuitos values (5, 11);
insert into pilotos_has_circuitos values (5, 12);
insert into pilotos_has_circuitos values (5, 13);
insert into pilotos_has_circuitos values (5, 14);
insert into pilotos_has_circuitos values (5, 15);
insert into pilotos_has_circuitos values (5, 16);
insert into pilotos_has_circuitos values (5, 17);
insert into pilotos_has_circuitos values (5, 18);
insert into pilotos_has_circuitos values (5, 19);
insert into pilotos_has_circuitos values (5, 20);
insert into pilotos_has_circuitos values (5, 21);
insert into pilotos_has_circuitos values (5, 22);
insert into pilotos_has_circuitos values (5, 23);

insert into pilotos_has_circuitos values (6, 1);
insert into pilotos_has_circuitos values (6, 2);
insert into pilotos_has_circuitos values (6, 3);
insert into pilotos_has_circuitos values (6, 4);
insert into pilotos_has_circuitos values (6, 5);
insert into pilotos_has_circuitos values (6, 6);
insert into pilotos_has_circuitos values (6, 7);
insert into pilotos_has_circuitos values (6, 8);
insert into pilotos_has_circuitos values (6, 9);
insert into pilotos_has_circuitos values (6, 10);
insert into pilotos_has_circuitos values (6, 11);
insert into pilotos_has_circuitos values (6, 12);
insert into pilotos_has_circuitos values (6, 13);
insert into pilotos_has_circuitos values (6, 14);
insert into pilotos_has_circuitos values (6, 15);
insert into pilotos_has_circuitos values (6, 16);
insert into pilotos_has_circuitos values (6, 17);
insert into pilotos_has_circuitos values (6, 18);
insert into pilotos_has_circuitos values (6, 19);
insert into pilotos_has_circuitos values (6, 20);
insert into pilotos_has_circuitos values (6, 21);
insert into pilotos_has_circuitos values (6, 22);
insert into pilotos_has_circuitos values (6, 23);

insert into pilotos_has_circuitos values (7, 1);
insert into pilotos_has_circuitos values (7, 2);
insert into pilotos_has_circuitos values (7, 3);
insert into pilotos_has_circuitos values (7, 4);
insert into pilotos_has_circuitos values (7, 5);
insert into pilotos_has_circuitos values (7, 6);
insert into pilotos_has_circuitos values (7, 7);
insert into pilotos_has_circuitos values (7, 8);
insert into pilotos_has_circuitos values (7, 9);
insert into pilotos_has_circuitos values (7, 10);
insert into pilotos_has_circuitos values (7, 11);
insert into pilotos_has_circuitos values (7, 12);
insert into pilotos_has_circuitos values (7, 13);
insert into pilotos_has_circuitos values (7, 14);
insert into pilotos_has_circuitos values (7, 15);
insert into pilotos_has_circuitos values (7, 16);
insert into pilotos_has_circuitos values (7, 17);
insert into pilotos_has_circuitos values (7, 18);
insert into pilotos_has_circuitos values (7, 19);
insert into pilotos_has_circuitos values (7, 20);
insert into pilotos_has_circuitos values (7, 21);
insert into pilotos_has_circuitos values (7, 22);
insert into pilotos_has_circuitos values (7, 23);

insert into pilotos_has_circuitos values (8, 1);
insert into pilotos_has_circuitos values (8, 2);
insert into pilotos_has_circuitos values (8, 3);
insert into pilotos_has_circuitos values (8, 4);
insert into pilotos_has_circuitos values (8, 5);
insert into pilotos_has_circuitos values (8, 6);
insert into pilotos_has_circuitos values (8, 7);
insert into pilotos_has_circuitos values (8, 8);
insert into pilotos_has_circuitos values (8, 9);
insert into pilotos_has_circuitos values (8, 10);
insert into pilotos_has_circuitos values (8, 11);
insert into pilotos_has_circuitos values (8, 12);
insert into pilotos_has_circuitos values (8, 13);
insert into pilotos_has_circuitos values (8, 14);
insert into pilotos_has_circuitos values (8, 15);
insert into pilotos_has_circuitos values (8, 16);
insert into pilotos_has_circuitos values (8, 17);
insert into pilotos_has_circuitos values (8, 18);
insert into pilotos_has_circuitos values (8, 19);
insert into pilotos_has_circuitos values (8, 20);
insert into pilotos_has_circuitos values (8, 21);
insert into pilotos_has_circuitos values (8, 22);
insert into pilotos_has_circuitos values (8, 23);

insert into pilotos_has_circuitos values (9, 1);
insert into pilotos_has_circuitos values (9, 2);
insert into pilotos_has_circuitos values (9, 3);
insert into pilotos_has_circuitos values (9, 4);
insert into pilotos_has_circuitos values (9, 5);
insert into pilotos_has_circuitos values (9, 6);
insert into pilotos_has_circuitos values (9, 7);
insert into pilotos_has_circuitos values (9, 8);
insert into pilotos_has_circuitos values (9, 9);
insert into pilotos_has_circuitos values (9, 10);
insert into pilotos_has_circuitos values (9, 11);
insert into pilotos_has_circuitos values (9, 12);
insert into pilotos_has_circuitos values (9, 13);
insert into pilotos_has_circuitos values (9, 14);
insert into pilotos_has_circuitos values (9, 15);
insert into pilotos_has_circuitos values (9, 16);
insert into pilotos_has_circuitos values (9, 17);
insert into pilotos_has_circuitos values (9, 18);
insert into pilotos_has_circuitos values (9, 19);
insert into pilotos_has_circuitos values (9, 20);
insert into pilotos_has_circuitos values (9, 21);
insert into pilotos_has_circuitos values (9, 22);
insert into pilotos_has_circuitos values (9, 23);

insert into pilotos_has_circuitos values (10, 1);
insert into pilotos_has_circuitos values (10, 2);
insert into pilotos_has_circuitos values (10, 3);
insert into pilotos_has_circuitos values (10, 4);
insert into pilotos_has_circuitos values (10, 5);
insert into pilotos_has_circuitos values (10, 6);
insert into pilotos_has_circuitos values (10, 7);
insert into pilotos_has_circuitos values (10, 8);
insert into pilotos_has_circuitos values (10, 9);
insert into pilotos_has_circuitos values (10, 10);
insert into pilotos_has_circuitos values (10, 11);
insert into pilotos_has_circuitos values (10, 12);
insert into pilotos_has_circuitos values (10, 13);
insert into pilotos_has_circuitos values (10, 14);
insert into pilotos_has_circuitos values (10, 15);
insert into pilotos_has_circuitos values (10, 16);
insert into pilotos_has_circuitos values (10, 17);
insert into pilotos_has_circuitos values (10, 18);
insert into pilotos_has_circuitos values (10, 19);
insert into pilotos_has_circuitos values (10, 20);
insert into pilotos_has_circuitos values (10, 21);
insert into pilotos_has_circuitos values (10, 22);
insert into pilotos_has_circuitos values (10, 23);

insert into pilotos_has_circuitos values (11, 1);
insert into pilotos_has_circuitos values (11, 2);
insert into pilotos_has_circuitos values (11, 3);
insert into pilotos_has_circuitos values (11, 4);
insert into pilotos_has_circuitos values (11, 5);
insert into pilotos_has_circuitos values (11, 6);
insert into pilotos_has_circuitos values (11, 7);
insert into pilotos_has_circuitos values (11, 8);
insert into pilotos_has_circuitos values (11, 9);
insert into pilotos_has_circuitos values (11, 10);
insert into pilotos_has_circuitos values (11, 11);
insert into pilotos_has_circuitos values (11, 12);
insert into pilotos_has_circuitos values (11, 13);
insert into pilotos_has_circuitos values (11, 14);
insert into pilotos_has_circuitos values (11, 15);
insert into pilotos_has_circuitos values (11, 16);
insert into pilotos_has_circuitos values (11, 17);
insert into pilotos_has_circuitos values (11, 18);
insert into pilotos_has_circuitos values (11, 19);
insert into pilotos_has_circuitos values (11, 20);
insert into pilotos_has_circuitos values (11, 21);
insert into pilotos_has_circuitos values (11, 22);
insert into pilotos_has_circuitos values (11, 23);

insert into pilotos_has_circuitos values (12, 1);
insert into pilotos_has_circuitos values (12, 2);
insert into pilotos_has_circuitos values (12, 3);
insert into pilotos_has_circuitos values (12, 4);
insert into pilotos_has_circuitos values (12, 5);
insert into pilotos_has_circuitos values (12, 6);
insert into pilotos_has_circuitos values (12, 7);
insert into pilotos_has_circuitos values (12, 8);
insert into pilotos_has_circuitos values (12, 9);
insert into pilotos_has_circuitos values (12, 10);
insert into pilotos_has_circuitos values (12, 11);
insert into pilotos_has_circuitos values (12, 12);
insert into pilotos_has_circuitos values (12, 13);
insert into pilotos_has_circuitos values (12, 14);
insert into pilotos_has_circuitos values (12, 15);
insert into pilotos_has_circuitos values (12, 16);
insert into pilotos_has_circuitos values (12, 17);
insert into pilotos_has_circuitos values (12, 18);
insert into pilotos_has_circuitos values (12, 19);
insert into pilotos_has_circuitos values (12, 20);
insert into pilotos_has_circuitos values (12, 21);
insert into pilotos_has_circuitos values (12, 22);
insert into pilotos_has_circuitos values (12, 23);

insert into pilotos_has_circuitos values (13, 1);
insert into pilotos_has_circuitos values (13, 2);
insert into pilotos_has_circuitos values (13, 3);
insert into pilotos_has_circuitos values (13, 4);
insert into pilotos_has_circuitos values (13, 5);
insert into pilotos_has_circuitos values (13, 6);
insert into pilotos_has_circuitos values (13, 7);
insert into pilotos_has_circuitos values (13, 8);
insert into pilotos_has_circuitos values (13, 9);
insert into pilotos_has_circuitos values (13, 10);
insert into pilotos_has_circuitos values (13, 11);
insert into pilotos_has_circuitos values (13, 12);
insert into pilotos_has_circuitos values (13, 13);
insert into pilotos_has_circuitos values (13, 14);
insert into pilotos_has_circuitos values (13, 15);
insert into pilotos_has_circuitos values (13, 16);
insert into pilotos_has_circuitos values (13, 17);
insert into pilotos_has_circuitos values (13, 18);
insert into pilotos_has_circuitos values (13, 19);
insert into pilotos_has_circuitos values (13, 20);
insert into pilotos_has_circuitos values (13, 21);
insert into pilotos_has_circuitos values (13, 22);
insert into pilotos_has_circuitos values (13, 23);

insert into pilotos_has_circuitos values (14, 1);
insert into pilotos_has_circuitos values (14, 2);
insert into pilotos_has_circuitos values (14, 3);
insert into pilotos_has_circuitos values (14, 4);
insert into pilotos_has_circuitos values (14, 5);
insert into pilotos_has_circuitos values (14, 6);
insert into pilotos_has_circuitos values (14, 7);
insert into pilotos_has_circuitos values (14, 8);
insert into pilotos_has_circuitos values (14, 9);
insert into pilotos_has_circuitos values (14, 10);
insert into pilotos_has_circuitos values (14, 11);
insert into pilotos_has_circuitos values (14, 12);
insert into pilotos_has_circuitos values (14, 13);
insert into pilotos_has_circuitos values (14, 14);
insert into pilotos_has_circuitos values (14, 15);
insert into pilotos_has_circuitos values (14, 16);
insert into pilotos_has_circuitos values (14, 17);
insert into pilotos_has_circuitos values (14, 18);
insert into pilotos_has_circuitos values (14, 19);
insert into pilotos_has_circuitos values (14, 20);
insert into pilotos_has_circuitos values (14, 21);
insert into pilotos_has_circuitos values (14, 22);
insert into pilotos_has_circuitos values (14, 23);

insert into pilotos_has_circuitos values (15, 1);
insert into pilotos_has_circuitos values (15, 2);
insert into pilotos_has_circuitos values (15, 3);
insert into pilotos_has_circuitos values (15, 4);
insert into pilotos_has_circuitos values (15, 5);
insert into pilotos_has_circuitos values (15, 6);
insert into pilotos_has_circuitos values (15, 7);
insert into pilotos_has_circuitos values (15, 8);
insert into pilotos_has_circuitos values (15, 9);
insert into pilotos_has_circuitos values (15, 10);
insert into pilotos_has_circuitos values (15, 11);
insert into pilotos_has_circuitos values (15, 12);
insert into pilotos_has_circuitos values (15, 13);
insert into pilotos_has_circuitos values (15, 14);
insert into pilotos_has_circuitos values (15, 15);
insert into pilotos_has_circuitos values (15, 16);
insert into pilotos_has_circuitos values (15, 17);
insert into pilotos_has_circuitos values (15, 18);
insert into pilotos_has_circuitos values (15, 19);
insert into pilotos_has_circuitos values (15, 20);
insert into pilotos_has_circuitos values (15, 21);
insert into pilotos_has_circuitos values (15, 22);
insert into pilotos_has_circuitos values (15, 23);

insert into pilotos_has_circuitos values (16, 1);
insert into pilotos_has_circuitos values (16, 2);
insert into pilotos_has_circuitos values (16, 3);
insert into pilotos_has_circuitos values (16, 4);
insert into pilotos_has_circuitos values (16, 5);
insert into pilotos_has_circuitos values (16, 6);
insert into pilotos_has_circuitos values (16, 7);
insert into pilotos_has_circuitos values (16, 8);
insert into pilotos_has_circuitos values (16, 9);
insert into pilotos_has_circuitos values (16, 10);
insert into pilotos_has_circuitos values (16, 11);
insert into pilotos_has_circuitos values (16, 12);
insert into pilotos_has_circuitos values (16, 13);
insert into pilotos_has_circuitos values (16, 14);
insert into pilotos_has_circuitos values (16, 15);
insert into pilotos_has_circuitos values (16, 16);
insert into pilotos_has_circuitos values (16, 17);
insert into pilotos_has_circuitos values (16, 18);
insert into pilotos_has_circuitos values (16, 19);
insert into pilotos_has_circuitos values (16, 20);
insert into pilotos_has_circuitos values (16, 21);
insert into pilotos_has_circuitos values (16, 22);
insert into pilotos_has_circuitos values (16, 23);

insert into pilotos_has_circuitos values (17, 1);
insert into pilotos_has_circuitos values (17, 2);
insert into pilotos_has_circuitos values (17, 3);
insert into pilotos_has_circuitos values (17, 4);
insert into pilotos_has_circuitos values (17, 5);
insert into pilotos_has_circuitos values (17, 6);
insert into pilotos_has_circuitos values (17, 7);
insert into pilotos_has_circuitos values (17, 8);
insert into pilotos_has_circuitos values (17, 9);
insert into pilotos_has_circuitos values (17, 10);
insert into pilotos_has_circuitos values (17, 11);
insert into pilotos_has_circuitos values (17, 12);
insert into pilotos_has_circuitos values (17, 13);
insert into pilotos_has_circuitos values (17, 14);
insert into pilotos_has_circuitos values (17, 15);
insert into pilotos_has_circuitos values (17, 16);
insert into pilotos_has_circuitos values (17, 17);
insert into pilotos_has_circuitos values (17, 18);
insert into pilotos_has_circuitos values (17, 19);
insert into pilotos_has_circuitos values (17, 20);
insert into pilotos_has_circuitos values (17, 21);
insert into pilotos_has_circuitos values (17, 22);
insert into pilotos_has_circuitos values (17, 23);

insert into pilotos_has_circuitos values (18, 1);
insert into pilotos_has_circuitos values (18, 2);
insert into pilotos_has_circuitos values (18, 3);
insert into pilotos_has_circuitos values (18, 4);
insert into pilotos_has_circuitos values (18, 5);
insert into pilotos_has_circuitos values (18, 6);
insert into pilotos_has_circuitos values (18, 7);
insert into pilotos_has_circuitos values (18, 8);
insert into pilotos_has_circuitos values (18, 9);
insert into pilotos_has_circuitos values (18, 10);
insert into pilotos_has_circuitos values (18, 11);
insert into pilotos_has_circuitos values (18, 12);
insert into pilotos_has_circuitos values (18, 13);
insert into pilotos_has_circuitos values (18, 14);
insert into pilotos_has_circuitos values (18, 15);
insert into pilotos_has_circuitos values (18, 16);
insert into pilotos_has_circuitos values (18, 17);
insert into pilotos_has_circuitos values (18, 18);
insert into pilotos_has_circuitos values (18, 19);
insert into pilotos_has_circuitos values (18, 20);
insert into pilotos_has_circuitos values (18, 21);
insert into pilotos_has_circuitos values (18, 22);
insert into pilotos_has_circuitos values (18, 23);

insert into pilotos_has_circuitos values (19, 1);
insert into pilotos_has_circuitos values (19, 2);
insert into pilotos_has_circuitos values (19, 3);
insert into pilotos_has_circuitos values (19, 4);
insert into pilotos_has_circuitos values (19, 5);
insert into pilotos_has_circuitos values (19, 6);
insert into pilotos_has_circuitos values (19, 7);
insert into pilotos_has_circuitos values (19, 8);
insert into pilotos_has_circuitos values (19, 9);
insert into pilotos_has_circuitos values (19, 10);
insert into pilotos_has_circuitos values (19, 11);
insert into pilotos_has_circuitos values (19, 12);
insert into pilotos_has_circuitos values (19, 13);
insert into pilotos_has_circuitos values (19, 14);
insert into pilotos_has_circuitos values (19, 15);
insert into pilotos_has_circuitos values (19, 16);
insert into pilotos_has_circuitos values (19, 17);
insert into pilotos_has_circuitos values (19, 18);
insert into pilotos_has_circuitos values (19, 19);
insert into pilotos_has_circuitos values (19, 20);
insert into pilotos_has_circuitos values (19, 21);
insert into pilotos_has_circuitos values (19, 22);
insert into pilotos_has_circuitos values (19, 23);

insert into pilotos_has_circuitos values (20, 1);
insert into pilotos_has_circuitos values (20, 2);
insert into pilotos_has_circuitos values (20, 3);
insert into pilotos_has_circuitos values (20, 4);
insert into pilotos_has_circuitos values (20, 5);
insert into pilotos_has_circuitos values (20, 6);
insert into pilotos_has_circuitos values (20, 7);
insert into pilotos_has_circuitos values (20, 8);
insert into pilotos_has_circuitos values (20, 9);
insert into pilotos_has_circuitos values (20, 10);
insert into pilotos_has_circuitos values (20, 11);
insert into pilotos_has_circuitos values (20, 12);
insert into pilotos_has_circuitos values (20, 13);
insert into pilotos_has_circuitos values (20, 14);
insert into pilotos_has_circuitos values (20, 15);
insert into pilotos_has_circuitos values (20, 16);
insert into pilotos_has_circuitos values (20, 17);
insert into pilotos_has_circuitos values (20, 18);
insert into pilotos_has_circuitos values (20, 19);
insert into pilotos_has_circuitos values (20, 20);
insert into pilotos_has_circuitos values (20, 21);
insert into pilotos_has_circuitos values (20, 22);
insert into pilotos_has_circuitos values (20, 23);

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

/*
	INSERCIONES PATROCINADORES
	FUENTES:
    https://es.motorsport.com/f1/news/quienes-son-patrocinadores-publicidad-equipos-formula1/9250036/
*/

select * from equipos;

/* Mercedes */
insert into patrocinadores (Nombre, Equipos_id) values ('Petronas', 1);
insert into patrocinadores (Nombre, Equipos_id) values ('INEOS', 1);
insert into patrocinadores (Nombre, Equipos_id) values ('UBS', 1);
insert into patrocinadores (Nombre, Equipos_id) values ('TeamViewer', 1);
insert into patrocinadores (Nombre, Equipos_id) values ('IWC', 1);

/* Alpine */
insert into patrocinadores (Nombre, Equipos_id) values ('BWT', 2);
insert into patrocinadores (Nombre, Equipos_id) values ('Castrol', 2);
insert into patrocinadores (Nombre, Equipos_id) values ('Mapfre', 2);
insert into patrocinadores (Nombre, Equipos_id) values ('Kappa', 2);
insert into patrocinadores (Nombre, Equipos_id) values ('Alpinestars', 2);

/* Haas */
insert into patrocinadores (Nombre, Equipos_id) values ('Rich Energy', 3);
insert into patrocinadores (Nombre, Equipos_id) values ('1&1', 3);
insert into patrocinadores (Nombre, Equipos_id) values ('Uralkali', 3);

/* McLaren */
insert into patrocinadores (Nombre, Equipos_id) values ('A Better Tomorrow', 4);
insert into patrocinadores (Nombre, Equipos_id) values ('Vype', 4);
insert into patrocinadores (Nombre, Equipos_id) values ('Velo', 4);
insert into patrocinadores (Nombre, Equipos_id) values ('Vuse', 4);
insert into patrocinadores (Nombre, Equipos_id) values ('Android', 4);
insert into patrocinadores (Nombre, Equipos_id) values ('Chrome', 4);

/* Red Bull */
insert into patrocinadores (Nombre, Equipos_id) values ('Oracle', 5);
insert into patrocinadores (Nombre, Equipos_id) values ('TAG Heuer', 5);
insert into patrocinadores (Nombre, Equipos_id) values ('Tezos', 5);
insert into patrocinadores (Nombre, Equipos_id) values ('Bybit', 5);

/* Aston Martin */
insert into patrocinadores (Nombre, Equipos_id) values ('Aramco', 6);
insert into patrocinadores (Nombre, Equipos_id) values ('Cognizant', 6);
insert into patrocinadores (Nombre, Equipos_id) values ('JCB', 6);
insert into patrocinadores (Nombre, Equipos_id) values ('TikTok', 6);

/* AlphaTauri */
insert into patrocinadores (Nombre, Equipos_id) values ('Fantom', 7);
insert into patrocinadores (Nombre, Equipos_id) values ('Randstad', 7);
insert into patrocinadores (Nombre, Equipos_id) values ('DAZN', 7);
insert into patrocinadores (Nombre, Equipos_id) values ('Honda', 7);
insert into patrocinadores (Nombre, Equipos_id) values ('Siemens', 7);

/* Ferrari */
insert into patrocinadores (Nombre, Equipos_id) values ('Banco Santander', 8);
insert into patrocinadores (Nombre, Equipos_id) values ('Shell', 8);
insert into patrocinadores (Nombre, Equipos_id) values ('Puma', 8);
insert into patrocinadores (Nombre, Equipos_id) values ('Velas', 8);
insert into patrocinadores (Nombre, Equipos_id) values ('Estrella Galicia', 8);

/* Alfa Romeo */
insert into patrocinadores (Nombre, Equipos_id) values ('PNK ORLEN', 9);
insert into patrocinadores (Nombre, Equipos_id) values ('Ferrari Trento', 9);
insert into patrocinadores (Nombre, Equipos_id) values ('AMX', 9);
insert into patrocinadores (Nombre, Equipos_id) values ('CODE-ZERO', 9);

/* Williams */
insert into patrocinadores (Nombre, Equipos_id) values ('Duracell', 10);
insert into patrocinadores (Nombre, Equipos_id) values ('Sofina', 10);
insert into patrocinadores (Nombre, Equipos_id) values ('Dorilton Ventures', 10);
insert into patrocinadores (Nombre, Equipos_id) values ('Umbro', 10);