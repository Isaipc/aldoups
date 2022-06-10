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