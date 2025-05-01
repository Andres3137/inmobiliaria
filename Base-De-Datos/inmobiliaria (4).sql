-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-04-2025 a las 17:49:50
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `cod_cargo` int(11) NOT NULL,
  `nom_cargo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cod_cli` int(11) NOT NULL,
  `nom_cli` varchar(150) DEFAULT NULL,
  `doc_cli` int(11) DEFAULT NULL,
  `tipo_doc_cli` enum('CC','CE','TI') DEFAULT NULL,
  `dic_cli` varchar(150) NOT NULL,
  `tel_cli` varchar(12) NOT NULL,
  `email_cli` varchar(12) NOT NULL,
  `cod_tipoinm` int(11) DEFAULT NULL,
  `valor_maximo` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `cod_emp` int(11) DEFAULT NULL,
  `notas_cli` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `cod_con` int(11) NOT NULL,
  `cod_cli` int(11) DEFAULT NULL,
  `fecha_con` date DEFAULT NULL,
  `fecha_ini` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `meses` int(11) DEFAULT NULL,
  `valor_con` int(11) DEFAULT NULL,
  `deposito_con` int(11) DEFAULT NULL,
  `metodo_pago_con` enum('transferencia','efectivo') DEFAULT NULL,
  `dato_pago` varchar(20) DEFAULT NULL,
  `archivo_con` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `cod_emp` int(11) NOT NULL,
  `ced_emp` int(11) NOT NULL,
  `tipo_doc` enum('CC','CE','TI') NOT NULL,
  `nom_emp` varchar(100) NOT NULL,
  `dic_emp` varchar(150) NOT NULL,
  `tel_emp` varchar(12) NOT NULL,
  `email_emp` varchar(50) NOT NULL,
  `rh_emp` varchar(3) NOT NULL,
  `fecha_nac` date NOT NULL,
  `cod_cargo` int(11) NOT NULL,
  `salario` int(11) NOT NULL,
  `gastos` int(11) NOT NULL,
  `comision` int(11) NOT NULL,
  `fecha_ing` date NOT NULL,
  `fecha_ret` date NOT NULL,
  `nom_contacto` varchar(100) NOT NULL,
  `dic_contacto` varchar(100) NOT NULL,
  `tel_contacto` varchar(12) NOT NULL,
  `email_contacto` varchar(50) NOT NULL,
  `relacion_contacto` varchar(30) NOT NULL,
  `cod_ofi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE `inmuebles` (
  `cod_inm` int(11) NOT NULL,
  `di_inm` varchar(150) NOT NULL,
  `barrio_inm` varchar(150) NOT NULL,
  `ciudad_inm` varchar(150) NOT NULL,
  `departamento_inm` varchar(100) NOT NULL,
  `latitud` decimal(10,8) NOT NULL,
  `longitud` decimal(11,8) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `web_p1` varchar(255) NOT NULL,
  `web_p2` varchar(255) NOT NULL,
  `cod_tipoinm` int(11) DEFAULT NULL,
  `num_hab` int(11) NOT NULL,
  `precio_alq` int(11) NOT NULL,
  `cod_propietarios` int(11) DEFAULT NULL,
  `caracteristicas_inm` enum('cojunto','urbanizacion') DEFAULT NULL,
  `notas_inm` text DEFAULT NULL,
  `cod_emp` int(11) DEFAULT NULL,
  `cod_ofi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inspeccion`
--

CREATE TABLE `inspeccion` (
  `cod_ins` int(11) NOT NULL,
  `fecha_ins` date DEFAULT NULL,
  `cod_inm` int(11) DEFAULT NULL,
  `cod_emp` int(11) DEFAULT NULL,
  `comentario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficinas`
--

CREATE TABLE `oficinas` (
  `cod_ofi` int(11) NOT NULL,
  `nom_ofi` varchar(100) NOT NULL,
  `dic_ofi` varchar(255) NOT NULL,
  `tel_ofi` varchar(12) NOT NULL,
  `email_ofi` varchar(50) NOT NULL,
  `latitud` decimal(10,8) NOT NULL,
  `longitud` decimal(11,8) NOT NULL,
  `foto_ofi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE `propietarios` (
  `cod_propietarios` int(11) NOT NULL,
  `tipo_empresa` enum('persona natural','juridico') NOT NULL,
  `tipo_doc` enum('CC','NIT','CE') NOT NULL,
  `num_doc` int(11) NOT NULL,
  `nomb_propietario` varchar(100) NOT NULL,
  `dic_propietario` varchar(150) NOT NULL,
  `tel_propietario` varchar(12) NOT NULL,
  `email_propietario` varchar(50) NOT NULL,
  `contacto_prop` varchar(100) NOT NULL,
  `tel_contacto` varchar(12) NOT NULL,
  `email_contacto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_inmueble`
--

CREATE TABLE `tipo_inmueble` (
  `cod_tipoinm` int(11) NOT NULL,
  `nom_tipoinm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `pass_usuario` varchar(255) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `pass_usuario`, `nombre_usuario`) VALUES
(1, '$2y$10$OZdYVzaE0LcwQB4d6.atlulWUIztOlhEmoZalOxr7CBekEy2olaWS', 'juan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `cod_vis` int(11) NOT NULL,
  `fecha_vis` date DEFAULT NULL,
  `cod_cli` int(11) DEFAULT NULL,
  `cod_emp` int(11) DEFAULT NULL,
  `cod_inm` int(11) DEFAULT NULL,
  `comenta_vis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`cod_cargo`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cod_cli`),
  ADD KEY `cod_tipoinm` (`cod_tipoinm`),
  ADD KEY `cod_emp` (`cod_emp`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`cod_con`),
  ADD KEY `cod_cli` (`cod_cli`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`cod_emp`),
  ADD KEY `cod_cargo` (`cod_cargo`),
  ADD KEY `cod_ofi` (`cod_ofi`);

--
-- Indices de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD PRIMARY KEY (`cod_inm`),
  ADD KEY `cod_tipoinm` (`cod_tipoinm`),
  ADD KEY `cod_propietarios` (`cod_propietarios`),
  ADD KEY `cod_emp` (`cod_emp`),
  ADD KEY `cod_ofi` (`cod_ofi`);

--
-- Indices de la tabla `inspeccion`
--
ALTER TABLE `inspeccion`
  ADD PRIMARY KEY (`cod_ins`),
  ADD KEY `cod_inm` (`cod_inm`),
  ADD KEY `cod_emp` (`cod_emp`);

--
-- Indices de la tabla `oficinas`
--
ALTER TABLE `oficinas`
  ADD PRIMARY KEY (`cod_ofi`);

--
-- Indices de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`cod_propietarios`);

--
-- Indices de la tabla `tipo_inmueble`
--
ALTER TABLE `tipo_inmueble`
  ADD PRIMARY KEY (`cod_tipoinm`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`cod_vis`),
  ADD KEY `cod_emp` (`cod_emp`),
  ADD KEY `cod_cli` (`cod_cli`),
  ADD KEY `cod_inm` (`cod_inm`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `cod_cargo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cod_cli` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `cod_con` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `cod_emp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  MODIFY `cod_inm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inspeccion`
--
ALTER TABLE `inspeccion`
  MODIFY `cod_ins` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `oficinas`
--
ALTER TABLE `oficinas`
  MODIFY `cod_ofi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  MODIFY `cod_propietarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_inmueble`
--
ALTER TABLE `tipo_inmueble`
  MODIFY `cod_tipoinm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `cod_vis` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`cod_tipoinm`) REFERENCES `tipo_inmueble` (`cod_tipoinm`),
  ADD CONSTRAINT `clientes_ibfk_2` FOREIGN KEY (`cod_emp`) REFERENCES `empleados` (`cod_emp`);

--
-- Filtros para la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `contratos_ibfk_1` FOREIGN KEY (`cod_cli`) REFERENCES `clientes` (`cod_cli`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`cod_cargo`) REFERENCES `cargos` (`cod_cargo`),
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`cod_ofi`) REFERENCES `oficinas` (`cod_ofi`);

