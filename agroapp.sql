-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2024 a las 16:50:07
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
-- Base de datos: `agroapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) NOT NULL,
  `Nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `Nombre`) VALUES
(1, 'frutas'),
(2, 'verduras'),
(3, 'hortalizas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `departamento` varchar(25) NOT NULL,
  `ciudad` varchar(25) NOT NULL,
  `dirEntrega` varchar(25) NOT NULL,
  `correo` varchar(20) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `comentario` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `cedula`, `departamento`, `ciudad`, `dirEntrega`, `correo`, `celular`, `comentario`) VALUES
(5, 'juan', '10000', '', '', '', 'juan@gmail.com', '321', ''),
(6, 'as', '31321', '', '', '', 'gvhj@gmsai.bo', '3512', 'puto el que lol ea'),
(7, 'jhon', '1245', 'META', 'Villavicencio', 'cll 35 #42-24', 'jhoanes@gm.com', '215215', 'Hola'),
(8, 'juan', '25261', 'Meta', 'Villavicencio', 'calle 60 Norte #44-22', 'juan@gmail.com', '321', 'A ver si funciona'),
(9, 'juan', '12345', 'Meta', 'Villavo', 'cll 70 sus', 'juan.e.arredondosaen', '12345', '1 libra(s) de Frijol \r\n1 libra(s) de Habichuela \r\n'),
(12, 'jhon', '45678', 'popayan', 'cucuta', 'asd ar125', 'ajausd@gja.aicm', '145353', '3 libra(s) de Frijol \r\n1 libra(s) de Habichuela \r\n'),
(14, 'sender', '678910', 'Meta', 'Calvario', 'ni idea jaja salu2', 'juaneduardoarredondo', '1325315', '6 libra(s) de Habichuela \r\n'),
(15, 'Jeas', '123456', 'Meta', 'Villavicencio', 'Calle 70 SUr #45-22', 'juaneduardoarredondo', '3123066611', '1 libra(s) de Maiz \r\n1 libra(s) de Pepino \r\n'),
(16, 'Juan manuel', '35261091', 'Meta', 'Villavicencio', 'Calle 70 SUr #45-22', 'juaneduardoarredondo', '315881', '5 libra(s) de Maiz \r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `precio` int(7) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `pedido_id`, `producto_id`, `precio`, `cantidad`, `estado`) VALUES
(3, 2, 13, 15000, 1, 0),
(4, 2, 11, 5000, 1, 0),
(5, 2, 1, 3000, 1, 0),
(6, 3, 14, 3000, 1, 0),
(7, 3, 12, 3000, 1, 0),
(8, 3, 11, 5000, 1, 0),
(9, 4, 13, 15000, 1, 0),
(10, 5, 4, 2000, 1, 0),
(11, 5, 0, 2500, 1, 0),
(12, 6, 0, 2500, 1, 0),
(13, 6, 5, 2500, 1, 0),
(14, 7, 0, 2500, 1, 0),
(15, 7, 5, 2500, 1, 0),
(18, 9, 0, 2500, 3, 0),
(19, 9, 5, 2500, 1, 0),
(20, 10, 1, 3000, 4, 0),
(21, 11, 5, 2500, 6, 0),
(22, 12, 11, 5000, 1, 0),
(23, 12, 13, 15000, 1, 0),
(24, 13, 11, 5000, 5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(10) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `total` int(7) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `total`, `fecha`, `estado`) VALUES
(2, 5, 23000, '2024-02-11', 1),
(3, 6, 11000, '2024-02-15', 1),
(4, 7, 15000, '2024-02-18', 1),
(5, 8, 4500, '2024-02-22', 1),
(6, 9, 5000, '2024-02-26', 1),
(9, 12, 10000, '2024-02-26', 1),
(11, 14, 15000, '2024-02-26', 1),
(12, 15, 20000, '2024-02-26', 1),
(13, 16, 25000, '2024-02-26', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `NombrePro` varchar(20) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `precio` int(7) NOT NULL,
  `categoria_id` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `NombrePro`, `descripcion`, `foto`, `precio`, `categoria_id`, `fecha`, `estado`) VALUES
(0, 'Frijol', 'Frijol rojo a 2500 la libra', 'frijol.jpg', 2500, 2, '2024-02-07', 1),
(1, 'Arveja', 'Arveja verde a 3000 pesos la libra', 'arveja.jpg', 3000, 2, '2024-02-06', 1),
(2, 'Frijol', 'Frijol rojo a 3000 pesos la libra', 'frijol.jpg', 3000, 0, '2024-02-07', 1),
(4, 'Lulo', 'Lulo fresco a 2000 pesos la libra', 'lulo.jpg', 2000, 1, '2024-02-07', 1),
(5, 'Habichuela', 'Libra de habichuelas a 2500 pesos', 'habichuela.jpg', 2500, 2, '2024-02-07', 1),
(11, 'Maiz', 'Libra de Mazorca a 5000 pesos', 'maiz.jpg', 5000, 2, '2024-02-07', 1),
(12, 'Mora', 'Libra de mora en 3000 pesos', 'Mora.jpg', 3000, 1, '2024-02-07', 1),
(13, 'Pepino', 'Pepino fresco a 15000 pesos la unidad', 'PEPINO.jpg', 15000, 2, '2024-02-07', 1),
(14, 'Pimenton', 'Libra de pimentón a 3000 pesos', 'pimenton.jpg', 3000, 2, '2024-02-07', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(30) NOT NULL,
  `clave` varchar(15) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `clave`, `estado`) VALUES
(1, 'juan', '1234', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
