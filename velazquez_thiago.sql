CREATE DATABASE IF NOT EXISTS velazquez_thiago;
USE velazquez_thiago;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    email VARCHAR(100),
    clave VARCHAR(100),
    fecha_nacimiento DATE
);