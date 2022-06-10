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
