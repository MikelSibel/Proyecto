DROP DATABASE IF EXISTS tienda;
CREATE DATABASE IF NOT EXISTS tienda CHARACTER SET utf8 COLLATE utf8_general_ci;
USE tienda;

DROP TABLE IF EXISTS USUARIO;
DROP TABLE IF EXISTS PRODUCTO;
DROP TABLE IF EXISTS PEDIDOS;
DROP TABLE IF EXISTS VALORACIONES;
DROP TABLE IF EXISTS STOCK;

CREATE TABLE IF NOT EXISTS USUARIO(
    Email VARCHAR(20) PRIMARY KEY,
    Nombre VARCHAR(20) NOT NULL,
    Apellido VARCHAR(20) NOT NULL,
    Clave VARCHAR(20) NOT NULL,
    Fecha_naci DATE NOT NULL,
    Sexo ENUM('Hombre', 'Mujer', 'Otro')
    Es_Admin BOOLEAN DEFAULT 0
);

CREATE TABLE IF NOT EXISTS PRODUCTO(
    ID_Producto INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(20) NOT NULL,
    Categoria ENUM('Camiseta','Sudadera','Accesiorios') NOT NULL,
    Sub_Categoria ENUM('Gorras','Llaveros','Mochilas','Otros'),
    Precio DECIMAL(10,2) NOT NULL,
    Es_Promocionado BOOLEAN DEFAULT 0,
    Imagen1 VARCHAR(255) NOT NULL,
    Imagen2 VARCHAR(255),
    Imagen3 VARCHAR(255),
    Descripcion VARCHAR(50)
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
    Comentario VARCHAR(50)
    Email_Usuario VARCHAR(20) NOT NULL,
    ID_Producto INT NOT NULL,
    FOREIGN KEY(Email_Usuario) REFERENCES USUARIO(Email),
    FOREIGN KEY(ID_Producto) REFERENCES PRODUCTO(ID_Producto)
);

CREATE TABLE IF NOT EXISTS STOCK(
    ID_Stock INT AUTO_INCREMENT PRIMARY KEY,
    Unidades INT NOT NULL,
    Color ENUM('Negro','Blanco','Azul','Rojo','Verde'),
    Talla ENUM('XXS','XS','S','M','L','XL','XXL','XXXL'),
    ID_Producto INT NOT NULL,
    FOREIGN KEY(ID_Producto) REFERENCES PRODUCTO(ID_Producto)
);

INSERT INTO USUARIO(Email, Nombre, Apellido, Clave, Fecha_naci, Es_Admin)
VALUES ('correo@admin.com', 'Soy', 'Admin', 'admin123' '2000', '1');
INSERT INTO USUARIO(Email, Nombre, Apellido, Clave, Fecha_naci, Es_Admin)
VALUES ('correo@cliente.com', 'timmy', 'timmyton', 'user123', '2001', '0');

INSERT INTO PEDIDOS(Nombre, Estado, Fecha, Descripcion, Email_Usuario)
VALUES ('Pedido prueba 1','Almacen', '2025-03-18', 'pedido de prueba 1', 'correo@cliente.com')
INSERT INTO PEDIDOS(Nombre, Estado, Fecha, Descripcion, Email_Usuario)
VALUES ('Pedido prueba 2','Paqueteria', '2025-03-18', 'pedido de prueba 2', 'correo@cliente.com')
INSERT INTO PEDIDOS(Nombre, Estado, Fecha, Descripcion, Email_Usuario)
VALUES ('Pedido prueba 3','Entregado', '2025-03-18', 'pedido de prueba 3', 'correo@cliente.com')

