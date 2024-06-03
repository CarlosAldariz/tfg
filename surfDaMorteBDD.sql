-- Creación de la base de datos surfDaMorte
CREATE DATABASE IF NOT EXISTS surfDaMorte;

-- Uso de la base de datos surfDaMorte
USE surfDaMorte; 

-- Creación de la tabla Rol
CREATE TABLE Rol (
    CodRol INT PRIMARY KEY,
    Rol VARCHAR(50) NOT NULL
); 
INSERT INTO Rol (CodRol, Rol) VALUES
(1, 'editor'),
(2, 'usuario'),
(3, 'tienda'),
(4, 'root');

-- Creación de la tabla Usuarios
CREATE TABLE Usuarios (
    nombre VARCHAR(100) NOT NULL UNIQUE PRIMARY KEY,
    contraseña VARCHAR(255) NOT NULL,
    CodRol INT,
    FOREIGN KEY (CodRol) REFERENCES Rol(CodRol)
); 
INSERT INTO Usuarios (nombre, contraseña, CodRol) VALUES
('editor', '123', 1),
('usuario', '123', 2),
('tienda', '123', 3),
('root', '123', 4),
('usuario2', '123', 2);

-- Creación de la tabla Categorías
CREATE TABLE Categorias (
    CodCat INT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
); 
INSERT INTO Categorias (CodCat, nombre) VALUES
(1, 'tablas'),
(2, 'neoprenos'),
(3, 'aletas'),
(4, 'merch');

-- Creación de la tabla Productos
CREATE TABLE Productos (
    CodProd INT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(255),
    stock INT, 
    CodCat INT, 
    FOREIGN KEY (CodCat) REFERENCES Categorias(CodCat)
);

-- Creación de la tabla Articulos
CREATE TABLE Articulos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    extracto TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    texto TEXT,
    thumb VARCHAR(255)
);

-- Creación de la tabla Playas
CREATE TABLE Playas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    geolocalizacion VARCHAR(255),
    imagen VARCHAR(255),
    apikey VARCHAR(100)
); 