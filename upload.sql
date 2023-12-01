-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2023 a las 20:21:27
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
  `tipo_articulo` enum('PC','Licencia','Otro') DEFAULT NULL,
  `ip` varchar(30) NOT NULL,
  `windows` text NOT NULL,
  `office` varchar(300) NOT NULL,
  `factura_office` text NOT NULL,
  `departamento_articulo` enum('Piso 1 /  U.O','Piso 2 / U.O','Operaciones','Monitoreo') DEFAULT NULL,
  `lugar_articulo` text DEFAULT NULL,
  `observaciones_articulo` text DEFAULT NULL,
  `numero_factura` float DEFAULT NULL,
  `fecha_garantia` date DEFAULT NULL,
  `valor_articulo` float DEFAULT NULL,
  `condicion_articulo` text DEFAULT NULL,
  `id_proveedor_fk` int(11) DEFAULT NULL,
  `descripcion_proveedor` text DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `estado_activo` enum('Activo','Inactivo','Rentado','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `activos`
--

INSERT INTO `activos` (`id_activo`, `fecha_asignacion`, `nombre_articulo`, `descripcion_articulo`, `modelo_articulo`, `referencia_articulo`, `marca_articulo`, `tipo_articulo`, `ip`, `windows`, `office`, `factura_office`, `departamento_articulo`, `lugar_articulo`, `observaciones_articulo`, `numero_factura`, `fecha_garantia`, `valor_articulo`, `condicion_articulo`, `id_proveedor_fk`, `descripcion_proveedor`, `id_usuario_fk`, `estado_activo`) VALUES
(2, '2023-11-28 18:27:18', 'ComputadorHP', 'DELL', '3070', 'LENOVO', 'LENOVO', '', '', '', '', '', 'Piso 1 /  U.O', 'Sala de juntas', 'ninguna', 540, '2023-11-30', 1000000, 'buena', 0, 'no registraba', 2, 'Activo'),
(1548, '2023-11-28 18:27:18', 'Computador Optiplex 3070', 'DELL', '3070', 'LENOVO', 'LENOVO', '', '', '', '', '', 'Piso 1 /  U.O', 'Sala de juntas', 'ninguna', 540, '2023-11-30', 1000000, 'buena', 0, 'no registraba', 2, 'Activo');

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
(15, 'Pc', 124854, 151, 1, 1, '', 2),
(16, 'Telefono', 124854, 151, 1, 1, '', 2),
(17, 'Pc', 124854, 151, 1, 1, '', 3),
(18, 'Telefono', 124854, 151, 1, 1, '', 3);

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

INSERT INTO `orden_compra` (`id_orden`, `fecha_orden`, `proveedor_recurrente`, `forma_pago`, `tiempo_pago`, `porcentaje_anticipo`, `condiciones_negociacion`, `comentario_orden`, `tiempo_entrega`, `total_orden`, `analisis_cotizacion`, `estado_orden`, `descripcion_declinado`, `fecha_aprobacion`, `id_cotizante`, `id_proveedor_fk`, `id_gerente`) VALUES
(2, '2023-11-28', 'No', 'Contado', '', 0, '', '<p>aaaa</p>', '1', 2, 'No', 'Proceso', NULL, NULL, 2, 42024431, NULL),
(3, '2023-11-28', 'No', 'Contado', '', 0, '', '<p>aaaa</p>', '1', 2, 'No', 'Proceso', NULL, NULL, 2, 42024431, NULL);

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
(2, 'ymontoyag@zonafrancadepereira.com', '2012', 'Yuliana Melissa', 'Montoya', 'ZFIP-TI01', 'activo', '65660ce9edcc9_650b541b0e691_firma meli.png', 'lunes', 2, 1, 8),
(3, 'jcardona@zonafrancadepereira.com', '6325', 'Jorge Eliecer', 'Garcia Cardona', '', 'activo', '', 'lunes', 2, 1, 3),
(4, 'sbermudez@zonafrancadepereira.com', '5212', 'Santiago', 'Bermudez Marin', '', 'activo', '', 'lunes', 2, 1, 3),
(5, 'mensajeria@zonafrancadepereira.com', '9632', 'Santiago', 'Rendon', '', 'activo', '', 'lunes', 2, 1, 3),
(6, 'ssalazar@zonafrancadepereira.com', '4789', 'Sonia Janeth', 'Salazar Oviedo ', '', 'activo', '', 'lunes', 2, 1, 3),
(7, 'aledesma@zonafrancadepereira.com', '3215', 'Aura Mar¡a', 'Ledesma', '', 'activo', '', 'lunes', 2, 1, 3),
(8, 'auxiliarsst@zonafrancadepereira.com', '9845', 'Oscar Julian', 'Millan Rodas', '', 'activo', '', 'lunes', 2, 1, 3),
(9, 'monitoreo@zonafrancadepereira.com', '2105', 'Monitoreo', 'ZFIP', '', 'activo', '', 'lunes', 2, 1, 3),
(10, 'ygarciaz@zonafrancadepereira.com', '9874', 'Yaqueline', 'Garcia Zapata', '', 'activo', '', 'lunes', 2, 1, 3),
(11, 'agalan@zonafrancadepereira.com', '8745', 'Andrea ', 'Galan Moreno', '', 'activo', '', 'lunes', 2, 1, 3),
(12, 'cbustamante@zonafrancadepereira.com', '6302', 'Isabel Cristina', 'Bustamante', '', 'activo', '', 'lunes', 2, 1, 3),
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
-- AUTO_INCREMENT de la tabla `activos`
--
ALTER TABLE `activos`
  MODIFY `id_activo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1550;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  MODIFY `id_detalle_acpm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  MODIFY `id_orden_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `id_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `sadoc`
--
ALTER TABLE `sadoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
