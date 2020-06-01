CREATE DATABASE movilmad;

USE movilmad;

DROP TABLE IF EXISTS rclientes;

create table rclientes (idcliente integer(5) not null, nombre varchar(50) not null, apellido varchar(50) not null,
 email varchar(50), fecha_alta date not null);

alter table rclientes add constraint pk_rclientes primary key (idcliente);

insert into rclientes (idcliente , nombre , apellido , email , fecha_alta ) values
(1,'MARY','SMITH','marysmith@movilmad.net','2018-01-01'),
(2,'LINDA','WILLIAMS','linda.williams@movilmad.net','2018-02-01'),
(3,'SUSAN','WILSON','susan.wilson@movilmad.net','2018-03-01'),
(4,'MARGARET','MOORE','margaret.moore@movilmad.net','2018-12-31'),
(5,'DOROTHY','TAYLOR','dorothy.taylor@movilmad.net','2019-01-01');


DROP TABLE IF EXISTS rvehiculos;

create table rvehiculos (matricula varchar(7), marca varchar(40), modelo varchar(40), kms integer(8), fecha_matriculacion date,
preciobase integer(5), disponible boolean);

alter table rvehiculos add constraint pk_rvehiculos primary key (matricula);

insert into rvehiculos (matricula , marca , modelo , kms , fecha_matriculacion, preciobase , disponible ) values
('4589HMK','VOLVO','A30',12400,'2018-01-25',30, 1),
('4001MKT','VOLVO','A40',125400,'2018-01-25',50, 1),
('3333JTM','VOLVO','A30',2400,'2018-11-12',40, 1),
('4545BGT','FIAT','TIPO',3500,'2018-07-15',20, 0),
('1283KTS','FIAT','TIPO',25000,'2019-01-30',20, 1),
('1647DES','RENAULT','CLIO',189754,'2018-09-02',30, 1),
('1477KLT','RENAULT','MEGANE',32564,'2018-01-25',30, 1),
('7777KLT','RENAULT','SCENIC',30000,'2018-01-01',30, 1),
('1234ABC','SEAT','CORDOBA',10000,'2018-01-01',20, 1);


DROP TABLE IF EXISTS ralquilar;
create table ralquilar (idcliente smallint(5), matricula varchar(7), num_dias smallint(5), fecha_alquiler date, fecha_devolucion date, preciototal integer(8));

alter table ralquilar add constraint pk_ralquilar primary key (idcliente,matricula, fecha_alquiler);

insert into ralquilar  (idcliente , matricula , num_dias, fecha_alquiler , fecha_devolucion, preciototal) values
(1,'1477KLT',10,'2019-01-01','2019-01-10',10*30),
(5,'1477KLT',3,'2019-02-01','2019-02-03',3*30),
(5,'4001MKT',1,'2019-03-03','2019-03-03',1*50),
(3,'4545BGT',7,'2020-03-02','2020-03-09',7*20);

commit;CREATE DATABASE MOVILMAD;
USE MOVILMAD;

CREATE TABLE RCLIENTE
(IDCLIENTE VARCHAR(9),
 NOMBRE VARCHAR(40),
 APELLIDO VARCHAR(40),
 EMAIL VARCHAR(40),
 FECHA_ALTA DATE);
 
ALTER TABLE RCLIENTE ADD CONSTRAINT PK_RCLIENTE PRIMARY KEY (IDCLIENTE); 

CREATE TABLE RVEHICULOS
(MATRICULA VARCHAR(8),
 MARCA VARCHAR(40),
 MODELO VARCHAR(40),
 KMS INTEGER,
 FECHA_MATRICULACION DATE,
 PRECIOBASE DOUBLE,
 DISPONIBLE BOOLEAN);
 
ALTER TABLE RVEHICULOS ADD CONSTRAINT PK_RVEHICULOS PRIMARY KEY (MATRICULA); 


CREATE TABLE RALQUILAR
(IDCLIENTE VARCHAR(5),
 MATRICULA	VARCHAR(40),
 NUM_DIAS	INTEGER,
 FECCHA_ALQUILER DATE,
 FECHA_DEVOLUCION DATE,
 PRECIOTOTAL DOUBLE);

ALTER TABLE RALQUILAR ADD CONSTRAINT PK_RCLIENTE PRIMARY KEY (IDCLIENTE); 
ALTER TABLE RALQUILAR ADD CONSTRAINT PK_RVEHICULOS PRIMARY KEY (MATRICULA); 
ALTER TABLE RALQUILAR ADD CONSTRAINT PK_RALQUILAR PRIMARY KEY (FECCHA_ALQUILER); 

ALTER TABLE RALQUILAR ADD CONSTRAINT FK_CLI_ALQ FOREIGN KEY (IDCLIENTE) REFERENCES RCLIENTE(IDCLIENTE); 
ALTER TABLE RALQUILAR ADD CONSTRAINT FK_VEH_ALQ FOREIGN KEY (MATRICULA) REFERENCES RVEHICULOS(MATRICULA); 

