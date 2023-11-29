-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-11-2023 a las 19:30:38
-- Versión del servidor: 10.5.19-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u446101023_app`
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
  `evaluar_proveedor` enum('Si','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `rol_usuario`, `admin_acpm`, `radicar_acpm`, `admin_sadoc`, `consultar_sadoc`, `ordenes`, `admin_compras`, `pagar_ordenes`, `analisis_cotizacion`, `radicar_orden`, `firmar_orden`, `evaluar_proveedor`) VALUES
(1, 'superadmin', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si', 'Si'),
(2, 'admin_sig', 'Si', 'Si', 'Si', 'Si', 'Si', 'No', 'No', 'No', 'Si', 'No', 'Si'),
(3, 'usuario_aux', 'No', 'No', 'No', 'Si', 'Si', 'No', 'No', 'No', 'No', 'No', 'No'),
(4, 'gerencia', 'No', 'Si', 'No', 'Si', 'Si', 'No', 'No', 'No', 'No', 'Si', 'Si'),
(5, 'directivo', 'No', 'Si', 'No', 'Si', 'Si', 'No', 'No', 'No', 'Si', 'No', 'Si'),
(6, 'aux_cotizacion', 'No', 'No', 'No', 'Si', 'Si', 'No', 'No', 'Si', 'No', 'No', 'Si'),
(7, 'aux_contable', 'No', 'No', 'No', 'Si', 'Si', 'No', 'Si', 'No', 'No', 'No', 'No');

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
(1, 'ssierra@zonafrancadepereira.com', '8521', 'Stefania', 'Sierra Loaiza', '', 'activo', '', 7, 9, 2),
(2, 'ymontoyag@zonafrancadepereira.com', '2012', 'Yuliana Melissa', 'Montoya', '', 'activo', '652423e3eda0b_firmameli.png', 2, 1, 4),
(3, 'jcardona@zonafrancadepereira.com', '6325', 'Jorge Eliecer', 'Garcia Cardona', '', 'activo', '', 2, 1, 3),
(4, 'sbermudez@zonafrancadepereira.com', '5212', 'Santiago', 'Bermudez Marin', '', 'activo', '', 2, 1, 3),
(5, 'mensajeria@zonafrancadepereira.com', '9632', 'Santiago', 'Rendon', '', 'activo', '', 2, 1, 3),
(6, 'ssalazar@zonafrancadepereira.com', '4789', 'Sonia Janeth', 'Salazar Oviedo ', '', 'activo', '', 2, 1, 3),
(7, 'aledesma@zonafrancadepereira.com', '3215', 'Aura Mar¡a', 'Ledesma', '', 'activo', '', 2, 1, 3),
(8, 'auxiliarsst@zonafrancadepereira.com', '9845', 'Oscar Julian', 'Millan Rodas', '', 'activo', '', 2, 1, 3),
(9, 'monitoreo@zonafrancadepereira.com', '2105', 'Monitoreo', 'ZFIP', '', 'activo', '', 2, 1, 3),
(10, 'ygarciaz@zonafrancadepereira.com', '9874', 'Yaqueline', 'Garcia Zapata', '', 'activo', '', 2, 1, 3),
(11, 'agalan@zonafrancadepereira.com', '8745', 'Andrea ', 'Galan Moreno', '', 'activo', '', 2, 1, 3),
(12, 'cbustamante@zonafrancadepereira.com', '6302', 'Isabel Cristina', 'Bustamante', '', 'activo', '', 2, 1, 3),
(13, 'evelasquez@zonafrancadepereira.com', '7913', 'Estefania', 'Velasquez', '', 'activo', '', 2, 1, 3),
(14, 'bparra@zonafrancadepereira.com', '5241', 'Bayron Julian', 'Gomez Parra', '', 'activo', '', 2, 1, 3),
(15, 'fgomez@zonafrancadepereira.com', '5213', 'Faisury', 'Gomez Serna', '', 'activo', '', 2, 1, 3),
(16, 'jperez@zonafrancadepereira.com', '3054', 'Juan Carlos', 'P‚rez Rodas', '', 'activo', '', 2, 1, 3),
(17, 'yrios@zonafrancadepereira.com', '7852', 'Yuly Viviana', 'Rios Casta¤o', '', 'activo', '', 2, 1, 3),
(18, 'Serazo@zonafrancadepereira.com', '8415', 'Sebastian', 'Erazo Aguirre', '', 'activo', '', 2, 1, 3),
(19, 'practicantesig@zonafrancadepereira.com', '6825', 'Jennifer Alexandra', 'Villada Gonzales', '', 'activo', '', 2, 1, 3),
(20, 'rsoto@zonafrancadepereira.com', '9730', 'Robert Arturo', 'Soto V‚lez', '', 'activo', '', 2, 1, 3),
(21, 'jraigosa@zonafrancadepereira.com', '6548', 'Julio', 'Raigosa', '', 'activo', '', 2, 1, 3),
(22, 'ylopez@zonafrancadepereira.com', '1548', 'Yuliana Andrea', 'Lopez Taborda', '', 'activo', '', 2, 1, 3),
(23, 'jgutierrez@zonafrancadepereira.com', '2315', 'Julian Bernardo', 'Gutierrez Naranjo', '', 'activo', '', 2, 1, 3),
(24, 'malvarez@zonafrancadepereira.com', '6582', 'Maria Valentina', 'Alvarez Gallego', '', 'activo', '', 2, 1, 3),
(25, 'gerencia@creserconsultores.com.co', '3201', 'Mateo', 'Rios', '', 'activo', '', 2, 1, 3),
(26, 'alagos@zonafrancadepereira.com', '7895', 'Ana Luisa', ' Lagos Pati¤o', '', 'activo', '', 2, 1, 3),
(27, 'diradministrativo@zonafrancadepereira.com', '9654', 'Cristian', 'Benavides', '', 'activo', '', 2, 1, 3),
(28, 'kechavarria@zonafrancadepereira.com', '9632', 'Kevin David', 'Echavarria Gonzalez', '', 'activo', '', 2, 1, 3),
(55, 'correo_usuario', 'contrasena', 'nombre_usuario', 'apellidos_usuario', 'salario_us', '', 'firma_usuario', 0, 0, 0);

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
  MODIFY `id_orden_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Restricciones para tablas volcadas
--

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
