CREATE DATABASE aldoups_proyecto;

USE aldoups_proyecto;

CREATE TABLE productos(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    precio DOUBLE NOT NULL,
    descripcion TEXT NOT NULL,
    stock INT NOT NULL,
    fecha_ingreso TIMESTAMP
    fecha_modificacion TIMESTAMP
);

CREATE TABLE categorias(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    descripcion TEXT,
    fecha_ingreso TIMESTAMP,
    fecha_modificacion TIMESTAMP
)

CREATE TABLE usuarios(
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(15) NOT NULL,
    password VARCHAR NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    fecha_ingreso TIMESTAMP,
    fecha_modificacion TIMESTAMP
)

CREATE TABLE producto_vendido(
    id INT AUTO_INCREMENT,
    producto_id INT NOT NULL,
    venta_id INT NOT NULL,
    cantidad INT NOT NULL,
    monto DOUBLE NOT NULL,

    PRIMARY KEY (id)
    INDEX (producto_id)
    INDEX (venta_id)

    FOREIGN KEY (producto_id)
        REFERENCES productos(id)
    FOREIGN KEY (venta_id)
        REFERENCES ventas(id)
) ENGINE=INNODB;