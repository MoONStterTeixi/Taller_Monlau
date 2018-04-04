-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.29-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para tallerddbb
CREATE DATABASE IF NOT EXISTS `tallerddbb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `tallerddbb`;

-- Volcando estructura para tabla tallerddbb.material
CREATE TABLE IF NOT EXISTS `material` (
  `ref` varchar(50) NOT NULL,
  `type` varchar(50) DEFAULT '0',
  `marca` varchar(50) NOT NULL DEFAULT '0',
  `modelo` varchar(50) DEFAULT '0',
  `estado` varchar(50) NOT NULL DEFAULT '0',
  `lastupdate` date DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`ref`),
  KEY `FK__type` (`type`),
  CONSTRAINT `FK__type` FOREIGN KEY (`type`) REFERENCES `type` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla tallerddbb.material: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
INSERT INTO `material` (`ref`, `type`, `marca`, `modelo`, `estado`, `lastupdate`, `comment`) VALUES
	('1', 'Placa Base', 'Marca1', 'Modelo1', 'Bueno', '2018-03-22', 'Hay un trozo de la plackajsdkajsda que esta un poco araÃ±ado'),
	('233cv', 'Placa Base', 'Marca1', 'Modelo1', 'Malo', '2018-03-22', 'Se quedo un pin del procesador dentro.'),
	('3', 'Fuente', 'asdf', 'asd', 'a\r\nasd', '2019-03-01', 'a');
/*!40000 ALTER TABLE `material` ENABLE KEYS */;

-- Volcando estructura para tabla tallerddbb.type
CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla tallerddbb.type: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` (`id`, `name`) VALUES
	(3, 'Fuente'),
	(4, 'Grafica'),
	(1, 'Placa Base'),
	(2, 'Procesador');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;

-- Volcando estructura para tabla tallerddbb.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `username` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '0',
  `admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla tallerddbb.usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`username`, `password`, `admin`) VALUES
	('admin', '21232f297a57a5a743894a0e4a801fc3', 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
