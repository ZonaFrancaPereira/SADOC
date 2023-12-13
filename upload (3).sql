-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2023 a las 20:50:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `upload`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acpm`
--

CREATE TABLE `acpm` (
  `id_consecutivo` int(11) NOT NULL,
  `origen_acpm` text DEFAULT NULL,
  `fuente_acpm` enum('AI','AE','Otros') DEFAULT NULL,
  `descripcion_fuente` text DEFAULT NULL,
  `tipo_acpm` enum('AC','AP','AM') DEFAULT NULL,
  `fecha_acpm` timestamp NULL DEFAULT current_timestamp(),
  `descripcion_acpm` text DEFAULT NULL,
  `causa_acpm` text DEFAULT NULL,
  `nc_similar` enum('Si','No') DEFAULT NULL,
  `descripcion_nsc` text DEFAULT NULL,
  `correccion_acpm` text DEFAULT NULL,
  `fecha_correccion` date DEFAULT NULL,
  `estado_acpm` enum('Abierta','Proceso','Cerrada','Rechazada','Verificacion') DEFAULT NULL,
  `riesgo_acpm` enum('Si','No') DEFAULT NULL,
  `justificacion_riesgo` text DEFAULT NULL,
  `cambios_sig` enum('Si','No') DEFAULT NULL,
  `justificacion_sig` text DEFAULT NULL,
  `conforme_sig` enum('Si','No') DEFAULT NULL,
  `justificacion_conforme_sig` text DEFAULT NULL,
  `fecha_estado` date DEFAULT NULL,
  `fecha_finalizacion` date DEFAULT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `acpm`
--

INSERT INTO `acpm` (`id_consecutivo`, `origen_acpm`, `fuente_acpm`, `descripcion_fuente`, `tipo_acpm`, `fecha_acpm`, `descripcion_acpm`, `causa_acpm`, `nc_similar`, `descripcion_nsc`, `correccion_acpm`, `fecha_correccion`, `estado_acpm`, `riesgo_acpm`, `justificacion_riesgo`, `cambios_sig`, `justificacion_sig`, `conforme_sig`, `justificacion_conforme_sig`, `fecha_estado`, `fecha_finalizacion`, `id_usuario_fk`) VALUES
(7, '            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi repudiandae earum iusto eligendi ad modi minus ipsa quibusdam voluptatibus aliquam unde harum dolorem tenetur dicta mollitia, rem veritatis reprehenderit sapiente.\n', 'AI', '            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi repudiandae earum iusto eligendi ad modi minus ipsa quibusdam voluptatibus aliquam unde harum dolorem tenetur dicta mollitia, rem veritatis reprehenderit sapiente.', 'AC', '2023-12-05 19:22:21', 'PRUEBA            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi repudiandae earum iusto eligendi ad modi minus ipsa quibusdam voluptatibus aliquam unde harum dolorem tenetur dicta mollitia, rem veritatis reprehenderit sapiente.\n', 'PRUEBA            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi repudiandae earum iusto eligendi ad modi minus ipsa quibusdam voluptatibus aliquam unde harum dolorem tenetur dicta mollitia, rem veritatis reprehenderit sapiente.\n', 'No', '            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi repudiandae earum iusto eligendi ad modi minus ipsa quibusdam voluptatibus aliquam unde harum dolorem tenetur dicta mollitia, rem veritatis reprehenderit sapiente.', 'PRUEBA            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi repudiandae earum iusto eligendi ad modi minus ipsa quibusdam voluptatibus aliquam unde harum dolorem tenetur dicta mollitia, rem veritatis reprehenderit sapiente.\n', '2023-12-05', 'Abierta', 'No', 'es confirm...', 'Si', 'sssss', 'Si', '            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi repudiandae earum iusto eligendi ad modi minus ipsa quibusdam voluptatibus aliquam unde harum dolorem tenetur dicta mollitia, rem veritatis reprehenderit sapiente.\n', '2023-12-05', '2023-11-01', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acpm_rechazada`
--

