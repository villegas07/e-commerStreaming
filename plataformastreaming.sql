-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2024 a las 17:49:42
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
-- Base de datos: `plataformastreaming`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('admin','superadmin') DEFAULT 'admin',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `nombre_usuario`, `email`, `contrasena`, `rol`, `fecha_registro`) VALUES
(2, 'Brayan Villegas Corrales', 'brayanvillegas0719@gmail.com', '$2y$10$3i0AJ3lif/sXLtxoUEfa6OFxz13Sf6JAeqvquovRWGP5JunIaQMU2', 'superadmin', '2024-10-31 04:22:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infonetflix`
--

CREATE TABLE `infonetflix` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL DEFAULT 'Netflix',
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `boton_texto` varchar(50) DEFAULT 'Solicitar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `infonetflix`
--

INSERT INTO `infonetflix` (`id`, `nombre`, `descripcion`, `precio`, `imagen_url`, `boton_texto`) VALUES
(1, 'Netflix', 'Accede a todas las series, películas y documentales de Netflix con nuestra cuenta Premium por solo $10,000. Disfruta de la mejor calidad de video en múltiples dispositivos y sin interrupciones.\r\n\r\n', 10000.00, 'uploads/netflix.png', 'Contactar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infospotify`
--

CREATE TABLE `infospotify` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL DEFAULT 'Spotify',
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `boton_texto` varchar(50) DEFAULT 'Solicitar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `infospotify`
--

INSERT INTO `infospotify` (`id`, `nombre`, `descripcion`, `precio`, `imagen_url`, `boton_texto`) VALUES
(1, 'Spotify', 'Accede a todo el catálogo de música, podcasts y playlists exclusivas en Spotify con nuestra suscripción Premium por solo $9,000. Disfruta de la mejor calidad de audio, sin anuncios, y con la opción de descargar tus canciones para escuchar offline en múltiples dispositivos. ¡Lleva tu música a todas partes sin interrupciones!', 9000.00, 'uploads/logoSpotify.png', 'Contactar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lomejorparati`
--

CREATE TABLE `lomejorparati` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `garantia` varchar(50) DEFAULT '30 Días',
  `popularidad` tinyint(1) DEFAULT 1,
  `imagen_url` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lomejorparati`
--

INSERT INTO `lomejorparati` (`id`, `nombre`, `precio`, `garantia`, `popularidad`, `imagen_url`, `descripcion`) VALUES
(2, 'Disney', 15000.00, '30 Días Garantizados', 1, 'uploads/fondo01.jpg', 'adadadad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otrosservicios`
--

CREATE TABLE `otrosservicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `garantia` varchar(50) DEFAULT '30 Días',
  `imagen_url` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `otrosservicios`
--

INSERT INTO `otrosservicios` (`id`, `nombre`, `precio`, `garantia`, `imagen_url`, `descripcion`) VALUES
(1, 'Canva Premium', 12000.00, '30 Días Garantizados', 'uploads/INICIO.jpg', 'Canva premium por 30 Dias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocionesespeciales`
--

CREATE TABLE `promocionesespeciales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `garantia` varchar(50) DEFAULT '30 Días'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promocionesespeciales`
--

INSERT INTO `promocionesespeciales` (`id`, `nombre`, `precio`, `descripcion`, `imagen_url`, `garantia`) VALUES
(1, 'Combo plus', 12000.00, 'dasdasdada', 'uploads/fondo01.jpg', '30 Días Garantizados');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `garantia` varchar(50) DEFAULT '30 Días',
  `imagen_url` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `precio`, `garantia`, `imagen_url`, `descripcion`) VALUES
(3, 'Netflix', 12000.00, '30 Días ', 'uploads/fondo01.jpg', 'Pantalla de netflix full por 30 Dias ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `streamingtotal`
--

CREATE TABLE `streamingtotal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `garantia` varchar(50) DEFAULT '30 Días',
  `disponibilidad` tinyint(1) DEFAULT 1,
  `imagen_url` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `streamingtotal`
--

INSERT INTO `streamingtotal` (`id`, `nombre`, `precio`, `garantia`, `disponibilidad`, `imagen_url`, `descripcion`) VALUES
(2, 'HBO+', 12000.00, '30 Días Garantizados', 1, 'uploads/spotify.jpg', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `infonetflix`
--
ALTER TABLE `infonetflix`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `infospotify`
--
ALTER TABLE `infospotify`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lomejorparati`
--
ALTER TABLE `lomejorparati`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `otrosservicios`
--
ALTER TABLE `otrosservicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promocionesespeciales`
--
ALTER TABLE `promocionesespeciales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `streamingtotal`
--
ALTER TABLE `streamingtotal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `infonetflix`
--
ALTER TABLE `infonetflix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `infospotify`
--
ALTER TABLE `infospotify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `lomejorparati`
--
ALTER TABLE `lomejorparati`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `otrosservicios`
--
ALTER TABLE `otrosservicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `promocionesespeciales`
--
ALTER TABLE `promocionesespeciales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `streamingtotal`
--
ALTER TABLE `streamingtotal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
