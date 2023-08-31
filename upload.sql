-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-08-2023 a las 02:22:41
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

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
  `estado_acpm` enum('Abierta','Proceso','Cerrada','Rechazada') DEFAULT NULL,
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
(11, '1', 'AI', '', 'AC', '2023-08-30 21:30:35', '1', '1', 'Si', '11', '22', '2023-12-31', 'Abierta', 'No', '', NULL, NULL, NULL, NULL, '2023-08-30', '0000-00-00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades_acpm`
--

CREATE TABLE `actividades_acpm` (
  `id_actividad` int(11) NOT NULL,
  `fecha_actividad` timestamp NOT NULL DEFAULT current_timestamp(),
  `descripcion_actividad` text NOT NULL,
  `estado_actividad` enum('Completa','Incompleta') NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_acpm_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(1, 'Coordinadora Tecnología e Informática'),
(2, 'Auxiliar Tecnología e Informática');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_actividad`
--

CREATE TABLE `detalle_actividad` (
  `id_detalle_acpm` int(11) NOT NULL,
  `fecha_evidencia` timestamp NOT NULL DEFAULT current_timestamp(),
  `evidencia` text NOT NULL,
  `recursos` text NOT NULL,
  `id_actividad_fk` int(11) NOT NULL,
  `id_usuario_e_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(4, 'licencia', 1, 1, 1, 1, '', 12),
(5, 'SSD', 1, 1, 1, 1, '', 12),
(6, '12', 1, 1, 1, 1, '1', 13),
(7, '12666', 1, 1, 1, 1, '1', 13),
(8, 'LUPA', 1, 2000000, 10000, 200000, '', 14),
(9, 'LUPA', 1, 2000000, 10000, 200000, '', 14),
(10, 'LOI|', 0, 2000000, 0, 2000000, '', 15),
(11, 'LOI|', 0, 2000000, 0, 2000000, '', 15),
(12, '1s', 2, 2000000, 0, 2000000, '', 16),
(13, 's1', 2, 2000000, 0, 2000000, '', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `id_orden` int(11) NOT NULL,
  `fecha_orden` date DEFAULT NULL,
  `forma_pago` enum('Contado','Credito','Anticipo','Otros') DEFAULT NULL,
  `tiempo_pago` varchar(50) DEFAULT NULL,
  `porcentaje_anticipo` float DEFAULT NULL,
  `condiciones_negociacion` text DEFAULT NULL,
  `comentario_orden` text DEFAULT NULL,
  `tiempo_entrega` varchar(300) DEFAULT NULL,
  `total_orden` float DEFAULT NULL,
  `analisis_cotizacion` enum('Si','No') DEFAULT NULL,
  `estado_orden` enum('Proceso','Aprobada','Denegada','Analisis de Cotizacion') DEFAULT NULL,
  `descripcion_declinado` text DEFAULT NULL,
  `fecha_aprobacion` datetime DEFAULT NULL,
  `id_cotizante` int(11) DEFAULT NULL,
  `id_proveedor_fk` int(11) DEFAULT NULL,
  `id_gerente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`id_orden`, `fecha_orden`, `forma_pago`, `tiempo_pago`, `porcentaje_anticipo`, `condiciones_negociacion`, `comentario_orden`, `tiempo_entrega`, `total_orden`, `analisis_cotizacion`, `estado_orden`, `descripcion_declinado`, `fecha_aprobacion`, `id_cotizante`, `id_proveedor_fk`, `id_gerente`) VALUES
(12, '2023-08-30', 'Contado', '', 0, '', '<p>S</p>', '1', 2, 'No', 'Proceso', NULL, NULL, 3, 900311215, NULL),
(13, '2023-08-30', 'Contado', '', 0, '', '<p>2</p>', '2', 2, 'No', 'Proceso', NULL, NULL, 3, 900311215, NULL),
(14, '2023-08-30', '', '', 0, '', '<p>2</p>', '2', 400000, 'No', 'Proceso', NULL, NULL, 3, 900311215, NULL),
(15, '2023-08-30', 'Contado', '', 0, '', '<p>1</p>', '1', 4000000, 'Si', 'Analisis de Cotizacion', NULL, NULL, 3, 900311215, NULL),
(16, '2023-08-30', 'Contado', '', 0, '', '<p>s</p>', '3', 4000000, 'Si', 'Analisis de Cotizacion', NULL, NULL, 3, 900311215, NULL);

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
(900311215, 'Zona Franca Internacional e Pereira', 'contacto@zonafrancapereira.com', '3343000', 3);

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
(94, 'files//pieza definitiva.png', 'files//', '2023-07-24 17:33:19', 'activo', 'No', 2),
(95, 'files/Gerencia/Acta RAD/ACTAS C. GERENCIA 2019/upload (1).sql', 'files/Gerencia/Acta RAD/ACTAS C. GERENCIA 2019/', '2023-08-11 16:35:22', 'activo', 'Si', 10),
(96, 'files/PLE/Cadena de Suministro/upload.sql', 'files/PLE/Cadena de Suministro/', '2023-08-11 16:35:34', 'activo', 'Si', 12);

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
  `admin_compras` enum('Si','No') NOT NULL,
  `pagar_ordenes` enum('Si','No') NOT NULL,
  `analisis_cotizacion` enum('Si','No') NOT NULL,
  `radicar_orden` enum('Si','No') NOT NULL,
  `firmar_orden` enum('Si','No') NOT NULL,
  `evaluar_proveedor` enum('Si','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `rol_usuario`, `admin_acpm`, `radicar_acpm`, `admin_sadoc`, `consultar_sadoc`, `admin_compras`, `pagar_ordenes`, `analisis_cotizacion`, `radicar_orden`, `firmar_orden`, `evaluar_proveedor`) VALUES
(1, 'superadmin', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si'),
(2, 'admin_sig', 'Si', 'Si', 'Si', 'Si', 'No', 'No', 'No', 'Si', 'No', 'Si'),
(3, 'usuario_aux', 'No', 'No', 'No', 'Si', 'No', 'No', 'No', 'No', 'No', 'No'),
(4, 'gerencia', 'No', 'Si', 'No', 'Si', 'No', 'No', 'No', 'Si', 'Si', 'Si');

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
  `salario_usuario` varchar(10) NOT NULL,
  `estado_usuario` enum('activo','inactivo') DEFAULT NULL,
  `firma_usuario` text NOT NULL,
  `proceso_usuario_fk` int(11) NOT NULL,
  `id_cargo_fk` int(11) NOT NULL,
  `tipo_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_usuario`, `correo_usuario`, `contrasena_usuario`, `nombre_usuario`, `apellidos_usuario`, `salario_usuario`, `estado_usuario`, `firma_usuario`, `proceso_usuario_fk`, `id_cargo_fk`, `tipo_usuario_fk`) VALUES
(2, 'ptecnico@zonafrancadepereira.com', '7896', 'Fabio', 'Oliveros', '', 'activo', '', 2, 1, 2),
(3, 'ymontoya@zonafrancadepereira.com', '5689', 'Melissa', 'Montoya', '', 'activo', '64efa30b7d965_firma.png', 2, 1, 1),
(4, 'jcardona@zonafrancadepereira.com', '1059', 'Jorge Eliecer', 'Garcia Cardona', '', 'activo', '', 2, 1, 3),
(5, 'pjuridico@zonafrancadepereira.com', '9876', 'Edwin David', 'Vallejo Rodriguez', '', 'activo', '', 2, 1, 3),
(6, 'mensajeria@zonafrancadepereira.com', '1234', 'Juan Carlos', 'Arcila', '', 'activo', '', 2, 1, 3),
(7, 'avasquez@zonafrancadepereira.com', '9853', 'Angelica Maria', 'Vásquez Hoyos', '', 'activo', '', 2, 1, 3),
(9, 'aledesma@zonafrancadepereira.com', '7589', 'Aura María', 'Ledesma', '', 'activo', '', 2, 1, 3),
(10, 'auxiliarsst@zonafrancadepereira.com', '8563', 'Oscar Julian', 'Millan Rodas', '', 'activo', '', 2, 1, 3),
(12, 'monitoreo@zonafrancadepereira.com', '7238', 'Monitoreo', 'PH', '', 'activo', '', 2, 1, 3),
(13, 'dsanchez@zonafrancadepereira.com', '4981', 'Dubian Ernesto', 'Sánchez Muñoz', '', 'activo', '', 2, 1, 3),
(15, 'agalan@zonafrancadepereira.com', '7238', 'Andrea Liliana', 'Galan Moreno', '', 'activo', '', 2, 1, 3),
(17, 'cbustamante@zonafrancadepereira.com', '1439', 'Isabel Cristina', 'Bustamante', '', 'activo', '', 2, 1, 3),
(18, 'yarroyave@zonafrancadepereira.com', '8635', 'Carolina', 'Cardona', '', 'activo', '', 2, 1, 3),
(19, 'jvelasquez@zonafrancadepereira.com', '8952', 'Juan Francisco', 'Velasquez', '', 'activo', '', 2, 1, 3),
(20, 'jrestrepo@zonafrancadepereira.com', '8521', 'Johana Marcela', 'Restrepo Pineda', '', 'activo', '', 2, 1, 3),
(21, 'jperez@zonafrancadepereira.com', '4103', 'Juan Carlos', 'Pérez Rodas', '', 'activo', '', 2, 1, 3),
(24, 'yrios@zonafrancadepereira.com', '9943', 'Yuly Viviana', 'Rios Castaño', '', 'activo', '', 2, 1, 3),
(25, 'ingresos@zonafrancadepereira.com', '7361', 'Ingresos', 'PH', '', 'inactivo', '', 2, 1, 3),
(27, 'ocorrea@zonafrancadepereira.com', '1478', 'Omaira ', 'Correa Guapacha', '', 'inactivo', '', 2, 1, 3),
(30, 'Serazo@zonafrancadepereira.com', '2296', 'Sebastian', 'Erazo Aguirre', '', 'activo', '', 2, 1, 3),
(31, 'epuerta@zonafrancadepereira.com', '2249', 'Erika', 'Puerta Duque', '', 'inactivo', '', 2, 1, 3),
(32, 'rsoto@zonafrancadepereira.com', '8705', 'Robert Arturo', 'Soto Vélez', '', 'activo', '', 2, 1, 3),
(34, 'jraigosa@zonafrancadepereira.com', '8390', 'Julio', 'Raigosa', '', 'activo', '', 2, 1, 3),
(35, 'dsanchez@zonafrancadepereira.com', 'Matriz4981', 'Dubian Ernesto', 'Sánchez Muñoz', '', 'activo', '', 2, 1, 3),
(36, 'mantenimiento@zonafrancadepereira.com', '8756', 'Jhoanny', 'Gil', '', 'activo', '', 2, 1, 3),
(37, 'agalan@zonafrancadepereira.com', 'Matriz7238', 'Andrea Liliana', 'Galan Moreno', '', 'activo', '', 2, 1, 3),
(38, 'jvelasquez@zonafrancadepereira.com', 'Matriz8952', 'Juan Francisco', 'Velasquez', '', 'activo', '', 2, 1, 3),
(39, 'ylopez@zonafrancadepereira.com', '3306', 'Yuliana Andrea', 'Lopez Taborda', '', 'activo', '', 2, 1, 3),
(41, 'agarcia@zonafrancadepereira.com', '8962', 'Alejandro', 'Garcia', '', 'activo', '', 2, 1, 3),
(43, 'yrios@zonafrancadepereira.com', 'Matriz9943', 'Yuly Viviana', 'Rios Castaño', '', 'activo', '', 2, 1, 3),
(50, 'malvarez@zonafrancadepereira.com', '0252', 'Maria Valentina', 'Alvarez Gallego', '', 'activo', '', 2, 1, 3),
(51, 'evallejo@zonafrancadepereira.com', 'Matriz0252', 'Edwin', 'Vallejo', '', 'activo', '', 2, 1, 3),
(52, 'gerencia@creserconsultores.com.co', '8521', 'Mateo', 'Rios', '', 'activo', '', 2, 1, 3),
(53, 'ireyes@zonafrancadepereira.com', '4862', 'Ivonne Viviana', 'Reyes Vallejo', '', 'activo', '', 2, 1, 3);

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
-- Indices de la tabla `actividades_acpm`
--
ALTER TABLE `actividades_acpm`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`),
  ADD KEY `id_acpm_fk` (`id_acpm_fk`);

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
  ADD KEY `cargo_fk` (`proceso_usuario_fk`),
  ADD KEY `cargo_fk_2` (`proceso_usuario_fk`),
  ADD KEY `tipo_usuario_fk` (`tipo_usuario_fk`),
  ADD KEY `tipo_usuario_fk_2` (`tipo_usuario_fk`),
  ADD KEY `id_cargo_fk` (`id_cargo_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acpm`
--
ALTER TABLE `acpm`
  MODIFY `id_consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `actividades_acpm`
--
ALTER TABLE `actividades_acpm`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  MODIFY `id_detalle_acpm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  MODIFY `id_orden_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `id_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `proveedor_compras`
--
ALTER TABLE `proveedor_compras`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=900311216;

--
-- AUTO_INCREMENT de la tabla `sadoc`
--
ALTER TABLE `sadoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Filtros para la tabla `proveedor_compras`
--
ALTER TABLE `proveedor_compras`
  ADD CONSTRAINT `proveedor_compras_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `usuarios` (`Id_usuario`);

--
-- Filtros para la tabla `sadoc`
--
ALTER TABLE `sadoc`
  ADD CONSTRAINT `sadoc_ibfk_1` FOREIGN KEY (`id_proceso_fk`) REFERENCES `proceso` (`id_proceso`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`tipo_usuario_fk`) REFERENCES `tipo_usuario` (`id_tipo_usuario`),
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`proceso_usuario_fk`) REFERENCES `proceso` (`id_proceso`),
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`id_cargo_fk`) REFERENCES `cargos` (`id_cargo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
