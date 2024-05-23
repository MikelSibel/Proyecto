CREATE DATABASE IF NOT EXISTS Proyecto;

CREATE DATABASE Proyecto CHARACTER SET utf8 COLLATE utf8_general_ci;

USE Proyecto;

CREATE TABLE ALUMNOS(
Correo_elec VARCHAR(60) PRIMARY KEY,
Nombre VARCHAR(20) NOT NULL,
Apellido_1 VARCHAR(20) NOT NULL,
Apellido_2 VARCHAR(20) NOT NULL,
Tel VARCHAR(9) NOT NULL,
Foto VARCHAR(255),
Clave VARCHAR(45) Not NULL,
Nombre_User VARCHAR(45) UNIQUE NOT NULL,
Estado ENUM('Estudiando','Trabajando','Disponible','No Molestar')
);

CREATE TABLE PROFESORES(
Correo_elec VARCHAR(60) PRIMARY KEY,
Nombre VARCHAR(20) NOT NULL,
Apellido_1 VARCHAR(20) NOT NULL,
Apellido_2 VARCHAR(20) NOT NULL,
Tel VARCHAR(9) NOT NULL,
Foto VARCHAR(255),
Clave VARCHAR(45) NOT NULL,
Nombre_User VARCHAR(45) UNIQUE NOT NULL
);

CREATE TABLE OFERTAS(
CodOf INT AUTO_INCREMENT PRIMARY KEY,
Nombre VARCHAR(50) NOT NULL,
Fecha_Publ TIMESTAMP DEFAULT CURRENT_TIMESTAM,
Fecha_Mod TIMESTAMP DEFAULT CURRENT_TIMESTAM ON UPDATE CURRENT_TIMESTAM,
Modalidad ENUM('Remoto','Presencial','Mixto','No Especificado') NOT NULL,
Horario VARCHAR(30) NOT NULL,
Ubicacion VARCHAR(45) NOT NULL,
Niv_Educ VARCHAR(45) NOT NULL,
Salario DECIMAL(10,2),
Moneda VARCHAR(3),
Empresa VARCHAR(45) NOT NULL,
Idioma_Of VARCHAR(45) NOT NULL,
Ex_Re VARCHAR(45) NOT NULL,
Descripcion VARCHAR(200),
Popularidad INT,
Estado BOOLEAN,
Prof_Crea_Of VARCHAR(20) NOT NULL,
Prof_Mod_Of VARCHAR(20) NOT NULL,
FOREIGN KEY(Prof_Crea_Of) REFERENCES PROFESORES(nombre),
FOREIGN KEY(Prof_Mod_Of) REFERENCES PROFESORES(nombre),
);

CREATE TABLE OFERTAS_FAVORITAS(
CodOf INT AUTO_INCREMENT PRIMARY KEY,
Nombre VARCHAR(50) NOT NULL,
Fecha_Publ TIMESTAMP DEFAULT CURRENT_TIMESTAM,
Fecha_Mod TIMESTAMP DEFAULT CURRENT_TIMESTAM ON UPDATE CURRENT_TIMESTAM,
Modalidad ENUM('Remoto','Presencial','Mixto','No Especificado') NOT NULL,
Horario VARCHAR(30) NOT NULL,
Ubicacion VARCHAR(45) NOT NULL,
Niv_Educ VARCHAR(45) NOT NULL,
Salario DECIMAL(10,2),
Moneda VARCHAR(3),
Empresa VARCHAR(45) NOT NULL,
Idioma_Of VARCHAR(45) NOT NULL,
Ex_Re VARCHAR(45) NOT NULL,
Descripcion VARCHAR(200),
Popularidad INT,
Estado BOOLEAN,
Prof_Crea_Of VARCHAR(20) NOT NULL,
Prof_Mod_Of VARCHAR(20) NOT NULL,
FOREIGN KEY(Prof_Crea_Of) REFERENCES PROFESORES(nombre),
FOREIGN KEY(Prof_Mod_Of) REFERENCES PROFESORES(nombre),
);

INSERT INTO ALUMNOS(Nombre, Apellido_1, Apellido_2, Correo_elec, Tel, Clave, Nombre_User)
VALUES ('Manolo','González','Pérez','mgonpez0602@g.educaand.es','684131948','alumno','mgonpez')

INSERT INTO PROFESORES(Nombre, Apellido_1, Apellido_2, Correo_elec, Tel, Clave, Nombre_User)
VALUES ('María','Gallego','Montes','mgalmot0109@g.educaand.es','687115073','profesor','mgalmot')

INSER INTO OFERTAS(Nombre, Remoto, Horario, Ubicacion, Niv_Educ, Salario, Moneda, Empresa, Idioma_Of, Ex_Re, Descripcion)
VALUES ('Responsable de Almacén | Supervisor/a de Plantas', 3, 'Jornada Completa', 'Sevilla','Educación Segundaria Obligatoria', 1000, 'EUR','TE CONSULTING HOUSE 4 PLUS SL.','Español','No','·Gestionar un pequeño almacén (ej. seguimiento de entradas y salidas de material, llevanza de inventario, reposición de estocaje mínimo, gestión de recepciones, entregas y envíos, etc.)')