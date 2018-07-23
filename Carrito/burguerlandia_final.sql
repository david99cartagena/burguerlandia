-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-03-2018 a las 17:41:46
-- Versión del servidor: 5.7.11
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `burguerlandia_final`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `client_email` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cart`
--

INSERT INTO `cart` (`id`, `client_email`, `created_at`) VALUES
(4, 'd@c', '2018-03-22 08:49:31'),
(5, 'd@c', '2018-03-22 08:50:11'),
(6, 'orarsr@asdasd', '2018-03-22 08:52:12'),
(7, 'zd@sdsd', '2018-03-22 11:13:04'),
(8, 'df@dfd', '2018-03-22 11:21:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_product`
--

CREATE TABLE `cart_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `q` float DEFAULT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cart_product`
--

INSERT INTO `cart_product` (`id`, `product_id`, `q`, `cart_id`) VALUES
(8, 4, 1, 2),
(7, 3, 1, 2),
(6, 2, 1, 2),
(5, 1, 1, 2),
(9, 3, 1, 3),
(10, 2, 5, 4),
(11, 3, 1000, 5),
(12, 1, 1, 6),
(13, 1, 1, 7),
(14, 2, 1, 7),
(15, 2, 20, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio_has_usuario`
--

CREATE TABLE `domicilio_has_usuario` (
  `Domicilio_Num_Domicilio` int(11) NOT NULL,
  `Usuario_Tipo_identificacion_Tipo_id` varchar(10) NOT NULL,
  `Usuario_Identificacion_usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_rest`
--

CREATE TABLE `info_rest` (
  `Nit_Rest` int(11) NOT NULL,
  `Nom_rest` varchar(45) NOT NULL,
  `Tipo_regimen` varchar(30) NOT NULL,
  `Dir_rest` varchar(45) NOT NULL,
  `Telefono_rest` varchar(15) NOT NULL,
  `Cel_rest` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `info_rest`
--

INSERT INTO `info_rest` (`Nit_Rest`, `Nom_rest`, `Tipo_regimen`, `Dir_rest`, `Telefono_rest`, `Cel_rest`) VALUES
(1, 'Burguerlandia', '1', 'cra1', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medios_pago`
--

CREATE TABLE `medios_pago` (
  `Cod_Medios_pago` int(11) NOT NULL,
  `Desc_medios_pago` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `medios_pago`
--

INSERT INTO `medios_pago` (`Cod_Medios_pago`, `Desc_medios_pago`) VALUES
(1, 'efectivo'),
(2, 'tarjeta'),
(3, 'efectivo y tarjeta'),
(4, 'otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opinion`
--

CREATE TABLE `opinion` (
  `Id_Opinion` int(11) NOT NULL,
  `Correo_Electronico` varchar(65) NOT NULL,
  `Opinion` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `opinion`
--

INSERT INTO `opinion` (`Id_Opinion`, `Correo_Electronico`, `Opinion`) VALUES
(1, 'pepe@gmail.com', 'me encanta su comida es muy rica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `Tipo_Pedido_Cod_TP` int(11) NOT NULL,
  `Num_Domicilio` int(11) NOT NULL,
  `Info_Rest_Nit_Rest` int(11) NOT NULL,
  `Fecha_y_hora_Dom` datetime NOT NULL,
  `Total_Domicilio` float NOT NULL,
  `Medios_pago_Cod_Medios_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`Tipo_Pedido_Cod_TP`, `Num_Domicilio`, `Info_Rest_Nit_Rest`, `Fecha_y_hora_Dom`, `Total_Domicilio`, `Medios_pago_Cod_Medios_pago`) VALUES
(5, 1, 1, '2017-12-10 01:56:02', 14000, 4),
(1, 2, 1, '2017-12-10 09:05:27', 2850, 1),
(3, 3, 1, '2018-03-08 07:57:04', 5500, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `IdProducto` int(11) NOT NULL,
  `Nombre_Pr` varchar(45) NOT NULL,
  `Valor_Pr` varchar(45) NOT NULL,
  `Descripcion_Pr` varchar(45) NOT NULL,
  `Foto_Pr` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `Nombre_Pr`, `Valor_Pr`, `Descripcion_Pr`, `Foto_Pr`) VALUES
(1, 'empanada_de_queso_y_pollo', '1600', 'empanada_de_queso_y_pollo', ''),
(2, 'empanada_de_arroz_y_pollo', '1600', 'empanada_de_arroz_y_pollo', ''),
(3, 'empanada_de_carne', '1600', 'empanada_de_carne', ''),
(4, 'nuggets_de_polloapanado', '4000', '4_mininuggets_con_arepas_fritas', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_has_domicilio`
--

CREATE TABLE `producto_has_domicilio` (
  `Domicilio_Num_Domicilio` int(11) NOT NULL,
  `Producto_IdProducto` int(11) NOT NULL,
  `Cantidad_Pro` int(11) NOT NULL,
  `Valor_venta` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Codigo_rol` varchar(5) NOT NULL,
  `Desc_rol` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`Codigo_rol`, `Desc_rol`) VALUES
('1', 'admin'),
('2', 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_identificacion`
--

CREATE TABLE `tipo_identificacion` (
  `Tipo_id` varchar(10) NOT NULL,
  `Desc_TipoId` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_identificacion`
--

INSERT INTO `tipo_identificacion` (`Tipo_id`, `Desc_TipoId`) VALUES
('1', 'C.C'),
('2', 'C.E'),
('3', 'T.I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pedido`
--

CREATE TABLE `tipo_pedido` (
  `Cod_TP` int(11) NOT NULL,
  `Desc_Tp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_pedido`
--

INSERT INTO `tipo_pedido` (`Cod_TP`, `Desc_Tp`) VALUES
(1, 'burguer_entradas'),
(2, 'burguer_especiales'),
(3, 'burguer_fuertes'),
(4, 'burguer_rapidas'),
(5, 'burguer_bebidas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Tipo_identificacion_Tipo_id` varchar(10) NOT NULL,
  `Identificacion_usu` int(11) NOT NULL,
  `Rol_Codigo_rol` varchar(5) NOT NULL,
  `Nombre_usu` varchar(45) NOT NULL,
  `Apellido_usu` varchar(15) DEFAULT NULL,
  `Telefono_Cl` int(10) DEFAULT NULL,
  `Celular_usu` int(15) DEFAULT NULL,
  `Direccion_usu` varchar(60) NOT NULL,
  `Password_usu` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_pass`
--

CREATE TABLE `usuarios_pass` (
  `IDENTIFICACION_USU` int(11) NOT NULL,
  `USUARIO` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `ROL` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cart_product`
--
ALTER TABLE `cart_product`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `domicilio_has_usuario`
--
ALTER TABLE `domicilio_has_usuario`
  ADD PRIMARY KEY (`Domicilio_Num_Domicilio`,`Usuario_Tipo_identificacion_Tipo_id`,`Usuario_Identificacion_usu`),
  ADD KEY `fk_Domicilio_has_Usuario_Usuario1_idx` (`Usuario_Tipo_identificacion_Tipo_id`,`Usuario_Identificacion_usu`),
  ADD KEY `fk_Domicilio_has_Usuario_Domicilio1_idx` (`Domicilio_Num_Domicilio`);

--
-- Indices de la tabla `info_rest`
--
ALTER TABLE `info_rest`
  ADD PRIMARY KEY (`Nit_Rest`);

--
-- Indices de la tabla `medios_pago`
--
ALTER TABLE `medios_pago`
  ADD PRIMARY KEY (`Cod_Medios_pago`);

--
-- Indices de la tabla `opinion`
--
ALTER TABLE `opinion`
  ADD PRIMARY KEY (`Id_Opinion`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`Num_Domicilio`),
  ADD KEY `fk_Domicilio_Info_Rest1_idx` (`Info_Rest_Nit_Rest`),
  ADD KEY `fk_Domicilio_Medios_pago1_idx` (`Medios_pago_Cod_Medios_pago`),
  ADD KEY `fk_Pedido_Tipo_Pedido1_idx` (`Tipo_Pedido_Cod_TP`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IdProducto`);

--
-- Indices de la tabla `producto_has_domicilio`
--
ALTER TABLE `producto_has_domicilio`
  ADD PRIMARY KEY (`Domicilio_Num_Domicilio`,`Producto_IdProducto`),
  ADD KEY `fk_Producto_has_Domicilio_Domicilio1_idx` (`Domicilio_Num_Domicilio`),
  ADD KEY `fk_Producto_has_Domicilio_Producto_idx` (`Producto_IdProducto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Codigo_rol`);

--
-- Indices de la tabla `tipo_identificacion`
--
ALTER TABLE `tipo_identificacion`
  ADD PRIMARY KEY (`Tipo_id`);

--
-- Indices de la tabla `tipo_pedido`
--
ALTER TABLE `tipo_pedido`
  ADD PRIMARY KEY (`Cod_TP`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Tipo_identificacion_Tipo_id`,`Identificacion_usu`),
  ADD KEY `fk_Usuario_Tipo_identificacion1_idx` (`Tipo_identificacion_Tipo_id`),
  ADD KEY `fk_Usuario_Rol1_idx` (`Rol_Codigo_rol`),
  ADD KEY `fk_usuario_usuario_pass` (`Identificacion_usu`);

--
-- Indices de la tabla `usuarios_pass`
--
ALTER TABLE `usuarios_pass`
  ADD PRIMARY KEY (`USUARIO`,`PASSWORD`),
  ADD KEY `ROL` (`ROL`),
  ADD KEY `IDENTIFICACION_USU` (`IDENTIFICACION_USU`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `cart_product`
--
ALTER TABLE `cart_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `opinion`
--
ALTER TABLE `opinion`
  MODIFY `Id_Opinion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `Num_Domicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_Domicilio_Info_Rest1` FOREIGN KEY (`Info_Rest_Nit_Rest`) REFERENCES `info_rest` (`Nit_Rest`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Domicilio_Medios_pago1` FOREIGN KEY (`Medios_pago_Cod_Medios_pago`) REFERENCES `medios_pago` (`Cod_Medios_pago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Pedido_Tipo_Pedido1` FOREIGN KEY (`Tipo_Pedido_Cod_TP`) REFERENCES `tipo_pedido` (`Cod_TP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_has_domicilio`
--
ALTER TABLE `producto_has_domicilio`
  ADD CONSTRAINT `fk_Producto_has_Domicilio_Domicilio1` FOREIGN KEY (`Domicilio_Num_Domicilio`) REFERENCES `pedido` (`Num_Domicilio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Producto_has_Domicilio_Producto` FOREIGN KEY (`Producto_IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Rol1` FOREIGN KEY (`Rol_Codigo_rol`) REFERENCES `rol` (`Codigo_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Usuario_Tipo_identificacion1` FOREIGN KEY (`Tipo_identificacion_Tipo_id`) REFERENCES `tipo_identificacion` (`Tipo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_pass`
--
ALTER TABLE `usuarios_pass`
  ADD CONSTRAINT `fk_rol_usuarios_pass` FOREIGN KEY (`ROL`) REFERENCES `rol` (`Codigo_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_usuario_pass` FOREIGN KEY (`IDENTIFICACION_USU`) REFERENCES `usuario` (`Identificacion_usu`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
