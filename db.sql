DROP DATABASE IF EXISTS aldoups_proyecto;

CREATE DATABASE aldoups_proyecto;

USE aldoups_proyecto;

CREATE TABLE categorias(
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    descripcion TEXT,
    fecha_ingreso TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id)
) ENGINE=INNODB;

CREATE TABLE productos(
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    precio DOUBLE NOT NULL,
    descripcion TEXT NOT NULL,
    stock INT NOT NULL,
    fecha_ingreso TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    categoria_id INT NOT NULL,
    
    PRIMARY KEY (id),

    FOREIGN KEY (categoria_id)
        REFERENCES categorias(id)
) ENGINE=INNODB;


CREATE TABLE usuarios(
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(15) NOT NULL,
    password VARCHAR(100) NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    fecha_ingreso TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id)
) ENGINE=INNODB;

CREATE TABLE ventas(
    id INT NOT NULL AUTO_INCREMENT,
    total DOUBLE NOT NULL,
    fecha_ingreso TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    usuario_id INT NOT NULL,
    estado TINYINT NULL,

    PRIMARY KEY (id),

    FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
) ENGINE=INNODB;

CREATE TABLE producto_vendido(
    id INT AUTO_INCREMENT,
    producto_id INT NOT NULL,
    venta_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio DOUBLE NOT NULL,

    PRIMARY KEY (id),
    INDEX (producto_id),
    INDEX (venta_id),

    FOREIGN KEY (producto_id)
        REFERENCES productos(id),
    FOREIGN KEY (venta_id)
        REFERENCES ventas(id)
) ENGINE=INNODB;

CREATE TABLE cortes_de_caja(
    id INT AUTO_INCREMENT,
    efectivo_esperado DOUBLE NOT NULL,
    efectivo_contado DOUBLE NOT NULL,
    fecha_ingreso TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    usuario_id INT NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
) ENGINE=INNODB;