INSERT INTO PRODUCTO(Nombre, Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES ('CAMISETA MONSTER TRIO','Camiseta',22.95, '../imagenes/1.jpg', '../imagenes/2.jpg', 'Camiseta Monster Trio de la marca de anime Nakama Clothing. Se han reunido los 3 piratas más fuertes de la tripulación del futuro rey de los piratas, para hacer frente a cualquier calamidad.');
INSERT INTO PRODUCTO(Nombre, Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES ('CAMISETA EVIL GHOST','Camiseta', 22.95,'../imagenes/3.jpg','../imagenes/4.jpg','Camiseta morado Evil Ghost de la marca de anime Nakama Clothing. Soy un canalla difícil de atrapar, incorpóreo, de ojos rojos y gran sonrisa. Cuando menos te lo esperes un buen lengüetazo te vas a llevar Muajajajaja');
INSERT INTO PRODUCTO(Nombre, Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES ('SUDADERA BRAVE PIG','Sudadera',45.95,'../imagenes/5.jpg','../imagenes/6.jpg','Sudadera Brave Pig de la marca de anime Nakama Clothing. Soy el Cazador de demonios enmascarado ¡RESPIRACIÓN!');
INSERT INTO PRODUCTO(Nombre, Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES ('SUDADERA BLOODY SAW','Sudadera',45.95,'../imagenes/7.jpg','../imagenes/8.jpg','Sudadera Bloody Saw de la marca de anime Nakama Clothing. Cortaré y desmembraré lo que haga falta con tal de conseguir un beso de una chica.');
INSERT INTO PRODUCTO(Nombre, Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES ('Anime Sword Art Online Sao Denim Jacket Chaqueta Vaquera Adulto Cosplay Jeans Hoodie Outwear Abrigo','Sudadera', ,'../imagenes/9.jpg','../imagenes/10.jpg','Anime Sword Art Online Sao Denim Jacket Chaqueta Vaquera Adulto Cosplay Jeans Hoodie Outwear Abrigo Azul 1 M');
INSERT INTO PRODUCTO(Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES ('GORRA FIVE CLOVER','Accesirios', 'Gorras',19.95,'../imagenes/11.jpg','../imagenes/12.jpg','Gorra Five Clover de la marca de anime Nakama Clothing. A pesar de no tener una gota de magia, entrenaré duro para proteger este reino.');
INSERT INTO PRODUCTO(Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES ('GORRO DEMON SAND','Accesorios','Gorras',19.95,'../imagenes/13.jpg','../imagenes/14.jpg','');
INSERT INTO PRODUCTO(Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES ('MOCHILA THE GOD ELEVEN','Accesirios', 'Mochilas',24.95,'../imagenes/15.jpg','../imagenes/16.jpg','Mochila naranja The God Eleven de la marca de anime Nakama Clothing. Arriba, chuta, la victoria es tuya! Con este equipo la portería será impenetrable!');
INSERT INTO PRODUCTO(Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES ('MOCHILA WONDERFUL PIG','Accesorios', 'Mochilas',15.95,'../imagenes/17.jpg','../imagenes/18.jpg','Mochila Wonderful pig de la marca de anime Nakama Clothing. Vive las mejores aventuras, junto al cerdito más valiente que la imaginación de un niño de 5 años Japonés ha creado!');
INSERT INTO PRODUCTO(Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Descripcion)
VALUES ('LLAVERO DANCING SWEET','Accesorios', 'Llaveros',5.95,'../imagenes/19.jpg','Llavero Dancing Sweet de la marca de anime Nakama Clothing. No tener magia, no hará que no pueda bailar mientras tenga mis profiteroles.');
INSERT INTO PRODUCTO(Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Descripcion)
VALUES ('LLAVERO BLOODY SAW','Accesorios', 'Llaveros',5.95,'../imagenes/20.jpg','Llavero Bloody Saw de la marca de anime Nakama Clothing. Cortaré y desmembraré lo que haga falta con tal de conseguir un beso de una chica.');
INSERT INTO PRODUCTO(Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES ('POSAVASOS ALIEN FROG','Accesorios', 'Otros',15.95,'../imagenes/21.jpg','../imagenes/22.jpg','Posavasos Alien Frog de la marca de anime Nakama Clothing. A pesar de tener un aspecto animal adorable, somos unos alienígenas temibles. Pensamos conquistar el planeta tierra, jurado por las nuestras ancas!');
INSERT INTO PRODUCTO(Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES ('MUÑEQUERA NAKAMA','Accesorios', 'Otros',4.95,'../imagenes/23.jpg','../imagenes/24.jpg','Muñequera Nakama de la marca de anime Nakama Clothing. Recrea el símbolo de la amistad pirata.');