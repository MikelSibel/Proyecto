DROP DATABASE IF EXISTS tienda;
CREATE DATABASE IF NOT EXISTS tienda CHARACTER SET utf8 COLLATE utf8_general_ci;
USE tienda;

DROP TABLE IF EXISTS USUARIO;
DROP TABLE IF EXISTS PEDIDOS;
DROP TABLE IF EXISTS VALORACIONES;
DROP TABLE IF EXISTS PRODUCTO;
DROP TABLE IF EXISTS STOCK;

CREATE TABLE IF NOT EXISTS USUARIO(
    Email VARCHAR(20) PRIMARY KEY,
    Nombre VARCHAR(20) NOT NULL,
    Apellido VARCHAR(20) NOT NULL,
    Fecha_naci DATE NOT NULL,
    Es_Admin BOOLEAN DEFAULT 0
);

CREATE TABLE IF NOT EXISTS PEDIDOS(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(20) NOT NULL,
    Estado ENUM('Almacen','Paqueteria', 'Entregado'),
    Fecha DATE NOT NULL,
    Descripcion VARCHAR(50),
    Email_Usuario VARCHAR(50) NOT NULL,
    FOREIGN KEY(Email_Usuario) REFERENCES USUARIO(Email)
);

CREATE TABLE IF NOT EXISTS VALORACIONES(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Estrellas INT NOT NULL,
    Fecha DATE NOT NULL,
    Descripcion VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS PRODUCTO(
    ID_Producto INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(20) NOT NULL,
    Categoria ENUM('Camiseta','Pantalón','Sudadera','Accesiorios','Chaquetas') NOT NULL,
    Precio DECIMAL(10,2) NOT NULL,
    Es_Promocionado BOOLEAN DEFAULT 0,
    Imagen VARCHAR(255) NOT NULL,
    Descripcion VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS STOCK(
    ID_Stock INT AUTO_INCREMENT PRIMARY KEY,
    Unidades INT NOT NULL,
    Color ENUM('Negro','Blanco','Azul','Rojo','Verde') NOT NULL,
    Talla ENUM('XXS','XS','S','M','L','XL','XXL','XXXL') NOT NULL,
    ID_Producto INT NOT NULL,
    FOREIGN KEY(ID_Producto) REFERENCES PRODUCTO(ID_Producto)
);

INSERT INTO USUARIO(Email, Nombre, Apellido, Fecha_naci, Es_Admin)
VALUES ('correo@admin.com', 'Soy', 'Admin', '2000', '1');
INSERT INTO USUARIO(Email, Nombre, Apellido, Fecha_naci, Es_Admin)
VALUES ('correo@cliente.com', 'timmy', 'timmyton', '2001', '0');

INSERT INTO PEDIDOS(Nombre, Estado, Fecha, Descripcion, Email_Usuario)
VALUES ('Pedido prueba 1','Almacen', '2025-03-18', 'pedido de prueba 1', 'correo@cliente.com')
INSERT INTO PEDIDOS(Nombre, Estado, Fecha, Descripcion, Email_Usuario)
VALUES ('Pedido prueba 2','Paqueteria', '2025-03-18', 'pedido de prueba 2', 'correo@cliente.com')
INSERT INTO PEDIDOS(Nombre, Estado, Fecha, Descripcion, Email_Usuario)
VALUES ('Pedido prueba 3','Entregado', '2025-03-18', 'pedido de prueba 3', 'correo@cliente.com')