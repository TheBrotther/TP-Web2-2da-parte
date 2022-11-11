-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2022 a las 21:52:41
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpweb2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account`
--

CREATE TABLE `account` (
  `id_account` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `type_account` varchar(20) NOT NULL,
  `coin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `account`
--

INSERT INTO `account` (`id_account`, `id_client`, `amount`, `type_account`, `coin`) VALUES
(6, 1, 2147483647, 'Caja de ahorro', 'Dolar Estadounidense'),
(10, 2, 5000000, 'Cuenta corriente', 'Dolar Estadounidense');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `alias` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id_client`, `dni`, `alias`, `city`) VALUES
(0, 38178273, 'Lucas', 'Tandil'),
(1, 41258326, 'Carreto', 'Gesell'),
(2, 42136985, 'Marcos', 'Gesell');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `email` text NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `id_client`, `username`, `pass`, `email`, `rol`) VALUES
(8, 0, 'Lucas', '$2y$10$a4pDdQtUFe2p4Yupj1PcfeMmuwABr72AwUCXZQQAG2ubJLfTMRD8e', 'quiroga9409@gmail.com', 'admin'),
(9, 1, 'Carretto', '$2y$10$A0usUMUTK.fcmOP.0FT/ZOnVeb0BKlE8i3ErqOPeFzSAZ1xMw1eH.', 'carretto_leonardo@gmail.com', 'normal'),
(10, 2, 'Marcos', '$2y$10$8c9bb93nvbCT3pSUTG09dujlopp669ZrAM/u./4fDAnj/0CAT73gS', 'marcos_fumador@gmail.com', 'normal');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_account`),
  ADD KEY `FK_id_client` (`id_client`) USING BTREE;

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_cliente` (`id_client`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `account`
--
ALTER TABLE `account`
  MODIFY `id_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
