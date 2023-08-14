-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2023 a las 17:01:43
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `upload`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acpm`
--

CREATE TABLE IF NOT EXISTS `acpm` (
`id_consecutivo` int(11) NOT NULL,
  `origen_acpm` text NOT NULL,
  `fuente_acpm` enum('AI','AE','Otros') NOT NULL,
  `descripcion_fuente` text NOT NULL,
  `tipo_acmp` enum('AC','AP','AM') NOT NULL,
  `fecha_acpm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion_acpm` text NOT NULL,
  `causa_acpm` text NOT NULL,
  `nc_similar` enum('Si','No') NOT NULL,
  `descripcion_nsc` text NOT NULL,
  `correcion_acpm` text NOT NULL,
  `fecha_correcion` date DEFAULT NULL,
  `estado_acpm` enum('Abierta','Proceso','Cerrada','Rechazada') NOT NULL,
  `riesgo_acpm` enum('Si','No') NOT NULL,
  `justificacion_riesgo` text NOT NULL,
  `cambios_sig` enum('Si','No') NOT NULL,
  `justificacion_sig` text NOT NULL,
  `conforme` enum('Si','No') NOT NULL,
  `justificacion_conforme` text NOT NULL,
  `fecha_estado` enum('Abierta','Proceso','Cerrada') DEFAULT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades_acpm`
--