--
-- Filtros para la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD CONSTRAINT `inmuebles_ibfk_1` FOREIGN KEY (`cod_tipoinm`) REFERENCES `tipo_inmueble` (`cod_tipoinm`),
  ADD CONSTRAINT `inmuebles_ibfk_2` FOREIGN KEY (`cod_propietarios`) REFERENCES `propietarios` (`cod_propietarios`),
  ADD CONSTRAINT `inmuebles_ibfk_3` FOREIGN KEY (`cod_emp`) REFERENCES `empleados` (`cod_emp`),
  ADD CONSTRAINT `inmuebles_ibfk_4` FOREIGN KEY (`cod_ofi`) REFERENCES `oficinas` (`cod_ofi`);

--
-- Filtros para la tabla `inspeccion`
--
ALTER TABLE `inspeccion`
  ADD CONSTRAINT `inspeccion_ibfk_1` FOREIGN KEY (`cod_inm`) REFERENCES `inmuebles` (`cod_inm`),
  ADD CONSTRAINT `inspeccion_ibfk_2` FOREIGN KEY (`cod_emp`) REFERENCES `empleados` (`cod_emp`);

--
-- Filtros para la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `visitas_ibfk_1` FOREIGN KEY (`cod_emp`) REFERENCES `empleados` (`cod_emp`),
  ADD CONSTRAINT `visitas_ibfk_2` FOREIGN KEY (`cod_cli`) REFERENCES `clientes` (`cod_cli`),
  ADD CONSTRAINT `visitas_ibfk_3` FOREIGN KEY (`cod_inm`) REFERENCES `inmuebles` (`cod_inm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
