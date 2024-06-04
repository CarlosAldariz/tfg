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
('editor', '$2y$10$WZ3.v5Y6jtVjWo/zU4d2EuZc4tG50J3Dl9N35nC7jURxMF58./Fzi', 1),
('usuario', '$2y$10$UHZM9H1Q6IW8eLzHfpBoNuf3F.aHJ3lH45joUikHV7X0/YHOFsVKS', 2),
('tienda', '$2y$10$MKhWbLoxmRMd/O5A1JbW3efXxYqSmwrJ.uZT8K5x.mH6FAyEP4QiC', 3),
('root', '$2y$10$8O/qzUdAXySlrXmv6Q1RseXZz.ZJ6bR2zqhr/lQ8zUM0CopeX0MSS', 4),
('usuario2', '$2y$10$wxkGzhwO.wQcX5X.hZ/TU.z1VcC08Yscj9FAd3oyKO6zii/7cC7Iu', 2);

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
INSERT INTO Productos (CodProd, nombre, descripcion, imagen, stock, CodCat) 
VALUES 
(1, 'evolutiva', 'Tabla de surf evolutiva para iniciarse', 'tabla_surf1.jpg', 4, 1), 
(2, 'bodyboard', 'tabla para iniciarse', 'bodyboard1.jpg', 4, 1), 
(3, 'neopreno_largo', 'neopreno de invierno para situaciones frías', 'neopreno1.jpg', 4, 2), 
(4, 'neopreno_corto', 'neopreno de verano para temperaturas cálidas', 'neopreno2.jpg', 4, 2), 
(5, 'aletas', 'aletas cortas para bodyboard', 'aletas1.jpg', 4, 3), 
(6, 'camiseta', 'camiseta logotipo surf da morte', 'camiseta1.jpg', 4, 4), 
(7, 'gorra', 'gorra logotipo surf da morte', 'gorra1.jpg', 4, 4);



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
INSERT INTO Playas (nombre, descripcion, geolocalizacion, imagen) VALUES
('Playa de Razo', 'La Playa de Razo es una de las más extensas de la costa gallega, conocida por sus olas perfectas para el surf de aprendizage y su arena fina.', 'https://www.google.com/maps/place/Praia+de+Razo/@43.2904003,-8.7197448,15z/data=!3m1!4b1!4m6!3m5!1s0xd2e90921972a6ad:0xa2b9f2eb1d93f877!8m2!3d43.2897112!4d-8.7094069!16s%2Fg%2F11xbw13rw?entry=ttu','razo.jpg'),
('Playa de Torradas', 'Una playa pequeña y tranquila, ideal para relajarse y disfrutar del mar en un entorno natural. Su potencia y corrientes suele ser alta y la calidad de sus olas también. La playa vecina de O Rías también es una opción pero ¡cuidado con sus fondos de roca!', 'https://www.google.com/maps/place/Praia+das+Torradas/@43.2910545,-8.745932,15.5z/data=!4m6!3m5!1s0xd2e90afbda69d79:0xb97bd4e31d4a15c4!8m2!3d43.2934409!4d-8.7389966!16s%2Fg%2F11y2z2lrl?entry=ttu', 'torradas.webp'),
('Playa de Malpica', 'Situada en el centro de Malpica, es una playa urbana con gran actividad pesquera y turística. Se está volviendo una playa clásica para surf y campeonatos, su derecha es una ola historica de esta zona. Con viento del sur mas de 1,5 de mar y marea baja siempre funciona', 'https://www.google.com/maps/search/praia+de+malpica/@43.3232654,-8.8223217,16z?entry=ttu', 'malpica.jpg'),
('Playa de Seaia', 'Conocida por su belleza natural y aguas cristalinas, es un lugar perfecto para disfrutar de la tranquilidad. Tiene una ola muy caprichosa, puede que solo salga una vez al año, la mejos ola de toda costa da morte', 'https://www.google.com/maps/place/Praia+de+Seaia/@43.328432,-8.8290265,18z/data=!3m1!4b1!4m6!3m5!1s0xd2e987b6e4f1967:0x822748d2f9f3bb4f!8m2!3d43.3281055!4d-8.8276618!16s%2Fg%2F11xr_8qb0?entry=ttu', 'seaia.jpg'),
('Playa de Beo', 'Una playa aislada con aguas limpias y un entorno natural impresionante, ideal para los amantes de la naturaleza zona de descanso para caminantes de el camino de los faros. Cuenta la leyenda que solo es surfeada por los locales. Cuidado con sus piedras y su bahía, es perfecta para "tostarse" al Sol', 'https://www.google.com/maps/place/Praia+de+Beo/@43.3233829,-8.8576431,15.5z/data=!4m6!3m5!1s0xd2ea2910c30b9c3:0x3b3213a27e5d23c3!8m2!3d43.3197451!4d-8.8466132!16s%2Fg%2F11xhjy8h4?entry=ttu', 'beo.jpg'),
('Playa de Niñóns', 'Un lugar escondido y poco frecuentado, perfecto para disfrutar de la calma y la belleza del litoral gallego. Cuenta con cuevas, sus mareas determinan la formología de la playa, es preciosa. Ola enorme y muy caprichosa, es auténtico "secret spot" pero es complicado conseguir verla romper bien, su calidad es legendaria ', 'https://www.google.com/maps/place/Praia+de+Ni%C3%B1%C3%B3ns/@43.2946541,-8.9075881,17z/data=!3m1!4b1!4m6!3m5!1s0xd2ea34facaa6093:0xa59f0c6ea9a7a786!8m2!3d43.2946388!4d-8.9053916!16s%2Fg%2F11yl6j5c6?entry=ttu', 'ninhons.jpg'),
('Playa de Valarés', 'Rodeada de un pinar y con arena fina, esta playa es ideal para pasar un día en familia, hacer camping o un picnic. Para surfearla necesita condiciones de invierno, unos 7 metros y viento del sur, su orillera es fuerte no apta para principiantes', 'https://www.google.com/maps/place/Praia+de+Balar%C3%A9s/@43.2414285,-8.945314,17z/data=!3m1!4b1!4m6!3m5!1s0xd2ebba2bd58ec67:0xe626f979d6b4a702!8m2!3d43.2412366!4d-8.9421291!16s%2Fg%2F11xkc5xfq?entry=ttu', 'valares.jpg'),
('Playa de Rebordelo', 'Con un paisaje espectacular y bien oculta. Apenas se ve afectada por el viento. Playa peleona, de olas potentes y corrientuda, es común ver a locales dominando sus olas. En verano suele masificarse, en invierno es una playa para surfistas experimentados', 'https://www.google.com/maps/place/Praia+de+Rebordelo/@43.2253163,-8.9683668,18z/data=!3m1!4b1!4m6!3m5!1s0xd2ebbcb3b841a0b:0x6a53afda2c177239!8m2!3d43.2248813!4d-8.9669754!16s%2Fg%2F11z4mp0bb?entry=ttu', 'rebor.jpg'),
('Playa de Laxe', 'Una playa muy popular en la Costa da Morte, conocida por su gran extensión y aguas tranquilas. Solo se permite pillar pocas veces al año, con alerta roja y temporales de mar terribles. Su orillera te destrozará, pero probar las olas de la mejor playa de toda costa da morte es toda una experiencia', 'https://www.google.com/maps/place/Praia+de+Laxe/@43.2189306,-9.0089024,15z/data=!3m1!4b1!4m6!3m5!1s0xd2eba104371e027:0xa8032a6ab8938ce2!8m2!3d43.2174107!4d-9.0008066!16s%2Fg%2F11xlbt7s5?entry=ttu', 'laxe.webp'),
('Playa de Soesto', 'Caracterizada por sus olas fuertes y su ambiente salvaje, es ideal para los surfistas y aventureros. Cuidado con sus corrientes, se recomienda tener un nivel alto de conocimiento marítimo para tratar de surfearla en invierno', 'https://www.google.com/maps/place/Praia+de+Soesto/@43.2165066,-9.0239767,16.25z/data=!4m6!3m5!1s0xd2eb0a5a8ffe1dd:0x7764ad33821a76ef!8m2!3d43.2158804!4d-9.0201452!16s%2Fg%2F11hzdr6h5j?entry=ttu', 'soesto.jpg'),
('Playa de Traba', 'Con un entorno natural protegido, esta playa ofrece un paisaje impresionante y una gran biodiversidad. Sus servicios son muchos y sus olas potentes. Ojo con los locales suelen quejarse de la masificación. S la visitas, respeta su entorno', 'https://www.google.com/maps/place/Praia+de+Traba/@43.1894077,-9.0516361,17z/data=!3m1!4b1!4m6!3m5!1s0xd2eb7262f88dbef:0x9127907555bafa83!8m2!3d43.1894005!4d-9.0493347!16s%2Fg%2F11xgr7rkb?entry=ttu', 'traba.jfif'),
('Playa de Reira', 'Parte del Parque Natural de las Islas Atlánticas, es una playa virgen con aguas cristalinas y arenas blancas de muy difícil acceso y con muy buenas olas. Se la conoce como "o inferniño"', 'https://www.google.com/maps/place/Praia+de+Reira/@43.1669286,-9.183213,17z/data=!3m1!4b1!4m6!3m5!1s0xd2eb4cbef15cc0d:0x9bb2abe1f810df10!8m2!3d43.1668697!4d-9.1807338!16s%2Fg%2F11xs0c5nf?entry=ttu', 'reira.jpg'),
('Playa de Nemiña', 'Popular entre los surfistas, esta playa ofrece olas grandes y un ambiente tranquilo y natural de las pocas playas de toda galicia cuyo offshore está mirando hacia el nordeste', 'https://www.google.com/maps/place/Praia+de+Nemi%C3%B1a/@43.0084629,-9.2649787,17z/data=!3m1!4b1!4m6!3m5!1s0xd2933c4a0724bc9:0xeeb79d8cbc45a850!8m2!3d43.0082895!4d-9.261582!16s%2Fg%2F11_kkhs2p?entry=ttu', 'nemina.jpg'),
('Playa Mar de Fora', 'Situada en el fin del mundo, esta playa ofrece paisajes espectaculares y es perfecta para caminatas y exploración. Solo apta para expertos, es una playa peligrosa.', 'https://www.google.com/maps/place/Praia+do+Mar+de+F%C3%B3ra/@42.9088361,-9.2777792,17z/data=!3m1!4b1!4m6!3m5!1s0xd292e840bbc6dd3:0x3cbbac8e2a1baa70!8m2!3d42.9093696!4d-9.2749202!16s%2Fg%2F11y00ym_k?entry=ttu', 'mar_de_fora.webp');