CREATE TABLE IF NOT EXISTS `actividades_acpm` (
`id_actividad` int(11) NOT NULL,
  `fecha_actividad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion_actividad` text NOT NULL,
  `estado_actividad` enum('Completa','Incompleta') NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_acpm_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE IF NOT EXISTS `cargos` (
`id_cargo` int(11) NOT NULL,
  `siglas_cargo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_cargo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `estado_cargo` enum('Activo','Inactivo') COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `siglas_cargo`, `nombre_cargo`, `estado_cargo`) VALUES
(1, 'SIG', 'Sistema Integrado de Gestión', 'Activo'),
(2, 'TI', 'Tecnología e Informática', 'Activo'),
(3, 'CT', 'Contabilidad', 'Activo'),
(4, 'TEC', 'Técnico', 'Activo'),
(5, 'GH', 'Gestión Humana', 'Activo'),
(6, 'GD', 'Gestion Documental', 'Activo'),
(7, 'OP', 'Operaciones', 'Activo'),
(8, 'PH', 'Propiedad Horizontal', 'Activo'),
(9, 'SST', 'Seguridad Salud en el Trabajo', 'Activo'),
(10, 'GR', 'Gerencia', 'Activo'),
(11, 'JR', 'Gestión Juridica', 'Activo'),
(12, 'PLE', 'Planeacion Estrategia', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_actividad`
--

CREATE TABLE IF NOT EXISTS `detalle_actividad` (
`id_detalle_acpm` int(11) NOT NULL,
  `fecha_evidencia` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `evidencia` text NOT NULL,
  `recursos` text NOT NULL,
  `id_actividad_fk` int(11) NOT NULL,
  `id_usuario_e_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sadoc`
--

CREATE TABLE IF NOT EXISTS `sadoc` (
`id` int(11) NOT NULL,
  `ruta` varchar(500) NOT NULL,
  `ruta_principal` varchar(500) NOT NULL,
  `Fecha_Subida` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('activo','inactivo') NOT NULL,
  `sub_Carpeta` enum('Si','No') NOT NULL,
  `id_cargo_fk` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Volcado de datos para la tabla `sadoc`
--

INSERT INTO `sadoc` (`id`, `ruta`, `ruta_principal`, `Fecha_Subida`, `estado`, `sub_Carpeta`, `id_cargo_fk`) VALUES
(25, 'files/Conta/Formatos/FO-FI-12 Arqueo de Caja V2.xlsx', 'files/Conta/Formatos/', '2019-05-29 18:52:34', 'activo', 'Si', 3),
(28, 'files/TI/Formatos/CAMARA DE COMERCIO06 JUNIO 2023.pdf', 'files/TI/Formatos/', '2023-07-18 19:45:08', 'activo', 'Si', 2),
(30, 'files/TI/Documentos/CAMARA DE COMERCIO06 JUNIO 2023.pdf', 'files/TI/Documentos/', '2023-07-18 19:45:49', 'activo', 'Si', 2),
(34, 'files/TI/Documentos/CERTF BANCOLOMBIA.pdf', 'files/TI/Documentos/', '2023-07-18 19:51:39', 'activo', 'Si', 2),
(44, 'files/conta/ACTIVOS FIJOS.pdf', 'files/conta/', '2023-07-18 22:05:22', 'activo', 'No', 3),
(58, 'files/GH/Compras/ZONA FRANCA blnaci.png', 'files/GH/Compras/', '2023-07-18 22:53:46', 'activo', 'Si', 5),
(59, 'files/GH/SUPERNUMERARIA.pdf', 'files/GH/', '2023-07-18 22:53:59', 'activo', 'No', 5),
(60, 'files/OP/SUPERNUMERARIA.pdf', 'files/OP/', '2023-07-19 13:18:43', 'activo', 'No', 7),
(79, 'files/JR/NUEVO/SUPERNUMERARIA.pdf', 'files/JR/NUEVO/', '2023-07-24 14:09:19', 'activo', 'Si', 11),
(80, 'files/PLE/Cadena de Suministro/nuevo/SUPERNUMERARIA.pdf', 'files/PLE/Cadena de Suministro/nuevo/', '2023-07-24 14:24:41', 'activo', 'Si', 11),
(81, 'files/PLE/Cadena de Suministro/nuevo/CAMARA DE COMERCIO06 JUNIO 2023.pdf', 'files/PLE/Cadena de Suministro/nuevo/', '2023-07-24 14:25:06', 'activo', 'Si', 11),
(84, 'files/PLE/CONTEXTO/SUPERNUMERARIA.pdf', 'files/PLE/CONTEXTO/', '2023-07-24 14:31:10', 'activo', 'Si', 11),
(85, 'files/PLE/Cadena de Suministro/nuevo/SUPERNUMERARIA.pdf', 'files/PLE/Cadena de Suministro/nuevo/', '2023-07-24 14:39:32', 'activo', 'Si', 11),
(86, 'files/PLE/CONTEXTO/SUPERNUMERARIA.pdf', 'files/PLE/CONTEXTO/', '2023-07-24 14:40:24', 'activo', 'Si', 11),
(87, 'files/TI/Documentos/SUPERNUMERARIA.pdf', 'files/TI/Documentos/', '2023-07-24 15:03:52', 'activo', 'Si', 2),
(89, 'files/PLE/SUPERNUMERARIA.pdf', 'files/PLE/', '2023-07-24 15:06:23', 'activo', 'No', 12),
(92, 'files//pieza definitiva.png', 'files//', '2023-07-24 17:21:22', 'activo', 'No', 2),
(94, 'files//pieza definitiva.png', 'files//', '2023-07-24 17:33:19', 'activo', 'No', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
`id_tipo_usuario` int(11) NOT NULL,
  `rol_usuario` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `rol_usuario`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `Id_usuario` int(11) NOT NULL,
  `correo_usuario` varchar(100) DEFAULT NULL,
  `contrasena_usuario` varchar(10) DEFAULT NULL,
  `nombre_usuario` varchar(20) DEFAULT NULL,
  `apellidos_usuario` varchar(20) DEFAULT NULL,
  `salario_usuario` varchar(10) NOT NULL,
  `estado_usuario` enum('activo','inactivo') DEFAULT NULL,
  `firma_usuario` text NOT NULL,
  `cargo_usuario_fk` int(11) NOT NULL,
  `tipo_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_usuario`, `correo_usuario`, `contrasena_usuario`, `nombre_usuario`, `apellidos_usuario`, `salario_usuario`, `estado_usuario`, `firma_usuario`, `cargo_usuario_fk`, `tipo_usuario_fk`) VALUES
(2, 'ptecnico@zonafrancadepereira.com', '7896', 'Fabio', 'Oliveros', '', 'activo', '', 2, 2),
(3, 'ymontoya@zonafrancadepereira.com', '5689', 'Melissa', 'Montoya', '', 'activo', '', 1, 1),
(4, 'jcardona@zonafrancadepereira.com', '1059', 'Jorge Eliecer', 'Garcia Cardona', '', 'activo', '', 2, 3),
(5, 'pjuridico@zonafrancadepereira.com', '9876', 'Edwin David', 'Vallejo Rodriguez', '', 'activo', '', 2, 3),
(6, 'mensajeria@zonafrancadepereira.com', '1234', 'Juan Carlos', 'Arcila', '', 'activo', '', 2, 3),
(7, 'avasquez@zonafrancadepereira.com', '9853', 'Angelica Maria', 'Vásquez Hoyos', '', 'activo', '', 2, 3),
(9, 'aledesma@zonafrancadepereira.com', '7589', 'Aura María', 'Ledesma', '', 'activo', '', 2, 3),
(10, 'auxiliarsst@zonafrancadepereira.com', '8563', 'Oscar Julian', 'Millan Rodas', '', 'activo', '', 2, 3),
(12, 'monitoreo@zonafrancadepereira.com', '7238', 'Monitoreo', 'PH', '', 'activo', '', 2, 3),
(13, 'dsanchez@zonafrancadepereira.com', '4981', 'Dubian Ernesto', 'Sánchez Muñoz', '', 'activo', '', 2, 3),
(15, 'agalan@zonafrancadepereira.com', '7238', 'Andrea Liliana', 'Galan Moreno', '', 'activo', '', 2, 3),
(17, 'cbustamante@zonafrancadepereira.com', '1439', 'Isabel Cristina', 'Bustamante', '', 'activo', '', 2, 3),
(18, 'yarroyave@zonafrancadepereira.com', '8635', 'Carolina', 'Cardona', '', 'activo', '', 2, 3),
(19, 'jvelasquez@zonafrancadepereira.com', '8952', 'Juan Francisco', 'Velasquez', '', 'activo', '', 2, 3),
(20, 'jrestrepo@zonafrancadepereira.com', '8521', 'Johana Marcela', 'Restrepo Pineda', '', 'activo', '', 2, 3),
(21, 'jperez@zonafrancadepereira.com', '4103', 'Juan Carlos', 'Pérez Rodas', '', 'activo', '', 2, 3),
(24, 'yrios@zonafrancadepereira.com', '9943', 'Yuly Viviana', 'Rios Castaño', '', 'activo', '', 2, 3),
(25, 'ingresos@zonafrancadepereira.com', '7361', 'Ingresos', 'PH', '', 'inactivo', '', 2, 3),
(27, 'ocorrea@zonafrancadepereira.com', '1478', 'Omaira ', 'Correa Guapacha', '', 'inactivo', '', 2, 3),
(30, 'Serazo@zonafrancadepereira.com', '2296', 'Sebastian', 'Erazo Aguirre', '', 'activo', '', 2, 3),
(31, 'epuerta@zonafrancadepereira.com', '2249', 'Erika', 'Puerta Duque', '', 'inactivo', '', 2, 3),
(32, 'rsoto@zonafrancadepereira.com', '8705', 'Robert Arturo', 'Soto Vélez', '', 'activo', '', 2, 3),
(34, 'jraigosa@zonafrancadepereira.com', '8390', 'Julio', 'Raigosa', '', 'activo', '', 2, 3),
(35, 'dsanchez@zonafrancadepereira.com', 'Matriz4981', 'Dubian Ernesto', 'Sánchez Muñoz', '', 'activo', '', 2, 3),
(36, 'mantenimiento@zonafrancadepereira.com', '8756', 'Jhoanny', 'Gil', '', 'activo', '', 2, 3),
(37, 'agalan@zonafrancadepereira.com', 'Matriz7238', 'Andrea Liliana', 'Galan Moreno', '', 'activo', '', 2, 3),
(38, 'jvelasquez@zonafrancadepereira.com', 'Matriz8952', 'Juan Francisco', 'Velasquez', '', 'activo', '', 2, 3),
(39, 'ylopez@zonafrancadepereira.com', '3306', 'Yuliana Andrea', 'Lopez Taborda', '', 'activo', '', 2, 3),
(41, 'agarcia@zonafrancadepereira.com', '8962', 'Alejandro', 'Garcia', '', 'activo', '', 2, 3),
(43, 'yrios@zonafrancadepereira.com', 'Matriz9943', 'Yuly Viviana', 'Rios Castaño', '', 'activo', '', 2, 3),
(50, 'malvarez@zonafrancadepereira.com', '0252', 'Maria Valentina', 'Alvarez Gallego', '', 'activo', '', 2, 3),
(51, 'evallejo@zonafrancadepereira.com', 'Matriz0252', 'Edwin', 'Vallejo', '', 'activo', '', 2, 3),
(52, 'gerencia@creserconsultores.com.co', '8521', 'Mateo', 'Rios', '', 'activo', '', 2, 3),
(53, 'ireyes@zonafrancadepereira.com', '4862', 'Ivonne Viviana', 'Reyes Vallejo', '', 'activo', '', 2, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acpm`
--
ALTER TABLE `acpm`
 ADD PRIMARY KEY (`id_consecutivo`), ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Indices de la tabla `actividades_acpm`
--
ALTER TABLE `actividades_acpm`
 ADD PRIMARY KEY (`id_actividad`), ADD KEY `id_usuario_fk` (`id_usuario_fk`), ADD KEY `id_acpm_fk` (`id_acpm_fk`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
 ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
 ADD PRIMARY KEY (`id_detalle_acpm`), ADD KEY `id_actividad_fk` (`id_actividad_fk`), ADD KEY `id_usuario_e_fk` (`id_usuario_e_fk`);

--
-- Indices de la tabla `sadoc`
--
ALTER TABLE `sadoc`
 ADD PRIMARY KEY (`id`), ADD KEY `id_cargo_fk` (`id_cargo_fk`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
 ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`Id_usuario`), ADD KEY `cargo_fk` (`cargo_usuario_fk`), ADD KEY `cargo_fk_2` (`cargo_usuario_fk`), ADD KEY `tipo_usuario_fk` (`tipo_usuario_fk`), ADD KEY `tipo_usuario_fk_2` (`tipo_usuario_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acpm`
--
ALTER TABLE `acpm`
MODIFY `id_consecutivo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `actividades_acpm`
--
ALTER TABLE `actividades_acpm`
MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
MODIFY `id_detalle_acpm` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sadoc`
--
ALTER TABLE `sadoc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acpm`
--
ALTER TABLE `acpm`
ADD CONSTRAINT `acpm_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`Id_usuario`);

--
-- Filtros para la tabla `actividades_acpm`
--
ALTER TABLE `actividades_acpm`
ADD CONSTRAINT `actividades_acpm_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`Id_usuario`),
ADD CONSTRAINT `actividades_acpm_ibfk_2` FOREIGN KEY (`id_acpm_fk`) REFERENCES `acpm` (`id_consecutivo`);

--
-- Filtros para la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
ADD CONSTRAINT `detalle_actividad_ibfk_1` FOREIGN KEY (`id_actividad_fk`) REFERENCES `actividades_acpm` (`id_actividad`),
ADD CONSTRAINT `detalle_actividad_ibfk_2` FOREIGN KEY (`id_usuario_e_fk`) REFERENCES `usuarios` (`Id_usuario`);

--
-- Filtros para la tabla `sadoc`
--
ALTER TABLE `sadoc`
ADD CONSTRAINT `sadoc_ibfk_1` FOREIGN KEY (`id_cargo_fk`) REFERENCES `cargos` (`id_cargo`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`cargo_usuario_fk`) REFERENCES `cargos` (`id_cargo`),
ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`tipo_usuario_fk`) REFERENCES `tipo_usuario` (`id_tipo_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
