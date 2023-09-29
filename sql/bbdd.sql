-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-09-2023 a las 15:50:25
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `administrador`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desarrollo`
--

CREATE TABLE `desarrollo` (
  `id` int NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripción` text,
  `imagen` varchar(100) DEFAULT NULL,
  `desarrollouserid` int DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `desarrollo`
--

INSERT INTO `desarrollo` (`id`, `nombre`, `descripción`, `imagen`, `desarrollouserid`, `fecha`) VALUES
(2, 'Marisol', 'Josefa Flores González, conocida artísticamente como Marisol o Pepa Flores, es una actriz y cantante española.​​Como niña prodigio, tuvo un gran éxito en la década de los sesenta en España. El estreno de su primera película Un rayo de luz en 1960 la convirtió en una figura paradigmática y un fenómeno social.​', 'uploads/marisol.jpg', NULL, '2023-08-19 15:20:02'),
(3, 'Rosablanca', 'Rosas blancas, significado: Pureza, amistad y confianza. Regalar rosas blancas es un acto de pureza, transparencia y acompañamiento. Siempre que quieras mostrarle a alguien que estas a su lado o que tus sentimientos son totalmente puros y transparentes hacia esa persona, será un gran acierto regalarle flores blancas.', 'uploads/rosablanca.jpg', NULL, '2023-08-19 15:23:59'),
(4, 'Bernadino', 'Bernardo Rocha de Rezende o simplemente Bernardinho es un exjugador profesional y entrenador de voleibol brasileño, actual seleccionador de la Selección masculina de voleibol de Brasil y del Sesc/Río de Janeiro Vôlei Clube femenino.​', 'uploads/bernardino.jpg', NULL, '2023-08-19 15:30:29'),
(5, 'Salome', 'La palabra Salomé tiene el significado de \"nombre propio que sale en la Biblia de la madre de los apóstoles Juan y Santiago, el anciano\" y viene del griego Salome, derivado del hebreo Shalem = \"paz, bienestar\".', 'uploads/salome.jpg', NULL, '2023-08-19 15:32:37'),
(6, 'Silvia', 'Silvia es un nombre femenino de origen latino que significa natural de los bosques (o reina de la naturaleza). Deriva del latín silva, cuyo significado era selva, bosque siniestro.', 'uploads/silvia.jpg', NULL, '2023-08-19 15:35:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int NOT NULL,
  `misión` text,
  `visión` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `misión`, `visión`) VALUES
(16, 'La misión describe el motivo o la razón de ser de una organización, empresa o institución. Se enfoca en los objetivos a cumplir en el presente. Debe estar definida de manera precisa y concreta para guiar al grupo de trabajo en el día a día. Por ejemplo: La misión de la compañía es mejorar la calidad de los automóviles.', 'La visión de una empresa es el faro de tu empresa que guía el camino que tomarás en el futuro. Se trata de una declaración en la que la empresa define la ruta que seguirá para lograr la misión de la empresa.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripción` text,
  `imagen` varchar(100) DEFAULT NULL,
  `serviciouserid` int DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`, `descripción`, `imagen`, `serviciouserid`, `fecha`) VALUES
(5, 'CHAT BOT', 'Nuestro chat bot ofrece la oportunidad de conectar con más clientes con una herramienta automatizada y fácil de usar para el usuario final.', 'uploads/chatbot.jpg', NULL, '2023-08-19 15:57:45'),
(6, 'Gestor documental', 'Reduce hasta un 70% las tareas manuales de creación, organización, intercambio y firma de documentos con un Gestor Documental software.', 'uploads/gestordocumental.jpg', NULL, '2023-08-19 15:59:09'),
(7, 'Evaluciones de desempeño trabajadores y proveedores', 'Siempre podrás contar con nuestra ayuda para crear un lugar de trabajo más feliz. Agéndate. Puedes configurar distintos tipos de formularios para cada tipo de evaluación.', 'uploads/evaluacionesdedesempeñotrabajadoresyproveedores.jpg', NULL, '2023-08-19 16:00:44'),
(8, 'Desarrollo e integración API Whatsapp', 'Chatbots personalizados para enviar mensajes automáticos. ¡Descubre API Oficial Whatsapp! Amplía tu alcance y fortalece la seguridad en canales digitales con Whatsapp API Oficial.', 'uploads/desarrolloeintegraciónapiwhatsapp.jpg', NULL, '2023-08-19 16:01:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int NOT NULL,
  `tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Desarrollador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `correo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contraseña` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tipousuarioid` int DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `correo`, `contraseña`, `tipousuarioid`, `fecha`, `telefono`) VALUES
(123456, 'prueba1@hotmail.com', '$2y$10$i.RXNCMyJbeVJxJLc6fUQO9OhHlCNUzhQyqptpHcpPwkd5PPpZBee', 2, '2023-08-18 14:01:44', '3204568790'),
(308070735, 'geraldin@gmail.com', '$2y$10$pQl3pxXJOP7VBAdTV3ptO.mqe8rUACVcATwafWGbqqvDMAavji7MS', 1, '2023-08-18 18:21:26', '3124489562'),
(1096245179, 'guillermo971013@hotmail.com', '$2y$10$AXC1uuuLS1rSIbQwKzJwMu44MDtyf7hR5bKOYy5pUq2FzY8DYMUvK', 1, '2023-08-08 19:33:19', '3004969886'),
(1096803384, 'emilymariana@gmail.com', '$2y$10$NTpEEvU7dvamDCuiWHan9.aThkWmYrUCe9ef.oKtS1iUjJFxD1iiG', 2, '2023-09-05 14:22:13', '3138817259');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `desarrollo`
--
ALTER TABLE `desarrollo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desarrollouserid` (`desarrollouserid`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `serviciouserid` (`serviciouserid`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipousuarioid` (`tipousuarioid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `desarrollo`
--
ALTER TABLE `desarrollo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `desarrollo`
--
ALTER TABLE `desarrollo`
  ADD CONSTRAINT `desarrollo_ibfk_1` FOREIGN KEY (`desarrollouserid`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`serviciouserid`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`tipousuarioid`) REFERENCES `tipo_usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
