-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-07-2021 a las 03:07:34
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `credimas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `ID` int(11) NOT NULL,
  `ACCOUNTS_PAYABLE` float NOT NULL,
  `LOANS` int(11) NOT NULL,
  `TYPE` char(1) NOT NULL,
  `LATENESS` int(11) NOT NULL DEFAULT 0,
  `USER_CREATE` varchar(30) NOT NULL,
  `DATE_CREATE` date NOT NULL,
  `USER_UPDATE` varchar(30) DEFAULT NULL,
  `DATE_UPDATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`ID`, `ACCOUNTS_PAYABLE`, `LOANS`, `TYPE`, `LATENESS`, `USER_CREATE`, `DATE_CREATE`, `USER_UPDATE`, `DATE_UPDATE`) VALUES
(16, 0, 0, 'C', 0, 'admin', '0000-00-00', NULL, NULL),
(20, 0, 0, 'C', 0, 'admin', '0000-00-00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consecutive`
--

CREATE TABLE `consecutive` (
  `ID` int(11) NOT NULL,
  `USERS` int(11) NOT NULL,
  `FEES_DOCUMENTS` int(11) NOT NULL,
  `LOAN_DOCUMENTS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `consecutive`
--

INSERT INTO `consecutive` (`ID`, `USERS`, `FEES_DOCUMENTS`, `LOAN_DOCUMENTS`) VALUES
(1, 21, 18, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currencies`
--

CREATE TABLE `currencies` (
  `ID` varchar(5) NOT NULL,
  `DESCRIPTION` varchar(50) NOT NULL,
  `USER_CREATE` varchar(30) NOT NULL,
  `DATE_CREATE` date NOT NULL,
  `USER_UPDATE` varchar(30) DEFAULT NULL,
  `DATE_UPDATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `currencies`
--

INSERT INTO `currencies` (`ID`, `DESCRIPTION`, `USER_CREATE`, `DATE_CREATE`, `USER_UPDATE`, `DATE_UPDATE`) VALUES
('CNY', 'Yuán', 'admin', '0000-00-00', NULL, NULL),
('COR', 'Córdoba', 'admin', '0000-00-00', 'admin', NULL),
('EUR', 'Euro', 'admin', '0000-00-00', 'admin', NULL),
('USD', 'Dólar', 'admin', '0000-00-00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fees_documents`
--

CREATE TABLE `fees_documents` (
  `ID` int(11) NOT NULL,
  `ID_LOAN` int(11) NOT NULL,
  `N_PARTIAL` int(11) NOT NULL,
  `GROSS_AMOUNT` float NOT NULL,
  `FINANCIAL_ENTITY` varchar(5) DEFAULT NULL,
  `CURRENCY` varchar(5) DEFAULT NULL,
  `INTERES` float NOT NULL,
  `DEDUCTION` float NOT NULL,
  `TOTAL_AMOUNT` float NOT NULL,
  `BALANCE` float NOT NULL,
  `TRANSACTION` varchar(200) DEFAULT NULL,
  `STATUS` varchar(10) NOT NULL,
  `PAYMENT_DATE` date NOT NULL,
  `USER_CREATE` varchar(30) NOT NULL,
  `DATE_CREATE` date NOT NULL,
  `USER_UPDATE` varchar(30) DEFAULT NULL,
  `DATE_UPDATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fees_documents`
--

INSERT INTO `fees_documents` (`ID`, `ID_LOAN`, `N_PARTIAL`, `GROSS_AMOUNT`, `FINANCIAL_ENTITY`, `CURRENCY`, `INTERES`, `DEDUCTION`, `TOTAL_AMOUNT`, `BALANCE`, `TRANSACTION`, `STATUS`, `PAYMENT_DATE`, `USER_CREATE`, `DATE_CREATE`, `USER_UPDATE`, `DATE_UPDATE`) VALUES
(3, 3, 1, 33.33, NULL, 'USD', 10, 33.33, 10, 43.33, NULL, 'pending', '2021-08-23', '19', '2021-07-24', '1', '2021-07-26'),
(4, 3, 2, 33.33, NULL, 'USD', 6.67, 5, 35, 40, NULL, 'pending', '2021-09-22', '19', '2021-07-24', '1', '2021-07-26'),
(5, 3, 3, 33.33, NULL, 'USD', 3.33, 0, 36.66, 36.66, NULL, 'pending', '2021-10-22', '19', '2021-07-24', '1', '2021-07-26'),
(6, 4, 1, 41.67, NULL, 'EUR', 75, 0, 116.67, 116.67, NULL, 'pending', '2021-08-30', '19', '2021-07-24', '1', '2021-07-26'),
(7, 4, 2, 41.67, NULL, 'EUR', 68.75, 0, 110.42, 110.42, NULL, 'pending', '2021-09-29', '19', '2021-07-24', '1', '2021-07-26'),
(8, 4, 3, 41.67, NULL, 'EUR', 62.5, 0, 104.17, 104.17, NULL, 'pending', '2021-10-29', '19', '2021-07-24', '1', '2021-07-26'),
(9, 4, 4, 41.67, NULL, 'EUR', 56.25, 0, 97.92, 97.92, NULL, 'pending', '2021-11-28', '19', '2021-07-24', '1', '2021-07-26'),
(10, 4, 5, 41.67, NULL, 'EUR', 50, 0, 91.67, 91.67, NULL, 'pending', '2021-12-28', '19', '2021-07-24', '1', '2021-07-26'),
(11, 4, 6, 41.67, NULL, 'EUR', 43.75, 0, 85.42, 85.42, NULL, 'pending', '2022-01-27', '19', '2021-07-24', '1', '2021-07-26'),
(12, 4, 7, 41.67, NULL, 'EUR', 37.5, 0, 79.17, 79.17, NULL, 'pending', '2022-02-26', '19', '2021-07-24', '1', '2021-07-26'),
(13, 4, 8, 41.67, NULL, 'EUR', 31.25, 0, 72.92, 72.92, NULL, 'pending', '2022-03-28', '19', '2021-07-24', '1', '2021-07-26'),
(14, 4, 9, 41.67, NULL, 'EUR', 25, 0, 66.67, 66.67, NULL, 'pending', '2022-04-27', '19', '2021-07-24', '1', '2021-07-26'),
(15, 4, 10, 41.67, NULL, 'EUR', 18.75, 0, 60.42, 60.42, NULL, 'pending', '2022-05-27', '19', '2021-07-24', '1', '2021-07-26'),
(16, 4, 11, 41.67, NULL, 'EUR', 12.5, 0, 54.17, 54.17, NULL, 'pending', '2022-06-26', '19', '2021-07-24', '1', '2021-07-26'),
(17, 4, 12, 41.67, NULL, 'EUR', 6.24, 0, 47.91, 47.91, NULL, 'pending', '2022-07-26', '19', '2021-07-24', '1', '2021-07-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `financial_entities`
--

CREATE TABLE `financial_entities` (
  `ID` varchar(10) NOT NULL,
  `DESCRIPTION` varchar(100) NOT NULL,
  `USER_CREATE` varchar(30) NOT NULL,
  `DATE_CREATE` date NOT NULL,
  `USER_UPDATE` varchar(30) DEFAULT NULL,
  `DATE_UPDATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `financial_entities`
--

INSERT INTO `financial_entities` (`ID`, `DESCRIPTION`, `USER_CREATE`, `DATE_CREATE`, `USER_UPDATE`, `DATE_UPDATE`) VALUES
('BAC', 'Banco de Centroamérica', 'admin', '0000-00-00', 'admin', NULL),
('BANPRO', 'Banco Promérica', 'admin', '0000-00-00', 'admin', NULL),
('LAFISE', 'Banco Lafise Bancentro', 'admin', '0000-00-00', NULL, NULL),
('LAFISE2', 'Banco Lafise Bancentro ', 'admin', '0000-00-00', 'admin', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lenders`
--

CREATE TABLE `lenders` (
  `ID` int(11) NOT NULL,
  `CAPITAL` float NOT NULL,
  `ACCOUNTS_RECEIVABLE` float NOT NULL,
  `LOANS` int(11) NOT NULL,
  `USER_CREATE` varchar(30) NOT NULL,
  `DATE_CREATE` date NOT NULL,
  `USER_UPDATE` varchar(30) DEFAULT NULL,
  `DATE_UPDATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lenders`
--

INSERT INTO `lenders` (`ID`, `CAPITAL`, `ACCOUNTS_RECEIVABLE`, `LOANS`, `USER_CREATE`, `DATE_CREATE`, `USER_UPDATE`, `DATE_UPDATE`) VALUES
(19, 0, 0, 0, 'admin', '0000-00-00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loan_documents`
--

CREATE TABLE `loan_documents` (
  `ID` int(11) NOT NULL,
  `ID_LENDER` int(11) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  `GROSS_AMOUNT` float NOT NULL,
  `PARTIAL_AMOUNT` float NOT NULL,
  `INTERES_RATE` float NOT NULL,
  `TOTAL_AMOUNT` float NOT NULL,
  `PARTIALS` int(11) NOT NULL,
  `BALANCE` float NOT NULL,
  `CURRENCY` varchar(5) NOT NULL,
  `STATUS` varchar(20) NOT NULL,
  `TERM` varchar(20) NOT NULL,
  `LOAN_RECEIPT` varchar(200) DEFAULT NULL,
  `INIT_DATE` date NOT NULL,
  `USER_CREATE` varchar(30) NOT NULL,
  `DATE_CREATE` date NOT NULL,
  `USER_UPDATE` varchar(30) DEFAULT NULL,
  `DATE_UPDATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `loan_documents`
--

INSERT INTO `loan_documents` (`ID`, `ID_LENDER`, `ID_CLIENT`, `GROSS_AMOUNT`, `PARTIAL_AMOUNT`, `INTERES_RATE`, `TOTAL_AMOUNT`, `PARTIALS`, `BALANCE`, `CURRENCY`, `STATUS`, `TERM`, `LOAN_RECEIPT`, `INIT_DATE`, `USER_CREATE`, `DATE_CREATE`, `USER_UPDATE`, `DATE_UPDATE`) VALUES
(3, 19, 16, 100, 33.33, 10, 100, 3, 100, 'USD', 'pending', '30', '273dda74f4e3f804caa1b1be02f0a549.png', '2021-07-24', '19', '2021-07-24', NULL, NULL),
(4, 19, 20, 500, 41.67, 15, 500, 12, 500, 'EUR', 'pending', '30', '691292d6699edd9311d0c3cfa8494897.png', '2021-07-31', '19', '2021-07-24', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments_details`
--

CREATE TABLE `payments_details` (
  `ID` int(11) NOT NULL,
  `ID_FEE_DOCUMENT` int(11) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  `AMOUNT` float NOT NULL,
  `CURRENCY` varchar(5) NOT NULL,
  `FINANCIAL_ENTITY` varchar(10) NOT NULL,
  `CURRENCY_DOCUMENT` varchar(5) NOT NULL,
  `EXCHANGE_RATE` int(11) NOT NULL,
  `TRANSACTION` varchar(200) DEFAULT NULL,
  `STATUS` varchar(10) NOT NULL,
  `USER_CREATE` varchar(20) NOT NULL,
  `DATE_CREATE` date NOT NULL,
  `USER_UPDATE` varchar(20) DEFAULT NULL,
  `DATE_UPDATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `payments_details`
--

INSERT INTO `payments_details` (`ID`, `ID_FEE_DOCUMENT`, `ID_CLIENT`, `AMOUNT`, `CURRENCY`, `FINANCIAL_ENTITY`, `CURRENCY_DOCUMENT`, `EXCHANGE_RATE`, `TRANSACTION`, `STATUS`, `USER_CREATE`, `DATE_CREATE`, `USER_UPDATE`, `DATE_UPDATE`) VALUES
(7, 3, 16, 10, 'USD', 'BANPRO', 'USD', 1, NULL, 'rejected', '16', '2021-07-24', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `ROLE` varchar(10) NOT NULL,
  `PHOTO` varchar(150) DEFAULT NULL,
  `ADDRESS` varchar(150) DEFAULT NULL,
  `PHONE` varchar(10) DEFAULT NULL,
  `FIRST_NAME` varchar(20) DEFAULT NULL,
  `SECOND_NAME` varchar(20) DEFAULT NULL,
  `FIRST_LASTNAME` varchar(20) DEFAULT NULL,
  `SECOND_LASTNAME` varchar(20) DEFAULT NULL,
  `IDENTIFICATION` varchar(20) DEFAULT NULL,
  `IDENTIFICATION_PHOTO` varchar(150) DEFAULT NULL,
  `USER_CREATE` varchar(30) NOT NULL,
  `DATE_CREATE` date NOT NULL,
  `USER_UPDATE` varchar(30) DEFAULT NULL,
  `DATE_UPDATE` date DEFAULT NULL,
  `VERIFIED` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`ID`, `USERNAME`, `PASSWORD`, `ROLE`, `PHOTO`, `ADDRESS`, `PHONE`, `FIRST_NAME`, `SECOND_NAME`, `FIRST_LASTNAME`, `SECOND_LASTNAME`, `IDENTIFICATION`, `IDENTIFICATION_PHOTO`, `USER_CREATE`, `DATE_CREATE`, `USER_UPDATE`, `DATE_UPDATE`, `VERIFIED`) VALUES
(1, 'admin', '$2y$05$XHXkA4HxCEs6/WbxIBYJR.eCBf5IY/H5Gl.3hx6Gd/H3nqDuiG2c6', 'admin', NULL, 'De', '5768-9250', 'Gabriel', 'Alejandro', 'Ortiz', 'Amador', NULL, NULL, 'admin', '2021-07-09', 'admin', '2021-07-26', 1),
(16, 'Luis', '$2y$05$3wNMHO3HlqNFpaObMDq/De2E9ww/sbbZbP7T1ZxvxdXCQkMrvbDvS', 'client', NULL, 'De la Rotonda b...', '4356-5607', 'Luis', 'Miguel', 'Pineda', 'Joseph', '001-200504-1002L', NULL, 'admin', '0000-00-00', 'Luis', '2021-07-17', 0),
(19, 'Engel', '$2y$05$lsRwRdGDLGELMwXOT6NbW.ufl9xoLNLPuFj.S3p35zu0.AhR09Zb.', 'lender', NULL, '-', '4546-6543', 'Engel', 'Gabriel', 'Reyes', 'Moreno', '607-654545-3430A', NULL, 'admin', '0000-00-00', 'Engel', '2021-07-17', 0),
(20, 'SA', '$2y$05$Oe7QqwX.PFKXiF4UB4Pzu.WA/DpU8JMYtHoHK9rXYcZV7cNgzcoFS', 'client', NULL, '-', '8945-6634', 'Cristian', '', 'Rodriguez', '', '001-304404-2043U', NULL, 'admin', '0000-00-00', 'SA', '2021-07-24', 0),
(21, 'G_ORTIZ', '$2y$05$hncuvrW1b2uEN5EsxwoiVu8qJET.ayOIQ41cHB.CvRNyXGvmtR89q', 'client', NULL, '-', '5768-9250', 'Alejandro', 'Gabriel', 'Amador', 'Ortiz', '570-251102-1010Q', NULL, 'admin', '2021-07-26', NULL, NULL, 0),
(22, 'LSPINEDA', '$2y$05$PWOIuqMBDNPEGeT2/MtgUu4op10N1u1bdxaNNHokw/KkU1pemB7se', 'client', NULL, '-', '4340-5454', 'Miguel', 'Alejandro', 'Pineda', 'Itsme', '435-454545-2991Q', NULL, 'Engel', '2021-07-26', NULL, NULL, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD KEY `ID` (`ID`);

--
-- Indices de la tabla `consecutive`
--
ALTER TABLE `consecutive`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `fees_documents`
--
ALTER TABLE `fees_documents`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_LOAN` (`ID_LOAN`),
  ADD KEY `CURRENCY` (`CURRENCY`);

--
-- Indices de la tabla `financial_entities`
--
ALTER TABLE `financial_entities`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `lenders`
--
ALTER TABLE `lenders`
  ADD KEY `ID` (`ID`);

--
-- Indices de la tabla `loan_documents`
--
ALTER TABLE `loan_documents`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_CLIENT` (`ID_CLIENT`),
  ADD KEY `ID_LENDER` (`ID_LENDER`),
  ADD KEY `CURRENCY` (`CURRENCY`);

--
-- Indices de la tabla `payments_details`
--
ALTER TABLE `payments_details`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_FEE_DOCUMENT` (`ID_FEE_DOCUMENT`),
  ADD KEY `FINANCIAL_ENTITY` (`FINANCIAL_ENTITY`),
  ADD KEY `CURRENCY` (`CURRENCY`),
  ADD KEY `CURRENCY_DOCUMENT` (`CURRENCY_DOCUMENT`),
  ADD KEY `ID_CLIENT` (`ID_CLIENT`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consecutive`
--
ALTER TABLE `consecutive`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `fees_documents`
--
ALTER TABLE `fees_documents`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT de la tabla `loan_documents`
--
ALTER TABLE `loan_documents`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `payments_details`
--
ALTER TABLE `payments_details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `fees_documents`
--
ALTER TABLE `fees_documents`
  ADD CONSTRAINT `fees_documents_ibfk_1` FOREIGN KEY (`ID_LOAN`) REFERENCES `loan_documents` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fees_documents_ibfk_2` FOREIGN KEY (`FINANCIAL_ENTITY`) REFERENCES `financial_entities` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fees_documents_ibfk_3` FOREIGN KEY (`CURRENCY`) REFERENCES `currencies` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `lenders`
--
ALTER TABLE `lenders`
  ADD CONSTRAINT `lenders_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `loan_documents`
--
ALTER TABLE `loan_documents`
  ADD CONSTRAINT `loan_documents_ibfk_1` FOREIGN KEY (`ID_CLIENT`) REFERENCES `clients` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `loan_documents_ibfk_2` FOREIGN KEY (`ID_LENDER`) REFERENCES `lenders` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `loan_documents_ibfk_3` FOREIGN KEY (`CURRENCY`) REFERENCES `currencies` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `payments_details`
--
ALTER TABLE `payments_details`
  ADD CONSTRAINT `payments_details_ibfk_1` FOREIGN KEY (`ID_FEE_DOCUMENT`) REFERENCES `fees_documents` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `payments_details_ibfk_2` FOREIGN KEY (`FINANCIAL_ENTITY`) REFERENCES `financial_entities` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `payments_details_ibfk_3` FOREIGN KEY (`CURRENCY`) REFERENCES `currencies` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `payments_details_ibfk_4` FOREIGN KEY (`CURRENCY_DOCUMENT`) REFERENCES `currencies` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `payments_details_ibfk_5` FOREIGN KEY (`ID_CLIENT`) REFERENCES `clients` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
