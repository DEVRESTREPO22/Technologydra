-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-03-2025 a las 15:11:28
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
-- Base de datos: `technologydra`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_pedido` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','enviado','cancelado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id_registro` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id_registro`, `nombre`, `id_usuario`, `apellido`, `fecha_nacimiento`) VALUES
(1, '', 12, 'Restrepo', '2025-02-12'),
(2, 'Sara', 13, 'Restrepo', '2025-02-14'),
(3, 'Devora', 14, 'Restrepo', '2025-02-20'),
(4, 'Sofia', 15, 'Hernandez', '2025-02-20'),
(5, 'Devora', 16, 'Restrepo', '2025-02-20'),
(6, 'Devora', 17, 'Aguirre', '2025-02-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `contrasena` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `contrasena`) VALUES
(3, 'dev1', 'dev1', '1dev'),
(4, 'dedsfd', 'dfsd', 'sdffs'),
(5, 'devora', 'devora', 'devroa'),
(7, 'dev2', '2dev', '2dev'),
(8, 'szara', 'asdsdsa', 'asdsada'),
(12, 'Devora', 'restrepoa0907@gmail.com', '$2y$10$BhT1vDv3fChH8s7mZkWtKOPOx3Lv4JH8hadD33WlFrAuhMrg8ca52'),
(13, 'Sara', 'sararestrepo1715@gmail.com', '$2y$10$SwakvSlhCG9Wu9/HGAWCD.QNnNiKVdRU3ArpWticgart4.w.gkY06'),
(14, 'Devora', 'administracion@prada.vet', '$2y$10$7.7NxWVCu5hJaMxtFqubcuQ/gQMWBmTopNkeqAN4F3cN5aYs1/dNi'),
(15, 'Sofia', 'sofiah22@gmail.com', '$2y$10$FwZ2IdhV73CrTwygUrKBBuRDQxbMWQxCT3I/1RJZT4Fhe68B.ijNW'),
(16, 'Devora', 'tecnologia2@prada.vet', '$2y$10$cc4Mkg75bvABo35pT8A1SOKjqI4VGalUFhX8FgTUKRssjr/G9qq3q'),
(17, 'Devora', 'restrepoa09072@gmail.com', '$2y$10$5SQHdJMnln9/a02cEOfrQO434kpwSCl5dzFGB6O1T6bs43YF/aRC6');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD CONSTRAINT `detalles_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `detalles_pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
