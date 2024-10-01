-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-09-2024 a las 01:03:32
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
-- Base de datos: `tpe web 2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `Nombre_producto` varchar(50) NOT NULL,
  `id_proveedor_fk` int(11) NOT NULL,
  `categoría` varchar(100) NOT NULL
  `cantidad` int(10) NOT NULL,
  `talle` varchar(10) NOT NULL,
  `valor` decimal(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `Nombre_proveedor` varchar(100) NOT NULL,
  `medio_de_pago` varchar(100) NOT NULL,
  `telefono` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Índices para tablas volcadas
--
`id_proveedor` , `Nombre_proveedor` , `medio_de_pago` , `telefono` 
--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_proveedor_fk` (`id_proveedor_fk`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_proveedor_fk`) REFERENCES `proveedor` (`id_proveedor`);
COMMIT;
-- Agrego elementos a la tabla 'proveedor'
INSERT INTO `proveedor` (`id_proveedor` , `Nombre_proveedor` , `medio_de_pago` , `telefono` ) VALUES (1, 'Distrito Moda', 'Transferencia/Credito/Debito', 01124587693) ; 
INSERT INTO `proveedor` (`id_proveedor` , `Nombre_proveedor` , `medio_de_pago` , `telefono` ) VALUES (2, '45 minutos', 'Transferencia',  01146134489 ) ; 
INSERT INTO `proveedor` (`id_proveedor` , `Nombre_proveedor` , `medio_de_pago` , `telefono` ) VALUES (3, 'Embrujo jeans', 'Efectivo/Debito',01146136226 ) ; 
INSERT INTO `proveedor` (`id_proveedor` , `Nombre_proveedor` , `medio_de_pago` , `telefono` ) VALUES (4, 'Salvame', 'Efectivo',01148626139 ) ; 
INSERT INTO `proveedor` (`id_proveedor` , `Nombre_proveedor` , `medio_de_pago` , `telefono` ) VALUES (5, 'LolaModa', 'Efectivo/Debito',22848937396 ) ; 



-- Agrego elementos a la tabla 'producto'
INSERT INTO `producto` (`Nombre_producto`, `id_proveedor_fk`, `categoria`, `cantidad`, `talle`, `valor`) VALUES ('Remera Sol', 1, 'Remeras de mujer', 3, 'L', 8200) ; 
INSERT INTO `producto` (`Nombre_producto`, `id_proveedor_fk`, `categoria`, `cantidad`, `talle`, `valor`) VALUES ('Cargo Eliseo', 3, 'Pantalones de mujer', 2, 'M', 10450) ; 
INSERT INTO `producto` (`Nombre_producto`, `id_proveedor_fk`, `categoria`, `cantidad`, `talle`, `valor`) VALUES ('Campera de jean Margarita', 1, 'Camperas de mujer', 1, 'M', 12300) ; 
INSERT INTO `producto` (`Nombre_producto`, `id_proveedor_fk`, `categoria`, `cantidad`, `talle`, `valor`) VALUES ('Hoodie Alma', 4, 'Buzos de hombre', 2, 'XL', 17000);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
