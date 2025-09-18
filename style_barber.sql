-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2025 a las 05:02:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `style_barber`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `id_clientes_barberia` int(11) DEFAULT NULL,
  `id_empleado` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` varchar(50) DEFAULT 'Reservada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_servicio`
--

CREATE TABLE `cita_servicio` (
  `id_cita` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contraseña` varchar(100) NOT NULL,
  `fecha_registro` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `telefono`, `correo`, `contraseña`, `fecha_registro`) VALUES
(1, 'pablo', '3212520864', 'andrdesfelipeobregon860@gmail.com', '12021000', '2025-06-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_barberia`
--

CREATE TABLE `clientes_barberia` (
  `id_clientes_barberia` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `ultima_visita` date DEFAULT NULL,
  `proxima_cita` date DEFAULT NULL,
  `servicio_favorito` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes_barberia`
--

INSERT INTO `clientes_barberia` (`id_clientes_barberia`, `nombre`, `telefono`, `ultima_visita`, `proxima_cita`, `servicio_favorito`) VALUES
(0, 'Juan Pérez', '3001234567', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `especialidad` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL,
  `fecha_pago` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `clientes_barberia` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo` enum('descuento','2x1','envio_gratis','regalo','otro') NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `email_cliente` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `servicio` varchar(50) NOT NULL,
  `fecha_reserva` date NOT NULL,
  `hora_reserva` time NOT NULL,
  `barbero` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `nombre_cliente`, `email_cliente`, `telefono`, `servicio`, `fecha_reserva`, `hora_reserva`, `barbero`, `created_at`) VALUES
(5, 'Test', 'test@example.com', '3001234567', 'Corte', '2025-09-10', '10:00:00', NULL, '2025-09-07 03:05:40'),
(8, 'frank jimenez', '', '3142843736', 'Corte Gold\n                $ 38.000, Corte Gold', '0000-00-00', '08:00:00', NULL, '2025-09-07 03:09:42'),
(11, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Corte Gold\n                    $ 38.000, Corte Gol', '0000-00-00', '08:00:00', NULL, '2025-09-07 03:25:28'),
(12, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Corte Gold\n                    $ 38.000, Corte Gol', '0000-00-00', '12:00:00', NULL, '2025-09-07 03:26:24'),
(13, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Corte Platinum\n                    $ 28.000, Corte', '0000-00-00', '04:00:00', NULL, '2025-09-07 03:31:07'),
(14, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Corte Platinum\n                    $ 28.000, Corte', '0000-00-00', '12:00:00', NULL, '2025-09-07 03:45:04'),
(15, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Corte Platinum\n                    $ 28.000, Corte', '0000-00-00', '12:00:00', NULL, '2025-09-07 03:47:10'),
(16, 'andres bustos', 'andresfelipeobregon860@gmail.com', '3142843736', 'Shampoo\n                    $ 6.000, Shampoo', '0000-00-00', '12:00:00', NULL, '2025-09-07 03:49:54'),
(17, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Cejas\n                    $ 10.000, Cejas', '0000-00-00', '12:00:00', NULL, '2025-09-07 03:55:23'),
(18, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Barba Sola\n                    $ 30.000, Barba Sol', '0000-00-00', '12:00:00', NULL, '2025-09-08 23:16:59'),
(19, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Barba Sola\n                    $ 30.000, Barba Sol', '0000-00-00', '12:00:00', NULL, '2025-09-08 23:17:03'),
(20, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Shampoo\n                    $ 6.000, Shampoo', '0000-00-00', '08:00:00', NULL, '2025-09-09 03:49:34'),
(21, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Cejas\n                    $ 10.000, Cejas', '0000-00-00', '03:00:00', NULL, '2025-09-09 04:04:38'),
(22, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Cejas\n                    $ 10.000, Cejas', '0000-00-00', '08:00:00', NULL, '2025-09-16 18:59:19'),
(23, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Shampoo\n                    $ 6.000, Shampoo', '0000-00-00', '08:00:00', NULL, '2025-09-16 20:23:42'),
(24, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Shampoo\n                    $ 6.000, Shampoo', '0000-00-00', '08:00:00', NULL, '2025-09-16 20:23:43'),
(25, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Barba Sola\n                    $ 30.000, Barba Sol', '0000-00-00', '12:00:00', NULL, '2025-09-16 21:12:00'),
(26, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Barba Sola\n                    $ 30.000, Barba Sol', '0000-00-00', '12:00:00', NULL, '2025-09-16 21:12:01'),
(27, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Corte Black Label\n                    $ 49.000, Co', '0000-00-00', '12:00:00', NULL, '2025-09-16 21:50:37'),
(28, '', '', '3142843736', 'Shampoo\n                    $ 6.000, Shampoo', '0000-00-00', '00:00:00', NULL, '2025-09-17 00:58:16'),
(29, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Shampoo\n                    $ 6.000, Shampoo', '0000-00-00', '08:00:00', NULL, '2025-09-17 01:11:09'),
(30, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Corte y Barba Black Label\n                    $ 69', '0000-00-00', '05:00:00', NULL, '2025-09-17 01:17:13'),
(31, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Cejas\n                    $ 10.000, Cejas', '2025-09-18', '03:00:00', NULL, '2025-09-17 01:54:08'),
(32, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Barba Sola\n                    $ 30.000, Barba Sol', '2025-09-19', '12:00:00', NULL, '2025-09-17 02:06:41'),
(33, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Cejas\n                    $ 10.000, Cejas', '2025-09-19', '01:00:00', NULL, '2025-09-17 02:29:28'),
(34, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Corte Platinum\n                    $ 28.000, Corte', '2025-09-20', '12:00:00', NULL, '2025-09-17 02:32:07'),
(35, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Shampoo\n                    $ 6.000, Shampoo', '2025-09-20', '12:00:00', '', '2025-09-17 02:52:18'),
(36, 'frank jimenez', 'frankjimenez081@gmail.com', '3142843736', 'Barba Sola\n                    $ 30.000, Barba Sol', '2025-09-19', '12:00:00', '', '2025-09-17 02:54:11'),
(37, 'carlos perez', 'frankjimenez081@gmail.com', '3142843736', 'Corte Gold\n                    $ 38.000, Corte Gol', '2025-09-19', '12:00:00', 'Carlos Perez', '2025-09-17 03:04:52'),
(38, 'Sofia Leyva', 'Sofialeyvamarroquin@gmail.com', '3142843736', 'Shampoo\n                    $ 6.000, Shampoo', '2025-09-18', '12:00:00', 'Andres Diaz', '2025-09-17 03:08:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `duracion_min` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `nombre`, `descripcion`, `precio`, `duracion_min`) VALUES
(1, 'Corte de cabello', 'Corte clásico con máquina o tijeras', 15000.00, 30),
(2, 'Afeitado de barba', 'Afeitado completo con toalla caliente', 10000.00, 20),
(3, 'Perfilado de barba', 'Definición y perfilado con máquina y navaja', 12000.00, 25),
(4, 'Tinte de cabello', 'Aplicación de tinte para cubrir canas o dar color', 25000.00, 40),
(5, 'Limpieza facial', 'Tratamiento básico de limpieza facial para hombres', 20000.00, 30),
(6, 'Corte + barba', 'Combo de corte de cabello y barba', 22000.00, 50),
(7, 'Diseño de cejas', 'Diseño y depilación de cejas con navaja', 8000.00, 10),
(8, 'Tratamiento capilar', 'Tratamiento nutritivo o anticaspa', 18000.00, 35),
(9, 'juan valdez', 'enjavonado para la casp', 2000000.00, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `estado` varchar(20) DEFAULT 'Activo',
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `correo`, `contraseña`, `rol`, `estado`, `fecha_creacion`) VALUES
(1, 'Juan Pérez', 'juanp', '', '123456', 'administrador', 'Activo', '2025-05-20 13:50:28'),
(2, 'Carlos Gómez', 'carlosg', '', 'barbero123', 'barbero', 'Activo', '2025-05-20 13:50:28'),
(3, 'Ana Torres', 'ana.t', '', 'recepcion1', 'recepcionista', 'Activo', '2025-05-20 13:50:28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_cliente` (`id_clientes_barberia`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `cita_servicio`
--
ALTER TABLE `cita_servicio`
  ADD PRIMARY KEY (`id_cita`,`id_servicio`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `clientes_barberia`
--
ALTER TABLE `clientes_barberia`
  ADD PRIMARY KEY (`id_clientes_barberia`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_cita` (`id_cita`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`clientes_barberia`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_clientes_barberia`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`),
  ADD CONSTRAINT `fk_citas_clientes` FOREIGN KEY (`id_clientes_barberia`) REFERENCES `clientes_barberia` (`id_clientes_barberia`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
