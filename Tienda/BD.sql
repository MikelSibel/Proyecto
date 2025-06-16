DROP DATABASE IF EXISTS oro;
CREATE DATABASE IF NOT EXISTS oro CHARACTER SET utf8 COLLATE utf8_general_ci;
USE oro;

DROP TABLE IF EXISTS USUARIO;
DROP TABLE IF EXISTS PRODUCTO;
DROP TABLE IF EXISTS PEDIDOS;
DROP TABLE IF EXISTS VALORACIONES;
DROP TABLE IF EXISTS STOCK;

CREATE TABLE IF NOT EXISTS USUARIO(
    DNI VARCHAR(255) PRIMARY KEY,
    Email VARCHAR(255) NOT NULL,
    Nombre VARCHAR(255) NOT NULL,
    Apellido VARCHAR(255) NOT NULL,
    Clave VARCHAR(255) NOT NULL,
    Fecha_naci DATE NOT NULL,
    Es_Admin BOOLEAN DEFAULT 0,
    Direccion VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS CATEGORIAS(
    categorias VARCHAR(255) PRIMARY KEY
);

CREATE TABLE IF NOT EXISTS PRODUCTO(
    ID_Producto INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL,
    Categorias VARCHAR(255) NOT NULL,
    Precio DECIMAL(10,2) NOT NULL,
    IVA INT NOT NULL,
    Es_Promocionado BOOLEAN DEFAULT 0,
    Imagen1 VARCHAR(255) NOT NULL,
    Imagen2 VARCHAR(255),
    Imagen3 VARCHAR(255),
    Descripcion VARCHAR(255),
    FOREIGN KEY(Categorias) REFERENCES CATEGORIAS(categorias)
);

CREATE TABLE IF NOT EXISTS PRODUCTOS_FAVORITOS(
    ID_Producto INT,
    DNI VARCHAR(255),
    FOREIGN KEY(ID_Producto) REFERENCES PRODUCTO(ID_Producto),
    FOREIGN KEY(DNI) REFERENCES USUARIO(DNI)
);

CREATE TABLE IF NOT EXISTS PEDIDOS(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL,
    Estado ENUM('Almacen','Paqueteria', 'Entregado') NOT NULL,
    Fecha DATE NOT NULL,
    Descripcion VARCHAR(255),
    DNI VARCHAR(255) NOT NULL,
    Direccion VARCHAR(255) NOT NULL,
    FOREIGN KEY(DNI) REFERENCES USUARIO(DNI)
);

CREATE TABLE IF NOT EXISTS LINEAS_PEDIDO(
    numPedido INT NOT NULL,
    numLinea INT NOT NULL,
    ID_Producto INT NOT NULL,
    unidades int NOT NULL,
    IVA INT NOT NULL,
    Precio DECIMAL(10,2) NOT NULL,
    descuento INT NOT NULL,
    PRIMARY KEY (numPedido, numLinea),
    FOREIGN KEY (numPedido) REFERENCES PEDIDOS(ID),
    FOREIGN KEY (ID_Producto) REFERENCES PRODUCTO(ID_Producto)
);


CREATE TABLE IF NOT EXISTS VALORACIONES(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Estrellas INT NOT NULL,
    Fecha DATE NOT NULL,
    Comentario VARCHAR(255),
    DNI VARCHAR(255) NOT NULL,
    ID_Producto INT NOT NULL,
    FOREIGN KEY(DNI) REFERENCES USUARIO(DNI),
    FOREIGN KEY(ID_Producto) REFERENCES PRODUCTO(ID_Producto)
);

CREATE TABLE IF NOT EXISTS STOCK(
    Unidades INT NOT NULL,
    Color ENUM('Negro','Blanco','Azul','Rojo','Verde') NOT NULL,
    Talla ENUM('XXS','XS','S','M','L','XL','XXL','XXXL') NOT NULL,
    ID_Producto INT NOT NULL,
    PRIMARY KEY (Color, Talla, ID_Producto),
    FOREIGN KEY(ID_Producto) REFERENCES PRODUCTO(ID_Producto)
);

INSERT INTO USUARIO(DNI,Email, Nombre, Apellido, Clave, Fecha_naci, Es_Admin)
VALUES ('04514257R','correo@admin.com', 'Soy', 'Admin', 'admin123', '2000-6-4', 1);
INSERT INTO USUARIO(DNI,Email, Nombre, Apellido, Clave, Fecha_naci, Es_Admin)
VALUES ('14514258H','correo@cliente.com', 'timmy', 'timmyton', 'user123', '2001-7-19', 0);

INSERT INTO PEDIDOS(Nombre, Estado, Fecha, Descripcion, DNI)
VALUES ('Pedido prueba 1','Almacen', '2025-03-18', 'pedido de prueba 1', '14514258H');
INSERT INTO PEDIDOS(Nombre, Estado, Fecha, Descripcion, DNI)
VALUES ('Pedido prueba 2','Paqueteria', '2025-03-18', 'pedido de prueba 2', '14514258H');
INSERT INTO PEDIDOS(Nombre, Estado, Fecha, Descripcion, DNI)
VALUES ('Pedido prueba 3','Entregado', '2025-03-18', 'pedido de prueba 3', '14514258H');

INSERT INTO CATEGORIAS(categorias)
VALUES ('Camiseta');
INSERT INTO CATEGORIAS(categorias)
VALUES ('Sudadera');
INSERT INTO CATEGORIAS(categorias)
VALUES ('Accesorios');

INSERT INTO PRODUCTO(ID_Producto, Nombre, Categorias, Precio, Imagen1, Imagen2, Descripcion)
VALUES (1,'CAMISETA MONSTER TRIO','Camiseta',22.95, '../imagenes/1.jpg', '../imagenes/2.jpg', 'Camiseta Monster Trio de la marca de anime Nakama Clothing. Se han reunido los 3 piratas más fuertes de la tripulación del futuro rey de los piratas, para hacer frente a cualquier calamidad.');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categorias, Precio, Imagen1, Imagen2, Descripcion)
VALUES (2,'CAMISETA EVIL GHOST','Camiseta', 22.95,'../imagenes/3.jpg','../imagenes/4.jpg','Camiseta morado Evil Ghost de la marca de anime Nakama Clothing. Soy un canalla difícil de atrapar, incorpóreo, de ojos rojos y gran sonrisa. Cuando menos te lo esperes un buen lengüetazo te vas a llevar Muajajajaja');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categorias, Precio, Imagen1, Imagen2, Descripcion)
VALUES (3,'SUDADERA BRAVE PIG','Sudadera',45.95,'../imagenes/5.jpg','../imagenes/6.jpg','Sudadera Brave Pig de la marca de anime Nakama Clothing. Soy el Cazador de demonios enmascarado ¡RESPIRACIÓN!');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categorias, Precio, Imagen1, Imagen2, Descripcion)
VALUES (4,'SUDADERA BLOODY SAW','Sudadera',45.95,'../imagenes/7.jpg','../imagenes/8.jpg','Sudadera Bloody Saw de la marca de anime Nakama Clothing. Cortaré y desmembraré lo que haga falta con tal de conseguir un beso de una chica.');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categorias, Precio, Imagen1, Imagen2, Descripcion)
VALUES (5,'Anime Sword Art Online Sao Denim Jacket Chaqueta Vaquera Adulto Cosplay Jeans Hoodie Outwear Abrigo','Sudadera', 45.95,'../imagenes/9.jpg','../imagenes/10.jpg','Anime Sword Art Online Sao Denim Jacket Chaqueta Vaquera Adulto Cosplay Jeans Hoodie Outwear Abrigo Azul 1 M');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categorias, Precio, Imagen1, Imagen2, Descripcion)
VALUES (6,'GORRA FIVE CLOVER','Accesorios',19.95,'../imagenes/11.jpg','../imagenes/12.jpg','Gorra Five Clover de la marca de anime Nakama Clothing. A pesar de no tener una gota de magia, entrenaré duro para proteger este reino.');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categorias, Precio, Imagen1, Imagen2, Descripcion)
VALUES (7,'GORRO DEMON SAND','Accesorios',19.95,'../imagenes/13.jpg','../imagenes/14.jpg','Gorro Demon Sand de la marca de anime Nakama Clothing. Sufrí mucho en mi pasado, más que el dolor que sientes cuando se te mete arena dentro del ojo. Ahora sufriréis mi venganza.');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categorias, Precio, Imagen1, Imagen2, Descripcion)
VALUES (8,'MOCHILA THE GOD ELEVEN','Accesorios',24.95,'../imagenes/15.jpg','../imagenes/16.jpg','Mochila naranja The God Eleven de la marca de anime Nakama Clothing. Arriba, chuta, la victoria es tuya! Con este equipo la portería será impenetrable!');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categorias, Precio, Imagen1, Imagen2, Descripcion)
VALUES (9,'MOCHILA WONDERFUL PIG','Accesorios',15.95,'../imagenes/17.jpg','../imagenes/18.jpg','Mochila Wonderful pig de la marca de anime Nakama Clothing. Vive las mejores aventuras, junto al cerdito más valiente que la imaginación de un niño de 5 años Japonés ha creado!');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categorias, Precio, Imagen1, Descripcion)
VALUES (10,'LLAVERO DANCING SWEET','Accesorios',5.95,'../imagenes/19.jpg','Llavero Dancing Sweet de la marca de anime Nakama Clothing. No tener magia, no hará que no pueda bailar mientras tenga mis profiteroles.');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categorias, Precio, Imagen1, Descripcion)
VALUES (11,'LLAVERO BLOODY SAW','Accesorios',5.95,'../imagenes/20.jpg','Llavero Bloody Saw de la marca de anime Nakama Clothing. Cortaré y desmembraré lo que haga falta con tal de conseguir un beso de una chica.');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categorias, Precio, Imagen1, Imagen2, Descripcion)
VALUES (12,'POSAVASOS ALIEN FROG','Accesorios',15.95,'../imagenes/21.jpg','../imagenes/22.jpg','Posavasos Alien Frog de la marca de anime Nakama Clothing. A pesar de tener un aspecto animal adorable, somos unos alienígenas temibles. Pensamos conquistar el planeta tierra, jurado por las nuestras ancas!');
INSERT INTO PRODUCTO(ID_Producto, Nombre, Categorias, Precio, Imagen1, Imagen2, Descripcion)
VALUES (13,'MUÑEQUERA NAKAMA','Accesorios',4.95,'../imagenes/23.jpg','../imagenes/24.jpg','Muñequera Nakama de la marca de anime Nakama Clothing. Recrea el símbolo de la amistad pirata.');

INSERT INTO STOCK(Unidades, Color, Talla, ID_Producto)
VALUES (50, 'Negro', 'L', 1);
INSERT INTO STOCK(Unidades, Color, Talla, ID_Producto)
VALUES (25, 'Blanco', 'XL', 1);
INSERT INTO STOCK(Unidades, Color, Talla, ID_Producto)
VALUES (50, 'Azul', 'L', 2);
INSERT INTO STOCK(Unidades, Color, Talla, ID_Producto)
VALUES (30, 'Negro', 'L', 2);
INSERT INTO STOCK(Unidades, Color, Talla, ID_Producto)
VALUES (50, 'Negro', 'S', 5);
INSERT INTO STOCK(Unidades, Color, Talla, ID_Producto)
VALUES (50, 'Negro', 'XXL', 5);
INSERT INTO STOCK(Unidades, ID_Producto)
VALUES (10, 10);
INSERT INTO STOCK(Unidades, ID_Producto)
VALUES (5, 12);