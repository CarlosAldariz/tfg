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
INSERT INTO Playas (nombre, descripcion, geolocalizacion, imagen, apikey) VALUES
('Playa de Razo', 'La Playa de Razo es una de las más extensas de la costa gallega, conocida por sus olas perfectas para el surf de aprendizage y su arena fina.', '', '', ''),
('Playa de Torradas', 'Una playa pequeña y tranquila, ideal para relajarse y disfrutar del mar en un entorno natural. Su potencia y corrientes suele ser alta y la calidad de sus olas también', '', '', ''),
('Playa de Malpica', 'Situada en el centro de Malpica, es una playa urbana con gran actividad pesquera y turística. Se está volviendo una playa clásica para surf y campeonatos, su derecha es una ola historica de esta zona. Con viento del sur mas de 1,5 de mar y marea baja siempre funciona', '', '', ''),
('Playa de Seaia', 'Conocida por su belleza natural y aguas cristalinas, es un lugar perfecto para disfrutar de la tranquilidad. Tiene una ola muy caprichosa, puede que solo salga una vez al año, la mejos ola de toda costa da morte', 'https://www.google.com/maps/place/43%C2%B020\'11.0%22N+8%C2%B049\'44.4%22W/@43.3364,-8.8290,17z', '', ''),
('Playa de Beo', 'Una playa aislada con aguas limpias y un entorno natural impresionante, ideal para los amantes de la naturaleza zona de descanso para caminantes de el camino de los faros. Cuenta la leyenda que solo es surfeada por los locales. Cuidado con sus puedras y su bahía, es perfecta para "tostarse" al Sol', 'https://www.google.com/maps/place/43%C2%B020\'55.0%22N+8%C2%B051\'19.8%22W/@43.3486,-8.8555,17z', '', ''),
('Playa de Niñóns', 'Un lugar escondido y poco frecuentado, perfecto para disfrutar de la calma y la belleza del litoral gallego. Cuenta con cuevas, sus mareas determinan la formología de la playa, es preciosa. Ola enorme y muy caprichosa, es auténtico "secret spot" pero es complicado conseguir verla romper bien, su calidad es legendaria ', 'https://www.google.com/maps/place/43%C2%B022\'10.9%22N+8%C2%B053\'21.5%22W/@43.3697,-8.8893,17z', '', ''),
('Playa de Valarés', 'Rodeada de un pinar y con arena fina, esta playa es ideal para pasar un día en familia, hacer camping o un picnic. Para surfearla necesita condiciones de invierno, unos 7 metros y viento del sur, su orillera es fuerte no apta para principiantes', 'https://www.google.com/maps/place/43%C2%B017\'29.8%22N+8%C2%B051\'43.6%22W/@43.2916,-8.8621,17z', '', ''),
('Playa de Rebordelo', 'Con un paisaje espectacular y bien oculta. Apenas se ve afectada por el viento. Playa peleona, de olas potentes y corrientuda, es común ver a locales dominando sus olas. En verano suele masificarse, en invierno es una playa para surfistas experimentados', 'https://www.google.com/maps/place/43%C2%B019\'37.2%22N+8%C2%B054\'34.9%22W/@43.3270,-8.9097,17z', '', ''),
('Playa de Laxe', 'Una playa muy popular en la Costa da Morte, conocida por su gran extensión y aguas tranquilas. Solo se permite pillar pocas veces al año, con alerta roja y temporales de mar terribles. Su orillera te destrozará, pero probar las olas de la mejor playa de toda costa da morte es toda una experiencia', 'https://www.google.com/maps/place/43%C2%B013\'10.6%22N+9%C2%B000\'10.1%22W/@43.2196,-9.0028,17z', '', ''),
('Playa de Soesto', 'Caracterizada por sus olas fuertes y su ambiente salvaje, es ideal para los surfistas y aventureros. Cuidado con sus corrientes, se recomienda tener un nivel alto de conocimiento maritimo para tratar de surfearla en invierno', 'https://www.google.com/maps/place/43%C2%B014\'15.7%22N+9%C2%B002\'06.4%22W/@43.2377,-9.0351,17z', '', ''),
('Playa de Traba', 'Con un entorno natural protegido, esta playa ofrece un paisaje impresionante y una gran biodiversidad. Sus servicios son muchos y sus olas potentes. Ojo con los locales suelen quejarse de la masificación. S la visitas, respeta su entorno', 'https://www.google.com/maps/place/43%C2%B006\'31.0%22N+9%C2%B002\'29.4%22W/@43.1086,-9.0415,17z', '', ''),
('Playa de Reira', 'Parte del Parque Natural de las Islas Atlánticas, es una playa virgen con aguas cristalinas y arenas blancas de muy difícil acceso y con muy buenas olas.', 'https://www.google.com/maps/place/43%C2%B007\'12.4%22N+9%C2%B011\'52.1%22W/@43.1201,-9.1978,17z', '', ''),
('Playa de Nemiña', 'Popular entre los surfistas, esta playa ofrece olas grandes y un ambiente tranquilo y natural de las pocas playas de toda galicia cuyo offshore está mirando hacia el nordeste', 'https://www.google.com/maps/place/43%C2%B002\'22.6%22N+9%C2%B017\'29.4%22W/@43.0396,-9.2915,17z', '', ''),
('Playa Mar de Fora', 'Situada en el fin del mundo, esta playa ofrece paisajes espectaculares y es perfecta para caminatas y exploración. Solo apta para expertos, es una playa peligrosa.', 'https://www.google.com/maps/place/42%C2%B053\'20.0%22N+9%C2%B016\'00.1%22W/@42.8889,-9.2667,17z', '', '');