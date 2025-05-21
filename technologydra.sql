-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2025 a las 04:59:38
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

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(1, 'Todo Gamer'),
(2, 'Todo en Portátiles'),
(3, 'Accesorios'),
(4, 'Otros');

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
  `imagen` varchar(255) DEFAULT NULL,
  `precio` int(10) UNSIGNED DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `imagen`, `precio`, `stock`, `categoria_id`) VALUES
(9, 'PC Gamer Ultra', 'Amd Ryzen 5 Disc Ssd 240 + 1tb Ram 16gb Monitor 22', 'gamer.webp', 3339900, 10, 1),
(10, 'Torre Gamer Completa CPU + Pantalla', 'Amd Ryzen 5 5600G Ssd 480Gb + Hdd 1Tb Ram 8Gb Led 22 Full Hd Pulgadas', 'gamer2.webp', 2534500, 8, 1),
(11, 'PC Gamer Pro', 'Procesad Amd Ryzen 5 5600GT 16GB SSD 500GB Linux Negro', 'gamer4.webp', 4499900, 5, 1),
(12, 'Potatil Gamer ASUS TUF A15', 'AMD Ryzen 7 7435HS RAM 16 GB 512 GB SSD', 'portatil1.webp', 3899900, 7, 1),
(13, 'Portátil Victus Gaming HP', 'AMD Radeon Graphics GTX 1650 DDR5 4GB, SSD 512GB, RAM 12 GB.', 'portatil2.jpg', 2420000, 6, 1),
(14, 'Portatil Gaming ACER Nitro', 'Intel Core i5 12450H RAM 8 GB 512 GB SSD', 'portatil3.webp', 3140280, 9, 1),
(15, 'Combo Gamer 4 En 1 Unitec Km18', 'Teclado Retroiluminado, Mouse RGB, Diadema LED, Pad Mouse', 'combo1.avif', 80000, 20, 2),
(16, 'COMBO KIT GAMER COMPUMAX', 'MOUSE, TECLADO, MOUSEPAD Y DIAMDEMA', 'combo2.avif', 250000, 15, 2);

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
(6, 'Devora', 17, 'Aguirre', '2025-02-26'),
(7, 'Devo', 18, 'Aguirre', '2002-03-22');

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
(17, 'Devora', 'restrepoa09072@gmail.com', '$2y$10$5SQHdJMnln9/a02cEOfrQO434kpwSCl5dzFGB6O1T6bs43YF/aRC6'),
(18, 'Devo', 'devo123@gmail.com', '$2y$10$cPtHsJ2cCWGmwGknGUj3yuTsLRCP.9NlkYrlvnoVuFRj98sBzH6nK');

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
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
