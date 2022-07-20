-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-07-2022 a las 22:00:25
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `treninterurbano`
--
CREATE DATABASE IF NOT EXISTS `treninterurbano` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `treninterurbano`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `apellidos` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fechaNac` date DEFAULT NULL,
  `idTUsuario` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `telefono` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `calle` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `numExt` int(11) DEFAULT NULL,
  `numInt` int(11) DEFAULT NULL,
  `municipio` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `codigoPostal` int(11) DEFAULT NULL,
  `idServicio` int(11) NOT NULL,
  `idEscuela` int(11) DEFAULT NULL,
  `Status` int(11) NOT NULL,
  `Sexo` char(12) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `dateCreacion` datetime DEFAULT NULL,
  `dateModificacion` datetime DEFAULT NULL,
  `dateEliminacion` datetime DEFAULT NULL,
  `img` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nombre`, `apellidos`, `fechaNac`, `idTUsuario`, `email`, `telefono`, `calle`, `numExt`, `numInt`, `municipio`, `codigoPostal`, `idServicio`, `idEscuela`, `Status`, `Sexo`, `password`, `dateCreacion`, `dateModificacion`, `dateEliminacion`, `img`) VALUES
(1, 'Edwin', 'Flores Vargas', '2003-06-30', 2, 'al222110833@gmail.com', '+52 722109013', 'Carlos Hank Gonzales', 125, 0, 'Metepec', 52156, 1, 3, 0, 'M', 'floresedwin03**', NULL, NULL, NULL, 'https://tinyurl.com/23gwpgek'),
(2, 'Joana', 'Uribe Hermeneguildo', '2003-06-30', 2, 'al222110810@gmail.com', '+52 7291193146', 'Calle Olivos Colonia Simulacro', 123, 123, 'Santa María Atarasquillo', 52050, 1, 1, 0, 'F', '', NULL, NULL, NULL, 'https://tinyurl.com/2mfuzp4c'),
(3, 'Damian', 'Pedraza', '2001-05-30', 4, 'damian.pedraza@gmail.com', '+52 722154890', 'Teminal de Autobuses', 325, NULL, 'Toluca', 52158, 1, NULL, 1, 'M', 'damian2002**', NULL, NULL, NULL, 'https://tinyurl.com/2nm68wbo'),
(14, 'Alexis', 'Raymundo', '2002-03-10', 3, 'alexis.raymundo@gmail.com', '+52 72221895', 'Crisa', 547, NULL, 'Metepec', 52158, 1, NULL, 1, 'M', 'alexis202**', NULL, NULL, NULL, ''),
(15, 'Alin', 'Amparo', '2002-07-09', 3, 'alin.amparo@gmail.com', '+52 19726481', 'Sendero', 9275, NULL, 'Toluca', 52283, 1, 4, 0, 'F', 'alin202**', NULL, NULL, NULL, 'https://tinyurl.com/2nboqbeh'),
(16, 'Kevin', 'Salvador Gutierrez', '2003-06-15', 2, 'kevin.gutierrez@gmail.com', NULL, NULL, 250, NULL, 'San Mateo Atenco', NULL, 1, 5, 0, 'M', 'kevin2003**', NULL, NULL, NULL, 'https://tinyurl.com/2mebxr8c'),
(18, 'LINA MARÍA ', 'ZÚÑIGA RAMÍREZ', '2000-02-05', 1, 'lina.maria@gmail.com', '123', 'asdas', 254, NULL, 'Toluca de Lerdo', 52156, 1, NULL, 1, 'F', '2002', '2022-07-17 15:18:57', NULL, NULL, NULL),
(20, 'MARIA JOSÉ ', 'GARCÍA MORA', '2003-08-25', 2, 'maria.garcia@gmail.com', '123456789', '', 256, 5, 'San Mateo Atenco', 52156, 1, 1, 1, 'F', '2002', '2022-07-17 15:33:11', NULL, NULL, NULL),
(21, 'MARIA JOSÉ ', 'GARCÍA MORA', '2003-08-25', 2, 'maria.garcia@gmail.com', '123456789', '', 256, 5, 'San Mateo Atenco', 52156, 1, 1, 1, 'F', '2002', '2022-07-17 15:33:26', NULL, NULL, NULL),
(24, 'LAURA VIVIANA', 'DEL RÍO AYERBE', '2000-03-25', 1, 'laura.rio@gmail.com', '123456789', 'asdas', 254, 0, 'Toluca de Lerdo', 52156, 1, NULL, 1, 'F', '2002', '2022-07-17 15:59:38', NULL, NULL, NULL),
(25, 'NATALIA MELISSA', 'BARRERO FORERO', '2001-10-30', 2, 'natalia', '123456789', 'asdasdas', 854, 0, 'Toluca de Lerdo', 52158, 1, 4, 1, 'F', 'Natalia2001**', '2022-07-17 17:10:59', NULL, NULL, NULL),
(26, 'OSCAR FABIAN', 'CASTELLANOS ROJAS', '2005-05-25', 3, 'oscar.fabian@gmail.com', '123456789', 'adasd', 263, 0, 'Lerma', 52154, 1, NULL, 1, '', '2005', '2022-07-17 17:57:50', NULL, NULL, NULL),
(27, 'OSCAR FABIAN', 'CASTELLANOS ROJAS', '2005-08-26', 3, 'oscar.fabian@gmail.com', '123456789', 'asdasd', 239, 0, 'Lerma', 52157, 1, NULL, 1, 'M', 'Fabian2005**', '2022-07-17 18:00:04', NULL, NULL, NULL),
(28, 'PABLO', 'URIBE ANTIA', '2004-05-05', 3, 'pablo.uribe@gmail.com', '123456789', 'adasd', 985, 20, 'San Mateo Atenco', 52145, 1, NULL, 1, 'M', '25436**', '2022-07-17 18:08:41', NULL, NULL, NULL),
(29, 'SEBASTIAN ', 'BORDA MELGUIZO', '2003-06-08', 2, 'sebastian.borda@gmail.com', '123456789', 'adadasd', 25, 200, 'Santa Maria Atarasquillo', 52158, 1, 14, 1, 'M', '5851236', '2022-07-17 18:10:59', NULL, NULL, NULL),
(30, 'LAURA CAMILA', 'PUERTO CASTRO', '2000-08-06', 3, 'laura.puerto@gmail.com', '123456789', 'asdasdf adas', 36, 63, 'Tenango del Valle', 52176, 1, NULL, 1, 'M', '2005896**', '2022-07-17 18:22:08', NULL, NULL, NULL),
(31, 'LAURA FERNANDA', 'RODRÍGUEZ TORRES', '2002-09-12', 2, 'laura.rodriguez@gmail.com', '123456489', 'dasdasfadwq', 96, 587, 'Rancho Viejo San Dimas', 52163, 1, 12, 0, 'F', '2569800', '2022-07-17 18:23:51', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientestemp`
--

CREATE TABLE `clientestemp` (
  `id` int(11) NOT NULL,
  `Folio` int(11) NOT NULL,
  `teminalIn` int(11) NOT NULL,
  `terminalFin` int(11) NOT NULL,
  `Costo` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuelas`
--

CREATE TABLE `escuelas` (
  `idEscuela` int(11) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `Direccion` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `img` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `escuelas`
--

INSERT INTO `escuelas` (`idEscuela`, `Nombre`, `Direccion`, `email`, `password`, `img`) VALUES
(1, 'Universidad Tecnologica del Valle de Toluca', 'Carretera, Del Depto del Distrito Federal km 7.5, 52044 Santa María Atarasquillo, Méx.', '', '', 'https://i.postimg.cc/qB6DjLkR/UTVT-escudos2.png'),
(2, 'Escuela Preparatoria Oficial Num. 33', 'Aquiles Serdan 111, San Miguel,525140,Metepec,Mex', 'EPO33@gmail.com', 'Reclusorio33', ''),
(3, 'TECNOLOGICO DE ESTUDIOS SUPERIORES DE CHALCO', ' Carretera Federal México Cuautla s/n La Candelaria Tlapala, 56641 Chalco de Díaz Covarrubias, Méx.', 'teschalco@hotmail.com', 'tecChalco22', 'https://tinyurl.com/2o9bzo53'),
(4, 'TECNOLOGICO DE ESTUDIOS SUPERIORES DE JILOTEPEC\r\n', 'Carretera Jilotepec a Chapa de Mota km. 6.5, Ejido de Jilotepec, 54240 Jilotepec de Molina Enríquez', '', '', 'https://tinyurl.com/2m5vuv25'),
(5, 'TECNOLOGICO DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO\r\n', 'Carretera Federal Valle de Bravo Km 30, Ejido San Antonio Laguna, 51200 Valle de Bravo, Méx.', '', '', 'https://tinyurl.com/2zww88uu'),
(6, 'UNIDAD ACADEMICA DE CAPULHUAC-UTVT', 'Paraje Lomas de San Juan s/n, de, Méx.', '', '', ''),
(7, 'UNIDAD DE ESTUDIOS SUPERIORES ECATEPEC\r\n', 'Av Insurgentes, Fraccionamiento Las Americas, Las Americas, 55070 Ecatepec de Morelos, Méx.', '', '', ''),
(8, 'UNIDAD DE ESTUDIOS SUPERIORES LERMA\r\n', 'Cto de la Industria Pte S/N, Isidro Fabela, 52004 Lerma de Villada, Méx.', '', '', ''),
(9, 'UNIDAD DE ESTUDIOS SUPERIORES SULTEPEC', ' Carretera Toluca–Sultepec, Libramiento Sultepec–La Goleta S/N,, Barrio Camino Nacional, 51600 Sulte', '', '', ''),
(10, 'UNIDAD DE ESTUDIOS SUPERIORES TEPOTZOTLAN\r\n', 'Calle Av. del Convento S/N, El Trebol, 54614 Tepotzotlán, Méx.', '', '', ''),
(11, 'UNIDAD DE ESTUDIOS SUPERIORES TLATLAYA\r\n', 'Carretera Los Cuervos-Arcelia km 35, San Pedro, Limón, 51585 Tlatlaya, Méx.', '', '', ''),
(12, 'UNIVERSIDAD DIGITAL DEL ESTADO DE MEXICO PLANTEL UNAM\r\n', 'Av. José María Morelos Pte. 905, Barrio de la Merced, 50080 Toluca de Lerdo, Méx.', '', '', ''),
(13, 'UNIVERSIDAD INTERCULTURAL DEL ESTADO DE MEXICO\r\n', 'Lib. Francisco Villa S/N, Col. Centro, 50640 San Felipe del Progreso, Méx.', '', '', ''),
(14, 'TECNOLOGICO DE ESTUDIOS SUPERIORES DE JILOTEPEC\r\n', 'Carretera Jilotepec a Chapa de Mota km. 6.5, Ejido de Jilotepec, 54240 Jilotepec de Molina Enríquez', '', '', ''),
(15, 'TECNOLOGICO DE ESTUDIOS SUPERIORES DE VALLE DE BRAVO\r\n', 'Carretera Federal Valle de Bravo Km 30, Ejido San Antonio Laguna, 51200 Valle de Bravo, Méx.', '', '', ''),
(16, 'UNIVERSIDAD ESTATAL DEL VALLE DE TOLUCA', 'Acueducto del Alto Lerma No.183 Col C.P, 52756 Pedregal de Guadalupe Hidalgo, Méx.', '', '', ''),
(17, 'UNIDAD DE ESTUDIOS SUPERIORES ECATEPEC\r\n', 'Av Insurgentes, Fraccionamiento Las Americas, Las Americas, 55070 Ecatepec de Morelos, Méx.', '', '', ''),
(18, 'UNIDAD DE ESTUDIOS SUPERIORES JIQUIPILCO', 'Km.1, Carretera San Felipe Santiago, 50800 Méx.', '', '', ''),
(19, 'UNIDAD DE ESTUDIOS SUPERIORES TEMOAYA\n', 'Domicilio Conocido S/N, San Diego Alcalá, 50850 Temoaya, Méx', '', '', ''),
(20, 'UNIDAD DE ESTUDIOS SUPERIORES TEPOTZOTLAN\r\n', 'Calle Av. del Convento S/N, El Trebol, 54614 Tepotzotlán, Méx.', '', '', ''),
(21, 'UNIDAD DE ESTUDIOS SUPERIORES TLATLAYA\r\n', 'Carretera Los Cuervos-Arcelia km 35, San Pedro, Limón, 51585 Tlatlaya, Méx.', '', '', ''),
(22, 'UNIVERSIDAD DIGITAL DEL ESTADO DE MEXICO PLANTEL UNAM\r\n', 'Av. José María Morelos Pte. 905, Barrio de la Merced, 50080 Toluca de Lerdo, Méx.', '', '', ''),
(23, 'UNIVERSIDAD INTERCULTURAL DEL ESTADO DE MEXICO\r\n', 'Lib. Francisco Villa S/N, Col. Centro, 50640 San Felipe del Progreso, Méx.', '', '', ''),
(24, 'UNIVERSIDAD TECNOLOGICA DE ZINACANTEPEC', 'Av. Libramiento Universidad 106, San Bartolo el Llano, Zinacantepec, 51361 Méx.', '', '', ''),
(25, 'UNIVERSIDAD TECNOLOGICA DEL SUR DEL ESTADO DE MEXICO\r\n', 'Carr Tejupilco-Amatepec Kilómetro 12, 51400 Tejupilco de Hidalgo, Méx.', '', '', ''),
(26, 'UNIVERSIDAD TECNOLOGICA FIDEL VELAZQUEZ\r\n', 'Avenida Emiliano Zapata S/N, El Trafico, 54400 Villa Nicolás Romero, Méx.', '', '', ''),
(27, 'UNIVERSIDAD DIGITAL DEL ESTADO DE MEXICO PLANTEL UPAEP\r\n', 'AVENIDA JOSE MARIA MORELOS	905	TOLUCA	TOLUCA DE LERDO\r\n', '', '', ''),
(28, 'UNIVERSIDAD DIGITAL DEL ESTADO DE MEXICO PLANTEL UDEMEX\r\n', 'Av. Morelos #905 Col. La mereced, Toluca, Estado de México. CP. 50080', '', '', ''),
(29, 'UNIVERSIDAD DIGITAL DEL ESTADO DE MEXICO PLANTEL U. DE G.\r\n', 'Av. José María Morelos Pte. 905, Barrio de la Merced, 50080 Toluca de Lerdo, Méx.', '', '', ''),
(30, 'UNIVERSIDAD DIGITAL DEL ESTADO DE MEXICO  PLANTEL ETAC\r\n', 'Av. José María Morelos Pte. 905, Barrio de la Merced, 50080 Toluca de Lerdo, Méx.', '', '', ''),
(31, 'UNIDAD DE ESTUDIOS SUPERIORES TULTITLAN\r\n', 'San Antonio s/n, Villa Esmeralda, 54910 Tultitlán de Mariano Escobedo, Méx.', '', '', ''),
(32, 'TECNOLOGICO DE ESTUDIOS SUPERIORES DE SAN FELIPE DEL PROGRESO\r\n', 'Avenida Instituto Tecnológico S/N, Ejido, Tecnológico, 50640 San Felipe del Progreso, Méx.', '', '', ''),
(33, 'TECNOLOGICO DE ESTUDIOS SUPERIORES DEL ORIENTE DEL ESTADO DE MEXICO\r\n', 'TECNOLOGICO DE ESTUDIOS SUPERIORES DEL ORIENTE DEL ESTADO DE MEXICO\r\n', '', '', ''),
(34, 'No pertenece', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `idFactura` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `Producto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `costo` double(10,2) DEFAULT NULL,
  `fechaC` datetime DEFAULT NULL,
  `idTicket` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `dateProceso` datetime DEFAULT NULL,
  `dateAprobada` datetime DEFAULT NULL,
  `dateRechazada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`idFactura`, `idCliente`, `Producto`, `costo`, `fechaC`, `idTicket`, `status`, `dateProceso`, `dateAprobada`, `dateRechazada`) VALUES
(1, 2, 'Boleto', 50.00, '2022-07-14 21:36:06', 35, 3, '2022-07-20 14:25:33', '2022-07-20 14:27:03', NULL),
(3, 15, 'Boleto 12315', 250.00, '2022-07-14 22:41:00', 11, 2, '2022-07-20 01:24:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `idHorario` int(11) NOT NULL,
  `TiempoE` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`idHorario`, `TiempoE`) VALUES
(1, '5:00 - 6:00'),
(2, '6:00 - 7:00'),
(3, '7:00 - 8:00'),
(4, '8:00 - 9:00'),
(5, '9:00 - 10:00'),
(6, '10:00 - 11:00'),
(7, '11:00 - 12:00'),
(8, '12:00 - 13:00'),
(9, '13:00 - 14:00'),
(10, '14:00 - 15:00'),
(11, '15:00 - 16:00'),
(12, '16:00 - 17:00'),
(13, '17:00 - 18:00'),
(14, '18:00 - 19:00'),
(15, '19:00 - 20:00'),
(16, '20:00 - 21:00'),
(17, '21:00 - 22:00'),
(18, '22:00 - 23:00'),
(19, '23:00 - 00:00'),
(20, '00:00 - 00:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `id_transaccion` varchar(20) COLLATE utf8_bin NOT NULL,
  `fecha` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `idTicket` varchar(11) COLLATE utf8_bin NOT NULL,
  `description` varchar(100) COLLATE utf8_bin NOT NULL,
  `codigo_qr` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id_pago`, `id_transaccion`, `fecha`, `status`, `email`, `id_cliente`, `total`, `idTicket`, `description`, `codigo_qr`) VALUES
(16, '4GB361124G118922H', '2022-07-19 17:53:40', 'COMPLETED', 'sb-hxpph18999753@personal.example.com', 2, '18.00', '42', 'No. Operacion 289088, Boleto tipo Estudiante', 'QR_289088.png'),
(17, '5NY15843J5294864B', '2022-07-19 17:57:24', 'COMPLETED', 'sb-hxpph18999753@personal.example.com', 2, '75.00', '4', 'No. Operacion 232450, Boleto tipo Estudiante', 'QR_232450.png'),
(18, '7BH756890V4924535', '2022-07-19 18:01:35', 'COMPLETED', 'sb-hxpph18999753@personal.example.com', 1, '24.00', '41', 'No. Operacion 242873, Boleto tipo Estudiante', 'QR_242873.png'),
(19, '01J84995NY729871D', '2022-07-19 20:27:52', 'COMPLETED', 'sb-hxpph18999753@personal.example.com', 2, '45.00', '13', 'No. Operacion 281089, Boleto tipo Estudiante', 'QR_281089.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `idRuta` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `idTerminales` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`idRuta`, `nombre`, `idTerminales`) VALUES
(1, 'Zinacantepec - Tecnologico', '2036587423 - 2048962231'),
(2, 'Zinacantepec - Pino Suárez', '2036587423 - 2036578952'),
(3, 'Zinacantepec - San Mateo Atenco', '2036587423 - 2068742984'),
(4, 'Zinacantepec - Santa Fe', '2036587423 - 2032548956'),
(5, 'Zinacantepec - Observatorio', '2036587423 - 2031254789'),
(6, 'Pino Suárez - Tecnologico', '2036578952 - 2048962231'),
(7, 'Pino Suárez - San Mateo Atenco', '2036578952 - 2068742984'),
(8, 'Pino Suárez - Santa Fe	\r\n', '2036578952 - 2032548956'),
(9, 'Pino Suárez - Observatorio\r\n', '2036578952 - 2031254789'),
(10, 'Pino Suárez - Zinacantepec\r\n', '2036578952 - 2036587423'),
(11, 'Tecnologico - San Mateo Atenco\r\n', '2048962231 - 2068742984'),
(12, 'Tecnologico - Santa Fe\r\n', '2048962231 - 2032548956'),
(13, 'Tecnologico - Observatorio\r\n', '2048962231 - 2031254789'),
(14, 'Tecnologico - Pino Suárez\r\n', '2048962231 - 2036578952'),
(15, 'Tecnologico - Zinacantepec\r\n', '2048962231 - 2036587423'),
(16, 'San Mateo Atenco - Santa Fe\r\n', '2068742984 - 2032548956'),
(17, 'San Mateo Atenco - Observatorio\r\n', '2068742984 - 2031254789'),
(18, 'San Mateo Atenco - Tecnologico\r\n', '2068742984 - 2048962231'),
(19, 'San Mateo Atenco - Pino Suárez \r\n', '2068742984 - 2036578952'),
(20, 'San Mateo Atenco - Zinacantepec\r\n', '2068742984 - 2036587423'),
(21, 'Santa Fe - Observatorio\r\n', '2032548956 - 2031254789'),
(22, 'Santa Fe - San Mateo Atenco\r\n', '2032548956 - 2068742984'),
(23, 'Santa Fe - Tecnologico\r\n', '2032548956 - 2048962231'),
(24, 'Santa Fe - Pino Suárez \r\n', '2032548956 - 2036578952'),
(25, 'Santa Fe - Zinacantepec\r\n', '2032548956 - 2036587423'),
(26, 'Observatorio - Santa Fe\r\n', '2031254789 - 2032548956'),
(27, 'Observatorio - San Mateo Atenco\r\n', '2031254789 - 2068742984'),
(28, 'Observatorio - Tecnologico\r\n', '2031254789 - 2048962231'),
(29, 'Observatorio - Pino Suárez\r\n', '2031254789 - 2036578952'),
(30, 'Observatorio - Zinacantepec\r\n', '2031254789 - 2036587423');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idServicio` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idServicio`, `nombre`) VALUES
(1, 'Online'),
(2, 'Ventanilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `idTicket` int(11) NOT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `matricula` int(11) DEFAULT NULL,
  `fechaC` date DEFAULT NULL,
  `fechaV` date DEFAULT NULL,
  `costo` double(10,2) DEFAULT NULL,
  `N_Operacion` int(11) DEFAULT NULL,
  `idRuta` int(11) DEFAULT NULL,
  `idHorario` int(11) DEFAULT NULL,
  `dateModificacion` datetime DEFAULT NULL,
  `dateEliminacion` datetime DEFAULT NULL,
  `dateCreacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`idTicket`, `idCliente`, `matricula`, `fechaC`, `fechaV`, `costo`, `N_Operacion`, `idRuta`, `idHorario`, `dateModificacion`, `dateEliminacion`, `dateCreacion`) VALUES
(0, 16, NULL, '2022-07-15', '2022-07-15', 65.00, 266042, 5, NULL, '2022-07-19 19:43:56', NULL, '2022-07-15 00:00:00'),
(4, 2, 548932179, '2022-06-15', '2022-06-15', 250.00, 232450, 15, NULL, NULL, NULL, NULL),
(5, 15, 523321565, '2022-07-08', '2022-07-08', 250.00, 23658, 2, NULL, NULL, NULL, NULL),
(6, 14, 548932179, '2022-07-09', '2022-07-09', 300.00, 232698, 7, NULL, NULL, NULL, NULL),
(7, 14, NULL, '2022-07-12', '2022-07-12', 250.00, 281040, 18, NULL, NULL, NULL, NULL),
(8, 1, NULL, '2022-07-12', '2022-07-12', 250.00, 281088, 18, NULL, NULL, NULL, NULL),
(9, 16, NULL, '2022-07-12', '2022-07-12', 250.00, 281074, 18, NULL, NULL, NULL, NULL),
(10, 14, NULL, '2022-07-12', '2022-07-12', 250.00, 281085, 18, NULL, NULL, NULL, NULL),
(11, 15, NULL, '2022-07-12', '2022-07-12', 250.00, 281022, 18, NULL, NULL, NULL, NULL),
(12, 14, NULL, '2022-07-12', '2022-07-12', 250.00, 281041, 18, NULL, NULL, NULL, NULL),
(13, 2, NULL, '2022-07-13', '2022-07-13', 150.00, 281089, 9, NULL, '2022-07-11 23:46:38', NULL, '2022-07-13 00:00:00'),
(14, 15, NULL, '2022-07-12', '2022-07-12', 250.00, 281055, 18, NULL, NULL, NULL, NULL),
(15, 14, NULL, '2022-07-12', '2022-07-12', 250.00, 281047, 18, NULL, NULL, NULL, NULL),
(30, 2, NULL, '2022-07-13', '2022-07-13', 25.00, 268239, 9, NULL, NULL, NULL, '2022-07-12 07:18:15'),
(31, 14, NULL, '2022-07-29', '2022-07-29', 20.00, 283609, 13, NULL, NULL, NULL, '2022-07-12 07:19:33'),
(32, 2, NULL, '2022-08-03', '2022-07-24', 25.00, 300886, 14, NULL, '2022-07-14 15:39:28', NULL, '2022-08-03 00:00:00'),
(33, 15, NULL, '2022-07-17', '2022-07-17', 80.00, 273793, 10, NULL, '2022-07-14 20:56:23', NULL, '2022-07-17 00:00:00'),
(35, 2, NULL, '2022-07-14', '2022-07-14', 80.00, 280477, 5, NULL, '2022-07-14 21:02:06', NULL, '2022-07-14 21:01:48'),
(36, 2, NULL, '2022-07-26', '2022-07-26', 50.00, 293706, 18, NULL, NULL, NULL, '2022-07-14 22:49:07'),
(37, 3, NULL, '2022-07-17', '2022-07-17', 25.00, 274060, 17, 16, NULL, NULL, '2022-07-17 13:19:44'),
(38, 15, NULL, '2022-07-20', '2022-07-20', 50.00, 318290, 7, 2, NULL, NULL, '2022-07-17 13:21:02'),
(39, 16, NULL, '2022-07-18', '2022-07-18', 52.00, 318280, 12, 15, NULL, NULL, '2022-07-17 13:21:23'),
(40, 2, NULL, '2022-07-31', '2022-07-31', 50.00, 287059, 17, 8, NULL, NULL, '2022-07-17 13:27:32'),
(41, 1, NULL, '2022-07-17', '2022-07-17', 80.00, 242873, 9, 9, NULL, NULL, '2022-07-17 13:39:10'),
(42, 2, NULL, '2022-07-18', '2022-07-18', 60.00, 289088, 13, 15, NULL, NULL, '2022-07-17 13:43:37'),
(43, 2, NULL, '2022-07-25', '2022-07-25', 250.00, 279117, 14, 14, NULL, NULL, '2022-07-18 23:39:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idTUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idTUsuario`, `nombreUsuario`) VALUES
(1, 'Trabajador'),
(2, 'Estudiante'),
(3, 'Usuario'),
(4, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `matricula` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `apellidoPat` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `idTUsuario` int(11) DEFAULT NULL,
  `fechaNac` date DEFAULT NULL,
  `emai` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `telefono` varchar(14) COLLATE utf8_bin DEFAULT NULL,
  `calle` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `numExt` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `numInt` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `municipio` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `seguroSocial` int(11) DEFAULT NULL,
  `codigoPostal` int(11) DEFAULT NULL,
  `Sexo` char(12) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `dateCreacion` datetime DEFAULT NULL,
  `dateModificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`matricula`, `nombre`, `apellidoPat`, `idTUsuario`, `fechaNac`, `emai`, `telefono`, `calle`, `numExt`, `numInt`, `municipio`, `seguroSocial`, `codigoPostal`, `Sexo`, `password`, `dateCreacion`, `dateModificacion`) VALUES
(100523698, 'LIZETH DANIELA', 'AGUILAR MORALEZ', 1, '2003-06-30', 'aguilar.daniela@gmail.com', '+52 7222547517', '101 Av Vicente Guerrero Nte, San Mateo Mexicaltzingo, Estado de México', '101', NULL, 'Mexicaltzingo', 521479654, 52180, 'F', '123456789', NULL, NULL),
(245879630, 'CAMILO', 'VILLAMIZAR ARISTIZABAL', 1, '1993-06-05', 'CAMILO.VILLAMIZAR@gmail.com', '+52 729123456', 'wqdasdasdasd', '236', NULL, 'Metepec', 231312356, 58248, 'M', 'Camilo86**', NULL, NULL),
(245879632, 'ADRIANA CAROLINA', 'HERNANDEZ MONTERROZA', 1, '1995-05-09', 'adriana.hernandez@gmail.com', '+52 14876567', 'adasdarfafgaf', '5789', NULL, 'Santiago', 578965478, 52147, 'F', 'Adriana254**', NULL, NULL),
(521569874, 'MARIA JOSÉ', 'GARCÍA MORA', 1, '1999-02-25', 'maria.jose@gmail.com', '+52 12345648', 'adafaw432wewdas', '854', NULL, 'San Dimas', 521587963, 52147, 'F', 'MariaJOSE**', NULL, NULL),
(523321565, 'ALEXANDER', 'CARVAJAL VARGAS', 1, '2000-02-03', 'ALEXANDER.CARVAJAL@gmail.com', '+52 213548436', 'qwasfas fas', '1236', '0', 'Toluca', 254238684, 52483, 'M', 'alexander123**', NULL, NULL),
(548796547, 'MARCELA', 'GARCIA RUEDA', 1, '1993-06-15', 'MARCELA.RUEDA@gmail.com', '+52 1235489', 'jgasdhjkasd', '895', NULL, 'Tenancingo', 578965412, 52156, 'F', '123456789', NULL, NULL),
(548932179, 'JAQUELINE', 'DAMIAN PEDRAZA', 1, '2003-06-30', 'Jaqueline.Damian@gmail.com', NULL, 'Cuauhtémoc 28, Santiaguito', '126', NULL, 'Metepec', 215968712, 52140, '', '', NULL, NULL),
(598742369, 'NATALIA', 'BUITRAGO CONTRERAS', 1, '1999-06-20', 'natalia.contreras.12@gmail.com', '+52 458968741', 'qwradagfawfasd', '254', '120', 'Aculco', 524587412, 52496, 'F', 'natalia2036**', NULL, NULL),
(785496321, 'LAURA FERNANDA', 'RODRÍGUEZ TORRES', 1, '1993-06-10', 'laura.torres@gmail.com', '+52 125879630', 'asdafawqweqw', '5248', NULL, 'Lerma', 524789632, 52489, 'F', 'lauraTorres1993', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD KEY `idServicio` (`idServicio`) USING BTREE,
  ADD KEY `idTUsuario` (`idTUsuario`) USING BTREE,
  ADD KEY `idEscuela` (`idEscuela`) USING BTREE;

--
-- Indices de la tabla `clientestemp`
--
ALTER TABLE `clientestemp`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  ADD PRIMARY KEY (`idEscuela`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`idFactura`),
  ADD UNIQUE KEY `idTicket` (`idTicket`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`idHorario`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`idRuta`),
  ADD KEY `idTerminales` (`idTerminales`) USING BTREE,
  ADD KEY `idTerminales_2` (`idTerminales`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idServicio`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`idTicket`),
  ADD KEY `matricula` (`matricula`) USING BTREE,
  ADD KEY `idCliente` (`idCliente`) USING BTREE,
  ADD KEY `idRuta` (`idRuta`) USING BTREE,
  ADD KEY `idHorario` (`idHorario`) USING BTREE;

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idTUsuario`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `idTUsuario` (`idTUsuario`),
  ADD KEY `nombreUsuario` (`idTUsuario`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `clientestemp`
--
ALTER TABLE `clientestemp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  MODIFY `idEscuela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idHorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `idRuta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `idTicket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idTUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idTUsuario`) REFERENCES `tipousuario` (`idTUsuario`),
  ADD CONSTRAINT `cliente_ibfk_4` FOREIGN KEY (`idServicio`) REFERENCES `servicio` (`idServicio`),
  ADD CONSTRAINT `cliente_ibfk_5` FOREIGN KEY (`idEscuela`) REFERENCES `escuelas` (`idEscuela`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`idTicket`) REFERENCES `tickets` (`idTicket`),
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idCliente`);

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`idRuta`) REFERENCES `rutas` (`idRuta`),
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`matricula`) REFERENCES `trabajadores` (`matricula`),
  ADD CONSTRAINT `tickets_ibfk_4` FOREIGN KEY (`idHorario`) REFERENCES `horarios` (`idHorario`);

--
-- Filtros para la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD CONSTRAINT `trabajadores_ibfk_1` FOREIGN KEY (`idTUsuario`) REFERENCES `tipousuario` (`idTUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
