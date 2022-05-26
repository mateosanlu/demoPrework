-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2022 a las 16:08:08
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cognox_bank`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(11) NOT NULL,
  `ACC_CNAME` varchar(25) NOT NULL,
  `ACC_NNUMBER` varchar(11) NOT NULL DEFAULT '0000000000',
  `ACC_NBALANCE` int(20) NOT NULL DEFAULT 0,
  `ID_ACCOUNT_TYPE` int(11) NOT NULL,
  `ID_CLIENTS` int(11) NOT NULL,
  `ACC_BSTATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accounts`
--

INSERT INTO `accounts` (`ID`, `ACC_CNAME`, `ACC_NNUMBER`, `ACC_NBALANCE`, `ID_ACCOUNT_TYPE`, `ID_CLIENTS`, `ACC_BSTATUS`) VALUES
(1, 'Cuenta de Ahorros', '220123456', 3, 1, 1, 1),
(2, 'Cuenta de Nómina', '220123789', 3, 1, 1, 1),
(3, 'Cuenta de Ahorros', '770142536', 4, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account_type`
--

CREATE TABLE `account_type` (
  `ID` int(11) NOT NULL,
  `ATY_CNAME` varchar(25) NOT NULL DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `account_type`
--

INSERT INTO `account_type` (`ID`, `ATY_CNAME`) VALUES
(1, ' Ahorros'),
(2, ' Corriente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `ID` int(11) NOT NULL,
  `CLI_NIDENTIFICATION` int(11) NOT NULL,
  `ID_IDENTIFICATION_TYPE` int(11) NOT NULL,
  `CLI_CFIRSTNAME` varchar(50) NOT NULL,
  `CLI_CSECONDNAME` varchar(50) DEFAULT NULL,
  `CLI_CLASTNAME` varchar(50) NOT NULL,
  `CLI_CLASTNAME_MOTHER` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`ID`, `CLI_NIDENTIFICATION`, `ID_IDENTIFICATION_TYPE`, `CLI_CFIRSTNAME`, `CLI_CSECONDNAME`, `CLI_CLASTNAME`, `CLI_CLASTNAME_MOTHER`) VALUES
(1, 1010123456, 1, 'Mateo', NULL, 'Sandoval', 'Luna'),
(2, 1010456789, 1, 'Juan', 'Pablo', 'Montoya', 'Roldán');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `identification_type`
--

CREATE TABLE `identification_type` (
  `ID` int(11) NOT NULL,
  `ITY_CNAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `identification_type`
--

INSERT INTO `identification_type` (`ID`, `ITY_CNAME`) VALUES
(1, 'Cédula de Ciudadanía'),
(2, 'Cédula de Extranjería'),
(3, 'Tarjeta de Identidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg_accounts`
--

CREATE TABLE `reg_accounts` (
  `ID` int(11) NOT NULL,
  `RAC_CNAME` varchar(25) NOT NULL,
  `ID_CLIENTS` int(11) NOT NULL,
  `ID_ACCOUNTS` int(11) NOT NULL,
  `RAC_BSTATUS` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reg_accounts`
--

INSERT INTO `reg_accounts` (`ID`, `RAC_CNAME`, `ID_CLIENTS`, `ID_ACCOUNTS`, `RAC_BSTATUS`) VALUES
(1, 'Cuenta de Juan', 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transactions`
--

CREATE TABLE `transactions` (
  `ID` int(11) NOT NULL,
  `ID_ACCOUNTS_ORI` int(11) NOT NULL,
  `ID_ACCOUNTS_DES` int(11) NOT NULL,
  `TRA_NVALUE` int(20) NOT NULL DEFAULT 0,
  `TRA_DDATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_TRANSACTIONS_STATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `transactions`
--

INSERT INTO `transactions` (`ID`, `ID_ACCOUNTS_ORI`, `ID_ACCOUNTS_DES`, `TRA_NVALUE`, `TRA_DDATE`, `ID_TRANSACTIONS_STATUS`) VALUES
(1, 2, 1, 1, '2022-05-23 04:35:46', 1),
(8, 2, 1, 1, '2022-05-23 05:03:43', 3),
(9, 2, 1, 1, '2022-05-23 05:07:39', 3),
(10, 2, 1, 1, '2022-05-23 05:07:53', 3),
(11, 2, 1, 1, '2022-05-23 05:11:40', 3),
(12, 2, 1, 2, '2022-05-23 05:54:56', 3),
(13, 1, 3, 3, '2022-05-23 09:54:53', 3),
(14, 2, 3, 1, '2022-05-23 11:18:14', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transactions_status`
--

CREATE TABLE `transactions_status` (
  `ID` int(11) NOT NULL,
  `TST_CNAME` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `transactions_status`
--

INSERT INTO `transactions_status` (`ID`, `TST_CNAME`) VALUES
(1, 'Pendiente'),
(2, 'Anulada'),
(3, 'Exitosa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `ID_CLIENTS` int(11) NOT NULL,
  `USE_CPASSWORD` varchar(50) NOT NULL,
  `USE_NSTATUS` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`ID_CLIENTS`, `USE_CPASSWORD`, `USE_NSTATUS`) VALUES
(1, '46093a7d5fd51f2617806d9324e48728812ef40f', 1),
(2, '46093a7d5fd51f2617806d9324e48728812ef40f', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ACCOUNT_TYPE` (`ID_ACCOUNT_TYPE`),
  ADD KEY `ID_CLIENTS` (`ID_CLIENTS`);

--
-- Indices de la tabla `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_IDENTIFICATION_TYPE` (`ID_IDENTIFICATION_TYPE`);

--
-- Indices de la tabla `identification_type`
--
ALTER TABLE `identification_type`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `reg_accounts`
--
ALTER TABLE `reg_accounts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_CLIENTS` (`ID_CLIENTS`),
  ADD KEY `ID_ACCOUNTS` (`ID_ACCOUNTS`);

--
-- Indices de la tabla `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ACCOUNTS_ORI` (`ID_ACCOUNTS_ORI`),
  ADD KEY `ID_ACCOUNTS_DES` (`ID_ACCOUNTS_DES`),
  ADD KEY `ID_TRANSACTIONS_STATUS` (`ID_TRANSACTIONS_STATUS`);

--
-- Indices de la tabla `transactions_status`
--
ALTER TABLE `transactions_status`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_CLIENTS`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `account_type`
--
ALTER TABLE `account_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `identification_type`
--
ALTER TABLE `identification_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reg_accounts`
--
ALTER TABLE `reg_accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `transactions`
--
ALTER TABLE `transactions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `transactions_status`
--
ALTER TABLE `transactions_status`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`ID_ACCOUNT_TYPE`) REFERENCES `account_type` (`ID`),
  ADD CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`ID_CLIENTS`) REFERENCES `clients` (`ID`);

--
-- Filtros para la tabla `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`ID_IDENTIFICATION_TYPE`) REFERENCES `identification_type` (`ID`);

--
-- Filtros para la tabla `reg_accounts`
--
ALTER TABLE `reg_accounts`
  ADD CONSTRAINT `reg_accounts_ibfk_1` FOREIGN KEY (`ID_CLIENTS`) REFERENCES `clients` (`ID`),
  ADD CONSTRAINT `reg_accounts_ibfk_2` FOREIGN KEY (`ID_ACCOUNTS`) REFERENCES `accounts` (`ID`);

--
-- Filtros para la tabla `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`ID_ACCOUNTS_ORI`) REFERENCES `accounts` (`ID`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`ID_ACCOUNTS_DES`) REFERENCES `accounts` (`ID`),
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`ID_TRANSACTIONS_STATUS`) REFERENCES `transactions_status` (`ID`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ID_CLIENTS`) REFERENCES `clients` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
