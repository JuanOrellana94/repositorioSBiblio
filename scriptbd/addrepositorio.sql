-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 23-08-2019 a las 03:23:30
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `repositorio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_documentos`
--

DROP TABLE IF EXISTS `tbl_documentos`;
CREATE TABLE IF NOT EXISTS `tbl_documentos` (
  `id_documento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) DEFAULT NULL,
  `doc_portada` varchar(450) DEFAULT 'img/portadapdf/defaultpdf.jpg',
  `descripcion` mediumtext,
  `tamanio` varchar(100) DEFAULT NULL,
  `tipo` varchar(150) DEFAULT NULL,
  `nombre_archivo` varchar(255) DEFAULT NULL,
  `tagdocumento` varchar(450) NOT NULL DEFAULT '---' COMMENT 'Contiene los tags de los documentos',
  PRIMARY KEY (`id_documento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `usucod` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo usuario: llave primaria de la tabla usuarios',
  `usuprinom` varchar(45) NOT NULL COMMENT 'Personal auxiliar',
  `ususegnom` varchar(45) DEFAULT NULL COMMENT 'Segundo nombre del usuario: campo no obligatorio',
  `usupriape` varchar(45) NOT NULL COMMENT 'Prrimer apellido del usuario: campo obligatorio',
  `ususegape` varchar(45) DEFAULT NULL COMMENT 'Segundo apellido del usuario: campo no obligatorio',
  `usucarnet` varchar(45) DEFAULT NULL COMMENT 'Carnet del usuario: Numero de carnet del personal o estudiantes de la institucion',
  `usucorre` varchar(250) DEFAULT NULL COMMENT 'Correo electronico del usuario: campo no obligatorio',
  `usuestcue` varchar(11) NOT NULL DEFAULT '0' COMMENT 'Estado de la cuenta de usuario: muestra si una cuenta esta logeada en el sistema 0=Activa 1=inactiva 2=Suspendida',
  `usuclave` varchar(250) NOT NULL COMMENT 'ContraseÃ±a del usuario: Clave para entrar al sistema ',
  `usuaccnom` varchar(45) NOT NULL COMMENT 'Usuario acceso nombre: nombre de acceso al sistema para el usuario',
  `usuanobac` varchar(11) DEFAULT NULL COMMENT 'AÃ±o de bachillerato del usuario: AÃ±o de bachillerato que realiza el usuario 1Â°,2Â°,3Â°',
  `ususecaul` varchar(15) DEFAULT NULL COMMENT 'Seccion del aula del usuario: Secciones establecidas por la institucion para sus bachillerato como 1Â° A,1Â°B etc.',
  `usutipbac` varchar(11) DEFAULT NULL COMMENT 'Tipo de bachillerato del usuario: los bachilleratos disponibles en la institucion 0=Comercio 1=Mecanica 2=Salud',
  `usunivel` varchar(11) NOT NULL COMMENT 'Usuario Nivel: neveles de acceso a los modulos del sistema 0=Administrador 1=Bibliotecario 2=Personal administrativo 3=Estudiante',
  `usucodbar` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`usucod`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usucod`, `usuprinom`, `ususegnom`, `usupriape`, `ususegape`, `usucarnet`, `usucorre`, `usuestcue`, `usuclave`, `usuaccnom`, `usuanobac`, `ususecaul`, `usutipbac`, `usunivel`, `usucodbar`) VALUES
(1, 'repositorio', 'repositorio', 'repositorio', 'repositorio', NULL, NULL, '0', '3057ee0df4ac24ad9e032b38a87124a6', 'Repositorio', NULL, NULL, NULL, '0', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