CREATE TABLE `acpm_rechazada` (
  `id_rechazada` int(11) NOT NULL,
  `fecha_rechazo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `descripcion_rechazo` text NOT NULL,
  `tipo_movimiento` enum('Correcion','Accion') NOT NULL,
  `id_acpm_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `acpm_rechazada`
--

INSERT INTO `acpm_rechazada` (`id_rechazada`, `fecha_rechazo`, `descripcion_rechazo`, `tipo_movimiento`, `id_acpm_fk`) VALUES
(2, '2023-12-13 18:54:49', 'Analisis de causa mal hecho', 'Correcion', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades_acpm`
--

CREATE TABLE `actividades_acpm` (
  `id_actividad` int(11) NOT NULL,
  `fecha_actividad` date NOT NULL,
  `descripcion_actividad` text NOT NULL,
  `tipo_actividad` enum('Correccion','Actividad') NOT NULL,
  `estado_actividad` enum('Completa','Incompleta') NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_acpm_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `actividades_acpm`
--

INSERT INTO `actividades_acpm` (`id_actividad`, `fecha_actividad`, `descripcion_actividad`, `tipo_actividad`, `estado_actividad`, `id_usuario_fk`, `id_acpm_fk`) VALUES
(14, '2023-11-08', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Impedit laboriosam mollitia cupiditate? Illo ullam corporis tempora nam accusantium quis nihil minus consectetur alias. Rem at quo eveniet maxime consequuntur libero?\n', 'Correccion', 'Incompleta', 2, 7),
(15, '2023-11-14', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam impedit quia iusto, perspiciatis est ut odit commodi in voluptates temporibus nostrum eveniet totam perferendis eaque facilis animi repellendus nobis enim.\n', 'Actividad', 'Completa', 2, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activos`
--

CREATE TABLE `activos` (
  `id_activo` int(11) NOT NULL,
  `fecha_asignacion` datetime NOT NULL,
  `nombre_articulo` varchar(300) NOT NULL,
  `descripcion_articulo` text NOT NULL,
  `modelo_articulo` varchar(200) DEFAULT NULL,
  `referencia_articulo` varchar(200) DEFAULT NULL,
  `marca_articulo` varchar(300) DEFAULT NULL,
  `tipo_articulo` text DEFAULT NULL,
  `ip` varchar(30) NOT NULL,
  `windows` text NOT NULL,
  `office` varchar(300) NOT NULL,
  `factura_office` text NOT NULL,
  `lugar_articulo` text DEFAULT NULL,
  `observaciones_articulo` text DEFAULT NULL,
  `numero_factura` float DEFAULT NULL,
  `fecha_garantia` date DEFAULT NULL,
  `valor_articulo` float DEFAULT NULL,
  `condicion_articulo` text DEFAULT NULL,
  `id_proveedor_fk` int(11) DEFAULT NULL,
  `descripcion_proveedor` text DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `estado_activo` enum('Activo','Inactivo','Rentado','') NOT NULL,
  `recurso_tecnologico` enum('Si','No','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `activos`
--

INSERT INTO `activos` (`id_activo`, `fecha_asignacion`, `nombre_articulo`, `descripcion_articulo`, `modelo_articulo`, `referencia_articulo`, `marca_articulo`, `tipo_articulo`, `ip`, `windows`, `office`, `factura_office`, `lugar_articulo`, `observaciones_articulo`, `numero_factura`, `fecha_garantia`, `valor_articulo`, `condicion_articulo`, `id_proveedor_fk`, `descripcion_proveedor`, `id_usuario_fk`, `estado_activo`, `recurso_tecnologico`) VALUES
(1001, '2023-12-01 00:00:00', 'REPISAS DECORATIVAS', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1002, '2023-12-01 00:00:00', 'REPISAS DECORATIVAS', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1003, '2023-12-01 00:00:00', 'ESCRITORIO EN L', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1004, '2023-12-01 00:00:00', 'COMPUTADOR PORTATIL MAC', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'Si'),
(1005, '2023-12-01 00:00:00', 'BASE DE PORTATIL', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTEMA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1006, '2023-12-01 00:00:00', 'PANTALLA LG PARA COMPUTADOR, CON MOUSE Y TECLADO INHALAMBRICO', 'COLOR NEGRO', 'NO APLICA', '20MK400H', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1007, '2023-12-01 00:00:00', 'BASE DE MADERA', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1008, '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTEMA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1009, '2023-12-01 00:00:00', 'SILLA AUXILIAR EN CUERO VISITANTE', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1010, '2023-12-01 00:00:00', 'SILLA AUXILIAR EN CUERO VISITANTE', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2013-11-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1011, '2023-12-01 00:00:00', 'SILLA GERENCIAL ERGONOMICA NEGRA', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2013-11-13', 342360, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1012, '2023-12-01 00:00:00', 'SILLA AUX TERCIOPELO ', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1013, '2023-12-01 00:00:00', 'SILLA AUX TERCIOPELO ', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1014, '2023-12-01 00:00:00', 'SILLA AUX TERCIOPELO ', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1015, '2023-12-01 00:00:00', 'SILLA AUX TERCIOPELO ', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1016, '2023-12-01 00:00:00', 'MESA MADERA OVALA', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1017, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1018, '2023-12-01 00:00:00', 'TABLERO', 'TABLERO', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1019, '2023-12-01 00:00:00', 'UN CAJON DE MADERA', 'COLOR BLANCO DOS PUERTAS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1020, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'MEDIDA 1 METRO Y MEDIO', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '2012-12-31', 75918.5, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 11, 'Activo', 'No'),
(1021, '2023-12-01 00:00:00', 'ESCRITORIO 3 CAJONES', 'MODULO COLOR BEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1022, '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL EN  MADERA SENCILLA (UN MODULO) ARRENDADO', 'PAPELERA HORIZONTAL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'AUX. CONTABLE', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1023, '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL EN  MADERA SENCILLA (UN MODULO) ARRENDADO', 'PAPELERA HORIZONTAL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'AUX. CONTABLE', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1024, '2023-12-01 00:00:00', 'TELEFONO FIJO', 'COLOR NEGRO, INHALAMBRICO', 'NO APLICA', '1DASDQ74721', 'PANASONIC', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1025, '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1026, '2023-12-01 00:00:00', 'ARCHIVADOR HORIZONTAL', 'COLOR BEIGE DE DOS CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2019-04-04', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1027, '2023-12-01 00:00:00', 'ARCHIVADOR VERTICAL', 'COLOR BEIGE DE CUATRO CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 1886610, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1028, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'COLOR AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Activo', 'No'),
(1029, '2023-12-01 00:00:00', 'ESCRITORIO EN L SOLINOF', 'ESCRITORIO EN L - SOLINOF MADERA Y METAL GRIS, BEIGE Y CAFÉ 2 CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'EDIFICIO PISO 1', 'Ninguna', 0, '0000-00-00', 9912050, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1030, '2023-12-01 00:00:00', 'ESCRITORIO EN L 6 CAJONES MADERA, 2 PUESTOS PATAS GRISES METALICAS VENTANILLA', 'BEIGE MODULAR A LA MEDIDA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'EDIFICIO PISO 1', 'Ninguna', 0, '2013-04-25', 9912050, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1031, '2023-12-01 00:00:00', 'ARCHIVADOR METALICO 70 CMTS Y DE MADERA 3 DIVISIONES', 'CON LLAVE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2022-11-30', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1032, '2023-12-01 00:00:00', 'ARCHIVADOR METALICO 50 CMTS Y DE MADERA 4 DIVISIONES', 'CON LLAVE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2022-11-30', 1080000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1033, '2023-12-01 00:00:00', 'ARCHIVADOR EN FORMA DE PALOMERA', 'CON LLAVE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2022-11-30', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1034, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1035, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO NEGRA ', 'PATAS EN ACERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 374793, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1036, '2023-12-01 00:00:00', 'COMPUTADOR PORTATIL CON TECLADO Y MOUSE LENOVO', 'SIN VALIDAR', 'MPNXB25110AJ', 'MP27PQ4W', 'LENOVO', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 1790000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'Si'),
(1037, '2023-12-01 00:00:00', 'BASE PARA PORTATIL ARTECMA GRADUABLE', 'BUEN ESTADO ROJA', 'NO APLICA', 'NO APLICA', 'ARTECMA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1038, '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'MADERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1039, '2023-12-01 00:00:00', 'DIVISIÓN METALICA, VIDRIO Y MADERA 40 MODULOS CON PUERTA', '40 MODULOS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 9912050, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1040, '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTECMA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1041, '2023-12-01 00:00:00', 'TABLERO EN ACRILICO', 'BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1042, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 289801, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1043, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'UNO X UNO', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2022-11-02', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1044, '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTEMAC', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1045, '2023-12-01 00:00:00', 'IMPRESORA TERMICA EPSON ', 'VENTANILLA ENTRADA', 'M-188D', 'B3QF358497', 'EPSON', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1046, '2023-12-01 00:00:00', 'MICROFONO TAKSTEAR', 'VENTANILLA ENTRADA', 'NO APLICA', 'DA-237', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-04-30', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1047, '2023-12-01 00:00:00', 'IMPRESORA HP LASER JET PROMFP M428fdw', 'BLANCA IMPRESORA, COPIADORA Y ESCANER', '110-127W-AC', 'MXBPMCC17T', 'HP', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-08-12', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1048, '2023-12-01 00:00:00', 'IMPRESORA HP LASER JET P1606DN', 'HP', 'NO APLICA', 'BND3G35495', 'HP', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-08-12', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1049, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'VENTANILLA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1050, '2023-12-01 00:00:00', 'SILLA AUXILIAR EN CUERO AZUL ', 'CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1051, '2023-12-01 00:00:00', 'SILLA AUXILIAR EN CUERO AZUL ', 'CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1052, '2023-12-01 00:00:00', 'SILLA AUXILIAR EN CUERO AZUL ', 'CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1053, '2023-12-01 00:00:00', 'SILLA AUXILIAR EN CUERO AZUL ', 'CUERO AZUL, PASTA NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1054, '2023-12-01 00:00:00', 'MESA REDONDA', 'COLOR BEIGE CON PATAS GRISES METALICAS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1055, '2023-12-01 00:00:00', 'NEVERA MINI BAR', 'COLOR GRIS DE 90 LITROS', 'K-MB93G', 'NO APLICA', 'KALLEY', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 759899, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1056, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA 1', 'BLACK OUT-PERSIANAS ENROLLABLE (2 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-04-17', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1057, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA 2', 'BLACK OUT-PERSIANAS ENROLLABLE (2 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1058, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1059, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA 1', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'SUNTECA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1060, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA 2', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1061, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1062, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1063, '2023-12-01 00:00:00', 'LOCKER', 'VERTICAL DE 5 PUESTOS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1064, '2023-12-01 00:00:00', 'HORNO MICROHONDAS KALLEY', 'ACERO / COLOR GRIS', 'NO APLICA', 'NO APLICA', 'KALLEY', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2015-11-30', 399900, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Activo', 'No'),
(1065, '2023-12-01 00:00:00', 'DIVISIÓN METALICA, VIDRIO Y MADERA', 'DIVISIÓN EN MODULO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1066, '2023-12-01 00:00:00', 'ESCRITORIO EN L SOLINOF', 'ESCRITORIO EN L - SOLINOF MADERA Y METAL GRIS, BEIGE Y CAFÉ 2 CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '2012-12-31', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1067, '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'AIRE ACONDICIONADO CON CONTROL', 'DWALT INVERTE', '9C1GOOHM-903TAJDER028', 'LG', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1068, '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'AIRE ACONDICIONADO CON CONTROL', 'INVERTE V', 'VM242CE NC2', 'LG', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS II', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1069, '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'CON CONTROL', 'VIRUS DOCTOR', 'AS2TUBCXAP', 'SAMSUNG', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA 103', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1070, '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'CON CONTROL', 'INVERTE V', '21KAPB0052', 'LG', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS II', 'Ninguna', 0, '0000-00-00', 3167740, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1071, '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'CON CONTROL', 'NO SE IDENTIFICA', 'NO APLICA', 'ELECTROLUX', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1072, '2023-12-01 00:00:00', 'COMPUTADOR PORTATIL', 'COLOR NEGRO Y GRIS', 'X55Q', 'ZFIP0022020', 'ASUS', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'Si'),
(1073, '2023-12-01 00:00:00', 'TABLERO', 'TABLERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '2013-04-26', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1074, '2023-12-01 00:00:00', 'COMPUTADOR DE MESA', 'COLOR NEGRO', 'NO APLICA', 'CN413704F5', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 1755000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'Si'),
(1075, '2023-12-01 00:00:00', 'BASE DE MADERA', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '2012-12-31', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1076, '2023-12-01 00:00:00', 'CELULAR', 'COLOR GRIS', '220333QL', 'NO APLICA', 'XIAOMI', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1077, '2023-12-01 00:00:00', 'FLUNIOMETRO', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1078, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'SILLA ERGONOMICA CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1079, '2023-12-01 00:00:00', 'BASE DE COMPUTADOR', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTERMA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1080, '2023-12-01 00:00:00', 'TELEFONO FIJO PASASONIC', 'NEGRO', 'KX-TS500LX', 'NO APLICA', 'PANASONIC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1081, '2023-12-01 00:00:00', 'SILLA AUXILIAR PASTA Y CUERO VISITANTE', 'NEGRA Y CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TECNICO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1082, '2023-12-01 00:00:00', 'PALOMERA ', 'MATERIAL MADERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 TECNICO', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1083, '2023-12-01 00:00:00', 'AIRE ACONDICIONADO CENTRAL', 'MATERIAL ACERO', 'AHR60D3XH21A', 'W1H1280607', 'YORK', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 10484400, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1084, '2023-12-01 00:00:00', 'MODULOS DE LOCKER X6', 'DE MADERA Y ACERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1085, '2023-12-01 00:00:00', 'MODULOS DE LOCKER X6', 'DE MADERA Y ACERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1086, '2023-12-01 00:00:00', 'SISTEMA PUERTA PRINCIPAL', 'MECANICO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1087, '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'AIRE ACONDICIONADO CON CONTROL', 'CH2A-012-HJU1C', '10062305', 'CIAC', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1088, '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'AIRE ACONDICIONADO', 'CH42A-02A-H3131C', '174', 'CIAC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2013-03-18', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1089, '2023-12-01 00:00:00', 'AIRE ACONDICIONADO INVERTERV LG CON CONTROL', 'AIRE ACONDICIONADO LG CON CONTROL', 'NO APLICA', 'VM182CE MCE3', 'LG', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 2876800, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1090, '2023-12-01 00:00:00', 'AIRE ACONDICIONADO TIAC CON CONTROL ', '', 'NO APLICA', 'CH21V-009-H3U1C', 'CIAC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 5749000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1091, '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'COLOR BLANCO GRANDE', 'NO APLICA', 'NO APLICA', 'PANASONIC', 'MAQUINARIA Y EQUIPO', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1092, '2023-12-01 00:00:00', 'AIRE ACONDICIONADO ELECTROLUX', '', 'PNC 929090113', 'IS305100021', 'ELECTROLUX', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ARCHIVO', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1093, '2023-12-01 00:00:00', 'AIRE ACONDICIONADO', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'LG', 'EQUIPO DE OFICINA', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1094, '2023-12-01 00:00:00', 'AIRE ACONDICIONADO YORK', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'YORK', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 3', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1095, '2023-12-01 00:00:00', 'ESTANTERIA METALICA DE 7 ENTREPAÑOS COLOR GRIS', '', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', 'SAN ALEJO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1096, '2023-12-01 00:00:00', 'GUADAÑA STIHN', 'COLOR GRIS Y NARANJA', 'FS280', '4119 967 4005A', 'STIHN', 'EQUIPO DE OFICINA', '', '', '', '', 'SAN ALEJO', 'Ninguna', 0, '0000-00-00', 1850000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1097, '2023-12-01 00:00:00', 'COMPRESOR', 'COLOR VERDE MILITAR Y NEGRO', '1129500990', 'CJK2622200925', 'BAUKER', 'EQUIPO DE OFICINA', '', '', '', '', 'SAN ALEJO', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1098, '2023-12-01 00:00:00', 'HIDROLAVADORA A GASOLINA', 'COLOR ZUL, NEGRO Y GRIS CON CUATRO BOQUILLAS', 'HYGPW2700', 'HYGPW27220704-01-0027', 'HYUNDAI', 'CONTROL', '', '', '', '', 'SAN ALEJO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1099, '2023-12-01 00:00:00', 'GRAPADORA GRANDE', 'COLOR GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1100, '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL EN  MADERA SENCILLA (UN MODULO) ARRENDADO', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1101, '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL EN  MADERA SENCILLA (UN MODULO) ARRENDADO', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1102, '2023-12-01 00:00:00', 'SILLA AUXILIAR CUERO AZUL Y NEGRO', 'NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1103, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'COLOR AZUL CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1104, '2023-12-01 00:00:00', 'PANTALLA NOC PARA COMPUTADOR, CON MOUSE Y TECLADO LENOVO', 'NEGRA', 'E970SWHEN', 'AOBH91A001492', 'NOC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1105, '2023-12-01 00:00:00', 'BASE MADERA PARA COMPUTADOR NEGRA ', 'NEGRA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1106, '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL MADERA DOBLE', 'MADERA CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1107, '2023-12-01 00:00:00', 'PERCHERO NEGRO Y PLATEADO TUBULAR', 'NEGRO Y PLATEADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1108, '2023-12-01 00:00:00', 'TELEFONO INLAMBRICO SYMPLY ', 'INHALAMBRICO', 'STI3522', 'QNUE41015B1WB', 'SYMPLI', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1109, '2023-12-01 00:00:00', 'TABLERO EN MADERA Y ACRILICO BLANCO', 'BLANCO Y MADERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1110, '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTESMA', 'CONTROL', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1111, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'CONTROL', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1112, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'CONTROL', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1113, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1114, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (3 METRO)', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1115, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (3 METRO)', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1116, '2023-12-01 00:00:00', 'ESCRITORIO EN L CAFÉ 3 CAJONES', 'DIAN', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1117, '2023-12-01 00:00:00', 'ESCRITORIO EN L BEIGE 3 CAJONES SIN LLAVE ABRE', 'DIAN', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1118, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'DIAN', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1119, '2023-12-01 00:00:00', 'ESCRITORIO EN L CAFÉ 3 CAJONES', 'CON LLAVE EN BUEN ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1120, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'BUEN ESTADO ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1121, '2023-12-01 00:00:00', 'MESA DE VIDRIO CIRCULAR Y METAL ', 'VIDRIO Y METAL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '2014-08-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1122, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1123, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'BUEN ESTADO ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1124, '2023-12-01 00:00:00', 'MESA REDONDA DE MADERA Y METAL GRIS', 'MADERA BEIGE Y PATAS GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1125, '2023-12-01 00:00:00', 'SILLAS AUXILIARES DE TERCIOPELO AZUL Y PATAS NEGRAS', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1126, '2023-12-01 00:00:00', 'SILLAS AUXILIARES DE TERCIOPELO AZUL Y PATAS NEGRAS', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1127, '2023-12-01 00:00:00', 'ESCRITORIO MODULAR EN L WENGUE 2 CAJORES CON TUBOS DE ACERO', 'LLAVE SIN USO CORRECTO', 'NO APLICA', 'NO APLICA', 'MODUART', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1128, '2023-12-01 00:00:00', 'ESCRITORIO EN L WENGUE 3 CAJOSES 3 METALICOS CON PATAS GRISES CON LLAVE', 'CON LLAVE BIEN', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1129, '2023-12-01 00:00:00', 'ESCRITORIO EN L WENGUE 3 CAJONES MADERA CON PATAS GRISES CON LLAVE', 'CON LLAVE BIEN', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1130, '2023-12-01 00:00:00', 'ESCRITORIO EN L WENGUE 3 CAJONES MADERA CON PATAS GRISES SIN LLAVE', 'SIN LLAVE Y CAJONES ASEGURADOS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1131, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'BUEN ESTADO ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1132, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'BUEN ESTADO ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1133, '2023-12-01 00:00:00', 'MESA AUXILIAR CON RODACHINES ', 'ESQUINAS EN MAL ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1134, '2023-12-01 00:00:00', 'MUEBLE DE COCINA', '4 SUPERIORES Y 2 INFERIORES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1135, '2023-12-01 00:00:00', 'ESCRITORIO EN L WENGUE 3 CAJOSES 3 METALICOS CON PATAS GRISES CON LLAVE ', 'SIN LLAVE Y CAJONES ASEGURADOS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1136, '2023-12-01 00:00:00', 'DIVISIÓN METALICA, VIDRIO Y MADERA 24 MODULOS CON PUERTA', 'LA PUERTA CIERRA SIN LLAVE ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '2012-12-31', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1137, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1138, '2023-12-01 00:00:00', 'ARCHIVADOR DE 3 PUESTOS CAJONES SIN LLAVE', 'MADERA NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 755000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1139, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (2 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1140, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1141, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '2012-12-31', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1142, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (2 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1143, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1144, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'HORIZONTE', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1145, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'UNO X UNO', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1146, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'HORIZONTE', 'CONTROL', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 114812, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1147, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'COLOR AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '2013-06-05', 289801, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1148, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'COLOR AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1149, '2023-12-01 00:00:00', 'SILLA ERGONOMICA EN CUERO ', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 374793, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1150, '2023-12-01 00:00:00', 'ESCRITORIO DE DOS PUESTOS CON TRES CAJONES Y LLAVE', 'COLOR MADERA Y NEGRO', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'CONTROL', '', '', '', '', 'ACOTAR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1151, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'COLOR AZUL', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'CONTROL', '', '', '', '', 'ACOTAR', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1152, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'COLOR AZUL', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', 'ACOTAR', 'Ninguna', 0, '2012-12-31', 289801, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1153, '2023-12-01 00:00:00', 'ESCRITORIO PEQUEÑO CON 1 CAJON ', 'COLOR NEGRO', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', 'ACOTAR', 'Ninguna', 0, '2014-02-17', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No');
INSERT INTO `activos` (`id_activo`, `fecha_asignacion`, `nombre_articulo`, `descripcion_articulo`, `modelo_articulo`, `referencia_articulo`, `marca_articulo`, `tipo_articulo`, `ip`, `windows`, `office`, `factura_office`, `lugar_articulo`, `observaciones_articulo`, `numero_factura`, `fecha_garantia`, `valor_articulo`, `condicion_articulo`, `id_proveedor_fk`, `descripcion_proveedor`, `id_usuario_fk`, `estado_activo`, `recurso_tecnologico`) VALUES
(1154, '2023-12-01 00:00:00', 'PUERTA DE MODULO', 'GRIS DE VIDRIO', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'CONTROL', '', '', '', '', 'ACOTAR', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1155, '2023-12-01 00:00:00', 'VENTILADOR DE MESA', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'BIONAIRE', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1156, '2023-12-01 00:00:00', 'DIVISIÓN METALICA, VIDRIO Y MADERA', 'DIVISIÓN EN MODULO DE 23 ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '2012-12-31', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 27, 'Activo', 'No'),
(1157, '2023-12-01 00:00:00', 'PERCHERO CAFÉ', 'PERCHERO CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1158, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1159, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1160, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1161, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1162, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1163, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '2012-12-31', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1164, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1165, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1166, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1167, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '2013-06-05', 289826, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1168, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1169, '2023-12-01 00:00:00', 'SILLA ERGONOMICA ROJA', 'SILLA ERGONOMICA ROJA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 289826, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1170, '2023-12-01 00:00:00', 'TABLERO CON BASE PLEGABLE', 'TABLERO CON BASE PLEGABLE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1171, '2023-12-01 00:00:00', 'BASE DE TV EXTENSIBLE', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '2012-12-31', 1977000, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1172, '2023-12-01 00:00:00', 'SILLAS RIMAX 1', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1173, '2023-12-01 00:00:00', 'SILLAS RIMAX 2', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1174, '2023-12-01 00:00:00', 'SILLAS RIMAX 3', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '2013-04-25', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1175, '2023-12-01 00:00:00', 'SILLAS RIMAX 4', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '2013-04-25', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1176, '2023-12-01 00:00:00', 'SILLAS RIMAX 5', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1177, '2023-12-01 00:00:00', 'SILLAS RIMAX 6', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1178, '2023-12-01 00:00:00', 'SILLAS RIMAX 7', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1179, '2023-12-01 00:00:00', 'SILLAS RIMAX 8', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1180, '2023-12-01 00:00:00', 'SILLAS RIMAX 9', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1181, '2023-12-01 00:00:00', 'SILLAS RIMAX 10', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1182, '2023-12-01 00:00:00', 'SILLAS RIMAX 11', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1183, '2023-12-01 00:00:00', 'SILLAS RIMAX 12', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1184, '2023-12-01 00:00:00', 'SILLAS RIMAX 13', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'RIMAX', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '2013-04-25', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1185, '2023-12-01 00:00:00', 'MESA RECTANGULAR', 'COLOR NEGRO Y COLOR MADERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 5561630, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1186, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (2 METRO)', 'NO APLICA', 'NO APLICA', 'HORIZONTE', 'CONTROL', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 193333, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1187, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'HORIZONTE', 'CONTROL', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 193333, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1188, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'HORIZONTE', 'CONTROL', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 193333, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1189, '2023-12-01 00:00:00', 'MESA OVALADA', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS II', 'Ninguna', 0, '0000-00-00', 530000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1190, '2023-12-01 00:00:00', 'SILLAS RIMAX 14', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO I U:O', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1191, '2023-12-01 00:00:00', 'TABLERO', 'TABLERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS II', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1192, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (2.5 METRO)', 'NO APLICA', 'NO APLICA', 'HORIZONTE', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS II', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1193, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (2.5 METRO)', 'NO APLICA', 'NO APLICA', 'PENTAGRAMA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1194, '2023-12-01 00:00:00', 'SILLA AUXILIAR NEGRA', 'NEGRA EN CUERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '2023-05-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1195, '2023-12-01 00:00:00', 'SILLA AUXILIAR NEGRA', 'NEGRA EN CUERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1196, '2023-12-01 00:00:00', 'SILLA AUXILIAR NEGRA', 'NEGRA EN CUERO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1197, '2023-12-01 00:00:00', 'MESA REDONDA DE VIDRIO Y BASE EN METAL', 'NEGRO Y PLATEADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '0000-00-00', 1075180, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1198, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1199, '2023-12-01 00:00:00', 'SOFA EN CUERO NEGRO 2 PUESTOS', 'RECEPCIÓN', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'RECEPCIÓN', 'Ninguna', 0, '0000-00-00', 2538000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1200, '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'PAPALERA HORIZONTAL EN  MADERA PARA COMPUTADOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1201, '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL EN  MADERA SENCILLA (UN MODULO)', 'PAPELERA HORIZONTAL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1202, '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL EN  MADERA SENCILLA (UN MODULO)', 'PAPELERA HORIZONTAL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1203, '2023-12-01 00:00:00', 'ESCRITORIO EN L 3 CAJONERAS', 'COLOR MADERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1204, '2023-12-01 00:00:00', 'TELEFONO FIJO PBX PANASONIC ', 'TELEFONO FIJO PBX PANASONIC ', 'NO APLICA', 'KX-T7730X-B', 'PANASONIC', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1205, '2023-12-01 00:00:00', 'COMPUTADOR DE MESA', 'COMPUTADOR DE MESA', 'NO APLICA', 'MXL249147V', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'Si'),
(1206, '2023-12-01 00:00:00', 'ESCRITORIO PEQUEÑO', 'COLOR MADERA UN CAJON CON LLAVE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1207, '2023-12-01 00:00:00', 'ARCHIVADOR EN FORMA DE PALOMERA', 'ARCHIVADOR EN FORMA DE PALOMERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1208, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1209, '2023-12-01 00:00:00', 'BUZON', 'SUGERENCIAS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1210, '2023-12-01 00:00:00', 'ARCHIVADOR HORIZONTAL', 'COLOR BEIGE DE DOS CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 13, 'Activo', 'No'),
(1211, '2023-12-01 00:00:00', 'ESCRITORIO L DE TRES CAJONES', 'NO TIENE LLAVE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 15, 'Activo', 'No'),
(1212, '2023-12-01 00:00:00', 'BASE GRADUABLE', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 15, 'Activo', 'No'),
(1213, '2023-12-01 00:00:00', 'BASE FIJA DE COMPUTADOR', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 15, 'Activo', 'No'),
(1214, '2023-12-01 00:00:00', 'TELEFONO', 'INHALAMBRICO', 'MOTO550D', 'MOTOXQT000V', 'MOTOROLA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 15, 'Activo', 'No'),
(1215, '2023-12-01 00:00:00', 'COMPUTADOR TODO EN UNO, CON MOUSE Y TECLADO', 'COLOR NEGRO', '7558-L412', 'S1DVP45', 'LENOVO/LENOVO/HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 15, 'Activo', 'Si'),
(1216, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 15, 'Activo', 'No'),
(1217, '2023-12-01 00:00:00', 'BICICLETA', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', ' ', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 15, 'Activo', 'No'),
(1218, '2023-12-01 00:00:00', 'ESCRITORIO 3 CAJONES', 'MODULO COLOR BEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1219, '2023-12-01 00:00:00', 'COMPUTADOR DE MESA, CON MOUSE Y TECLADO', 'TODO EN UNO, COLOR NEGRO', '7558-L4S', 'S1DVV40', 'LENOVO', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2013-08-12', 1670310, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'Si'),
(1220, '2023-12-01 00:00:00', 'BASE DE MADERA', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2013-08-12', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1221, '2023-12-01 00:00:00', 'TELEFONO FIJO', 'COLOR NEGRO, INHALAMBRICO', 'NO APLICA', 'QNUE41015B1WB', 'SIMPLY', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2013-08-12', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1222, '2023-12-01 00:00:00', 'VENTILADOR', 'COLOR NEGRO Y GRIS', 'BT38', '60HZ120V-0.4AMPS', 'BIONAIRE', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2013-08-12', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1223, '2023-12-01 00:00:00', 'PAPALERA HORIZONTAL EN  MADERA SENCILLA (UN MODULO)', 'PAPELERA HORIZONTAL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2013-08-12', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1224, '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTEMA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2013-08-12', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1225, '2023-12-01 00:00:00', 'ARCHIVADOR VERTICAL', 'COLOR BEIGE DE CUATRO CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 1886610, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1226, '2023-12-01 00:00:00', 'ARCHIVADOR VERTICAL', 'COLOR BEIGE DE CUATRO CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 1886610, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1227, '2023-12-01 00:00:00', 'MODULO DE DIVISION', 'MODULO DE DIVISION', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '2012-12-31', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1228, '2023-12-01 00:00:00', 'ESCRITORIO EN L 3 CAJONES', 'COLOR GEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1229, '2023-12-01 00:00:00', 'VENTILADOR OSTER VERTICAL 8 REVOLUCIONES CON CONTROL', 'NEGRO CON CONTROL', 'NO APLICA', 'OTF9115R-LA013', 'OSTER', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 189900, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1230, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA ADMINISTRATIVA', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 12, 'Activo', 'No'),
(1231, '2023-12-01 00:00:00', 'ESCRITORIO SENCILLO GEIGE CON 3 CAJONES Y LLAVE', 'PATAS GRISES EN BUEN ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 3, 'Activo', 'No'),
(1232, '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 3, 'Activo', 'No'),
(1233, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 3, 'Activo', 'No'),
(1234, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 3, 'Activo', 'No'),
(1235, '2023-12-01 00:00:00', 'BICICLETA AZUL', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 14, 'Activo', 'No'),
(1236, '2023-12-01 00:00:00', 'ESCRITORIO EN L 3 CAJONES MADERA, PATAS GRISES METALICAS', 'BEIGE CON LLAVE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 16, 'Activo', 'No'),
(1237, '2023-12-01 00:00:00', 'PALOMERA GRIS CON WENGUE PEQUEÑA', 'GRIS Y WEHGUE SIN LLAVE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 16, 'Activo', 'No'),
(1238, '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'MADERA MAL ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 16, 'Activo', 'No'),
(1239, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-04-26', 579602, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 16, 'Activo', 'No'),
(1240, '2023-12-01 00:00:00', 'ESCRITORIO SENCILLO GEIGE CON 3 CAJONES SIN LLAVE', 'PATAS GRISES EN BUEN ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 23, 'Activo', 'No'),
(1241, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-04-26', 579602, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 23, 'Activo', 'No'),
(1242, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (2 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 129186, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1243, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'COLOR AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 579602, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1244, '2023-12-01 00:00:00', 'ESCRITORIO MEDIANO', 'COLOR MADERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1245, '2023-12-01 00:00:00', 'UN ARCHIVADOR PEQUEÑO', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1246, '2023-12-01 00:00:00', 'ARCHIVADOR DE METAL', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1247, '2023-12-01 00:00:00', 'UNA DIVISION DE OFICINA', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1248, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'COLOR AZUL', 'NO APLICA', 'NO  APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 579602, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1249, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA 1', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 129186, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1250, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA 2', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 129186, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1251, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA 3', 'BLACK OUT-PERSIANAS ENROLLABLE (1.5 METRO)', 'NO APLICA', 'NO APLICA', 'HORIZONTE', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 129186, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 21, 'Activo', 'No'),
(1252, '2023-12-01 00:00:00', 'ESCRITORIO SENCILLO GEIGE CON 3 CAJONES Y LLAVE', 'PATAS GRISES EN BUEN ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-02-15', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 28, 'Activo', 'No'),
(1253, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2014-06-19', 289801, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 28, 'Activo', 'No'),
(1254, '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTEMA', 'CONTROL', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 28, 'Activo', 'No'),
(1255, '2023-12-01 00:00:00', 'TELEFONO', 'INHALAMBRICO', 'NO APLICA', 'QNUE4101555K6', 'SIMPLY', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 28, 'Activo', 'No'),
(1256, '2023-12-01 00:00:00', 'ESPEJO EN MADERA', 'UN ESPEJO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'BAÑO HOMBRES PISO I', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1257, '2023-12-01 00:00:00', 'ESPEJO EN MADERA', 'UN ESPEJO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'BAÑOMUJERES PISO I', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1258, '2023-12-01 00:00:00', 'COCINA INTEGRAL', 'COLOR CAFÉ DE 4 DIVISIONES INFERIORES, ENCIMERA EN ALUMINIO Y MUEBLE SUPERIOR DE 3 DIVISIONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO I', 'Ninguna', 0, '2012-12-31', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1259, '2023-12-01 00:00:00', 'UN BASURERO PLASTICO', 'COLOR BLANCO DE RESIDUOS APROVECHABLES UNA DIVISION  ', 'NO APLICA', 'NO APLICA', 'COLPLASTICO', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO I', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1260, '2023-12-01 00:00:00', 'UN BASURERO PLASTICO', 'COLOR BLANCO DE RESIDUOS APROVECHABLES 2 DIVISION  ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO I', 'Ninguna', 0, '2012-12-31', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1261, '2023-12-01 00:00:00', 'NEVERA - BLANCA', 'BLANCA', 'NO APLICA', '_ _ 058550 4164', 'LG', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINETA U:O PISO I', 'Ninguna', 0, '0000-00-00', 420000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1262, '2023-12-01 00:00:00', 'GRECA DE CAFE', 'PLATEADA', 'NO APLICA', 'NO APLICA', 'GRECA NACIONAL DEL CAFÉ', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINETA U:O PISO I', 'Ninguna', 0, '2012-12-31', 305000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1263, '2023-12-01 00:00:00', 'ESPEJO EN MADERA NEGRA', 'ESPEJO BAÑO EN MADERA NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS III', 'Ninguna', 0, '2012-12-31', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1264, '2023-12-01 00:00:00', 'ESPEJO EN MADERA', 'ESPEJO BAÑO EN MADERA NEGRA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'BAÑO MUJERES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1265, '2023-12-01 00:00:00', 'ESPEJO EN MADERA', 'ESPEJO BAÑO EN MADERA NEGRA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'BAÑO HOMBRES', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1266, '2023-12-01 00:00:00', 'ESPEJO DE MADERA', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1267, '2023-12-01 00:00:00', 'ALACENA VERTICAL 5 PUESTOS EN MADERA BEIGE', 'BEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1268, '2023-12-01 00:00:00', 'COCINA INTEGRAL ', '2 DIVICIONES EN MADELA WENGUE, MODULO SUPERIOR 2 DIVISIONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1269, '2023-12-01 00:00:00', 'ESCALERA 2 PASOS RIMAX', 'AZUL PLASTICA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1270, '2023-12-01 00:00:00', 'CANECA DE RESIDUOS APROVECHABLES', 'COLOR NEGRO DE UN MODULO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1271, '2023-12-01 00:00:00', 'CANECA DE RESIDUOS APROVECHABLES', 'COLOR BLANCO DE UN MODULO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1272, '2023-12-01 00:00:00', 'PURIFICADOR DE AGUA OZONO HEALTH', 'BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1273, '2023-12-01 00:00:00', 'BANDEJA DE MADERA ', 'COLOR MADERA ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1274, '2023-12-01 00:00:00', 'GRECA DE CAFÉ', 'PLATEADO', 'NO APLICA', 'NO APLICA', 'LA SIMA DE LA GRECA', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1275, '2023-12-01 00:00:00', 'NEVERA ELECTROLUX INFINITY ACERO Y METAL', 'ACERO Y METAL GRIS', 'MR125E08700155', 'ERT163EG', 'ELETROLUX', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 1462980, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1276, '2023-12-01 00:00:00', 'HORNO MICROHONDAS KALLEY', 'ACERO / COLOR GRIS', 'NO APLICA', 'NO APLICA', 'KALEY', 'EQUIPO DE OFICINA', '', '', '', '', 'COCINA PISO 2', 'Ninguna', 0, '0000-00-00', 399900, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1277, '2023-12-01 00:00:00', 'ESPEJO DE MADERA', 'MADERA CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1278, '2023-12-01 00:00:00', 'ESPEJO DE MADERA', 'MADERA CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'DIAN', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1279, '2023-12-01 00:00:00', 'OZONO PURIFICADOR DE AGUA', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1280, '2023-12-01 00:00:00', 'COCINA INTEGRAL ', 'COLOR BLANCO DE 2 PUESTOS, METALICA Y ALUMINIO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2019-05-02', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1281, '2023-12-01 00:00:00', 'CANECA DE RESIDUOS APROVECHABLES', 'COLOR BLANCO DE UN MODULO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2016-12-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1282, '2023-12-01 00:00:00', 'CANECA DE RESIDUOS APROVECHABLES', 'COLOR GRIS DE DOS MODULOS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2016-12-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1283, '2023-12-01 00:00:00', 'HORNO MICROHONDAS ', 'COLOR BLANCO', 'EMDA20S3MKW', '22305474', 'ELECTROLUX', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2016-12-13', 130000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1284, '2023-12-01 00:00:00', 'MESA PLASTICO', 'TRES COMPARTIMENTOS COLOR AZUL Y GRIS CON RODCHINES', 'NO APLICA', 'NO APLICA', 'WINCO', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2016-12-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1285, '2023-12-01 00:00:00', 'SILLAS', 'AZULES PLASTICO Y ACERO ', 'NO APLICA ', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '2016-12-13', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1286, '2023-12-01 00:00:00', 'SILLAS', 'AZULES PLASTICO Y ACERO ', 'NO APLICA ', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '2016-12-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1287, '2023-12-01 00:00:00', 'SILLAS', 'AZULES PLASTICO Y ACERO ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'CONTROL', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1288, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'MAQUINARIA Y EQUIPO', '', '', '', '', '', 'Ninguna', 0, '2014-08-23', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1289, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2016-12-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1290, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1291, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1292, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1293, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2016-12-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1294, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1295, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1296, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '2013-04-26', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1297, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1298, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1299, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'CONTROL', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1300, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2013-11-13', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1301, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA SIN REPOSA BRAZOS  ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'CONTROL', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1302, '2023-12-01 00:00:00', 'SILLAS RIMAX', 'BLANCA CON REPOSA BRAZOS ', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'CONTROL', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1303, '2023-12-01 00:00:00', 'VENTILADOR VERTICAL ', 'COLOR NEGRO', 'VE231210', '2708', 'SAMURAI', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '2012-12-31', 205350, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1304, '2023-12-01 00:00:00', 'VENTILADOR VERTICAL ', 'COLOR GRIS', 'BE732210', '1089', 'SAMURAI', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 205350, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1305, '2023-12-01 00:00:00', 'SILLAS 1', 'COLOR NEGRO Y AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1306, '2023-12-01 00:00:00', 'SILLAS 2', 'COLOR NEGRO Y AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1307, '2023-12-01 00:00:00', 'SILLAS 3', 'COLOR NEGRO Y AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1308, '2023-12-01 00:00:00', 'SILLAS 4', 'COLOR NEGRO Y AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1309, '2023-12-01 00:00:00', 'SILLAS 5', 'COLOR NEGRO Y AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No');
INSERT INTO `activos` (`id_activo`, `fecha_asignacion`, `nombre_articulo`, `descripcion_articulo`, `modelo_articulo`, `referencia_articulo`, `marca_articulo`, `tipo_articulo`, `ip`, `windows`, `office`, `factura_office`, `lugar_articulo`, `observaciones_articulo`, `numero_factura`, `fecha_garantia`, `valor_articulo`, `condicion_articulo`, `id_proveedor_fk`, `descripcion_proveedor`, `id_usuario_fk`, `estado_activo`, `recurso_tecnologico`) VALUES
(1310, '2023-12-01 00:00:00', 'SILLAS 6', 'COLOR NEGRO Y AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1311, '2023-12-01 00:00:00', 'MESA MADERA Y METAL', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1312, '2023-12-01 00:00:00', 'MESA MADERA Y METAL', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1313, '2023-12-01 00:00:00', 'MESA MADERA Y METAL', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1314, '2023-12-01 00:00:00', 'MESA MADERA Y METAL', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1315, '2023-12-01 00:00:00', 'SILLAS ', 'VERDES DE PASTICO  Y ACERO ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1316, '2023-12-01 00:00:00', 'SILLAS ', 'VERDES DE PASTICO  Y ACERO ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1317, '2023-12-01 00:00:00', 'SILLAS ', 'VERDES DE PASTICO  Y ACERO ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '2012-12-31', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1318, '2023-12-01 00:00:00', 'SILLAS ', 'VERDES DE PASTICO  Y ACERO ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1319, '2023-12-01 00:00:00', 'SILLAS ', 'VERDES DE PASTICO  Y ACERO ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'COMEDOR', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 56, 'Activo', 'No'),
(1320, '2023-12-01 00:00:00', 'ESCRITORIO EN L SOLINOF', 'ESCRITORIO EN L - SOLINOF MADERA Y METAL GRIS, BEIGE Y CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1321, '2023-12-01 00:00:00', 'DIVISIÓN METALICA, VIDRIO Y MADERA', 'DIVISIÓN EN MODULO DE 23 ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1322, '2023-12-01 00:00:00', 'ROUTER', 'ROUTER', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1323, '2023-12-01 00:00:00', 'TELEVISOR LG 70\" ', 'TELEVISOR LG 70\" CON CONTROL', 'NO APLICA', '70UK6550PDA', 'LG', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS I', 'Ninguna', 0, '0000-00-00', 3499900, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1324, '2023-12-01 00:00:00', 'ROUTER', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'TP-LINK', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'SALA DE JUNTAS II', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1325, '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'PAPALERA HORIZONTAL EN  MADERA PARA COMPUTADOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1326, '2023-12-01 00:00:00', 'MONITOR LG PARA COMPUTADOR', 'MONITOR LG PARA COMPUTADOR', 'NO APLICA', '20M38HBBAWPQJVN', 'LG', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1327, '2023-12-01 00:00:00', 'UPS DELL OPTIPLEX 3070', 'UPS DELL OPTIPLEX 3070', '29264706543', 'DFZG833', 'DELL', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '2012-12-31', 0, '', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1328, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1329, '2023-12-01 00:00:00', 'DUPLICARDOR DISCO DURO', 'COLOR NEGRO', 'WL-ST334U REV.A', 'BG26HL0200471', 'WAVLINK', 'CONTROL', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1330, '2023-12-01 00:00:00', 'ARCHIVADOR EN FORMA DE PALOMERA', 'ARCHIVADOR EN FORMA DE PALOMERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1331, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'SILLA ERGONOMICA CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1332, '2023-12-01 00:00:00', 'TELEFONO INLAMBRICO PANASONIC', 'NEGRO CON BASE', 'NO APLICA', 'KXTGB110LA', 'PANASONIC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1333, '2023-12-01 00:00:00', 'BASE MADERA PARA COMPUTADOR NEGRA', 'BASE MADERA PARA COMPUTADOR NEGRA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1334, '2023-12-01 00:00:00', 'SILLA AUXILIAR PASTA Y CUERO VISITANTE', 'NEGRA Y CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - TI', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1335, '2023-12-01 00:00:00', 'TELEVISOR SAMSUMG 32\"', 'TELEVISOR 32\" SAMSUMG', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1336, '2023-12-01 00:00:00', 'ROUTER', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'TP-LINK', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA GERENCIA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1337, '2023-12-01 00:00:00', 'IMPRESORA A COLOR ', 'BLANCA', 'NO APLICA', 'HP SMART TANK 720', 'HP', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1338, '2023-12-01 00:00:00', 'IMPRESORA HP LASER JET PROMFP M428fdw', 'COLOR BLANCO', 'VCVRA-1712', 'MXBPMCBOLH', 'HP', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1339, '2023-12-01 00:00:00', 'IMPRESORA HP LASER PEQUEÑA P1606DN', 'COLOR NEGRO', 'BOISB-0902-00', 'VNB3G04919', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1340, '2023-12-01 00:00:00', 'ESCRITORIO GRANDE SIN CAJON ', 'COLOR MADERA ', 'NO APLICA ', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1341, '2023-12-01 00:00:00', 'ESCRITORIO PEQUEÑO CON 2 CAJONES ', 'MADERA ', 'NO APLICA ', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1342, '2023-12-01 00:00:00', 'RACK PRINCIPAL ', 'CAJO DE ALMACENAMIENTO ELTRONICO NEGRO ', 'NO APLICA ', 'TECNI SERVICIOS ', 'SIEMON', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1343, '2023-12-01 00:00:00', 'ACESS POIN', 'BLANCO', 'LAPAC1750', 'NO APLICA', 'LINKSYS', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1344, '2023-12-01 00:00:00', 'SWITCHE', 'GRIS ', 'NO APLICA ', '130', ' ALLIED TELISIS 24 PUERTOS ', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1345, '2023-12-01 00:00:00', 'RACK DE COMUNICACIONES ', 'NEGRO ', 'NO APLICA ', 'NO APLICA', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1346, '2023-12-01 00:00:00', 'CISCO', 'SWITCHE CATALYST 2950', 'NO APLICA ', 'NO APLICA', 'CATALYST 2950', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1347, '2023-12-01 00:00:00', 'UPC', 'NEGRO ', 'ON-LINE MGO-10K-MAGOM', 'NO APLICA', 'NO APLICA ', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1348, '2023-12-01 00:00:00', 'ROUTER PORTABLE ', 'ROUTER PORTABLE 4G WIFI', 'B612 FBD9', 'NO APLICA', 'NO APLICA ', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1349, '2023-12-01 00:00:00', 'TELEFONO FIJO ', 'INHALAMBRICO', 'KX-T5500LX', 'NO APLICA', 'PANASONIC', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2023-05-23', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1350, '2023-12-01 00:00:00', 'SERVIDOR ZEUS ', 'COMPLETO', '1040-900-0092 ', 'NO APLICA', 'COMPUMAX ', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1351, '2023-12-01 00:00:00', 'TORRE DE COMPUTADOR', 'NEGRO ', 'HG00507', 'NO APLICA', 'HGXTREME', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1352, '2023-12-01 00:00:00', 'DISCOS DE COPIA DE SEGURIDAD', 'NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA ', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1353, '2023-12-01 00:00:00', 'COMPUTADOR TODO EN UNO', 'TODO NEGRO', '100B', 'HP100BALLINONEPCSERIES', 'HP ', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1354, '2023-12-01 00:00:00', 'COMPUTADOR PORTATIL LENOVO', 'LENOVO NEGRO THINPAD', 'L430', 'ZPI0072020', 'LEVONO', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 1790000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1355, '2023-12-01 00:00:00', 'PARLANTES GENIOS CABINAS DE SONIDO', 'GENIOS', 'XN130XE03210', 'SP-HF2020V2', 'GENIOS', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1356, '2023-12-01 00:00:00', 'BASE DE MADERA FIJA ', 'NEGRA', 'NO APLICA ', 'NO APLICA', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1357, '2023-12-01 00:00:00', 'COMPUTADOR PORTATIL LENOVO', 'LENOVO NEGRO THINPAD', 'L430', 'NO APLICA', 'LENOVO', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 1790000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1358, '2023-12-01 00:00:00', 'TORRE DE COMPUTADOR HG XTREME', 'HG XTREM', 'HG00502', '2123374', 'HG XTREME', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1359, '2023-12-01 00:00:00', 'TORRE DE COMPUTADOR HG XTREME', 'HG XTREM', 'HG00502', '123040', 'HG XTREME', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2019-05-28', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1360, '2023-12-01 00:00:00', 'TORRE DE COMPUTADOR HG XTREME', 'HG XTREM', 'HG00516', '123492', 'HG XTREME', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2019-05-28', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1361, '2023-12-01 00:00:00', 'TORRE DE COMPUTADOR HG', 'HG ANTERIOR COMPUTADOR DEL DIR CONTABLE', 'HG00469A', '116431', 'HG', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2019-05-28', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'Si'),
(1362, '2023-12-01 00:00:00', 'PANTALLA 14\' NOC ', 'NEGRA', '185LM0019', 'AOBH91A000321', 'NOC', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1363, '2023-12-01 00:00:00', 'PANTALLA 14\' NOC ', 'NEGRA', '195LM0003', 'AOXH81A000402', 'NOC', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2023-05-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1364, '2023-12-01 00:00:00', 'PANTALLA 14\' NOC ', 'NEGRA', '185LM0019', 'AOBHA1A000318', 'NOC', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1365, '2023-12-01 00:00:00', 'PANTALLA 14\' NOC ', 'NEGRA', '185LM0019', 'AOBH91A000599', 'NOC', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1366, '2023-12-01 00:00:00', 'PANTALLA 15\' LG', 'LG', '20M35ASA', '407NDZJ42421', 'LG', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1367, '2023-12-01 00:00:00', 'PANTALLA 15\' LG', 'LG', '20MP38HQ', '804NTUW6M566', 'LG', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1368, '2023-12-01 00:00:00', 'TABLERO EN ACRILICO', 'BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1369, '2023-12-01 00:00:00', 'CAMARA WEB HD 1080p', '', 'NO APLICA', 'HD 1080P', 'LOGI', 'CONTROL', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1370, '2023-12-01 00:00:00', 'PARLANTES CON CABLE PARA EQUIPO COMPUTO', 'ANTES DEL DIR CONTABLE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1371, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1372, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFICINA RACK DE TELECOMUNICACIONES', 'Ninguna', 0, '2012-12-31', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1373, '2023-12-01 00:00:00', 'TELEFONO FIJO PANASONIC', '', 'KX-TS500LXB', '2KDKH300046', 'PANASONIC', 'FLOTA Y EQUIPO DE TRANSPORTE', '', '', '', '', 'PISO 1', 'Ninguna', 0, '0000-00-00', 0, 'Buena', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1374, '2023-12-01 00:00:00', 'UN RACK', 'COLOR NEGRO', '16-PORTGIGANTBIT', 'TL-SG1016D', 'TP-LINK', 'FLOTA Y EQUIPO DE TRANSPORTE', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Buena', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1375, '2023-12-01 00:00:00', 'VIDEO BEAM', 'COLOR BLANCO Y GRIS', 'NO APLICA', 'X4YF8300534', 'EPSON', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1376, '2023-12-01 00:00:00', 'NVR CCTV', 'NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'CCTV', 'Ninguna', 0, '2012-12-31', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1377, '2023-12-01 00:00:00', 'RACK', 'COLOR NEGRO CCTV-3', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'CCTV', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 2, 'Activo', 'No'),
(1378, '2023-12-01 00:00:00', 'UN BOTIQUIN', 'COLOR BLACO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'SALA DE JUNTAS II', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1379, '2023-12-01 00:00:00', 'ESTANTERIA', 'COLOR GRIS DE 6 ENTREPAÑOS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ALMACEN', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1380, '2023-12-01 00:00:00', 'ESTANTERIA', 'COLOR GRIS Y VERDE DE 5 ENTREPAÑOS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ALMACEN', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1381, '2023-12-01 00:00:00', 'JUEGO DE SAPO', 'JUEGO DE SAPO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ALMACEN', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1382, '2023-12-01 00:00:00', 'TABLERO EN MADERA Y CORCHO', 'TABLERO EN MADERA Y CORCHO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PASILLO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1383, '2023-12-01 00:00:00', 'ESCRITORIO 3 CAJONES', 'MODULO COLOR BEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1384, '2023-12-01 00:00:00', 'BASE DE MADERA', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1385, '2023-12-01 00:00:00', 'COMPUTADOR DE MESA CON MOUSE Y TECLADO', 'COLOR NEGRO', '7558-L4S', 'S1DMB12', 'LENOVO', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 1670310, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'Si'),
(1386, '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'COLOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1387, '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1388, '2023-12-01 00:00:00', 'BOTIQUIN', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1389, '2023-12-01 00:00:00', 'BOTIQUIN', 'PORTATIL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1390, '2023-12-01 00:00:00', 'ARCHIVADOR', 'COLOR BEIGE DE DOS CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 1222730, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1391, '2023-12-01 00:00:00', 'COMPUTADOR DE MESA, CON MOUSE Y TECLADO', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'LENOVO', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'Si'),
(1392, '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1393, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'COLOR AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1394, '2023-12-01 00:00:00', 'BOTIQUIN', 'COLOR BLANCO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1395, '2023-12-01 00:00:00', 'TABLERO DE INFORMACION', 'MATERIAL CORCHO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 8, 'Activo', 'No'),
(1396, '2023-12-01 00:00:00', 'ESCRITORIO SENCILLO GEIGE CON 3 CAJONES Y LLAVE', 'PATAS GRISES EN BUEN ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-04-30', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 20, 'Activo', 'No'),
(1397, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2013-04-30', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 20, 'Activo', 'No'),
(1398, '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 20, 'Activo', 'No'),
(1399, '2023-12-01 00:00:00', 'ESCRITORIO EN L SOLINOF', 'ESCRITORIO EN L - SOLINOF MADERA Y METAL GRIS, BEIGE Y CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '2012-12-31', 2956860, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1400, '2023-12-01 00:00:00', 'EQUIPO DE COMPUTO HP TODO EN UNO ', 'EQUIPO DE COMPUTO HP COMPAQ PRO 4300 CON TECLADO Y MOUSE TODO EN UNO ', 'C9G88LT#ABM', 'MXL24913TD', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '0000-00-00', 1755000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'Si'),
(1401, '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'PAPALERA HORIZONTAL EN  MADERA PARA COMPUTADOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '0000-00-00', 0, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1402, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTEC', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '2013-08-12', 129186, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1403, '2023-12-01 00:00:00', 'ARCHIVADOR GRIS CON LLAVE 4 CAJONES', 'ARCHIVADOR GRIS CON LLAVE 4 CAJONES EN MADERA Y LAMINA METALICA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '2013-08-12', 1448430, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1404, '2023-12-01 00:00:00', 'SILLA AUXILIAR PASTA Y CUERO', 'NEGRA Y CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'MAQUINARIA Y EQUIPO', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '2023-04-24', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1405, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'MAQUINARIA Y EQUIPO', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1406, '2023-12-01 00:00:00', 'BASE MADERA PARA COMPUTADOR NEGRA', 'BASE MADERA PARA COMPUTADOR NEGRA', 'NO APLICA', 'C111967', 'FSC', 'MAQUINARIA Y EQUIPO', '', '', '', '', 'MODULO 1 - JURIDICO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1407, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 4, 'Activo', 'No'),
(1408, '2023-12-01 00:00:00', 'ESCRITORIO SENCILLO GEIGE CON 3 CAJONES Y LLAVE', 'PATAS GRISES EN BUEN ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 18, 'Activo', 'No'),
(1409, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2019-05-28', 579602, 'Regular', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 18, 'Activo', 'No'),
(1410, '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2019-05-28', 0, 'Buena', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 18, 'Activo', 'No'),
(1411, '2023-12-01 00:00:00', 'TELEFONO', 'INHALAMBRICO', 'STI3522', 'QNUE4101585K6', 'SIMPLY', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 18, 'Activo', 'No'),
(1412, '2023-12-01 00:00:00', 'UN ESCRITORIO EN L COLOR BEIGE', 'TRES CAJONES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1413, '2023-12-01 00:00:00', 'PALOMERA ', 'CAFÉ Y GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '2023-11-30', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1414, '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'COLOR MADERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1415, '2023-12-01 00:00:00', 'TELEFONO FIJO ', 'COLOR NEGRO INHALAMBRICO', 'KX-TGB112LAB', '1DAFDO74721', 'PASASONIC', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1416, '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1417, '2023-12-01 00:00:00', 'CALCULADORA', 'CALCULADORA DE IMPRESION', 'DR-120TM', '360BL29DA085618', 'CACIO', 'CONTROL', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1418, '2023-12-01 00:00:00', 'SILLA AUXILIAR EN CUERO VISITANTE', 'COLOR NEGRO Y AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1419, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'COLOR AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1420, '2023-12-01 00:00:00', 'CAJA FUERTE', 'COLOR NEGRO Y GRIS', 'NO APLICA', '47470', 'CAJAS FUERTES ANCLAS S.A', 'EQUIPO DE OFICINA', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 1148400, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Activo', 'No'),
(1421, '2023-12-01 00:00:00', 'ESCRITORIO SENCILLO GEIGE CON 3 CAJONES Y LLAVE', 'PATAS GRISES EN BUEN ESTADO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 1, 'Activo', 'No'),
(1422, '2023-12-01 00:00:00', 'SILLA ERGONOMICA CUERO AZUL', 'CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 579602, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 1, 'Activo', 'No'),
(1423, '2023-12-01 00:00:00', 'DESTRUCTORA DE PAPEL', 'COLOR NEGRO', 'NO APLICA', 'SHREDDER X6', 'PELIKAN', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 102900, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1424, '2023-12-01 00:00:00', 'ESCRITORIO 3 CAJONES', 'MODULO COLOR BEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1425, '2023-12-01 00:00:00', 'PORTATIL CON MOUSE Y TECLADO', 'COLOR NEGRO', 'NO APLICA', 'ZFIP00822020', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1426, '2023-12-01 00:00:00', 'BASE DE PORTATIL', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1427, '2023-12-01 00:00:00', 'REPOSA PIES', 'COLOR NEGRO', 'NO APLICA', 'NO APLICA', 'ARTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1428, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'COLOR AZUL CON RODACHINES', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1429, '2023-12-01 00:00:00', 'ESTANTERIA', 'ESTANTERIA METALICA COLOR GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1430, '2023-12-01 00:00:00', 'ESTANTERIA', 'ESTANTERIA METALICA COLOR GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1431, '2023-12-01 00:00:00', 'ESTANTERIA', 'ESTANTERIA METALICA COLOR GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1432, '2023-12-01 00:00:00', 'ESTANTERIA', 'ESTANTERIA METALICA COLOR GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1433, '2023-12-01 00:00:00', 'ESTANTERIA', 'COLOR GUENGUE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1434, '2023-12-01 00:00:00', 'ARCHIVADOR / ESTANTERIA', 'MATERIAL DE METAL COLOR GRIS', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1435, '2023-12-01 00:00:00', 'ESCRITORIO', 'TRES CAJONES COLOR BEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1436, '2023-12-01 00:00:00', 'ESCALERA 2 PUESTOS ACERO ', 'BLANCA Y NEGRO ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1437, '2023-12-01 00:00:00', 'ESTANTERIA 1 DE 1X5', '', 'NO APLICA ', 'NO APLICA ', 'NO APLICA ', 'EQUIPO DE OFICINA', '', '', '', '', 'ARCHIVO FISICO', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1438, '2023-12-01 00:00:00', 'ESTANTERIA 2 DE 1X5', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'CRISTIAN BENABIDES', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1439, '2023-12-01 00:00:00', 'ESTANTERIA 3 DE 1X5', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'NO APLICA ', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1440, '2023-12-01 00:00:00', 'ESTANTERIA 4 DE 1X5', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1441, '2023-12-01 00:00:00', 'ESTANTERIA 5 DE 1X5', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', '', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1442, '2023-12-01 00:00:00', 'ESTANTERIA 6 DE 1X5', '', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'CRISTIAN BENABIDES', 'Ninguna', 0, '0000-00-00', 103806, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 24, 'Activo', 'No'),
(1443, '2023-12-01 00:00:00', 'ESCRITORIO 3 CAJONES', 'MODULO COLOR BEIGE', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 10, 'Activo', 'No'),
(1444, '2023-12-01 00:00:00', 'COMPUTADOR DE MESA, CON TECLADO Y MOUSE', 'COLOR CAFÉ, ', '195LM003', 'KOXHA1A000382', 'NOC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 10, 'Activo', 'Si'),
(1445, '2023-12-01 00:00:00', 'TORRE DE COMPUTADOR', 'COLOR NEGRO', '1040-900-0091', '200SN82689', 'COMPUMAX', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 10, 'Activo', 'Si'),
(1446, '2023-12-01 00:00:00', 'TELEFONO FIJO', 'INHALAMBRICO', 'NO APLICA', '1DASD74657', 'PANASONIC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 10, 'Activo', 'No'),
(1447, '2023-12-01 00:00:00', 'ESCRITORIO EN L SOLINOF', 'ESCRITORIO EN L - SOLINOF MADERA Y METAL GRIS, BEIGE Y CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1448, '2023-12-01 00:00:00', 'DIVISIÓN METALICA, VIDRIO Y MADERA', 'DIVISIÓN EN MODULO DE 23 ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 2956860, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1449, '2023-12-01 00:00:00', 'PAPELERA HORIZONTAL DEL MADERA 2 MODULOS ', 'PAPALERA HORIZONTAL EN  MADERA PARA COMPUTADOR CAFÉ', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1450, '2023-12-01 00:00:00', 'BLACK OUT - PERSIANA', 'BLACK OUT-PERSIANAS ENROLLABLE (1 METRO)', 'NO APLICA', 'NO APLICA', 'SUNTECA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 129186, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1451, '2023-12-01 00:00:00', 'ARCHIVADOR EN FORMA DE PALOMERA', 'ARCHIVADOR EN FORMA DE PALOMERA', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1452, '2023-12-01 00:00:00', 'TELEFONO FIJO PASASONIC', 'NEGRO', 'NO APLICA', 'KXTS500LX', 'PANASONIC', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1453, '2023-12-01 00:00:00', 'PANTALLA', 'DE MESA COLOR NEGRO ', 'NO APLICA', '60RBM13', 'DELL', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1454, '2023-12-01 00:00:00', 'PORTATIL', 'COLOR NEGRO CON CARGADOR', 'NO APLICA', 'NO APLICA', 'LENOVO', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 1790000, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1455, '2023-12-01 00:00:00', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'SILLA ERGONOMICA TERCIOPELO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 289801, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(1456, '2023-12-01 00:00:00', 'SILLA AUXILIAR PASTA Y CUERO VISITANTE', 'NEGRA Y CUERO AZUL', 'NO APLICA', 'NO APLICA', 'NO APLICA', 'EQUIPO DE OFICINA', '', '', '', '', 'MODULO 1 - SIG', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 17, 'Activo', 'No'),
(82305, '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82305', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP ', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Bueno', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 16, 'Rentado', 'Si'),
(82306, '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82306', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'U:O PISO 2', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 22, 'Rentado', 'Si'),
(82307, '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82307', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 20, 'Rentado', 'Si'),
(82308, '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82308', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP ', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 3, 'Rentado', 'Si'),
(82309, '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO VENTANILLA PRNINCIPAL', 'NEGRO TODO EN 1 ARRENDADO', '82309', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2019-08-09', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 7, 'Rentado', 'Si'),
(82310, '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82310', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 1, 'Rentado', 'Si');
INSERT INTO `activos` (`id_activo`, `fecha_asignacion`, `nombre_articulo`, `descripcion_articulo`, `modelo_articulo`, `referencia_articulo`, `marca_articulo`, `tipo_articulo`, `ip`, `windows`, `office`, `factura_office`, `lugar_articulo`, `observaciones_articulo`, `numero_factura`, `fecha_garantia`, `valor_articulo`, `condicion_articulo`, `id_proveedor_fk`, `descripcion_proveedor`, `id_usuario_fk`, `estado_activo`, `recurso_tecnologico`) VALUES
(82311, '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82311', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 23, 'Rentado', 'Si'),
(82312, '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82312', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'OFI. CONTADORA', 'Ninguna', 0, '0000-00-00', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 6, 'Rentado', 'Si'),
(82313, '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82313', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2023-05-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 28, 'Rentado', 'Si'),
(82314, '2023-12-01 00:00:00', 'COMPUTADOR TODO EN 1 HP INTEL VPRO ', 'NEGRO TODO EN 1 ARRENDADO', '82314', 'PCAIO HP440 PROONE G9 CORE I 5 - 12/16', 'HP', 'EQUIPO DE COMPUTACION Y COMUNICACIÓN', '', '', '', '', 'PISO 1 (OPERACIONES)', 'Ninguna', 0, '2012-12-31', 0, 'Excelente', 0, 'Inventario Diciembre 2023 (No aplica proveedores antes del 31/12/2023 )', 18, 'Rentado', 'Si'),
(182323, '0000-00-00 00:00:00', 'nombre_articulo', 'descripcion_articulo', 'modelo_articulo', 'referencia_articulo', 'marca_articulo', 'tipo_articulo', 'ip', 'windows', 'office', 'factura_office', 'lugar_articulo', 'observaciones_articulo', 0, '0000-00-00', 0, 'condicion_articulo', 0, 'descripcion_proveedor', 0, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `nombre_cargo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `nombre_cargo`) VALUES
(1, 'Coordinadora Tecnologia e Informatica'),
(2, 'Auxiliar Tecnologia e Informatica'),
(3, 'Auxiliar SST'),
(4, 'Coordinador SIG'),
(5, 'Auxiliar Administrativo'),
(6, 'Director Administativo'),
(7, 'Directora Operaciones'),
(8, 'Cordinador Operaciones'),
(9, 'Analista Operaciones'),
(10, 'Auxiliar Operaciones'),
(11, 'Mensajero'),
(12, 'Directora Contable'),
(13, 'Auxiliar Contable'),
(14, 'Lider Jurico'),
(15, 'Coordinador Tecnico'),
(16, 'Auxiliar de Gestion Documental'),
(18, 'Auxiliar de Monitoreo'),
(19, 'Gerente'),
(20, 'Supernumeraria'),
(21, 'Practicante SIG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_actividad`
--

CREATE TABLE `detalle_actividad` (
  `id_detalle_acpm` int(11) NOT NULL,
  `fecha_evidencia` date NOT NULL DEFAULT current_timestamp(),
  `evidencia` text NOT NULL,
  `recursos` text NOT NULL,
  `id_actividad_fk` int(11) NOT NULL,
  `id_usuario_e_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalle_actividad`
--

INSERT INTO `detalle_actividad` (`id_detalle_acpm`, `fecha_evidencia`, `evidencia`, `recursos`, `id_actividad_fk`, `id_usuario_e_fk`) VALUES
(32, '2023-12-07', 'nueva <a href=\"http://localhost/SADOC/admin/informe_acpm.php?id_acpm=7\" target=\"_blank\">solucion</a>', 'Humanos', 14, 2),
(33, '2023-12-22', '<a href=\"ddddddddddddddddd\" target=\"_blank\">ddddddddddddddddd</a>', 'Humanos', 14, 2),
(34, '2023-12-20', '45', 'Humanos', 15, 2),
(35, '2023-12-13', 'qqqqqqqq', 'Humanos', 16, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden`
--

CREATE TABLE `detalle_orden` (
  `id_orden_detalle` int(11) NOT NULL,
  `articulo_compra` text NOT NULL,
  `cantidad_orden` float NOT NULL,
  `valor_neto` float NOT NULL,
  `valor_iva` float NOT NULL,
  `valor_total` float NOT NULL,
  `observaciones_articulo` text NOT NULL,
  `id_orden_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalle_orden`
--

INSERT INTO `detalle_orden` (`id_orden_detalle`, `articulo_compra`, `cantidad_orden`, `valor_neto`, `valor_iva`, `valor_total`, `observaciones_articulo`, `id_orden_compra`) VALUES
(15, 'Pc', 124854, 151, 1, 1, '', 2),
(16, 'Telefono', 124854, 151, 1, 1, '', 2),
(17, 'Pc', 124854, 151, 1, 1, '', 3),
(18, 'Telefono', 124854, 151, 1, 1, '', 3),
(19, '111', 1, 1, 1, 1, '1', 4),
(20, '2', 2, 2, 2, 2, '', 5),
(21, '1', 1, 1, 1, 1, '', 6),
(22, '2', 2, 2, 2, 2, '', 7),
(23, '2', 2, 2, 2, 2, '', 8),
(24, '1', 1, 1, 1, 1, '', 9),
(25, '1', 1, 1200000, 0, 1200000, '', 10),
(26, '1', 1, 1200000, 0, 1200000, '', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `id_orden` int(11) NOT NULL,
  `fecha_orden` date DEFAULT NULL,
  `proveedor_recurrente` enum('Si','No') NOT NULL,
  `forma_pago` enum('Contado','Credito','Anticipo','Otros') DEFAULT NULL,
  `tiempo_pago` varchar(50) DEFAULT NULL,
  `porcentaje_anticipo` float DEFAULT NULL,
  `condiciones_negociacion` text DEFAULT NULL,
  `comentario_orden` text DEFAULT NULL,
  `tiempo_entrega` varchar(300) DEFAULT NULL,
  `total_orden` float DEFAULT NULL,
  `analisis_cotizacion` enum('Si','No') DEFAULT NULL,
  `estado_orden` enum('Proceso','Aprobada','Denegada','Analisis de Cotizacion','Ejecutada') DEFAULT NULL,
  `descripcion_declinado` text DEFAULT NULL,
  `fecha_aprobacion` datetime DEFAULT NULL,
  `id_cotizante` int(11) DEFAULT NULL,
  `id_proveedor_fk` int(11) DEFAULT NULL,
  `id_gerente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`id_orden`, `fecha_orden`, `proveedor_recurrente`, `forma_pago`, `tiempo_pago`, `porcentaje_anticipo`, `condiciones_negociacion`, `comentario_orden`, `tiempo_entrega`, `total_orden`, `analisis_cotizacion`, `estado_orden`, `descripcion_declinado`, `fecha_aprobacion`, `id_cotizante`, `id_proveedor_fk`, `id_gerente`) VALUES
(2, '2023-11-28', 'No', 'Contado', '', 0, '', '<p>aaaa</p>', '1', 2, 'No', 'Denegada', NULL, NULL, 2, 42024431, NULL),
(3, '2023-11-28', 'No', 'Contado', '', 0, '', '<p>aaaa</p>', '1', 2, 'No', 'Denegada', NULL, NULL, 2, 42024431, NULL),
(4, '2023-11-29', 'Si', 'Credito', '1', 0, '', '<p>1</p>', '1', 1, 'No', 'Denegada', NULL, NULL, 2, 42024431, NULL),
(5, '2023-11-30', 'Si', 'Credito', '1', 0, '', '<p>1</p>', '1', 2, 'No', 'Denegada', NULL, NULL, 2, 1087561072, NULL),
(6, '2023-12-04', 'No', 'Contado', '', 0, '', '<p>111</p>', '1', 1, 'No', 'Denegada', NULL, NULL, 2, 42024431, NULL),
(7, '2023-12-04', 'No', 'Contado', '', 0, '', '<p><u>22</u></p>', '2', 2, 'No', 'Denegada', NULL, NULL, 2, 42024431, NULL),
(8, '2023-12-04', 'No', 'Contado', '', 0, '', '<p><u>22</u></p>', '2', 2, 'No', 'Denegada', NULL, NULL, 2, 42024431, NULL),
(9, '2023-12-04', 'No', 'Contado', '', 0, '', '<p>111</p>', '111', 1, 'No', 'Denegada', NULL, NULL, 2, 515, NULL),
(10, '2023-12-04', 'No', 'Contado', '', 0, '', '<p>1</p>', '1', 2400000, 'Si', 'Proceso', NULL, NULL, 2, 1087561072, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `id_proceso` int(11) NOT NULL,
  `siglas_proceso` varchar(20) NOT NULL,
  `nombre_proceso` varchar(30) NOT NULL,
  `estado_proceso` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`id_proceso`, `siglas_proceso`, `nombre_proceso`, `estado_proceso`) VALUES
(1, 'SIG', 'Sistema Integrado de Gestion', 'Activo'),
(2, 'TI', 'Tecnologi­a e Informatica', 'Activo'),
(3, 'CT', 'Contabilidad', 'Activo'),
(4, 'TEC', 'Tecnico', 'Activo'),
(5, 'GH', 'Gestion Humana', 'Activo'),
(6, 'GD', 'Gestion Documental', 'Activo'),
(7, 'OP', 'Operaciones', 'Activo'),
(8, 'PH', 'Propiedad Horizontal', 'Activo'),
(9, 'SST', 'Seguridad Salud en el Trabajo', 'Activo'),
(10, 'GR', 'Gerencia', 'Activo'),
(11, 'JR', 'Gestion Juridica', 'Activo'),
(12, 'PLE', 'Planeacion Estrategia', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_compras`
--

CREATE TABLE `proveedor_compras` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(200) NOT NULL,
  `contacto_proveedor` varchar(100) NOT NULL,
  `telefono_proveedor` varchar(15) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `proveedor_compras`
--

INSERT INTO `proveedor_compras` (`id_proveedor`, `nombre_proveedor`, `contacto_proveedor`, `telefono_proveedor`, `id_usuario_fk`) VALUES
(0, 'NO APLICA', 'NO APLICA', '3218124847', 1),
(515, '151', 'yumemogu@gmail.com', '151', 2),
(42024431, 'Lucenia', 'ymontoya@zonafrancadepereira.com', '321548151', 2),
(1087561072, 'Melissa Montoya', 'melissa@gmail.com', '3218124874', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sadoc`
--

CREATE TABLE `sadoc` (
  `id` int(11) NOT NULL,
  `ruta` varchar(500) NOT NULL,
  `ruta_principal` varchar(500) NOT NULL,
  `Fecha_Subida` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('activo','inactivo') NOT NULL,
  `sub_Carpeta` enum('Si','No') NOT NULL,
  `id_proceso_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `sadoc`
--

INSERT INTO `sadoc` (`id`, `ruta`, `ruta_principal`, `Fecha_Subida`, `estado`, `sub_Carpeta`, `id_proceso_fk`) VALUES
(1, 'files//u446101023_app (1).sql', 'files//', '2023-11-30 21:28:42', 'activo', 'No', 2),
(2, 'files//SADOC Gestor.pdf', 'files//', '2023-11-30 21:30:52', 'activo', 'No', 2),
(3, 'files/TI/Documentos/SADOC Gestor.pdf', 'files/TI/Documentos/', '2023-11-30 21:32:20', 'activo', 'Si', 2),
(4, 'files/TI/Documentos/SADOC Gestor.pdf', 'files/TI/Documentos/', '2023-11-30 21:32:38', 'activo', 'Si', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `rol_usuario` varchar(100) NOT NULL,
  `admin_acpm` enum('Si','No') NOT NULL,
  `radicar_acpm` enum('Si','No') NOT NULL,
  `admin_sadoc` enum('Si','No') NOT NULL,
  `consultar_sadoc` enum('Si','No') NOT NULL,
  `ordenes` enum('Si','No') NOT NULL,
  `admin_compras` enum('Si','No') NOT NULL,
  `pagar_ordenes` enum('Si','No') NOT NULL,
  `analisis_cotizacion` enum('Si','No') NOT NULL,
  `radicar_orden` enum('Si','No') NOT NULL,
  `firmar_orden` enum('Si','No') NOT NULL,
  `evaluar_proveedor` enum('Si','No') NOT NULL,
  `admin_activos` enum('Si','No','','') NOT NULL,
  `consultar_activos` enum('Si','No','','') NOT NULL,
  `ingresar_activos` enum('Si','No') NOT NULL,
  `editar_activos` enum('Si','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `rol_usuario`, `admin_acpm`, `radicar_acpm`, `admin_sadoc`, `consultar_sadoc`, `ordenes`, `admin_compras`, `pagar_ordenes`, `analisis_cotizacion`, `radicar_orden`, `firmar_orden`, `evaluar_proveedor`, `admin_activos`, `consultar_activos`, `ingresar_activos`, `editar_activos`) VALUES
(1, 'superadmin', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si'),
(2, 'admin_sig', 'Si', 'Si', 'Si', 'Si', 'Si', 'No', 'No', 'No', 'Si', 'No', 'Si', 'Si', 'Si', 'Si', 'Si'),
(3, 'usuario_aux', 'No', 'No', 'No', 'Si', 'Si', 'No', 'No', 'No', 'No', 'No', 'No', 'Si', 'Si', 'Si', 'Si'),
(4, 'gerencia', 'No', 'Si', 'No', 'Si', 'Si', 'No', 'No', 'No', 'No', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si'),
(5, 'directivo', 'No', 'Si', 'No', 'Si', 'Si', 'No', 'No', 'No', 'Si', 'No', 'Si', 'Si', 'Si', 'Si', 'Si'),
(6, 'aux_cotizacion', 'No', 'No', 'No', 'Si', 'Si', 'No', 'No', 'Si', 'No', 'No', 'Si', 'Si', 'Si', 'Si', 'Si'),
(7, 'aux_contable', 'No', 'No', 'No', 'Si', 'Si', 'No', 'Si', 'No', 'No', 'No', 'No', 'Si', 'Si', 'Si', 'Si'),
(8, 'admin_contable', 'No', 'Si', 'No', 'Si', 'Si', 'No', 'Si', 'No', 'Si', 'No', 'Si', 'Si', 'Si', 'Si', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_usuario` int(11) NOT NULL,
  `correo_usuario` varchar(100) DEFAULT NULL,
  `contrasena_usuario` varchar(10) DEFAULT NULL,
  `nombre_usuario` varchar(20) DEFAULT NULL,
  `apellidos_usuario` varchar(20) DEFAULT NULL,
  `siglas_usuario` varchar(50) NOT NULL,
  `estado_usuario` enum('activo','inactivo') DEFAULT NULL,
  `firma_usuario` text NOT NULL,
  `dia_backup` enum('lunes','martes','miercoles','jueves','viernes') NOT NULL,
  `proceso_usuario_fk` int(11) NOT NULL,
  `id_cargo_fk` int(11) NOT NULL,
  `tipo_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_usuario`, `correo_usuario`, `contrasena_usuario`, `nombre_usuario`, `apellidos_usuario`, `siglas_usuario`, `estado_usuario`, `firma_usuario`, `dia_backup`, `proceso_usuario_fk`, `id_cargo_fk`, `tipo_usuario_fk`) VALUES
(1, 'ssierra@zonafrancadepereira.com', '8521', 'Stefania', 'Sierra Loaiza', '', 'activo', '', 'lunes', 7, 9, 2),
(2, 'ymontoyag@zonafrancadepereira.com', '2012', 'Yuliana Melissa', 'Montoya', 'ZFIP-TI01', 'activo', '65660ce9edcc9_650b541b0e691_firma meli.png', 'lunes', 2, 1, 2),
(3, 'jcardona@zonafrancadepereira.com', '6325', 'Jorge Eliecer', 'Garcia Cardona', '', 'activo', '', 'lunes', 2, 1, 3),
(4, 'sbermudez@zonafrancadepereira.com', '5212', 'Santiago', 'Bermudez Marin', '', 'activo', '', 'lunes', 2, 1, 3),
(5, 'mensajeria@zonafrancadepereira.com', '9632', 'Santiago', 'Rendon', '', 'activo', '', 'lunes', 2, 1, 3),
(6, 'ssalazar@zonafrancadepereira.com', '4789', 'Sonia Janeth', 'Salazar Oviedo ', '', 'activo', '', 'lunes', 2, 1, 3),
(7, 'aledesma@zonafrancadepereira.com', '3215', 'Aura Mar¡a', 'Ledesma', '', 'activo', '', 'lunes', 10, 19, 3),
(8, 'auxiliarsst@zonafrancadepereira.com', '9845', 'Oscar Julian', 'Millan Rodas', '', 'activo', '', 'lunes', 2, 1, 3),
(9, 'monitoreo@zonafrancadepereira.com', '2105', 'Monitoreo', 'ZFIP', '', 'activo', '', 'lunes', 2, 1, 3),
(10, 'ygarciaz@zonafrancadepereira.com', '9874', 'Yaqueline', 'Garcia Zapata', '', 'activo', '', 'lunes', 2, 1, 4),
(11, 'agalan@zonafrancadepereira.com', '8745', 'Andrea ', 'Galan Moreno', '', 'activo', '', 'lunes', 10, 19, 4),
(12, 'cbustamante@zonafrancadepereira.com', '6302', 'Isabel Cristina', 'Bustamante', '', 'activo', '', 'lunes', 5, 5, 6),
(13, 'evelasquez@zonafrancadepereira.com', '7913', 'Estefania', 'Velasquez', '', 'activo', '', 'lunes', 2, 1, 3),
(14, 'bparra@zonafrancadepereira.com', '5241', 'Bayron Julian', 'Gomez Parra', '', 'activo', '', 'lunes', 2, 1, 3),
(15, 'fgomez@zonafrancadepereira.com', '5213', 'Faisury', 'Gomez Serna', '', 'activo', '', 'lunes', 2, 1, 3),
(16, 'jperez@zonafrancadepereira.com', '3054', 'Juan Carlos', 'P‚rez Rodas', '', 'activo', '', 'lunes', 2, 1, 3),
(17, 'yrios@zonafrancadepereira.com', '7852', 'Yuly Viviana', 'Rios Casta¤o', '', 'activo', '', 'lunes', 2, 1, 3),
(18, 'Serazo@zonafrancadepereira.com', '8415', 'Sebastian', 'Erazo Aguirre', '', 'activo', '', 'lunes', 2, 1, 3),
(19, 'practicantesig@zonafrancadepereira.com', '6825', 'Jennifer Alexandra', 'Villada Gonzales', '', 'activo', '', 'lunes', 2, 1, 3),
(20, 'rsoto@zonafrancadepereira.com', '9730', 'Robert Arturo', 'Soto V‚lez', '', 'activo', '', 'lunes', 2, 1, 3),
(21, 'jraigosa@zonafrancadepereira.com', '6548', 'Julio', 'Raigosa', '', 'activo', '', 'lunes', 2, 1, 3),
(22, 'ylopez@zonafrancadepereira.com', '1548', 'Yuliana Andrea', 'Lopez Taborda', '', 'activo', '', 'lunes', 2, 1, 3),
(23, 'jgutierrez@zonafrancadepereira.com', '2315', 'Julian Bernardo', 'Gutierrez Naranjo', '', 'activo', '', 'lunes', 2, 1, 3),
(24, 'malvarez@zonafrancadepereira.com', '6582', 'Maria Valentina', 'Alvarez Gallego', '', 'activo', '', 'lunes', 2, 1, 3),
(25, 'gerencia@creserconsultores.com.co', '3201', 'Mateo', 'Rios', '', 'activo', '', 'lunes', 2, 1, 3),
(26, 'alagos@zonafrancadepereira.com', '7895', 'Ana Luisa', ' Lagos Pati¤o', '', 'activo', '', 'lunes', 2, 1, 3),
(27, 'diradministrativo@zonafrancadepereira.com', '9654', 'Cristian', 'Benavides', '', 'activo', '', 'lunes', 2, 1, 3),
(28, 'kechavarria@zonafrancadepereira.com', '9632', 'Kevin David', 'Echavarria Gonzalez', '', 'activo', '', 'lunes', 2, 1, 3),
(55, 'correo_usuario', 'contrasena', 'nombre_usuario', 'apellidos_usuario', 'salario_us', '', 'firma_usuario', 'lunes', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vencimiento_acpm`
--

CREATE TABLE `vencimiento_acpm` (
  `id_notificacion` int(11) NOT NULL,
  `id_acpm_fk` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `vencimiento_acpm`
--

INSERT INTO `vencimiento_acpm` (`id_notificacion`, `id_acpm_fk`, `fecha_vencimiento`) VALUES
(3, 7, '2023-12-16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acpm`
--
ALTER TABLE `acpm`
  ADD PRIMARY KEY (`id_consecutivo`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Indices de la tabla `acpm_rechazada`
--
ALTER TABLE `acpm_rechazada`
  ADD PRIMARY KEY (`id_rechazada`),
  ADD KEY `id_acpm_fk` (`id_acpm_fk`);

--
-- Indices de la tabla `actividades_acpm`
--
ALTER TABLE `actividades_acpm`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`),
  ADD KEY `id_acpm_fk` (`id_acpm_fk`);

--
-- Indices de la tabla `activos`
--
ALTER TABLE `activos`
  ADD PRIMARY KEY (`id_activo`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`),
  ADD KEY `id_proveedor` (`id_proveedor_fk`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  ADD PRIMARY KEY (`id_detalle_acpm`),
  ADD KEY `id_actividad_fk` (`id_actividad_fk`),
  ADD KEY `id_usuario_e_fk` (`id_usuario_e_fk`);

--
-- Indices de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD PRIMARY KEY (`id_orden_detalle`),
  ADD KEY `id_orden_compra` (`id_orden_compra`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `id_cotizante` (`id_cotizante`),
  ADD KEY `id_gerente` (`id_gerente`),
  ADD KEY `id_proveedor_fk` (`id_proveedor_fk`);

--
-- Indices de la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD PRIMARY KEY (`id_proceso`);

--
-- Indices de la tabla `proveedor_compras`
--
ALTER TABLE `proveedor_compras`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Indices de la tabla `sadoc`
--
ALTER TABLE `sadoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cargo_fk` (`id_proceso_fk`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_usuario`),
  ADD KEY `proceso_usuario_fk` (`proceso_usuario_fk`,`id_cargo_fk`,`tipo_usuario_fk`),
  ADD KEY `id_cargo_fk` (`id_cargo_fk`),
  ADD KEY `tipo_usuario_fk` (`tipo_usuario_fk`);

--
-- Indices de la tabla `vencimiento_acpm`
--
ALTER TABLE `vencimiento_acpm`
  ADD PRIMARY KEY (`id_notificacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acpm`
--
ALTER TABLE `acpm`
  MODIFY `id_consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `acpm_rechazada`
--
ALTER TABLE `acpm_rechazada`
  MODIFY `id_rechazada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `actividades_acpm`
--
ALTER TABLE `actividades_acpm`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `activos`
--
ALTER TABLE `activos`
  MODIFY `id_activo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182324;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  MODIFY `id_detalle_acpm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  MODIFY `id_orden_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `id_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `sadoc`
--
ALTER TABLE `sadoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `vencimiento_acpm`
--
ALTER TABLE `vencimiento_acpm`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activos`
--
ALTER TABLE `activos`
  ADD CONSTRAINT `activos_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`Id_usuario`),
  ADD CONSTRAINT `activos_ibfk_2` FOREIGN KEY (`id_proveedor_fk`) REFERENCES `proveedor_compras` (`id_proveedor`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`proceso_usuario_fk`) REFERENCES `proceso` (`id_proceso`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_cargo_fk`) REFERENCES `cargos` (`id_cargo`),
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`tipo_usuario_fk`) REFERENCES `tipo_usuario` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
