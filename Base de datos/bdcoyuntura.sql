-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-07-2017 a las 00:01:06
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdcoyuntura`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambito`
--

CREATE TABLE `ambito` (
  `idAmbito` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ambito`
--

INSERT INTO `ambito` (`idAmbito`, `Nombre`) VALUES
(1, 'España'),
(2, 'Burgos'),
(3, 'Castilla y León'),
(4, 'Europa'),
(5, 'Mundo'),
(6, 'China'),
(7, 'Aragon'),
(9, 'Groenlandia'),
(10, 'Costa Rica'),
(27, 'Alarcia'),
(28, 'Zimbawe'),
(29, 'Aranda de Duero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `idSuperCategoria` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `idSuperCategoria`, `Nombre`) VALUES
(2, 1, 'IPI de bienes de consumo'),
(3, 2, 'Importación de bienes de equipo'),
(4, 2, 'Matriculación de vehiculos industriales'),
(5, 3, 'Importaciones'),
(6, 4, 'IPI General'),
(7, 4, 'Consumo de energía eléctrica en la industria'),
(8, 5, 'Consumo aparente de cemento'),
(9, 6, 'Turistas Totales'),
(10, 6, 'Tráfico aéreo de pasajeros'),
(34, 9, 'Agricultura'),
(45, 9, 'Saldo comercial'),
(58, 1, 'Consumo interior'),
(79, 1, 'Consumo Exterior'),
(81, 29, 'Tasa de paro < 25 años'),
(82, 29, 'Tasa de paro > 25 años'),
(85, 9, 'Volumen de creditos'),
(89, 9, 'Grado de ocupación de establecimientos hoteleros'),
(90, 9, 'Activos fijos inmateriales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuente`
--

CREATE TABLE `fuente` (
  `idFuente` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fuente`
--

INSERT INTO `fuente` (`idFuente`, `Name`) VALUES
(1, 'Elaboración Propia'),
(2, 'IPI BASE 2005'),
(3, 'INE'),
(4, 'IPI Base 2007'),
(29, 'INE y Elaboración propia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2017_06_19_045127_entrust_setup_tables', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL, NULL, NULL),
(2, 'editor', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supercategoria`
--

CREATE TABLE `supercategoria` (
  `idSuperCategoria` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `supercategoria`
--

INSERT INTO `supercategoria` (`idSuperCategoria`, `Name`) VALUES
(1, 'Consumo'),
(2, 'Inversión'),
(3, 'Sector Exterior'),
(4, 'Industria'),
(5, 'Construcción'),
(6, 'Servicios'),
(9, 'Sin categoria'),
(29, 'Tasa de Paro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'SuperAdmin@superadmin.es', '$2y$10$APXb6Ksz0GXH66bLi1uSd.Q4UFb3eGDsbL4lKXEvpKz8XdgGcjyuu', 'AEQWPrkF0C2vSgYFQpSndr1kKQzBRgxSKzKB5IoYNIbPnty5ZKJrWDpRr7SL', '2017-06-19 09:09:04', '2017-06-19 09:09:04'),
(10, 'Admin', 'Admin@admin.es', '$2y$10$/G9ayx.zhwosC18oqv7hVe0Deshpzzzo7dY2/tGXJRvXA.1hvruJi', 'omSo8sZBbS3kYBxzBOC6wLCsRt84w88zajWw3gpn8CmO2kKoWTFHZZ6RBrum', '2017-06-25 17:17:41', '2017-07-01 08:52:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usersconfirm`
--

CREATE TABLE `usersconfirm` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variable`
--

CREATE TABLE `variable` (
  `idVariable` int(11) NOT NULL,
  `idFuente` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Descripcion` varchar(1000) NOT NULL,
  `Tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `variable`
--

INSERT INTO `variable` (`idVariable`, `idFuente`, `Nombre`, `Descripcion`, `Tipo`) VALUES
(5, 4, 'Indicadores de Demanda', 'Los municipios con población inferior a los 1.000 habitantes, presentan\r\nevoluciones y tendencias muy dispares y en algunos casos muy variables,\r\nposiblemente por circunstancias muy particulares. En general, se acentúa la\r\nregresión poblacional, en una situación que se puede calificar de muy difícil\r\nretorno por el elevado número de núcleos de población y la escasa dimensión de\r\nlos mismos, lo que dificulta la implantación y dotación de unos servicios mínimos,\r\nque garanticen el bienestar de la población con unos baremos aceptables en\r\nnuestra sociedad actual. De nuevo encontramos una evolución anómala en el\r\nconjunto de los municipios de entre 250 y 500 habitantes, donde el conjunto ha\r\ndescendido muy levemente y hay núcleos de población en esta franja poblacional\r\ncon incrementos significativos de población (Villalmanzo casi un 12%,\r\nMecerreyes supera el 10%), sin embargo la mayoría mantiene significativas\r\npérdidas de población.', 'Tasa de variación'),
(6, 1, 'Indicadores de Oferta', 'En el caso de las economías de mercados emergentes y en desarrollo, se ha\r\ncontinuado con un elevado ritmo de crecimiento. La reducción de la demanda\r\nexterna en muchas economías emergentes, como las de Asia, se ha compensado\r\ncon la mejora de la demanda interna. El desafío actual se centra en afrontar los\r\nnuevos riesgos de recalentamiento derivados de las limitaciones de capacidad\r\nproductiva y de la gran afluencia de flujos de capital. Las economías en desarrollo\r\n–en especial, las economías de África subsahariana– también han reanudado un\r\nelevado crecimiento en 2010, aunque amenazado por la fuerte subida del precio\r\nde los alimentos y de la energía y la incertidumbre suscitada por las tensiones\r\npolíticas y sociales en los países de Oriente Medio y Norte de África.', 'Tasa de variación'),
(23, 29, 'Perspectivas de la economía: Proyecciones', 'La evolución negativa en Burgos se ha confirmado en el año 2010 con los\r\ndatos del padrón, que recoge una disminución del -0,2%, aunque el avance del\r\npadrón a 1 de enero de 2011 refleja una pequeña recuperación del 0,16%. Sin\r\nembargo, los datos de población estimada, también elaborados por el INE,\r\nindican una pérdida de población mucho más preocupante a partir del otoño de\r\n2009, que en tanto anual superan el -0,6%, situación que se mantiene e incluso se\r\nagrava ligeramente durante el año 2010 y 2011, lo que implica una pérdida\r\nsuperior de más de 5.000 habitantes desde octubre de 2009. Además, esta\r\ndisminución, en porcentaje, es muy superior a la que experimenta el conjunto de\r\nla Comunidad Autónoma, -0,31%, que por primera vez presenta una evolución\r\nmenos negativa que la provincia de Burgos y en un contexto nacional donde la\r\npoblación sigue incrementándose, el 0,35%, aunque a ritmos muy inferiores a los\r\naños precedentes.', 'Variación de población'),
(25, 1, 'Tasa de Paro', 'En este contexto de recuperación lenta, desempleo elevado e inflación\r\ncontrolada, las autoridades justifican seguir apoyando la actividad económica\r\nmediante políticas expansivas. Sin embargo, el elevado déficit fiscal –el más alto\r\nentre las economías avanzadas junto a Irlanda en 2011– y el notable incremento\r\nde la deuda pública ponen de manifiesto un escenario fiscal insostenible, que\r\nlimita considerablemente su margen de maniobra (véase la tabla 3.2). Si la\r\nrecuperación continúa siendo débil, la combinación de políticas más probable\r\nserá el mantenimiento de las medidas acomodaticias para apoyar el crecimiento\r\npor parte de la Reserva Federal y la adopción de medidas fiscales para garantizar\r\nla sostenibilidad fiscal a medio plazo. Junto a las medidas monetarias y fiscales,\r\nse considera fundamental continuar con las reformas en el sistema financiero y en\r\nel sector exterior', '%');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variableambitocategoria`
--

CREATE TABLE `variableambitocategoria` (
  `idVariable` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idAmbito` int(11) NOT NULL,
  `Mes` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  `Valor` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `variableambitocategoria`
--

INSERT INTO `variableambitocategoria` (`idVariable`, `idCategoria`, `idAmbito`, `Mes`, `Year`, `Valor`) VALUES
(5, 2, 1, 1, 2011, 7.9),
(5, 3, 1, 1, 2011, -7.6),
(5, 4, 1, 1, 2011, 10.8),
(5, 5, 1, 1, 2011, 18.1),
(5, 2, 1, 2, 2011, 7.9),
(5, 2, 1, 3, 2011, 7.9),
(5, 2, 1, 4, 2011, -8.2),
(5, 2, 1, 5, 2011, -8.2),
(5, 2, 1, 6, 2011, -8.2),
(5, 2, 1, 7, 2011, -3.5),
(5, 2, 1, 8, 2011, -3.5),
(5, 2, 1, 9, 2011, -3.5),
(5, 2, 1, 10, 2011, -3.6),
(5, 2, 1, 11, 2011, -3.6),
(5, 2, 1, 12, 2011, -3.6),
(5, 3, 1, 2, 2011, -7.6),
(5, 3, 1, 3, 2011, -7.6),
(5, 3, 1, 4, 2011, -31.1),
(5, 3, 1, 5, 2011, -31.1),
(5, 3, 1, 6, 2011, -31.1),
(5, 3, 1, 7, 2011, -26.7),
(5, 3, 1, 8, 2011, -26.7),
(5, 3, 1, 9, 2011, -26.7),
(5, 3, 1, 10, 2011, -15.5),
(5, 3, 1, 11, 2011, -15.5),
(5, 3, 1, 12, 2011, -15.5),
(5, 4, 1, 2, 2011, 10.8),
(5, 4, 1, 3, 2011, 10.8),
(5, 4, 1, 4, 2011, 2),
(5, 4, 1, 5, 2011, 2),
(5, 4, 1, 6, 2011, 2),
(5, 4, 1, 7, 2011, -19.3),
(5, 4, 1, 8, 2011, -19.3),
(5, 4, 1, 9, 2011, -19.3),
(5, 4, 1, 10, 2011, -22.5),
(5, 4, 1, 11, 2011, -22.5),
(5, 4, 1, 12, 2011, -22.5),
(5, 5, 1, 2, 2011, 18.1),
(5, 5, 1, 3, 2011, 18.1),
(5, 5, 1, 4, 2011, 9.7),
(5, 5, 1, 5, 2011, 9.7),
(5, 5, 1, 6, 2011, 9.7),
(5, 5, 1, 7, 2011, -2.9),
(5, 5, 1, 8, 2011, -2.9),
(5, 5, 1, 9, 2011, -2.9),
(5, 5, 1, 10, 2011, 1.4),
(5, 5, 1, 11, 2011, 1.4),
(5, 5, 1, 12, 2011, 1.4),
(5, 2, 4, 1, 2011, 6.2),
(5, 2, 4, 2, 2011, 6.2),
(5, 2, 4, 3, 2011, 6.2),
(5, 2, 4, 4, 2011, -7.9),
(5, 2, 4, 5, 2011, -7.9),
(5, 2, 4, 6, 2011, -7.9),
(5, 2, 4, 7, 2011, -3.1),
(5, 2, 4, 8, 2011, -3.1),
(5, 2, 4, 9, 2011, -3.1),
(5, 2, 4, 10, 2011, 1.2),
(5, 2, 4, 11, 2011, 1.2),
(5, 2, 4, 12, 2011, 1.2),
(5, 3, 4, 1, 2011, 10.1),
(5, 3, 4, 2, 2011, 10.1),
(5, 3, 4, 3, 2011, 10.1),
(5, 3, 4, 4, 2011, 1),
(5, 3, 4, 5, 2011, 1),
(5, 3, 4, 6, 2011, 1),
(5, 3, 4, 7, 2011, -20.5),
(5, 3, 4, 8, 2011, -20.5),
(5, 3, 4, 9, 2011, -20.5),
(5, 3, 4, 10, 2011, -2.5),
(5, 3, 4, 11, 2011, -2.5),
(5, 3, 4, 12, 2011, -2.5),
(5, 4, 4, 1, 2011, -7.6),
(5, 4, 4, 2, 2011, -7.6),
(5, 4, 4, 3, 2011, -7.6),
(5, 4, 4, 4, 2011, -30.2),
(5, 4, 4, 5, 2011, -30.2),
(5, 4, 4, 6, 2011, -30.2),
(5, 4, 4, 7, 2011, -25.6),
(5, 4, 4, 8, 2011, -25.6),
(5, 4, 4, 9, 2011, -25.6),
(5, 4, 4, 10, 2011, -17.8),
(5, 4, 4, 11, 2011, -17.8),
(5, 4, 4, 12, 2011, -17.8),
(5, 5, 4, 1, 2011, 20),
(5, 5, 4, 2, 2011, 20),
(5, 5, 4, 3, 2011, 20),
(5, 5, 4, 4, 2011, 5.2),
(5, 5, 4, 5, 2011, 5.2),
(5, 5, 4, 6, 2011, 5.2),
(5, 5, 4, 7, 2011, -3.4),
(5, 5, 4, 8, 2011, -3.4),
(5, 5, 4, 9, 2011, -3.4),
(5, 5, 4, 10, 2011, 1.1),
(5, 5, 4, 11, 2011, 1.1),
(5, 5, 4, 12, 2011, 1.1),
(5, 2, 1, 1, 2012, -4.2),
(5, 2, 1, 2, 2012, -4.2),
(5, 2, 1, 3, 2012, -4.2),
(5, 2, 1, 4, 2012, -7.1),
(5, 2, 1, 5, 2012, -7.1),
(5, 2, 1, 6, 2012, -7.1),
(5, 2, 1, 7, 2012, -6.9),
(5, 2, 1, 8, 2012, -6.9),
(5, 2, 1, 9, 2012, -6.9),
(5, 2, 1, 10, 2012, -0.7),
(5, 2, 1, 11, 2012, -0.7),
(5, 2, 1, 12, 2012, -0.7),
(5, 3, 1, 1, 2012, -18.5),
(5, 3, 1, 2, 2012, -18.5),
(5, 3, 1, 3, 2012, -18.5),
(5, 3, 1, 4, 2012, -26.6),
(5, 3, 1, 5, 2012, -26.6),
(5, 3, 1, 6, 2012, -26.6),
(5, 3, 1, 7, 2012, -27.9),
(5, 3, 1, 8, 2012, -27.9),
(5, 3, 1, 9, 2012, -27.9),
(5, 3, 1, 10, 2012, -15),
(5, 3, 1, 11, 2012, -15),
(5, 3, 1, 12, 2012, -15),
(5, 4, 1, 1, 2012, -27.5),
(5, 4, 1, 2, 2012, -27.5),
(5, 4, 1, 3, 2012, -27.5),
(5, 4, 1, 4, 2012, -14.3),
(5, 4, 1, 5, 2012, -14.3),
(5, 4, 1, 6, 2012, -14.3),
(5, 4, 1, 7, 2012, -22.1),
(5, 4, 1, 8, 2012, -22.1),
(5, 4, 1, 9, 2012, -22.1),
(5, 4, 1, 10, 2012, -4.9),
(5, 4, 1, 11, 2012, -4.9),
(5, 4, 1, 12, 2012, -4.9),
(5, 5, 1, 1, 2012, -4.8),
(5, 5, 1, 2, 2012, -4.8),
(5, 5, 1, 3, 2012, -4.8),
(5, 5, 1, 4, 2012, 1.3),
(5, 5, 1, 5, 2012, 1.3),
(5, 5, 1, 6, 2012, 1.3),
(5, 5, 1, 7, 2012, 5),
(5, 5, 1, 8, 2012, 5),
(5, 5, 1, 9, 2012, 5),
(5, 5, 1, 10, 2012, 1),
(5, 5, 1, 11, 2012, 1),
(5, 5, 1, 12, 2012, 1),
(5, 2, 4, 1, 2012, -3.9),
(5, 2, 4, 2, 2012, -3.9),
(5, 2, 4, 3, 2012, -3.9),
(5, 2, 4, 4, 2012, -7.2),
(5, 2, 4, 5, 2012, -7.2),
(5, 2, 4, 6, 2012, -7.2),
(5, 2, 4, 7, 2012, -10.1),
(5, 2, 4, 8, 2012, -10.1),
(5, 2, 4, 9, 2012, -10.1),
(5, 2, 4, 10, 2012, 0.2),
(5, 2, 4, 11, 2012, 0.2),
(5, 2, 4, 12, 2012, 0.2),
(5, 3, 4, 1, 2012, -10.9),
(5, 3, 4, 2, 2012, -10.9),
(5, 3, 4, 3, 2012, -10.9),
(5, 3, 4, 4, 2012, -15.2),
(5, 3, 4, 5, 2012, -15.2),
(5, 3, 4, 6, 2012, -15.2),
(5, 3, 4, 7, 2012, -14),
(5, 3, 4, 8, 2012, -14),
(5, 3, 4, 9, 2012, -14),
(5, 3, 4, 10, 2012, -8),
(5, 3, 4, 11, 2012, -8),
(5, 3, 4, 12, 2012, -8),
(5, 4, 4, 1, 2012, -19.1),
(5, 4, 4, 2, 2012, -19.1),
(5, 4, 4, 3, 2012, -19.1),
(5, 4, 4, 4, 2012, -27.7),
(5, 4, 4, 5, 2012, -27.7),
(5, 4, 4, 6, 2012, -27.7),
(5, 4, 4, 7, 2012, -30.6),
(5, 4, 4, 8, 2012, -30.6),
(5, 4, 4, 9, 2012, -30.6),
(5, 4, 4, 10, 2012, -9),
(5, 4, 4, 11, 2012, -9),
(5, 4, 4, 12, 2012, -9),
(5, 5, 4, 1, 2012, -6.6),
(5, 5, 4, 2, 2012, -6.6),
(5, 5, 4, 3, 2012, -6.6),
(5, 5, 4, 4, 2012, 7.2),
(5, 5, 4, 5, 2012, 7.2),
(5, 5, 4, 6, 2012, 7.2),
(5, 5, 4, 7, 2012, 6.2),
(5, 5, 4, 8, 2012, 6.2),
(5, 5, 4, 9, 2012, 6.2),
(5, 5, 4, 10, 2012, -2.3),
(5, 5, 4, 11, 2012, -2.3),
(5, 5, 4, 12, 2012, -2.3),
(6, 7, 1, 1, 2011, 43),
(6, 8, 1, 1, 2011, 8),
(6, 9, 1, 1, 2011, 59),
(6, 10, 1, 1, 2011, 95),
(6, 7, 1, 2, 2011, 23),
(6, 7, 1, 3, 2011, 23),
(6, 7, 1, 4, 2011, 88),
(6, 7, 1, 5, 2011, 68),
(6, 7, 1, 6, 2011, 68),
(6, 7, 1, 7, 2011, 96),
(6, 7, 1, 8, 2011, 98),
(6, 7, 1, 9, 2011, 96),
(6, 7, 1, 10, 2011, 10),
(6, 7, 1, 11, 2011, 29),
(6, 7, 1, 12, 2011, 84),
(6, 8, 1, 2, 2011, 75),
(6, 8, 1, 3, 2011, 62),
(6, 8, 1, 4, 2011, 53),
(6, 8, 1, 5, 2011, 72),
(6, 8, 1, 6, 2011, 89),
(6, 8, 1, 7, 2011, 11),
(6, 8, 1, 8, 2011, 23),
(6, 8, 1, 9, 2011, 47),
(6, 8, 1, 10, 2011, 37),
(6, 8, 1, 11, 2011, 36),
(6, 8, 1, 12, 2011, 54),
(6, 9, 1, 2, 2011, 2678),
(6, 9, 1, 3, 2011, 48),
(6, 9, 1, 4, 2011, 87),
(6, 9, 1, 5, 2011, 65),
(6, 9, 1, 6, 2011, 4),
(6, 9, 1, 7, 2011, 8),
(6, 9, 1, 8, 2011, 215),
(6, 9, 1, 9, 2011, 10),
(6, 9, 1, 10, 2011, 14),
(6, 9, 1, 11, 2011, 45),
(6, 9, 1, 12, 2011, 68),
(6, 10, 1, 2, 2011, 93),
(6, 10, 1, 3, 2011, 26),
(6, 10, 1, 4, 2011, 58),
(6, 10, 1, 5, 2011, 36),
(6, 10, 1, 6, 2011, 62),
(6, 10, 1, 7, 2011, 14),
(6, 10, 1, 8, 2011, 75),
(6, 10, 1, 9, 2011, 76),
(6, 10, 1, 10, 2011, 14),
(6, 10, 1, 11, 2011, 23),
(6, 10, 1, 12, 2011, 57),
(6, 7, 4, 1, 2011, 78),
(6, 7, 4, 2, 2011, 65),
(6, 7, 4, 3, 2011, 63),
(6, 7, 4, 4, 2011, 2),
(6, 7, 4, 5, 2011, 14),
(6, 7, 4, 6, 2011, 78),
(6, 7, 4, 7, 2011, 76),
(6, 7, 4, 8, 2011, 28),
(6, 7, 4, 9, 2011, 96),
(6, 7, 4, 10, 2011, 18),
(6, 7, 4, 11, 2011, 65),
(6, 7, 4, 12, 2011, 74),
(6, 8, 4, 1, 2011, 65),
(6, 8, 4, 2, 2011, 89),
(6, 8, 4, 3, 2011, 78),
(6, 8, 4, 4, 2011, 54),
(6, 8, 4, 5, 2011, 65),
(6, 8, 4, 6, 2011, 98),
(6, 8, 4, 7, 2011, 78),
(6, 8, 4, 8, 2011, 21),
(6, 8, 4, 9, 2011, 84),
(6, 8, 4, 10, 2011, 87),
(6, 8, 4, 11, 2011, 39),
(6, 8, 4, 12, 2011, 48),
(6, 9, 4, 1, 2011, 32),
(6, 9, 4, 2, 2011, 98),
(6, 9, 4, 3, 2011, 78),
(6, 9, 4, 4, 2011, 21),
(6, 9, 4, 5, 2011, 48),
(6, 9, 4, 6, 2011, 89),
(6, 9, 4, 7, 2011, 36),
(6, 9, 4, 8, 2011, 59),
(6, 9, 4, 9, 2011, 47),
(6, 9, 4, 10, 2011, 58),
(6, 9, 4, 11, 2011, 23),
(6, 9, 4, 12, 2011, 12),
(6, 10, 4, 1, 2011, 16),
(6, 10, 4, 2, 2011, 87),
(6, 10, 4, 3, 2011, 19),
(6, 10, 4, 4, 2011, 73),
(6, 10, 4, 5, 2011, 46),
(6, 10, 4, 6, 2011, 28),
(6, 10, 4, 7, 2011, 82),
(6, 10, 4, 8, 2011, 48),
(6, 10, 4, 9, 2011, 61),
(6, 10, 4, 10, 2011, 6),
(6, 10, 4, 11, 2011, 76),
(6, 10, 4, 12, 2011, 34),
(6, 7, 1, 1, 2012, 61),
(6, 7, 1, 2, 2012, 27),
(6, 7, 1, 3, 2012, 75),
(6, 7, 1, 4, 2012, 73),
(6, 7, 1, 5, 2012, 36),
(6, 7, 1, 6, 2012, 36),
(6, 7, 1, 7, 2012, 91),
(6, 7, 1, 8, 2012, 71),
(6, 7, 1, 9, 2012, 62),
(6, 7, 1, 10, 2012, 56),
(6, 7, 1, 11, 2012, 52),
(6, 7, 1, 12, 2012, 84),
(6, 8, 1, 1, 2012, 92),
(6, 8, 1, 2, 2012, 84),
(6, 8, 1, 3, 2012, 78),
(6, 8, 1, 4, 2012, 54),
(6, 8, 1, 5, 2012, 68),
(6, 8, 1, 6, 2012, 21),
(6, 8, 1, 7, 2012, 48),
(6, 8, 1, 8, 2012, 86),
(6, 8, 1, 9, 2012, 32),
(6, 8, 1, 10, 2012, 33),
(6, 8, 1, 11, 2012, 21),
(6, 8, 1, 12, 2012, 11),
(6, 9, 1, 1, 2012, 74),
(6, 9, 1, 2, 2012, 85),
(6, 9, 1, 3, 2012, 2),
(6, 9, 1, 4, 2012, 47),
(6, 9, 1, 5, 2012, 65),
(6, 9, 1, 6, 2012, 2),
(6, 9, 1, 7, 2012, 47),
(6, 9, 1, 8, 2012, 89),
(6, 9, 1, 9, 2012, 62),
(6, 9, 1, 10, 2012, 14),
(6, 9, 1, 11, 2012, 58),
(6, 9, 1, 12, 2012, 63),
(6, 10, 1, 1, 2012, 78),
(6, 10, 1, 2, 2012, 54),
(6, 10, 1, 3, 2012, 69),
(6, 10, 1, 4, 2012, 58),
(6, 10, 1, 5, 2012, 53),
(6, 10, 1, 6, 2012, 21),
(6, 10, 1, 7, 2012, 45),
(6, 10, 1, 8, 2012, 36),
(6, 10, 1, 9, 2012, 87),
(6, 10, 1, 10, 2012, 65),
(6, 10, 1, 11, 2012, 27),
(6, 10, 1, 12, 2012, 56),
(6, 7, 4, 1, 2012, 84),
(6, 7, 4, 2, 2012, 65),
(6, 7, 4, 3, 2012, 69),
(6, 7, 4, 4, 2012, 62),
(6, 7, 4, 5, 2012, 21),
(6, 7, 4, 6, 2012, 32),
(6, 7, 4, 7, 2012, 14),
(6, 7, 4, 8, 2012, 58),
(6, 7, 4, 9, 2012, 73),
(6, 7, 4, 10, 2012, 12),
(6, 7, 4, 11, 2012, 12),
(6, 7, 4, 12, 2012, 25),
(6, 8, 4, 1, 2012, 98),
(6, 8, 4, 2, 2012, 15),
(6, 8, 4, 3, 2012, 69),
(6, 8, 4, 4, 2012, 35),
(6, 8, 4, 5, 2012, 47),
(6, 8, 4, 6, 2012, 88),
(6, 8, 4, 7, 2012, 99),
(6, 8, 4, 8, 2012, 35),
(6, 8, 4, 9, 2012, 47),
(6, 8, 4, 10, 2012, 65),
(6, 8, 4, 11, 2012, 98),
(6, 8, 4, 12, 2012, 12),
(6, 9, 4, 1, 2012, 48),
(6, 9, 4, 2, 2012, 19),
(6, 9, 4, 3, 2012, 95),
(6, 9, 4, 4, 2012, 98),
(6, 9, 4, 5, 2012, 48),
(6, 9, 4, 6, 2012, 56),
(6, 9, 4, 7, 2012, 32),
(6, 9, 4, 8, 2012, 12),
(6, 9, 4, 9, 2012, 45),
(6, 9, 4, 10, 2012, 89),
(6, 9, 4, 11, 2012, 65),
(6, 9, 4, 12, 2012, 32),
(6, 10, 4, 1, 2012, 94),
(6, 10, 4, 2, 2012, 48),
(6, 10, 4, 3, 2012, 78),
(6, 10, 4, 4, 2012, 32),
(6, 10, 4, 5, 2012, 14),
(6, 10, 4, 6, 2012, 58),
(6, 10, 4, 7, 2012, 98),
(6, 10, 4, 8, 2012, 69),
(6, 10, 4, 9, 2012, 21),
(6, 10, 4, 10, 2012, 2.01),
(6, 10, 4, 11, 2012, 14),
(6, 10, 4, 12, 2012, 22),
(23, 58, 2, 1, 2013, 3),
(23, 58, 2, 2, 2013, 54),
(23, 58, 2, 3, 2013, 78),
(23, 58, 2, 4, 2013, 54),
(23, 58, 2, 5, 2013, 12),
(23, 58, 2, 6, 2013, 65),
(23, 58, 2, 7, 2013, 37),
(23, 58, 2, 8, 2013, 91),
(23, 58, 2, 9, 2013, 49),
(23, 58, 2, 10, 2013, 87),
(23, 58, 2, 11, 2013, 36),
(23, 58, 2, 12, 2013, 48),
(23, 58, 2, 1, 2014, 59),
(23, 58, 2, 2, 2014, 26),
(23, 58, 2, 3, 2014, 15),
(23, 58, 2, 4, 2014, 48),
(23, 58, 2, 5, 2014, 37),
(23, 58, 2, 6, 2014, 19),
(23, 58, 2, 7, 2014, 48),
(23, 58, 2, 8, 2014, 59),
(23, 58, 2, 9, 2014, 48),
(23, 58, 2, 10, 2014, 57),
(23, 58, 2, 11, 2014, 32),
(23, 58, 2, 12, 2014, 15),
(23, 79, 2, 1, 2013, 84),
(23, 79, 2, 2, 2013, 91),
(23, 79, 2, 3, 2013, 25),
(23, 79, 2, 4, 2013, 78),
(23, 79, 2, 5, 2013, 96),
(23, 79, 2, 6, 2013, 36),
(23, 79, 2, 7, 2013, 25),
(23, 79, 2, 8, 2013, 41),
(23, 79, 2, 9, 2013, 78),
(23, 79, 2, 10, 2013, 56),
(23, 79, 2, 11, 2013, 23),
(23, 79, 2, 12, 2013, 41),
(23, 79, 2, 1, 2014, 9),
(23, 79, 2, 2, 2014, 54),
(23, 79, 2, 3, 2014, 7),
(23, 79, 2, 4, 2014, 52),
(23, 79, 2, 5, 2014, 33),
(23, 79, 2, 6, 2014, 63),
(23, 79, 2, 7, 2014, 2),
(23, 79, 2, 8, 2014, 12),
(23, 79, 2, 9, 2014, 24),
(23, 79, 2, 10, 2014, 54),
(23, 79, 2, 11, 2014, 87),
(23, 79, 2, 12, 2014, 69),
(23, 58, 1, 1, 2013, 98),
(23, 58, 1, 2, 2013, 11),
(23, 58, 1, 3, 2013, 3),
(23, 58, 1, 4, 2013, 55),
(23, 58, 1, 5, 2013, 88),
(23, 58, 1, 6, 2013, 77),
(23, 58, 1, 7, 2013, 15),
(23, 58, 1, 8, 2013, 47),
(23, 58, 1, 9, 2013, 96),
(23, 58, 1, 10, 2013, 25),
(23, 58, 1, 11, 2013, 1),
(23, 58, 1, 12, 2013, 49),
(23, 58, 1, 1, 2014, 86),
(23, 58, 1, 2, 2014, 35),
(23, 58, 1, 3, 2014, 14),
(23, 58, 1, 4, 2014, 78),
(23, 58, 1, 5, 2014, 89),
(23, 58, 1, 6, 2014, 65),
(23, 58, 1, 7, 2014, 32),
(23, 58, 1, 8, 2014, 14),
(23, 58, 1, 9, 2014, 87),
(23, 58, 1, 10, 2014, 59),
(23, 58, 1, 11, 2014, 47),
(23, 58, 1, 12, 2014, 58),
(23, 79, 1, 1, 2013, 65),
(23, 79, 1, 2, 2013, 30),
(23, 79, 1, 3, 2013, 14),
(23, 79, 1, 4, 2013, 87),
(23, 79, 1, 5, 2013, 91),
(23, 79, 1, 6, 2013, 78),
(23, 79, 1, 7, 2013, 65),
(23, 79, 1, 8, 2013, 32),
(23, 79, 1, 9, 2013, 14),
(23, 79, 1, 10, 2013, 95),
(23, 79, 1, 11, 2013, 87),
(23, 79, 1, 12, 2013, 65),
(23, 79, 1, 1, 2014, 31),
(23, 79, 1, 2, 2014, 48),
(23, 79, 1, 3, 2014, 58),
(23, 79, 1, 4, 2014, 69),
(23, 79, 1, 5, 2014, 14),
(23, 79, 1, 6, 2014, 58),
(23, 79, 1, 7, 2014, 78),
(23, 79, 1, 8, 2014, 96),
(23, 79, 1, 9, 2014, 26),
(23, 79, 1, 10, 2014, 15),
(23, 79, 1, 11, 2014, 41),
(23, 79, 1, 12, 2014, 35),
(23, 58, 2, 1, 2013, 3),
(23, 58, 2, 2, 2013, 54),
(23, 58, 2, 3, 2013, 78),
(23, 58, 2, 4, 2013, 54),
(23, 58, 2, 5, 2013, 12),
(23, 58, 2, 6, 2013, 65),
(23, 58, 2, 7, 2013, 37),
(23, 58, 2, 8, 2013, 91),
(23, 58, 2, 9, 2013, 49),
(23, 58, 2, 10, 2013, 87),
(23, 58, 2, 11, 2013, 36),
(23, 58, 2, 12, 2013, 48),
(23, 58, 2, 1, 2014, 59),
(23, 58, 2, 2, 2014, 26),
(23, 58, 2, 3, 2014, 15),
(23, 58, 2, 4, 2014, 48),
(23, 58, 2, 5, 2014, 37),
(23, 58, 2, 6, 2014, 19),
(23, 58, 2, 7, 2014, 48),
(23, 58, 2, 8, 2014, 59),
(23, 58, 2, 9, 2014, 48),
(23, 58, 2, 10, 2014, 57),
(23, 58, 2, 11, 2014, 32),
(23, 58, 2, 12, 2014, 15),
(23, 79, 2, 1, 2013, 84),
(23, 79, 2, 2, 2013, 91),
(23, 79, 2, 3, 2013, 25),
(23, 79, 2, 4, 2013, 78),
(23, 79, 2, 5, 2013, 96),
(23, 79, 2, 6, 2013, 36),
(23, 79, 2, 7, 2013, 25),
(23, 79, 2, 8, 2013, 41),
(23, 79, 2, 9, 2013, 78),
(23, 79, 2, 10, 2013, 56),
(23, 79, 2, 11, 2013, 23),
(23, 79, 2, 12, 2013, 41),
(23, 79, 2, 1, 2014, 9),
(23, 79, 2, 2, 2014, 54),
(23, 79, 2, 3, 2014, 7),
(23, 79, 2, 4, 2014, 52),
(23, 79, 2, 5, 2014, 33),
(23, 79, 2, 6, 2014, 63),
(23, 79, 2, 7, 2014, 2),
(23, 79, 2, 8, 2014, 12),
(23, 79, 2, 9, 2014, 24),
(23, 79, 2, 10, 2014, 54),
(23, 79, 2, 11, 2014, 87),
(23, 79, 2, 12, 2014, 69),
(23, 58, 1, 1, 2013, 98),
(23, 58, 1, 2, 2013, 11),
(23, 58, 1, 3, 2013, 3),
(23, 58, 1, 4, 2013, 55),
(23, 58, 1, 5, 2013, 88),
(23, 58, 1, 6, 2013, 77),
(23, 58, 1, 7, 2013, 15),
(23, 58, 1, 8, 2013, 47),
(23, 58, 1, 9, 2013, 96),
(23, 58, 1, 10, 2013, 25),
(23, 58, 1, 11, 2013, 1),
(23, 58, 1, 12, 2013, 49),
(23, 58, 1, 1, 2014, 86),
(23, 58, 1, 2, 2014, 35),
(23, 58, 1, 3, 2014, 14),
(23, 58, 1, 4, 2014, 78),
(23, 58, 1, 5, 2014, 89),
(23, 58, 1, 6, 2014, 65),
(23, 58, 1, 7, 2014, 32),
(23, 58, 1, 8, 2014, 14),
(23, 58, 1, 9, 2014, 87),
(23, 58, 1, 10, 2014, 59),
(23, 58, 1, 11, 2014, 47),
(23, 58, 1, 12, 2014, 58),
(23, 79, 1, 1, 2013, 65),
(23, 79, 1, 2, 2013, 30),
(23, 79, 1, 3, 2013, 14),
(23, 79, 1, 4, 2013, 87),
(23, 79, 1, 5, 2013, 91),
(23, 79, 1, 6, 2013, 78),
(23, 79, 1, 7, 2013, 65),
(23, 79, 1, 8, 2013, 32),
(23, 79, 1, 9, 2013, 14),
(23, 79, 1, 10, 2013, 95),
(23, 79, 1, 11, 2013, 87),
(23, 79, 1, 12, 2013, 65),
(23, 79, 1, 1, 2014, 31),
(23, 79, 1, 2, 2014, 48),
(23, 79, 1, 3, 2014, 58),
(23, 79, 1, 4, 2014, 69),
(23, 79, 1, 5, 2014, 14),
(23, 79, 1, 6, 2014, 58),
(23, 79, 1, 7, 2014, 78),
(23, 79, 1, 8, 2014, 96),
(23, 79, 1, 9, 2014, 26),
(23, 79, 1, 10, 2014, 15),
(23, 79, 1, 11, 2014, 41),
(23, 79, 1, 12, 2014, 35),
(25, 81, 2, 1, 1992, 12),
(25, 81, 2, 2, 1992, 32),
(25, 81, 2, 3, 1992, 2),
(25, 81, 2, 4, 1992, 23),
(25, 81, 2, 5, 1992, 15),
(25, 81, 2, 6, 1992, 75),
(25, 81, 2, 7, 1992, 22),
(25, 81, 2, 8, 1992, 78),
(25, 81, 2, 9, 1992, 45),
(25, 81, 2, 10, 1992, 6),
(25, 81, 2, 11, 1992, 65),
(25, 81, 2, 12, 1992, 14),
(25, 82, 2, 1, 1992, 47),
(25, 82, 2, 2, 1992, 87),
(25, 82, 2, 3, 1992, 12),
(25, 82, 2, 4, 1992, 25),
(25, 82, 2, 5, 1992, 84),
(25, 82, 2, 6, 1992, 74),
(25, 82, 2, 7, 1992, 98),
(25, 82, 2, 8, 1992, 47),
(25, 82, 2, 9, 1992, 26),
(25, 82, 2, 10, 1992, 41),
(25, 82, 2, 11, 1992, 88),
(25, 82, 2, 12, 1992, 12),
(25, 81, 1, 1, 1992, 34),
(25, 81, 1, 2, 1992, 22),
(25, 81, 1, 3, 1992, 34),
(25, 81, 1, 4, 1992, 31),
(25, 81, 1, 5, 1992, 42),
(25, 81, 1, 6, 1992, 64),
(25, 81, 1, 7, 1992, 45),
(25, 81, 1, 8, 1992, 34),
(25, 81, 1, 9, 1992, 66),
(25, 81, 1, 10, 1992, 34),
(25, 81, 1, 11, 1992, 32),
(25, 81, 1, 12, 1992, 12),
(25, 82, 1, 1, 1992, 78),
(25, 82, 1, 2, 1992, 59),
(25, 82, 1, 3, 1992, 23),
(25, 82, 1, 4, 1992, 35),
(25, 82, 1, 5, 1992, 78),
(25, 82, 1, 6, 1992, 14),
(25, 82, 1, 7, 1992, 67),
(25, 82, 1, 8, 1992, 35),
(25, 82, 1, 9, 1992, 36),
(25, 82, 1, 10, 1992, 56),
(25, 82, 1, 11, 1992, 68),
(25, 82, 1, 12, 1992, 32),
(25, 81, 27, 1, 1992, 12),
(25, 81, 27, 2, 1992, 8),
(25, 81, 27, 3, 1992, 63),
(25, 81, 27, 4, 1992, 12),
(25, 81, 27, 5, 1992, 35),
(25, 81, 27, 6, 1992, 67),
(25, 81, 27, 7, 1992, 54),
(25, 81, 27, 8, 1992, 69),
(25, 81, 27, 9, 1992, 11),
(25, 81, 27, 10, 1992, 25),
(25, 81, 27, 11, 1992, 58),
(25, 81, 27, 12, 1992, 90),
(25, 82, 27, 1, 1992, 23),
(25, 82, 27, 2, 1992, 45),
(25, 82, 27, 3, 1992, 65),
(25, 82, 27, 4, 1992, 32),
(25, 82, 27, 5, 1992, 14),
(25, 82, 27, 6, 1992, 74),
(25, 82, 27, 7, 1992, 87),
(25, 82, 27, 8, 1992, 95),
(25, 82, 27, 9, 1992, 56),
(25, 82, 27, 10, 1992, 15),
(25, 82, 27, 11, 1992, 34),
(25, 82, 27, 12, 1992, 53),
(23, 85, 2, 1, 1992, 89),
(23, 85, 2, 2, 1992, 62),
(23, 85, 2, 3, 1992, 32),
(23, 85, 2, 4, 1992, 54),
(23, 85, 2, 5, 1992, 87),
(23, 85, 2, 6, 1992, 98),
(23, 85, 2, 7, 1992, 69),
(23, 85, 2, 8, 1992, 32),
(23, 85, 2, 9, 1992, 45),
(23, 85, 2, 10, 1992, 87),
(23, 85, 2, 11, 1992, 36),
(23, 85, 2, 12, 1992, 98),
(23, 58, 2, 1, 1992, 15),
(23, 58, 2, 2, 1992, 47),
(23, 58, 2, 3, 1992, 25),
(23, 58, 2, 4, 1992, 78),
(23, 58, 2, 5, 1992, 65),
(23, 58, 2, 6, 1992, 21),
(23, 58, 2, 7, 1992, 14),
(23, 58, 2, 8, 1992, 74),
(23, 58, 2, 9, 1992, 87),
(23, 58, 2, 10, 1992, 69),
(23, 58, 2, 11, 1992, 36),
(23, 58, 2, 12, 1992, 12),
(23, 79, 2, 1, 1992, 24),
(23, 79, 2, 2, 1992, 86),
(23, 79, 2, 3, 1992, 64),
(23, 79, 2, 4, 1992, 97),
(23, 79, 2, 5, 1992, 31),
(23, 79, 2, 6, 1992, 65),
(23, 79, 2, 7, 1992, 98),
(23, 79, 2, 8, 1992, 7),
(23, 79, 2, 9, 1992, 53),
(23, 79, 2, 10, 1992, 20),
(23, 79, 2, 11, 1992, 87),
(23, 79, 2, 12, 1992, 60),
(23, 85, 2, 1, 2013, 47),
(23, 85, 2, 2, 2013, 12),
(23, 85, 2, 3, 2013, 32),
(23, 85, 2, 4, 2013, 65),
(23, 85, 2, 5, 2013, 74),
(23, 85, 2, 6, 2013, 98),
(23, 85, 2, 7, 2013, 45),
(23, 85, 2, 8, 2013, 25),
(23, 85, 2, 9, 2013, 36),
(23, 85, 2, 10, 2013, 98),
(23, 85, 2, 11, 2013, 78),
(23, 85, 2, 12, 2013, 45),
(23, 85, 2, 1, 2014, 14),
(23, 85, 2, 2, 2014, 26),
(23, 85, 2, 3, 2014, 87),
(23, 85, 2, 4, 2014, 98),
(23, 85, 2, 5, 2014, 74),
(23, 85, 2, 6, 2014, 36),
(23, 85, 2, 7, 2014, 96),
(23, 85, 2, 8, 2014, 84),
(23, 85, 2, 9, 2014, 75),
(23, 85, 2, 10, 2014, 15),
(23, 85, 2, 11, 2014, 42),
(23, 85, 2, 12, 2014, 68),
(23, 58, 1, 1, 1992, 32),
(23, 58, 1, 2, 1992, 14),
(23, 58, 1, 3, 1992, 54),
(23, 58, 1, 4, 1992, 87),
(23, 58, 1, 5, 1992, 69),
(23, 58, 1, 6, 1992, 12),
(23, 58, 1, 7, 1992, 63),
(23, 58, 1, 8, 1992, 8),
(23, 58, 1, 9, 1992, 47),
(23, 58, 1, 10, 1992, 29),
(23, 58, 1, 11, 1992, 25),
(23, 58, 1, 12, 1992, 47),
(23, 79, 1, 1, 1992, 14),
(23, 79, 1, 2, 1992, 22),
(23, 79, 1, 3, 1992, 88),
(23, 79, 1, 4, 1992, 77),
(23, 79, 1, 5, 1992, 65),
(23, 79, 1, 6, 1992, 98),
(23, 79, 1, 7, 1992, 15),
(23, 79, 1, 8, 1992, 22),
(23, 79, 1, 9, 1992, 69),
(23, 79, 1, 10, 1992, 44),
(23, 79, 1, 11, 1992, 23),
(23, 79, 1, 12, 1992, 80),
(23, 85, 1, 1, 1992, 98),
(23, 85, 1, 2, 1992, 47),
(23, 85, 1, 3, 1992, 12),
(23, 85, 1, 4, 1992, 51),
(23, 85, 1, 5, 1992, 69),
(23, 85, 1, 6, 1992, 28),
(23, 85, 1, 7, 1992, 58),
(23, 85, 1, 8, 1992, 47),
(23, 85, 1, 9, 1992, 96),
(23, 85, 1, 10, 1992, 13),
(23, 85, 1, 11, 1992, 87),
(23, 85, 1, 12, 1992, 65),
(23, 85, 1, 1, 2013, 47),
(23, 85, 1, 2, 2013, 58),
(23, 85, 1, 3, 2013, 93),
(23, 85, 1, 4, 2013, 12),
(23, 85, 1, 5, 2013, 47),
(23, 85, 1, 6, 2013, 62),
(23, 85, 1, 7, 2013, 15),
(23, 85, 1, 8, 2013, 47),
(23, 85, 1, 9, 2013, 58),
(23, 85, 1, 10, 2013, 96),
(23, 85, 1, 11, 2013, 32),
(23, 85, 1, 12, 2013, 17),
(23, 85, 1, 1, 2014, 98),
(23, 85, 1, 2, 2014, 45),
(23, 85, 1, 3, 2014, 69),
(23, 85, 1, 4, 2014, 14),
(23, 85, 1, 5, 2014, 25),
(23, 85, 1, 6, 2014, 98),
(23, 85, 1, 7, 2014, 45),
(23, 85, 1, 8, 2014, 68),
(23, 85, 1, 9, 2014, 90),
(23, 85, 1, 10, 2014, 70),
(23, 85, 1, 11, 2014, 54),
(23, 85, 1, 12, 2014, 54);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ambito`
--
ALTER TABLE `ambito`
  ADD PRIMARY KEY (`idAmbito`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`),
  ADD KEY `Categoria_SuperCategoria_idx` (`idSuperCategoria`);

--
-- Indices de la tabla `fuente`
--
ALTER TABLE `fuente`
  ADD PRIMARY KEY (`idFuente`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `supercategoria`
--
ALTER TABLE `supercategoria`
  ADD PRIMARY KEY (`idSuperCategoria`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usersconfirm`
--
ALTER TABLE `usersconfirm`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `variable`
--
ALTER TABLE `variable`
  ADD PRIMARY KEY (`idVariable`),
  ADD KEY `Variable_Fuente_idx` (`idFuente`);

--
-- Indices de la tabla `variableambitocategoria`
--
ALTER TABLE `variableambitocategoria`
  ADD KEY `VAC_Categoria_idx` (`idCategoria`),
  ADD KEY `VAC_Variable_idx` (`idVariable`),
  ADD KEY `VAC_Ambito_idx` (`idAmbito`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ambito`
--
ALTER TABLE `ambito`
  MODIFY `idAmbito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT de la tabla `fuente`
--
ALTER TABLE `fuente`
  MODIFY `idFuente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `supercategoria`
--
ALTER TABLE `supercategoria`
  MODIFY `idSuperCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `usersconfirm`
--
ALTER TABLE `usersconfirm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `variable`
--
ALTER TABLE `variable`
  MODIFY `idVariable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `Categoria_SuperCategoria` FOREIGN KEY (`idSuperCategoria`) REFERENCES `supercategoria` (`idSuperCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `variable`
--
ALTER TABLE `variable`
  ADD CONSTRAINT `Variable_Fuente` FOREIGN KEY (`idFuente`) REFERENCES `fuente` (`idFuente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `variableambitocategoria`
--
ALTER TABLE `variableambitocategoria`
  ADD CONSTRAINT `VAC_Ambito` FOREIGN KEY (`idAmbito`) REFERENCES `ambito` (`idAmbito`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `VAC_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `VAC_Variable` FOREIGN KEY (`idVariable`) REFERENCES `variable` (`idVariable`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
