/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `propiedades` (
  `idProp` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(60) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext,
  `habitaciones` int(1) DEFAULT NULL,
  `toilet` int(1) DEFAULT NULL,
  `garage` int(1) DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedorId` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProp`),
  KEY `vendedorId_idx` (`vendedorId`),
  CONSTRAINT `vendedorId` FOREIGN KEY (`vendedorId`) REFERENCES `vendedores` (`idvendedores`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

CREATE TABLE `usuarios` (
  `idUsuarios` int(1) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) DEFAULT NULL,
  `password` char(60) DEFAULT NULL,
  PRIMARY KEY (`idUsuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

CREATE TABLE `vendedores` (
  `idvendedores` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` int(10) DEFAULT NULL,
  PRIMARY KEY (`idvendedores`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `propiedades` (`idProp`, `titulo`, `precio`, `imagen`, `descripcion`, `habitaciones`, `toilet`, `garage`, `creado`, `vendedorId`) VALUES
(1, 'Casa de playa', 1000000.00, 'b0aa76c73d7acb95161e7faaf080a421.jpg', 'Casa en la playa de lujo, con una excelente vista del Mar AdriÃ¡tico. ', 3, 3, 2, '2022-08-14', 1);
INSERT INTO `propiedades` (`idProp`, `titulo`, `precio`, `imagen`, `descripcion`, `habitaciones`, `toilet`, `garage`, `creado`, `vendedorId`) VALUES
(2, 'Departamento en el centro de la ciudad', 650000.00, '15026e1ed1342d8912edfd3cae3a0d3a.jpg', 'Lujoso apartamento de 5 ambientes, con climatizacion central y cochera para dos vehiculos. Excelente vista. ', 3, 3, 2, '2022-11-01', 1);
INSERT INTO `propiedades` (`idProp`, `titulo`, `precio`, `imagen`, `descripcion`, `habitaciones`, `toilet`, `garage`, `creado`, `vendedorId`) VALUES
(3, 'Granja', 600000.00, '5fbb20e5c4a861dae7ac11b6413fc438.jpg', 'Una granja con terreno de 5 hectareas apta para cultivo, con acceso a curso de agua', 3, 3, 2, '2022-11-01', 1);
INSERT INTO `propiedades` (`idProp`, `titulo`, `precio`, `imagen`, `descripcion`, `habitaciones`, `toilet`, `garage`, `creado`, `vendedorId`) VALUES
(4, 'Cochera', 2000.00, NULL, 'Cochera amplia, en el centro de la ciudad.', 0, 0, 1, '2022-11-01', 2),
(5, 'Casita chiquita', 9.00, '95bab50d6cadee0d31dffe05a0f9d709.jpg', ' Casa pequeÃ±aCasa pequeÃ±aCasa pequeÃ±aCasa pequeÃ±aCasa pequeÃ±aCasa pequeÃ±aCasa pequeÃ±aCasa pequeÃ±aCasa pequeÃ±aCasa pequeÃ±aCasa pequeÃ±aCasa pequeÃ±aCasa pequeÃ±aCasa pequeÃ±a', 2, 2, 2, '2022-11-13', 2);

INSERT INTO `usuarios` (`idUsuarios`, `email`, `password`) VALUES
(1, 'admin@damianmediavilla.com', '$2y$10$mdwHSSivg9CO1CiCinxWqucRe5SwpJFznOJaVbSxz56aXFBG9v7e2');
INSERT INTO `usuarios` (`idUsuarios`, `email`, `password`) VALUES
(2, 'guest@damianmediavilla.com', '$2y$10$jEtP2fZHT6GecQsnjpV1gOxGKws9R1HDzp/mpc6wcowA302ahpHga');
INSERT INTO `usuarios` (`idUsuarios`, `email`, `password`) VALUES
(3, 'test@damianmediavilla.com', '$2y$10$naA4sFN9lV9NhbmZdnKNm.p3F14ghPrKaqNPVodjWaIxQKEJa0nby');
INSERT INTO `usuarios` (`idUsuarios`, `email`, `password`) VALUES
(4, 'info@damianmediavilla.com', '$2y$10$joB4DlQRZdjn0LSKDWfyFu3/isueRmEJ0o6iYH6ihh2NvtXVrKZDa');

INSERT INTO `vendedores` (`idvendedores`, `nombre`, `apellido`, `telefono`) VALUES
(1, 'Damian', 'Mediavilla', 99999999);
INSERT INTO `vendedores` (`idvendedores`, `nombre`, `apellido`, `telefono`) VALUES
(2, 'Toto', 'Torres', 222222222);
INSERT INTO `vendedores` (`idvendedores`, `nombre`, `apellido`, `telefono`) VALUES
(3, 'Pepe', 'Perez', 333333333);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;