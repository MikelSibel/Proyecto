DROP DATABASE IF EXISTS Golden;
CREATE DATABASE IF NOT EXISTS Golden CHARACTER SET utf8 COLLATE utf8_general_ci;
USE Golden;

DROP TABLE IF EXISTS USUARIO;
DROP TABLE IF EXISTS PRODUCTO;
DROP TABLE IF EXISTS PEDIDOS;
DROP TABLE IF EXISTS VALORACIONES;
DROP TABLE IF EXISTS STOCK;

CREATE TABLE IF NOT EXISTS USUARIO(
    Email VARCHAR(255) PRIMARY KEY,
    Nombre VARCHAR(20) NOT NULL,
    Apellido VARCHAR(20) NOT NULL,
    Clave VARCHAR(20) NOT NULL,
    Fecha_naci DATE NOT NULL,
    Sexo ENUM('Hombre', 'Mujer', 'Otro'),
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
    Descripcion VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS PEDIDOS(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(20) NOT NULL,
    Estado ENUM('Almacen','Paqueteria', 'Entregado') NOT NULL,
    Fecha DATE NOT NULL,
    Descripcion VARCHAR(255),
    Email_Usuario VARCHAR(50) NOT NULL,
    FOREIGN KEY(Email_Usuario) REFERENCES USUARIO(Email)
);

CREATE TABLE IF NOT EXISTS VALORACIONES(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Estrellas INT NOT NULL,
    Fecha DATE NOT NULL,
    Comentario VARCHAR(255),
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
VALUES ('correo@admin.com', 'Soy', 'Admin', 'admin123', '2000-6-4', 1);
INSERT INTO USUARIO(Email, Nombre, Apellido, Clave, Fecha_naci, Es_Admin)
VALUES ('correo@cliente.com', 'timmy', 'timmyton', 'user123', '2001-7-19', 0);

INSERT INTO PEDIDOS(Nombre, Estado, Fecha, Descripcion, Email_Usuario)
VALUES ('Pedido prueba 1','Almacen', '2025-03-18', 'pedido de prueba 1', 'correo@cliente.com');
INSERT INTO PEDIDOS(Nombre, Estado, Fecha, Descripcion, Email_Usuario)
VALUES ('Pedido prueba 2','Paqueteria', '2025-03-18', 'pedido de prueba 2', 'correo@cliente.com');
INSERT INTO PEDIDOS(Nombre, Estado, Fecha, Descripcion, Email_Usuario)
VALUES ('Pedido prueba 3','Entregado', '2025-03-18', 'pedido de prueba 3', 'correo@cliente.com');

INSERT INTO PRODUCTO(ID_Producto, Nombre, Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES (1,'CAMISETA MONSTER TRIO','Camiseta',22.95, '../imagenes/1.jpg', '../imagenes/2.jpg', 'Camiseta Monster Trio de la marca de anime Nakama Clothing. Se han reunido los 3 piratas más fuertes de la tripulación del futuro rey de los piratas, para hacer frente a cualquier calamidad.');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES (2,'CAMISETA EVIL GHOST','Camiseta', 22.95,'../imagenes/3.jpg','../imagenes/4.jpg','Camiseta morado Evil Ghost de la marca de anime Nakama Clothing. Soy un canalla difícil de atrapar, incorpóreo, de ojos rojos y gran sonrisa. Cuando menos te lo esperes un buen lengüetazo te vas a llevar Muajajajaja');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES (3,'SUDADERA BRAVE PIG','Sudadera',45.95,'../imagenes/5.jpg','../imagenes/6.jpg','Sudadera Brave Pig de la marca de anime Nakama Clothing. Soy el Cazador de demonios enmascarado ¡RESPIRACIÓN!');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES (4,'SUDADERA BLOODY SAW','Sudadera',45.95,'../imagenes/7.jpg','../imagenes/8.jpg','Sudadera Bloody Saw de la marca de anime Nakama Clothing. Cortaré y desmembraré lo que haga falta con tal de conseguir un beso de una chica.');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES (5,'Anime Sword Art Online Sao Denim Jacket Chaqueta Vaquera Adulto Cosplay Jeans Hoodie Outwear Abrigo','Sudadera', 45.95,'../imagenes/9.jpg','../imagenes/10.jpg','Anime Sword Art Online Sao Denim Jacket Chaqueta Vaquera Adulto Cosplay Jeans Hoodie Outwear Abrigo Azul 1 M');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES (6,'GORRA FIVE CLOVER','Accesorios', 'Gorras',19.95,'../imagenes/11.jpg','../imagenes/12.jpg','Gorra Five Clover de la marca de anime Nakama Clothing. A pesar de no tener una gota de magia, entrenaré duro para proteger este reino.');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES (7,'GORRO DEMON SAND','Accesorios', 'Gorras',19.95,'../imagenes/13.jpg','../imagenes/14.jpg','Gorro Demon Sand de la marca de anime Nakama Clothing. Sufrí mucho en mi pasado, más que el dolor que sientes cuando se te mete arena dentro del ojo. Ahora sufriréis mi venganza.');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES (8,'MOCHILA THE GOD ELEVEN','Accesorios', 'Mochilas',24.95,'../imagenes/15.jpg','../imagenes/16.jpg','Mochila naranja The God Eleven de la marca de anime Nakama Clothing. Arriba, chuta, la victoria es tuya! Con este equipo la portería será impenetrable!');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES (9,'MOCHILA WONDERFUL PIG','Accesorios', 'Mochilas',15.95,'../imagenes/17.jpg','../imagenes/18.jpg','Mochila Wonderful pig de la marca de anime Nakama Clothing. Vive las mejores aventuras, junto al cerdito más valiente que la imaginación de un niño de 5 años Japonés ha creado!');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Descripcion)
VALUES (10,'LLAVERO DANCING SWEET','Accesorios', 'Llaveros',5.95,'../imagenes/19.jpg','Llavero Dancing Sweet de la marca de anime Nakama Clothing. No tener magia, no hará que no pueda bailar mientras tenga mis profiteroles.');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Descripcion)
VALUES (11,'LLAVERO BLOODY SAW','Accesorios', 'Llaveros',5.95,'../imagenes/20.jpg','Llavero Bloody Saw de la marca de anime Nakama Clothing. Cortaré y desmembraré lo que haga falta con tal de conseguir un beso de una chica.');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES (12,'POSAVASOS ALIEN FROG','Accesorios', 'Otros',15.95,'../imagenes/21.jpg','../imagenes/22.jpg','Posavasos Alien Frog de la marca de anime Nakama Clothing. A pesar de tener un aspecto animal adorable, somos unos alienígenas temibles. Pensamos conquistar el planeta tierra, jurado por las nuestras ancas!');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categoria, Sub_Categoria, Precio, Imagen1, Imagen2, Descripcion)
VALUES (13,'MUÑEQUERA NAKAMA','Accesorios', 'Otros',4.95,'../imagenes/23.jpg','../imagenes/24.jpg','Muñequera Nakama de la marca de anime Nakama Clothing. Recrea el símbolo de la amistad pirata.');

INSERT INTO STOCK(ID_Stock, Unidades, Color, Talla, ID_Producto)
VALUES (1, 50, 'Negro', 'L', 1);
INSERT INTO STOCK(ID_Stock, Unidades, Color, Talla, ID_Producto)
VALUES (2, 25, 'Blanco', 'XL', 1);
INSERT INTO STOCK(ID_Stock, Unidades, Color, Talla, ID_Producto)
VALUES (3, 50, 'Azul', 'L', 2);
INSERT INTO STOCK(ID_Stock, Unidades, Color, Talla, ID_Producto)
VALUES (4, 30, 'Negro', 'L', 2);
INSERT INTO STOCK(ID_Stock, Unidades, Color, Talla, ID_Producto)
VALUES (5, 50, 'Negro', 'S', 5);
INSERT INTO STOCK(ID_Stock, Unidades, Color, Talla, ID_Producto)
VALUES (6, 50, 'Negro', 'XXL', 5);
INSERT INTO STOCK(ID_Stock, Unidades, ID_Producto)
VALUES (7, 10, 10);
INSERT INTO STOCK(ID_Stock, Unidades, ID_Producto)
VALUES (8, 5, 12);