-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2025 a las 08:40:56
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
-- Base de datos: `sistema_usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Usuario con permisos completos'),
(2, 'Usuario', 'Usuario estándar del sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `id` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `fechaInicio` datetime DEFAULT current_timestamp(),
  `fechaExpiracion` datetime DEFAULT NULL,
  `activa` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`id`, `usuarioId`, `token`, `fechaInicio`, `fechaExpiracion`, `activa`) VALUES
(1, 1, '900f5ac4c7a128abce3b3c8eb10319b4a57b77b2c97b629e7676ccc7cbc9196a', '2025-12-12 00:38:11', '2025-12-13 00:38:11', 1),
(2, 1, '69d50dc9720d4986316109bfb8ba068a48a9907693a63606ac3dcb61a39a6537', '2025-12-12 00:41:38', '2025-12-13 00:41:38', 1),
(3, 1, '4ea357b105a0940a74c5bb57fb1bb27c90aa6e83e0a87c177006ca89e8dfc780', '2025-12-12 01:00:53', '2025-12-13 01:00:53', 1),
(4, 1, '75aed994821a43cdc6cb215fd41faf7fac4c889d27ca8f9b3947bce6e73b8769', '2025-12-12 01:12:45', '2025-12-13 01:12:45', 1),
(5, 1, '6c4eb6daa4444f44daf6eefa3c1d39cf8f5add3ba75ccccb2926f4dbe2a91f1b', '2025-12-12 01:55:17', '2025-12-13 01:55:17', 1),
(6, 1, '07613e8964990db5447aa4d824f29958c4167070e5ca2546de05f173990f2e6f', '2025-12-12 01:56:22', '2025-12-13 01:56:22', 1),
(7, 1, '3201d901b8598d844296ee2b37aa400cdd2a3da4975487ec2c4c4a197d3323cf', '2025-12-12 02:08:01', '2025-12-13 02:08:01', 1),
(8, 1, 'd2bb86b542108ea73b21d19cf77688d981494410e94775cfb37d8d1b677633af', '2025-12-12 02:22:10', '2025-12-13 02:22:10', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `documentoIdentidad` varchar(50) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `rolId` int(11) DEFAULT 2,
  `fechaRegistro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `contraseña`, `documentoIdentidad`, `nombreUsuario`, `rolId`, `fechaRegistro`) VALUES
(1, 'Nicolas', 'Acosta', 'nico123@admin.com', '$2y$10$2GZ9JesluLWA23ycg5im9eDFmsBWxmsutShUKtnYIwOntSm.SXezW', '1030690566', 'NikoAdmin', 2, '2025-12-12 00:36:43');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarioId` (`usuarioId`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `documentoIdentidad` (`documentoIdentidad`),
  ADD UNIQUE KEY `nombreUsuario` (`nombreUsuario`),
  ADD KEY `rolId` (`rolId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `sesiones_ibfk_1` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rolId`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
