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
    text TEXT,
    thumb VARCHAR(255)
);

-- Inserción de los datos en la tabla Articulos
INSERT INTO Articulos (id, titulo, extracto, text, thumb) VALUES
(1, 'Sesión de infarto', 'Un temporal trajo a Seaia unas olas trepidantes', 'Con el mal tiempo vienen las condiciones extremas y Seaia nunca defrauda cuando sale, siempre hay que ir a mirar esta playa porque sus olas son una delicia. Disfruta la foto de algo que se da muy pocas veces al año', 'seaiaolas.jpg'), 
(2, 'Ruta dos faros & surf', '¿Qué hago un día sin olas?', 'La ruta de los faros nos ofrece una perfecta opción para conocer Costa da Morte a fondo, con todas las calas y playas. Una de las mejores actividades de senderismo a nivel mundial', 'ruta.jpg'), 
(3, 'Razo sigue imbatible', 'Playa de Razo, una de las mecas del surf a nivel nacional', 'Toda la estructura de escuelas, cultura surf, tiendas, publicidad, furgonetas, etc. le ha salido muy bien al Concello de Carballo, encumbrando la playa de Razo y sus olas como destino de surfers, viajeros y hasta celebrities', 'razo.jpg'), 
(4, 'Se ha perdido Soesto', 'Soesto siempre salvaje, ahora lo es aún más', 'La que fue una de las playas más importantes de Galicia, y que aún es paraíso del surf, la siempre salvaje y peligrosa Soesto se ha vuelto caprichosa. Los locales indican que los fondos se han movido y hasta a ellos les cuesta conseguir condiciones épicas. Fuerte y salvaje, solo para atrevidos, siempre recomendada. Parece que últimamente apenas hace aparición', 'soesto.jpg'), 
(5, 'Costa Da Morte, Nordeste, Nemiña', 'Tres factores que van de la mano día tras día', 'La mejor playa con offshore de sur ya no es un secreto; la gente peregrina día tras día pues es muy fácil que las condiciones sean favorables. Los locales están cansados de la masificación y se están registrando altercados en la zona. ¿Se acabó el buen rollo en Nemiña?', 'nemina.jpg'), 
(6, '¿Verano épico en Rebordelo?', 'Los últimos reportes indican que Rebordelo puede brindar una gran temporada', 'El mar de ardora la puso en el mapa; ahora parece que las olas van a volver a ponerla. Se están reportando muchas olas de calidad con distintos tipos de condiciones en la playa de Rebordelo. ¡Ponle un ojo y cuidado con los locales! No son del todo amistosos', 'rebor.jpg'), 
(7, 'Vuelve el verano, vuelven los kooks', 'Todos sabemos que hay mucha gente que trata de aprender este deporte, y no saben dónde se meten...', 'Con el verano salen de las cuevas los miles y miles de novatos que llenan las playas y que tanto aborrecen los surfistas locales o los más experimentados, pero... ¿acaso no fuimos todos novatos algún día? La paciencia no siempre es una virtud en el agua y no saber dónde te metes puede generar una situación muy peligrosa. Pide información sobre la playa en la que vas a surfear y respeta a la gente en el agua', 'torradas.jpg');
-- Creación de la tabla Playas
CREATE TABLE Playas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    geolocalizacion TEXT,
    imagen VARCHAR(255),
    apikey VARCHAR(100)
);  
INSERT INTO Playas (nombre, descripcion, geolocalizacion, imagen) VALUES
('Razo', 'La Playa de Razo es una de las más extensas de la costa gallega, conocida por sus olas perfectas para el surf de aprendizage y su arena fina.', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23233.67865769957!2d-8.729211948978792!3d43.28892724034765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2e90f05ce55f85%3A0x66aa398b3e04469b!2sRazo%2C%2015107%20Carballo%2C%20La%20Coru%C3%B1a!5e0!3m2!1ses!2ses!4v1717513489610!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>','razo.jpg'),
('Torradas', 'Una playa pequeña y tranquila, ideal para relajarse y disfrutar del mar en un entorno natural. Su potencia y corrientes suele ser alta y la calidad de sus olas también. La playa vecina de O Rías también es una opción pero ¡cuidado con sus fondos de roca!', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2903.9914839629814!2d-8.741302423527545!3d43.29350002562044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2e90afbda69d79%3A0xb97bd4e31d4a15c4!2sPraia%20das%20Torradas!5e0!3m2!1ses!2ses!4v1717513936487!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'torradas.webp'),
('Malpica', 'Situada en el centro de Malpica, es una playa urbana con gran actividad pesquera y turística. Se está volviendo una playa clásica para surf y campeonatos, su derecha es una ola historica de esta zona. Con viento del sur mas de 1,5 de mar y marea baja siempre funciona', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2440.7304699207525!2d-8.816283388101018!3d43.32401279800083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2e9868876d57a3%3A0xe934005d5d7516f6!2sPraia%20de%20Area%20Maior!5e0!3m2!1ses!2ses!4v1717513977149!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'malpica.jpg'),
('Seaia', 'Conocida por su belleza natural y aguas cristalinas, es un lugar perfecto para disfrutar de la tranquilidad. Tiene una ola muy caprichosa, puede que solo salga una vez al año, la mejos ola de toda costa da morte', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1451.1613969062291!2d-8.829026511045193!3d43.32843399390651!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2e987b6e4f1967%3A0x822748d2f9f3bb4f!2sPraia%20de%20Seaia!5e0!3m2!1ses!2ses!4v1717514094684!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'seaia.jpg'),
('Beo', 'Una playa aislada con aguas limpias y un entorno natural impresionante, ideal para los amantes de la naturaleza zona de descanso para caminantes de el camino de los faros. Cuenta la leyenda que solo es surfeada por los locales. Cuidado con sus piedras y su bahía, es perfecta para "tostarse" al Sol', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2902.7305521197527!2d-8.84906597352648!3d43.31989967392344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2ea2910c30b9c3%3A0x3b3213a27e5d23c3!2sPraia%20de%20Beo!5e0!3m2!1ses!2ses!4v1717514162221!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'beo.jpg'),
('Niñóns', 'Un lugar escondido y poco frecuentado, perfecto para disfrutar de la calma y la belleza del litoral gallego. Cuenta con cuevas, sus mareas determinan la formología de la playa, es preciosa. Ola enorme y muy caprichosa, es auténtico "secret spot" pero es complicado conseguir verla romper bien, su calidad es legendaria ', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5807.874210338277!2d-8.909768965112304!3d43.29463880000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2ea34facaa6093%3A0xa59f0c6ea9a7a786!2zTmnDscOzbnMgQmVhY2g!5e0!3m2!1ses!2ses!4v1717514226461!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'ninhons.jpg'),
('Valarés', 'Rodeada de un pinar y con arena fina, esta playa es ideal para pasar un día en familia, hacer camping o un picnic. Para surfearla necesita condiciones de invierno, unos 7 metros y viento del sur, su orillera es fuerte no apta para principiantes', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2906.4765943706975!2d-8.945313973529704!3d43.241432378964966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2ebba2bd58ec67%3A0xe626f979d6b4a702!2sPraia%20de%20Balar%C3%A9s!5e0!3m2!1ses!2ses!4v1717514284101!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'valares.jpg'),
('Rebordelo', 'Con un paisaje espectacular y bien oculta. Apenas se ve afectada por el viento. Playa peleona, de olas potentes y corrientuda, es común ver a locales dominando sus olas. En verano suele masificarse, en invierno es una playa para surfistas experimentados', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1453.6226044833559!2d-8.968366761046212!3d43.22531829721714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2ebbcb3b841a0b%3A0x6a53afda2c177239!2sPraia%20de%20Rebordelo!5e0!3m2!1ses!2ses!4v1717514354117!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'rebor.jpg'),
('Laxe', 'Una playa muy popular en la Costa da Morte, conocida por su gran extensión y aguas tranquilas. Solo se permite pillar pocas veces al año, con alerta roja y temporales de mar terribles. Su orillera te destrozará, pero probar las olas de la mejor playa de toda costa da morte es toda una experiencia', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5815.098873139688!2d-9.00375255281268!3d43.21893880307823!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2eba104371e027%3A0xa8032a6ab8938ce2!2sPlaya%20de%20Laxe!5e0!3m2!1ses!2ses!4v1717514429885!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'laxe.webp'),
('Soesto', 'Caracterizada por sus olas fuertes y su ambiente salvaje, es ideal para los surfistas y aventureros. Cuidado con sus corrientes, se recomienda tener un nivel alto de conocimiento marítimo para tratar de surfearla en invierno', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2907.687197451774!2d-9.022451723530768!3d43.216049780594204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2eb0a5a8ffe1dd%3A0x7764ad33821a76ef!2sPraia%20de%20Soesto!5e0!3m2!1ses!2ses!4v1717514471861!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'soesto.jpg'),
('Traba', 'Con un entorno natural protegido, esta playa ofrece un paisaje impresionante y una gran biodiversidad. Sus servicios son muchos y sus olas potentes. Ojo con los locales suelen quejarse de la masificación. S la visitas, respeta su entorno', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2908.9570692997117!2d-9.051636123531893!3d43.18941163230332!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2eb7262f88dbef%3A0x9127907555bafa83!2sPraia%20de%20Traba!5e0!3m2!1ses!2ses!4v1717514523357!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'traba.jfif'),
('Reira', 'Parte del Parque Natural de las Islas Atlánticas, es una playa virgen con aguas cristalinas y arenas blancas de muy difícil acceso y con muy buenas olas. Se la conoce como "o inferniño"', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2910.028187563074!2d-9.183212973532813!3d43.16693248374487!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2eb4cbef15cc0d%3A0x9bb2abe1f810df10!2sPraia%20de%20Reira!5e0!3m2!1ses!2ses!4v1717514575637!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'reira.jpg'),
('Nemiña', 'Popular entre los surfistas, esta playa ofrece olas grandes y un ambiente tranquilo y natural de las pocas playas de toda galicia cuyo offshore está mirando hacia el nordeste', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5835.13218842769!2d-9.271630662771628!3d43.00847042497233!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2933c4a0724bc9%3A0xeeb79d8cbc45a850!2sPraia%20de%20Nemi%C3%B1a!5e0!3m2!1ses!2ses!4v1717515068682!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'nemina.jpg'),
('Mar_de_Fora', 'Situada en el fin del mundo, esta playa ofrece paisajes espectaculares y es perfecta para caminatas y exploración. Solo apta para expertos, es una playa peligrosa.', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2922.2940067564596!2d-9.277779223543453!3d42.90884000025435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd292e840bbc6dd3%3A0x3cbbac8e2a1baa70!2sPraia%20do%20Mar%20de%20F%C3%B3ra!5e0!3m2!1ses!2ses!4v1717515509007!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'mar_de_fora.webp');